<?php
/**
 * User: sh_abdurasulov
 * @package shop\services\auth
 */

namespace shop\services\auth;


use shop\entities\User\User;
use shop\forms\auth\LoginForm;
use shop\repositories\UserRepository;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function auth(LoginForm $form): User
    {
        $user = $this->userRepository->findByUsernameOrEmail($form->username);

        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or password');
        }
        return $user;
    }

}