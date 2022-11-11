<?php
/**
 * User: sh_abdurasulov
 */


use shop\entities\Shop\Product\Product;
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $product Product */

$url = Url::to(['product', 'id' => $product->id]);
?>


<div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="product-thumb">
        <?php if ($product->mainPhoto): ?>
            <div class="image">
                <a href="/product/product&amp;path=18&amp;product_id=43">
                    <img src="<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?>"
                         alt="" title="" class="img-responsive">
                </a>
            </div>
        <?php endif; ?>
        <div>
            <div class="caption">
                <h4><a href="<?= $url ?>"><?= Html::encode($product->name) ?></a></h4>
                <p><?= Html::encode(StringHelper::truncateWords(strip_tags($product->description), 20)) ?></p>
                <p class="price">
                    <span class="price-new"><?= PriceHelper::format($product->price_new) ?> so'm</span>
                    <?php if ($product->price_old): ?>
                        <span class="price-old"><?= PriceHelper::format($product->price_old) ?> so'm</span>
                    <?php endif; ?>
                </p>
            </div>
            <div class="button-group">
                <button type="button" onclick="cart.add('<?= $product->id ?>', '1');">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span>
                </button>
                <button type="button" data-toggle="tooltip" title="" onclick="wishlist.add('<?= $product->id ?>');"
                        data-original-title="Add to Wish List">
                    <i class="fa fa-heart"></i>
                </button>
                <button type="button" data-toggle="tooltip" title="" onclick="compare.add('<?= $product->id ?>');"
                        data-original-title="Compare this Product">
                    <i class="fa fa-exchange"></i>
                </button>
            </div>
        </div>
    </div>
</div>
