<?php

namespace backend\forms\Shop;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\Shop\Product\Product;

/**
 * ProductSearch represents the model behind the search form of `shop\entities\Shop\Product\Product`.
 */
class ProductSearch extends Model
{
    public $id;
    public $code;
    public $name;
    public $description;
    public $category_id;
    public $brand_id;
    public $main_photo_id;
    public $price_old;
    public $price_new;
    public $rating;
    public $meta_json;
    public $created_at;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'brand_id', 'main_photo_id', 'price_old', 'price_new', 'created_at'], 'integer'],
            [['code', 'name', 'description', 'meta_json'], 'safe'],
            [['rating'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'main_photo_id' => $this->main_photo_id,
            'price_old' => $this->price_old,
            'price_new' => $this->price_new,
            'rating' => $this->rating,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'meta_json', $this->meta_json]);

        return $dataProvider;
    }
}
