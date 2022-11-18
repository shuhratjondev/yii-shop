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

$this->title = $category->getSeoTitle();

$this->registerMetaTag(['name' => 'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $category->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];

foreach ($category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}

$this->params['breadcrumbs'][] = $category->name;
$this->params['active_category'] = $category;
?>

    <h1><?= Html::encode($category->getHeadingTitle()) ?></h1>

<?= $this->render('_subcategories', [
    'category' => $category
]) ?>

<?php if (trim($category->description)): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= Yii::$app->formatter->asNtext($category->description) ?>
        </div>
    </div>
<?php endif ?>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>