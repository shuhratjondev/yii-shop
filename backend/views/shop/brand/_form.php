<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Shop\BrandForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Common</h3>
        </div>
        <div class="box-body table-responsive">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">SEO</h3>
        </div>
        <div class="box-body table-responsive">
            <?= $form->field($model->meta, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model->meta, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model->meta, 'keywords')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
