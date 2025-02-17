<?php

namespace app\controllers;

use yii\web\Controller;

class DesignController extends Controller
{
    public $layout = 'mainDesign';

    //  design/index
    public function actionIndex() {
        return $this->render('index', [
            'name' => 'Rom'
        ]);
    }
}