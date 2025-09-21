<?php

namespace App\Core;

use App\Core\ErrorHandler;

class Router
{
    protected array $routes = [];

    public function __construct(array $routes = [])
    {
        $this->routes = $routes;
    }

    public function dispatch(string $uri)
    {
        $uri = trim($uri, '/');

        if (isset($this->routes[$uri])) {
            [$controller, $action] = explode('@', $this->routes[$uri]);
            $controller = ucfirst($controller) . 'Controller';
            $controllerClass = 'App\\Controllers\\' . $controller;
            $params = [];
        } else {
            $parts = explode('/', $uri);
            $controller = !empty($parts[0]) ? ucfirst($parts[0]) . 'Controller' : 'HomeController';
            $action = $parts[1] ?? 'index';
            $controllerClass = 'App\\Controllers\\' . $controller;
            $params = array_slice($parts, 2);
        }

        // Валидация имён
        $isValid = preg_match('/^[A-Za-z0-9_]+$/', $controller) && preg_match('/^[A-Za-z0-9_]+$/', $action);

        if ($isValid && class_exists($controllerClass)) {
            $controllerObj = new $controllerClass();
            if (method_exists($controllerObj, $action) && is_callable([$controllerObj, $action])) {
                call_user_func_array([$controllerObj, $action], $params);
            } else {
                ErrorHandler::actionNotFound($controllerClass, $action);
            }
        } else {
            ErrorHandler::controllerNotFound($controllerClass);
        }
    }
}