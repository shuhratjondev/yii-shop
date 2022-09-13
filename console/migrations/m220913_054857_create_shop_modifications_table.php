<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_modifications}}`.
 */
class m220913_054857_create_shop_modifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_modifications}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'code' => $this->string()->notNull(),
            'price' => $this->integer(),
        ]);

        $this->createIndex('idx-shop_modifications-code', 'shop_modifications', 'code');
        $this->createIndex('idx-shop_modifications-product_id-code', 'shop_modifications', ['product_id', 'code'], true);

        $this->createIndex('idx-shop_modifications-product_id', 'shop_modifications', 'product_id');
        $this->addForeignKey('fk-shop_modifications-product_id', 'shop_modifications', 'product_id',
            'shop_products', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_modifications}}');
    }
}
