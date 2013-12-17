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
        $this->data['code_snippets'] = Snippet::where('user_id', '=',  $this->data['user']->id)->orderBy('id', 'ASC')->paginate(10);
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

        //stop script kiddies editing the source on the front-end 
        //this stops edited values being submitted 
        if(Input::get('state'))
        {
		    if(Input::get('state') == 'public' || Input::get('state') == 'private')
		    {
			    //if the value is private/public lets store it   
			    $code_snippets->state = e(Input::get('state'));  
			} else {
				//if value has been tampered with submit default
				$code_snippets->state = 'public';
			}
	    
	    } else { 
            
            //if the radio button has been unchecked
            //submit default
			$code_snippets->state = 'public';
		}

		// Was the snippet saved?
		if($code_snippets->save())
		{
			// Redirect to my snippets
			return Redirect::to("dashboard/snippets")->with('success', Lang::get('features/snippets.create.success'));
		}

		// Redirect to add-snippet page..
		return Redirect::to('dashboard/snippets/add')->with('error', Lang::get('features/snippets.create.error'));

	}

	public function getDeleteSnippet($snippetId)
	{


		//check if the snippet exists
		if (is_null($snippet = Snippet::find($snippetId)))
		{
			//redirect to my snippets with not found error
			return Redirect::to('dashboard/snippets')->with('error', Lang::get('features/snippets.not_found.error'));
		}

        //get the user_id of the snippet
		$snippet_user = Snippet::where('id', $snippetId)->pluck('user_id');

		//check if user owns the snippet
		if (Sentry::getUser()->id != $snippet_user) 
		{
            //redirect with bad message, bad kids
			return Redirect::to('dashboard/snippets')->with('error', Lang::get('features/snippets.delete_check.error'));	
		} 
		else 
		{

            //delete the snippet
		    $snippet->delete();

		    //redirect to my snippets page with success message
		    return Redirect::to('dashboard/snippets')->with('success', Lang::get('features/snippets.delete.success'));

	    }

	}
}