<?php

use DB;
use HGM_API\Controllers\MainController;
use User;

class Auth {

    public static function checkToken() {

        $token = $_GET['access_token'];

        if (!$token) {
            Response::Error(401, 'Access token need');
        }

        $user_id = DB::getUserId($token);
        $userData = DB::query("select * from users where user_id = '$user_id'");
        if ($userData) {
            MainController::setUser(new User($userData[0]));
        }

        if (!$user_id) {
            Response::Error(401, 'Access token is invalid');
        }
    }

}
