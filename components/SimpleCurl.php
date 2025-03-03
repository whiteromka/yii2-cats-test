<?php

namespace app\components;

class SimpleCurl
{
    public  function request()
    {
        // REST API - Средство общения программ через http(s) протокол.

        // POST .../user/create {...} // создать пользователя
        // GET .../user/12 // получить данные о поль-е
        // POST .../user/delete/12 // удаление
        // POST .../user/update/12 {...} // обновление

        // GET — получение информации об объекте (ресурсе).
        // POST — создание нового объекта (ресурса).
        // PUT — полная замена объекта (ресурса) на обновленную версию.
        // PATCH — частичное изменение объекта (ресурса).
        // DELETE — удаление информации об объекте (ресурсе).

        // Статус код - это признак успешности выполнения запроса
        //      200 20X 2XX // хорошо
        //      400 4XX // плохой запрос. Т.е. ошибка на стороне которая отправила запрос
        //      500 ... // сервер сломался. Т.е. ошибка на стороне которая принимает запрос
        //      100 // информационные
        //      300 // редирект

        //    {
        //        "userId" : 1,
        //        "id": 111111,
        //        "title": "testRom",
        //        "body": "test body"
        //    }






        $data = [
            "userId" => 2,
            "id" => 111111,
            "title" => "!!!!!!!!!!!!!!!!!!!!!!!!!testRom34444",
            "body" => "test body6666"
        ];
        $dataJson = json_encode($data);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://jsonplaceholder.typicode.com/posts',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30, // !!!
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST', // !!!

            CURLOPT_POSTFIELDS => $dataJson,
            //'{
//                "userId" : 1,
//                "id": 111111,
//                "title": "testRom222",
//                "body": "test body444"
//            }',

            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $responseAsArray = json_decode($response, true);
        debug($responseAsArray);

        //

//        [
//            'success' => false,
//            'error' => '',
//            'data' => []
//        ]
        die;
    }
}