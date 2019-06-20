<?php

namespace app\modules\team\controllers;

use Yii;
use app\modules\team\models\Team;
use app\modules\team\models\TeamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\modules\team\models\TeamMemberSearch;

/**
 * TeamController implements the CRUD actions for Team model.
 */
class TeamController extends Controller {

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
     * Lists all Team models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TeamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Team model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {

        $searchModel = new TeamMemberSearch();
        $searchModel->team_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Team model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Team();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Team model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if(!\Yii::$app->user->can('admin')){
            throw new \yii\web\ForbiddenHttpException("ท่านไม่ได้รับอนุญาตให้ลบข้อมูล กรุณาประสานผู้รับผิดชอบงานของ สคร.ที่ 2 โทร 055-214615");
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view','id'=>$id]);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Team model.
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
     * Finds the Team model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Team the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Team::findOne($id)) !== null) {
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

}
