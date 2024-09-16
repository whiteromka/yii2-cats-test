<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property int $gender
 * @property string $password_hash
 * @property int $status
 * @property string $breed
 * @property string $created_at
 * @property string|null $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    public const GENDER_MALE = 'М';
    public const GENDER_FEMALE = 'Ж';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 60],
            [['last_name'], 'string', 'max' => 60],
            [['password_hash'], 'string', 'max' => 100],
            [['name', 'last_name', 'email', 'password_hash', 'status'], 'required'],
            [['status'], 'integer'],
            ['status', 'in', 'range' => [0, 1]],
            [['gender'], 'integer'],
            ['gender', 'in', 'range' => [0, 1]],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['created_at', 'updated_at'], 'safe']
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
            'last_name' => 'Фамилия',
            'password_hash' => 'Хэш пароля',
            'status' => 'Статус',
            'email' => 'email',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'gender' => 'Пол'
        ];
    }

    public static function getGenders(): array
    {
        return [
            0 => User::GENDER_FEMALE,
            1 => User::GENDER_MALE
        ];
    }
}
