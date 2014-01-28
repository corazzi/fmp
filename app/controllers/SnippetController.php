<?php

class SnippetController extends BaseController {


	public function __construct()
	{
		parent::__construct();

		//check if the user is logged in
        $this->beforeFilter('auth');        
	}

    
    /**
     * Get My Snippets.
     *
     * @return View
     */

	public function getMySnippet()
	{
		
		$search_term = Request::get('search');

		if ($search_term) {

			// find snippet where snippet user_id = sentry user_id, 
			// where title is like $query
			// OR where description is like $query 
			// order by id desc and paginate results 
			
			$code_snippets = Snippet::where('user_id', '=', Sentry::getUser()->id)
			                            ->where('title', 'LIKE', "%$search_term%")
			                            ->orWhere('description', 'LIKE', "%$search_term%")
			                            ->orderBy('id', 'DESC')	
			                        	->paginate(10);

			return View::make('dash.snippets.my_search', compact('code_snippets'));
		}

	
       
        $code_snippets = Snippet::where('user_id', '=',  Sentry::getUser()->id)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);

		return View::make('dash.snippets.my_snippets', compact('code_snippets'));
	}
   
    /**
     * Get Public Snippets and Search.
     *
     * @return View
     */

	public function getPublicSnippet()
	{
		//assign the search term to query
		$search_term = Request::get('search');
        
        //if there has been a query submitted
		if($search_term)
		{
			// find snippet where state = public, 
			// where title is like $query
			// OR where description is like $query 
			// order by id desc and paginate results 
			$code_snippets = Snippet::where('state', '=', 'public')
			                            ->where('title', 'LIKE', "%$search_term%")
			                            ->orWhere('description', 'LIKE', "%$search_term%")
			                            ->orderBy('id', 'DESC')	
			                        	->paginate(15);

            //return view with results
			return View::make('dash.snippets.public_search', compact('code_snippets'));

		} 


		//pull all snippets where state = public and return the view
		$code_snippets = Snippet::where('state', '=', 'public')
		                            ->orderBy('id', 'DESC')
		                            ->paginate(15);

	

		return View::make('dash.snippets.public', compact('code_snippets'));
	}


    /**
     * Get My View Snippet.
     *
     * @return View 
     */


	public function getViewSnippet($slug)
	{

        $snippet_data = Snippet::where('slug', $slug)->first();
        $snippet_user = Snippet::where('slug', $slug)->pluck('user_id');
		$snippet_state = Snippet::where('slug', $slug)->pluck('state');
        
        //because im using slugs the majority of the below 
        //doesnt really need to be here, as they would have
        //to guess the slug of another users snippet to view it
        //but its here anyway for that extra added security :D

        //lets see if the snippet exists at all
		if(is_null($snippet_data))
        {
        	//if it doesnt exist show error and redirect
        	return Redirect::route('my-snippets')->with('error', Lang::get('features/snippets.not_found'));
        } 
        else
        {
        	
        	if ($snippet_state == 'private') 
            {
			    
			    //if the user owns the snippet
			    if(Sentry::getUser()->id != $snippet_user)
			    {
				    
				    //if the dont own it, they shouldnt be here
				    return Redirect::route('my-snippets')->with('error', Lang::get('features/snippets.view_check'));

			    } 
			    else
			    {
				
				    //if they do own it then show away!
				    return View::make('dash.snippets.view_snippet',  compact('snippet_data'));
			    }

            }
            elseif ($snippet_state == 'public' && $snippet_user == Sentry::getUser()->id) 
            {
                //if its public and the user owns it show them it in my snippets
			    return View::make('dash.snippets.view_snippet', compact('snippet_data'));
            }
            else
            {

			    //if the snippet is public but they dont own it
			    //redirect to public snippets 
			    return Redirect::route('public-snippets');
		
            }
        }

	}

    /**
     * Get Public View Snippet.
     *
     * @return View
     */

	public function getViewPublicSnippet($slug)
	{

        $snippet_data = Snippet::where('slug', $slug)->first();

        //check if the snippet exists, if not redirect with error
        if (is_null($snippet_data))
        {
        	return Redirect::route('snippets')->with('error',  Lang::get('features/snippets.not_found'));
        }

        return View::make('dash/snippets/public_view_snippet', compact('snippet_data'));

	}


    /**
     * Get Add Snippet.
     *
     * @return View
     */

	public function getAddSnippet()
	{
		return View::make('dash.snippets.add_snippet');
	}

    /**
     * Post Add Snippet.
     *
     * @return Redirect
     */

	public function postAddSnippet()
	{

     	//declare the rules for the form validation
		$rules = array(
			'title'               => 'required|min:3',
			'code_snippet'        => 'required',
			'tags'                => 'required',
		);

		//create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		//if validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			//oops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

        //create new snippet - elequent you beauty
		$code_snippet = new Snippet();

        //update snippet data
		$code_snippet->title           = e(Input::get('title')); //e() sanitizes input, best way in laravel apparently..
		$code_snippet->description     = e(Input::get('description'));
		$code_snippet->code_snippet    = e(Input::get('code_snippet'));
		$code_snippet->credit          = e(Input::get('credit'));
		$code_snippet->tags            = e(Input::get('tags'));
		$code_snippet->user_id         = Sentry::getId();
		$code_snippet->author          = Sentry::getUser()->username;


        //stop script kiddies editing the source on the front-end 
        //this stops edited values being submitted 
        if(Input::get('state'))
        {
		    if(Input::get('state') == 'public' || Input::get('state') == 'private')
		    {
			    //if the value is private/public lets store it   
			    $code_snippet->state = e(Input::get('state'));  
			} 
			else 
			{
				//if value has been tampered with submit default
				$code_snippet->state = 'public';
			}
	    
	    } 
	    else 
	    { 
            
            //if the radio button has been unchecked
            //submit default
			$code_snippet->state = 'public';
		}

		//was the snippet saved?
		if($code_snippet->save())
		{
			//redirect to my snippets
			return Redirect::route("my-snippets")->with('success', Lang::get('features/snippets.create.success'));
		}

		//redirect to add-snippet page..
		return Redirect::to('add-snippet')->with('error', Lang::get('features/snippets.create.error'));

	}

    /**
     * Get Edit Snippet.
     *
     * @return View
     */


	public function getEditSnippet($snippetId = null)
	{
		//check if the snippet exists
        if (is_null($this->data['code_snippet'] = Snippet::find($snippetId)))
        {
            //redirect with not found error
            return Redirect::route('my-snippets')->with('error', Lang::get('features/snippets.not_found'));
        }

        //get the user_id of the snippet
		$snippet_user = Snippet::where('id', $snippetId)->pluck('user_id');

		//check if user owns the snippet
		if (Sentry::getUser()->id != $snippet_user) 
		{
            //redirect with bad message, bad kids
			return Redirect::route('my-snippets')->with('error', Lang::get('features/snippets.update_check'));	
		} 

        return View::make('dash.snippets.edit_snippet', $this->data);

	}

    /**
     * Post Edit Snippet.
     *
     * @return Redirect
     */

	public function postEditSnippet($snippetId = null)
	{
        //check if the snippet exists
        if (is_null($code_snippet = Snippet::find($snippetId)))
        {
            //redirect with not found error
            return Redirect::route('my-snippets')->with('error', Lang::get('features/snippets.not_found'));
        }

        //get the user_id of the snippet
		$snippet_user = Snippet::where('id', $snippetId)->pluck('user_id');

        //check if user owns the snippet
		if (Sentry::getUser()->id != $snippet_user) 
		{
            //redirect with bad message, bad kids
			return Redirect::route('my-snippets')->with('error', Lang::get('features/snippets.update_check'));	
		} 
		else
		{

            //declare rules for the form (same as addSnippet)
		    $rules = array(
			    'title'               => 'required|min:3',
			    'code_snippet'        => 'required',
			    'tags'                => 'required',
		    );

		    //create new validator instance with said rules
		    $validator = Validator::make(Input::all(), $rules);

		    //if validation fails
		    if ($validator->fails())
            {
               //something went wrong show validation errors
               return Redirect::back()->withInput()->withErrors($validator);
            }

        
            //update snippet
		    $code_snippet->title           = e(Input::get('title'));
		    $code_snippet->description     = e(Input::get('description'));
		    $code_snippet->code_snippet    = e(Input::get('code_snippet'));
		    $code_snippet->credit          = e(Input::get('credit'));
		    $code_snippet->tags            = e(Input::get('tags'));

            if(Input::get('state'))
            {
		        if(Input::get('state') == 'public' || Input::get('state') == 'private')
		        {
			        //if the value is private/public lets store it   
			        $code_snippet->state = e(Input::get('state'));  
			    } 
			    else 
			    {
				    //if value has been tampered with submit default
				    $code_snippet->state = 'public';
			    }
	    
	        } 
	        else 
	        { 
            
                //if the radio button has been unchecked
                //submit default
			    $code_snippet->state = 'public';
		    }


		    if($code_snippet->save())
		    {
			    //redirect to my snippets
			    return Redirect::route("my-snippets")->with('success', Lang::get('features/snippets.update.success'));
		    }


		    //redirect to edit-snippet page..
		    return Redirect::to('snippets/$snippetId/edit/')->with('error', Lang::get('features/snippets.update.error'));
	    }


	}

    /**
     * Get Delete Snippet.
     *
     * @return Redirect
     */

	public function getDeleteSnippet($snippetId)
	{

		//check if the snippet exists
		if (is_null($snippet = Snippet::find($snippetId)))
		{
			//redirect to my snippets with not found error
			return Redirect::route('my-snippets')->with('error', Lang::get('features/snippets.not_found'));
		}

        //get the user_id of the snippet
		$snippet_user = Snippet::where('id', $snippetId)->pluck('user_id');

		//check if user owns the snippet
		if (Sentry::getUser()->id != $snippet_user) 
		{
            //redirect with bad message, bad kids
			return Redirect::route('my-snippets')->with('error', Lang::get('features/snippets.delete_check'));	
		} 
		else 
		{

            //delete the snippet
		    $snippet->delete();

		    //redirect to my snippets page with success message
		    return Redirect::route('my-snippets')->with('success', Lang::get('features/snippets.delete'));

	    }

	}

}