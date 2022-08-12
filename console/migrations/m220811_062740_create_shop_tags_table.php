<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_tags}}`.
 */
class m220811_062740_create_shop_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_tags}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()->unique(),
        ]);

        $this->createIndex('{{%idx-shop_tags-slug}}', '{{%shop_tags}}', 'slug', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_tags}}');
    }
}
