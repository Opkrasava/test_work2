<?php

namespace app;

use app\App as App;

class Core {

    static private $env = null;

    private $controller_namespace = 'app\mvc\controller\\';

    public function __construct($env)
    {
        self::$env = $env;

        list($class_name, $method_name) = $this->route();

        $class = new $class_name();
        if (!method_exists($class, $method_name)) {
            Response::send([
                'error' => '404'
            ]);
        }
        $class->$method_name();
    }

    static function getEnv() {
        return self::$env;
    }

    private function route() {
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        $route = explode('/', $uri['0']);
        $return = [
            $this->getClassName($route['1']),
            $this->getMethodName($route['2'])
        ];
        return $return;
    }

    private function getClassName($route) {
        return $this->controller_namespace.ucfirst($route).'Controller';
    }

    private function getMethodName($route) {
        return 'action'.ucfirst($route);
    }

    static public function app() {
        return new App();
    }
}
