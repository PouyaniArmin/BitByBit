<?php 
namespace App\Models;

use App\Core\Model;

class TagModel extends Model{

    public function getAllTag()
    {
        return $this->getAll('tags');
    }
    public function createTag(array $data)
    {
        return $this->create('tags', $data);
    }
    public function getTagById($id)
    {
        return $this->getById('tags', $id);
    }
    public function updateTag($id, $data)
    {
        return $this->updateById('tags', $id, $data);
    }
    public function deleteTagById($id){
        return $this->deleteById('tags',intval($id));
    }
}