<?php

namespace app\components;

use Yii;

class CurlApi
{
    private string $method;
    private string $url;
    private $data;
    /** @var string|array [key => value, headerName => headerValue] */
    private array $headers;

    private array $reconstructedData = [];

    public function getReconstructedData(): array
    {
        return $this->reconstructedData;
    }

    public function __construct(string $method, string $url, $data = [], array $headers = [])
    {
        $this->method = $method;
        $this->url = $url;
        $this->data = $data;
        $this->headers = $headers;
    }

    public function request(): void
    {
        $curlHeaders = [];
        $headers = $this->headers;
        foreach ($headers as $headerKey => $header) {
            $curlHeaders[] = $headerKey . ': ' . $header;
        }

        $curlOptions = [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10, // !!!
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_HTTPHEADER => $curlHeaders,
        ];
        if ($this->data) {
            $curlOptions[CURLOPT_POSTFIELDS] = $this->data;
        }

        $curl = curl_init();
        curl_setopt_array($curl, $curlOptions);
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $data = json_decode($response, true);
        $this->reconstructedData = $this->reconstructData($data, $httpCode);
    }

    private function reconstructData(array $data, int $httpCode)
    {
        return [
            'code' => $httpCode,
            'data' => $data,
        ];
    }

    public function getLatAndLon(): array
    {
        $data = $this->reconstructedData['data'];
        if (array_key_exists(0, $data)) {
            return [
                'success' => true,
                'data' => [
                    'lat' => $data[0]['geo_lat'],
                    'lon' => $data[0]['geo_lon']
                ]
            ];
        }
        return [
            'success' => false,
            'data' => []
        ];
    }

    //         $method = 'POST';
    //        $url = "https://cleaner.dadata.ru/api/v1/clean/address";
    //        $headers = [
    //            'Authorization' => 'Token ' . Yii::$app->params['DadataApiKey'],
    //            'X-Secret' => Yii::$app->params['DadataSecretKey'],
    //            'Content-Type' =>  'application/json'
    //        ];
    //        $data = '["Мурманск"]';
    //        $api = new CurlApi($method, $url, $data, $headers);
    //        $api->request();
    //        $data = $api->getLatAndLon();
    //        $a =1;
}