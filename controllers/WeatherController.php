<?php

namespace app\controllers;

use app\components\DadataApi;
use app\components\RequesterApi;
use app\components\YandexWeatherCurl;
use Yii;
use yii\web\Controller;

class WeatherController extends Controller
{
    // weather/index?lat=33&lon=22
    public function actionIndex(float $lat = 1, float $lon = 1)
    {
        $data = (new YandexWeatherCurl($lat, $lon))->request();
        // return $this->asJson($data); // если раскоментить то это будет работать как наше АПИ
        return $this->render('index', ['data' => $data]);
    }

    // Получить данные о погоде по названию города пол-ля
    // weather/weather
    public function actionWeather()
    {
        // 1 по городу получить широту и долготу
//        $city = 'Архангельск';
//        $geoData = (new DadataApi($city))->request();

        //1 Получаем IP $_SERVER['X_']  // 127.0.0.1 //93
        // 1.1 IP
        // 1.2 IP >>> Dadata API
        // 1.3


         $city = 'Архангельск';
         $geoData = (new DadataApi($city))->request();

        // 2 по широте и долготе отдает погоду X
        if ($geoData) {
            $data = (new YandexWeatherCurl($geoData['lat'], $geoData['lon']))->request();
        }
        debug($data);
        die;
    }

}
