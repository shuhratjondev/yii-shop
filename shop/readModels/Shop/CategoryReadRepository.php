<?php
/**
 * User: sh_abdurasulov
 * @package shop\readModels\Shop
 */

namespace shop\readModels\Shop;


use shop\entities\Shop\Category;

class CategoryReadRepository
{

    public function getRoot()
    {
        return Category::find()->roots()->one();
    }

    public function find($id)
    {
        return Category::find()->andWhere(['id' => $id])->andWhere(['>', 'depth', 0])->one();
    }

}