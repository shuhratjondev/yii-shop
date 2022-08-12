<?php
/**
 * User: sh_abdurasulov
 * @package shop\services\manage
 */

namespace shop\services\manage\User;


use shop\entities\User\User;
use shop\forms\manage\User\UserCreateForm;
use shop\forms\manage\User\UserEditForm;
use shop\repositories\UserRepository;

class UserManageService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws \yii\base\Exception
     */
    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password,
        );
        $this->repository->save($user);
        return $user;
    }

    /**
     * @throws \yii\base\Exception
     */
    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email,
        );
        $this->repository->save($user);
    }

}