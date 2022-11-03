<?php

namespace backend\controllers\shop;

use shop\forms\manage\Tag\TagForm;
use shop\services\manage\Shop\TagMangeService;
use Yii;
use shop\entities\Shop\Tag;
use backend\forms\shop\TagSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends Controller
{
    private TagMangeService $service;

    public function __construct($id, $module, TagMangeService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
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
     * Lists all Tag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tag model.
     * @param int $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new TagForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $model = $this->service->create($form);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $tag = $this->findModel($id);
        $form = new TagForm($tag);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->service->edit($tag->id, $form);
            return $this->redirect(['view', 'id' => $tag->id]);
        }
        return $this->render('update', [
            'model' => $form,
            'tag' => $tag,
        ]);
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Tag
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
