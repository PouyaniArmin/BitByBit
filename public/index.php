<?php

header_remove('X-Powered-By');
header('X-Frame-Options: SAMEORIGIN');

use App\Controllers\CategoryController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\TagsController;
use App\Controllers\UserController;
use App\Core\AdminSetup;
use App\Core\Application;
use App\Core\Middlewares\AdminMiddleware;
use App\Core\Request;
use App\Core\Router;
use App\Utils\MailService;

require __DIR__ . "/../vendor/autoload.php";
session_start();
$app = new Application(new Router(new Request), dirname(__DIR__));
// add admin
$admin = new AdminSetup;
$admin->createAdminIfNotExists();


$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/forgot-password', [UserController::class, 'forgetPassword']);
$app->router->post('/forgot-password', [UserController::class, 'resetPasswordRequest']);
$app->router->get('/verify-email', [UserController::class, 'verfiyAccount']);

$app->router->get('/reset-password', [UserController::class, 'restPassword']);
$app->router->post('/process-reset-password', [UserController::class, 'processResetPassword']);

$app->router->get('/articles', [HomeController::class, 'articles']);
$app->router->get('/test/{id}', [HomeController::class, 'test']);
// serach
$app->router->get('/search', [HomeController::class, 'search']);

// login and register
$app->router->get('/register', [UserController::class, 'register']);
$app->router->post('/register', [UserController::class, 'processRegistration']);
$app->router->get('/login', [UserController::class, 'login']);
$app->router->post('/login', [UserController::class, 'processLogin']);

$app->router->get('/post/{id}', [HomeController::class, 'posts']);
$app->router->post('/post/{id}', [HomeController::class, 'comments']);

// dashboard
$app->router->get('/dashboard', [DashboardController::class, 'index'], [AdminMiddleware::class]);

// posts
$app->router->get('/dashboard/posts', [PostController::class, 'posts'], [AdminMiddleware::class]);
$app->router->get('/dashboard/posts/create', [PostController::class, 'createPost'], [AdminMiddleware::class]);
$app->router->post('/dashboard/posts/create', [PostController::class, 'insertPost'], [AdminMiddleware::class]);
$app->router->get('/dashboard/posts/update/{id}', [PostController::class, 'updatePost'], [AdminMiddleware::class]);
$app->router->post('/dashboard/posts/update', [PostController::class, 'updatedPost'], [AdminMiddleware::class]);
$app->router->post('/dashboard/posts/delete', [PostController::class, 'deletePost'], [AdminMiddleware::class]);
// category
$app->router->get('/dashboard/category', [CategoryController::class, 'category'], [AdminMiddleware::class]);
$app->router->post('/dashboard/category', [CategoryController::class, 'saveCategory'], [AdminMiddleware::class]);
$app->router->get('/dashboard/category/update/{id}', [CategoryController::class, 'updateCategory'], [AdminMiddleware::class]);
$app->router->post('/dashboard/category/updated', [CategoryController::class, 'updatedCategory'], [AdminMiddleware::class]);
$app->router->post('/dashboard/category/delete/{id}', [CategoryController::class, 'deletedCategory'], [AdminMiddleware::class]);
// tags
$app->router->get('/dashboard/tag', [TagsController::class, 'index'], [AdminMiddleware::class]);
$app->router->post('/dashboard/tag', [TagsController::class, 'saveTag'], [AdminMiddleware::class]);
$app->router->get('/dashboard/tag/update/{id}', [TagsController::class, 'updateTag'], [AdminMiddleware::class]);
$app->router->post('/dashboard/tag/updated', [TagsController::class, 'updatedTag'], [AdminMiddleware::class]);
$app->router->post('/dashboard/tag/delete/{id}', [TagsController::class, 'deletedTad'], [AdminMiddleware::class]);

// users
$app->router->get('/dashboard/users', [DashboardController::class, 'users'], [AdminMiddleware::class]);
$app->router->get('/dashboard/users/update/{id}', [DashboardController::class, 'updateUser'], [AdminMiddleware::class]);
$app->router->post('/dashboard/users/updated', [DashboardController::class, 'updatedUser'], [AdminMiddleware::class]);
// setting
$app->router->get('/dashboard/setting', [DashboardController::class, 'setting'], [AdminMiddleware::class]);
$app->router->get('/logout', [DashboardController::class, 'logout']);
$app->run();
