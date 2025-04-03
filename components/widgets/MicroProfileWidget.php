<?php

namespace app\components\widgets;

use yii\base\Widget;

class MicroProfileWidget extends Widget
{
    public function run()
    {
        return $this->render('microProfile');
    }
}