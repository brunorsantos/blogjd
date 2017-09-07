<?php
namespace Src\Core;
class App
{

    protected static $registry = [];

    /**
     * Associa uma chave a implementação a ser associada na aplicação
     *
     * @param  $key 
     * @param  $value 
     */
    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }

    /**
     * Retona uma chave a implementação a ser associada na aplicação
     *
     * @param  $key 
     * @param  $value 
     *
     * @return object
     */
    public static function get($key)
    {
        if (! array_key_exists($key, static::$registry)) {
            throw new Exception("No key");
        }
        return static::$registry[$key];
    }
}