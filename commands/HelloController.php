<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\CatCalculatorSingleton;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * php yii hello/index
     */
    public function actionIndex()
    {
        $cc = CatCalculatorSingleton::getInstance(); // 1
        echo $cc->result() . PHP_EOL;
        echo $cc->aaa() . PHP_EOL;

        $cc2 = CatCalculatorSingleton::getInstance(); // 1
        echo $cc2->result() . PHP_EOL;

        $cc3 = CatCalculatorSingleton::getInstance(); //1
        echo $cc3->result() . PHP_EOL;

        $cc4 = CatCalculatorSingleton::getInstance(); //1
        echo $cc4->result() . PHP_EOL;
        echo $cc4->aaa() . PHP_EOL;

        die;
    }
}
