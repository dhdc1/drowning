<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\team\models\Team */

$this->title = 'แก้ไขทีม : ' . $model->team_name;
$this->params['breadcrumbs'][] = ['label' => 'ทีมผู้ก่อการดี', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->team_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="team-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
