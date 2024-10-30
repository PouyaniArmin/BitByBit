<?php

use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Core\Application;
use App\Core\Request;
use App\Core\Router;

require __DIR__."/../vendor/autoload.php";

$app=new Application(new Router(new Request));

$app->router->get('/',[HomeController::class,'index']);
$app->router->get('/articles',[HomeController::class,'articles']);
$app->router->get('/test/{id}',[HomeController::class,'test']);
$app->router->get('/register',[UserController::class,'register']);
$app->router->get('/login',[UserController::class,'login']);

// dashboard

$app->router->get('/dashboard',[DashboardController::class,'index']);
$app->router->get('/dashboard/posts',[DashboardController::class,'posts']);
$app->router->get('/dashboard/posts/create',[DashboardController::class,'createPost']);
$app->router->get('/dashboard/posts/update/{id}',[DashboardController::class,'updatePost']);
$app->router->get('/dashboard/category',[DashboardController::class,'category']);
$app->router->get('/dashboard/category/update/{id}',[DashboardController::class,'updateCategory']);
$app->router->get('/dashboard/users',[DashboardController::class,'users']);
$app->router->get('/dashboard/users/update/{id}',[DashboardController::class,'updateUser']);
$app->router->get('/dashboard/setting',[DashboardController::class,'setting']);



$app->run();
