<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('before' => 'loggedIntoGoogle', 'as' => 'index', function() {
    return View::make('index');
}));

Route::get('/login', array('as' => 'login', 'uses' => 'LoginController@loginWithGoogle'));

Route::get('/logout', function() {
    if (Session::has('token')) {
        Session::forget('token');
    }

    $googleService = OAuth::consumer('Google');
    $url = $googleService->getAuthorizationUri();

    return View::make('login')->withMsg('You have successfully been logged out.')->withLink($url);
});

Route::get('/images', 'ImageController@all');

Route::get('/images/{page}', 'ImageController@getPage');

Route::post('/upload', 'ImageController@upload');
