<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class FontAwesomeAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/fortawesome/font-awesome';

    /**
     * @var string[]
     */
    public $css = [
        'css/font-awesome.min.css'
    ];

    /**
     * @var bool
     */
    public $cdn = false;

    /**
     * @var string
     */
    public $cdnVersion = 'v4.7';

    /**
     * @var string[]
     */
    public $cdnCss = ['https://cdnjs.cloudflare.com/ajax/libs/font-awesome/%s/css/all.min.css'];
    /**
     * @var string[]
     */
    public $cdnJs = ['https://cdnjs.cloudflare.com/ajax/libs/font-awesome/%s/js/all.min.js'];

    public function init()
    {
        if ($this->cdn) {
            $this->sourcePath = null;

            $this->css = [];
            foreach ($this->cdnCss as $css) {
                $this->css[] = sprintf($css, $this->cdnVersion);
            }

            $this->js = [];
            foreach ($this->cdnJs as $js) {
                $this->js[] = sprintf($js, $this->cdnVersion);
            }
        }
        parent::init();
    }
}