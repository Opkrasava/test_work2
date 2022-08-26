<?php

namespace app;

class Request
{
    public function __construct() {

    }

    public function post() {
        $post = file_get_contents('php://input');
        return json_decode($post, true);
    }

    public function get() {
        return $_GET;
    }


}