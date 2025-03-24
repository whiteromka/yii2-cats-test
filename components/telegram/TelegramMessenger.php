<?php

// 1) В TG найти BotFather  и в нем создать нового бота. С определенным name и username.
// name: yii2-lessons_bot
// username: yii2_lessons_bot

// Нужно получить АПИ ТОКЕН:
// BotFather последним сообщение отдаст апи токен для вашего бота

// и ссылку на апи телеги:
// https://core.telegram.org/bots/api
// https://core.telegram.org/bots/api#making-requests
// https://core.telegram.org/bots/api#sendmessage

// 2) Нужно создать новую группу. И туда добавить нашего бота по имени "yii2-lessons_bot"

// 3) Нужно узнать ID чата этой новой группы.
// Для этого добавляем в группу еще одного бота по имени "Get My ID" (это уже существующий бот его не нужно создавать).
// Этот бот после добавления в группу напишет ID группового чата. В формате: -XXXX.... Минус обязателен!

namespace app\components\telegram;

use app\components\RequesterApi;
use Yii;

class TelegramMessenger
{
    private string $token;
    private int $chatId;

    public function __construct()
    {
        $this->token = Yii::$app->params['Telegram']['token'];
        $this->chatId = Yii::$app->params['Telegram']['chatId'];
    }

    public function send(string $message)
    {
        $apiUrl = "https://api.telegram.org/bot{$this->token}/sendMessage";
        $data = [
            'chat_id' => $this->chatId,
            'text' => $message,
            'parse_mode' => 'HTML',
        ];
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $requester = new RequesterApi(
            'POST',
            $apiUrl,
            http_build_query($data),
            $headers
        );
        $requester->request();
    }


}