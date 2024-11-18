<?php

use app\models\Passport;
use yii\db\Migration;

/**
 * Class m241118_174256_add_some_passports
 */
class m241118_174256_add_some_passports extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $passports = [
            [
                'user_id' => 2,
                'number'=> 2222,
                'code' => 2222,
                'country' => 'Russia',
                'city' => 'Moscow',
                'address' => 'Lenina 1'
            ],
            [
                'user_id' => 3,
                'number'=> 3333,
                'code' => 3333,
                'country' => 'Russia',
                'city' => 'Kostroma',
                'address' => 'Proezd Yjnii 1'
            ]
        ];

        foreach ($passports as $passportData) {
            $passport = new Passport();
            $passport->load(['Passport' => $passportData]);
            $passport->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return false;
    }
}
