<?php

use app\models\Cat;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%cat}}`.
 */
class m240909_172249_create_cat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Тут должны быть sql инструкции
        $this->createTable('{{%cat}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'age' => $this->integer(2)->notNull(),
            'gender' => $this->integer(1)->notNull(),
            'price' => $this->integer(),
            'breed' => $this->string(255)->notNull(),
        ]);

        // Базовый кот
        $cat = new Cat();
        $cat->name = 'Rom!!!!!!';
        $cat->age = 10;
        $cat->gender = 1;
        $cat->price = 1000;
        $cat->breed = 'Персидский';
        $result = $cat->save();

//             Для отладки
//        echo "!!!!!!" . PHP_EOL;
//        echo "<pre>";
//        print_r($cat->errors);
//        if ($result) {
//            echo 'Cat Rom successed!';
//        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cat}}');
    }
}
