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
 * @property int $status_id
 * @property string $breed
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Status $status
 * @property Car $car
 */
class User extends \yii\db\ActiveRecord
{
    /** @var string - пол мужской */
    public const GENDER_MALE = 'М';

    /** @var string - пол женский */
    public const GENDER_FEMALE = 'Ж';

    public const STATUS_ACTIVE = 'active';
    public const STATUS_DISACTIVE = 'disactive';

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
            [['name', 'last_name', /*'email',*/ 'password_hash', 'status_id'], 'required'],
            [['status_id'], 'integer'],
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
            'status_id' => 'Статус ID',
            'email' => 'email',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'gender' => 'Пол'
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    public function getCar()
    {
        return $this->hasOne(Car::class, ['id' => 'car_id']);
    }

    public static function getGenders(): array
    {
        return [
            0 => User::GENDER_FEMALE,
            1 => User::GENDER_MALE
        ];
    }

    /**
     * Получить все возможные статусы
     */
    public static function getStatuses(): array
    {
        return [
            0 => User::STATUS_DISACTIVE,
            1 => User::STATUS_ACTIVE
        ];
    }
}
