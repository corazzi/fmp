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
        return View::make('dash.resources.resources_home');
    }

}