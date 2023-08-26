<?php
    \App\Authentification::accessBlocker();
    $idAnnee=$match['params']['idAnnee'] ?? null;
    $idClasse=$match['params']['idClasse'] ?? null;
    $matricule=$match['params']['matricule'] ?? null;

    $auth=new \App\Authentification(\App\Database::getPdo());
    $user=$auth->isConnect();
    $bool= $user->getRole()=='ADMINISTRATEUR';

    $eleve=\App\Eleve::getPupilByIdAnneeIdClasseMatricule($idAnnee,$matricule,$idClasse);
    $pupil=\App\Eleve::getPupilByMatricule($matricule);
    $sf=$pupil->getSituationFinanciere($idAnnee);
?>

<div class="container">
    <div class="d-flex justify-content-center align-items-center flex-wrap">
        <div><img src="../../asset/img/profil.jpeg" alt="icone"></div>
        <div>
            <p class="m-1">Matricule : <?= $eleve[0]->matricule ?></p>
            <p class="m-1">Nom : <?= $eleve[0]->nom ?></p>
            <p class="m-1">Postnom : <?= $eleve[0]->postnom ?></p>
            <p class="m-1">Prenom : <?= $eleve[0]->prenom ?></p>
            <p class="m-1">Sexe : <?= $eleve[0]->sexe ?></p>
            <p class="m-1">Numéro du responsable : <?= $eleve[0]->numeroDuResponsable ?></p>
            <p class="m-1">Classe : <?= $eleve[0]->nomPromotion.' '.$eleve[0]->nomOption ?></p>
        </div>
    </div>
    <div class="text-center m-3">
        <?php if($bool): ?>
            <a class="btn-primary btn" href="<?= isset($router) ? $router->generate('modifyPupil', ['idAnnee' => $idAnnee,'idClasse'=>$idClasse, 'matricule'=>$matricule]) : '/public/login' ?>">Modifier</a>
        <?php else: ?>
            <a class="btn-primary btn" href="<?= isset($router) ? $router->generate('gestion_payement', ['idAnnee' => $idAnnee,'matricule'=>$matricule]) : '/public/login' ?>">Payement</a>
        <?php endif; ?>
    </div>
    <h3 class="text-center">Situation financière</h3>
    <?php if(empty($sf) || !$sf): ?>
        <div class="display-5 text-center">Aucun payement enregistrer</div>
    <?php else: ?>
        <ul>
            <?php foreach ($sf as $s): ?>
                <li><?= $s->motif.' '.$s->mois ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>
