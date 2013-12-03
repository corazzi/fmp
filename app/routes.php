<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

# Home!
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

# Login
Route::get('login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));
Route::post('login', 'AuthController@postLogin');

# Register
Route::get('register', array('as' => 'register', 'uses' => 'AuthController@getRegister'));
Route::post('register', 'AuthController@postRegister');

# Account Activation
Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

# Forgot Password
Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
Route::post('forgot-password', 'AuthController@postForgotPassword');

# Forgot Password Confirmation
Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

# Logout
Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => 'dashboard'), function()
{
    # User Dashboard
    Route::get('/', array('as' => 'dashboard', 'uses' => 'DashController@index'));


    # Snippets
    Route::group(array('prefix' => 'snippets'), function()
    { 
        # My Snippets
        Route::get('/', array('as' => 'snippets', 'uses' => 'SnippetController@getMySnippet'));
        
        # Add Snippet
        Route::get('add-snippet', array('as' => '/snippets/add-snippet', 'uses' => 'SnippetController@getAddSnippet'));
        Route::post('add-snippet', 'SnippetController@postAddSnippet');

        

    });

});

Route::get('/test',function() {
 $users = DB::table('snippets')->where('user_id', '=',  '2')->count();
 echo $users;
 });



