<?php
 require VENDOR;
 $error=false;
 $pdo= \App\Database::getPdo();
 $auth=new \App\Authentification($pdo);
 $user=$auth->isConnect();
 if($user != null){
     $user->redirectUser($user->getRole());
     exit();
 }
 if(isset($_POST['username']) && isset($_POST['password'])){
     $auth->setUsername($_POST['username']);
     $auth->setPasssword($_POST['password']);
     $user=$auth->login();
     if($user){
         $idAnne=\App\Annee::getAnneeInSession();
         if($idAnne){
             $route=isset($router) ? $router->generate('viewClasses', ['idAnnee' => $idAnne]) : '/public/login';
         }else{
             $route=isset($router) ? $router->generate('home') : '/public/login';
         }
         $user->redirectUser($route);
         exit();
     }
 $error=true;
 }
 if($error){
     echo "<div class='alert alert-danger'>Vous avez saisi des identifiants incorrect</div>";
 }
?>

<section class="container text-center">
    <header>
        <h2 class="red-color">Connexion</h2>
    </header>

    <form method="post">
        <div class="form-group m-1">
            <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-control" required>
        </div>
        <div class="form-group m-1">
            <input type="password" name="password" placeholder="mot de pass" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</section>
