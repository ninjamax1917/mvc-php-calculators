<?php

define('BASE_PATH', dirname(__DIR__));
require BASE_PATH . '/vendor/autoload.php';

use App\Core\Application;

$routes = require BASE_PATH . '/routes.php';

$app = new Application($routes);
$app->run();