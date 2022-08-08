<?php

namespace shop\repositories;

use shop\entities\User;

/**
 * User: sh_abdurasulov
 */
class UserRepository
{

    public function getByEmail($email): User
    {
        return $this->getBy(['email' => $email]);
    }

    public function findByUsernameOrEmail($username): User
    {
        return $this->getBy(['OR', ['email' => $username], ['username' => $username]]);
    }

    public function getByVerificationToken($token): ?User
    {
        return $this->getBy(['verification_token' => $token]);
    }

    public function getByPasswordResetToken($token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function existsByPasswordRestToken($token): bool
    {
        return (bool)User::findByPasswordResetToken($token);
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }


    private function getBy(array $condition): User
    {
        if ($model = User::find()->andWhere($condition)->limit(1)->one()) {
            return $model;
        }
        throw new NotFoundException('User not found.');
    }


}