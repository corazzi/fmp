<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{ 	
		//Check if user is logged in/ if so redirect
		if(Sentry::check()) 
		{
			return Redirect::route('dashboard');
		}

		return View::make('home');
	}

	public function getBeta()
	{
		return View::make('beta_page');
	}

	public function postBeta()
	{
		//declare the rules for the form validation
		$rules = array(
			'email'               => 'required|min:3'
		);

		//create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		//if validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			//oops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$beta_email = new Beta();

		$beta_email->email = e(Input::get('email')); //e() sanitizes input

	    if($beta_email->save())
		{
			//redirect back to the beta page
			return Redirect::route("beta")->with('success', 'Email submitted successfully');
		}

		//redirect to beta page for now
		return Redirect::route('beta')->with('error', 'Something went wrong please try again.');


	}

	public function postNewsletter()
	{
		$rules = array(
			'email' => 'required|min:3', 
		);

		$validator = Validator::make(Input::all(), $rules);


		$input = Input::all();//Get all the old input.
        $input['Success'] = 'true';//Add the auto open indicator flag as an input.

		if ($validator->fails()) 
		{
			// return Redirect::back()->withInput()->withErrors($validator);
			return Redirect::back()->withErrors($validator)->withInput($input);//Passing the old input and the flag.
		}

		$news_email = new Beta();
		$news_email->email = e(Input::get('email')); 

	    if($news_email->save())
		{
			//redirect back to the beta page
			return Redirect::route('home')->withInput($input);
		}

		//redirect to beta page for now
		return Redirect::route('home')->with('error', 'Something went wrong please try again.');
	}
	
}