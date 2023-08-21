<?php
    $id=$match['params']['idAnnee'] ?? 0;
    $annee=\App\Annee::getAnneeById($id);
    if($annee && isset($_POST['annee'],$_POST['debut'],$_POST['fin'])){
        $annee->annee=$_POST['annee'];
        $annee->debut=$_POST['debut'];
        $annee->debut=$_POST['fin'];
        $verify=$annee->modify();
        if($verify){
            echo "<div class='alert alert-success'>Vous avez effectué une modification</div>";
        }else{
            echo "<div class='alert alert-danger'>Nous avons rencontré une erreur</div>";
        }
    }
    $annee=\App\Annee::getAnneeById($id);
?>

 <div class="container text-center">
     <?php if ($annee) : ?>
         <h4>Modification</h4>
         <form method="post">
             <div class="m-3">
                 <label class="form-label">Designation</label>
                 <input type="text" name="annee" class="form-control" value="<?= $annee->annee ?>">
             </div>
             <div class="m-3">
                 <label class="form-label">Début</label>
                 <input type="date" name="debut" class="form-control" value="<?= $annee->debut ?>">
             </div>
             <div class="m-3">
                 <label class="form-label">Fin</label>
                 <input type="date" name="fin" class="form-control" value="<?= $annee->fin ?>">
             </div>
             <button type="submit" class="btn-primary btn">Modifier</button>
         </form>
     <?php endif; ?>
 </div>