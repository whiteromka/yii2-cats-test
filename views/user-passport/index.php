<?php

use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserPassportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = 'Пользователи с паспортами';
?>
<div class="user-index">

    <h1>Пользователи с паспортами</h1>

    <!-- 1) Форма поиска -->
    <?php $form = ActiveForm::begin([
        'method' => 'GET',
    ]); ?>
    <div class="row">
        <div class="col-3">
            <?= $form->field($searchModel, 'name') ?>
        </div>
        <div class="col-3">
            <?= $form->field($searchModel, 'last_name') ?>
        </div>
        <div class="col-3">
            <?= $form->field($searchModel, 'email') ?>
        </div>
        <div class="col-3">
            <?= $form->field($searchModel, 'gender')->dropDownList(User::getGendersWithEmpty()) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <br>
    <hr>

    <!-- 2) Результат кубиками -->
    <?php $users = $dataProvider->getModels(); ?>
    <div class="row">
        <?php
        /** @var User $user */
        foreach ($users as $user) : ?>

        <div class="col-4">
            <div class="user-passport-item">
                <h3>
                    <span> <?= $user->id ?> </span>
                    <?= $user->name ?>
                    <?= $user->last_name ?>
                </h3>
                <p> email: <?= $user->email ?></p>
                <p> gender: <?= $user->gender ?></p>
                <p> status: <?= $user->getStatusAsString() ?></p>
            </div>
        </div>

        <?php endforeach; ?>
    </div>

    <!-- 3) Пагинация -->
    <div class="row">
        <?= LinkPager::widget(['pagination' => $dataProvider->pagination])?>
    </div>
</div>
