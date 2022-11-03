<?php

use yii\db\Migration;

/**
 * Class m221103_074008_add_shop_product_description_field
 */
class m221103_074008_add_shop_product_description_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'description', $this->text()->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_products}}', 'description');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221103_074008_add_shop_product_description_field cannot be reverted.\n";

        return false;
    }
    */
}
