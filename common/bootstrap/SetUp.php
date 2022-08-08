<?php

namespace common\bootstrap;

use shop\services\auth\PasswordResetService;
use shop\services\contact\ContactService;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

/**
 * User: sh_abdurasulov
 */
class SetUp implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);

        $container->setSingleton(PasswordResetService::class, [], [
            $app->mailer,
        ]);

    }
}