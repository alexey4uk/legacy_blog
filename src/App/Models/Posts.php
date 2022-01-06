<?php

namespace App\Models;

use App\Db;

class Posts
{
    public $id;
    public $title;
    public $description;
    public $text;
    public $user;
    public $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function create($post = [])
    {
        $request = $this->db->pdo->prepare("INSERT INTO posts (\"title\", \"description\", \"content\", \"user\") VALUES (:title, :description, :content, :user)");
        $request->bindValue(':title', $post['title']);
        $request->bindValue(':description', $post['description']);
        $request->bindValue(':content', $post['content']);
        $request->bindValue(':user', $post['user']);
        return $request->execute();
    }
    public function update($post = [])
    {
        $request = $this->db->pdo->prepare(
        "UPDATE posts SET 
        \"title\" = :title,
        \"description\" = :description,
        \"content\" = :content,
        \"user\" = :user
        WHERE \"id\" = :id;
        ");
        $request->bindValue(':title', $post['title']);
        $request->bindValue(':description', $post['description']);
        $request->bindValue(':content', $post['content']);
        $request->bindValue(':user', $post['user']);
        $request->bindParam(':id', $post['id']);
        return $request->execute();
    }

    public function delete($id)
    {
        $request = $this->db->pdo->prepare("DELETE FROM posts WHERE id = :id");
        $request->bindParam(':id', $id);
        $request->execute();
    }

    public function getPost($id)
    {
        $request = $this->db->pdo->prepare('SELECT * FROM posts WHERE id = :id;');
        $request->bindParam(':id', $id);
        $request->execute();
        return $request->fetch();
    }

    public function getPosts()
    {
        $request = $this->db->pdo->prepare('SELECT * FROM posts;');
        $request->execute();
        return $request->fetchAll();
    }
}
