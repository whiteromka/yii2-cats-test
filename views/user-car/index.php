<?php

/** @var yii\web\View $this */
/** @var app\models\User[] $users */

?>

<h1>Пользователи</h1>

<?php
foreach ($users as $user) { ?>
    <?php $year = $user->car->year ?? ' - '; ?>
    <?php $mark = $user->car->mark ?? ' - '; ?>
    <?php $car = $user->car->name ?? ' - '; ?>
    <p> <?=$user->id?>, <?=$user->name?> <?=$car?>  <?=$mark?> <?=$year?></p>


<?php } ?>
