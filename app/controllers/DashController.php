<?php

class DashController extends BaseController {

    public function __construct() 
    {
    	parent::__construct();
        $this->beforeFilter('auth');
    }


	public function index()
	{
        $grava = $this->get_gravatar();
        
		return View::make('dash.home', compact('grava'));
	}

}