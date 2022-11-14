<?php
/**
 * User: sh_abdurasulov
 * @package shop\entities\Shop
 */

namespace shop\entities\Shop;


use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use yii\db\ActiveRecord;

/**
 * Class Brand
 * @author sh_abdurasulov
 * @package shop\entities\Shop
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 *
 * @property Meta $meta
 */
class Brand extends ActiveRecord
{

    public Meta $meta;

    public static function create($name, $slug, Meta $meta): Brand
    {
        $brand = new self();
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->meta = $meta;
        return $brand;
    }

    public function edit($name, $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    ############################################################

    public static function tableName(): string
    {
        return '{{%shop_brands}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class
        ];
    }

}