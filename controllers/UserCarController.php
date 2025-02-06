<?php

namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use Yii;
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
        $cache = Yii::$app->cache;
        $users = $cache->getOrSet('users', function() {
            $data = User::find()->joinWith('car')->all();
            return $data;
        }, 200);

        return $this->render('index', [
            'users' => $users,
        ]);
    }
}
