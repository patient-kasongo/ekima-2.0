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
    public static function getPupilByMatricule(string $matricule):Eleve|false
    {
        try{
            $pdo=Database::getPdo();
            $query="select * from eleve where matricule=?";
            $stmt=$pdo->prepare($query);
            $stmt->execute([$matricule]);
            $eleve=$stmt->fetchObject(Eleve::class);
            return $eleve ?? false;
        }catch (\PDOException){
            return false;
        }
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
            $query= "select matricule,nom, postnom, prenom from eleve, option, promotion, classe, niveau, annee where eleve.matricule=niveau.tEleveMatricule and niveau.tAnneeIdAnnee=annee.idAnnee and niveau.tClasseIdClasse=classe.idClasse and classe.tPromotionIdPromotion=promotion.idPromotion and classe.tOptionIdOption=option.idOption and tAnneeIdAnnee=:idAnnee and tClasseIdClasse=:idClasse";
            $stmt= $pdo->prepare($query);
            $stmt->execute(['idAnnee'=>$idAnnee,'idClasse'=>$idClasse]);
            $eleves=$stmt->fetchAll();
            return $eleves ?? false;
        } catch (\PDOException){
            return false;
        }
    }
    public function getSituationFinanciere(string $idAnnee):Array|false
    {
        try {
            $pdo=Database::getPdo();
            $query= "select motif,mois from recu,eleve,niveau, annee where recu.tEleveMatricule=eleve.matricule and recu.tAnneeIdAnnee=annee.idAnnee and eleve.matricule=niveau.tEleveMatricule and niveau.tAnneeIdAnnee=annee.idAnnee and idAnnee=:idAnnee and matricule=:matricule";
            $stmt= $pdo->prepare($query);
            $stmt->execute(['idAnnee'=>$idAnnee,'matricule' => $this->matricule]);
            $sf=$stmt->fetchAll();
            return $sf ?? false;
        } catch (\PDOException){
            return false;
        }
    }
    public static function getPupilByIdAnneeIdClasseMatricule(int $idAnnee,string $matricule,int $idClasse):array|false
    {
        try {
            $pdo=Database::getPdo();
            $query= "select matricule,nom, postnom, prenom,sexe,numeroDuResponsable,tClasseIdClasse,nomOption,nomPromotion from eleve, option, promotion, classe, niveau, annee where eleve.matricule=niveau.tEleveMatricule and niveau.tAnneeIdAnnee=annee.idAnnee and niveau.tClasseIdClasse=classe.idClasse and classe.tPromotionIdPromotion=promotion.idPromotion and classe.tOptionIdOption=option.idOption and tAnneeIdAnnee=:idAnnee and tClasseIdClasse=:idClasse and tEleveMatricule=:matricule";
            $stmt= $pdo->prepare($query);
            $stmt->execute(['idAnnee'=>$idAnnee,'idClasse'=>$idClasse, 'matricule'=>$matricule]);
            $eleve=$stmt->fetchAll();
            return $eleve ?? false;
        } catch (\PDOException){
            return false;
        }
    }
    public function modify():bool{
        try {
            $pdo=Database::getPdo();
            $query="update eleve set nom=:nom,postnom=:postnom,prenom=:prenom, sexe=:sexe,numeroDuResponsable=:numero where matricule=:matricule";
            $stmt=$pdo->prepare($query);
            $stmt->execute([
                'matricule'=>$this->matricule,
                'nom'=>$this->nom,
                'postnom'=>$this->postnom,
                'prenom'=>$this->prenom,
                'sexe'=> $this->sexe,
                'numero'=>$this->numeroDuResponsable
            ]);
            return true;
        } catch (\PDOException){
            return false;
        }
    }
}