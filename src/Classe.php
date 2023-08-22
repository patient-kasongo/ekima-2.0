<?php

namespace App;

class Classe
{
    public $idClasse;
    public $tPromotionIdPromotion;
    public $tOptionIdOption;

    public static function getClasses():array|false{
        try {
            $pdo=Database::getPdo();
            $stmt=$pdo->prepare("select idClasse, nomPromotion, nomOption from promotion inner join classe on promotion.idPromotion=classe.tPromotionIdPromotion inner join option on classe.tOptionIdOption=option.idOption");
            $stmt->execute([]);
            $classes=$stmt->fetchAll();
            return $classes;
        } catch (\PDOException){
            return false;
        }
    }
    public function add():bool
    {
        try{
            $pdo=Database::getPdo();
            $query="insert into classe(tPromotionIdPromotion,tOptionIdOption) values(:promotion, :option)";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['promotion'=>$this->tPromotionIdPromotion,'option'=>$this->tOptionIdOption]);
            return true;
        } catch (\PDOException){
            return false;
        }

    }
    public function modify():bool
    {
        try{
            $pdo=Database::getPdo();
            $query="update classe set tPromotionIdPromotion=:promotion,tOptionIdOption=:option where idClasse=:idClasse";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['promotion'=>$this->tPromotionIdPromotion,'option'=>$this->tOptionIdOption, 'idClasse'=>$this->idClasse]);
            return true;
        } catch (\PDOException){
            return false;
        }
    }
    public static function getClasseById(int $id):Classe|false
    {
        try{
            $pdo=Database::getPdo();
            $query="select * from classe where idClasse=?";
            $stmt=$pdo->prepare($query);
            $stmt->execute([$id]);
            $classe=$stmt->fetchObject(Classe::class);
            return $classe ?? false;
        }catch (\PDOException){
            return false;
        }
    }
}