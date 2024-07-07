<?php

namespace Lib;

class Route
{

    private static $routes = [];

    public static function get($uri, $callback)
    {
        self::$routes['GET'][$uri] = $callback;
    }

    public static function post($uri, $callback)
    {
        self::$routes['POST'][$uri] = $callback;
    }

    /*
    public static function init($url)
    {
        $url = explode("/", $url);
        $controller = $url[0];
        $method = $url[1];
        $params = array_slice($url, 2);

        $controller = "Controllers\\" . ucfirst($controller) . "Controller";
        $controller = new $controller();
        call_user_func_array([$controller, $method], $params);
    }*/
}
