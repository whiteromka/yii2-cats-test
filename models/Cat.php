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

    /** Этот метод нужно вынести в CatCreator
     * Получить случайное котоимя
     */
    public static function getRandomName($isBoy = true): string
    {
        $boys = [
            'Ethan', 'Liam', 'Noah', 'Lucas', 'Oliver', 'Benjamin', 'Logan', 'William', 'Alexander', 'Elijah',
            'James', 'Gabriel', 'Michael', 'Daniel', 'Anthony', 'Christopher', 'Joshua', 'Mason', 'Andrew', 'Samuel',
            'Julian', 'Owen', 'Caleb', 'Jaxon', 'Hunter', 'Landon', 'Aiden', 'Gavin', 'Cameron', 'Cooper' , 'A', 'B', 'C', 'D', 'E',
        ];

        $gils = [
            'Emma', 'Olivia', 'Ava', 'Sophia', 'Mia', 'Isabella', 'Charlotte', 'Amelia', 'Harper', 'Evelyn',
            'Abigail', 'Emily', 'Hannah', 'Madison', 'Victoria', 'Jessica', 'Samantha', 'Avery', 'Riley', 'Zoe',
            'Lily', 'Grace', 'Natalie', 'Savannah', 'Julia', 'Peyton', 'Hailey', 'Kayla', 'Sarah', 'Lauren',
        ];

        if ($isBoy) {
            $key = array_rand($boys);
            return $boys[$key];
        } else {
            $key = array_rand($gils);
            return $gils[$key];
        }
    }

    /** Этот метод нужно вынести в CatCreator
     *  Вернет случайную котопороду
     */
    public static function getRandomBreed(): string
    {
        $breeds = ['Британская короткошёрстная', 'Сиамская', 'Абиссинская', 'Персидская'];
        $key = array_rand($breeds);
        return $breeds[$key];
    }
}
