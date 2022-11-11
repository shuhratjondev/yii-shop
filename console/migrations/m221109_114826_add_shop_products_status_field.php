<?php

use yii\db\Migration;

/**
 * Class m221109_114826_add_shop_products_status_field
 */
class m221109_114826_add_shop_products_status_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'status', $this->text()->after('meta_json'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_products}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221109_114826_add_shop_products_status_field cannot be reverted.\n";

        return false;
    }
    */
}
