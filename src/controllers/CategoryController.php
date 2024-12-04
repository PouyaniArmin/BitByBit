<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\ValidatesRequests;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    use ValidatesRequests;

    public function __construct()
    {

        $this->setHeaders('Content-Type', 'text/html; charset=UTF-8');
        $this->setHeaders('X-Frame-Options', 'SAMEORIGIN');
        $this->setHeaders('X-Content-Type-Options', 'nosniff');
        // $this->setHeaders('Content-Security-Policy', "default-src 'self'");
        $this->layout = "main-dashboard";
    }

    public function category()
    {
        $category = new CategoryModel;
        $data = $category->getAllCategory();
        return $this->renderView('category', $data);
    }

    public function saveCategory(Request $request)
    {
        $fields = ['category_name' => 'required'];
        $data = $this->validate($fields, $request->body());
        $category = new CategoryModel;
        $category->createCategory($data);
        return $this->renderView('category');
    }
    public function updateCategory($id)
    {
        $category = new CategoryModel;
        $data = $category->getCategoryById($id);
        return $this->renderView('updateCategory', $data[0]);
    }
    public function updatedCategory(Request $request)
    {
        $body = $request->body();
        $category = new CategoryModel;
        $category->updateCategory($body['id'], $body);
        return $this->redierctTo('/dashboard/category');
    }
    public function deletedCategory(Request $request)
    {
        $category = new CategoryModel;
        $category->deleteCategoryById($request->body()['id']);
        return $this->redierctTo('/dashboard/category');
    }
}
