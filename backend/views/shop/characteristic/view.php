<?php

use shop\helpers\CharacteristicHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model shop\entities\Shop\Characteristic */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Characteristics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-view box box-primary">
    <div class="box-header">
        <?= Html::a('List', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                [
                    'attribute' => 'type',
                    'value' => function ($model) {
                        return CharacteristicHelper::typeName($model->type);
                    },
                    'format' => 'raw',
                ],
                'required',
                [
                    'attribute' => 'required',
                    'value' => function ($model) {
                        return $model->required ? '<span class="glyphicon glyphicon-check"></span>' :
                            '<span class="glyphicon glyphicon-remove"></span>';
                    },
                    'format' => 'raw',
                ],
                'default',
                [
                    'attribute' => 'variants',
                    'value' => function ($model) {
                        return '<pre>' . json_encode($model->variants, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT) . '</pre>';
                    },
                    'format' => 'raw',
                ],
                'sort',
            ],
        ]) ?>
    </div>
</div>
