<?php
/**
 * User: sh_abdurasulov
 * @package shop\readModels\Shop
 */

namespace shop\readModels\Shop;


use shop\entities\Shop\Brand;
use shop\entities\Shop\Category;
use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Tag;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ProductReadRepository
{

    public function getAll(): ActiveDataProvider
    {
        $query = Product::find()->alias('p')->active('p')->with('mainPhoto');
        return $this->getProvider($query);
    }

    public function getAllByCategory(Category $category): ActiveDataProvider
    {
        $query = Product::find()->alias('p')->active('p')->with('mainPhoto', 'category');
        $ids = ArrayHelper::merge([$category->id], $category->getLeaves()->select('id')->column());
        $query->joinWith(['categoryAssignments ca'], false);
        $query->andWhere(['or', ['p.category_id' => $ids], ['ca.category_id' => $ids]]);
        $query->orderBy('p.id');
        return $this->getProvider($query);
    }

    public function getAllByBrand(Brand $brand): ActiveDataProvider
    {
        $query = Product::find()->alias('p')->active('p')->with('mainPhoto');
        $query->andWhere(['p.brand_id' => $brand->id]);
        return $this->getProvider($query);
    }

    public function getAllByTag(Tag $tag): ActiveDataProvider
    {
        $query = Product::find()->alias('p')->active('p')->with('mainPhoto');
        $query->joinWith(['tagAssignments ta'], false);
        $query->andWhere(['ta.tag_id' => $tag->id]);
        $query->orderBy('p.id');
        return $this->getProvider($query);
    }

    public function getFeatured($limit)
    {
        return Product::find()->active()->with('mainPhoto')->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }


    public function find($id)
    {
        return Product::find()->andWhere(['id' => $id])->one();
    }

    protected function getProvider($query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['p.id' => SORT_ASC],
                        'desc' => ['p.id' => SORT_DESC],
                    ],
                    'name' => [
                        'asc' => ['p.name' => SORT_ASC],
                        'desc' => ['p.name' => SORT_DESC],
                    ],
                    'price' => [
                        'asc' => ['p.price_new' => SORT_ASC],
                        'desc' => ['p.price_new' => SORT_DESC],
                    ],
                    'rating' => [
                        'asc' => ['p.rating' => SORT_ASC],
                        'desc' => ['p.rating' => SORT_DESC],
                    ],
                ]
            ],
            'pagination' => [
                'pageSizeLimit' => [15, 100],
            ]
        ]);
    }

}