<?php

namespace App\Core;

class ErrorHandler
{
    public static function controllerNotFound(string $controllerClass)
    {
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        echo "<p>Страница не найдена.</p>";
        // error_log("Controller not found: $controllerClass");
    }

    public static function actionNotFound(string $controllerClass, string $action)
    {
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        echo "<p>Страница не найдена.</p>";
        // error_log("Action not found: $controllerClass::$action");
    }
}