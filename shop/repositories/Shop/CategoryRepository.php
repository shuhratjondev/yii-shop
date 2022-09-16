<?php
/**
 * User: sh_abdurasulov
 * @package shop\repositories\Shop
 */

namespace shop\repositories\Shop;


use shop\entities\Shop\Category;
use shop\repositories\NotFoundException;

class CategoryRepository
{

    public function get($id): Category
    {
        return $this->getBy(['id' => $id]);
    }


    private function getBy(array $condition): Category
    {
        if ($model = Category::find()->where($condition)->limit(1)->one()) {
            return $model;
        }
        throw new NotFoundException('Category not found');
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \DomainException('Category save error');
        }
    }


    /**
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Remove error');
        }
    }

}