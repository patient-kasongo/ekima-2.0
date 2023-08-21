<?php

namespace App;

class Annee
{
    public $idAnnee;
    public $annee;
    public $debut;
    public $fin;

    public static function getYears():false|array
    {
        $pdo=Database::getPdo();
        $stmt=$pdo->prepare("select * from annee");
        $stmt->execute([]);
        $annee=$stmt->fetchAll();
        return $annee ?? false;
    }

    public function add():bool{
        try {
            $pdo= Database::getPdo();
            $query= "insert into annee(annee,debut,fin) values(:annee, :debut, :fin)";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['annee'=>$this->annee,
                            'debut'=>$this->debut,
                            'fin'=>$this->fin]);

            $return = true;
        } catch (\PDOException){
            $return=false;
        }
        return $return;
    }
    public static function getAnneeById(int $id): Annee | false
    {
        try {
            $pdo=Database::getPdo();
            $query="select * from annee where idAnnee=?";
            $stmt= $pdo->prepare($query);
            $stmt->execute([$id]);
            $annee= $stmt->fetchObject(Annee::class);
            return $annee;
        } catch (\PDOException){
            return false;
        }
    }
    public function modify():bool
    {
        try{
            $pdo= Database::getPdo();
            $query= "update annee set annee=:annee, debut=:debut, fin=:fin where idAnnee=:idAnnee";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['annee'=>$this->annee,
                            'debut'=>$this->debut,
                            'fin'=>$this->fin,
                            'idAnnee'=>$this->idAnnee]);
            return true;
        }catch (\PDOException){
            return false;
        }
    }

}