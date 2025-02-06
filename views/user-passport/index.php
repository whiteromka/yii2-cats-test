<?php

use app\assets\UserSearchAsset;
use app\models\Status;
use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserUniversalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = 'Пользователи с паспортами';
UserSearchAsset::register($this);
?>
<div class="user-index">

    <h1>Пользователи с паспортами</h1>

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
            <div class="user-passport-item">
                <h3>
                    <span> <?= $user->id ?> </span>
                    <?= $user->name ?>
                    <?= $user->last_name ?>
                </h3>
                <p> email: <?= $user->email ?></p>
                <p> gender: <?= $user->getGenderChar() ?></p>

                <p>
                    <?php $cssId = 'status-id-' . $user->id?>
                    status: <span id="<?= $cssId?>"><?= $user->getStatusAsString() ?></span>

                    <?php if ($user->status_id !== Status::STATUS_DISACTIVE) : ?>
                        <a class="btn btn-sm btn-warning js-btn-disactive"
                           href="/user-passport/disactive-status?id=<?= $user->id?>"
                           data-user-id="<?= $user->id?>"
                        >
                            Set disactive
                        </a>
                    <?php endif;?>
                </p>

                <p> country: <?= $user->passport->country ?? '' ?></p>
                <p> passport number: <?= $user->passport->number ?? '' ?></p>
                <?php if ($user->car) {?>
                    <p> car: <?= $user->car->name ?? '' ?></p>
                    <p> mark: <?= $user->car->mark ?? '' ?></p>
                <?php } ?>
            </div>
        </div>

        <?php endforeach; ?>
    </div>

    <!-- 3) Пагинация -->
    <div class="row">
        <?= LinkPager::widget(['pagination' => $dataProvider->pagination])?>
    </div>
</div>
