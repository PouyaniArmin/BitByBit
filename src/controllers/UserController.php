<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class UserController extends Controller{
    public function register(Request $request){
        return $this->renderView('register');
    }
    public function login(Request $request){
        return $this->renderView('login');
    }
}