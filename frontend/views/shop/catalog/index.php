<?php
/**
 * User: sh_abdurasulov
 */

/* @var $category \shop\entities\Shop\Category */

/* @var $dataProvider \yii\data\DataProviderInterface */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php foreach ($category->children as $child): ?>
            <a href="<?= Html::encode(Url::to(['category', 'id' => $child->id])) ?>"><?= Html::encode($child->name) ?></a>
        <?php endforeach; ?>
    </div>
</div>

<div class="row">
    <aside id="column-left" class="col-sm-3 hidden-xs">
        <div class="list-group"><a href="/product/category&amp;path=20" class="list-group-item">Desktops (13)</a>
            <a href="/product/category&amp;path=18" class="list-group-item active">Laptops &amp; Notebooks (5)</a>
            <a href="/product/category&amp;path=18_46" class="list-group-item">&nbsp;&nbsp;&nbsp;-Macs (0)</a>
            <a href="/product/category&amp;path=18_45" class="list-group-item">&nbsp;&nbsp;&nbsp;-Windows (0)</a>
            <a href="/product/category&amp;path=25" class="list-group-item">Components (2)</a>
            <a href="/product/category&amp;path=57" class="list-group-item">Tablets (1)</a>
            <a href="/product/category&amp;path=17" class="list-group-item">Software (0)</a>
            <a href="/product/category&amp;path=24" class="list-group-item">Phones &amp; PDAs (3)</a>
            <a href="/product/category&amp;path=33" class="list-group-item">Cameras (2)</a>
            <a href="/product/category&amp;path=34" class="list-group-item">MP3 Players (4)</a></div>

        <div id="banner0" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
            <div class="owl-wrapper-outer">
                <div class="owl-wrapper"
                     style="width: 526px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(0px, 0px, 0px); transform-origin: 131.5px center; perspective-origin: 131.5px center;">
                    <div class="owl-item" style="width: 263px;">
                        <div class="item"><a href="index.php?route=product/manufacturer/info&amp;manufacturer_id=7">
                                <img src="/image/cache/catalog/demo/compaq_presario-182x182.jpg" alt="HP Banner"
                                     class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript"><!--
            $('#banner0').owlCarousel({
                items: 6,
                autoPlay: 3000,
                singleItem: true,
                navigation: false,
                pagination: false,
                transitionStyle: 'fade'
            });
            --></script>

    </aside>
    <div id="content" class="col-sm-9">
        <h2>Laptops &amp; Notebooks</h2>
        <div class="row">
            <div class="col-sm-2">
                <img src="/image/cache/catalog/demo/hp_2-80x80.jpg" alt="Laptops &amp; Notebooks"
                     title="Laptops &amp; Notebooks" class="img-thumbnail">
            </div>
            <div class="col-sm-10">
                <p>
                    Shop Laptop feature only the best laptop deals on the market. By comparing laptop deals from the
                    likes of PC World, Comet, Dixons, The Link and Carphone Warehouse, Shop Laptop has the most
                    comprehensive selection of laptops on the internet. At Shop Laptop, we pride ourselves on offering
                    customers the very best laptop deals. From refurbished laptops to netbooks, Shop Laptop ensures that
                    every laptop - in every colour, style, size and technical spec - is featured on the site at the
                    lowest possible price.
                </p>
            </div>
        </div>
        <hr>
        <h3>Refine Search</h3>
        <div class="row">
            <div class="col-sm-3">
                <ul>
                    <li><a href="/product/category&amp;path=18_46">Macs (0)</a></li>
                    <li><a href="/product/category&amp;path=18_45">Windows (0)</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-sm-6 hidden-xs">
                <div class="btn-group btn-group-sm">
                    <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title=""
                            data-original-title="List">
                        <i class="fa fa-th-list"></i>
                    </button>
                    <button type="button" id="grid-view" class="btn btn-default active" data-toggle="tooltip" title=""
                            data-original-title="Grid">
                        <i class="fa fa-th"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                    <a href="/product/compare" id="compare-total" class="btn btn-link">Product Compare (0)</a>
                </div>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="form-group input-group input-group-sm">
                    <label class="input-group-addon" for="input-sort">Sort By:</label>
                    <select id="input-sort" class="form-control" onchange="location = this.value;">
                        <?php
                        $values = [
                            '' => 'Default',
                            'name' => 'Name (A-Z)',
                            '-name' => 'Name (Z-A)',
                            'price' => 'Price (Low &gt; High)',
                            '-price' => 'Price (High &gt; Low)',
                            'rating' => 'Rating (Highest)',
                            '-rating' => 'Rating (Lowest)',
                        ];
                        $current = Yii::$app->request->get('sort');
                        ?>
                        <?php foreach ($values as $value => $label): ?>
                            <option value="<?= Html::encode(Url::current(['sort' => $value ?? null])) ?>"<?php if ($current === $value): ?> selected="selected" <?php endif; ?>><?= $label ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="form-group input-group input-group-sm">
                    <label class="input-group-addon" for="input-limit">Show:</label>
                    <select id="input-limit" class="form-control" onchange="location = this.value;">
                        <?php
                        $values = [15, 25, 50, 75, 100];
                        $current = $dataProvider->getPagination()->getPageSize();
                        ?>
                        <?php foreach ($values as $value): ?>
                            <option value="<?= Html::encode(Url::current(['per-page' => $value])) ?>"
                                    <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $value ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
            </div>
        </div>
        <div class="row">

            <?php foreach ($dataProvider->getModels() as $product): ?>
                <?= $this->render('_product', [
                    'product' => $product
                ]) ?>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-sm-6 text-left">
                <?= LinkPager::widget([
                    'pagination' => $dataProvider->getPagination()
                ]) ?>
            </div>
            <div class="col-sm-6 text-right">Showing <?= $dataProvider->getCount() ?>
                of <?= $dataProvider->getTotalCount() ?></div>
        </div>
    </div>
</div>