<?php

require __DIR__ . '/vendor/autoload.php';

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$routes = [
    '' => ['controller' => 'HomeController', 'action' => 'index'],
    'about' => ['controller' => 'HomeController', 'action' => 'about'],
];

$route = $routes[$uri] ?? null;

if ($route) {
    $controllerName = 'User\\Calculators\\App\\Controllers\\' . $route['controller'];
    $action = $route['action'];

    $controller = new $controllerName();
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        http_response_code(404);
        echo "Action not found";
    }
} else {
    http_response_code(404);
    echo "Page not found";
}
