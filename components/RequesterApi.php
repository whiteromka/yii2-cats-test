<?php

namespace app\components;

class RequesterApi
{
    private string $method;
    private string $url;
    private $data;

    /** @var string|array [key => value, headerName => headerValue] */
    private array $headers;

    public function __construct(string $method, string $url, $data = null, array $headers = [])
    {
        $this->method = $method;
        $this->url = $url;
        $this->data = $data;
        $this->headers = $headers;
    }

    public function request()
    {
        $culrHeaders = [];
        $headers = $this->headers;
        foreach ($headers as $keyName => $headerValue) {
            $culrHeaders[] = $keyName . ': ' . $headerValue;
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_POSTFIELDS =>  $this->data,
            CURLOPT_HTTPHEADER => $culrHeaders,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);

        return $data;
    }
}