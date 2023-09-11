<?php
    \App\Authentification::accessBlocker();
    \App\Annee::accessBlockerBySession();
    $idAnnee=\App\Annee::getAnneeInSession();

    $auth=new \App\Authentification(\App\Database::getPdo());
    $user=$auth->isConnect();
    $bool= $user->getRole()=='ADMINISTRATEUR';

    if(isset($_POST['search'])){
        $searchs=\App\Eleve::search($_POST['search']);
        if(!empty($searchs)):?>
            <?php foreach ($searchs as $eleve) : ?>
                <div>
                    <a href="<?= isset($router) ? $router->generate('viewPupilDetail', ['idAnnee' => $idAnnee, 'idClasse'=>$eleve->tClasseIdClasse, 'matricule'=>$eleve->matricule]) : '/public/login' ?>" class="link-dark m-2"><?= $eleve->nom.' '.$eleve->postnom.' '.$eleve->prenom ?></a>
                    <?php if($bool): ?>
                        <a href="<?= isset($router) ? $router->generate('modifyPupil', ['idAnnee' => $idAnnee,'idClasse'=>$eleve->tClasseIdClasse, 'matricule'=>$eleve->matricule]) : '/public/login' ?>">Modifier</a>
                    <?php else: ?>
                        <a href="<?= isset($router) ? $router->generate('gestion_payement', ['idAnnee' => $idAnnee,'matricule'=>$eleve->matricule]) : '/public/login' ?>">Payement</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-danger">Aucun élève trouvé</div>;
        <?php endif; ?>
    <?php }else{
        echo '<h3 class="display-3">Recherche</h3>';
    }
?>
<a href=""></a>

