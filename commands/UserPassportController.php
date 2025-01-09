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
    public function actionIndex()
    {
        // Тут должен выполняться код который сгенерит много пользователей и паспортов
        $creator = new UserPassportCreator();
        $creator->run();
        return ExitCode::OK;
    }
}
