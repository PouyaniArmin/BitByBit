<?php

use App\Controllers\CategoryController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Core\Application;
use App\Core\Request;
use App\Core\Router;

require __DIR__ . "/../vendor/autoload.php";

$app = new Application(new Router(new Request), dirname(__DIR__));

$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/articles', [HomeController::class, 'articles']);
$app->router->get('/test/{id}', [HomeController::class, 'test']);

$app->router->get('/register', [UserController::class, 'register']);
$app->router->post('/register', [UserController::class, 'processRegistration']);
$app->router->get('/login', [UserController::class, 'login']);

$app->router->get('/post', [HomeController::class, 'posts']);
// dashboard

$app->router->get('/dashboard', [DashboardController::class, 'index']);

// posts
$app->router->get('/dashboard/posts', [PostController::class, 'posts']);
$app->router->get('/dashboard/posts/create', [PostController::class, 'createPost']);
$app->router->post('/dashboard/posts/create', [PostController::class, 'insertPost']);
$app->router->get('/dashboard/posts/update/{id}', [PostController::class, 'updatePost']);
$app->router->post('/dashboard/posts/update', [PostController::class, 'updatedPost']);
$app->router->post('/dashboard/posts/delete', [PostController::class, 'deletePost']);
// category
$app->router->get('/dashboard/category', [CategoryController::class, 'category']);
$app->router->get('/dashboard/category/update/{id}', [CategoryController::class, 'updateCategory']);
// users
$app->router->get('/dashboard/users', [DashboardController::class, 'users']);
$app->router->get('/dashboard/users/update/{id}', [DashboardController::class, 'updateUser']);
// setting
$app->router->get('/dashboard/setting', [DashboardController::class, 'setting']);

$app->run();
