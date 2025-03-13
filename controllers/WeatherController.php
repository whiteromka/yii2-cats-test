<?php

namespace app\controllers;

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
        $city = 'Архангельск';

        // 1 по городу получить широту и долготу
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' =>  'Token ' . Yii::$app->params['DadataApiKey'],
            'X-Secret' => Yii::$app->params['DadataSecretKey']
        ];
        $requester = new RequesterApi(
            'POST',
            'https://cleaner.dadata.ru/api/v1/clean/address',
            '[ "' . $city . '" ]',
            $headers
        );
        $data = $requester->request();
        if (array_key_exists(0, $data)) {
            $d = $data[0];
            $geoData = [
                'lat' => $d['geo_lat'],
                'lon' => $d['geo_lon']
            ];
        } else {
            $geoData = [];
        }

        // 2 по широте и долготе отдает погоду X
        if ($geoData) {
            $data = (new YandexWeatherCurl($geoData['lat'], $geoData['lon']))->request();
        }
        debug($data);
        die;
    }

}
