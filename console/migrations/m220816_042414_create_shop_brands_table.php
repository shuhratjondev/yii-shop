<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_brands}}`.
 */
class m220816_042414_create_shop_brands_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_brands}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->unique()->notNull(),
            'meta_json' => "JSON NOT NULL",
        ]);

        $this->createIndex('idx-shop_brands-slug', 'shop_brands', 'slug', 1);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_brands}}');
    }
}
