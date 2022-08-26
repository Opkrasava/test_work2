<?php

namespace app\mvc\model;

use app\Model as Model;

class UserModel extends Model {

    static $table_name = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserFromLoginAndPassword($login, $password) {
        return $this->db->query("SELECT * FROM ".self::$table_name." WHERE login='".$login."' AND password='".$password."'")->fetch();
    }
}
