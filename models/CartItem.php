<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cart_item".
 *
 * @property int $id
 * @property int $cart_id
 * @property int $cat_id
 * @property int $price
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Cart $cart
 * @property Cat $cat
 */
class CartItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cart_id', 'cat_id', 'price'], 'required'],
            [['cart_id', 'cat_id', 'price'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['cart_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cart::class, 'targetAttribute' => ['cart_id' => 'id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cat::class, 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cart_id' => 'Cart ID',
            'cat_id' => 'Cat ID',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Cart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCart()
    {
        return $this->hasOne(Cart::class, ['id' => 'cart_id']);
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Cat::class, ['id' => 'cat_id']);
    }
}
