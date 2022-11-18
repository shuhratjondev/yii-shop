<?php
/**
 * User: sh_abdurasulov
 */

use shop\entities\Shop\Tag;
use yii\data\DataProviderInterface;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $dataProvider DataProviderInterface */
/* @var $tag Tag */

$this->title = $tag->name;

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $tag->name;
?>

<h1> Products with tag &laquo;<?= Html::encode($tag->name) ?>&raquo;</h1>
<hr>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>