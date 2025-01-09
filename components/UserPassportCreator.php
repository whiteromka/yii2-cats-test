<?php

namespace app\components;

use app\models\Passport;
use app\models\User;
use Faker\Factory;
use Random\RandomException;
use Yii;

/** Создать пользователей и паспорты */
class UserPassportCreator
{
    /**
     * Метод должен создавать пользователей и паспорта к ним
     */
    public function run(): void
    {
        $count = 20;
        echo 'Start processing user passport creator ' . PHP_EOL;
        for ($i = 0; $i < $count; $i++) {
            $user = $this->createUser();
//            if (random_int(0, 1)) {
//                $this->createPassport($user->id);
//            }
            echo '.';
        }
        echo PHP_EOL .' End processing user passport creator ' . PHP_EOL;
    }

    /**
     * @throws RandomException
     */
    private function createUser()
    {
        $user = new User();
        $faker = Factory::create('ru_Ru');
        $gender = $user->gender = random_int(0, 1);
        $user->name = $faker->firstName($gender);
        $user->last_name = $faker->lastName($gender);
        $user->email = $faker->email();
        $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($faker->password());
        $user->status_id = (random_int(1, 10) > 1) ? 1 : 0;
        //die('!!!!!!');
        $user->save();
    }

    private function createPassport(int $userId)
    {
        $passport = new Passport();
        $passport->user_id = $userId;
        // ..
        $passport->save();
    }
}