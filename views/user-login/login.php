<?php

use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var User $user */
/** @var string $error */
?>
<h1>User Login</h1>

<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin([
            'id' => 'user-form',
            'method' => 'POST',
        ]); ?>
        <?= $form->field($user, 'email') ?>
        <?= $form->field($user, 'password')->passwordInput()->label('password') ?>
        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>

        <?php if ($error) : ?>
            <p class="text-danger"><?= $error ?></p>
        <?php endif; ?>

    </div>
</div>


