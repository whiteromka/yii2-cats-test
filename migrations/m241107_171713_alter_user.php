<?php

use yii\db\Migration;

/**
 * Class m241107_171713_alter_user
 */
class m241107_171713_alter_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('user', 'status', 'status_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('user', 'status_id', 'status');
    }
}
