<?php

namespace app\commands;

use app\components\UserPassportCreator;
use yii\console\Controller;
use yii\console\ExitCode;

class UserPassportController extends Controller
{
    /**
     *  php yii user-passport/index
     */
    public function actionIndex(int $count = 20)
    {
        $creator = new UserPassportCreator($count);
        $creator->run();
        return ExitCode::OK;
    }
}
