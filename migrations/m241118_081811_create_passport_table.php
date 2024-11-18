<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%passport}}`.
 */
class m241118_081811_create_passport_table extends Migration
{
    public function safeUp()
    {
        // 1) Создаем тбл passport
        $this->createTable('{{%passport}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->comment("Связь с таблицей user"),
            'number' => $this->integer(),
            'code' => $this->integer(),
            'country' => $this->string(),
            'city' => $this->string(),
            'address' => $this->string(),
            'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()',
            'updated_at' => 'TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP()'
        ]);

        // 2) Создаем внешний ключ
        /**
         * Внешний ключ (FK). Ограничение для тбл passport на колонку user_id,
         * что она может иметь только те ID которые есть в таблице user.
         * Т.е. паспорт не может принадлежать пользователю которого нет в тбл user
         */
        $this->addForeignKey(
            'fk_passport__user_id', // название внешнего ключа. Всегда по формуле: "fk_" + <таблица> + <колонка>
            'passport', // таблица
            'user_id',  // колонка
            'user',     // таблица на которую ссылается FK
            'id',       // колонка на которую ссылается FK в ссылающиеся таблице
            'CASCADE',  // Необязательно! При удалении главной записи т.е. пользователь, подчиненная запись т.е. паспорт удалится тоже
            'CASCADE'   // Необязательно! При обновлении ID главной записи т.е. ID в user, подчиненная запись т.е. user_id в паспорте обновится тоже
        );

        // 3) Создаем индекс
        /**
         * Создаем индекс для таблицы passport для колонки user_id. Индексы нужны для ускорения поиска
         */
        $this->createIndex('idx_passport__user_id', 'passport', 'user_id', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаляем таблицу. Вместе с ней удалятся и ее внешние ключи и индексы
        $this->dropTable('{{%passport}}');
    }
}
