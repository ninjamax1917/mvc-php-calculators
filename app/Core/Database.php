<?php

namespace App\Core;

use PDO;

class Database
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=mysql;dbname=mvc_db;charset=utf8',
            'root',
            'secret'
        );
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}