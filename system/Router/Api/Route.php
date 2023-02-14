<?php

namespace System\Router\Api;

class Route
{

    public static function add($methods, $url, $action, $options)
    {
        global $routes;
        foreach ($methods as $method) {
            array_push($routes[$method], ['url' => 'api/'.trim($url,'/'), 'action' => $action, 'options' => $options]);
        }
    }
    public static function get($url, $action, $options = [])
    {
        self::add(['get'], $url, $action, $options);
    }
    public static function post($url, $action, $options = [])
    {
        self::add(['post'], $url, $action, $options);
    }
    public static function put($url, $action, $options = [])
    {
        self::add(['put'], $url, $action, $options);
    }
    public static function patch($url, $action, $options = [])
    {
        self::add(['put'], $url, $action, $options);
    }
    public static function delete($url, $action, $options = [])
    {
        self::add(['delete'], $url, $action, $options);
    }
}
