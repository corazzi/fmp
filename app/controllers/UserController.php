<?php 

class UserController extends BaseController {

    public function __construct() 
    {
    	parent::__construct();
        $this->beforeFilter('auth');

    }


	public function index()
	{
		
	}

    public function getUserSnippets($slug)
    {
        $code_snippets = User::where('slug', $slug);

        return View::make('dash.snippets.public', compact('code_snippets'))

    }

}