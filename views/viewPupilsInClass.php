<?php
    \App\Authentification::accessBlocker();
    \App\Annee::accessBlockerBySession();
    $idAnnee= $match['params']['idAnnee'] ?? null;
    $idClasse= $match['params']['idClasse'] ?? null;


    $auth=new \App\Authentification(\App\Database::getPdo());
    $user=$auth->isConnect();
    $bool= $user->getRole()=='ADMINISTRATEUR';
    $eleves=\App\Eleve::getPupilInClass($idAnnee,$idClasse);

    $lesMois=["SEPTEMBRE","OCTOBRE","NOVEMBRE","DECEMBRE","JANVIER","FEVRIER","MARS","AVRIL","MAIS","JUIN"];

    if(empty($eleves) || !$eleves):?>
        <div class="display-5 text-center">Classe vide</div>
    <?php else: ?>
        <?php if(!$bool) :?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" colspan="11"><h4>Liste de payements</h4></th>
                    </tr>

                </thead>
                <tr>
                    <td class="text-center">Nom</td>
                    <?php foreach ($lesMois as $mois):?>
                        <td class="text-center">
                            <?= $mois ?>
                        </td>
                    <?php endforeach;?>
                </tr>
            <?php foreach ($eleves as $eleve):?>
                <tr>
                    <td>
                        <a href="<?= isset($router) ? $router->generate('viewPupilDetail', ['idAnnee' => $idAnnee, 'idClasse'=>$idClasse, 'matricule'=>$eleve->matricule]) : '/public/login' ?>" class="link-dark"><li class="list-unstyled"><?= $eleve->nom.' '.$eleve->postnom.' '.$eleve->prenom ?></li></a>
                    </td>
                    <?php foreach ($lesMois as $mois):?>
                        <td>
                            <?php
                                $moisPayements=\App\Recu::getMonthPayement($idAnnee, $eleve->matricule, $mois);
                            ?>
                            <?php if(!empty($moisPayements)) :?>
                                    <?php foreach ($moisPayements as $oneMonth): ?>
                                        <div><?= $oneMonth->sommeEnChiffre ?>$ <br> </div>
                                    <?php endforeach;?>
                            <?php else: ?>
                                <div>-</div>
                            <?php endif; ?>
                        </td>
                    <?php endforeach;?>
                </tr>
            <?php endforeach; ?>

        </table>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="13" class="text-center">List des élèves</th>
                </tr>
            </thead>
            <tr>
                <td class="text-center">Nom</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php foreach ($eleves as $eleve):?>
                <tr>
                    <td><a href="<?= isset($router) ? $router->generate('viewPupilDetail', ['idAnnee' => $idAnnee, 'idClasse'=>$idClasse, 'matricule'=>$eleve->matricule]) : '/public/login' ?>" class="text-dark"><li class="list-unstyled"><?= $eleve->nom.' '.$eleve->postnom.' '.$eleve->prenom ?></li></a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php endif; ?>
    <button class="btn-primary btn" id="print">Imprimer</button>
<?php endif; ?>
