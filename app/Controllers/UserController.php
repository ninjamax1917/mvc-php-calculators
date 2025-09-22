<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function showRegister()
    {
        $this->render('register');
    }

    public function register()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Здесь должна быть валидация и сохранение пользователя в БД
        // Пример: password_hash для хранения пароля
        // После успешной регистрации — редирект или сообщение

        header('Location: /login');
        exit;
    }

    public function showLogin()
    {
        $this->render('login');
    }

    public function login()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Здесь должна быть проверка пользователя в БД
        // Пример: password_verify для проверки пароля

        // Если успешно:
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