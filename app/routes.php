<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

# Home!
Route::get('/',  array('as' => 'beta', 'uses' => 'HomeController@getBeta'));
Route::post('/',  'HomeController@postBeta');


Route::get('/home', array('as' => 'home', 'uses' => 'HomeController@index'));

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

Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'DashController@index'));


# Private Functions

Route::group(array('prefix' => 'private'), function()
{

    /*
    |--------------------------------------------------------------------------
    | Private Snippet Routes
    |--------------------------------------------------------------------------
    */

    # My Snippets
    Route::get('my-snippets', array('as' => 'my-snippets', 'uses' => 'SnippetController@getMySnippet'));

    # View My Snippet
    Route::get('my-snippets/{slug}', array('as' => 'view-private-snippet', 'uses' => 'SnippetController@getViewSnippet'));

    # Add Snippet
    Route::get('add-snippet', array('as' => 'add-snippet', 'uses' => 'SnippetController@getAddSnippet'));
    Route::post('add-snippet', 'SnippetController@postAddSnippet');

    # Delete Snippet
    Route::get('{snippetId}/delete', array('as' => 'delete-snippet', 'uses' => 'SnippetController@getDeleteSnippet'));

    # Edit Snippet
    Route::get('{snippetId}/edit', array('as' => 'edit-snippet', 'uses' => 'SnippetController@getEditSnippet'));
    Route::post('{snippetId}/edit', 'SnippetController@postEditSnippet'); 

    // Route::get('my-snippets/{id?}/{slug?}', array('as' => 'view', 'uses' => 'SnippetController@getViewSnippet'));

});


Route::group(array('prefix' => 'snippets'), function()
{ 
    # Public Snippets
    Route::get('/', array('as' => 'public-snippets', 'uses' => 'SnippetController@getPublicSnippet'));

    # View Public Snippet
    Route::get('{slug}', array('as' => 'view-public-snippet', 'uses' => 'SnippetController@getViewPublicSnippet'));

    // works but im going to handle it differently
    // Route::get('users/{slug}', array('as' => 'user-snippets', 'uses' => 'UserController@getUserSnippets'));

});


# Forgot Password
Route::get('me', array('as' => 'my-profile', 'uses' => 'ProfileController@getMyProfile'));

