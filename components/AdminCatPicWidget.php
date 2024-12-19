<?php

namespace app\components;

use app\models\Cat;
use app\models\CatPic;
use yii\base\Widget;

class AdminCatPicWidget extends Widget
{
    // тут параметры для виджета (придумываем сами)
    public Cat $cat;
    public CatPic $catPic;

    // тут код который автоматически сработает при вызове виджета
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('admin-cat-pic', [
            'cat' => $this->cat,
            'catPic' => $this->catPic
        ]);
    }
}