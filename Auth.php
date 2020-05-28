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

        $tokens = DB::query("select * from tokens where token_value = '$token' and token_expired > CURRENT_TIMESTAMP");
        $user_id = $tokens['token_user_id'];
        $userData = DB::query("select * from users where user_id = '$user_id'");
        
        MainController::setUser(new User($userData));
        
        if (count($tokens) <= 0) {
            Response::Error(401, 'Access token is invalid');
        }
    }

}
