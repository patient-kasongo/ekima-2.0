<?php
    $idRecu=$match["params"]["idRecu"] ?? null;
    $recu=\App\Recu::getRecuById($idRecu);
    ?>

<div class="container">
    <p>Numéro : <?= $recu[0]->idRecu ?></p>
    <p>Somme : <?= $recu[0]->sommeEnChiffre ?> $</p>
    <p>Somme en toute lettre : <?= $recu[0]->sommeEnLettre ?></p>
    <p>Appartenant à : <?= $recu[0]->nom.' '.$recu[0]->postnom.' '.$recu[0]->prenom ?></p>
    <p>Motif : <?= $recu[0]->motif.' '.$recu[0]->mois ?></p>
    <button class="btn-primary btn" id="print">Imprimer</button>
</div>
