<?php


namespace System\Database\DBConnection;

use PDO;
use PDOException;
use System\Config\Config;

class DBConnection{

    private static $dbConnectionInstance = null;

    public static function getDBConnectionInstance(){

        if(self::$dbConnectionInstance == null){
            $DBConnectionInstance = new DBConnection();
            self::$dbConnectionInstance = $DBConnectionInstance->dbConnection();
        }

        return self::$dbConnectionInstance;

    }

    private function dbConnection(){

        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        try{
            return new PDO("mysql:host=" . Config::get('database.DB_HOST') . ";dbname=" . Config::get('database.DB_NAME'), Config::get('database.DB_USERNAME'), Config::get('database.DB_PASSWORD'), $options);
        }
        catch (PDOException $e){
            echo "error in database connection: " . $e->getMessage();
            return false;
        }

    }


    public static function newInsertId(){

        return self::getDBConnectionInstance()->lastInsertId();

    }

}