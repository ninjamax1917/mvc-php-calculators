<?php

namespace App\Core;

class Application
{

    protected array $routes;
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function run()
    {

        $session = session_start();

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST') {
            if ($uri === '/register') {
                $uri = 'register_post';
            } elseif ($uri === '/login') {
                $uri = 'login_post';
            }
        }

        $router = new Router($this->routes);
        $router->dispatch($uri);
    }
}