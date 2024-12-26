<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int $sum
 * @property int $discount_percent
 * @property int $final_sum
 * @property string $created_at
 * @property string|null $updated_at
 * @property int status
 *
 * @property CartItem[] $cartItems
 * @property Order $order
 */
class Cart extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sum', 'status', 'discount_percent', 'final_sum'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sum' => 'Sum',
            'discount_percent' => 'Discount Percent',
            'final_sum' => 'Final Sum',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CartItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartItems()
    {
        return $this->hasMany(CartItem::class, ['cart_id' => 'id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['cart_id' => 'id']);
    }

    /**
     * @return Cart
     */
    public static function getActive()
    {
        $cart = self::find()->where(['status' => 1])->one();
        if (!$cart) {
            $cart = new Cart();
            $cart->status = 1;
            $cart->save();
        }
        return $cart;
    }

    /**
     * Получить процент от суммы в виде кол-ва руб.
     */
    public function getPercentDiscountSum(): int
    {
        $sum = $this->final_sum;
        $percent = $this->discount_percent;
        $discountAsFloat = $sum * ($percent / 100);
        return ceil($discountAsFloat);
    }
}
