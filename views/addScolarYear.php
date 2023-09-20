<?php
    \App\Authentification::accessBlocker();
    if(isset($_POST['annee'],$_POST['debut'],$_POST['fin'])){
        $annee=new \App\Annee();
        $annee->annee=$_POST['annee'];
        $annee->debut=$_POST['debut'];
        $annee->fin=$_POST['fin'];
        $verify=$annee->add();
        if($verify){
            echo "<div class='alert alert-success'>Vous avez ouvert une année scolaire</div>";
        }else{
            echo "<div class='alert alert-danger'>Nous avons rencontré une erreur</div>";
        }
    }
?>

<div class="container m-3">
    <h3>Ajouter une année scolaire</h3>
    <form method="post">
        <div class="m-3">
            <label class="form-label">Année scolaire</label>
            <input type="text" name="annee" class="form-control" placeholder="exemple: 2023-2024">
        </div>
        <div class="m-3">
            <label class="form-label">Début</label>
            <input type="date" name="debut" class="form-control" placeholder="debut">
        </div>
        <div class="m-3">
            <label class="form-label">Fin</label>
            <input type="date" name="fin" class="form-control" placeholder="fin">
        </div>
        <button type="submit" class="btn-primary btn m-3">Enregistrer</button>
    </form>
</div>
