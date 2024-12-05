<?php

/** @var yii\web\View $this */
/** @var app\models\Cat[] $cats */
/** @var Pagination $pages */

use yii\bootstrap5\LinkPager;
use yii\data\Pagination;
?>

<div class="row">

    <?php
    foreach ($cats as $cat) { ?>

    <div class="col-4">
        <div class="card">
            <?php
            $firstImg = $cat->catPics[0] ?? null;
            if ($firstImg) {
                $firstImg = $firstImg->pic_name;
            }
            ?>
            <?php if ($firstImg) { ?>
                <img src="<?= $firstImg ?>" height="130" class="card-img-top" alt="<?= $cat->name?>" title="<?= $cat->name?>">
            <? } else { ?>
                <img src="/uploads/cats/no_photo.jpg" height="130" class="card-img-top" alt="<?= $cat->name?>" title="<?= $cat->name?>">
            <?php  } ?>

            <div class="card-body">
                <h5 class="card-title"><?= $cat->name?> <?= $cat->price?> $</h5>
                <p class="card-text"> <?= $cat->getInfo() ?></p>
            </div>
        </div>
    </div>
    <?php  } ?>

</div>
<br>

<?php
    echo LinkPager::widget([
        'pagination' => $pages,
    ]);
?>
