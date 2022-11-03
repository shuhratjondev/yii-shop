<?php

namespace backend\controllers\shop;

use shop\forms\manage\Shop\CharacteristicForm;
use shop\services\manage\Shop\CharacteristicManageService;
use Yii;
use shop\entities\Shop\Characteristic;
use backend\forms\Shop\CharacteristicSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;

/**
 * CharacteristicController implements the CRUD actions for Characteristic model.
 */
class CharacteristicController extends Controller
{
    private CharacteristicManageService $service;

    public function __construct($id, $module, CharacteristicManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Characteristic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CharacteristicSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Characteristic model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Characteristic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CharacteristicForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $model = $this->service->create($form);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Characteristic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new CharacteristicForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($model->id, $form);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $form,
            'characteristic' => $model,
        ]);
    }

    /**
     * Deletes an existing Characteristic model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->service->remove($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Characteristic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Characteristic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Characteristic
    {
        if (($model = Characteristic::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
