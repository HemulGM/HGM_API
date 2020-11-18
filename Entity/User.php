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

    public function __construct(array $data = null) {
        if ($data) {
            self::setUser($data);
        }
    }
    
    public function load($id): bool {
        $data = DB::query("select * from users where user_id = '$id'");
        
        if (is_array($data)) {
            
            self::setUser($data);
            return True;
        }
        
        return False;
    }

    public function setUser(array $data) {
        $this->id = $data['user_id'];
        $this->name = $data['user_name'];
        $this->login = $data['user_login'];
    }

}
