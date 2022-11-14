<?php
/**
 * User: sh_abdurasulov
 */

use shop\entities\Shop\Category;
use yii\data\DataProviderInterface;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $dataProvider DataProviderInterface */
/* @var $category Category */

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_subcategories', [
    'category' => $category
]) ?>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>