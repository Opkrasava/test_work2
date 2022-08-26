<?php

namespace app;

use app\Request as Request;

class App
{
    public function __construct() {

    }

    public function request() {
        return new Request();
    }


}