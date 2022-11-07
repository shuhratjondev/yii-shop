<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\Shop\Product\ModificationForm */
/* @var $modification \shop\entities\Shop\Product\Modification */
/* @var $product \shop\entities\Shop\Product\Product */

$this->title = 'Update Modification: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['shop/product']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = 'Update ' . $modification->name;
?>
<div class="modification-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
