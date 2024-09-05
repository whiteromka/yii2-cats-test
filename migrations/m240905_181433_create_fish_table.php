<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fish}}`.
 */
class m240905_181433_create_fish_table extends Migration
{
// команда на создание миграции
// php yii migrate/create <название миграции>

// команда для накатки миграции: php yii migrate/up
// команда для отката миграции: php yii migrate/down

// sql на создание таблицы
//CREATE TABLE dog (
//id INT AUTO_INCREMENT PRIMARY KEY,
//name VARCHAR(255) NOT NULL,
//age TINYINT(2),
//price INT,
//gender TINYINT(1)
//);

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fish}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(10)->notNull(),
            'age' => $this->tinyInteger(2), //integer()->notNull(),
            'price' => $this->integer(),
            'gender' => $this->tinyInteger(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fish}}');
    }
}
