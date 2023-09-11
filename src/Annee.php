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
    public function setAnneeInSession():void
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['idAnnee']=$this->idAnnee;
    }
    public static function accessBlockerBySession():void
    {
        if(!isset($_SESSION['idAnnee'])){
            header("Location:/public/");
        }
    }
    public static function getAnneeInSession():int | null
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        return $_SESSION['idAnnee'] ?? null;
    }
    public static function getAnnuelBilan(int $idAnnee):Array{
        try {
            $pdo=Database::getPdo();
            $query="select nom, postnom, prenom,sexe, nomOption, nomPromotion, sommeEnChiffre, sommeEnLettre, dateDuJour, motif,mois from eleve, recu, niveau,annee,classe,promotion,option where recu.tEleveMatricule=eleve.matricule AND eleve.matricule=niveau.tEleveMatricule AND annee.idAnnee=recu.tAnneeIdAnnee AND niveau.tAnneeIdAnnee=annee.idAnnee AND niveau.tClasseIdClasse=classe.idClasse AND classe.tPromotionIdPromotion=promotion.idPromotion AND classe.tOptionIdOption=option.idOption AND idAnnee=:idAnnee";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['idAnnee'=>$idAnnee]);
            $bilans=$stmt->fetchAll();
            return $bilans ?? [];
        } catch (\PDOException $e){
            return [];
        }

    }
}