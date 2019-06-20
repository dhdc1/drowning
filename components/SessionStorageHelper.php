<?php

namespace app\components;

use yii\base\Component;

class SessionStorageHelper extends Component {

    public static function setData($key, $value) {


        $js = <<<JS
      sessionStorage.setItem("$key","$value");  
JS;

        \Yii::$app->view->registerJs($js);
    }

    public static function getData($key) {
        $js = <<<JS
      sessionStorage.getItem("$key");  
JS;

        \Yii::$app->view->registerJs($js);
    }

}
