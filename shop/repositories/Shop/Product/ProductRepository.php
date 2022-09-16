<?php

namespace shop\repositories\Shop\Product;

use shop\entities\Shop\Product\Product;
use shop\repositories\NotFoundException;

class ProductRepository
{

    public function get($id): Product
    {
        if (!$model = Product::findOne($id)) {
            throw new NotFoundException('Product is not found.');
        }
        return $model;
    }

    public function save(Product $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Product Saving Error');
        }
    }

    /**
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Product $model)
    {
        if (!$model->delete()) {
            throw new \RuntimeException("Product Removing Error");
        }
    }


}