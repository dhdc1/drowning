<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReportDead */

$this->title = "เอกสารหมายเลข ". $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ทะเบียนรายงานการสอบสวน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-dead-view">

   

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="glyphicon glyphicon-print"></i> Print', ['print', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cid',
            'icd_code',
            'drowning_date',
            'drowning_time',
            'dead_date',
            'pname',
            'fname',
            'lname',
            'sex',
            'home_addr',
            'no_addr',
            'moo_addr',
            //'province_addr',
            [
                'attribute'=>'province_addr',
                'value'=>$model->changwataddr->changwatname
            ],
            //'amphur_addr',
            [
                'attribute'=>'amphur_addr',
                'value'=>$model->ampuraddr->ampurname
            ],
            //'tambon_addr',
            [
                'attribute'=>'tambon_addr',
                'value'=>$model->tambonaddr->tambonname
            ],
            'age',
'ageMonth',
            'national',
            'can_swim',
            'drowning_type',
            'pool_depth',
            'location_lat',
            'location_lon',
            [
                //'label' => 'Upload Picture',
                'attribute' => 'picture',
                'format' => 'html',
                'value' => function($model){
                    return yii\bootstrap\Html::img($model->tmp_picture,['width'=>'300']);
                }
            ],
            'drowning_location:ntext',
            [
                'attribute'=>'drowning_province',
                'value'=>$model->changwatdrown->changwatname
            ],
            [
                'attribute'=>'drowning_amphur',
                'value'=>$model->ampurdrown->ampurname
            ],
            [
                'attribute'=>'drowning_tambon',
                'value'=>$model->tambondrown->tambonname
            ],
            
            'drowning_safty',
            'drowning_safty_des',
            'before_with',
            'drowning_with',
            'drowning_number',
            'drowning_number_dead',
            'drowning_number_alive',
            'drowning_why',
            'drowning_why_des',
            'drowning_risk_alcohol',
            'drowning_risk_addicted',
            'drowning_risk_drug',
            'drowning_risk_disability',
            'drowning_risk_none',
            'drowning_risk_disease',
            'drowning_risk_disease_des',
            'drowning_risk_other',
            'drowning_risk_other_des',
            'drowning_length',
            'drowning_accessory',
            'drowning_accessory_yes',
            'drowning_accessory_yes_des',
            'drowning_after_dead',
            'drowning_helper',
            'drowning_helper_drop_des',
            'drowning_rescue_water',
            'drowning_recue_no_des',
            'drowning_recue_yes',
            'drowning_rescue_yes_des',
            'drowning_refer',
            'drowning_refer_hosp',
            'drowning_des',
            'defend_drowning',
            'defend_drowning_des',
            'report_name',
            'report_job',
            'report_office',
            'report_province',
            'report_tel',
            'report_fax',
            'report_date',
            'd_update',
        ],
    ]) ?>

</div>
