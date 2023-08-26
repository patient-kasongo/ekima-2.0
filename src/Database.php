<?php
    namespace App;
    use PDO;
    use PDOException;

    class Database
    {
        public static $pdo;

        public static function getPdo():PDO|null
        {
            if(!self::$pdo){
                try{
                    self::$pdo = new PDO('mysql:host=localhost;dbname=ekima','root',null,[
                        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,
                        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
                    ]);}catch(PDOException){
                        echo "connection failed";
                        return null;
                    }
                }

            return self::$pdo;
        }
    }