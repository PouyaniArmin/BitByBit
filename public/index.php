<?php

use App\Controllers\CategoryController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Core\AdminSetup;
use App\Core\Application;
use App\Core\Middlewares\AdminMiddleware;
use App\Core\Request;
use App\Core\Router;
session_start();
require __DIR__ . "/../vendor/autoload.php";

$app = new Application(new Router(new Request), dirname(__DIR__));

// add admin
$admin=new AdminSetup;
$admin->createAdminIfNotExists();

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/articles', [HomeController::class, 'articles']);
$app->router->get('/test/{id}', [HomeController::class, 'test']);

$app->router->get('/register', [UserController::class, 'register']);
$app->router->post('/register', [UserController::class, 'processRegistration']);
$app->router->get('/login', [UserController::class, 'login']);
$app->router->post('/login', [UserController::class, 'processLogin']);

$app->router->get('/post', [HomeController::class, 'posts']);
// dashboard

$app->router->get('/dashboard', [DashboardController::class, 'index'],[AdminMiddleware::class]);

// posts
$app->router->get('/dashboard/posts', [PostController::class, 'posts'],[AdminMiddleware::class]);
$app->router->get('/dashboard/posts/create', [PostController::class, 'createPost'],[AdminMiddleware::class]);
$app->router->post('/dashboard/posts/create', [PostController::class, 'insertPost'],[AdminMiddleware::class]);
$app->router->get('/dashboard/posts/update/{id}', [PostController::class, 'updatePost'],[AdminMiddleware::class]);
$app->router->post('/dashboard/posts/update', [PostController::class, 'updatedPost'],[AdminMiddleware::class]);
$app->router->post('/dashboard/posts/delete', [PostController::class, 'deletePost'],[AdminMiddleware::class]);
// category
$app->router->get('/dashboard/category', [CategoryController::class, 'category'],[AdminMiddleware::class]);
$app->router->post('/dashboard/category', [CategoryController::class, 'saveCategory'],[AdminMiddleware::class]);
$app->router->get('/dashboard/category/update/{id}', [CategoryController::class, 'updateCategory'],[AdminMiddleware::class]);
$app->router->post('/dashboard/category/updated', [CategoryController::class, 'updatedCategory'],[AdminMiddleware::class]);
$app->router->post('/dashboard/category/delete/{id}', [CategoryController::class, 'deletedCategory'],[AdminMiddleware::class]);
// users
$app->router->get('/dashboard/users', [DashboardController::class, 'users'],[AdminMiddleware::class]);
$app->router->get('/dashboard/users/update/{id}', [DashboardController::class, 'updateUser'],[AdminMiddleware::class]);
// setting
$app->router->get('/dashboard/setting', [DashboardController::class, 'setting'],[AdminMiddleware::class]);
$app->router->get('/logout',[DashboardController::class,'logout']);
$app->run();
