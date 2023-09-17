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
    <?php if(empty($sf)): ?>
        <h3 class="text-center">Situation financière</h3>
        <div class="display-5 text-center">Aucun payement enregistrer</div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" colspan="3"><h4>Situation financière</h4></th>
                </tr>
            </thead>
            <tr>
                <td class="text-center">Motif</td>
                <td class="text-center">Montant</td>
                <td class="text-center">Date de payement</td>
            </tr>
            <?php foreach ($sf as $s): ?>
                <tr>
                    <?php
                        echo '<td>'.$s->motif.' '.$s->mois.'</td>';
                        echo '<td>'.$s->sommeEnChiffre.'$ </td>';
                        echo '<td>'.$s->dateDujour;
                        if(!$bool): ?>
                            <a href="<?= isset($router) ? $router->generate('viewRecuDetail', ['idRecu' => $s->idRecu]) : '/public/login' ?>" class="print">imprimer</a>
                        <?php endif; ?>
                    <?= '</td>' ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <button class="btn-primary btn" id="print">Imprimer</button>
</div>
