<div class="container">
    <div class="row g-4 m-3">
        <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
            <div class="d-flex align-items-center justify-content-between bg-light p-4">
                <h5 class="text-truncate me-3 mb-0">Ajouter élève</h5>
                <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('addClasse') : '/public/login' ?>"><i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
            <div class="d-flex align-items-center justify-content-between bg-light p-4">
                <h5 class="text-truncate me-3 mb-0">Modifier élève</h5>
                <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('addOption') : '/public/login' ?>"><i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
            <div class="d-flex align-items-center justify-content-between bg-light p-4">
                <h5 class="text-truncate me-3 mb-0">Voir élève</h5>
                <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('addOption') : '/public/login' ?>"><i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
