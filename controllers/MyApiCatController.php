<?php

namespace app\controllers;

use app\models\Cat;
use Yii;
use yii\web\Controller;

class MyApiCatController extends Controller
{

    // GET  /my-api-cat/get
    public function actionGet()
    {
        Yii::$app->response->headers->set('Rox-X', 'X');
        $cats = Cat::find()->limit(100)->all();
        Yii::$app->response->statusCode = 400;
        return $this->asJson($cats);
    }

    // POST /my-api-cat/add  {_name, age, gender}
    public function actionAdd()
    {
        // CSRF !!!

        //...
        $cat = new Cat();
        $cat->name = $_name;
        // ...
        if ($cat->save()) {
           $res = ['success' => true];
       } else {
           $res = ['success' => false];
        }
        return $this->asJson($res);
    }
}