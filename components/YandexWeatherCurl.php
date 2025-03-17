<?php

namespace app\components;

use Yii;
use yii\log\Logger;

class YandexWeatherCurl
{
    private float $lat;
    private float $lon;

    public function __construct(float $lat, float $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function request(): array
    {
        try {
            $accessKey = Yii::$app->params['YW'];
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.weather.yandex.ru/v2/forecast?lat={$this->lat}&lon={$this->lon}",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 10, // !!!
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET', // !!!
                CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'X-Yandex-Weather-Key: ' . $accessKey],
            ]);
            $response = curl_exec($curl);
            curl_close($curl);

            $data = json_decode($response, true);
            $data = $this->reconstructData($data);
            return $data;
        } catch (\Exception $e) {
            $error = $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine();
            $loger = Yii::getLogger();
            $loger->log(
                $error,
                Logger::LEVEL_ERROR
            );
            return [
                'error' => 'Ой беда. Уже чиним'
            ];
        }
    }

    private function reconstructData(array $data): array
    {
        $winDir = $data['fact']['wind_dir'];
        // n e w s // $this->reconstructWinDir($winDir);
        return [
            'lat' => $data['info']['lat'],
            'lon' => $data['info']['lon'],
            'season' => $data['fact']['season'],
            'temp' => $data['fact']['temp'],
            'winDir' => $winDir,
            'winSpeed' => $data['fact']['wind_speed']
        ];
    }
}