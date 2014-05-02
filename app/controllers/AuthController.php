<?php

class AuthController extends BaseController {

    /**
     * Account sign in.
     *
     * @return View
     */

	public function getLogin()
	{ 
		//check if the user is already logged in
		if(Sentry::check()) 
		{
			return Redirect::route('dashboard');
		}
		
		// show the login page
        return View::make('auth.login');
	}

	public function postLogin()
    {
        
        // Declare the rules for the form validation
        $rules = array(
            'email'    => 'required|email',
            'password' => 'required|between:3,32',
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // $input = Input::all();//Get all the old input.
        // $input['autoOpenModal'] = 'true';//Add the auto open indicator flag as an input.



        // If validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            // Ooops.. something went wrong
            // return Redirect::back()->withErrors($validator)->withInput($input);//Passing the old input and the flag.
            return Redirect::to('login')->withInput()->withErrors($validator);

        }

        try
        {
            // Try to log the user in
            Sentry::authenticate(Input::only('email', 'password'), Input::get('remember-me', 0));

            // Get the page we were before
            $redirect = Session::get('loginRedirect', 'dashboard');

            // Unset the page we were before from the session
            Session::forget('loginRedirect');

            // Redirect to the users page
            return Redirect::to($redirect)->with('success', Lang::get('auth/message.signin.success'));

        }
               
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            $this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
        }
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            $this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            $this->messageBag->add('email', Lang::get('auth/message.account_banned'));
        }

        // Ooops.. something went wrong
        // return Redirect::back()->withInput($input)->withErrors($this->messageBag);
        return Redirect::to('login')->withInput()->withErrors($this->messageBag);
    }

    /**
     * Account sign up.
     *
     * @return View
     */

	public function getRegister()
	{

		//check if the user is already logged in
		if(Sentry::check()) 
		{
			return Redirect::route('dashboard');
		}

        //show page
		return View::make('auth.register');

	}

	public function postRegister()
	{

        // Declare the rules for the form validation
        $rules = array(
            'username'         => 'required|between:3,13',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|between:3,32',
            'password_confirm' => 'required|same:password'        
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            // Ooops.. something went wrong
            return Redirect::to('register')->withInput()->withErrors($validator);
        }

        try
        {
            // Register the user
            $user = Sentry::register(array(
                'username'   => Input::get('username'),
                'email'      => Input::get('email'),
                'password'   => Input::get('password'),
      
            ));

            // Find the standard user group 
            $userGroup = Sentry::findGroupById(2);
            // Assign the standard user group to the user
            $user->addGroup($userGroup);

            // Data to be used on the email view
            $data = array(
                'user'          => $user,
                'activationUrl' => URL::route('activate', $user->getActivationCode()),
            );

            // Send the activation code through email  
            Mail::send('emails.register-activate', $data, function($m) use ($user)
            {
                $m->to($user->email, $user->username);
                $m->subject('Welcome ' . $user->username);
            });

            // Redirect to the register page
            return Redirect::back()->with('success', Lang::get('auth/message.signup.success'));

        }
        
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::to('register')->withInput()->withErrors($this->messageBag);

	}

    public function getActivate($activationCode = null)
    {
    	
        // Is the user logged in?
        if (Sentry::check())
        {
            return Redirect::route('dashboard');
        }

        try
        {
            // Get the user we are trying to activate
            $user = Sentry::getUserProvider()->findByActivationCode($activationCode);

            // Try to activate this user account
            if ($user->attemptActivation($activationCode))
            {
                // Redirect to the login page
                return Redirect::route('login')->with('success', Lang::get('auth/message.activate.success'));
            }

            // The activation failed.
            $error = Lang::get('auth/message.activate.error');

        }
                
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $error = Lang::get('auth/message.activate.error');
        }

        // Ooops.. something went wrong
        return Redirect::route('signin')->with('error', $error);
            
    }

    /**
     * Forgot password form processing page.
     *
     * @return Redirect
     */

    public function getForgotPassword()
    {
    	//show the page
    	return View::make('auth.forgotten-password');
    }

    public function postForgotPassword()
    {
                
        // Declare the rules for the validator
        $rules = array(
            'email' => 'required|email',
        );

        // Create a new validator instance from our dynamic rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            // Ooops.. something went wrong
            return Redirect::route('forgot-password')->withInput()->withErrors($validator);
        }

        try
        {
            // Get the user password recovery code
            $user = Sentry::getUserProvider()->findByLogin(Input::get('email'));

            // Data to be used on the email view
            $data = array(
                'user'              => $user,
                'forgotPasswordUrl' => URL::route('forgot-password-confirm', $user->getResetPasswordCode()),
            );

            // Send the activation code through email
            Mail::send('emails.forgot-password', $data, function($m) use ($user)
            {
                $m->to($user->email, $user->username);
                $m->subject('Account Password Recovery');
            });
        }
                
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect::route('forgot-password')->with('error', Lang::get('No account exists with that email.'));
        }

        //  Redirect to the forgot password
        return Redirect::route('forgot-password')->with('success', Lang::get('auth/message.forgot-password.success'));

    }

    public function getForgotPasswordConfirm($passwordResetCode = null)
    {
        try
        {
            // Find the user using the password reset code
            $user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);
        }
        
        catch(Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
        }

        // Show the page
        return View::make('auth.forgot-password-confirm');
    }

    public function postForgotPasswordConfirm($passwordResetCode = null)
    {
        
        // Declare the rules for the form validation
        $rules = array(
            'password'         => 'required',
            'password_confirm' => 'required|same:password'
        );

        // Create a new validator instance from our dynamic rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            // Ooops.. something went wrong
            return Redirect::route('forgot-password-confirm', $passwordResetCode)->withInput()->withErrors($validator);
        }

        try
        {
            // Find the user using the password reset code
            $user = Sentry::getUserProvider()->findByResetPasswordCode($passwordResetCode);

            // Attempt to reset the user password
            if ($user->attemptResetPassword($passwordResetCode, Input::get('password')))
            {
                // Password successfully reseted
                return Redirect::route('login')->with('success', Lang::get('auth/message.forgot-password-confirm.success'));
            }
            else
            {
                // Ooops.. something went wrong
                return Redirect::route('login')->with('error', Lang::get('auth/message.forgot-password-confirm.error'));
            }
        }
        
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
        }

    }

    public function getLogout()
    {
    	//log the user out 
    	Sentry::logout();
        
        //redirect back to home page with success message
    	return Redirect::route('login')->with('success', 'You have successfully logged out!');

    }
}