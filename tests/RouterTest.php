<?php

use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Core\AdminSetup;
use App\Core\Application;
use App\Core\Controller;
use App\Core\DBManager;
use App\Core\Middlewares\AdminMiddleware;
use App\Core\Request;
use App\Core\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private Router $router;
    public function setUp(): void
    {
        Application::$rootPath = __DIR__;

        $_ENV['DB_HOST'] = '127.0.0.1';
        $_ENV['DB_NAME'] = 'BitByBit';
        $_ENV['DB_USER'] = 'root';
        $_ENV['DB_PASSWORD'] = '';

        $admin = new AdminSetup;
        $admin->createAdminIfNotExists();
        $this->router = new Router(new Request);
    }

    public function testGet()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/';

        $home = new HomeController();
        $tes = $home->index(new Request);
        $this->router->get('/', [$home, 'index']);
        $out = $this->router->dispacth();
        $this->assertEquals($tes, $out);
    }
    public function testPost()
    {

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/login';
        $this->router->post('/login', [UserController::class, 'processLogin']);
        $login = new UserController;
        $test = $login->processLogin(new Request);
        $out = $this->router->dispacth();
        $this->assertNotEquals($test, $out);
    }
    public function testMiddleware()
    {

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/dashboard';
        $_SESSION['user_role'] = 'admin';
        $this->router->get('/dashboard', [DashboardController::class, 'index'], [AdminMiddleware::class]);
        $dash = new DashboardController;
        $test = $dash->index();
        $out = $this->router->dispacth();
        $this->assertNotEquals($test, $out);
    }
}
