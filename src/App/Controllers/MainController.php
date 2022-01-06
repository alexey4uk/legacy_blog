<?php

namespace App\Controllers;
use App\View;
use App\Models\Users;
use App\Db;
use App\Request;

class MainController
{
    public function __construct()
    {
        $db = new Db();
        $this->view = new View(__DIR__ . '/../../../views');
        $this->users = new Users($db);
    }

    public function index()
    {
        if(isset($_COOKIE['token'])){
            $user = $this->users->getByToken($_COOKIE['token']);
            if(isset($user['token']) && $_COOKIE['token'] == $user['token']){
                echo 'Привет, ' . $user['login'];
            }
        } else {
            echo 'Привет гость.';
        }
    }

    public function create()
    {
        //
    }

    public function update()
    {
        //
    }

    public function read()
    {
        //
    }
}