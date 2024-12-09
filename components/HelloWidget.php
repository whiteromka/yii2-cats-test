<?php

namespace app\components;

use yii\base\Widget;

class HelloWidget extends Widget
{
    // тут параметры для виджета (придумываем сами)
    public string $message;
    public string $name = '';

    private string $time;

    // тут код который автоматически сработает при вызове виджета
    public function init()
    {
        parent::init();
        // код...
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
        $this->time = date('d-m-Y H:i:s');
    }

    public function run()
    {
        $message = $this->message . ' ' . $this->name . ' ' . $this->time;
        return $this->render('hello', [
            'message' => $message,
            'name' => $this->name,
            'time' => $this->time
        ]);
    }
}