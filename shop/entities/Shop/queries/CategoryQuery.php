<?php

namespace shop\entities\Shop\queries;

use paulzi\nestedsets\NestedSetsQueryTrait;
use yii\db\ActiveQuery;

/**
 * User: sh_abdurasulov
 */
class CategoryQuery extends ActiveQuery
{
    use NestedSetsQueryTrait;
}