<?php

use yii\db\Migration;

/**
 * Class m241212_171442_alter_cat_pic_table
 */
class m241212_171442_alter_cat_pic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cat_pic', 'is_main', $this->tinyInteger()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('cat_pic', 'is_main');
        return false;
    }
}
