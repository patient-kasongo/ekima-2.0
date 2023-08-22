<h3 class="text-center">Modification de la salle</h3>
<?php
    $id=$match['params']['idClasse'] ?? 0;
    $classe=\App\Classe::getClasseById($id);
    $promotions=\App\Promotion::getPromotions();
    $options=\App\Option::getOptions();
    if(isset($_POST['promotion'],$_POST['option']) && !empty($classe)){
        $classe->tPromotionIdPromotion=$_POST['promotion'];
        $classe->tOptionIdOption=$_POST['option'];
        $verify=$classe->modify();
        if ($verify){
            echo '<div class="alert alert-success">Vous avez modifié un élèment</div>';
        }else{
            echo '<div class="alert alert-danger">Nous rencontrons une erreur</div>';
        }
        $classe=\App\Classe::getClasseById($id);
    }
    if (empty($options) || empty($promotions) || empty($classe) || !$options || !$promotions || !$classe): ?>
        <div class="alert alert-danger">Nous rencontrons une erreur</div>
    <?php else : ?>
        <form method="post" class="container">
            <div>
                <label class="form-label">Promotion</label>
                <select class="form-select" name="promotion">
                    <?php foreach ($promotions as $promotion): ?>
                        <?php
                            $selected=' ';
                            if($promotion->idPromotion == $classe->tPromotionIdPromotion){
                                $selected='selected';
                            }
                        ?>
                        <option value="<?= $promotion->idPromotion ?>" <?= $selected ?>><?= $promotion->nomPromotion ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="form-label">Option</label>
                <select class="form-select" name="option">
                    <?php foreach ($options as $option): ?>
                        <?php
                            $selected=' ';
                            if($option->idOption == $classe->tOptionIdOption){
                                $selected='selected';
                            }
                        ?>
                        <option value="<?= $option->idOption ?>" <?= $selected ?>><?= $option->nomOption ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn-primary btn">Modifier</button>
        </form>
    <?php endif; ?>