<?php

namespace app\modules\dashboard\controllers;

use yii\web\Controller;

/**
 * Default controller for the `dashboard` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($cyear = Null) {
        if (empty($cyear)) {
            $cyear = date('Y');
        }
        return $this->render('index', [
                    'cyear' => $cyear
        ]);
    }

}
