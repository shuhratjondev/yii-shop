<?php

namespace shop\forms\manage\Tag;

use shop\entities\Shop\Tag;
use yii\base\Model;

class TagForm extends Model
{
    public $name;
    public $slug;

    public Tag $entity;

    public function __construct(Tag $entity = null, $config = [])
    {
        parent::__construct($config);
        if ($entity) {
            $this->entity = $entity;
            $this->name = $this->entity->name;
            $this->slug = $this->entity->slug;
        }
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['slug', 'match', 'pattern' => '#^[a-z0-9_-]*$#'],
            [['name', 'slug'], 'unique', 'targetClass' => Tag::class],
        ];
    }
}