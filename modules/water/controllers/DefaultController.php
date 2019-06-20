<?php

namespace app\modules\water\controllers;

use yii\web\Controller;

/**
 * Default controller for the `water` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['/water/water-source-survey/index']);
    }
}
