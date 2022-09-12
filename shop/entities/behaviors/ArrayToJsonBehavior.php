<?php
/**
 * User: sh_abdurasulov
 * @package shop\behaviors
 */

namespace shop\behaviors;


use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\Json;

class ArrayToJsonBehavior extends Behavior
{
    public string $arrayAttribute = 'array_attribute';
    public string $jsonAttribute = 'json_attribute';

    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
        ];
    }

    public function afterFind(Event $event): void
    {
        /* @var ActiveRecord $model */
        $model = $event->sender;
        $model->{$this->arrayAttribute} = Json::decode($model->getAttribute($this->jsonAttribute));
    }

    public function beforeSave(Event $event): void
    {
        /* @var ActiveRecord $model */
        $model = $event->sender;
        $model->setAttribute($this->jsonAttribute, Json::encode($this->arrayAttribute));
    }

}