<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $name
 * @property string|null $year
 * @property string|null $mark
 */
class Car extends ActiveRecord
{
//    /**
//     * {@inheritdoc}
//     */
//    public static function tableName()
//    {
//        return 'car';
//    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'year', 'mark'], 'string', 'max' => 255],
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
            'year' => 'Год',
            'mark' => 'Марка',
        ];
    }
}
