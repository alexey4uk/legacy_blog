<?php

namespace App;

class Router
{
    public $routes;

    public function add(string $uri, array $handler)
    {
        $this->routes[] = ['uri' => $uri, 'handler' => $handler];
    }

    public function match($uri)
    {
        foreach($this->routes as $route){
            if($uri == $route['uri'] || parse_url($uri, PHP_URL_PATH) == $route['uri']){
                return($route);
            }
        }
        return false;
    }
}