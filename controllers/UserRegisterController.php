<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;

class UserRegisterController extends Controller
{
    // user-register/register
    public function actionRegister()
    {
        $user = new User();
        if ($user->load(Yii::$app->request->post())) {
            if ($user->password) {
                $user->password_hash = $user->generatePasswordHash($user->password);
            }
            $resultValidation = $user->validate();
            if ($resultValidation) {
                $user->save();
                Yii::$app->session->setFlash('success','Пользователь ' . $user->name . ' зарегистрирован!');
                return $this->redirect('/user-register/register');
            }
        }

        return $this->render('register', [
            'user' => $user
        ]);
    }
}