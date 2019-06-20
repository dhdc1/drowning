<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WaterSourceSurvey */

$this->title = 'เพิ่ม';
$this->params['breadcrumbs'][] = ['label' => 'แหล่งน้ำเสี่ยง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="water-source-survey-create">

 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
$this->registerJs($this->render('script.js'));
