<?php

namespace App\Database;

use PDO;
use PDOException;

class DB
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO("mysql:host=db;dbname=db_users", "php", "toor");
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection error: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}