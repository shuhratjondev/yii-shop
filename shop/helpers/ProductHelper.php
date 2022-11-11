<?php
/**
 * User: sh_abdurasulov
 * @package shop\helpers
 */

namespace shop\helpers;


use shop\entities\Shop\Product\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ProductHelper
{

    public static function statusList(): array
    {
        return [
            Product::STATUS_DRAFT => 'Draft',
            Product::STATUS_ACTIVE => 'Active',
        ];
    }

    /**
     * @throws \Exception
     */
    public static function statusName($status)
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    /**
     * @throws \Exception
     */
    public static function statusLabel($status): string
    {
        switch ($status) {
            case Product::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
                break;
        }

        return Html::tag('span', self::statusName($status), ['class' => $class]);
    }

}