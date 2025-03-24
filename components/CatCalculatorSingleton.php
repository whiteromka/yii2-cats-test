<?php

namespace app\components;

use app\models\Cat;

class CatCalculatorSingleton
{
    // тут будет экземпляр объекта этого класса
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        echo "Был создан новый CatCalculatorSingleton " . microtime() . PHP_EOL;
    }

    private function __clone() {}

    public function __wakeup() {} // при десериализации


    public function result()
    {
        // ..
        return 1 + 10 ;
    }

    public function aaa()
    {
        // ..
        return 'aaaaa';
    }

}
