<?php
/**
 * User: sh_abdurasulov
 * @package shop\entities\Shop\Product\queries
 */

namespace shop\entities\Shop\Product\queries;


use shop\entities\Shop\Product\Product;
use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    public function active($alias = null): ProductQuery
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Product::STATUS_ACTIVE,
        ]);
    }

}