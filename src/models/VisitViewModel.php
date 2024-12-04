<?php

namespace App\Models;

use App\Core\Model;

class VisitViewModel extends Model
{
    public function getAllVistView()
    {
        return $this->getAll('page_views');
    }
    public function createVistView(array $data)
    {
        return $this->create('page_views', $data);
    }
    public function getVistViewById($id)
    {
        return $this->getById('page_views', $id);
    }
    public function updateVistView($id, $data)
    {
        return $this->updateById('page_views', $id, $data);
    }
    public function deleteVistViewById($id)
    {
        return $this->deleteById('page_views', intval($id));
    }

    public function getViews(){
        return $this->getDailyViews('page_views');
    }
}
