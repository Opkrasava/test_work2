<?php

namespace app\mvc\controller;

use app\Core as Core;
use app\Response as Response;
use app\mvc\model\UserModel as UserModel;
use app\mvc\model\TokenModel as TokenModel;

class UserController {
    public function __construct()
    {

    }

    public function actionAuth() {
        $post = Core::app()->request()->post();

        if (!isset($post['login'])) {
            echo 'missing value login';
            die();
        }
        if (!isset($post['password'])) {
            echo 'missing value password';
            die();
        }

        $user_model = new UserModel();
        $user = $user_model->getUserFromLoginAndPassword($post['login'], $post['password']);

        if (!$user) {
            echo 'Wrong login or password';
            die();
        }

        $token_model = new TokenModel();
        $token = $token_model->createToken($user['id']);

        $response = [
            'token' => $token['token'],
            'expired_date' => $token['expired_date']
        ];

        Response::send($response);
    }
}
