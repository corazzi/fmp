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
       
        $code_snippets = Snippet::where('user_id', '=',  Sentry::getUser()->id)->orderBy('id', 'DESC')->paginate(10);
		return View::make('dash.snippets.my_snippets', compact('code_snippets'));
	}
   
    /**
     * Get Public Snippets.
     *
     * @return View
     */

	public function getPublicSnippet()
	{
		$code_snippets = Snippet::where('state', '=', 'public')->orderBy('id', 'DESC')->paginate(15);
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

        //check if the snippet exists, if not redirect with error
        if (is_null($snippet_data))
        {
        	return Redirect::to('my-snippets')->with('error', Lang::get('features/snippets.not_found'));
        }

        return View::make('dash/snippets/view_snippet', compact('snippet_data'));
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
			'description'         => 'required|min:10',
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

		//really not sure about this but hell with it for now, get full name for author
	    $fullname = Sentry::getUser()->first_name.' '.Sentry::getUser()->last_name;

        //create new snippet - elequent you beuty
		$code_snippet = new Snippet();

        //update snippet data
		$code_snippet->title           = e(Input::get('title')); //e() sanitizes input, best way in laravel apparently..
		$code_snippet->slug            = 
		e(
		   Str::slug(Input::get('title'))

		); //slugs yayyy
		$code_snippet->description     = e(Input::get('description'));
		$code_snippet->code_snippet    = e(Input::get('code_snippet'));
		$code_snippet->tags            = e(Input::get('tags'));
		$code_snippet->user_id         = Sentry::getId();
		$code_snippet->author          = $fullname;


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
			return Redirect::to("my-snippets")->with('success', Lang::get('features/snippets.create.success'));
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
			    'description'         => 'required|min:10',
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