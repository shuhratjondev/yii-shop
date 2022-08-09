<?php

namespace shop\services\auth;

use shop\entities\User;
use DomainException;
use shop\forms\auth\SignupForm;
use yii\mail\MailerInterface;

/**
 * User: sh_abdurasulov
 */
class SignupService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws \yii\base\Exception
     */
    public function signup(SignupForm $form): User
    {
        if (User::findOne(['username' => $form->username, 'status' => User::STATUS_ACTIVE])) {
            throw new DomainException('Username already exist');
        }
        if (User::findOne(['email' => $form->email, 'status' => User::STATUS_ACTIVE])) {
            throw new DomainException('Email already exist');
        }

        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password,
        );

        $this->save($user);

        $sent = $this->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup confirm for ' . \Yii::$app->name)
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email Sending error.');
        }

        return $user;
    }

    public function confirm($token): User
    {
        if (empty($token)) {
            throw new \DomainException('Empty verification token.');
        }
        $user = $this->getByVerificationToken($token);
        $user->confirmSignup();
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
        return $user;
    }

    private function getByVerificationToken($token): ?User
    {
        if (!$user = User::findByVerificationToken($token)) {
            throw new \DomainException('User is not found');
        }
        return $user;
    }

    private function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

}