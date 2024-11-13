<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ValidatesRequests;

class CategoryController extends Controller
{
    use ValidatesRequests;

    public function __construct()
    {
        $this->layout = "main-dashboard";
    }

    public function category()
    {

        return $this->renderView('category');
    }
    public function updateCategory($id)
    {
        return $this->renderView('updateCategory');
    }
}
