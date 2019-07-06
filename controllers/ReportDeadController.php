<?php

namespace app\controllers;

use Yii;
use app\models\ReportDead;
use app\models\ReportDeadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\filters\AccessControl;
use app\components\CheckArea;

/**
 * ReportDeadController implements the CRUD actions for ReportDead model.
 */
class ReportDeadController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ReportDead models.
     * @return mixed
     */
    public function actionIndex($s_year = Null, $s_nation = NULL, $s_age = NULL) {
        $searchModel = new ReportDeadSearch();
        $params = Yii::$app->request->queryParams;
        $params['ReportDeadSearch']['s_year'] = $s_year;
        $params['ReportDeadSearch']['s_nation'] = $s_nation;
        $params['ReportDeadSearch']['s_age'] = $s_age;
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    's_year' => $s_year,
                    's_nation' => $s_nation,
                    's_age' => $s_age,
                    'params'=>$params
        ]);
    }

    /**
     * Displays a single ReportDead model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        CheckArea::allowAccessCase($id);
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ReportDead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ReportDead();
        $model->d_update = date('Y-m-d');

        /* if ($model->load(Yii::$app->request->post())) {

          $model->picture = UploadedFile::getInstance($model, 'picture');
          $image_name = $model -> date('Y-m-d').rand(1, 4000).'.'.$model->picture->extension;
          $image_path = 'uploads/'.$image_name;
          $model->picture->saveAs($image_path);
          $model->picture = $image_path;

          $model->save();
          return $this->redirect(['index']);
          } */
        if ($model->load(Yii::$app->request->post())) {
            $model->upload_pic = UploadedFile::getInstance($model, 'upload_pic');

            if ($model->validate()) {
                if ($model->upload_pic) {
                    $filePath = 'uploads/' . 'pic_' . date('YmdHis') . '.' . $model->upload_pic->extension;
                    $thumbnailImagePath = 'uploads/thumbnail/' . 'pictmp_' . date('YmdHis') . '.' . $model->upload_pic->extension;
                    if ($model->upload_pic->saveAs($filePath)) {
                        $tmpPath = Image::getImagine()->open($filePath)->thumbnail(new Box(600, 600))->save($thumbnailImagePath, ['quality' => 50]);
                        $model->picture = $filePath;
                        $model->tmp_picture = $thumbnailImagePath;
                    }
                }

                if ($model->save(false)) {
                    //return $this->redirect(['view', 'id' => $model->id]);
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing ReportDead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->d_update = date('Y-m-d');
        /*
          if ($model->load(Yii::$app->request->post())) {

          $model->picture = UploadedFile::getInstance($model, 'picture');
          $image_name = $model->drowning_date . rand(1, 4000) . '.' . $model->picture->extension;
          $image_path = 'uploads/' . $image_name;
          $model->picture->saveAs($image_path);
          $model->picture = $image_path;

          $model->save();
          return $this->redirect(['view', 'id' => $model->id]);
          }
         */

        if ($model->load(Yii::$app->request->post())) {
            $model->upload_pic = UploadedFile::getInstance($model, 'upload_pic');

            if ($model->validate()) {
                if ($model->upload_pic) {
                    $filePath = 'uploads/' . 'pic_' . date('YmdHis') . '.' . $model->upload_pic->extension;
                    $thumbnailImagePath = 'uploads/thumbnail/' . 'pictmp_' . date('YmdHis') . '.' . $model->upload_pic->extension;
                    if ($model->upload_pic->saveAs($filePath)) {
                        $tmpPath = Image::getImagine()->open($filePath)->thumbnail(new Box(600, 600))->save($thumbnailImagePath, ['quality' => 50]);
                        $model->picture = $filePath;
                        $model->tmp_picture = $thumbnailImagePath;
                    }
                }

                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                    //return $this->redirect(['index']);
                }
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ReportDead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {

        CheckArea::allowAccessCase();
        if (!\Yii::$app->user->can('admin')) {
            throw new \yii\web\ForbiddenHttpException("ท่านไม่ได้รับอนุญาตให้ลบข้อมูล กรุณาประสานผู้รับผิดชอบงานของ สคร.ที่ 2 โทร 055-214615");
            return;
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReportDead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReportDead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ReportDead::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionListAmp() {


        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            $selected = $_POST['depdrop_all_params']['amphur_selected'];


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

            $selected = $_POST['depdrop_all_params']['tambon_selected'];



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

    public function actionListAmp2() {


        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            $selected = $_POST['depdrop_all_params']['amphur_selected_2'];


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

    public function actionListTmb2() {


        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            $selected = $_POST['depdrop_all_params']['tambon_selected_2'];



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

}
