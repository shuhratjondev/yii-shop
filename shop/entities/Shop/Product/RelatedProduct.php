<?php
/**
 * User: sh_abdurasulov
 * @package shop\entities\Shop\Product
 */

namespace shop\entities\Shop\Product;


use yii\db\ActiveRecord;

/**
 * Class RelatedProduct
 *
 * @author sh_abdurasulov
 * @package shop\entities\Shop\Product
 *
 * @property $product_id
 * @property $related_id
 *
 */
class RelatedProduct extends ActiveRecord
{

    public static function create($id)
    {
        $assignment = new self();
        $assignment->related_id = $id;
        return $assignment;
    }

    public function isForProduct($id): bool
    {
        return $this->related_id === $id;
    }

    ##################################
    public static function tableName(): string
    {
        return '{{%shop_related_assignments}}';
    }


}