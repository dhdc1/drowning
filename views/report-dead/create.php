<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReportDead */

$this->title = 'เพิ่มรายงาน';
$this->params['breadcrumbs'][] = ['label' => 'ทะเบียนรายงานการสอบสวน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-dead-create">

    <h4>รายละเอียดข้อมูลการสอบสวน</h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
$this->registerJs($this->render('script.js'));