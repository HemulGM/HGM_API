<?php

include_once 'config.php';

class DB {

    private static $con;

    private static function init() {
        static::$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno()) {
            echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
            die;
        }
        mysqli_set_charset(static::$con, DB_CHARSET);
    }

    public static function query($query) {
        if (!isset(static::$con)) {
            static::init();
        }    
        //var_dump($query);
        return static::fetch(mysqli_query(static::$con, $query));
    }

    public static function getUserId($token) {
        $tokens = DB::query("select * from tokens where token_value = '$token' and token_expired > CURRENT_TIMESTAMP")[0];
        //var_dump($tokens);
        return $tokens['token_user_id'];
    }

    public static function fetch($stmt) {
        if ($stmt) {
            if ($stmt === true) {
                return true;
            } else {
                $rows = [];
                while ($row = $stmt->fetch_array(MYSQLI_ASSOC)) {
                    $rows[] = $row;
                }
                return $rows;
            }
        } else {
            return [];
        }
    }

}
