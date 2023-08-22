<?php

namespace App;

class Promotion
{
    public $idPromotion;
    public $nomPromotion;

    public static function getPromotions():array | false
    {
        try{
            $pdo=Database::getPdo();
            $query="select * from promotion";
            $stmt=$pdo->prepare($query);
            $stmt->execute();
            $promotions=$stmt->fetchAll();
            return $promotions ?? false;
        }catch (\PDOException){
            return false;
        }
    }
}