<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pop\models\PopulationTarget */

$this->title = $model->ampurcode;
$this->params['breadcrumbs'][] = ['label' => 'เด็ก0-15ปี', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="population-target-view">

  

    <p>
        <?= Html::a('Update', ['update', 'ampurcode' => $model->ampurcode, 'byear' => $model->byear], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ampurcode' => $model->ampurcode, 'byear' => $model->byear], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'ampurcode',
                'value'=>$model->campur->ampurname
            ],
            [
                'attribute'=>'changwatcode',
                'value'=>$model->cchangwat->changwatname
            ],
            'byear',
            'pop_male',
            'pop_female',
        ],
    ]) ?>

</div>
