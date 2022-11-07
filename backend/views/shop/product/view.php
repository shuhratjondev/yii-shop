<?php

use shop\entities\Shop\Product\Modification;
use shop\entities\Shop\Product\Photo;
use shop\entities\Shop\Product\Value;
use shop\helpers\PriceHelper;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $product shop\entities\Shop\Product\Product */
/* @var $modificationDataProvider \yii\data\ActiveDataProvider */

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">
    <div class="box-header">
        <?= Html::a('List', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $product->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Common</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'brand_id',
                                'value' => ArrayHelper::getValue($product, 'brand.name'),
                                'format' => 'raw',
                            ],
                            'name',
                            'code',
                            [
                                'attribute' => 'price_new',
                                'value' => PriceHelper::format($product->price_new),
                            ],
                            [
                                'attribute' => 'price_old',
                                'value' => PriceHelper::format($product->price_old),
                            ],
                            [
                                'attribute' => 'category_id',
                                'value' => ArrayHelper::getValue($product, 'category.name')
                            ],
                            [
                                'label' => 'Other Categories',
                                'value' => implode(', ', ArrayHelper::getColumn($product->categories, 'name'))
                            ],
                            [
                                'label' => 'Tags',
                                'value' => implode(', ', ArrayHelper::getColumn($product->tags, 'name'))
                            ],
                            'created_at:datetime',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Characteristics</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => array_map(function (Value $value) {
                            return [
                                'label' => $value->characteristic->name,
                                'value' => $value->value,
                            ];
                        }, $product->values)
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Description</div>
        <div class="box-body">
            <?= Yii::$app->formatter->asNtext($product->description) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Modifications</div>
        <div class="box-body">
            <p>
                <?= Html::a('Add Modification', ['shop/modification/create', 'product_id' => $product->id], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $modificationDataProvider,
                'columns' => [
                    'code',
                    'name',
                    [
                        'attribute' => 'price',
                        'value' => function (Modification $model) {
                            return PriceHelper::format($model->price);
                        },
                    ],
                    [
                        'class' => \yii\grid\ActionColumn::class,
                        'controller' => 'shop/modification',
                        'template' => '{update} {delete}',
                    ]
                ]
            ]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Photos</div>
        <div class="box-body">
            <div class="row">
                <?php foreach ($product->photos as $photo): ?>
                    <div class="col-md-2 col-xs-3" style="">
                        <div>
                            <?= Html::a(
                                Html::img($photo->getThumbFileUrl('file', 'thumb')),
                                $photo->getUploadedFileUrl('file'),
                                ['class' => 'thumbnail', 'target' => '_blank']
                            ) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


</div>
