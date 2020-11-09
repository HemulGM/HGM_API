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
        return static::fetch(mysqli_query(static::$con, $query));
    }

    public static function fetch($stmt) {
        $rows = []; 
        while($row = $stmt->fetch_array())
        {
            $rows[] = $row;
        }
        return $rows;
    }

}
