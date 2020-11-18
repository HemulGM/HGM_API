<?php

namespace HGM_API\Controllers;

use Response;
use DB;
use DateTime;
use DateInterval;
use User;

class AccessToken {

    public $access_token;

    public function __construct(string $token) {
        $this->access_token = $token;
    }

}

class MainController {

    private static $user;

    public static function getUser() {
        return static::$user;
    }

    public static function setUser($user) {
        static::$user = $user;
    }

    /**
     * Auth
     */
    public static function auth() {

        $login = $_GET['login'];
        $password = $_GET['password'];

        $userData = DB::query("SELECT user_id, user_name, user_login FROM `users` WHERE user_login = '$login' and user_password = '$password'")[0];

        if ($userData) {

            static::setUser(new User($userData));
            $access_token = hash("sha512", $login . date('DD.MM.YYYY-HH.MM.SS') . random_int(100000, 500000));
            $token_expired = date_format(date_add(new DateTime(), (new DateInterval('P1D'))), 'Y-m-d H:i:s');
            $id = static::$user->id;
            if (DB::query("INSERT INTO `tokens` (token_user_id, token_value, token_expired) VALUES ('$id', '$access_token', '$token_expired')")) {
                $token = new AccessToken($access_token);
                Response::Ok($token);
            } else {
                Response::Error(401, 'Invalid login and password (internal error)');
            }
        } else {
            Response::Error(401, 'Invalid login and password');
        }
    }

    /**
     * Second Action
     */
    public static function secondAction($var) {
        echo 'Hello from ' . __METHOD__ . '( "' . $var . '" )!';
    }

}
