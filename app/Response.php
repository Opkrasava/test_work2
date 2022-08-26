<?php

namespace app;

use app\App as App;

class Response {

    public function __construct($env)
    {

    }

    static public function send($array) {
        $response = json_encode($array);
        echo $response;
        die();
    }


}
