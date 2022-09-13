<?php


namespace shop\entities\Shop\Product;


use yii\db\ActiveRecord;

/**
 * @property $product_id
 * @property $characteristic_id
 * @property $value
 */
class Value extends ActiveRecord
{

    public static function create($characteristicId, $value): Value
    {
        $object = new self();
        $object->characteristic_id = $characteristicId;
        $object->value = $value;
        return $object;
    }

    public static function blank($characteristicId): Value
    {
        $object = new self();
        $object->characteristic_id = $characteristicId;
        return $object;
    }

    public function isForCharacteristic($id): bool
    {
        return $this->characteristic_id === $id;
    }


    ####################################

    public static function tableName(): string
    {
        return "{{%shop_values}}";
    }

}