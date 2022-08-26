<?php

namespace app\mvc\controller;

use app\Core as Core;
use app\mvc\model\PostModel;
use app\Response as Response;
use app\mvc\model\TokenModel as TokenModel;

class PostController {
    public function __construct()
    {
        $post = Core::app()->request()->post();

        if (!isset($post['token'])) {
            Response::send([
                'error' => 'missing value token'
            ]);
        }
        $token_model = new TokenModel();
        if (!$token_model->checkToken($post['token'])) {
            Response::send([
                'error' => 'token empty or expired'
            ]);
        }
    }

    public function actionGet() {
        $request = Core::app()->request()->post();
        $post_model = new PostModel();
        $posts = $post_model->getPost($request['id']);

        $response = [];

        foreach ($posts as $post) {
            $response[] = [
                'content' => $post['content'],
                'user_id' => $post['user_id'],
            ];
        }

        Response::send($response);
    }

    public function actionSet() {
        $request = Core::app()->request()->post();

        if (!isset($request['content'])) {
            Response::send([
                'error' => 'mising value content'
            ]);
        }

        $token_model = new TokenModel();
        $user_id = $token_model->getUserIdFromToken($request['token']);

        $post_model = new PostModel();
        $post_id = $post_model->setPost($user_id, $request['content']);

        Response::send([
            'id' => $post_id
        ]);

    }
}
