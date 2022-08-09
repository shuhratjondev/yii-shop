<?php
/**
 * User: sh_abdurasulov
 * @package shop\services\auth
 */

namespace shop\services\auth;


use DomainException;
use shop\entities\User;
use shop\repositories\UserRepository;

class NetworkService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $network
     * @param $identity
     * @return array|User|\yii\db\ActiveRecord|null
     */
    public function auth($network, $identity)
    {
        if ($user = $this->userRepository->findByNetworkIdentity($network, $identity)) {
            return $user;
        }
        $user = User::signupByNetwork($network, $identity);
        $this->userRepository->save($user);
        return $user;
    }

    /**
     * @param $id
     * @param $network
     * @param $identity
     */
    public function attach($id, $network, $identity): void
    {
        if ($this->userRepository->findByNetworkIdentity($network, $identity)) {
            throw new DomainException('Network is already signed up.');
        }
        $user = $this->userRepository->get($id);
        $user->attachNetwork($network, $identity);
        $this->userRepository->save($user);
    }

}