<?php

use shop\entities\Shop\Product\Product;
use shop\forms\manage\Shop\Product\PriceForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model PriceForm */
/* @var $product Product */

$this->title = 'Update Product Price';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <div class="box box-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body table-responsive">

            <?= $form->field($model, 'new')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'old')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="box-footer">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>
