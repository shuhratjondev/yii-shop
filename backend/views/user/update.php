<?php

use shop\entities\User\User;
use shop\forms\manage\User\UserEditForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model UserEditForm */
/* @var $user User */

$this->title = 'Update User: ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxLength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
