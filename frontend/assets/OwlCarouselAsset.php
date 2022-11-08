<?php
/**
 * User: sh_abdurasulov
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class OwlCarouselAsset extends AssetBundle
{
//    public $sourcePath = '@bower/owl.carousel';

    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'
    ];

    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'
    ];

}