<?php

namespace frontend\tests\unit\forms;


use common\fixtures\UserFixture;
use frontend\forms\SignupForm;
use frontend\services\auth\SignupService;

/**
 * User: sh_abdurasulov
 */
class SignupFormTest extends \Codeception\Test\Unit
{

    protected $tester;

    public function _behavior()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testCorrectSignup()
    {
        $form = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
        ]);

        $service = new SignupService();
        $user = $service->signup($form);

        expect($user)->isInstanceOf('common\entities\User');

        expect($user->username)->equals('some_username');
        expect($user->email)->equals('some_email@example.com');
        expect($user->validatePassword('some_password'))->true();

    }

}