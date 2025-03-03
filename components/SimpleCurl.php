<?php

namespace app\components;

class SimpleCurl
{
    public  function request()
    {
        // post
        // {
        //    "userId": 1,
        //    "id": 1,
        //    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
        //    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
        //}

        //    {
        //        "userId" : 1,
        //        "id": 111111,
        //        "title": "testRom",
        //        "body": "test body"
        //    }

        //      200 20X 2XX // хорошо
        //      400         // плохой запрос
        //      500 // сервер сломался
        //      100 // авторизация ???
        //      300 // редирект ?

        //REST API
        // POST .../user/create {...} // создать пользователя
        // GET .../user/12 // получить данные о поль-е
        // POST .../user/delete/12 // удаление
        // POST .../user/update/12 {...} // обновление

        // GET .../user-by-email/rom@yandex.ru // получить данные о поль-е
        // DELETE .../user/12
        // PUT .../user/create {...} // обновление данных о существ пол-е
        // PUCH .../user/create {...} // обновление данных о существ пол-е
        // HEAD //

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