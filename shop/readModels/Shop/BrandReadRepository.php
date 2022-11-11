<?php
/**
 * User: sh_abdurasulov
 * @package shop\readModels\Shop
 */

namespace shop\readModels\Shop;


use shop\entities\Shop\Brand;

class BrandReadRepository
{

    public function find($id)
    {
        return Brand::find()->andWhere(['id' => $id])->one();
    }

}