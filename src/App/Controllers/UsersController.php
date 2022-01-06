<?php

namespace App\Controllers;

use App\View;
use App\Models\Users;
use App\Db;
use App\Request;

class UsersController
{
    private $view;
    private $users;

    public function __construct()
    {
        $db = new Db();
        $this->view = new View(__DIR__ . '/../../../views');
        $this->users = new Users($db);
    }

    public function register()
    {
        if(Request::post('login', FILTER_SANITIZE_STRING) && Request::post('email', FILTER_SANITIZE_STRING) && Request::post('name', FILTER_SANITIZE_STRING) && Request::post('password', FILTER_SANITIZE_STRING)){
            $user = [];
            $user['login'] = Request::post('login', FILTER_SANITIZE_STRING);
            $user['email'] = Request::post('email', FILTER_SANITIZE_STRING);
            $user['name'] = Request::post('name', FILTER_SANITIZE_STRING);
            $user['password'] = password_hash(Request::post('password', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
            if(false == $this->users->getByEmail($user['email'])){
                $this->users->register($user);
                header("Location: http://{$_SERVER['HTTP_HOST']}/posts");
            }else{
                echo 'Такой долбаёб есть уже';
            }
        }
        $this->view->renderHtml('users/register.php', []);
    }

    public function edit()
    {
        if(Request::post('login', FILTER_SANITIZE_STRING) && Request::post('email', FILTER_SANITIZE_STRING) && Request::post('name', FILTER_SANITIZE_STRING) && Request::post('password', FILTER_SANITIZE_STRING)){
            $user = [];
            $user['login'] = Request::post('login', FILTER_SANITIZE_STRING);
            $user['email'] = Request::post('email', FILTER_SANITIZE_STRING);
            $user['name'] = Request::post('name', FILTER_SANITIZE_STRING);
            $user['password'] = crypt(Request::post('password', FILTER_SANITIZE_STRING), '$5$');
            $this->users->register($user);
            header("Location: http://{$_SERVER['HTTP_HOST']}/posts");
        }
        $this->view->renderHtml('users/register.php', []);
    }

    public function login()
    {
        if(Request::post('email', FILTER_SANITIZE_STRING) && Request::post('password', FILTER_SANITIZE_STRING)){
            $user = [];
            $user['email'] = Request::post('email', FILTER_SANITIZE_STRING);
            $user['password'] = Request::post('password', FILTER_SANITIZE_STRING);
            $getUser = $this->users->getByEmail($user['email']);
            if($getUser && isset($getUser['password']) && $this->users->passwordVerify($user['password'], $getUser['password'])){
                $hash = $getUser['id'] + strtotime('now');
                $token = crypt($hash, '$6$auth');
                $this->users->setToken($getUser['id'], $token);
                setcookie('token', $token, time()+2592000);
            }
        }
        $this->view->renderHtml('users/login.php', []);
    }
}