<?php
/**
 * User: sh_abdurasulov
 */

/* @var $params */

return [
    'class' => 'yii\web\urlManager',
    //'hostInfo' => $params['frontendHostInfo'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '' => 'site/index',
        'contact' => 'contact/index',
        'signup' => 'auth/signup/index',
        'signup/<action:[\w-]+>' => 'auth/signup/<action>',
        '<action:login|logout>' => 'auth/auth/<action>',

        //'<action:login|signup|logout>' => 'site/<action>',

        '<controller:[\w\-]+>' => '<controller/index>',
        '<controller:[\w\-]+>/<id:\d+>' => '<controller/view>',
        '<controller:[\w\-]+>/<action:[\w-]+>' => '<controller>/<action>',
        '<controller:[\w\-]+>/<action:[\w\-]+>' => '<controller>/<action>',
    ]
];