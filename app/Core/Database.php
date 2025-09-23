<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    protected PDO $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') . ';charset=utf8',
                getenv('DB_USER'),
                getenv('DB_PASS'),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            error_log('Ошибка подключения к БД: ' . $e->getMessage());
            die('Database connection error.');
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}