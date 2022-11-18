<?php
/**
 * User: sh_abdurasulov
 * @package shop\readModels\Shop
 */

namespace shop\readModels\Shop;


use shop\entities\Shop\Category;
use yii\helpers\ArrayHelper;

class CategoryReadRepository
{

    public function getRoot()
    {
        return Category::find()->roots()->one();
    }

    public function find($id)
    {
        return Category::find()->andWhere(['id' => $id])->andWhere(['>', 'depth', 0])->one();
    }

    public function getTreeWithSubOf(Category $category = null): array
    {
        $query = Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft');
        if ($category) {
            $criteria = ['or', ['depth' => 1]];
            $categories = ArrayHelper::merge([$category], $category->parents);
            foreach ($categories as $cat) {
                $criteria[] = ['and', ['>', 'lft', $cat->lft], ['<', 'rgt', $cat->rgt], ['depth' => $cat->depth + 1]];
            }
            $query->andWhere($criteria);
        } else {
            $query->andWhere(['depth' => 1]);
        }
        return $query->all();
    }

}