<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'last_name',
            'email:email',
            'password_hash',

            [
                'attribute' => 'status',
                'filter' => User::getStatuses(), // выпадающий список
                'value' => function(User $user) { // отображение значений в строках
                    if ($user->status === 1) {
                        return 'active';
                    } else {
                        return 'disactive';
                    }
                }
            ],
//            [
//                'attribute' => 'gender',
//                'filter' => [0 =>'девочка', 1 => 'мальчик'],
//                'value' => function (Cat $model) {
//                    return $model->gender == 1 ? 'мальчик' : 'девочка';
//                }
//            ],

            'created_at',
            'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
