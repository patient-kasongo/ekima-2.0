<div class="row g-4 m-3">
    <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
        <div class="d-flex align-items-center justify-content-between bg-light p-4">
            <h5 class="text-truncate me-3 mb-0">Changer le mot de passe</h5>
            <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('changePassword') : '/public/login' ?>"><i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
        <div class="d-flex align-items-center justify-content-between bg-light p-4">
            <h5 class="text-truncate me-3 mb-0">Réinitialiser mot de passe caisse</h5>
            <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('resetPassword') : '/public/login' ?>"><i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
</div>
