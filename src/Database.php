<?php
    namespace App;
    use PDO;

    class Database
    {
        public static $pdo;

        public static function getPdo()
        {
            if(!self::$pdo){
                try{
                    self::$pdo = new PDO('mysql:host=server72.web-hosting.com;dbname=rofstmln_rof_s','rofstmln_root','3llduevjc1Vc',[
                        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,
                        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
                    ]);}catch(\PDOException $e){
                        echo "Erreur de connexion à la base des données";
                    }
                }
                    
             
            return self::$pdo;
        }
    }