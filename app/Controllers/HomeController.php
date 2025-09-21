<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $this->render('home');
    }

    public function about()
    {
        $this->render('about');
    }

    public function contacts()
    {
        $this->render('contacts');
    }
}