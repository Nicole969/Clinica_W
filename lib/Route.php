<?php

namespace Lib;

class Route
{
    private static $routes = [];

    public static function get($uri, $callback)
    {
        $uri = trim($uri, '/');
        self::$routes['GET'][$uri] = $callback;
    }

    public static function post($uri, $callback)
    {
        $uri = trim($uri, '/');
        self::$routes['POST'][$uri] = $callback;
    }

    public static function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); /* clave - RewriteBase /sistemas/CLINICA/mvc/public/ */
        $uri = str_replace('/sistemas/ClinicaW/public', '', $uri); // Ajuste para el subdirectorio
        $uri = trim($uri, '/');
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset(self::$routes[$method][$uri])) {
            call_user_func(self::$routes[$method][$uri]);
        } else {
            echo "404 - Ruta no encontrada";
        }
    }
}
