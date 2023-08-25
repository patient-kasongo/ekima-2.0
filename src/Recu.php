<?php

namespace App;

class Recu
{
    public $idRecu;
    public $sommeEnChiffre;
    public $sommeEnLettre;
    public $dateDuJour;
    public $tAnneeIdAnnee;
    public $tEleveMatricule;
    public $motif;
    public $mois;
    public static function isPayed(string $idAnnee, string $matricule, string $mois):bool{
        try {
            $pdo=Database::getPdo();
            $query="select idRecu from recu where tEleveMatricule=:maricule and tAnneeIdAnnee=:idAnnee and mois=:mois";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['matricule'=>$matricule,
                'idAnnee'=>$idAnnee,
                'mois'=>$mois
            ]);
            $id=$stmt->fetchAll();
            return !empty($id);
        } catch (\PDOException){
            return false;
        }
    }

}