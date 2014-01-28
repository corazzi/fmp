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
        $user_id = User::where('slug', $slug)->pluck('id');

        $code_snippets = Snippet::where('user_id', '=', $user_id)
                                     ->where('state', '=', 'public')
                                     ->orderBy('id', 'DESC')
                                     ->paginate('15');

        return View::make('dash.snippets.public', compact('code_snippets'));

    }

}