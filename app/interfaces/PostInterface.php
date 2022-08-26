<?php

namespace app\interfaces;

interface PostInterface {

    public function __construct();

    public function getPost($id = null);

    public function setPost($user_id, $content);

}
