<?php

require __DIR__ . '/vendor/autoload.php';

use App\Core\Router;

$routes = require __DIR__ . '/routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router($routes);
$router->dispatch($uri);