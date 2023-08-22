<?php
$idAnnee= $match['params']['idAnnee'] ?? null;
$idClasse= $match['params']['idClasse'] ?? null;

$eleves=\App\Eleve::getPupilInClass($idAnnee,$idClasse);
if(empty($eleves) || !$eleves):?>
    <div class="display-5 text-center">Classe vide</div>
<?php else: ?>
    <ul class="list-group m-4">
        <?php foreach ($eleves as $eleve):?>
            <a href="<?= isset($router) ? $router->generate('viewPupilDetail', ['idAnnee' => $idAnnee, 'idClasse'=>$idClasse, 'matricule'=>$eleve->matricule]) : '/public/login' ?>" class="m-1 link-dark"><li class="list-unstyled"><?= $eleve->nom.' '.$eleve->postnom.' '.$eleve->prenom ?></li></a>
         <?php endforeach; ?>
    </ul>
<?php endif; ?>
