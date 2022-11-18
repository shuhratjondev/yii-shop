<?php
/**
 * User: sh_abdurasulov
 */

use frontend\assets\MagnificPopupAsset;
use shop\entities\Shop\Product\Product;
use shop\forms\Shop\CartForm;
use shop\forms\Shop\ReviewForm;
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $product Product */
/* @var $cartForm CartForm */
/* @var $reviewForm ReviewForm */

MagnificPopupAsset::register($this);

$this->registerMetaTag(['name' => 'description', 'content' => $product->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $product->meta->keywords]);


$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
foreach ($product->category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ['category', 'id' => $product->category->id]];
$this->params['breadcrumbs'][] = $product->name;
?>

<div class="row">
    <div class="col-sm-8">
        <ul class="thumbnails">
            <?php foreach ($product->photos as $i => $photo): ?>
                <?php if ($i === 0): ?>
                    <li>
                        <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>">
                            <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>"
                                 alt="<?= Html::encode($product->name) ?>">
                        </a>
                    </li>
                <?php else: ?>
                    <li class="image-additional">
                        <a class="thumbnail" href="<?= $photo->getThumbFileUrl('file', 'catalog_origin') ?>">
                            <img src="<?= $photo->getThumbFileUrl('file', 'catalog_product_additional') ?>" alt="">
                        </a>
                    </li>
                <?php endif ?>
            <?php endforeach; ?>
        </ul>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
            <li><a href="#tab-specification" data-toggle="tab">Specification</a></li>
            <li><a href="#tab-review" data-toggle="tab">Reviews (0)</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-description">
                <p><?= Html::encode($product->description) ?></p>
            </div>
            <div class="tab-pane" id="tab-specification">
                <table class="table table-bordered">
                    <tbody>
                    <?php foreach ($product->values as $value): ?>
                        <?php if (!empty($value->value)): ?>
                            <tr>
                                <th><?= Html::encode($value->characteristic->name) ?></th>
                                <td><?= Html::encode($value->value) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab-review">
                <div id="review">
                    <p>There are no reviews for this product.</p>
                </div>
                <h2>Write a review</h2>
                <?php if (Yii::$app->user->isGuest): ?>
                    <div class="panel panel-info">
                        <div class="panel-body">
                            Please <?= Html::a('Log in', ['auth/auth/login']) ?> for writing a review
                        </div>
                    </div>
                <?php else: ?>
                    <?php $form = ActiveForm::begin() ?>

                    <?= $form->field($reviewForm, 'vote')->dropDownList($reviewForm->votesList(), ['prompt' => '-- Select --']) ?>
                    <?= $form->field($reviewForm, 'text')->textarea(['rows' => 5]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                    </div>

                    <?php $form = ActiveForm::end() ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="btn-group">
            <button type="button" data-toggle="tooltip" class="btn btn-default" title=""
                    onclick="wishlist.add('<?= $product->id ?>');" data-original-title="Add to Wish List">
                <i class="fa fa-heart"></i>
            </button>
            <button type="button" data-toggle="tooltip" class="btn btn-default" title=""
                    onclick="compare.add('<?= $product->id ?>');" data-original-title="Compare this Product">
                <i class="fa fa-exchange"></i>
            </button>
        </div>
        <h1><?= Html::encode($product->name) ?></h1>
        <ul class="list-unstyled">
            <li>
                Brand:
                <a href="<?= Html::encode(Url::to(['brand', 'id' => $product->brand->id])) ?>">
                    <?= Html::encode($product->brand->name) ?>
                </a>
            </li>
            <li>
                <?php foreach ($product->tags as $tag): ?>
                    <a href="<?= Url::to(['tag', 'id' => $tag->id]) ?>"><?= $tag->name ?></a>
                <?php endforeach; ?>
            </li>
            <li>Product Code: <?= Html::encode($product->code) ?></li>
        </ul>
        <ul class="list-unstyled">
            <li>
                <h2><?= PriceHelper::format($product->price_new) ?> so'm</h2>
            </li>
        </ul>

        <div id="product">
            <hr>
            <h3>Available Options</h3>
            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($cartForm, 'modification')->dropDownList($cartForm->modificationList(), ['prompt' => '-- Select --']) ?>
            <?= $form->field($cartForm, 'quantity')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Add to Cart', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            </div>

            <?php $form = ActiveForm::end() ?>
        </div>

        <div class="rating">
            <p>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>

                <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a> /
                <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a>
            </p>
            <hr>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style"
                 data-url="http://opencart-3/upload/index.php?route=product/product&amp;product_id=43">

                <a class="addthis_button_facebook_like at300b" fb:like:layout="button_count">
                    <div class="fb-like fb_iframe_widget" data-layout="button_count" data-show_faces="false"
                         data-share="false" data-action="like" data-width="90" data-height="25" data-font="arial"
                         data-href="http://opencart-3/upload/index.php?route=product/product&amp;product_id=43"
                         data-send="false" style="height: 25px;" fb-xfbml-state="rendered"
                         fb-iframe-plugin-query="action=like&amp;app_id=172525162793917&amp;container_width=0&amp;font=arial&amp;height=25&amp;href=http%3A%2F%2Fopencart-3%2Fupload%2Findex.php%3Froute%3Dproduct%2Fproduct%26product_id%3D43&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;send=false&amp;share=false&amp;show_faces=false&amp;width=90">
                        <span style="vertical-align: bottom; width: 90px; height: 28px;">
                            <iframe name="f28db7a77faa8"
                                    width="90px"
                                    height="25px"
                                    data-testid="fb:like Facebook Social Plugin"
                                    title="fb:like Facebook Social Plugin"
                                    frameborder="0"
                                    allowtransparency="true"
                                    allowfullscreen="true"
                                    scrolling="no"
                                    allow="encrypted-media"
                                    src="https://www.facebook.com/v2.6/plugins/like.php?action=like&amp;app_id=172525162793917&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df1177b1829e9d18%26domain%3Dopencart-3%26is_canvas%3Dfalse%26origin%3Dhttp%253A%252F%252Fopencart-3%252Ff3c5c7e389f44d4%26relation%3Dparent.parent&amp;container_width=0&amp;font=arial&amp;height=25&amp;href=http%3A%2F%2Fopencart-3%2Fupload%2Findex.php%3Froute%3Dproduct%2Fproduct%26product_id%3D43&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;send=false&amp;share=false&amp;show_faces=false&amp;width=90"
                                    style="border: none; visibility: visible; width: 90px; height: 28px;"
                                    class="">

                            </iframe>
                        </span>
                    </div>
                </a>
                <a class="addthis_button_tweet at300b">
                    <div class="tweet_iframe_widget" style="width: 62px; height: 25px;">
                        <span>
                            <iframe
                                    id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true"
                                    allowfullscreen="true"
                                    class="twitter-share-button twitter-share-button-rendered twitter-tweet-button"
                                    style="position: static; visibility: visible; width: 73px; height: 20px;"
                                    title="Twitter Tweet Button"
                                    src="https://platform.twitter.com/widgets/tweet_button.644279d1635fd969e87af94a98bd232b.en.html#dnt=false&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fopencart-3%2Fupload%2Findex.php%3Froute%3Dproduct%2Fproduct%26product_id%3D43&amp;size=m&amp;text=MacBook%3A&amp;time=1668426974372&amp;type=share&amp;url=http%3A%2F%2Fopencart-3%2Fupload%2Findex.php%3Froute%3Dproduct%2Fproduct%26product_id%3D43%23.Y3Is3MJTBwU.twitter"
                                    data-url="http://opencart-3/upload/index.php?route=product/product&amp;product_id=43#.Y3Is3MJTBwU.twitter">

                            </iframe>
                        </span>
                    </div>
                </a>
                <a class="addthis_button_pinterest_pinit at300b"></a>
                <a class="addthis_counter addthis_pill_style" href="#" style="display: inline-block;">
                    <a class="atc_s addthis_button_compact">Share<span></span></a>
                    <a class="addthis_button_expanded" target="_blank" title="More" href="#"></a>
                </a>
                <div class="atclear">
                </div>
            </div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e">
            </script>
            <!-- AddThis Button END -->
        </div>
    </div>
</div>

<script>
    <!--
    $('select[name=\'recurring_id\'], input[name="quantity"]').change(function () {
        $.ajax({
            url: 'index.php?route=product/product/getRecurringDescription',
            type: 'post',
            data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
            dataType: 'json',
            beforeSend: function () {
                $('#recurring-description').html('');
            },
            success: function (json) {
                $('.alert-dismissible, .text-danger').remove();

                if (json['success']) {
                    $('#recurring-description').html(json['success']);
                }
            }
        });
    });
    //-->
</script>

<!--
<script type="text/javascript">

    $('#button-cart').on('click', function () {
        $.ajax({
            url: 'index.php?route=checkout/cart/add',
            type: 'post',
            data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
            dataType: 'json',
            beforeSend: function () {
                $('#button-cart').button('loading');
            },
            complete: function () {
                $('#button-cart').button('reset');
            },
            success: function (json) {
                $('.alert-dismissible, .text-danger').remove();
                $('.form-group').removeClass('has-error');

                if (json['error']) {
                    if (json['error']['option']) {
                        for (i in json['error']['option']) {
                            var element = $('#input-option' + i.replace('_', '-'));

                            if (element.parent().hasClass('input-group')) {
                                element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            } else {
                                element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            }
                        }
                    }

                    if (json['error']['recurring']) {
                        $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                    }

                    // Highlight any found errors
                    $('.text-danger').parent().addClass('has-error');
                }

                if (json['success']) {
                    $('.breadcrumb').after('<div class="alert alert-success alert-dismissible">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

                    $('html, body').animate({scrollTop: 0}, 'slow');

                    $('#cart > ul').load('index.php?route=common/cart/info ul li');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
</script>
-->
<?php
$js = <<<EOD
$('.thumbnails').magnificPopup({
    type: 'image',
    delegate: 'a',
    gallery: {
        enabled: true
    }
});
EOD;
$this->registerJs($js);

?>
