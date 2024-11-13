<?php

namespace App\Controllers;

use App\Core\DBManager;
use App\Core\Request;
use App\Core\Controller;
use App\Models\PostModel;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $this->sendHeader('Content-Type', 'text/html; charset=UTF-8');
        $this->sendHeader('X-Frame-Options', 'SAMEORIGIN');
        $this->sendHeader('X-Content-Type-Options', 'nosniff');
        return $this->renderView('home');
    }
    public function articles(Request $request)
    {
        return $this->renderView('articles');
    }

    public function test($id)
    {
        echo $id;
    }
    public function posts()
    {
        $post=new PostModel;
        
        $result = $post->getAllPost();
        return $this->renderView('article',$result[0]);
    }
}
