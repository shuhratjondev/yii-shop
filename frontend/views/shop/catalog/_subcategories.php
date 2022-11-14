<?php
/**
 * User: sh_abdurasulov
 */

/* @var $category Category */

use shop\entities\Shop\Category;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if ($category->children): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php foreach ($category->children as $child): ?>
                <a href="<?= Html::encode(Url::to(['category', 'id' => $child->id])) ?>"><?= Html::encode($child->name) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
