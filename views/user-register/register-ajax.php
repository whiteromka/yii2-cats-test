<?php

use app\assets\RegisterAjaxAsset;
use app\components\RegisterSuccessWidget;
use app\models\Status;
use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var User $user */
RegisterAjaxAsset::register($this);
?>
<h1>User Register-Ajax</h1>

<div class="row">
    <!-- Для JS куда вставлять всплывашку -->
    <div class="js-success-message"></div>

    <!-- Для JS что бы скрыть формы -->
    <div class="col-lg-5 js-form">

        <?php $form = ActiveForm::begin([
                'id' => 'user-form',
                'method' => 'POST',
        ]); ?>

        <?php $user->status_id = Status::STATUS_ACTIVE; ?>
        <?= $form->field($user, 'status_id')->hiddenInput()->label(false) ?>

        <?= $form->field($user, 'name')->textInput(['autofocus' => true]) ?>

        <?= $form->field($user, 'last_name') ?>

        <?= $form->field($user, 'email') ?>

        <?= $form->field($user, 'gender')->dropDownList(User::getGenders()) ?>

        <?= $form->field($user, 'password')->passwordInput()->label('Пароль') ?>

        <?= $form->field($user, 'password_repeat')->passwordInput()->label('Повтор пароля') ?>

        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary js-btn-register-ajax']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

