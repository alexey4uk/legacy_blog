<?php

namespace App;

class Request
{
    public static function get(string $param, $filter)
    {
        return filter_input(INPUT_GET, $param, $filter); // $_GET[$param] 

    }

    public static function post(string $param, $filter)
    {
        return filter_input(INPUT_POST, $param, $filter); // $_POST[$param] 
    }

    public function setCookie($name, $time)
    {
        //
    }

}