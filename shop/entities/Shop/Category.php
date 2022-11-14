<?php
/**
 * User: sh_abdurasulov
 * @package shop\entities\Shop
 */

namespace shop\entities\Shop;


use paulzi\nestedsets\NestedSetsBehavior;
use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use shop\entities\Shop\queries\CategoryQuery;
use yii\db\ActiveRecord;


/**
 * Class Category
 *
 * @author sh_abdurasulov
 * @package shop\entities\Shop
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $title
 * @property string|null $description
 * @property string $meta_json
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 *
 * @property Meta $meta
 * @property Category $parent
 * @property Category[] $parents
 * @property Category[] $children
 * @property Category $prev
 * @property Category $next
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

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTitle();
    }

    public function getHeadingTitle(): string
    {
        return $this->title ?: $this->name;
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