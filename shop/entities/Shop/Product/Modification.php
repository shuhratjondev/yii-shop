<?php
/**
 * User: sh_abdurasulov
 * @package shop\entities\Shop\Product
 */

namespace shop\entities\Shop\Product;


use yii\db\ActiveRecord;

/**
 * Class Modification
 *
 * @author sh_abdurasulov
 * @package shop\entities\Shop\Product
 *
 * @property $id
 * @property $product_id
 * @property $name
 * @property $code
 * @property $price
 */
class Modification extends ActiveRecord
{

    public static function create($code, $name, $price): self
    {
        $modification = new self();
        $modification->code = $code;
        $modification->name = $name;
        $modification->price = $price;
        return $modification;
    }

    public function edit($code, $name, $price): void
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id === $id;
    }

    public function isCodeEqualTo($code): bool
    {
        return $this->code === $code;
    }

    #################
    public static function tableName(): string
    {
        return '{{%shop_modifications}}';
    }

}