<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReportDead */

$this->title = 'เอกสารหมายเลข ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ทะเบียนรายงานการสอบสวน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "เอกสารหมายเลข " .$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="report-dead-update">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
$this->registerJs($this->render('script.js'));