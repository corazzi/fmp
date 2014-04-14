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

}