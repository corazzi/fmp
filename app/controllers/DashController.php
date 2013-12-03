<?php

class DashController extends BaseController {

    public function __construct() 
    {
    	parent::__construct();
        $this->beforeFilter('auth');
        $this->data['user'] = Sentry::getUser();
    }


	public function index()
	{
		return View::make('dash.home', $this->data);
	}

}