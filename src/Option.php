<?php

namespace App;

class Option
{
    public $idOption;
    public $nomOption;

    public function add():bool{
        try{
            $pdo=Database::getPdo();
            $query="insert into option(nomOption) values (?)";
            $stmt=$pdo->prepare($query);
            $stmt->execute([$this->nomOption]);
            return true;
        }catch (\PDOException){
            return false;
        }
    }
    public function modify():bool
    {
        try {
            $pdo=Database::getPdo();
            $query="update option set nomOption=:nomOption where idOption=:idOption";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['nomOption'=> $this->nomOption, 'idOption'=>$this->idOption]);
            return true;
        }catch (\PDOException){
            return false;
        }
    }
    public static function getOptionById():Option|false
    {
        try{
            $pdo=Database::getPdo();
            $query="select * from option";
            $stmt=$pdo->query($query);
            $option=$stmt->fetchObject(Option::class);
            return $option ?? false;
        }catch (\PDOException){
            return false;
        }
    }
    public static function getOptions():array|false
    {
        try{
            $pdo=Database::getPdo();
            $query="select * from option";
            $stmt=$pdo->prepare($query);
            $stmt->execute();
            $options=$stmt->fetchAll();
            return $options ?? false;
        }catch (\PDOException){
            return false;
        }
    }
}