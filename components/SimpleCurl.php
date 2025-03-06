<?php

namespace app\components;

class SimpleCurl
{
    public  function request(int $id, string $type)
    {

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://jsonplaceholder.typicode.com/' . $type . '/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10, // !!!
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET', // !!!
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        $responseAsArray = json_decode($response, true);
        debug($responseAsArray);
        die;

    }


    // REST API - Средство общения программ через http(s) протокол.

    // Методы запроса:
    // POST .../user/create {...} // создать пользователя
    // GET .../user/12 // получить данные о поль-е
    // POST .../user/delete/12 // удаление
    // POST .../user/update/12 {...} // обновление

    // GET — получение информации об объекте (ресурсе).
    // POST — создание нового объекта (ресурса).
    // PUT — полная замена объекта (ресурса) на обновленную версию.
    // PATCH — частичное изменение объекта (ресурса).
    // DELETE — удаление информации об объекте (ресурсе).

    // HEAD - Запрашивает заголовки ответа без тела. Получение метаданных о ресурсе, например,
    // статуса или длины содержимого, без загрузки данных.
    // OPTIONS - Получение доступных методов

    // Коды ответов:
    // Статус код - это признак успешности выполнения запроса
    //      200 20X 2XX // хорошо
    //      400 4XX // плохой запрос. Т.е. ошибка на стороне которая отправила запрос
    //      500 ... // сервер сломался. Т.е. ошибка на стороне которая принимает запрос
    //      100 // информационные - редко встречаются
    //      300 // редирект. Смысл в том что нужно выполнить повторный запрос на другому url

    // Пример ответа в json:
    //    {
    //        "userId" : 1,
    //        "id": 111111,
    //        "title": "testRom",
    //        "body": "test body"
    //    }
}