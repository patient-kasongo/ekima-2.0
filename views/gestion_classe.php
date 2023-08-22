<h3 class="text-center">Gestion des classes</h3>
<?php
    $classes=\App\Classe::getClasses();
    if (empty($classes) || !$classes): ?>
        <div class="display-4 text-center">Aucune classe</div>
    <?php else: ?>
        <div class="row g-4 m-3">
            <?php foreach ($classes as $classe): ?>
                <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center justify-content-between bg-light p-4">
                        <h5 class="text-truncate me-3 mb-0"><?= $classe->nomOption.' '.$classe->nomPromotion ?></h5>
                        <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('modifieClasse') : '/public/login' ?>"><i class="bi bi-pencil-square"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

<div class="container">
    <div class="row g-4 m-3">
            <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
                <div class="d-flex align-items-center justify-content-between bg-light p-4">
                    <h5 class="text-truncate me-3 mb-0">Ajouter une classe</h5>
                    <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('addClasse') : '/public/login' ?>"><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
                <div class="d-flex align-items-center justify-content-between bg-light p-4">
                    <h5 class="text-truncate me-3 mb-0">Option</h5>
                    <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('addOption') : '/public/login' ?>"><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
    </div>
</div>