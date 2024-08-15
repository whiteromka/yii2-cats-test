<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat".
 *
 * @property int $id
 * @property string $name
 * @property int $age
 * @property int $gender
 * @property int|null $price
 * @property string $breed
 */
class Cat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'min' => 12],
            [['name', 'age', 'gender', 'breed'], 'required'],
            [['age', 'gender', 'price'], 'integer'],
            [['name', 'breed'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'age' => 'Age',
            'gender' => 'Gender',
            'price' => 'Price',
            'breed' => 'Порода',
        ];
    }
}
