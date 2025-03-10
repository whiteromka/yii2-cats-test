<?php

namespace app\controllers;

use app\components\SimpleCurl;
use yii\web\Controller;

class WeatherController extends Controller
{
    // site/curl?lat=1&lon=2
    public function actionIndex(float $lat = 1, float $lon = 1)
    {
        $data = (new SimpleCurl($lat, $lon))->request();
        // return $this->asJson($data); // если раскоментить то это будет работать как наше АПИ
        return $this->render('index', ['data' => $data]);
    }

}
