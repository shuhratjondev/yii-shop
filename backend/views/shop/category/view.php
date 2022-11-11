<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model shop\entities\Shop\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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

<div class="box box-primary">
    <div class="box-header with-border">Common</div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'parent',
                    'value' => ArrayHelper::getValue($model, 'parent.name'),
                    'format' => 'raw',
                ],
                'name',
                'slug',
                'title',
                'description',
                'lft',
                'rgt',
                'depth',
            ],
        ]) ?>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">Seo</div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'meta.title',
                'meta.description',
                'meta.keywords',
            ],
        ]) ?>
    </div>
</div>
