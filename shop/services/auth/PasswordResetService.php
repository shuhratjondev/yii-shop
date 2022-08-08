<?php

namespace shop\services\auth;

use frontend\forms\ResetPasswordForm;
use shop\forms\auth\PasswordResetRequestForm;
use shop\repositories\UserRepository;
use Yii;
use yii\mail\MailerInterface;

/**
 * User: sh_abdurasulov
 */
class PasswordResetService
{
    private $mailer;
    private UserRepository $userRepository;

    public function __construct(MailerInterface $mailer, UserRepository $userRepository)
    {
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
    }


    /**
     * @throws \yii\base\Exception
     */
    public function request(PasswordResetRequestForm $form): void
    {
        $user = $this->userRepository->getByEmail($form->email);
        if (!$user->isActive()) {
            throw new \DomainException('User is not active');
        }

        $user->requestPasswordReset();
        $this->userRepository->save($user);

        $sent = $this->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }


    public function validateToken($token): void
    {
        if (empty($token) && !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }

        if (!$this->userRepository->existsByPasswordRestToken($token)) {
            throw new \DomainException('Wrong password reset token');
        }
    }

    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->userRepository->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->userRepository->save($user);
    }

}