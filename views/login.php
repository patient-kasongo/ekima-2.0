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
     $auth->setPseudo($_POST['username']);
     $auth->setMotdepasse($_POST['password']);
     $user=$auth->login();
     if($user){
         $user->redirectUser($user->getRole());
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
        <h1 class="display-5"><img src="../../asset/img/palm(2).png">Palm tree strength</h1>
        <h2 class="red-color">Connection</h2>
    </header>

    <form method="post">
        <div class="form-group m-1">
            <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-control" required>
        </div>
        <div class="form-group m-1">
            <input type="password" name="password" placeholder="mot de pass" class="form-control" required>
        </div>
        <button type="submit" class="btn red-bg text-white">Login</button>
    </form>
</section>
