<?php

use app\models\Cat;
use app\models\Status;
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

    <!-- <form method="POST" action="user/search2">  -->
    <?php $form = ActiveForm::begin([
        'method' => 'POST',
        'action' => ['user/search'],
    ]); ?>
    <?= $form->field($user, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'email')->textInput() ?>
    <?php // echo $form->field($user, 'status_id')->checkbox(['uncheck' => 2]) ?>
    <?php echo $form->field($user, 'status_id')->dropDownList(Status::getStatuses()) ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <div>
        <?php foreach ($foundUsers as $user) {
            echo "<p> $user->name - $user->email</p>";
            echo "<p> {$user->status->name} </p>";
            echo $user->status->id;
        } ?>

    </div>
</div>
