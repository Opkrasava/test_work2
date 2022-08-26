<?php

namespace app\mvc\model;

use app\Model as Model;

class TokenModel extends Model {

    static $table_name = 'tokens';

    const expired_time = 7200;

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserIdFromToken($token) {
        return $this->db->query("SELECT user_id FROM ".self::$table_name." WHERE token = '".$token."'")->fetch()['user_id'];
    }

    public function checkToken($token) {
        $token = $this->db->query("SELECT * FROM ".self::$table_name." WHERE token = '".$token."'")->fetch();
        if (!$this->checkExpired($token['expired_date'])) {
            return false;
        }
        return $token;
    }

    public function createToken($user_id) {
        $token = $this->createHashToken();
        $expired_date = date("Y-m-d H:i:s", time()+self::expired_time);
        $sql = "INSERT INTO ".self::$table_name." (user_id, token, expired_date) VALUES ('.$user_id.', '".$token."', '".$expired_date."')";
        $query = $this->db->prepare($sql);
        $query->bindValue(":user_id", $user_id);
        $query->bindValue(":token", $token);
        $query->execute();
        return [
            'token' => $token,
            'expired_date' => $expired_date
        ];
    }

    public function createHashToken() {
        $token = md5(mt_rand(100000,9999999));
        return $token;
    }

    public function checkExpired($expired_date) {
        return ($expired_date > date("Y-m-d H:i:s"));
    }
}
