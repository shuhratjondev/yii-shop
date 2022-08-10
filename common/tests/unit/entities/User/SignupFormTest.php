<?php

namespace common\tests\unit\entities\User;

use Codeception\Test\Unit;
use shop\entities\User\User;

class SignupFormTest extends Unit
{

    /**
     * @throws \yii\base\Exception
     */
    public function testCorrectSignup(): void
    {
        $user = User::requestSignup(
            $username = 'some_username',
            $email = 'some_email@example.com',
            $password = 'some_password',
        );
        $this->assertEquals($username, $user->username);
        $this->assertEquals($email, $user->email);
        $this->assertNotEmpty($user->password_hash);
        $this->assertNotEquals($password, $user->password_hash);
        $this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->auth_key);
        $this->assertEquals(User::STATUS_WAIT, $user->status);

    }

}
