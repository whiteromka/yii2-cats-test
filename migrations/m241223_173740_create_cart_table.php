<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart}}`.
 */
class m241223_173740_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Таблица корзина
        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'sum' => $this->integer()->notNull()->defaultValue(0),
            'discount_percent' => $this->integer()->notNull()->defaultValue(0),
            'final_sum' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->integer()->notNull()->defaultValue(1)
                ->comment('Активна или нет'),
            'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()', // sql следит за добавление данных
            'updated_at' => 'TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP()' //sql следит за добавление данных
        ]);

        // Таблица товары в корзине
        $this->createTable('{{%cart_item}}', [
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer()->notNull(),
            'cat_id' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()',
            'updated_at' => 'TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP()'
        ]);
        // FK и IDX для cart_id
        $this->addForeignKey(
            'fk_cart_item_cart_id',
            'cart_item',
            'cart_id',
            'cart',
            'id',
            'CASCADE', // что происходит при удалении главной записи
            'CASCADE'  // что происходит при обновлении главной записи
        );
        $this->createIndex('idx_cart_item_cart_id', 'cart_item', 'cat_id');

        // FK и IDX для cat_id
        $this->addForeignKey(
            'fk_cart_item_cat_id',
            'cart_item',
            'cat_id',
            'cat',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->createIndex('idx_cart_item_cat_id', 'cart_item', 'cat_id');

        // Таблица заказ
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0)->comment('Доставлен или нет'),
        ]);
        $this->addForeignKey(
            'fk_order_cart_id',
            'order',
            'cart_id',
            'cart',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->createIndex('idx_order_cart_id', 'order', 'cart_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
        $this->dropTable('{{%cart_item}}');
        $this->dropTable('{{%cart}}');
    }
}
