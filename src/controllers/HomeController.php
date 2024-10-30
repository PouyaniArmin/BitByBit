<?php

namespace App\Controllers;

use App\Core\Controller as CoreController;
use App\Core\Request;
use Controller;

class HomeController extends CoreController
{

    public function index(Request $request)
    {

        $this->sendHeader('Content-Type', 'text/html; charset=UTF-8');
        $this->sendHeader('X-Frame-Options', 'SAMEORIGIN');
        $this->sendHeader('X-Content-Type-Options', 'nosniff');
        return $this->renderView('home');
    }
    public function articles(Request $request){
        return $this->renderView('articles');
    }

    public function test($id)
    {
        echo $id;
    }
}
