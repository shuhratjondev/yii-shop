<?php

namespace shop\helpers;

use shop\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * User: sh_abdurasulov
 */
class UserHelper
{
    public static function statusList(): array
    {
        return [
            User::STATUS_WAIT => 'Wait',
            User::STATUS_ACTIVE => 'Active',
        ];
    }

    /**
     * @throws \Exception
     */
    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    /**
     * @throws \Exception
     */
    public static function statusLabel($status): string
    {
        switch ($status) {
            case User::STATUS_WAIT:
                $class = 'label label-default';
                break;
            case User::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class
        ]);
    }

}