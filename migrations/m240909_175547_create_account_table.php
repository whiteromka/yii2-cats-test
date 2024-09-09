<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%account}}`.
 */
class m240909_175547_create_account_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
//        $this->createTable('{{%account}}', [
//            'id' => $this->primaryKey(),
//            'name' => $this->string()->notNull(),
//            'last_name' => $this->string(),
//            'phone' => $this->string(),
//            'email' => $this->string(100)->unique()->notNull(),
//            'passport_number' => $this->integer(),
//            'balance' => $this->integer(),
//        ]);

        // Нативный sql
        $sqlCreateTable = 'CREATE TABLE `account` (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                last_name VARCHAR(255),
                email VARCHAR(100) NOT NULL UNIQUE,
                passport_number INT,
                balance INT
            )';
        $this->execute($sqlCreateTable);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->dropTable('{{%account}}');
        $sql = 'DROP TABLE IF EXISTS `account`;';
        $this->execute($sql);
    }
}
