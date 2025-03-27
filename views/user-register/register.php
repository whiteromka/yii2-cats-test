<?php

use app\models\Status;
use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var User $user */

?>
<h1>User Register</h1>

<div class="row">
    <div class="col-lg-5">

        <?php $form = ActiveForm::begin([
                'id' => 'user-form',
                'method' => 'POST',
        ]); ?>

        <?php $user->status_id = Status::STATUS_ACTIVE; ?>
        <?= $form->field($user, 'status_id')->hiddenInput() ?>

        <?= $form->field($user, 'name')->textInput(['autofocus' => true]) ?>

        <?= $form->field($user, 'last_name') ?>

        <?= $form->field($user, 'email') ?>

        <?= $form->field($user, 'gender')->dropDownList(User::getGenders()) ?>

        <?= $form->field($user, 'password')->passwordInput()->label('Пароль') ?>

        <?= $form->field($user, 'password_repeat')->passwordInput()->label('Повтор пароля') ?>

        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

