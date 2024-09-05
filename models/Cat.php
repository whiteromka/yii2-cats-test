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
            [['name'], 'string', 'min' => 3],
            [['age'], 'integer', 'max' => 5],
            [['price'], 'integer', 'max' => 1000],
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
            'age' => 'Возраст',
            'gender' => 'Пол',
            'price' => 'Цена',
            'breed' => 'Порода',
        ];
    }

    /**
     * Вернет ошибки валидации если они есть
     */
    public function getPrettyErrors(): array
    {
        $prettyErrors = [];

        $errors = array_values($this->getErrors());
//        [
//            0 => [
//                0 => 'Значение «Возраст» не должно превышать 5.',
//            ],
//            1 => [
//                0 => 'Значение «Цена» не должно превышать 1000.',
//            ]
//        ];

        foreach ($errors as $errorList) {
            foreach ($errorList as $error) {
                $prettyErrors[] = $error;
            }
        }
        return $prettyErrors;
// $prettyErrors
//        [
//            'Значение «Возраст» не должно превышать 5.',
//            'Значение «Цена» не должно превышать 1000.'
//        ];

    }


}
