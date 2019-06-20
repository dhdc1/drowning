<?php

namespace app\modules\news\controllers;

use Yii;
use yii\web\Controller;
use app\modules\news\models\News;
use app\modules\news\models\NewsSearch;
/**
 * Default controller for the `news` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   public function actionDownload($file=null)
   {
      return \Yii::$app->response->sendFile($file);
   }


}
