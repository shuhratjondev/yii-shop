<?php
/**
 * User: sh_abdurasulov
 * @package unit\entities\User
 */

namespace unit\entities\User;


use Codeception\Test\Unit;
use shop\entities\User\User;

class ConfirmSignupTest extends Unit
{
    public function testSuccess()
    {
        $user = new User([
            'status' => User::STATUS_WAIT,
            'verification_token' => 'token'
        ]);
        $user->confirmSignup();

        $this->assertEmpty($user->verification_token);
        $this->assertFalse($user->isWait());
        $this->assertTrue($user->isActive());

    }
}