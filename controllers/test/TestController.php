<?php

namespace app\controllers\test;

use app\models\test\Man;

class TestController
{
    public function actionTest()
    {
        // создадим человека
        $anna = new Man();
        $anna->id = 1;
        $anna->name = 'Anna';
        $anna->age = 10;

        // Получим все болячки Анны
        $annaDiseases = $anna->getMyDiseases();

        // Получим все болячки которые вообще бывают у людей
        $diseases = Man::getAllDiseases();
    }
}