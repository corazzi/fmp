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
	
}