<?php
/**
 * User: sh_abdurasulov
 * @package shop\entities\Shop
 */

namespace shop\entities\Shop;


use shop\behaviors\ArrayToJsonBehavior;
use yii\db\ActiveRecord;

/**
 * Class Characteristic
 *
 * @author sh_abdurasulov
 * @package shop\entities\Shop
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $required
 * @property string $default
 * @property array $variants
 * @property integer $sort
 */
class Characteristic extends ActiveRecord
{
    public const TYPE_STRING = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_FLOAT = 'float';

    public array $variants;


    public static function create($name, $type, $required, $default, array $variants, $sort): self
    {
        $object = new self();
        $object->name = $name;
        $object->type = $type;
        $object->required = $required;
        $object->default = $default;
        $object->variants = $variants;
        $object->sort = $sort;
        return $object;
    }

    public function edit($name, $type, $required, $default, array $variants, $sort): void
    {
        $this->name = $name;
        $this->type = $type;
        $this->required = $required;
        $this->default = $default;
        $this->variants = $variants;
        $this->sort = $sort;
    }

    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }

    ############################################################

    public static function tableName(): string
    {
        return '{{%shop_characteristics}}';
    }

    public function behaviors()
    {
        return [
            ArrayToJsonBehavior::class,
        ];
    }

}