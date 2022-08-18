<?php
/**
 * User: sh_abdurasulov
 * @package shop\repositories\Shop
 */

namespace shop\repositories\Shop;


use shop\entities\Shop\Characteristic;
use shop\repositories\NotFoundException;

class CharacteristicRepository
{

    public function get($id)
    {
        return $this->getBy(['id' => $id]);
    }


    private function getBy(array $condition)
    {
        if ($model = Characteristic::find()->where($condition)->limit(1)->one()) {
            return $model;
        }
        throw new NotFoundException('Characteristic not found');
    }

    public function save(Characteristic $characteristic): void
    {
        if (!$characteristic->save()) {
            throw new \DomainException('Characteristic save error');
        }
    }


    /**
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Characteristic $characteristic): void
    {
        if (!$characteristic->delete()) {
            throw new \RuntimeException('Characteristic remove error');
        }
    }

}