<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class MagnificPopupAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@bower/magnific-popup/dist';

    /**
     * @var string[]
     */
    public $css = [
        'magnific-popup.css'
    ];

    /**
     * @var string[]
     */
    public $js = [
        'jquery.magnific-popup.min.js'
    ];

    public $cssOptions = [
        'media' => 'screen'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];


}