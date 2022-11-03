<?php

namespace backend\forms\Shop;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\Shop\Category;

/**
 * CategorySearch represents the model behind the search form of `shop\entities\Shop\Category`.
 */
class CategorySearch extends Model
{
    public $id;
    public $name;
    public $slug;
    public $title;
    public $description;
    public $meta_json;
    public $lft;
    public $rgt;
    public $depth;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lft', 'rgt', 'depth'], 'integer'],
            [['name', 'slug', 'title', 'description'], 'safe'],
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
        $query = Category::find()->where(['<>', 'lft', 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['lft' => SORT_ASC]]
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
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'depth' => $this->depth,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'meta_json', $this->meta_json]);

        return $dataProvider;
    }
}
