<?php

use app\Core as Core;

$env = require 'env.php';

spl_autoload_register(function ($class_name) {
    if (!file_exists(str_replace('\\', '/', $class_name) . '.php')) {
        echo json_encode(['error' => '404']);
        die();
    }
    require str_replace('\\', '/', $class_name) . '.php';
});

$obj = new Core($env);