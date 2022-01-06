<?php

namespace App\Controllers;

use App\View;
use App\Models\Posts;
use App\Db;
use App\Request;

class PostController
{
    private $view;
    private $posts;

    public function __construct()
    {
        $db = new Db();
        $this->view = new View(__DIR__ . '/../../../views');
        $this->posts = new Posts($db);
    }

    public function index()
    {
        $posts = $this->posts->getPosts();
        $this->view->renderHtml('posts/index.php', ['list' => $posts]);
        

    }

    public function create()
    {
        if(Request::post('title', FILTER_SANITIZE_STRING) && Request::post('description', FILTER_SANITIZE_STRING) && Request::post('content', FILTER_SANITIZE_STRING) && Request::post('user', FILTER_SANITIZE_STRING)){
            $addpost = [];
            $addpost['id'] = Request::get('id', FILTER_SANITIZE_NUMBER_INT);
            $addpost['title'] = Request::post('title', FILTER_SANITIZE_STRING);
            $addpost['description'] = Request::post('description', FILTER_SANITIZE_STRING);
            $addpost['content'] = Request::post('content', FILTER_SANITIZE_STRING);
            $addpost['user'] = Request::post('user', FILTER_SANITIZE_STRING);
            $this->posts->create($addpost);
            header("Location: http://{$_SERVER['HTTP_HOST']}/posts");
        }
        $this->view->renderHtml('posts/create.php', []);
    }

    public function update()
    {
        $id = filter_var($_GET['id'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
        $post = $this->posts->getPost($id);
        if(Request::post('title', FILTER_SANITIZE_STRING) && Request::post('description', FILTER_SANITIZE_STRING) && Request::post('content', FILTER_SANITIZE_STRING) && Request::post('user', FILTER_SANITIZE_STRING)){
            $addpost = [];
            $addpost['id'] = Request::get('id', FILTER_SANITIZE_NUMBER_INT);
            $addpost['title'] = Request::post('title', FILTER_SANITIZE_STRING);
            $addpost['description'] = Request::post('description', FILTER_SANITIZE_STRING);
            $addpost['content'] = Request::post('content', FILTER_SANITIZE_STRING);
            $addpost['user'] = Request::post('user', FILTER_SANITIZE_STRING);
            $this->posts->update($addpost);
            header("Location: http://{$_SERVER['HTTP_HOST']}/post?id={$id}");
        }
        $this->view->renderHtml('posts/edit.php', ['addpost' => $post]);
    }

    public function read()
    {
        $id = Request::get('id', FILTER_SANITIZE_NUMBER_INT);
        $post = $this->posts->getPost($id);
        $this->view->renderHtml('posts/new.php', ['new' => $post]);
    }

    public function delete()
    {
        $id = Request::get('id', FILTER_SANITIZE_NUMBER_INT);
        $this->posts->delete($id);
        header("Location: http://{$_SERVER['HTTP_HOST']}/posts");
    }
}