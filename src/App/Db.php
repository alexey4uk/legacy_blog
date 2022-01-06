<?php

namespace App;

use PDO;

class Db
{
    public $pdo;

    public function __construct()
    {
        $config = (require __DIR__ . '/../../config/config.php');
        $dsn = "pgsql:dbname={$config['dbname']};host={$config['host']}";
        $this->pdo = new PDO($dsn, $config['user'], $config['password']);
    }
}