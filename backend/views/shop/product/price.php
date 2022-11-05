<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\Shop\Product\PriceForm */
/* @var $product \shop\entities\Shop\Product\Product */

$this->title = 'Update Product Price';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <div class="box box-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body table-responsive">

            <?= $form->field($model, 'brandId')->dropdownList($model->getBrandList(), ['prompt' => '-- Виберите --']) ?>

            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


        </div>
        <div class="box-footer">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>
