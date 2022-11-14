<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700',
//        'css/site.css',
        'css/owl.carousel.css',
        'css/stylesheet.css',

    ];
    public $js = [
        'js/owl.carousel.min.js',
        'js/common.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'frontend\assets\FontAwesomeAsset',
    ];
}
