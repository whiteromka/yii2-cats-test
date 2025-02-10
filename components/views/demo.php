<?php

use app\models\Status;
use app\models\User;

/** @var yii\web\View $this */
/** @var User $user */
?>

<?php
$cssClass = '';
if ($user->status_id == Status::STATUS_DISACTIVE) {
    $cssClass = 'greyBG';
}
?>

<div class="user-passport-item <?=$cssClass?>">
    <h3>
        <span> <?= $user->id ?> </span>
        <?= $user->name ?>
        <?= $user->last_name ?>
    </h3>
    <p> email: <?= $user->email ?></p>
    <p> gender: <?= $user->getGenderChar() ?></p>

    <p>
        <?php $cssId = 'status-id-' . $user->id?>
        status: <span id="<?= $cssId?>"><?= $user->getStatusAsString() ?></span>

        <?php if ($user->status_id !== Status::STATUS_DISACTIVE) : ?>
            <a class="btn btn-sm btn-warning js-btn-disactive"
               href="/user-passport/disactive-status?id=<?= $user->id?>"
               data-user-id="<?= $user->id?>"
            >
                Set disactive
            </a>
        <?php endif;?>
    </p>

    <p> country: <?= $user->passport->country ?? '' ?></p>
    <p> passport number: <?= $user->passport->number ?? '' ?></p>
    <?php if ($user->car) {?>
        <p> car: <?= $user->car->name ?? '' ?></p>
        <p> mark: <?= $user->car->mark ?? '' ?></p>
    <?php } ?>
</div>
