<?php
/**
 * Created by PhpStorm.
 * User: austinwhite
 * Date: 6/24/14
 * Time: 12:55 PM
 */

require __DIR__ . '/../libraries/Config.php';

class Database {

    private function __construct() {}

    public static function instance()
    {
        static $mysqliInstance = null;

        if ($mysqliInstance === null) {
            $settings = Config::get('database::connection');

            try {
                $mysqliInstance = new mysqli($settings['host'], $settings['username'], $settings['password'], $settings['database']);
            } catch(Exception $e) {
                die('MySQLi Error: ' . $e->getMessage());
            }
        }

        return $mysqliInstance;
    }

    public static function pdo()
    {
        static $pdoInstance = null;

        if ($pdoInstance === null) {
            $settings = Config::get('database::connection');

            try {
                $pdoInstance = new PDO('mysql:host=' . $settings['host'] . ';dbname=' . $settings['database'], $settings['username'], $settings['password']);
                $pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                die('PDO Error: ' . $e->getMessage());
            }
        }

        return $pdoInstance;

    }
}