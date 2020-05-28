<?php

/**
 * Description of User
 *
 * @author HemulGM
 */
class User {

    public $id;
    public $name;
    public $login;

    public function __construct(array $userData = null) {
        if ($userData) {
            self::setUser($userData);
        }
    }
    
    public function load($user_id): bool {
        $userData = DB::query("select * from users where user_id = '$user_id'");
        
        if (is_array($userData)) {
            
            self::setUser($userData);
            return True;
        }
        
        return False;
    }

    public function setUser(array $userData) {
        $this->id = $userData['user_id'];
        $this->name = $userData['user_name'];
        $this->login = $userData['user_login'];
    }

}
