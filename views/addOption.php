<?php
    \App\Authentification::accessBlocker();
    \App\Annee::accessBlockerBySession();
    if(isset($_POST['designation'])){
        $nOption=new \App\Option();
        $nOption->nomOption=$_POST['designation'];
        $verify=$nOption->add();
        if($verify){
            echo "<div class='alert alert-success'>Vous avez ajouté une option</div>";
        }else{
            echo "<div class='alert alert-danger'>Nous avons rencontré une erreur</div>";
        }
    }
    $options=\App\Option::getOptions();
    if(empty($options)): ?>
        <div class='display-5 text-center'>Aucune option</div>
    <?php else: ?>
        <div class="row g-4 m-3">
            <?php foreach ($options as $option):?>
                <div class="col-lg-4 col-md-6 service-item-top wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center justify-content-between bg-light p-4">
                        <h5 class="text-truncate me-3 mb-0"><?= $option->nomOption ?></h5>
                        <a class="btn btn-outline-primary border-2 border-white" href="<?= isset($router) ? $router->generate('modifieOption', ['idOption' => $option->idOption]) : '/public/login' ?>"><i class="bi bi-pencil-square"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

<div class="container">
    <form method="post">
        <div class="mb-2">
            <input type="text" placeholder="designation" name="designation" class="form-control">
        </div>
        <button type="submit" class="btn-primary btn">Enregistrer</button>
    </form>
</div>
