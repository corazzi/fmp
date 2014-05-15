<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

# Home!
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

# Beta
Route::get('/beta',  array('as' => 'beta', 'uses' => 'HomeController@getBeta'));
Route::post('/beta',  'HomeController@postBeta');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

# Login
Route::get('login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));
Route::post('login', 'AuthController@postLogin');

Route::post('newsletter', array('as' => 'newsletter', 'uses' => 'HomeController@postNewsletter'));

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

Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'DashboardController@index'));

Route::group(array('prefix' => 'snippets'), function()
{ 
    # Code Snippets
    Route::get('/', array('as' => 'code-snippets', 'uses' => 'SnippetController@getSnippets'));

    # Add Snippet
    Route::get('add', array('as' => 'add-snippet', 'uses' => 'SnippetController@getAddSnippet'));
    Route::post('add', 'SnippetController@postAddSnippet');

    # View Snippet
    Route::get('{slug}', array('as' => 'view-snippet', 'uses' => 'SnippetController@getViewSnippet'));

    # Edit Snippet (if owner)
    Route::get('{slug}/edit', array('as' => 'edit-snippet', 'uses' => 'SnippetController@getEditSnippet'));
    Route::post('{slug}/edit', array('as' => 'edit-snippet-post', 'uses' => 'SnippetController@postEditSnippet')); 

    # Delete Snippet (if owner)
    Route::get('{slug}/delete', array('as' => 'delete-snippet', 'uses' => 'SnippetController@getDeleteSnippet'));

    # Favorite a Snippet
    Route::post('{slug}/favorite', array('as' => 'favorite-snippet', 'uses' => 'SnippetController@postFavoriteSnippet' ));
    Route::post('{slug}/unfavorite', array('as' => 'un-favorite-snippet', 'uses' => 'SnippetController@postUnFavoriteSnippet' ));

    # Snippet Voting
    Route::post('{slug}/yay', array('as' => 'yay-snippet', 'uses' => 'SnippetController@postGoodVote'));
    Route::post('{slug}/nay', array('as' => 'nay-snippet', 'uses' => 'SnippetController@postBadVote' ));

    # Snippet Comments
    Route::post('{slug}/comment', array('as' => 'comment-snippet', 'uses' => 'SnippetController@postSnippetComment'));
    Route::post('{slug}/uncomment/{id}', array('as' => 'uncomment-snippet', 'uses' => 'SnippetController@postDeleteSnippetComment' ));

    # Snippet Tag Search
    Route::get('tags/{tag}', array('as' => 'view-tags-snippets', 'uses' => 'SnippetController@getTagSnippets'));

});

Route::group(array('prefix' => 'guides'), function()
{ 

    # Guides Home
    Route::get('/', array('as' => 'user-guides', 'uses' => 'GuidesController@getGuides'));

    # Add Guide
    Route::get('add', array('as' => 'add-guide', 'uses' => 'GuidesController@getAddGuide'));
    Route::post('add', 'GuidesController@postAddGuide');

    # View Guide
    Route::get('{slug}', array('as' => 'view-guide', 'uses' => 'GuidesController@getViewGuide'));

    # Guide Tag Search
    Route::get('tags/{tag}', array('as' => 'view-tags-guides', 'uses' => 'GuidesController@getTagGuides'));

    # Favorite a Guide
    Route::post('{slug}/favorite', array('as' => 'favorite-guide', 'uses' => 'GuidesController@postFavoriteGuide' ));
    Route::post('{slug}/unfavorite', array('as' => 'un-favorite-guide', 'uses' => 'GuidesController@postUnFavoriteGuide' ));

    # Guide Voting
    Route::post('{slug}/yay', array('as' => 'yay-guide', 'uses' => 'GuidesController@postGoodVote'));
    Route::post('{slug}/nay', array('as' => 'nay-guide', 'uses' => 'GuidesController@postBadVote' ));

    # Guide Comments
    Route::post('{slug}/comment', array('as' => 'comment-guide', 'uses' => 'GuidesController@postGuideComment'));
    Route::post('{slug}/uncomment/{id}', array('as' => 'uncomment-guide', 'uses' => 'GuidesController@postDeleteGuideComment' ));

    # Delete Guide (if owner)
    Route::get('{slug}/delete', array('as' => 'delete-guide', 'uses' => 'GuidesController@getDeleteGuide'));

    # Edit Guide (if owner)
    Route::get('{slug}/edit', array('as' => 'edit-guide', 'uses' => 'GuidesController@getEditGuide'));
    Route::post('{slug}/edit', array('as' => 'edit-guide-post', 'uses' => 'GuidesController@postEditGuide')); 

});

Route::group(array('prefix' => 'news'), function()
{ 
    # News Home
    Route::get('/', array('as' => 'news-home', 'uses' => 'NewsController@getNews'));

    # Add News
    Route::post('/add', array('as' => 'add-news', 'uses' => 'NewsController@postNews'));

    # Delete News (if owner)
    Route::get('{slug}/delete', array('as' => 'delete-news', 'uses' => 'NewsController@postDeleteNews'));

});

Route::group(array('prefix' => 'resources'), function()
{ 
    # Resources Home
    Route::get('/', array('as' => 'resources-home', 'uses' => 'ResourcesController@getResources'));

});


Route::group(array('prefix' => 'me'), function()
{ 
    # Me Home
    Route::get('/', array('as' => 'me-home', 'uses' => 'ProfileController@getMyProfile'));

    # My Content
    Route::get('/content', array('as' => 'my-content', 'uses' => 'ProfileController@getMyContent'));

    # Edit Profile
    Route::get('/edit', array('as' => 'edit-profile', 'uses' => 'ProfileController@getEditProfile'));

});

