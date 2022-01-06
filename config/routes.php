<?php

use App\Router;
use App\Controllers\MainController;
use App\Controllers\PostController;
use App\Controllers\UsersController;

$router = new Router();
$router->add('/', [MainController::class, 'index']);
$router->add('/posts', [PostController::class, 'index']);
$router->add('/posts/add', [PostController::class, 'create']);
$router->add('/posts/edit', [PostController::class, 'update']);
$router->add('/post', [PostController::class, 'read']);
$router->add('/posts/delete', [PostController::class, 'delete']);
$router->add('/singup', [UsersController::class, 'register']);
$router->add('/login', [UsersController::class, 'login']);
$router->add('/user/edit', [UsersController::class, 'edit']);


return $router;