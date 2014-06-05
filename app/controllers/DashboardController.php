<?php

class DashboardController extends BaseController {

    public function __construct() 
    {
    	parent::__construct();
        $this->beforeFilter('auth');
    }


	public function index()
	{

		$latest_snippet = Snippet::where('state', 'public')->orderBy('id', 'DESC')->take(1)->first();
		$latest_guide = Guide::orderBy('id', 'DESC')->take(5)->get();



        
		return View::make('dash.home', compact('latest_snippet', 'latest_guide'));
	}

}