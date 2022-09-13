<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_category_assignments}}`.
 */
class m220913_051533_create_shop_category_assignments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_category_assignments}}', [
            'category_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk-shop_category_assignments', '{{%shop_category_assignments}}',
            ['product_id', 'category_id']);

        $this->createIndex('idx-shop_category_assignments-category_id', 'shop_category_assignments',
            'category_id');
        $this->createIndex('idx-shop_category_assignments-product_id', 'shop_category_assignments',
            'product_id');

        $this->addForeignKey('fk-shop_category_assignments-category_id', 'shop_category_assignments',
            'category_id', 'shop_categories', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-shop_category_assignments-product_id', 'shop_category_assignments',
            'product_id', 'shop_products', 'id', 'CASCADE', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_category_assignments}}');
    }
}
