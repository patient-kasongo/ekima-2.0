<?php
    \App\Authentification::accessBlocker();
    \App\Annee::accessBlockerBySession();
    $idAnnee=$match['params']['idAnnee'] ?? null;
    $classes=\App\Classe::getClasses();
    if (isset($_POST['name'],$_POST['postnom'],$_POST['prenom'],$_POST['sexe'],$_POST['numero'],$_POST['classe'])){

        $eleve=new \App\Eleve();
        $eleve->nom=strtoupper($_POST['name']);
        $eleve->postnom=strtoupper($_POST['postnom']);
        $eleve->prenom=strtolower($_POST['prenom']);
        $eleve->sexe=$_POST['sexe'];
        $eleve->numeroDuResponsable=$_POST['numero'];
        $eleve->setMatricule();
        $verify1=$eleve->add();

        $niveau=new \App\Niveau();
        $niveau->tEleveMatricule=$eleve->getMatricule();
        $niveau->tClasseIdClasse=$_POST['classe'];
        $niveau->tAnneeIdAnnee=$idAnnee;
        $verify2=$niveau->add();

        if($verify1 && $verify2){
            echo '<div class="alert-success alert">Vous avez enregistré un élève</div>';
        }else{
            echo '<div class="alert-danger alert">Nous avons rencontré une erreur</div>';
        }
    }
?>

<div class="container">
    <form method="post">
        <div class="m-1">
            <input type="text" class="form-control" name="name" required placeholder="nom de l'élève">
        </div>
        <div class="m-1">
            <input type="text" class="form-control" name="postnom" required placeholder="postnom de l'élève">
        </div>
        <div class="m-1">
            <input type="text" class="form-control" name="prenom" required placeholder="prenom de l'élève">
        </div>
        <div class="m-1">
            <input type="radio" name="sexe" checked class="m-1" value="M">M<input type="radio" name="sexe" class="m-1" value="F">F
        </div>
        <div class="m-1">
            <input type="text" class="form-control" name="numero" required placeholder="numéro du responsable commençant par +243">
        </div>
        <select name="classe" class="form-control">
            <?php foreach ($classes as $classe) :?>
                <option value="<?= $classe->idClasse ?>"><?= $classe->nomPromotion.' '.$classe->nomOption ?></option>
            <?php endforeach;?>
        </select>
        <button type="submit" class="btn-primary btn">Enregistrer</button>
    </form>
</div>
