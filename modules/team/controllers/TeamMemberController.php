<?php

namespace app\modules\team\controllers;

use Yii;
use app\modules\team\models\TeamMember;
use app\modules\team\models\TeamMemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeamMemberController implements the CRUD actions for TeamMember model.
 */
class TeamMemberController extends Controller
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
     * Lists all TeamMember models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeamMemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TeamMember model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            //'dataProvider'=>$dataProvider
        ]);
    }

    /**
     * Creates a new TeamMember model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($team_id)
    {
        $model = new TeamMember();
        $model->team_id = $team_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['team/view', 'id' => $team_id]);
            //return $this->refresh();
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TeamMember model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(!\Yii::$app->user->can('admin')){
            throw new \yii\web\ForbiddenHttpException("ท่านไม่ได้รับอนุญาตให้ลบข้อมูล กรุณาประสานผู้รับผิดชอบงานของ สคร.ที่ 2 โทร 055-214615");
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['team/view', 'id' => $model->team_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TeamMember model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(!\Yii::$app->user->can('admin')){
            throw new \yii\web\ForbiddenHttpException("ท่านไม่ได้รับอนุญาตให้ลบข้อมูล กรุณาประสานผู้รับผิดชอบงานของ สคร.ที่ 2 โทร 055-214615");
        }
        $model = $this->findModel($id);;
        $model->delete();

        return $this->redirect(['team/view','id'=>$model->team_id]);
    }

    /**
     * Finds the TeamMember model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeamMember the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeamMember::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
