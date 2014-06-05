<?php

class ProfileController extends BaseController {

    public function __construct()
    {
        parent::__construct();

        //check if the user is logged in
        $this->beforeFilter('auth');        
    }

    public function getMyProfile()
    {
        return View::make('dash.profile.profile_home');
    }

    public function getMyContent()
    {




        //get favorited snippets
        $snippet_ids = DB::table('snippets_favorite')->where('user_id', Sentry::getUser()->id)->lists('snippet_id');

        if(count($snippet_ids) > 0)
        {
            $fav_snippets = Snippet::where('user_id', Sentry::getUser()->id)->orderBy('id', 'DESC')->whereIn('id', array("19"))->get();

        }

        //get favorited guides
        $guide_ids = DB::table('guides_favorite')->where('user_id', Sentry::getUser()->id)->lists('guide_id');

        if(count($guide_ids) > 0)
        {
            $fav_guides = Guide::where('user_id', Sentry::getUser()->id)->whereIn('id', $guide_ids)->orderBy('id', 'DESC')->get();
        }
        
        //get snippets and guides
        $all_snippets = Snippet::where('user_id', Sentry::getUser()->id)->orderBy('id', 'DESC')->get();
        $all_guides = Guide::where('user_id', Sentry::getUser()->id)->orderBy('id', 'DESC')->get();
        $all_resources = Resource::where('user_id', Sentry::getUser()->id)->orderBy('id', 'DESC')->get();

        return View::make('dash.profile.profile_my_content', compact('fav_snippets', 'fav_guides', 'all_snippets', 'all_guides', 'all_resources'));


    }

    public function getEditProfile()
    {
        $user = Sentry::getUser();

        return View::make('dash.profile.profile_edit', compact('user'));
    }

    public function postEditProfile()
    {

        // Grab the user
        $user = Sentry::getUser();

        // Update the user information
        $user->location        = Input::get('location');
        $user->twitter_handle  = Input::get('twitter_handle');
        $user->about_me        = Input::get('about_me');
        $user->website         = Input::get('website');
        $user->preference      = Input::get('preference');
        
        if($user->save())
        {
            Notification::success('Profile updated!');
            return Redirect::route('edit-profile');
        }
        else 
        {
            Notification::error('There was an problem, try again.');
            return Redirect::route('edit-profile');
        }

    }

    public function getChangePassword()
    {
        return View::make('dash.profile.profile_change_password');
    }

    public function postChangePassword()
    {

        //declare the rules for the form validation
        $rules = array(
            'old_password'     => 'required|between:3,32',
            'password'         => 'required|between:3,32',
            'password_confirm' => 'required|same:password',
        );


        //create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        //if validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            //something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        //grab the user
        $user = Sentry::getUser();

        //check the user current password
        if ( ! $user->checkPassword(Input::get('old_password')))
        {
            //set the error message
            $this->messageBag->add('old_password', 'Your current password is incorrect.');

            //redirect to the change password page
            return Redirect::route('change-password')->withErrors($this->messageBag);
        }

        //update the user password
        $user->password = Input::get('password');
        $user->save();

        //redirect to the change-password page
        Notification::success('Password updated');
        return Redirect::route('change-password');

    }


    public function postAvatar()
    {
        //declare the rules for the form validation
        $rules = array(
            'avatar'     => 'required',
        );

        //create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        //if validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            //something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $file = Input::file('avatar');

        $destinationPath    = 'uploads/avatar/'; // The destination were you store the image.
        $filename           = $file->getClientOriginalName(); // Original file name that the end user used for it.
        $upload_success     = $file->move($destinationPath, $filename);
        
        //image manipulation
        $tester = Image::make($destinationPath.$filename);
        $tester->fit(80, 80);
        $tester->save($destinationPath.$filename);
        
        //save it
        $user = Sentry::getUser();
        $user->avatar = $filename;
        $user->save();

        Notification::success('Avatar Changed!');
        return Redirect::back();
        
    }

    public function postDeleteAvatar()
    {

        // Grab the user
        $user = Sentry::getUser();
        $user->avatar = NULL;
        $user->save();
        
        //delete the file 
        File::delete(public_path()."/uploads/avatar/".$user->avatar);


        Notification::success('Avatar Deleted');
        return Redirect::back();

    }

}