<?php

namespace frontend\controllers;

use DomainException;
use shop\forms\auth\ResendVerificationEmailForm;
use frontend\forms\VerifyEmailForm;
use shop\services\auth\AuthService;
use shop\services\auth\PasswordResetService;
use shop\services\auth\SignupService;
use shop\services\contact\ContactService;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use shop\forms\auth\LoginForm;
use shop\forms\auth\PasswordResetRequestForm;
use frontend\forms\ResetPasswordForm;
use shop\forms\auth\SignupForm;
use shop\forms\contact\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    private SignupService $signupService;
    private PasswordResetService $passwordResetService;
    private ContactService $contactService;
    private AuthService $authService;

    public function __construct(
        $id, $module,
        PasswordResetService $passwordResetService,
        SignupService $signupService,
        ContactService $contactService,
        AuthService $authService,
        $config = []
    )
    {
        $this->signupService = $signupService;
        $this->passwordResetService = $passwordResetService;
        $this->contactService = $contactService;
        $this->authService = $authService;

        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


}
