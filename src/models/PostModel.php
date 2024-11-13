<?php

namespace App\Models;

use App\Core\Model;

class PostModel extends Model
{
    public function getAllPost()
    {
        return $this->getAll('posts');
    }
    public function createPost(array $data)
    {
        return $this->create('posts', $data);
    }
    public function getPostById($id)
    {
        return $this->getById('posts', $id);
    }
    public function updatePost($id, $data)
    {
        return $this->updateById('posts', $id, $data);
    }
    public function deletePostById($id){
        return $this->deleteById('posts',intval($id));
    }
}
