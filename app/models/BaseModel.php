<?php
/**
 * Created by PhpStorm.
 * User: austinwhite
 * Date: 6/24/14
 * Time: 12:55 PM
 */

require __DIR__ . '/../libraries/Config.php';

class BaseModel {

    protected static $connection;

    public function __construct($conn = null) {

    }

    public static function setConnection($conn = null) {
        if ($conn) {
            self::$connection = $conn;
        } else {
            $settings = Config::get('database::connection');

            try {
                self::$connection = new PDO('mysql:host=' . $settings['host'] . ';dbname=' . $settings['database'], $settings['username'], $settings['password']);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die('ERROR: ' . $e->getMessage());
            }
        }
    }

    public static function getConnection() {
        if ( ! self::$connection) {
            self::setConnection();
        }

        return self::$connection;
    }
} 