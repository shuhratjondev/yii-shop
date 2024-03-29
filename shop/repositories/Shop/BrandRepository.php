<?php
/**
 * User: sh_abdurasulov
 * @package shop\repositories\Shop
 */

namespace shop\repositories\Shop;


use shop\entities\Shop\Brand;
use shop\repositories\NotFoundException;

class BrandRepository
{

    public function get($id): Brand
    {
        return $this->getBy(['id' => $id]);
    }

    private function getBy(array $condition): Brand
    {
        if (($model = Brand::find()->where($condition)->limit(1)->one()) !== null) {
            return $model;
        }
        throw new NotFoundException("Brand not found");
    }


    public function save(Brand $brand): void
    {
        if (!$brand->save()) {
            throw new \DomainException('Saving Error');
        }
    }

    /**
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Brand $brand): void
    {
        if (!$brand->delete()) {
            throw new \DomainException('Deleting Error');
        }
    }

}