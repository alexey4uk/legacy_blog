<?php

namespace App\Models;

use App\Db;
use PDO;

class Users
{
    public $id;
    public $login;
    public $password;
    public $email;
    public $name;
    public $db;

    public function __construct(Db $db)
    {
    $this->db = $db;
    }

    public function getByToken($token)
    {
        $request = $this->db->pdo->prepare("SELECT * FROM users WHERE \"token\" = :token;");
        $request->bindParam(':token', $token);
        $request->execute();
        return $request->fetch(PDO::FETCH_ASSOC);
    }

    public function register($user = [])
    {
        $request = $this->db->pdo->prepare("INSERT INTO users (\"login\", \"email\", \"name\", \"password\") VALUES (:login, :email, :name, :password)");
        $request->bindValue(':login', $user['login']);
        $request->bindValue(':email', $user['email']);
        $request->bindValue(':name', $user['name']);
        $request->bindValue(':password', $user['password']);
        return $request->execute();
    }

    public function getByEmail($email)
    {
        $request = $this->db->pdo->prepare("SELECT * FROM users WHERE \"email\" = :email;");
        $request->bindParam(':email', $email);
        $request->execute();
        return $request->fetch(PDO::FETCH_ASSOC);
    }

    public function passwordVerify($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function setToken($id, $token)
    {
        $request = $this->db->pdo->prepare('UPDATE users SET "token" = :token WHERE "id" = :id;');
        $request->bindParam(':id', $id);
        $request->bindValue(':token', $token);
        return $request->execute();
    }
}