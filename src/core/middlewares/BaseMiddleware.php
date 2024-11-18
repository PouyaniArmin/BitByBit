<?php 

namespace App\Core\Middlewares;

abstract class BaseMiddleware{
    abstract public function handle();
    protected function redirect(string $url){
        header('Location:'.$url);
        exit;
    }
}