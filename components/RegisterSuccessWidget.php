<?php

namespace app\components;

use yii\base\Widget;

class RegisterSuccessWidget extends Widget
{
    public string $message = 'Ура!';

    public function run()
    {
        return $this->render('register-success', [
            'message' => $this->message
        ]);
    }
}