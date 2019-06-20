<?php

namespace app\modules\water\controllers;

use Yii;
use app\modules\water\models\WaterSourceSurvey;
use app\modules\water\models\WaterSourceSurveySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * WaterSourceSurveyController implements the CRUD actions for WaterSourceSurvey model.
 */
class WaterSourceSurveyController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all WaterSourceSurvey models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new WaterSourceSurveySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WaterSourceSurvey model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new WaterSourceSurvey model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new WaterSourceSurvey();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing WaterSourceSurvey model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WaterSourceSurvey model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if(!\Yii::$app->user->can('admin')){
            throw new \yii\web\ForbiddenHttpException("ท่านไม่ได้รับอนุญาตให้ลบข้อมูล กรุณาประสานผู้รับผิดชอบงานของ สคร.ที่ 2 โทร 055-214615");
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WaterSourceSurvey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WaterSourceSurvey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = WaterSourceSurvey::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionListAmp() {


        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            $selected = $_POST['depdrop_all_params']['amphur'];

            if ($parents != null) {
                $code = $parents[0];

                $sql = "select ampurcodefull id , ampurname name from campur where changwatcode = '$code' ";
                $raw = \Yii::$app->db->createCommand($sql)->queryAll();



                echo Json::encode(['output' => $raw, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionListTmb() {


        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            $selected = $_POST['depdrop_all_params']['tambon'];

            if ($parents != null) {
                $code = $parents[0];

                $sql = "select tamboncodefull id , tambonname name from ctambon where ampurcode = '$code' ";
                $raw = \Yii::$app->db->createCommand($sql)->queryAll();


                echo Json::encode(['output' => $raw, 'selected' => $selected]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionTest() {

        $sql = "select ampurcodefull id , ampurname name from campur where changwatcode = '65' ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        echo "<pre>";
        print_r($raw);
    }

}
