<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pop\models\PopulationBase */

$this->title = 'แก้ไข: ' . $model->ampurcode;
$this->params['breadcrumbs'][] = ['label' => 'ประชากรกลางปี', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ampurcode, 'url' => ['view', 'ampurcode' => $model->ampurcode, 'byear' => $model->byear]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="population-base-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
