<?php

namespace app\controllers;

use app\components\Agent;
use app\models\Account;
use app\models\Car;
use app\models\Cat;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class TestController extends Controller
{
    // url: .../test/test
   public function actionTest()
   {
       //....
       $agent = new Agent();
       $agent->setName('Rom')->setAge(35)->setEmail('Rom@gmail.com');

       debug($agent);
       die;
   }

   // url: .../test/test-sql
    public function actionTestSql()
    {
        // выбрать только уникальные породы
        $cats = Cat::find()->select('breed')->distinct()->all();

        // выбрать все котов где
        // возраст меньше 5 и цена больше 20000
        // или Персидский или Абиссинская
        $q = Cat::find()->select('*')
            ->from('cat')
            ->where([
                'AND',
                ['<', 'age', 5],
                ['>', 'price', 20000]
            ])
            ->orWhere(['breed' => 'Персидский'])
            ->orWhere(['breed' => 'Абиссинская']);
        $sql = $q->createCommand()->rawSql; // Важно !!!

        debug($sql);
        die;
    }

}
