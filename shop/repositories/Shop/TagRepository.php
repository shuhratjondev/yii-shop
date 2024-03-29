<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Tag;
use shop\repositories\NotFoundException;

/**
 * User: sh_abdurasulov
 */
class TagRepository
{

    public function findById($id): Tag
    {
        return $this->findBy(['id' => $id]);
    }

    public function findByName($name): ?Tag
    {
        return Tag::findOne(['name' => $name]);
    }

    /**
     * @param array $condition
     * @return array|\yii\db\ActiveRecord|null
     */
    private function findBy(array $condition): Tag
    {
        if ($model = Tag::find()->andWhere($condition)->limit(1)->one()) {
            return $model;
        }
        throw new NotFoundException('Tag not found.' . json_encode($condition));
    }

    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new \RuntimeException('Saving error');
        }
    }

    /**
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new \RuntimeException('Remove error');
        }
    }

}