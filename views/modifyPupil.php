A2 A2  <?php
    \App\Authentification::accessBlocker();
    $idAnnee=$match['params']['idAnnee'] ?? null;
    $idClasse=$match['params']['idClasse'] ?? null;
    $matricule=$match['params']['matricule'] ?? null;
    $eleve=\App\Eleve::getPupilByIdAnneeIdClasseMatricule($idAnnee,$matricule,$idClasse);
    $classes=\App\Classe::getClasses();
    if (isset($_POST['name'],$_POST['postnom'],$_POST['prenom'],$_POST['sexe'],$_POST['numero'],$_POST['classe']) && !empty($eleve)) {
        $pupil = new \App\Eleve();
        $pupil->setMatricule($eleve[0]->matricule);
        $pupil->nom = strtoupper($_POST['name']);
        $pupil->postnom = strtoupper($_POST['postnom']);
        $pupil->prenom = strtolower($_POST['prenom']);
        $pupil->sexe = $_POST['sexe'];
        $pupil->numeroDuResponsable = $_POST['numero'];
        $verify1 = $pupil->modify();

        $niveau = new \App\Niveau();
        $niveau->tEleveMatricule = $eleve[0]->matricule;
        $niveau->tClasseIdClasse = $_POST['classe'];
        $niveau->tAnneeIdAnnee = $idAnnee;
        $verify2 = $niveau->modify();
        if($verify1 && $verify2){
            echo '<div class="alert-success alert">Vous avez modifié un élève</div>';
        }else{
            echo '<div class="alert-danger alert">Nous avons rencontré une erreur</div>';
        }
        $eleve=\App\Eleve::getPupilByIdAnneeIdClasseMatricule($idAnnee,$matricule,$idClasse);
    }

?>
<?php if(!empty($eleve)):?>
    <div class="container">
        <form method="post">
            <div class="m-1">
                <input type="text" class="form-control" name="name" required value="<?= $eleve[0]->nom ?>">
            </div>
            <div class="m-1">
                <input type="text" class="form-control" name="postnom" required value="<?= $eleve[0]->postnom ?>">
            </div>
            <div class="m-1">
                <input type="text" class="form-control" name="prenom" required value="<?= $eleve[0]->prenom ?>">
            </div>
            <div class="m-1">
                <?php if($eleve[0]->sexe=='M'):?>
                    <input type="radio" name="sexe" checked class="m-1" value="M">M<input type="radio" name="sexe" class="m-1" value="F">F
                <?php else: ?>
                    <input type="radio" name="sexe" class="m-1" value="M">M<input type="radio" name="sexe" checked class="m-1" value="F">F
                <?php endif; ?>
            </div>
            <div class="m-1">
                <input type="text" class="form-control" name="numero" required value="<?= $eleve[0]->numeroDuResponsable ?>">
            </div>
            <select name="classe" class="form-control">
                <?php foreach ($classes as $classe) :?>
                    <?php
                        $selected=' ';
                        if ($eleve[0]->tClasseIdClasse == $classe->idClasse){
                            $selected="selected";
                        }
                    ?>
                    <option value="<?= $classe->idClasse ?>" <?= $selected ?>><?= $classe->nomPromotion.' '.$classe->nomOption ?></option>
                <?php endforeach;?>
            </select>
            <button type="submit" class="btn-primary btn m-1">Mofifier</button>
        </form>
    </div>
<?php endif; ?>
