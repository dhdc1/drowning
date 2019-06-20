<?php

namespace app\modules\pop\controllers;

use yii\web\Controller;
use yii\helpers\Json;

/**
 * Default controller for the `pop` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionListAmpur() {
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            $selected = $_POST['depdrop_all_params']['ampur_selected'];


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
