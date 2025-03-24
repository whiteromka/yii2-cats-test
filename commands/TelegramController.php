<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\telegram\TelegramMessenger;
use yii\console\Controller;
use yii\console\ExitCode;

class TelegramController extends Controller
{
    // php yii Telegram/index
    public function actionIndex()
    {
        $tg = (new TelegramMessenger())->send('Hey bro!');
        return ExitCode::OK;
    }
}
