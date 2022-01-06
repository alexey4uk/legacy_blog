<?php

$autoload = __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

if(file_exists($autoload)){
  require_once $autoload;
}

$router = require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routes.php';
$route = $router->match($_SERVER['REQUEST_URI']);

if($route !== false){
  $controller = new $route['handler'][0]; // App\Controllers\MainController
  $action = $route['handler'][1];
  $controller->$action();
}else{
  echo "Страница не найдена";
}