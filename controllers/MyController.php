<?php

namespace app\controllers;

use yii\web\Controller;

class MyController extends Controller
{
    /**
     * Тестовый экшен // .../my/show-date
     *
     * @return string
     */
    public function actionShowDate()
    {
        $date = (string)date('d.m.Y H:i'); // string
        return $this->render('show-date',
            ['date' => $date]
        );
    }
}