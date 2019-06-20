<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\pop\models\PopulationTarget */

$this->title = 'เพิ่ม';
$this->params['breadcrumbs'][] = ['label' => 'เด็ก0-15ปี', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="population-target-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
