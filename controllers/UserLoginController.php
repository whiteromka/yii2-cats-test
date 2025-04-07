<?php

namespace app\controllers;

use app\models\User;
use yii\web\Controller;
use Yii;
use yii\web\IdentityInterface;

class UserLoginController extends Controller
{
    /** /user-login/login */
    public function actionLogin()
    {
        // !!! отрефачить
        $error = '';
        $user = new User();
        $user->setScenario(User::SCENARIO_LOGIN);
        if ($user->load(Yii::$app->request->post())) {
            $passwordFromPost = $user->password;
            $emailFromPost = $user->email;
            if ($user->validate()) {
                /** @var IdentityInterface $user */
                $userFromDb = User::find()->where(['email' => $emailFromPost])->one();
                if ($userFromDb) {
                    $passwordHash = $userFromDb->generatePasswordHash($passwordFromPost);
                    if ($passwordHash === $userFromDb->password_hash) {
                        Yii::$app->user->login($userFromDb);
                        return $this->redirect(['/cat/index']);
                    }
                }
                $error = 'Не верные авторизационные данные';
            }
        }
        return $this->render('login', [
            'user' => $user,
            'error' => $error
        ]);
    }

    /** /user-login/logout */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/');
    }
}