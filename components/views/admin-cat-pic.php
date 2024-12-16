<?php

use app\models\Cat;
use app\models\CatPic;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var Cat $cat */
/** @var CatPic $catPic */

// 'http://yii2-lessons.local/cat/make-pic-main?picId=2&catId=3'
$btnUrl = Url::to([
    '/cat/make-pic-main',
    'picId' => $catPic->id,
    'catId' => $catPic->cat_id
]);
$cssPic = $catPic->is_main === 1 ? 'main-pic' : '';
?>

<div class="overflow-hidden position-relative main-wrap-admin-pic">
    <img src="<?= $catPic->pic_name ?>" width='100' alt="<?= $cat->name ?>">
    <?php if ($catPic->is_main === 0) { ?>
        <div class="wrap-admin-pic-cat-btn">
            <a class="btn-success admin-pic-cat-btn" href="<?= $btnUrl?>">
                make main
            </a>
        </div>
    <?php } else { ?>
        <div class="wrap-admin-pic-cat-main-block">
            <div class="admin-pic-cat-main-block"></div>
        </div>
    <?php } ?>
    <br>
</div>
