<h3 class="m-3 text-center">Ajout d'une salle de classe</h3>
<?php
    $options=\App\Option::getOptions();
    $promotions=\App\Promotion::getPromotions();
    if (isset($_POST['promotion'],$_POST['option']))
    {
        $classe=new \App\Classe();
        $classe->option=$_POST['option'];
        $classe->promotion=$_POST['promotion'];
        $verify=$classe->add();
        if($verify){
            echo "<div class='alert alert-success'>vous avez ajouté une classe </div>";
        }else{
            echo "<div class='alert alert-success'>Nous avons rencontré une erreur</div>";
        }
    }
    if (empty($options)): ?>
        <div class="display-5 text-center">Aucune option, veuillez ajouter une option puis réessayer</div>;
    <?php else : ?>
        <form method="post" class="container">
            <div>
                <label class="form-label">Promotion</label>
                <select class="form-select" name="promotion">
                    <?php foreach ($promotions as $promotion): ?>
                        <option value="<?= $promotion->idPromotion ?>"><?= $promotion->nomPromotion ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="form-label">Option</label>
                <select class="form-select" name="option">
                    <?php foreach ($options as $option): ?>
                        <option value="<?= $option->idOption ?>"><?= $option->nomOption ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn-primary btn">Enregistrer</button>
        </form>
<?php endif; ?>