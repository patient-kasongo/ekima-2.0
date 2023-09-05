<?php
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
            <table class="table">
                <thead>
                    <th>Nom</th>
                    <?php foreach ($lesMois as $mois):?>
                        <th>
                            <?= $mois ?>
                        </th>
                    <?php endforeach;?>
                </thead>
            <?php foreach ($eleves as $eleve):?>
                <tr>
                    <td>
                        <a href="<?= isset($router) ? $router->generate('viewPupilDetail', ['idAnnee' => $idAnnee, 'idClasse'=>$idClasse, 'matricule'=>$eleve->matricule]) : '/public/login' ?>" class="link-dark"><li class="list-unstyled"><?= $eleve->nom.' '.$eleve->postnom.' '.$eleve->prenom ?></li></a>
                    </td>
                    <?php foreach ($lesMois as $mois):?>
                        <td>
                            <?php
                                $mois=\App\Recu::getMonthPayement($idAnnee, $eleve->matricule, $mois);
                            ?>
                            <?php if(!empty($mois)) :?>
                                    <?php foreach ($mois as $oneMonth): ?>
                                        <div>- <?= $oneMonth->sommeEnChiffre ?>$ </div>
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
        <ul class="list-group">
            <div class="list-group-item-action list-group-item">List des élèves</div>
            <?php foreach ($eleves as $eleve):?>
                <a href="<?= isset($router) ? $router->generate('viewPupilDetail', ['idAnnee' => $idAnnee, 'idClasse'=>$idClasse, 'matricule'=>$eleve->matricule]) : '/public/login' ?>" class="list-group-item list-group-item-action"><li class="list-unstyled"><?= $eleve->nom.' '.$eleve->postnom.' '.$eleve->prenom ?></li></a>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>
    <button class="btn-primary btn" id="print">Imprimer</button>
<?php endif; ?>
