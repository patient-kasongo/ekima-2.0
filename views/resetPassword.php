<?php
    \App\Authentification::accessBlocker();
    $verify=\App\User::resetPasswordCaisse();
    if (!$verify) {
        echo "<div class='alert alert-danger'>Nous avons rencontré une erreur</div>";
    } else {
        echo "<div class='alert alert-success'>Vous avez réinitialisé le mot de passe de la caisse</div>";
        echo "identifiant: caisse mot de passe: 1234";
    }