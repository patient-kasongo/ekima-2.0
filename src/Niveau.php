<?php

namespace App;

class Niveau
{
    public $tAnneeIdAnnee;
    public $tEleveMatricule;
    public $tClasseIdClasse;

    public function add():bool
    {
        try {
            $pdo=Database::getPdo();
            $query="insert into niveau values(:idAnnee,:matricule,:idClasse)";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['matricule'=>$this->tEleveMatricule,
                'idAnnee'=>$this->tAnneeIdAnnee,
                'idClasse'=>$this->tClasseIdClasse
            ]);
            return true;
        } catch (\PDOException){
            return false;
        }
    }
    public function modify():bool
    {
        try {
            $pdo=Database::getPdo();
            $query="update niveau set tClasseIdClasse=:idClasse where tAnneeIdAnnee=:idAnnee and tEleveMatricule =:matricule";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['matricule'=>$this->tEleveMatricule,
                'idAnnee'=>$this->tAnneeIdAnnee,
                'idClasse'=>$this->tClasseIdClasse
            ]);
            return true;
        } catch (\PDOException){
            return false;
        }
    }

}