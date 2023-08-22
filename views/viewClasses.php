<?php
    $classes=\App\Classe::getClasses();
    if(empty($classes)) :?>
        <div class='display-3 text-center'>Aucune classe dans notre base des données</div>;
    <?php else: ?>
        <div class="row g-4 m-3">
            <?php foreach ($classes as $classe): ?>
                <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center justify-content-between bg-light p-4">
                        <h5 class="text-truncate me-3 mb-0"><?= $classe->nomPromotion.' '.$classe->nomOption ?></h5>
                        <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('modifieAnnee', ['idAnnee' => $classe->idClasse]) : '/public/login' ?>"><i class="bi bi-pencil-square"></i></a><a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('viewClasses', ['idAnnee' => $classe->idClasse]) : '/public/login' ?>"><i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>