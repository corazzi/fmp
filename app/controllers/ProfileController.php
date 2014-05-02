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
        return View::make('dash.profile.home');
    }

    public function getMyContent()
    {

        return View::make('dash.profile.my_content');

    }

    public function getEditProfile()
    {
        return View::make('dash.profile.edit_profile');
    }

}