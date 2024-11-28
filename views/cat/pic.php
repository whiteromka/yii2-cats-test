<?php

use app\models\CatPicForm;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var int $id */
/** @var CatPicForm $model */

?>
<div class="cat-view">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <button>Сохранить картинки</button>

    <?php ActiveForm::end() ?>
</div>
