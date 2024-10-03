<?php

use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var User $user */
/** @var User[] $foundUsers */

?>

<div>
    <h1>Поиск пользователей</h1>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($user, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'email')->textInput() ?>
    <?= $form->field($user, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <div>
        <?php foreach ($foundUsers as $user) {
            echo "<p> $user->name - $user->email - $user->status </p>";
        } ?>

    </div>
</div>
