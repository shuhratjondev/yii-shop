<?php
/**
 * User: sh_abdurasulov
 * @package shop\behaviors
 */

namespace shop\entities\behaviors;


use shop\entities\Meta;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class MetaBehavior extends Behavior
{
    public string $attribute = 'meta';
    public string $jsonAttribute = 'meta_json';


    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
        ];
    }

    /**
     * @throws \Exception
     */
    public function onAfterFind(Event $event): void
    {
        /* @var ActiveRecord $model */
        $model = $event->sender;
        $meta = Json::decode($model->getAttribute($this->jsonAttribute));
        $model->{$this->attribute} = new Meta(
            ArrayHelper::getValue($meta, 'title'),
            ArrayHelper::getValue($meta, 'description'),
            ArrayHelper::getValue($meta, 'keywords')
        );
    }

    public function onBeforeSave(Event $event): void
    {
        /* @var ActiveRecord $model */
        $model = $event->sender;

        $model->setAttribute($this->jsonAttribute, Json::encode([
            'title' => $model->{$this->attribute}->title,
            'description' => $model->{$this->attribute}->description,
            'keywords' => $model->{$this->attribute}->keywords,
        ]));
    }


}