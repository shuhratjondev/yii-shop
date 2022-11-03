<?php
/**
 * User: sh_abdurasulov
 */

/* @var $params */

return [
    'class' => 'yii\web\urlManager',
    //'hostInfo' => $params['backendHostInfo'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '<action:login|logout>' => 'auth/<action>',

        '<controller:[\w\-]>' => '<controller/index>',
        '<controller:[\w\-]>/<id:\d+>' => '<controller/view>',
        '<controller:[\w\-]>/<action:[\w-]+>' => '<controller>/<action>',
        '<controller:[\w\-]>/<action:[\w\-]+>' => '<controller>/<action>',
    ],
];
