<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\team\models\Team */

$this->title = 'เพิ่มทีม';
$this->params['breadcrumbs'][] = ['label' => 'ทีมผู้ก่อการดี', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
