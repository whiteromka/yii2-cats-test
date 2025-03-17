<?php

namespace app\components;

use Yii;

class DadataApi
{
    private string $city;

    public function __construct(string $city)
    {
        $this->city = $city;
    }

    public function request(): array
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' =>  'Token ' . Yii::$app->params['DadataApiKey'],
            'X-Secret' => Yii::$app->params['DadataSecretKey']
        ];
        $requester = new RequesterApi(
            'POST',
            'https://cleaner.dadata.ru/api/v1/clean/address',
            '[ "' . $this->city . '" ]',
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

        return $geoData;
    }
}