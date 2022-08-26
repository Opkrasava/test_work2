<?php

namespace app\mvc\model;

use app\Model as Model;
use \app\interfaces\PostInterface;

class PostModel extends Model implements PostInterface {

    private $table_name = 'posts';

    public function __construct()
    {
        parent::__construct();
    }

    public function getPost($id = null) {
        if (!is_null($id)) {
            $post = $this->db->query('SELECT * FROM '.$this->table_name.' WHERE id = '.$id)->fetchAll();
        }
        else {
            $post = $this->db->query('SELECT * FROM '.$this->table_name)->fetchAll();
        }
        return $post;
    }

    public function setPost($user_id, $content) {
        $sql = "INSERT INTO ".$this->table_name." (user_id, content) VALUES ('.$user_id.', '".$content."')";
        $query = $this->db->prepare($sql);
        $query->bindValue(":user_id", $user_id);
        $query->bindValue(":token", $content);
        $query->execute();
        return $this->db->lastInsertId();
    }

}
