<?php

namespace App;

class Eleve
{
    private $matricule;
    public $nom;
    public $postnom;
    public $prenom;
    public $sexe;
    public $numeroDuResponsable;

    /**
     * @param mixed $matricule
     */
    public function setMatricule($matricule = null): void
    {
        if ($matricule == null)
        {
            $matricule=$this->genareteMatricule();
        }
        $this->matricule = $matricule;
    }

    /**
     * @return mixed
     */
    public function getMatricule()
    {
        return $this->matricule;
    }
    private function genareteMatricule():string
    {
        $nom=$this->nom;
        $postnom=$this->postnom;
        $matricule=date("y").$nom[0].$postnom[0].date("mHis");
        return $matricule;
    }
    public function add():bool
    {
        try {
            $pdo=Database::getPdo();
            $query="insert into eleve values(:matricule,:nom,:postnom,:prenom, :sexe,:numero)";
            $stmt=$pdo->prepare($query);
            $stmt->execute(['matricule'=>$this->matricule,
                'nom'=>$this->nom,
                'postnom'=>$this->postnom,
                'prenom'=>$this->prenom,
                'sexe'=> $this->sexe,'numero'=>$this->numeroDuResponsable
            ]);
            return true;
        } catch (\PDOException){
            return false;
        }
    }
    public static function getPupilInClass(int $idAnnee,int $idClasse):array|false
    {
        try {
            $pdo=Database::getPdo();
            $query= " select matricule,nom, postnom, prenom from eleve, option, promotion, classe, niveau, annee where eleve.matricule=niveau.tEleveMatricule and niveau.tAnneeIdAnnee=annee.idAnnee and niveau.tClasseIdClasse=classe.idClasse and classe.tPromotionIdPromotion=promotion.idPromotion and classe.tOptionIdOption=option.idOption and tAnneeIdAnnee=:idAnnee and tClasseIdClasse=:idClasse";
            $stmt= $pdo->prepare($query);
            $stmt->execute(['idAnnee'=>$idAnnee,'idClasse'=>$idClasse]);
            $eleves=$stmt->fetchAll();
            return $eleves ?? false;
        } catch (\PDOException){
            return false;
        }
    }
}