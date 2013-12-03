<?php



class SnippetController extends BaseController {


	public function __construct()
	{
		parent::__construct();
        $this->beforeFilter('auth');
        $this->data['user'] = Sentry::getUser();
	}

	public function getMySnippet()
	{
        $this->data['code_snippets'] = Snippet::where('user_id', '=',  $this->data['user']->id)->orderBy('id', 'ASC')->get();
		return View::make('dash.snippets.mysnippets', $this->data);
	}

	public function getAddSnippet()
	{
		return View::make('dash.snippets.addsnippet', $this->data);
	}

	public function postAddSnippet()
	{

		// Declare the rules for the form validation
		$rules = array(
			'title'               => 'required|min:3',
			'description'         => 'required|min:10',
			'code_snippet'        => 'required',
			'tags'                => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

        // create new snippet - elequent you beuty
		$code_snippets = new Snippet();

        // update snippet data
		$code_snippets->title           = e(Input::get('title')); //e() sanitizes input, best way in laravel apparently..
		$code_snippets->description     = e(Input::get('description'));
		$code_snippets->code_snippet    = e(Input::get('code_snippet'));
		$code_snippets->tags            = e(Input::get('tags'));
		$code_snippets->user_id         = Sentry::getId();

/*
        $snippet_count = DB::table('snippets')->where('user_id', '=',  '1')->count();


        if ($snippet_count == 0) 
        {
        	$code_snippets->user_snippet_count   =   '1';

        } else {
            
            $code_snippets->user_snippet_count   =   $snippet_count+'1';
        }
*/

		// Was the snippet saved?
		if($code_snippets->save())
		{
			// Redirect to add snippet page for now
			return Redirect::to("dashboard/snippets/add-snippet")->with('success', Lang::get('features/message.create.success'));
		}

		// Redirect to add-snippet page..
		return Redirect::to('dashboard/snippets/add-snippet')->with('error', Lang::get('features/message.create.error'));

	}
}