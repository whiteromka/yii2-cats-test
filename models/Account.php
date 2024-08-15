<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property string $name
 * @property string|null $last_name
 * @property string $phone
 * @property string|null $email
 * @property int $passport_number
 * @property int $balance
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'passport_number', 'balance'], 'required'],
            [['passport_number', 'balance'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['last_name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'min'=>3, 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'passport_number' => 'Passport Number',
            'balance' => 'Balance',
        ];
    }
}
