<?php

use app\models\Cat;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CatSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cats!!!!!'; // Это служебный тег Title
$this->params['breadcrumbs'][] = $this->title; // Это хлебные крошки
$this->params['breadcrumbs'][] = 'Моя страница';
$this->params['breadcrumbs'][] = '1';
?>
<div class="cat-index">

    <!-- Это экранирование спец символов -->
    <h1><?= Html::encode("Cats!!!!!") ?></h1>

    <p>
        <?= Html::a('Добавить кота', ['create'], ['class' => 'btn btn-success']) ?>
<!--        <a href="/cat/create" class="btn btn-success">Добавить кота</a>-->
    </p>

<!--    --><?php //echo $this->render('_search', [
//            'model' => $searchModel
//    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'age',
            'gender',
            'price',
            'breed',
            'aaaa_aaa2', // мое кастомное поле. У кота нет этой характеристики
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cat $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
