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
    public function getLastInsertPsotId(){
        return $this->getLastInsertedId('posts');
    }
    public function insertToPosTag($post_id,$tag_id){

        $data=['post_id'=>$post_id,'tag_id'=>$tag_id];
        var_dump($data);
        // return $this->create('post_tag',$data);
    }
    public function serarchPost($search){
        return $this->searchInTable('posts',$search);
    }
    public function getPostCountByMonth(){
        return $this->getCountByMonth('posts','post_count');
    }
}
