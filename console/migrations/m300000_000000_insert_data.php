<?php

use yii\db\Migration;

/**
 * Class m300000_000000_insert_data
 */
class m300000_000000_insert_data extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {

        /* shop_categories */
        $json = file_get_contents(__DIR__ . '/json/users.json');
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        $bulkInsertArray = array();
        foreach ($data as $item) {
            $bulkInsertArray[] = [
                'id' => (int)$item['id'],
                'username' => $item['username'],
                'auth_key' => $item['auth_key'],
                'password_hash' => $item['password_hash'],
                'password_reset_token' => $item['password_reset_token'],
                'email' => $item['email'],
                'status' => $item['status'],
                'created_at' => $item['created_at'],
                'updated_at' => $item['updated_at'],
            ];
        }
        $tableName = 'users';

        if (count($bulkInsertArray) > 0) {
            $columnNameArray = ['id', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email',
                'status', 'created_at', 'updated_at',];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " Users inserted ~~~~~~~~~~~~\n";
        }


        /* shop_brands */
        $json = file_get_contents(__DIR__ . '/json/shop_brands.json');
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        $bulkInsertArray = array();
        foreach ($data as $item) {
            $bulkInsertArray[] = [
                'id' => (int)$item['id'],
                'name' => $item['name'],
                'slug' => $item['slug'],
                'meta_json' => $item['meta_json'],
            ];
        }
        $tableName = 'shop_brands';
        if (count($bulkInsertArray) > 0) {
            $columnNameArray = ['id', 'name', 'slug', 'meta_json'];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " Shop Brands inserted ~~~~~~~~~~~~\n";
        }

        /* shop_categories */
        $json = file_get_contents(__DIR__ . '/json/shop_categories.json');
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        $bulkInsertArray = array();
        foreach ($data as $item) {
            $bulkInsertArray[] = [
                'id' => (int)$item['id'],
                'name' => $item['name'],
                'slug' => $item['slug'],
                'title' => $item['title'],
                'description' => $item['description'],
                'meta_json' => $item['meta_json'],
                'lft' => $item['lft'],
                'rgt' => $item['rgt'],
                'depth' => $item['depth'],
            ];
        }
        $tableName = 'shop_categories';
        if (count($bulkInsertArray) > 0) {
            $columnNameArray = ['id', 'name', 'slug', 'title', 'description', 'meta_json', 'lft', 'rgt', 'depth',];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " Shop Categories inserted ~~~~~~~~~~~~\n";
        }


        /* shop_characteristics */
        $json = file_get_contents(__DIR__ . '/json/shop_characteristics.json');
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        $bulkInsertArray = array();
        foreach ($data as $item) {
            $bulkInsertArray[] = [
                'id' => (int)$item['id'],
                'name' => $item['name'],
                'type' => $item['type'],
                'required' => $item['required'],
                'default' => $item['default'],
                'variants_json' => $item['variants_json'],
                'sort' => $item['sort'],
            ];
        }
        $tableName = 'shop_characteristics';

        if (count($bulkInsertArray) > 0) {
            $columnNameArray = ['id', 'name', 'type', 'required', 'default', 'variants_json', 'sort',];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " Shop Characteristics inserted ~~~~~~~~~~~~\n";
        }

        /* shop_tags */
        $json = file_get_contents(__DIR__ . '/json/shop_tags.json');
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        $bulkInsertArray = array();
        foreach ($data as $item) {
            $bulkInsertArray[] = [
                'id' => (int)$item['id'],
                'name' => $item['name'],
                'slug' => $item['slug'],
            ];
        }
        $tableName = 'shop_tags';

        if (count($bulkInsertArray) > 0) {
            $columnNameArray = ['id', 'name', 'slug'];
            // below line insert all your record and return number of rows inserted
            $insertCount = Yii::$app->db->createCommand()
                ->batchInsert(
                    $tableName, $columnNameArray, $bulkInsertArray
                )
                ->execute();
            echo '~~~~~~~~~~~~~~~~~~~~' . $insertCount . " Shop Tags inserted ~~~~~~~~~~~~\n";
        }


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m300000_000000_insert_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m300000_000000_insert_data cannot be reverted.\n";

        return false;
    }
    */
}
