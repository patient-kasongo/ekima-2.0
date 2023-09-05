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
    public function add(){
        try {
            $pdo=Database::getPdo();
            $query="insert into recu(sommeEnChiffre,sommeEnLettre,dateDuJour,tAnneeIdAnnee,tEleveMatricule,motif,mois) values(:sommeEnChiffre,:sommeEnLettre,:dateDuJour,:tAnneeIdAnnee, :tEleveMatricule,:motif,:mois)";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['sommeEnChiffre'=>$this->sommeEnChiffre,
                'sommeEnLettre'=>$this->sommeEnLettre,
                'dateDuJour'=>$this->dateDuJour,
                'tAnneeIdAnnee'=>$this->tAnneeIdAnnee,
                ':tEleveMatricule'=> $this->tEleveMatricule,
                'motif'=>$this->motif,
                'mois'=>$this->mois
            ]);
            return true;
        } catch (\PDOException){
            return false;
        }
    }
    public static function getMonthPayement(string $idAnnee, string $matricule, string $mois):Array{
        try {
            $pdo=Database::getPdo();
            $query="select sommeEnChiffre from recu where tEleveMatricule=:matricule and tAnneeIdAnnee=:idAnnee and mois=:mois";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['matricule'=>$matricule,
                'idAnnee'=>$idAnnee,
                'mois'=>$mois
            ]);
            $mois=$stmt->fetchAll();
            return $mois;
        } catch (\PDOException){
            return [];
        }
    }
    public static function convertirEnLettres($nombre)
    {
        $unites = [
            0 => 'zéro',
            1 => 'un',
            2 => 'deux',
            3 => 'trois',
            4 => 'quatre',
            5 => 'cinq',
            6 => 'six',
            7 => 'sept',
            8 => 'huit',
            9 => 'neuf',
            10 => 'dix',
            11 => 'onze',
            12 => 'douze',
            13 => 'treize',
            14 => 'quatorze',
            15 => 'quinze',
            16 => 'seize',
            20 => 'vingt',
            30 => 'trente',
            40 => 'quarante',
            50 => 'cinquante',
            60 => 'soixante',
            70 => 'soixante-dix',
            80 => 'quatre-vingt',
            90 => 'quatre-vingt-dix'
        ];
        if($nombre < 0 || $nombre > 999) {
            throw new InvalidArgumentException('Le nombre doit être compris entre 0 et 999.');
        }
        if ($nombre < 17) {
            return $unites[$nombre];
        }    if ($nombre < 20) {
        return 'dix-' . $unites[$nombre - 10];
    }
        if ($nombre < 70) {
            if ($nombre % 10 == 1) {
                return $unites[$nombre - 1] . '-et-' . $unites[1];
            } elseif ($nombre % 10 == 0) {
                return $unites[$nombre];
            } else {
                return $unites[$nombre - $nombre % 10] . '-' . $unites[$nombre % 10];
            }
        }
        if ($nombre < 80) {
            return $unites[60] . '-' . self::convertirEnLettres($nombre - 60);
        }
        if ($nombre < 90) {
            return $unites[80] . '-' . self::convertirEnLettres($nombre - 80);
        }
        if ($nombre < 100) {
            return $unites[90] . '-' . self::convertirEnLettres($nombre - 90);
        }
        if ($nombre == 100) {
            return 'cent';
        }
        if ($nombre < 200) {
            return 'cent-' . self::convertirEnLettres($nombre - 100);
        }
        if ($nombre < 1000) {
            if ($nombre % 100 == 0) {
                return $unites[intdiv($nombre,100)] . ' cents';
            } else {
                return $unites[intdiv($nombre,100)] . ' cent-' . self::convertirEnLettres($nombre % 100);
            }
        }
    }
    public static function getRecuById(int $idRecu):Array|false{
        try{
            $pdo=Database::getPdo();
            $query="select idRecu,sommeEnChiffre,sommeEnLettre,dateDuJour,motif,mois,nom,postnom,prenom from recu,eleve where idRecu=? and recu.tEleveMatricule=eleve.matricule";
            $stmt=$pdo->prepare($query);
            $stmt->execute([$idRecu]);
            $recu=$stmt->fetchAll();
            return $recu ?? false;
        }catch (\PDOException){
            return false;
        }
    }
}