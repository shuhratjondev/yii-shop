<?php

namespace frontend\services\auth;

use common\entities\User;
use DomainException;
use frontend\forms\SignupForm;
use RuntimeException;

/**
 * User: sh_abdurasulov
 */
class SignupService
{
    public function signup(SignupForm $form): User
    {
        if(User::findOne(['username' => $form->username, 'status' => User::STATUS_ACTIVE])){
            throw new DomainException('Username already exist');
        }
        if(User::findOne(['email' => $form->email, 'status' => User::STATUS_ACTIVE])){
            throw new DomainException('Email already exist');
        }

        $user = User::signup(
            $form->username,
            $form->email,
            $form->password,
        );

        if (!$user->save()) {
            throw new RuntimeException('Saving error.');
        }
        return $user;
    }
}