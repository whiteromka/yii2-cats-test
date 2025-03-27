<?php

namespace app\components;

use app\models\Passport;
use app\models\User;
use Faker\Factory;
use Faker\Generator;
use Random\RandomException;
use Yii;
use yii\db\Exception;

/** Создать пользователей и паспорты */
class UserPassportCreator
{
    /** @var int - Кол-во создаваемых пол-ей */
    private int $count;
    
    /** @var Generator|null - Объект для генерации рандомных данных */
    private ?Generator $faker = null;

    /** @var int - Сложность хеширования пароля (4 - 31) */
    public const DIFICULTY_PASSWORD = 4;

    public function __construct(int $count = 20)
    {
        $this->count = $count;
        $this->faker = Factory::create();
    }

    /**
     * Метод создает пользователей и паспорта к ним
     */
    public function run(): void
    {
        echo 'Start processing user passport creator ' . PHP_EOL;
        for ($i = 0; $i < $this->count; $i++) {
            $user = $this->createUser();
            if ($user->id) {
                if (random_int(0, 1)) {
                    $this->createPassport($user->id);
                }
                echo '.';
            }
        }
        echo PHP_EOL .' End processing user passport creator ' . PHP_EOL;
    }

    /**
     * @throws Exception
     * @throws \yii\base\Exception
     * @throws RandomException
     */
    private function createUser(): User
    {
        $faker = $this->faker;
        $user = new User();
        $gender = $user->gender = random_int(0, 1);
        $user->name = $faker->firstName($gender);
        $user->last_name = $faker->lastName($gender);
        $user->email = $faker->email();
        $user->password_hash = $user->generatePasswordHash($faker->password());
        $user->status_id = (random_int(1, 10) > 1) ? 1 : 0;
        $user->save();
        return $user;
    }

    /**
     * Создать паспорт
     */
    private function createPassport(int $userId)
    {
        $passport = new Passport();
        $passport->user_id = $userId;
        $passport->number = $this->faker->numberBetween(1111, 9999);
        $passport->code = $this->faker->numberBetween(1111, 9999);
        $passport->country = $this->faker->country();
        $passport->city = $this->faker->city();
        $passport->address = $this->faker->address();
        $passport->save();
    }
}