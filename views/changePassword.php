<?php
require VENDOR;
\App\Authentification::accessBlocker();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $auth=new \App\Authentification(\App\Database::getPdo());
    $auth->setUsername($_POST['username']);
    $auth->setPasssword($_POST['password']);
    $user = $auth->login();
    if ($user) {
        $success=$user->changePassword($_POST['new_password']);
        if (!$success) {
            echo "<div class='alert alert-danger'>Vous avez saisi des identifiants incorrects</div>";
        } else {
            echo "<div class='alert alert-success'>Vous avez changé votre mot de passe</div>";
        }
    }else{
        echo "<div class='alert alert-danger'>Vous avez saisi des identifiants incorrects</div>";
    }
}
?>


<section class="container text-center">
    <header>
        <h2 class="text-primary">Changer votre mot de passe</h2>
    </header>

    <form method="post">
        <div class="form-group m-1">
            <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-control" required>
        </div>
        <div class="form-group m-1">
            <input type="password" name="password" placeholder="mot de passe" class="form-control" required>
        </div>
        <div class="form-group m-1">
            <input type="password" name="new_password" placeholder="nouveau mot de passe" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary text-white">Soumettre</button>
    </form>
</section>


