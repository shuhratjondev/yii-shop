<?php

use shop\helpers\CharacteristicHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\entities\Shop\Characteristic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="characteristic-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'type')->dropDownList(CharacteristicHelper::typeList()) ?>

        <?= $form->field($model, 'sort')->textInput() ?>

        <?= $form->field($model, 'required')->checkbox() ?>

        <?= $form->field($model, 'default')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'textVariants')->textarea(['rows' => 6]) ?>


    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
