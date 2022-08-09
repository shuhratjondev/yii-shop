<?php
/**
 * User: sh_abdurasulov
 */

$this->title = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>
    <p>Hello</p>
    <?= \yii\authclient\widgets\AuthChoice::widget([
        'baseAuthUrl' => ['cabinet/network/attach']
    ]) ?>

</div>
