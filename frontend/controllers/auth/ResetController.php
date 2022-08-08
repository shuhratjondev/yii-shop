<?php
/**
 * User: sh_abdurasulov
 * @package frontend\controllers\auth
 */

namespace frontend\controllers\auth;


use DomainException;
use frontend\forms\ResetPasswordForm;
use shop\forms\auth\PasswordResetRequestForm;
use shop\services\auth\PasswordResetService;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class ResetController extends Controller
{

    private PasswordResetService $passwordResetService;

    public function __construct($id, $module, PasswordResetService $passwordResetService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $form = new PasswordResetRequestForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->passwordResetService->request($form);
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('request', [
            'model' => $form,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionConfirm($token)
    {
        try {
            $this->passwordResetService->validateToken($token);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $form = new ResetPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->passwordResetService->reset($token, $form);
                Yii::$app->session->setFlash('success', 'New ');
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            return $this->goHome();
        }

        return $this->render('confirm', [
            'model' => $form,
        ]);
    }


}