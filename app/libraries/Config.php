<?php
/**
 * Created by PhpStorm.
 * User: austinwhite
 * Date: 6/24/14
 * Time: 1:28 PM
 */

define('APP_PATH', __DIR__ . '../../');

class Config {
    static $basePath = "config/";

    public static function get($identifier, $fileFormat = 'json') {

        $path = explode('::', $identifier);
        $key = $path[1];

        $contents = json_decode(file_get_contents(APP_PATH . self::$basePath . $path[0] . '.' . $fileFormat), true);

        return self::array_get($contents, $key);
    }

    /**
     * Get an item from an array using "dot" notation.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public static function array_get($array, $key, $default = null)
    {
        if (is_null($key)) return $array;

        if (isset($array[$key])) return $array[$key];

        foreach (explode('.', $key) as $segment)
        {
            if ( ! is_array($array) || ! array_key_exists($segment, $array))
            {
                return $default;
            }

            $array = $array[$segment];
        }

        return $array;
    }
} 