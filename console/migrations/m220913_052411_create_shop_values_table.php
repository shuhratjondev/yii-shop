<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_values}}`.
 */
class m220913_052411_create_shop_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_values}}', [
            'product_id' => $this->integer()->notNull(),
            'characteristic_id' => $this->integer()->notNull(),
            'value' => $this->string(),
        ]);

        $this->createIndex('idx-shop_values-product_id', 'shop_values', 'product_id');
        $this->createIndex('idx-shop_values-characteristic_id', 'shop_values', 'characteristic_id');

        $this->addForeignKey('fk-shop_values-product_id', 'shop_values', 'product_id',
            'shop_products', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-shop_values-characteristic_id', 'shop_values', 'characteristic_id',
            'shop_characteristics', 'id', 'CASCADE', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_values}}');
    }
}
