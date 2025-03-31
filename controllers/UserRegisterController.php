<?php

namespace app\controllers;

use app\components\RegisterSuccessWidget;
use app\models\User;
use yii\web\Controller;
use Yii;

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
                Yii::$app->session->setFlash('success', 'Пользователь ' . $user->name . ' зарегистрирован!');
                return $this->redirect('/user-register/register');
            }
        }

        return $this->render('register', [
            'user' => $user
        ]);
    }

    // user-register/register-ajax
    public function actionRegisterAjax()
    {
        $user = new User();
        return $this->render('register-ajax', [
            'user' => $user
        ]);
    }

    public function actionRegisterAjaxLogic()
    {
        $error = '';
        $user = new User();

        if ($user->load(Yii::$app->request->post())) {
            if ($user->password) {
                $user->password_hash = $user->generatePasswordHash($user->password);
            }
            $resultValidation = $user->validate();
            if ($resultValidation) {
                if ($user->save()) {
                    return $this->asJson([
                        'success' => true,
                        'html' => RegisterSuccessWidget::widget(),
                        'error' => $error,
                    ]);
                } else {
                    $error = 'Не валидные данные в запросе';
                }
            }
        }

        return $this->asJson([
            'success' => false,
            'html' => '',
            'error' => $error ? $error : 'Не получилось зарегистрировать пол-ля',
        ]);
    }
}