<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\entities\Shop\Product\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'id')->textInput() ?>

        <?= $form->field($model, 'category_id')->textInput() ?>

        <?= $form->field($model, 'brand_id')->textInput() ?>

        <?= $form->field($model, 'main_photo_id')->textInput() ?>

        <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'price_old')->textInput() ?>

        <?= $form->field($model, 'price_new')->textInput() ?>

        <?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'meta_json')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
