<?php

namespace App\Controllers;

use App\Core\Database;

class UserController extends BaseController
{
    protected Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function showRegister()
    {
        $this->render('register');
    }

    public function register()
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        // Валидация
        if ($username === '' || $password === '') {
            $_SESSION['register_error'] = 'Все поля обязательны!';
            header('Location: /register');
            exit;
        }

        // Проверка уникальности
        $stmt = $this->db->getPdo()->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $_SESSION['register_error'] = 'Пользователь уже существует!';
            header('Location: /register');
            exit;
        }

        // Сохраняем пользователя
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->getPdo()->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->execute([$username, $hash]);

        header('Location: /login');
        exit;
    }

    public function showLogin()
    {
        $this->render('login');
    }

    public function login()
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        // Получаем пользователя из БД
        $stmt = $this->db->getPdo()->prepare('SELECT password FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Проверка пользователя и пароля
        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['login_error'] = 'Неверный логин или пароль!';
            header('Location: /login');
            exit;
        }

        // Авторизация
        $_SESSION['user'] = $username;
        header('Location: /');
        exit;
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /login');
        exit;
    }
}