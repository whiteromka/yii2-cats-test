<?php

/** @var yii\web\View $this */
/** @var int $count */
/** @var int $percent */
/** @var int $finalSum */

use yii\helpers\Url;

?>

<div class="cart-widget">
    <h6>Корзина</h6>
   <p>Кол-во: <?= $count?> шт</p>
    <p>Процент: <?= $percent?> %</p>
    <p>Сумма: <?= $finalSum?> руб</p>
<!--    <a href="/cart/index" style="font-size: 11px" class="btn btn-primary btn-sm">К оформлению</a>-->
    <a href="<?= Url::to(['/cart/index'])?>" style="font-size: 11px" class="btn btn-primary btn-sm">К оформлению</a>
</div>
