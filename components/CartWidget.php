<?php

namespace app\components;

use app\models\Cart;
use yii\base\Widget;

class CartWidget extends Widget
{
    /** @var int Всего в корзине */
    private int $count = 0;

    /** @var int Процент скидки */
    private int $percent = 0;

    /** @var int Итоговая сумма */
    private int $finalSum = 0;

    public function init()
    {
        parent::init();
        $cart = Cart::getActive();
        $this->count = count($cart->cartItems);
        $this->percent = (int)$cart->discount_percent; // (int) - приведение к integer, почему-то без него крашится
        $this->finalSum = (int)$cart->final_sum;
    }

    public function run()
    {
        return $this->render('cart', [
            'count' => $this->count,
            'percent' => $this->percent,
            'finalSum' => $this->finalSum,
        ]);
    }
}