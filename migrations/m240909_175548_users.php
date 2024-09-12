<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m240909_175548_users extends Migration
{
    /** В этом месте код для накатывания миграций
     *
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(60)->notNull(),
            'last_name' => $this->string(60)->notNull(),
            'email' => $this->string(100)->notNull()->unique(),
            'password_hash' => $this->string(100)->notNull(),
            'status' => $this->integer(2)->notNull(), // 0 - disactive, 1 - active
            'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()', //sql следит за добавление данных 2024-09-12 12:12:12
            'updated_at' => 'TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP()' //sql следит за добавление данных
        ]);
    }

    /**
     * В этом месте код для отмены миграций
     *
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
