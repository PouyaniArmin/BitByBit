<?php

namespace App\Models;

use App\Core\Model;

class CategoryModel extends Model
{
    public function getAllCategory()
    {
        return $this->getAll('categories');
    }
    public function getCategoryById($id)
    {
        return $this->getById('categories', intval($id));
    }
    public function createCategory(array $data)
    {
        return $this->create('categories', $data);
    }
    public function updateCategory($id, $data)
    {
        return $this->updateById('categories', intval($id), $data);
    }
    public  function deleteCategoryById($id){
        return $this->deleteById('categories',intval($id));
    }
}
