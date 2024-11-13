<?php 
namespace App\Core;

use Controller;

class Application{

    public Router $router;
    public static string $rootPath;
    public function __construct(Router $router,string $rootPath)
    {
        self::$rootPath=$rootPath;
        $this->router=$router;
    }


    public function run(){
        echo $this->router->dispacth();
    }

    
}