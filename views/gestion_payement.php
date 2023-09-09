<?php
    \App\Authentification::accessBlocker();
    \App\Annee::accessBlockerBySession();
    $idAnnee=$match['params']['idAnnee'] ?? null;
    $matricule=$match['params']['matricule'] ?? null;
    $lesMois=["SEPTEMBRE","OCTOBRE","NOVEMBRE","DECEMBRE","JANVIER","FEVRIER","MARS","AVRIL","MAIS","JUIN"];
    if(isset($_POST['sommeChiffre'],$_POST['motif'])){
        $recu=new \App\Recu();
        $lettre=\App\Recu::convertirEnLettres((int)$_POST['sommeChiffre']);
        $recu->sommeEnChiffre=$_POST['sommeChiffre'];
        $recu->sommeEnLettre=$lettre.' Dollars';
        $recu->tEleveMatricule=$matricule;
        $recu->tAnneeIdAnnee=$idAnnee;
        $recu->motif=$_POST['motif'];
        $recu->mois= $_POST['mois'] ?? null;
        $recu->dateDuJour=date("Y-m-d");
        $verify=$recu->add();
        if($verify){
            echo '<div class="alert-success alert">Vous avez effectué un payement</div>';
        }else{
            echo '<div class="alert-danger alert">Vous avons rencontré une erreur</div>';
        }
    }
?>
<h3 class="text-center">Gestion de payement</h3>
<form method="post">
    <div>
        <input type="number" max="900" name="sommeChiffre" class="form-control mb-1" placeholder="montant en chiffre" required>
    </div>
    <div>
        <input type="radio" name="motifChoise" id="frais-mensuel"> Frais mensuel <input type="radio" name="motifChoise" id="autre"> Autre motif
    </div>
    <div>
        <input type="text" name="motif" id="motif" placeholder="motif" id="motif" class="form-control mb-1" required>
    </div>
    <div>
        <select id="mois" name="mois" class="form-control">
            <?php foreach ($lesMois as $mois) : ?>
                <option value="<?= $mois ?>"><?= $mois ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button class="btn-primary btn">Valider</button>
</form>