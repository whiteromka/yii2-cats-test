<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cat_pic}}`.
 */
class m241202_162554_create_cat_pic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cat_pic}}', [
            'id' => $this->primaryKey(),
            'cat_id' => $this->integer(),
            'pic_name' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk_cat_pic__cat_id',
            'cat_pic',
            'cat_id',
            'cat',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex('idx_cat_pic__cat_id', 'cat_pic', 'cat_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cat_pic}}');
    }
}
