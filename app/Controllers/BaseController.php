<?php

namespace App\Controllers;

class BaseController
{
    protected function render(string $view)
    {
        require __DIR__ . "/../views/{$view}.php";
    }
}