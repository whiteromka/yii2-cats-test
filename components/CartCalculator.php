<?php

namespace app\components;

use app\models\Cart;
use app\models\Cat;

class CartCalculator
{
    private Cart $cart;
    private Cat $cat;

    public function __construct(Cart $cart, Cat $cat)
    {
        $this->cart = $cart;
        $this->cat = $cat;
    }

    public function calculate(): bool
    {
        $this->cart->sum = $this->cart->sum + $this->cat->price;
        if ($this->cart->sum >= 100000) {
            $this->cart->discount_percent = 1;
        }
        $this->cart->final_sum = ($this->cart->discount_percent > 0) ?
            $this->cart->sum - $this->cart->getPercentDiscountSum() :
            $this->cart->sum;

        return $this->cart->save();
    }
}
