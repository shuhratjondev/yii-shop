<?php
/**
 * User: sh_abdurasulov
 * @package unit\entities\User
 */

namespace unit\entities\User;


use Codeception\Test\Unit;
use shop\entities\User\User;

class RequestSignupTest extends Unit
{

    /**
     * @throws \yii\base\Exception
     */
    public function testSuccess()
    {
        $user = User::requestSignup(
            $username = 'username',
            $email = 'email@site.uz',
            $password = 'password'
        );

        $this->assertEquals($username, $user->username);
        $this->assertEquals($email, $user->email);
        $this->assertNotEmpty($user->password_hash);
        $this->assertNotEquals($password, $user->password_hash);
        $this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->auth_key);
        $this->assertNotEmpty($user->verification_token);
        $this->assertTrue($user->isWait());
        $this->assertFalse($user->isActive());
    }

}