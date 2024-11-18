<?php

/** @var yii\web\View $this */
/** @var app\models\User[] $users */

?>

<h1>Users and passports</h1>

<?php foreach ($users as $user) { ?>
    <p> <?= $user->email ?> -
        <b> <?= $user->passport->number ?? 'нет' ?> </b>
        <b> <?= $user->passport->code ?? 'нет' ?></b>
    </p>
<?php } ?>

