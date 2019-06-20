<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WaterSourceSurvey */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'แหล่งน้ำเสี่ยง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="water-source-survey-view">

   

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            [
                'attribute'=>'province',
                'value'=>$model->cchangwat->changwatname,
                     
            ],
            [
                'attribute'=>'amphur',
                'value'=>$model->campur->ampurname,
            ],
            [
                'attribute'=>'tambon',
                'value'=>$model->ctambon->tambonname,
            ],
            //'amphur',
            //'tambon',
            'village_no',
            'village_name',
            'source_type',
            'distance_village_mater',
            'safty_manage',
            'lat',
            'lon',
            'survey_date',
            'surveyer',
            
        ],
    ]) ?>

</div>
