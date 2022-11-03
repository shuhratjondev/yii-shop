<?php

namespace shop\helpers;

use shop\entities\Shop\Characteristic;
use shop\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * User: sh_abdurasulov
 */
class CharacteristicHelper
{
    public static function typeList(): array
    {
        return [
            Characteristic::TYPE_STRING => 'String',
            Characteristic::TYPE_INTEGER => 'Integer',
            Characteristic::TYPE_FLOAT => 'Float',
        ];
    }

    /**
     * @throws \Exception
     */
    public static function typeName($status): string
    {
        return ArrayHelper::getValue(self::typeList(), $status);
    }

}