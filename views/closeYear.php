<?php
    \App\Authentification::accessBlocker();
    \App\Annee::accessBlockerBySession();
    $idAnnee= $match['params']['idAnnee'] ?? null;
    $idClasse= $match['params']['idClasse'] ?? null;


    $auth=new \App\Authentification(\App\Database::getPdo());
    $user=$auth->isConnect();
    $eleves=\App\Eleve::getPupilInClass($idAnnee,$idClasse);
    $classes=\App\Classe::getClasses();
    $secondYear=\App\Annee::getSecondYear($idAnnee);
    if (!empty($_POST)){
        $count=0;
        $totalCount=0;
        foreach ($_POST as $key=>$post){
            $niveau=new \App\Niveau();
            $niveau->tEleveMatricule=$key;
            $niveau->tClasseIdClasse=$post;
            $niveau->tAnneeIdAnnee=$secondYear->idAnnee;
            $verify=$niveau->add();
            if($verify){
                $count++;
            }
            $totalCount++;
        }
        echo "<div class='alert-success alert'>$count/$totalCount enregistrerment(s) effectué(s)</div>";
    }
?>
<?php if($secondYear) :?>
    <form method="post">
        <div class="row m-1">
            <div class="div col-md-4"><label>Nom de l'élève</label></div>
            <div class="div col-md-4"><label>Classe actuelle</label></div>
            <div class="div col-md-4"><label>Entre en(<?= $secondYear->annee ?>)</label></div>
        </div>
        <?php foreach ($eleves as $eleve):?>
            <div class="row m-1">
                <div class="col-md-4">
                    <input type="text" name="<?= $eleve->matricule ?>" class="form-control" value="<?= $eleve->nom.' '.$eleve->postnom.' '.$eleve->prenom ?>" disabled="disabled">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" value="<?=$eleve->nomPromotion.' '.$eleve->nomOption ?>" disabled="disabled">
                </div>
                <div class="col-md-4">
                    <select name="<?= $eleve->matricule ?>" class="form-control">
                        <?php foreach ($classes as $classe): ?>
                            <option value="<?= $classe->idClasse ?>"><?=$classe->nomPromotion.' '.$classe->nomOption ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn-primary btn">Valider</button>
    </form>
<?php else: ?>
    <h3 class="display-5 text-center">Veuillez ajouter l'année qui vient après celle ci dans la base des données puis réessayer</h3>
<?php endif; ?>