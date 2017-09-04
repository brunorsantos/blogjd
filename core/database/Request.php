<?php
namespace Src\Core;
class Request
{

    protected static $parameters = [];

    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getParameters()
    {
        return static::$parameters;
    }

        public static function setParameters($parameters)
    {
        return static::$parameters = $parameters;
    }
}