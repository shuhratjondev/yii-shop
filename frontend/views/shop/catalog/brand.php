<?php
/**
 * User: sh_abdurasulov
 */

use shop\entities\Shop\Brand;
use yii\data\DataProviderInterface;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $dataProvider DataProviderInterface */
/* @var $brand Brand */

$this->title = $brand->getSeoTitle();

$this->registerMetaTag(['name' => 'description', 'content' => $brand->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $brand->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $brand->name;
?>

<h1><?= Html::encode($brand->name) ?></h1>
<hr>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>