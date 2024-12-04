<?php

namespace App\Core;

use Controller;

class Application
{

    public Router $router;
    public static string $rootPath;

    /**
     * Application constructor.
     * Initializes the router and sets the root path for the application.
     *
     * @param Router $router - Instance of the Router class to handle routes.
     * @param string $rootPath - The root directory of the application.
     */
    public function __construct(Router $router, string $rootPath)
    {
        self::$rootPath = $rootPath;
        $this->router = $router;
    }

    /**
     * Run the application.
     * Dispatches the router to handle the current request and outputs the response.
     */
    public function run()
    {
        echo $this->router->dispacth();
    }
}
