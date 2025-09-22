<?php

namespace App\Controllers;

class UserController extends BaseController
{
    protected string $usersFile = __DIR__ . '/../users.json';

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

        // Загрузка пользователей
        $users = file_exists($this->usersFile) ? json_decode(file_get_contents($this->usersFile), true) : [];

        // Проверка уникальности
        if (isset($users[$username])) {
            $_SESSION['register_error'] = 'Пользователь уже существует!';
            header('Location: /register');
            exit;
        }

        // Сохраняем пользователя
        $users[$username] = password_hash($password, PASSWORD_DEFAULT);
        file_put_contents($this->usersFile, json_encode($users));

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

        // Загрузка пользователей
        $users = file_exists($this->usersFile) ? json_decode(file_get_contents($this->usersFile), true) : [];

        // Проверка пользователя и пароля
        if (!isset($users[$username]) || !password_verify($password, $users[$username])) {
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