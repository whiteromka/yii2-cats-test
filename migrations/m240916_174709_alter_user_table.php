<?php

use yii\db\Migration;

/**
 * Class m240916_174709_alter_user_table
 */
class m240916_174709_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'gender',
            $this->tinyInteger(1)->defaultValue(1)->after('email')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'gender');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240916_174709_alter_user_table cannot be reverted.\n";

        return false;
    }
    */
}
