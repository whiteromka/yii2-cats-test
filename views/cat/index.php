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
            [
                'attribute' => 'Фото',
                'format' => 'html',
                'value' => function (Cat $cat) {
                    $pics = $cat->catPics;
                    $html = '';
                    if ($pics) {
                        foreach ($pics as $pic) {
                            $html .= Html::img($pic->pic_name, [
                                'width' => 100,
                                'alt' => 'Тут кот с именем' . $cat->name,
                                'title' => 'Тут кот с именем' . $cat->name
                            ]);
                        }
                        return $html;
                    }
                    return 'no';
                }
            ],
            'name',
            'age',
            [
                'attribute' => 'gender',
                'filter' => [0 =>'девочка', 1 => 'мальчик'],
                'value' => function (Cat $model) {
                    return $model->gender == 1 ? 'мальчик' : 'девочка';
                }
            ],
            'price',
            'breed',
            'aaa1', // Мое кастомное поле. У кота нет этой характеристики

            // Другое кастомное поле
//            [
//                    'attribute' => 'aaa2',
//                    'value' =>  function (Cat $model) {
//                          // ... тут код ...
//                        return $model->name  . '-' . $model->age;
//                    }
//            ],
            [
                'template' => '{update} {delete} {pic}', // какие кнопки отображать ({view} - глаз {update}, - карандаш, {delete} - корзина)
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Cat $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'pic' => function ($url, Cat $cat, $key) {
                        return Html::a(
                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                                 <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/>
                             </svg>',
                            ['cat/pic', 'id' => $cat->id]
                        );
                    },
                ],

            ],


//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{view} {update} {delete} {custom}', // Добавляем вторую кнопку
//                'buttons' => [
//                    'custom' => function ($url, $model, $key) {
//                        return Html::a('Кастомная кнопка', ['your-controller/your-action', 'id' => $model->id], [
//                            'class' => 'btn btn-success',
//                            'data-method' => 'post',
//                        ]);
//                    },
//                ],
//            ],

        ],
    ]); ?>


</div>
