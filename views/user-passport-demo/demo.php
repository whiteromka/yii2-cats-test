<?php

use app\assets\DemoAsset;
use app\components\DemoWidget;
use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserUniversalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = 'Пользователи с паспортами';
DemoAsset::register($this);
?>
<div class="user-index">

    <h1> --- DEMO ----</h1>

    <!-- 1) Форма поиска -->
    <?php $form = ActiveForm::begin([
        'method' => 'GET',
    ]); ?>

    <!-- Поиск по user-ам -->
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
    <br>

    <!-- Поиск по passport-ам -->
    <div class="row">
        <div class="col-3">
            <?= $form->field($searchModel, 'number') ?>
        </div>
        <div class="col-3">
            <?= $form->field($searchModel, 'country') ?>
        </div>
    </div>
    <br>

    <!-- Поиск по car-ам -->
    <div class="row">
        <div class="col-3">
            <?= $form->field($searchModel, 'carName') ?>
        </div>
        <div class="col-3">
            <?= $form->field($searchModel, 'mark') ?>
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

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="js-wrap-item-<?=$user->id?>">
                    <?= DemoWidget::widget(['user' => $user])?>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

    <!-- 3) Пагинация -->
    <div class="row">
        <?= LinkPager::widget(['pagination' => $dataProvider->pagination])?>
    </div>
</div>
