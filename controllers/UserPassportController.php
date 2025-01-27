<?php

namespace app\controllers;

use app\models\UserUniversalSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * UserPassportController implements the CRUD actions for User model.
 */
class UserPassportController extends Controller
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
     * Поиск поль-ей
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserUniversalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
