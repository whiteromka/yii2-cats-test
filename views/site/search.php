<?php
/** @var yii\web\View $this */

/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\Cat $cat */
/** @var bool $isLoad */
/** @var Cat[] $foundCats */

use app\models\Cat;
use yii\widgets\ActiveForm;

?>

<h1> <?= $isLoad ? 'TRUE' : 'FALSE' ?> </h1>

<div class="container">
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'contact-form',
                'method' => 'GET',
                'action' => ['site/search']
            ]); ?>
            <?= $form->field($cat, 'name')->textInput(['autofocus' => true]) ?>
            <div class="form-group">
                <input type="submit" value="Искать котов!">
                <?php // echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

        <?php  foreach ($foundCats as $cat) {
            echo "<h2> $cat->name <h2>";
        } ?>

    </div>
</div>
