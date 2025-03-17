<?php

namespace app\controllers;

use app\models\Cat;
use yii\rest\ActiveController;

class ApiCatController extends ActiveController
{
    public $modelClass = Cat::class;
}