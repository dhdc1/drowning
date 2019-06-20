<?php

namespace app\modules\pop\controllers;

use Yii;
use app\modules\pop\models\PopulationTarget;
use app\modules\pop\models\PopulationTargetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PopulationTargetController implements the CRUD actions for PopulationTarget model.
 */
class PopulationTargetController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all PopulationTarget models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PopulationTargetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PopulationTarget model.
     * @param string $ampurcode
     * @param string $byear
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ampurcode, $byear)
    {
        return $this->render('view', [
            'model' => $this->findModel($ampurcode, $byear),
        ]);
    }

    /**
     * Creates a new PopulationTarget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PopulationTarget();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ampurcode' => $model->ampurcode, 'byear' => $model->byear]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PopulationTarget model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ampurcode
     * @param string $byear
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ampurcode, $byear)
    {
        $model = $this->findModel($ampurcode, $byear);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ampurcode' => $model->ampurcode, 'byear' => $model->byear]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PopulationTarget model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ampurcode
     * @param string $byear
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ampurcode, $byear)
    {
        $this->findModel($ampurcode, $byear)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PopulationTarget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ampurcode
     * @param string $byear
     * @return PopulationTarget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ampurcode, $byear)
    {
        if (($model = PopulationTarget::findOne(['ampurcode' => $ampurcode, 'byear' => $byear])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
