<?php

namespace app\components;

use app\models\User;
use yii\base\Widget;

class DemoWidget extends Widget
{
    public User $user;

    public function run()
    {
        return $this->render('demo', [
            'user' => $this->user,
        ]);
    }
}