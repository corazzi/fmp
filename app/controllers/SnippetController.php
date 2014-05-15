<?php

class SnippetController extends BaseController {


	public function __construct()
	{
		parent::__construct();
		//check if the user is logged in
        $this->beforeFilter('auth');        
	}
    

    /**
     * Get all published snippets.
     *
     * @return View
     */

	public function getSnippets()
	{
		//assign the search term to variable
		$search_term = Request::get('search');
        
        //if there has been a search term submitted
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
			return View::make('dash.snippets.snippets_search', compact('code_snippets'));

		} 


		//pull all snippets where state = public 
		$code_snippets = Snippet::where('state', '=', 'public')
		                            ->orderBy('id', 'DESC')
		                            ->paginate(9);

        //return view with snippets
		return View::make('dash.snippets.snippets_home', compact('code_snippets'));
	}


    /**
     * Get snippets by tag.
     *
     * @return View
     */

	public function getTagSnippets($tag)
	{
		
		//get snippets where tags is like searched tag
		$code_snippets = Snippet::where('state', '=', 'public')
		                            ->where('tags', 'like', "%$tag%")
		                            ->orderBy('id', 'DESC')
		                            ->paginate(9);

        //reurn the view with snippets and search tag
		return View::make('dash.snippets.snippets_tags', compact('code_snippets', 'tag'));
        
	}




    /**
     * Get Single Snippet View.
     *
     * @return View
     */

	public function getViewSnippet($slug)
	{

		//get snippet data from slug
        $snippet_data = Snippet::where('slug', $slug)->first();

        //check if the snippet exists, if not redirect with error
        if (is_null($snippet_data))
        {
        	Notification::error('That snippet doesnt exist');

        	return Redirect::route('code-snippets');
        } 
        else 
        {
        	//favorite stuff here
            $favorites = DB::table('snippets_favorite')->whereUserId(Sentry::getUser()->id)->lists('snippet_id');

            //voting stuff here
            $ratings = DB::table('snippets_rating')->where('user_id', Sentry::getUser()->id)->where('snippet_id', $snippet_data->id)->get();
            $good_ratings = DB::table("snippets_rating")->where('snippet_id', $snippet_data->id)->lists('good');

            //comments stuff here
            $comments = DB::table('snippets_comment')->where('snippet_id', $snippet_data->id)->orderBy('id', 'DESC')->get();



        
            //snippet user info 
            $user = Sentry::findUserById($snippet_data->user_id);

            //snippet tags
            $tags = explode(',', $snippet_data->tags);

            return View::make('dash/snippets/snippets_view', compact('snippet_data', 'favorites', 'ratings', 'good_ratings', 'user', 'tags', 'comments', 'comment_user'));

        }   
	}

	/**
     * Favorite dem snipz.
     *
     * @return Redirect 
     */


	public function postFavoriteSnippet($slug)
	{ 
		//get snippet id from slug
		$snippet_id = Snippet::where('slug', $slug)->pluck('id');
        
        //relational magic 
        Sentry::getUser()->snippet_favorites()->attach($snippet_id);

        //toast notifciation 
        Notification::success('Snippet Favorited!');

        return Redirect::back();

	}

	/**
     * unFavorite dem snipz.
     *
     * @return Redirect 
     */


	public function postUnFavoriteSnippet($slug)
	{ 
		//get snippet id from slug
		$snippet_id = Snippet::where('slug', $slug)->pluck('id');

        //relational magic detach favorite 
        Sentry::getUser()->snippet_favorites()->detach($snippet_id);
        
        //red toast notification
        Notification::error('Snippet Unfavorited!');

        return Redirect::back();
	}


	/**
     * Good Content Vote 
     *
     * @return Redirect 
     */


	public function postGoodVote($slug)
	{ 
		//get snippet id from slug
		$snippet_id = Snippet::where('slug', $slug)->pluck('id');
 

        //get all ratings 
		$ratings = DB::table('snippets_rating')
                   ->where('user_id', '=', Sentry::getUser()->id)
                   ->where('snippet_id', '=', $snippet_id)
                   ->get();


        // if empty this means they havnt rated anything 
        if (empty($ratings)) 
        {

        	//lets carry on with the rating procedure 
        	Sentry::getUser()->snippet_ratings()->attach($snippet_id, array('good' => '1'));
            
            //toast notification
        	Notification::success('Yay vote submmited!');

            return Redirect::back();
        } 
        else 
        {
        	//already voted punk
        	return Redirect::back();
        }

	}

	/**
     * Bad Content Vote 
     *
     * @return Redirect 
     */


	public function postBadVote($slug)
	{ 
		//get snippet id from slug
		$snippet_id = Snippet::where('slug', $slug)->pluck('id');

        $ratings = DB::table('snippets_rating')
                   ->where('user_id', '=', Sentry::getUser()->id)
                   ->where('snippet_id', '=', $snippet_id)
                   ->get();
                   
        if(empty($ratings))
        {
        	Sentry::getUser()->snippet_ratings()->attach($snippet_id, array('bad' => '1'));
            
            //growl notification
            Notification::error('Nay vote submmited!');

            return Redirect::back();
        }
        else
        {
          	//already voted punk
        	return Redirect::back();
        }

	}

	/**
     * Post Snippet Comment
     *
     * @return Redirect 
     */


	public function postSnippetComment($slug)
	{

	    $rules = array(
            'comment' => 'required|min:10|max:255'
        ); 

		//create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		//if validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			Notification::error("Check form for errors!");
			//oops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else
		{
		    //get snippet id from slug
		    $snippet_id = Snippet::where('slug', $slug)->pluck('id');
            
            $comment = e(Input::get('comment'));

		    Sentry::getUser()->snippet_comments()->attach($snippet_id, array('comment' => $comment));

            Notification::success("Comment submmited!");

            return Redirect::back();
		}
	}

	/**
     * Post Delete Snippet Comment
     *
     * @return Redirect 
     */


	public function postDeleteSnippetComment($slug, $id)
	{
		//get the user_id of the comment
		$comment_user = DB::table('snippets_comment')->where('id', $id)->pluck('user_id');

        //check if its the same as the user trying to delete it OR an admin
        if(Sentry::getUser()->id === $comment_user || Sentry::getUser()->hasAccess('admin'))
        {
            
            //if it is delete the comment
		    DB::table('snippets_comment')->where('id', $id)->delete();

            Notification::success("Comment deleted!");

            return Redirect::back();

        }
        else
        {
        	//if not alert them
        	Notification::error("Not your comment!");

        	return Redirect::back();
        }

	}

    /**
     * Get Add Snippet.
     *
     * @return View
     */

	public function getAddSnippet()
	{
		//quick work around for the tags form validation with the tags manager JS library
		$tags_string = Input::old('hidden-tags');
        $tag_array = explode(",", $tags_string);
        $string = "'" . implode("','", $tag_array) . "'";

		return View::make('dash.snippets.snippets_add', compact('string'));

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
			'title'               => 'required|min:4|max:80',
			'description'         => 'required|min:10',
			'code_snippet'        => 'required|min:10',
			'state'               => 'required',
			'hidden-tags'         => 'required'
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
        
        //remove the spaces from tags 
        $spaced_tags = str_replace(' ', '', Input::get('hidden-tags'));
		$code_snippet->tags            = e($spaced_tags);


		$code_snippet->user_id         = Sentry::getId();


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
			Notification::success("Snippet added!");
			return Redirect::route("code-snippets");
		}

		Notification::error("Something went wrong, try again!");
		return Redirect::to('add-snippet');

	}

    /**
     * Get Edit Snippet.
     *
     * @return View
     */


	public function getEditSnippet($slug)
	{
		
		$snippet_data = Snippet::where('slug', $slug)->first();

        if (is_null($snippet_data))
        {
            //redirect with not found error
            Notification::error("Snippet not found!");
            return Redirect::back();
        }
        else 
        {

            if($snippet_data->user_id != Sentry::getUser()->id)
            {
            	Notification::error("You're not allowed to do that");
            	return Redirect::back();
            }
            else 
            {

        	    //do the fiddly tag stuff
        	    $tags_string = $snippet_data->tags;
                $tag_array = explode(",", $tags_string);
                $string = "'" . implode("','", $tag_array) . "'";

                return View::make('dash.snippets.snippets_edit', compact('snippet_data', 'string'));

            }
        }
	}

    /**
     * Post Edit Snippet.
     *
     * @return Redirect
     */

	public function postEditSnippet($slug)
	{
       
        //Lets get the snippet
		$snippet_data = Snippet::where('slug', $slug)->first();


            
            if($snippet_data->user_id != Sentry::getUser()->id)
            {
            	Notification::error("You're not allowed to do that");
            	return Redirect::back();
            }
            else 
            {

     	        //declare the rules for the form validation
		        $rules = array(
			        'title'               => 'required|min:4|max:80',
			        'description'         => 'required|min:10',
			        'code_snippet'        => 'required|min:10',
			        'state'               => 'required',
			        'hidden-tags'         => 'required'
		        );

		        //create a new validator instance from our validation rules
		        $validator = Validator::make(Input::all(), $rules);

		        //if validation fails, we'll exit the operation now.
		        if ($validator->fails())
		        {
		        	Notification::error('Check form for errors');
			        //oops.. something went wrong
			        return Redirect::back()->withInput()->withErrors($validator);
		        }

		        $code_snippet = Snippet::find($snippet_data->id);

                //update snippet data
		        $code_snippet->title           = e(Input::get('title')); //e() sanitizes input, best way in laravel apparently..
		        $code_snippet->description     = e(Input::get('description'));
		        $code_snippet->code_snippet    = e(Input::get('code_snippet'));
        
                 //remove the spaces from tags 
                $spaced_tags = str_replace(' ', '', Input::get('hidden-tags'));
		        $code_snippet->tags            = e($spaced_tags);


		        $code_snippet->user_id         = Sentry::getId();


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
		        	Notification::success("Snippet updated!");
			        //redirect to my snippets
			        return Redirect::route('view-snippet', $snippet_data->slug);
		        }

		        //redirect to add-snippet page..
		        return Redirect::back();


            }

	}

    /**
     *  Delete Snippet.
     *
     * @return Redirect
     */

	public function getDeleteSnippet($slug)
	{

        $snippet_data = Snippet::where('slug', $slug)->first();

		//check if the snippet exists
		if (is_null($snippet_data))
		{
			Notification::success("Snippet doesnt exist.");
			return Redirect::back();
		}
	    else 
	    {
	    	
	    	if($snippet_data->user_id != Sentry::getUser()->id)
	    	{
	    		Notification::error("You're not allowed to do that.");
	    		return Redirect::back();
	    	}
	    	else 
		    {

                //delete the snippet
		        $snippet_data->delete();

		        //delete comments, favorites and votes
		        DB::table('snippets_comment')->where('snippet_id', $snippet_data->id)->delete();
		        DB::table('snippets_favorite')->where('snippet_id', $snippet_data->id)->delete();
		        DB::table('snippets_rating')->where('snippet_id', $snippet_data->id)->delete();

		        Notification::success("Snippet deleted!");

		        
		        return Redirect::route('code-snippets');

	        }
	    }
	   

	}

}