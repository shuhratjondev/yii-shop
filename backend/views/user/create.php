<?php

use shop\entities\User\User;
use shop\forms\manage\User\UserCreateForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model UserCreateForm */
/* @var $user User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxLength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxLength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
