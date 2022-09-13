<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shop_characteristics}}`.
 */
class m220817_061848_create_shop_characteristics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%shop_characteristics}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'type' => $this->string(),
            'required' => $this->string(),
            'default' => $this->string(),
            'variants_json' => "JSON NOT NULL",
            'sort' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_characteristic}}');
    }
}
