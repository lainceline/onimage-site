<?php

class LoginController extends \BaseController {

    public function loginWithGoogle() {

        $code = Input::get('code');

        $googleService = OAuth::consumer('Google');

        if (!empty($code)) {
            $token = $googleService->requestAccessToken($code);

            $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

            if (isset($_ENV['DOMAIN']) && strpos($result['email'], $_ENV['DOMAIN']) === false) {
                $error = 'Sorry.  Your Google account does not belong to the proper domain.';
                return View::make('login')->withError($error);
            } else {
                Session::put('token', $token);
                return Redirect::route('index');
            }

        } else {

            $url = $googleService->getAuthorizationUri();

            return View::make('login')->withLink($url);
        }
    }
}