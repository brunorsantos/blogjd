<?php
namespace Src\Core;

 /**
 * Classe a ser instanciada uma unica vez para armazenar dados da requisição, como URL, metodo (verbo)
 * e parametros recebido de formulario
 /*
 * @return object
 */

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