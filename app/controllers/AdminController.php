<?php

class AdminController extends BaseController {

    public function __construct() 
    {
    	parent::__construct();
        $this->beforeFilter('admin-auth');
    }

    public function Index()
    {
        return View::make('admin.home');
    }

    public function getSnippets()
    {

        $search_term = Request::get('search');
        
        if($search_term)
        {

            $all_snippets = Snippet::where('title', 'LIKE', "%$search_term%")
                                        ->orWhere('description', 'LIKE', "%$search_term%")
                                        ->orderBy('id', 'DESC') 
                                        ->paginate(12);

    

            //return view with results
            return View::make('admin.features.snippets.snippets_home', compact('all_snippets'));

        } 

        $all_snippets = Snippet::orderBy('id', 'DESC')->paginate(12);

    	return View::make('admin.features.snippets.snippets_home', compact('all_snippets'));

    }


    public function getEditSnippet($slug)
    {
        $snippet_data = Snippet::where('slug', $slug)->first();

        if (is_null($snippet_data))
        {

            Notification::error("Snippet not found!");
            return Redirect::back();
        }
        else 
        {
            //do the fiddly tag stuff
            $tags_string = $snippet_data->tags;
            $tag_array = explode(",", $tags_string);
            $string = "'" . implode("','", $tag_array) . "'";

            return View::make('admin.features.snippets.snippets_edit', compact('snippet_data', 'string'));
        }

    }

    public function postEditSnippet($slug)
    {

        $snippet_data = Snippet::where('slug', $slug)->first();
 
        //declare the rules for the form validation
        $rules = array(
            'title'               => 'required|min:4|max:80',
            'description'         => 'required|min:10',
            'code_snippet'        => 'required|min:10',
            'state'               => 'required',
            'hidden-tags'         => 'required'
        );


        $validator = Validator::make(Input::all(), $rules);


        if ($validator->fails())
        {
            Notification::error('Check form for errors');
            //oops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $code_snippet = Snippet::find($snippet_data->id);


        $code_snippet->title           = e(Input::get('title')); //e() sanitizes input, best way in laravel apparently..
        $code_snippet->description     = e(Input::get('description'));
        $code_snippet->code_snippet    = e(Input::get('code_snippet'));
        

        $spaced_tags = str_replace(' ', '', Input::get('hidden-tags'));
        $code_snippet->tags            = e($spaced_tags);


        if(Input::get('state'))
        {
            if(Input::get('state') == 'public' || Input::get('state') == 'private')
            {   
                $code_snippet->state = e(Input::get('state'));  
            } 
            else 
            {
                $code_snippet->state = 'public';
            }
        
        } 
        else 
        { 
            $code_snippet->state = 'public';
        }


        if($code_snippet->save())
        {
            Notification::success("Snippet updated!");
            return Redirect::route('admin-snippets');
        }

        return Redirect::route('admin-snippets');

    }

    public function getDeleteSnippet($slug)
    {   
        $snippet_data = Snippet::where('slug', $slug)->first();

        $snippet_data->delete();

        DB::table('snippets_comment')->where('snippet_id', $snippet_data->id)->delete();
        DB::table('snippets_favorite')->where('snippet_id', $snippet_data->id)->delete();
        DB::table('snippets_rating')->where('snippet_id', $snippet_data->id)->delete();

        Notification::success("Snippet deleted!");
      
        return Redirect::back();
    }

    public function getGuides()
    {

        $search_term = Request::get('search');

        if($search_term)
        {
            $user_guides = guide::where('title', 'LIKE', "%$search_term%")
                                    ->orWhere('content', 'LIKE', "%$search_term%")
                                    ->orderBy('id', 'DESC') 
                                    ->paginate(12);

            return View::make('admin.features.guides.guides_home', compact('user_guides'));

        }

        $user_guides = Guide::orderBy('id', 'DESC')->paginate(12);

        return View::make('admin.features.guides.guides_home', compact('user_guides'));
    }

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

            //do the fiddly tag stuff
            $tags_string = $guide_data->tags;
            $tag_array = explode(",", $tags_string);
            $string = "'" . implode("','", $tag_array) . "'";

            return View::make('admin.features.guides.guides_edit', compact('guide_data', 'string'));
  
        }
     
    }

    public function postEditGuide($slug)
    {

        $guide_data = Guide::where('slug', $slug)->first();

        $rules = array(
            'title'  => 'required|min:5',
            'hidden-tags' => 'required',
            'content' => 'required|min:30'
        );

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
            return Redirect::route('admin-guides');
        }

        return Redirect::route('admin-guides');

    }

    public function getDeleteGuide($slug)
    {
        $guide_data = Guide::where('slug', $slug)->first();

        if (is_null($guide_data))
        {
            Notification::success("Guide doesnt exist.");
            return Redirect::back();
        }
        else 
        {
            
            $guide_data->delete();

            DB::table('guides_comment')->where('guide_id', $guide_data->id)->delete();
            DB::table('guides_favorite')->where('guide_id', $guide_data->id)->delete();
            DB::table('guides_rating')->where('guide_id', $guide_data->id)->delete();

            Notification::success("Guide Deleted!");
            return Redirect::back();
        }
    }

    public function getNews()
    {
        $all_news = News::orderBy('id', 'DESC')->paginate(20);

    	return View::make('admin.features.news.news_home', compact('all_news'));
    }

    public function getDeleteNews($id)
    {
        $news_data = News::where('id', $id)->first();

        $news_data->delete();

        Notification::success("News deleted!");
      
        return Redirect::back();
    }

    public function getResources()
    {
        $all_resources = Resource::where('activated', '0')->orderBy('id', 'DESC')->paginate(12);

    	return View::make('admin.features.resources.resources_home', compact('all_resources'));
    }

    public function getActivatedResources()
    {
        $all_resources = Resource::where('activated', '1')->orderBy('id', 'DESC')->paginate(12);

        return View::make('admin.features.resources.resources_activated', compact('all_resources'));
    }


    public function getDeleteResource($id)
    {
        $resource = Resource::where('id', $id)->first();

        $resource->delete();

        Notification::success("Resource deleted!");
      
        return Redirect::back();
    }

    public function getActivateResource($id)
    {
        $resources = Resource::where('id', $id)->first();

        $resource = Resource::find($resources->id);

        $resource->activated  = '1'; 

        if($resource->save())
        {
            Notification::success("Resource Activated!");
            return Redirect::route('admin-activated-resources');
        }

        return Redirect::route('admin-activated-resources');
    }
    

    public function getDeactivateResource($id)
    {
        $resources = Resource::where('id', $id)->first();

        $resource = Resource::find($resources->id);

        $resource->activated  = '0'; 

        if($resource->save())
        {
            Notification::success("Resource Deactivated!");
            return Redirect::route('admin-resources');
        }

        return Redirect::route('admin-resources');
    }


    public function getUsers()
    {

        $search_term = Request::get('search');
        
        if($search_term)
        {

            $all_users = Sentry::getUserProvider()
                                        ->createModel()
                                        ->where('username', 'LIKE', "%$search_term%")
                                        ->orderBy('id', 'DESC')
                                        ->paginate(12);

    

            return View::make('admin.features.users.users_home', compact('all_users'));

        } 

        $all_users = Sentry::getUserProvider()->createModel()->paginate(12);

        return View::make('admin.features.users.users_home', compact('all_users'));
    }


}