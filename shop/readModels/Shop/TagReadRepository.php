<?php
/**
 * User: sh_abdurasulov
 * @package shop\readModels\Shop
 */

namespace shop\readModels\Shop;


use shop\entities\Shop\Tag;

class TagReadRepository
{

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public function find($id)
    {
        return Tag::find()->andWhere(['id' => $id])->one();
    }

}