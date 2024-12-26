<?php

use app\models\Cart;
use app\models\CartItem;

/** @var yii\web\View $this */
/** @var Cart $cart */
/** @var CartItem[] $cartItems */
?>

<div class="row">
    <div class="col-12">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Возраст</th>
                <th scope="col">Цена</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($cartItems as $cartItem) :?>
            <?php $cat = $cartItem->cat; ?>
            <tr>
                <th scope="row">#</th>
                <td><?= $cat->name ?></td>
                <td><?= $cat->age ?></td>
                <td><?= $cat->price ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <p>Всего котов: <?= count($cartItems) ?></p>
        <p>Сумма: <?= $cart->sum ?></p>
        <p>Скидка %: <?= $cart->discount_percent ?></p>
        <p>Итого: <b> <?= $cart->final_sum?> </b> </p>

    </div>
    <div class="col-12">
        <a href="/cart/create-order" class="btn btn-success">Оформить заказ</a>
    </div>
</div>
