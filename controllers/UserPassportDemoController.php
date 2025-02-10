<?php

namespace app\controllers;

use app\components\DemoWidget;
use app\models\Status;
use app\models\User;
use app\models\UserUniversalSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * UserPassportController implements the CRUD actions for User model.
 */
class UserPassportDemoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    /**
     * user-passport-demo/demo
     * Поиск поль-ей
     *
     * @return string
     */
    public function actionDemo()
    {
        $searchModel = new UserUniversalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('demo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Деактивация статуса пользователя
     */
    public function actionDisactiveStatusAjax(int $id)
    {
        // Найти нужного пользователя
        /** @var User $user */
        $user = User::find()->where(['id' => $id])->one();

        // Деактивировать и сохранить
        $user->status_id = Status::STATUS_DISACTIVE;
        $saveResult = $user->save();

        return $this->asJson([
            'success' => $saveResult ? 1 : 0,
            'error' => $saveResult == false ? 'Произошла ошибка сохранения' : '',
            'html' => DemoWidget::widget(['user' => $user])
        ]);
    }
}
