<?php

namespace app\modules\news\controllers;

use Yii;
use app\modules\news\models\News;
use app\modules\news\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;

use yii\imagine\Image;
use Imagine\Image\Box;
/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */

    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        $model->d_update = date('Y-m-d');

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/
        
        if ($model->load(Yii::$app->request->post())) {
            $model->picture = UploadedFile::getInstance($model, 'picture');
            $model->attach = UploadedFile::getInstance($model, 'attach');
            
            if ($model->validate()) {
                if ($model->picture) {
                    $filePath = 'uploads/newspic/' . 'pic_news' . '.' . $model->picture->extension;
                    $thumbnailImagePath = 'uploads/newspic/' . 'pictmp_' . date('YmdHis') . '.' . $model->picture->extension;
                    if ($model->picture->saveAs($filePath)) {
                        $tmpPath = Image::getImagine()->open($filePath)->thumbnail(new Box(600, 600))->save($thumbnailImagePath, ['quality' => 50]);
                        unlink($filePath);
                        $model->picture = $thumbnailImagePath;
                    }

                }
                if ($model->attach) {
                    $filePath = 'uploads/attach/' . 'attach_' .date('YmdHis') .  '.' . $model->attach->extension;
                    
                    if ($model->attach->saveAs($filePath)) {
                        
                        $model->attach = $filePath;
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
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->d_update = date('Y-m-d');

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/
        
        if ($model->load(Yii::$app->request->post())) {
            $model->picture = UploadedFile::getInstance($model, 'picture');
            $model->attach = UploadedFile::getInstance($model, 'attach');
            
            if ($model->validate()) {
                if ($model->picture) {
                    $filePath = 'uploads/newspic/' . 'pic_news' . '.' . $model->picture->extension;
                    $thumbnailImagePath = 'uploads/newspic/' . 'pictmp_' . date('YmdHis') . '.' . $model->picture->extension;
                    if ($model->picture->saveAs($filePath)) {
                        $tmpPath = Image::getImagine()->open($filePath)->thumbnail(new Box(600, 600))->save($thumbnailImagePath, ['quality' => 50]);
                        unlink($filePath);
                        $model->picture = $thumbnailImagePath;
                    }

                }
                if ($model->attach) {
                    $filePath = 'uploads/attach/' . 'attach_' .date('YmdHis') .  '.' . $model->attach->extension;
                    
                    if ($model->attach->saveAs($filePath)) {
                        
                        $model->attach = $filePath;
                    }

                }
                
                if ($model->save(false)) {
                    //return $this->redirect(['view', 'id' => $model->id]);
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
