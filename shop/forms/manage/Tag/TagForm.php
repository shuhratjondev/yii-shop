<?php

namespace shop\forms\manage\Tag;

use shop\entities\Shop\Tag;
use shop\validators\SlugValidator;
use yii\base\Model;

class TagForm extends Model
{
    public $name;
    public $slug;

    public $entity;

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
            [['slug'], SlugValidator::class],
            [['name'], 'unique', 'targetClass' => Tag::class, 'filter' => $this->entity ? ['<>', 'name', $this->entity->name] : []],
            [['slug'], 'unique', 'targetClass' => Tag::class, 'filter' => $this->entity ? ['<>', 'slug', $this->entity->slug] : []],
        ];
    }
}