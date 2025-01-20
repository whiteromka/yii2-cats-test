<?php

use yii\db\Migration;

/**
 * Class m250120_180205_fix_users_statuses
 */
class m250120_180205_fix_users_statuses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'update User set status_id = 2 where status_id = 0';
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
