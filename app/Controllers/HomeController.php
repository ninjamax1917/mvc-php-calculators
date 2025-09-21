<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        echo "Главная страница";
    }

    public function about()
    {
        echo "О проекте";
    }

    public function contacts()
    {
        echo "Контакты";
    }
}