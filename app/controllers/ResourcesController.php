<?php

class ResourcesController extends BaseController {

    public function __construct()
    {
        parent::__construct();

        //check if the user is logged in
        $this->beforeFilter('auth');        
    }

    public function getResources()
    {
        $all_resources = Resource::where('activated', '1')->orderBy('id', 'DESC')->paginate(12);
        return View::make('dash.resources.resources_home', compact('all_resources'));
    }

    public function getTagResources($tag)
    {
        $all_resources = Resource::where('tags', 'LIKE', "%$tag%")
                              ->orderBy('id', 'DESC')
                              ->paginate(10);


        return View::make('dash.resources.resources_tags', compact('all_resources', 'tag'));    
    }

    public function getAddResource()
    {

        //quick work around for the tags form validation with the tags manager JS library
        $tags_string = Input::old('hidden-tags');
        $tag_array = explode(",", $tags_string);
        $string = "'" . implode("','", $tag_array) . "'";

        return View::make('dash.resources.resources_add', compact('string'));

    }


    public function postAddResource()
    {

        $rules = array(
            'title' => 'required',
            'hidden-tags' => 'required',
            'description' => 'required',
            'link' => 'required'
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

            $resource = new Resource();
            
            $resource->title        = e(Input::get('title'));
            $resource->tags         = e($spaced_tags);
            $resource->link         = e(Input::get('link'));
            $resource->description  = e(Input::get('description'));
            $resource->user_id      = Sentry::getId();

            if($resource->save())
            {  
                Notification::success("Resource submitted to webrepo staff!");

                return Redirect::route('resources-home');
            }
            else
            {
                Notifcation::error("Something went wrong please try again.");

                return Redirect::route('add-resource');
            }
        }   

    }
}