<?php
    \App\Authentification::accessBlocker();
    $id=$match['params']['idOption'] ?? 0;
    $option= \App\Option::getOptionById($id);
    if(isset($_POST['designation'])){
        $option->nomOption=$_POST['designation'];
        $verify=$option->modify();
        if($verify){
            echo "<div class='alert alert-success'>Vous avez modifié une option</div>";
        }else{
            echo "<div class='alert alert-success'>Nous avons rencontré une erreur</div>";
        }
    $option= \App\Option::getOptionById($id);
}
    if (!$option || empty($option)) : ?>
        <div class='alert alert-danger'>Nous avons rencontré une erreur</div>
    <?php else: ?>
        <form method="post">
            <input type="text" name="designation" class="form-control" value="<?= $option->nomOption ?>">
            <button class="btn-primary btn">Modifier</button>
        </form>
    <?php endif; ?>
