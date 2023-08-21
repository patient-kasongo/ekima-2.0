<?php
require VENDOR;
\App\Authentification::accessBlocker();
$annees=\App\Annee::getYears();
if($annees == null): ?>
    <div class="display-3 container text-center">Aucune année scolaire enregistrée pour l'instant</div>
<?php else: ?>
    <div class="row g-4 m-3">
        <?php foreach ($annees as $annee): ?>
            <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
                <div class="d-flex align-items-center justify-content-between bg-light p-4">
                    <h5 class="text-truncate me-3 mb-0"><?= $annee->annee ?></h5>
                    <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('modifieAnnee', ['idAnnee' => $annee->idAnnee]) : '/public/login' ?>"><i class="bi bi-pencil-square"></i></a><a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('viewClasses', ['idAnnee' => $annee->idAnnee]) : '/public/login' ?>"><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>









