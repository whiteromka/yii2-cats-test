<?php

use yii\db\Migration;

/**
 * Class m240919_170457_test
 */
class m240919_170457_test extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // нативный скул для измения структуры таблиц
//        $sql = 'alter table user add column category tinyint(1)';
//        $this->execute($sql);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $sql = 'alter table user drop column category';
//        $this->execute($sql);
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240919_170457_test cannot be reverted.\n";

        return false;
    }
    */
}
