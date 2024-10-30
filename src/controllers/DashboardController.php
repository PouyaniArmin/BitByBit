<?php
namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller{
    
    public function index(){
        $this->layout="main-dashboard";
        return $this->renderView('dashboard');
    }
    public function posts(){
        $this->layout="main-dashboard";
        return $this->renderView('posts');
    }
    public function createPost(){
        $this->layout="main-dashboard";
        return $this->renderView('createPost');
    }
    public function updatePost($id){
        $this->layout="main-dashboard";
        return $this->renderView('updatePost');
    }
    public function category(){

        $this->layout="main-dashboard";
        return $this->renderView('category');
    }
    public function updateCategory($id){
        $this->layout="main-dashboard";
        return $this->renderView('updateCategory');
    }
    public function users(){
        $this->layout="main-dashboard";
        return $this->renderView('users');
    }

    public function updateUser($id){
        $this->layout="main-dashboard";
        return $this->renderView('updateUser');
    }
    public function setting(){
        $this->layout="main-dashboard";
    return $this->renderView('setting');   
    }
}