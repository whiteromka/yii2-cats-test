<?php

namespace app\controllers;

use app\components\CartCalculator;
use app\components\CartWidget;
use app\models\Cart;
use app\models\CartItem;
use app\models\Cat;
use app\models\Order;
use Yii;
use yii\web\Controller;

class CartController extends Controller
{
    /** // http://yii2-lessons.local/cart/add?id=316
     * Добавить кота в корзину
     *
     * @param int $id - ID кота для добавления в корзину
     */
    public function actionAdd(int $id)
    {
        // табл:
        // cart: id, sum, discount_percent, final_sum, status
        // cart_item: id, cart_id, cat_id, price
        // order: id, cart_id, status
        /** @var Cat $cat */
        $cat = Cat::find()->where(['id' => $id])->one();
        $cart = Cart::getActive();
        if ($cat) {
            $successCartItemSave = CartItem::create($cart->id, $id, $cat->price);
            if ($successCartItemSave) {
                $success = (new CartCalculator($cart, $cat))->calculate();
                if ($success) {
                    Yii::$app->session->setFlash('success', 'Кот успешно добавлен в корзину!');
                }
            }
        }

        return $this->redirect(['/']);
    }

    /** // http://yii2-lessons.local/cart/add-ajax?id=316
     * Добавить кота в корзину
     *
     * @param int $id - ID кота для добавления в корзину
     */
    public function actionAddAjax(int $id)
    {
        /** @var Cat $cat */
        $cat = Cat::find()->where(['id' => $id])->one();
        $cart = Cart::getActive();
        if ($cat) {
            $successCartItemSave = CartItem::create($cart->id, $id, $cat->price);
            if ($successCartItemSave) {
                $success = (new CartCalculator($cart, $cat))->calculate();
                if ($success) {
                   return $this->asJson([
                       'success' => 1,
                       'error' => '',
                       'html' => CartWidget::widget()
                   ]);
                }
            }
        }

        return $this->asJson([
            'success' => 0,
            'error' => 'Произошла ошибка в расчетах!',
            'html' => ''
        ]);
    }

    /**
     * Страница просмотра всей коризны
     */
    public function actionIndex()
    {
        $cart = Cart::getActive();
        return $this->render('index', [
           'cart' => $cart,
           'cartItems' => $cart->cartItems,
        ]);
    }

    /**
     * Экшен для создания заказа
     */
    public function actionCreateOrder()
    {
        $cart = Cart::getActive();
        $cart->status = 0;
        $cart->save();

        $order = new Order();
        $order->cart_id = $cart->id;
        $order->status = Order::IN_PROCESS;
        $order->save();

        return $this->redirect(['/']);
    }
}