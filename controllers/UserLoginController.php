<?php

namespace app\controllers;

use app\models\User;
use yii\web\Controller;
use Yii;

class UserLoginController extends Controller
{
    // /user-login/login
    public function actionLogin()
    {
        // POST
        $email = 'fgordeev@bk.ru';
        $password = 'aaaaaa'; //12345

        /** @var User $user */
        $user = User::find()->where(['email' => $email])->one();
        if ($user) {
            $ps = $user->generatePasswordHash($password); // 12345
            if ($ps === $user->password_hash) {
                Yii::$app->user->login($user);
            }
        }

        return $this->redirect('/');
    }

    // /user-login/logout
    public function actionLogout()
    {
        return $this->redirect('/');
    }
}