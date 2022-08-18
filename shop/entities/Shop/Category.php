<?php
/**
 * User: sh_abdurasulov
 * @package shop\entities\Shop
 */

namespace shop\entities\Shop;


use paulzi\nestedsets\NestedSetsBehavior;
use shop\behaviors\MetaBehavior;
use shop\entities\Meta;
use shop\entities\Shop\queries\CategoryQuery;
use yii\db\ActiveRecord;


/**
 * Class Category
 *
 * @author sh_abdurasulov
 * @package shop\entities\Shop
 *
 * @property $id
 * @property $name
 * @property $slug
 * @property $title
 * @property $description
 *
 * @property Meta $meta
 * @property Category $parent
 * @mixin NestedSetsBehavior
 */
class Category extends ActiveRecord
{
    public Meta $meta;

    public static function create($name, $slug, $title, $description, Meta $meta): self
    {
        $category = new self();
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->meta = $meta;
        return $category;
    }

    public function edit($name, $slug, $title, $description, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->meta = $meta;
    }

    ############################################################

    public static function tableName(): string
    {
        return "{{%shop_categories}}";
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            NestedSetsBehavior::class,
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }


}