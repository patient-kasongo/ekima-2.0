<?php
    require VENDOR;
    $error = false;
    $pdo = \App\Database::getPdo();
    $auth = new \App\Authentification($pdo);
    $user = $auth->isConnect();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title><?= $pageTitle ?? "ROF Services Sarl" ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="rof-services sarl, certification, réseaux informatique, vidéo surveillance" name="keywords">
    <meta content="<?= $pageDescription ?? 'ROF Services Sarl' ?>" name="description">

    <!-- Favicon -->
    <link href="../img/RF2.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../asset/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../asset/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../asset/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid p-0 m-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <div class="container-fluid bg-dark px-0" id="home">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="/" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h4 class="m-0 text-primary">ROF Services Sarl</h4>
                    </a>
                </div>
                <div class="col-lg-9">
                    <div class="row gx-0 bg-white d-none d-lg-flex">
                        <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0">infos@rof-services.com</p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <address class="mb-0">93, Du Marché/Route Kafubu</address>
                            </div>
                        </div>
                        <div class="col-lg-5 px-5 text-end">
                            <div class="d-inline-flex align-items-center py-2">
                                <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                                <a class="me-3" href="https://www.linkedin.com/company/rof-services-sarl/"><i class="fab fa-linkedin-in"></i></a>
                                <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                                <a class="" href=""><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary">ROF Services Sarl</h1>
                        </a>

                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <nav class="navbar-nav mr-auto py-0">
                                <a href="/public/#home" class="nav-item nav-link">Home</a>
                                <a href="/public/#about" class="nav-item nav-link">A propos</a>
                                <a href="/public/#services" class="nav-item nav-link">Services</a>
                                <a href="/public/#partenaires" class="nav-item nav-link">Partenaires</a>
                                <a href="/public/#contact" class="nav-item nav-link">Contact</a>
                                <?php if ($user) : ?>
                                    <a href="<?= isset($router) ? $router->generate('admin') : '/public'; ?>" class="nav-item nav-link">Articles</a>
                                    <a href="<?= isset($router) ? $router->generate('changePassword') : '/public'; ?>" class="nav-item nav-link">Mot de passe</a>
                                    <a href="<?= isset($router) ? $router->generate('logout') : '/public'; ?>" class="nav-item nav-link">Se deconnecter</a>
                                <?php endif;?>
                            </nav>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->

        <?= $contents ?? 404 ?>

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer mt-4 wow" data-wow-delay="0.1s">
            <div class="container pb-5">
                <div class="row g-5">
                    <div class="text-center col-md-6 col-lg-4">
                        <div class="rounded p-4 wow slideInLeft" data-wow-delay="0.2s">
                            <a href="/" class="text-decoration-none"><h3 class="text-white mb-3">ROF Services Sarl</h3></a>
                            <img src="../img/RF2.jpg" alt="" class="logoRof wow rotateIn" data-wow-iteration="infinite" data-wow-duration="10s">
                        </div>
                    </div>
                    <address class="col-md-6 col-lg-3 wow slideInUp" data-wow-delay="0.1s">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Contact</h6>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>93, Du Marché/Route Kafubu, Lubumbachi, RDC</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+243 99 420 72 55</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>infos@rof-services.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.linkedin.com/company/rof-services-sarl/"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </address>
                    <div class="col-lg-5 col-md-12">
                        <div class="row gy-5 g-4">
                            <div class="col-md-6 wow slideInUp" data-wow-delay="0.3s">
                                <h6 class="section-title text-start text-primary mb-4">ROF Services</h6>
                                <a class="btn btn-link" href="/public/#about">A propos</a>
                                <a class="btn btn-link" href="/public/#services">Services</a>
                                <a class="btn btn-link" href="/public/#contact">Contact Us</a>
                            </div>
                            <div class="col-md-6 wow slideInUp" data-wow-delay="0.5s">
                                <h6 class="section-title text-start text-primary mb-4">Services</h6>
                                <a class="btn btn-link" href="/public/#services">Consultation</a>
                                <a class="btn btn-link" href="/public/#services">Vente</a>
                                <a class="btn btn-link" href="/public/#services">Conception</a>
                                <a class="btn btn-link" href="/public/#services">Implémentation</a>
                                <a class="btn btn-link" href="/public/#services">Certification</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="https://rof-services.com">ROF Services Sarl</a>, All Right Reserved.
                            Designed By <a class="border-bottom" href="https://github.com/patient-kasongo">patientKASONGO</a> & <a class="border-bottom" href="https://github.com/waltervq">vainqueurKASUMBA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Footer End -->


            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

        <!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../asset/lib/wow/wow.min.js"></script>
<script src="../asset/lib/easing/easing.min.js"></script>
<script src="../asset/lib/waypoints/waypoints.min.js"></script>
<script src="../asset/lib/counterup/counterup.min.js"></script>
<script src="../asset/lib/tempusdominus/js/moment.min.js"></script>
<script src="../asset/lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="../asset/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="../asset/js/main.js"></script>
</body>

</html>