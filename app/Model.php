<?php

namespace app;

use app\Core as Core;
use PDO;

class Model {

    public $db = null;

    public function __construct()
    {
        $this->db = $this->getPDO();
    }

    public function getPDO() {
        $env = Core::getEnv()['DATABASE']['MYSQL'];
        $db = new PDO('mysql:host='.$env['host'].';dbname='.$env['db'], $env['user'], $env['password']);
        return $db;
    }
}
