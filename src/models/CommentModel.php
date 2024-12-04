<?php 

namespace App\Models;

use App\Core\Model;

class CommentModel extends Model{

    public function getAllComment()
    {
        return $this->getAll('comments');
    }
    public function createComment(array $data)
    {
        return $this->create('comments', $data);
    }
    public function getCommentById($id)
    {
        return $this->getById('comments', $id);
    }
    public function updateComment($id, $data)
    {
        return $this->updateById('comments', $id, $data);
    }
    public function deleteCommentById($id)
    {
        return $this->deleteById('comments', intval($id));
    }
    public function getByEmail($email)
    {
        return $this->getBy('users', 'email', $email);
    }
}