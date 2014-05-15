<?php

use VTalbot\Markdown\Compilers\MarkdownCompiler;

class GuidesController extends BaseController {

    public function __construct() 
    {
    	parent::__construct();
        $this->beforeFilter('auth');
    }

   function RepoMarkdown($content)
   {

        $custom_blocks = array('[code]', '[/code]', '[b]','[/b]','[i]','[/i]'); //custom mark up
        $converted_html = array('<pre><code>', '</code></pre>', '<b>', '</b>', '<em>', '</em>'); //html 
        $guide_content = str_replace($custom_blocks, $converted_html, $content); // replace markup up with valid html

        return $guide_content; // return the converted string
   }

   function my_nl2br($conv_content){
        
        $conv_content = str_replace("\n", "<br />", $conv_content);
        
        if(preg_match_all('/\<pre\>(.*?)\<\/pre\>/', $conv_content, $match)){
            foreach($match as $a){
                foreach($a as $b){
                    $conv_content = str_replace('<pre>'.$b.'</pre>', "<pre>".str_replace("<br />", "", $b)."</pre>", $conv_content);
                }
            }
        }
        return $conv_content;
    }

    public function getGuides()
    {
        $search_term = Request::get('search');

        if($search_term)
        {
            $user_guides = guide::where('title', 'LIKE', "%$search_term%")
                                    ->orWhere('content', 'LIKE', "%$search_term%")
                                    ->orderBy('id', 'DESC') 
                                    ->paginate(10);

            return View::make('dash.guides.guides_search', compact('user_guides'));

        }

        $user_guides = Guide::orderBy('id', 'DESC')->paginate(6);



    	return View::make('dash.guides.guides_home', compact('user_guides'));
    }

    /**
     * Good Content Vote 
     *
     * @return Redirect 
     */


    public function postGoodVote($slug)
    { 
        //get snippet id from slug
        $guide_id = Guide::where('slug', $slug)->pluck('id');
 

        //get all ratings 
        $ratings = DB::table('guides_rating')
                   ->where('user_id', '=', Sentry::getUser()->id)
                   ->where('guide_id', '=', $guide_id)
                   ->get();


        // if empty this means they havnt rated anything 
        if (empty($ratings)) 
        {

            //lets carry on with the rating procedure 
            Sentry::getUser()->guide_ratings()->attach($guide_id, array('good' => '1'));
            
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
        $guide_id = Guide::where('slug', $slug)->pluck('id');

        $ratings = DB::table('guides_rating')
                   ->where('user_id', '=', Sentry::getUser()->id)
                   ->where('guide_id', '=', $guide_id)
                   ->get();
                   
        if(empty($ratings))
        {
            Sentry::getUser()->guide_ratings()->attach($guide_id, array('bad' => '1'));
            
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


    public function postGuideComment($slug)
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
            $guide_id = Guide::where('slug', $slug)->pluck('id');
            
            $comment = e(Input::get('comment'));

            Sentry::getUser()->guide_comments()->attach($guide_id, array('comment' => $comment));

            Notification::success("Comment submmited!");

            return Redirect::back();
        }
    }

    /**
     * Post Delete Snippet Comment
     *
     * @return Redirect 
     */


    public function postDeleteGuideComment($slug, $id)
    {
        //get the user_id of the comment
        $comment_user = DB::table('guides_comment')->where('id', $id)->pluck('user_id');

        //check if its the same as the user trying to delete it OR an admin
        if(Sentry::getUser()->id === $comment_user || Sentry::getUser()->hasAccess('admin'))
        {
            
            //if it is delete the comment
            DB::table('guides_comment')->where('id', $id)->delete();

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


    public function getTagGuides($tag) 
    {
        
        $user_guides = Guide::where('tags', 'LIKE', "%$tag%")
                              ->orderBy('id', 'DESC')
                              ->paginate(10);


        return View::make('dash.guides.guides_tags', compact('user_guides', 'tag'));
    }

    public function getViewGuide($slug)
    {
        //get guide data from slug
        $guide_data = Guide::where('slug', $slug)->first();

        // check if the guide exists
        if (is_null($guide_data))
        {

            Notification::error('That guide doesnt exist');

            return Redirect::route('user-guides');
        } 
        else 
        {
            //convert and format the content of the guide
            $content = $guide_data->content;
            $conv_content = $this->RepoMarkdown($content); //convert the custom markdown
            $guide_content = $this->my_nl2br($conv_content); //add br to line breaks but ignore <pre> tags

            //favorite stuff here
            $favorites = DB::table('guides_favorite')->whereUserId(Sentry::getUser()->id)->lists('guide_id');

            //voting stuff here
            $ratings = DB::table('guides_rating')->where('user_id', Sentry::getUser()->id)->where('guide_id', $guide_data->id)->get();
            $good_ratings = DB::table("guides_rating")->where('guide_id', $guide_data->id)->lists('good');

            //comments stuff here
            $comments = DB::table('guides_comment')->where('guide_id', $guide_data->id)->orderBy('id', 'DESC')->get();
        
            //guide user info 
            $user = Sentry::findUserById($guide_data->user_id);

            //guide tags
            $tags = explode(',', $guide_data->tags);

            //return the view with one of many goodies
            return View::make('dash.guides.guides_view', compact('guide_data', 'guide_content', 'user', 'favorites', 'good_ratings', 'ratings', 'comments', 'tags'));

        }   

    }

    /**
     * Favorite Guide.
     *
     * @return Redirect 
     */


    public function postFavoriteGuide($slug)
    { 
        //get snippet id from slug
        $guide_id = Guide::where('slug', $slug)->pluck('id');
        
        //relational magic 
        Sentry::getUser()->guide_favorites()->attach($guide_id);

        //toast notifciation 
        Notification::success('Guide Favorited!');

        return Redirect::back();

    }

    /**
     * unFavorite Guide.
     *
     * @return Redirect 
     */


    public function postUnFavoriteGuide($slug)
    { 
        //get snippet id from slug
        $guide_id = Guide::where('slug', $slug)->pluck('id');

        //relational magic detach favorite 
        Sentry::getUser()->guide_favorites()->detach($guide_id);
        
        //red toast notification
        Notification::error('Guide Unfavorited!');

        return Redirect::back();
    }

    public function getAddGuide()
    {
		//quick work around for the tags form validation with the tags manager JS library
		$tags_string = Input::old('hidden-tags');
        $tag_array = explode(",", $tags_string);
        $string = "'" . implode("','", $tag_array) . "'";

        return View::make('dash.guides.guides_add', compact('string'));
    }

    public function postAddGuide()
    {

        $rules = array(
            'title' => 'required|min:5',
            'hidden-tags' => 'required',
            'content' => 'required|min:30'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails())
        {
            Notification::error("Check the form for errors");


            return Redirect::back()->withInput()->withErrors($validator);
        }
        else 
        {
            //remove spaces from tags
            $spaced_tags = str_replace(' ', '', Input::get('hidden-tags'));

            $guide = new Guide();
            $guide->title    = e(Input::get('title'));
            $guide->tags     = e($spaced_tags);
            $guide->content  = e(Input::get('content'));
            $guide->user_id  = Sentry::getId();

            if($guide->save())
            {  
                Notification::success("Guide saved successfully!");

                return Redirect::route('user-guides');
            }
            else
            {
                Notifcation::error("Something went wrong please try again.");

                return Redirect::route('add-guide');
            }
        }



    }


 
    /**
     * Get Edit Guide.
     *
     * @return View
     */


    public function getEditGuide($slug)
    {
        
        $guide_data = Guide::where('slug', $slug)->first();

        if (is_null($guide_data))
        {
            //redirect with not found error
            Notification::error("Guide not found!");
            return Redirect::back();
        }
        else 
        {

            if($guide_data->user_id != Sentry::getUser()->id)
            {
                Notification::error("You're not allowed to do that");
                return Redirect::back();
            }
            else 
            {

                //do the fiddly tag stuff
                $tags_string = $guide_data->tags;
                $tag_array = explode(",", $tags_string);
                $string = "'" . implode("','", $tag_array) . "'";

                return View::make('dash.guides.guides_edit', compact('guide_data', 'string'));

            }
        }
    }   

    /**
     * Post Edit Guide.
     *
     * @return Redirect
     */

    public function postEditGuide($slug)
    {

        $guide_data = Guide::where('slug', $slug)->first();

        if($guide_data->user_id != Sentry::getUser()->id)
        {
            Notification::error("You're not allowed to do that.");
            return Redirect::back();
        }
        else
        {

            $rules = array(
                'title'  => 'required|min:5',
                'hidden-tags' => 'required',
                'content' => 'required|min:30'
            );

            //create a new validator instance from our validation rules
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails())
            {
                Notification::error('Check form for errors');
                //oops.. something went wrong
                return Redirect::back()->withInput()->withErrors($validator);
            }


            $user_guide = Guide::find($guide_data->id);

            $user_guide->title  = e(Input::get('title')); 
            $user_guide->tags   = e(Input::get('hidden-tags')); 
            $user_guide->content = e(Input::get('content'));

            //was the guide saved?
            if($user_guide->save())
            {
                Notification::success("Guide updated!");
                //redirect to my snippets
                return Redirect::route('user-guides');
            }

            return Redirect::route('edit-guide', $guide_data->slug);



                

        }


        

    }



    /**
     *  Delete Guide.
     *
     * @return Redirect
     */

    public function getDeleteGuide($slug)
    {

        $guide_data = Guide::where('slug', $slug)->first();

        //check if the snippet exists
        if (is_null($guide_data))
        {
            Notification::success("Guide doesnt exist.");
            return Redirect::back();
        }
        else 
        {
            
            if($guide_data->user_id != Sentry::getUser()->id)
            {
                Notification::error("You're not allowed to do that.");
                return Redirect::back();
            }
            else
            {

                //delete the snippet
                $guide_data->delete();

                //delete comments, favorites and votes
                DB::table('guides_comment')->where('guide_id', $guide_data->id)->delete();
                DB::table('guides_favorite')->where('guide_id', $guide_data->id)->delete();
                DB::table('guides_rating')->where('guide_id', $guide_data->id)->delete();

                Notification::success("Guide Deleted!");
                return Redirect::route('user-guides');

            }
        }
       

    }

}
