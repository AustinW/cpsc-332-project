<?php
/**
 * Created by PhpStorm.
 * User: austinwhite
 * Date: 6/24/14
 * Time: 12:55 PM
 */

require __DIR__ . '/../libraries/Config.php';

class Database {

    protected static $connection;

    private function __construct() {}

    public static function instance()
    {
        static $instance = null;

        if ($instance === null) {
            $settings = Config::get('database::connection');

            try {
                $instance = new PDO('mysql:host=' . $settings['host'] . ';dbname=' . $settings['database'], $settings['username'], $settings['password']);
                $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die('ERROR: ' . $e->getMessage());
            }
        }

        return $instance;
    }
}