<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\pop\models\PopulationBase */

$this->title = 'เพิ่ม';
$this->params['breadcrumbs'][] = ['label' => 'ประชากรกลางปี', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="population-base-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
