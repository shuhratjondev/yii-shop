<?php

namespace frontend\tests\unit\entities\User;

use Codeception\Test\Unit;
use common\entities\User;
use frontend\models\SignupForm;

class SignupFormTest extends Unit
{

    public function testCorrectSignup()
    {
        $user = User::signup(
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
        $this->assertEquals(User::STATUS_ACTIVE, $user->status);

    }

}
