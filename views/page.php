<?php
    require VENDOR;
    $pdo = \App\Database::getPdo();
    $auth = new \App\Authentification($pdo);
    $user = $auth->isConnect();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title><?= $pageTitle ?? "ekima" ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="gestion de scolarité" name="keywords">
    <meta content="<?= $pageDescription ?? 'ekima' ?>" name="description">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
    <!-- Libraries Stylesheet -->
    <link href="../../asset/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../../asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />


    <!-- Template Stylesheet -->
    <link href="../../asset/css/style.css" rel="stylesheet">

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    <?php if($user!=null) :?>
        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-light">
            <nav class="navbar navbar-expand-lg navbar-light bg-white p-3 py-lg-0 px-lg-4">
                <a href="" class="navbar-brand d-flex align-items-center m-0 p-0 d-lg-none">
                    <h1 class="text-primary m-0">Ekima</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav me-auto">
                        <a href="<?= isset($router) ? $router->generate('home') : '/public/login'; ?>" class="nav-item nav-link">Acceuil</a>
                        <?php if($user->getRole() == "ADMINISTRATEUR"): ?>
                            <a href="<?= isset($router) ? $router->generate('addScolarYear') : '/public/login'; ?>" class="nav-item nav-link">Ajouter année</a>
                            <a href="<?= isset($router) ? $router->generate('home') : '/public/login'; ?>" class="nav-item nav-link">gestion élève</a>
                            <a href="<?= isset($router) ? $router->generate('gestion_classe') : '/public/login'; ?>" class="nav-item nav-link">gestion classe</a>
                        <?php endif; ?>
                        <a href="<?= isset($router) ? $router->generate('logout') : '/public/login'; ?>" class="nav-item nav-link">Se deconnecter</a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->


        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="../../asset/img/carousel-1.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Ekima</h5>
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Gérez la scolarité de votre enfant en toute confiance avec Ekima </h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Envoi des notifications par SMS à chaque paiement effectué !</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="../../asset/img/carousel-2.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .4);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h5 class="text-white text-uppercase mb-3 animated slideInDown">Ekima</h5>
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Soyez toujours informé(e) de la scolarité de votre enfant avec Ekima</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">En étant notifier pour chaque payement effectuer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->

    <?php endif; ?>

    <div class="container m-3">
        <?= $contents ?? 404 ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../asset/lib/wow/wow.min.js"></script>
    <script src="../../asset/lib/easing/easing.min.js"></script>
    <script src="../../asset/lib/waypoints/waypoints.min.js"></script>
    <script src="../../asset/lib/counterup/counterup.min.js"></script>
    <script src="../../asset/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../../asset/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../../asset/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../../asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../asset/js/main.js"></script>
    <script src="../../asset/js/file.js"></script>
</body>

</html>