<?php

use yii\db\Migration;

/**
 * Class m241114_174948_alter_user_table
 */
class m241114_174948_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'car_id', $this->integer()->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'car_id');
    }
}
