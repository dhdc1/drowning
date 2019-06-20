<?php

namespace app\modules\pop\controllers;

use Yii;
use app\modules\pop\models\PopulationBase;
use app\modules\pop\models\PopulationBaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PopulationBaseController implements the CRUD actions for PopulationBase model.
 */
class PopulationBaseController extends Controller
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
     * Lists all PopulationBase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PopulationBaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PopulationBase model.
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
     * Creates a new PopulationBase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PopulationBase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ampurcode' => $model->ampurcode, 'byear' => $model->byear]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PopulationBase model.
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
     * Deletes an existing PopulationBase model.
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
     * Finds the PopulationBase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ampurcode
     * @param string $byear
     * @return PopulationBase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ampurcode, $byear)
    {
        if (($model = PopulationBase::findOne(['ampurcode' => $ampurcode, 'byear' => $byear])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
