<?php
/**
 * User: sh_abdurasulov
 * @package frontend\controllers\auth
 */

namespace frontend\controllers\auth;


use DomainException;
use shop\forms\auth\ResendVerificationEmailForm;
use shop\forms\auth\SignupForm;
use shop\services\auth\SignupService;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class SignupController extends Controller
{

    private SignupService $signupService;

    public function __construct($id, $module, SignupService $signupService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->signupService = $signupService;
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->signupService->signup($form);
                if (Yii::$app->user->login($user)) {
                    Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
                    return $this->goHome();
                }
            } catch (DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('index', [
            'model' => $form,
        ]);
    }


    /**
     * @param $token
     * @return \yii\web\Response
     */
    public function actionConfirm($token): \yii\web\Response
    {
        try {
            $user = $this->signupService->confirm($token);
            Yii::$app->user->login($user);
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
        } catch (InvalidArgumentException $e) {
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        }
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResend()
    {
        $form = new ResendVerificationEmailForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ($form->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resend', [
            'model' => $form
        ]);
    }

}