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

Route::get('/main', array('before' => 'loggedIntoGoogle', 'as' => 'home', function() {

}));

Route::get('/', array('as' => 'login', function() {
    // get data from input
    $code = Input::get( 'code' );

    // get google service
    $googleService = OAuth::consumer( 'Google' );

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $code ) ) {

        // This was a callback request from google, get the token
        $token = $googleService->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
        if (strpos($result['email'], $_ENV['DOMAIN']) === false) {
            return Redirect::to('/');
        }
        return View::make('index');
    }
    // if not ask for permission first
    else {
        // get googleService authorization
        $url = $googleService->getAuthorizationUri();

        // return to google login url
        return View::make('login')->withLink($url);
    }

}));

Route::get('/logout', function() {
    $googleService = OAuth::consumer( 'Google' );
    $googleService->revokeToken();

});

Route::get('/images', 'ImageController@all');

Route::get('/images/{page}', 'ImageController@getPage');

Route::post('/upload', 'ImageController@upload');
