<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WaterSourceSurvey */

$this->title = 'แก้ไข: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'แหล่งน้ำเสี่ยง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="water-source-survey-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
$this->registerJs($this->render('script.js'));

