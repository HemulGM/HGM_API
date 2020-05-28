<?php

namespace HGM_API\Controllers;

use User;
use Response;
use ReponseItems;

class UsersController {

    /**
     * List
     */
    public static function list() {

        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            $user = new User();
            if ($user->load($user_id)) {
                Response::Ok($user);
            } else {
                Response::Error(302, 'Item not found');
            }
        } else {
            $user = new User();
            $user->id = 123;
            $list = new ReponseItems(array($user, $user));

            Response::Ok($list);
        }
    }

}
