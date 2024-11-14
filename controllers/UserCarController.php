<?php

namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;

class UserCarController extends Controller
{
    /**
     * Страница просмотра пользователей и их машин
     *
     * @return string
     */
    public function actionIndex()
    {
        $users = User::find()->all();
        return $this->render('index', [
            'users' => $users,
        ]);
    }
}
