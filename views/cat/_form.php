<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cat $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cat-form">

    <form action=""></form>

    <?php $form = ActiveForm::begin(); ?> <!--  <form action="/cat/create" method="POST">  -->

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <!-- Строка выше отрендерит эту разметку
    <div class="form-group field-cat-name required has-error">
    <label class="control-label" for="cat-name">Имя</label>
    <input type="text" id="cat-name" class="form-control" name="Cat[name]" maxlength="255" aria-required="true" aria-invalid="true">
    <div class="help-block">Значение «Имя» должно содержать минимум 12 символа.</div>
    </div>
    -->
    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'breed')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <button type="submit" class="btn btn-success">Save</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>
