<?php

class LoginController extends \BaseController {

    public function loginWithGoogle() {

        $code = Input::get('code');

        $googleService = OAuth::consumer('Google');

        $url = $googleService->getAuthorizationUri();

        if (Session::has('error')) {
            return View::make('login')->withError(Session::get('error'))->withLink($url);
        }

        if (!empty($code)) {

            try {
                $token = $googleService->requestAccessToken($code);
            } catch (Exception $e) {
                return Redirect::route('index');
            }
            $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

            if (isset($_ENV['DOMAIN']) && strpos($result['email'], $_ENV['DOMAIN']) === false) {
                $error = 'Sorry.  Your Google account does not belong to the proper domain.';

                return Redirect::route('login')->with('error', $error);
            } else {
                Session::put('token', $token);
                return Redirect::route('index');
            }

        } else {

            return View::make('login')->withLink($url);
        }
    }
}