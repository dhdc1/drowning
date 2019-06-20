<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReportDeadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-dead-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cid') ?>

    <?= $form->field($model, 'icd_code') ?>

    <?= $form->field($model, 'drowning_date') ?>

    <?= $form->field($model, 'drowning_time') ?>

    <?php // echo $form->field($model, 'dead_date') ?>

    <?php // echo $form->field($model, 'pname') ?>

    <?php // echo $form->field($model, 'fname') ?>

    <?php // echo $form->field($model, 'lname') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'home_addr') ?>

    <?php // echo $form->field($model, 'no_addr') ?>

    <?php // echo $form->field($model, 'moo_addr') ?>

    <?php // echo $form->field($model, 'province_addr') ?>

    <?php // echo $form->field($model, 'amphur_addr') ?>

    <?php // echo $form->field($model, 'tambon_addr') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'national') ?>

    <?php // echo $form->field($model, 'can_swim') ?>

    <?php // echo $form->field($model, 'drowning_type') ?>

    <?php // echo $form->field($model, 'pool_depth') ?>

    <?php // echo $form->field($model, 'location_lat') ?>

    <?php // echo $form->field($model, 'location_lon') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'drowning_location') ?>

    <?php // echo $form->field($model, 'drowning_province') ?>

    <?php // echo $form->field($model, 'drowning_amphur') ?>

    <?php // echo $form->field($model, 'drowning_tambon') ?>

    <?php // echo $form->field($model, 'drowning_safty') ?>

    <?php // echo $form->field($model, 'drowning_safty_des') ?>

    <?php // echo $form->field($model, 'before_with') ?>

    <?php // echo $form->field($model, 'drowning_with') ?>

    <?php // echo $form->field($model, 'drowning_number') ?>

    <?php // echo $form->field($model, 'drowning_number_dead') ?>

    <?php // echo $form->field($model, 'drowning_number_alive') ?>

    <?php // echo $form->field($model, 'drowning_why') ?>

    <?php // echo $form->field($model, 'drowning_why_des') ?>

    <?php // echo $form->field($model, 'drowning_risk_alcohol') ?>

    <?php // echo $form->field($model, 'drowning_risk_addicted') ?>

    <?php // echo $form->field($model, 'drowning_risk_drug') ?>

    <?php // echo $form->field($model, 'drowning_risk_disability') ?>

    <?php // echo $form->field($model, 'drowning_risk_none') ?>

    <?php // echo $form->field($model, 'drowning_risk_disease') ?>

    <?php // echo $form->field($model, 'drowning_risk_disease_des') ?>

    <?php // echo $form->field($model, 'drowning_risk_other') ?>

    <?php // echo $form->field($model, 'drowning_risk_other_des') ?>

    <?php // echo $form->field($model, 'drowning_length') ?>

    <?php // echo $form->field($model, 'drowning_accessory') ?>

    <?php // echo $form->field($model, 'drowning_accessory_yes') ?>

    <?php // echo $form->field($model, 'drowning_accessory_yes_des') ?>

    <?php // echo $form->field($model, 'drowning_after_dead') ?>

    <?php // echo $form->field($model, 'drowning_helper') ?>

    <?php // echo $form->field($model, 'drowning_helper_drop_des') ?>

    <?php // echo $form->field($model, 'drowning_rescue_water') ?>

    <?php // echo $form->field($model, 'drowning_recue_no_des') ?>

    <?php // echo $form->field($model, 'drowning_recue_yes') ?>

    <?php // echo $form->field($model, 'drowning_rescue_yes_des') ?>

    <?php // echo $form->field($model, 'drowning_refer') ?>

    <?php // echo $form->field($model, 'drowning_refer_hosp') ?>

    <?php // echo $form->field($model, 'drowning_des') ?>

    <?php // echo $form->field($model, 'defend_drowning') ?>

    <?php // echo $form->field($model, 'defend_drowning_des') ?>

    <?php // echo $form->field($model, 'report_name') ?>

    <?php // echo $form->field($model, 'report_job') ?>

    <?php // echo $form->field($model, 'report_office') ?>

    <?php // echo $form->field($model, 'report_province') ?>

    <?php // echo $form->field($model, 'report_tel') ?>

    <?php // echo $form->field($model, 'report_fax') ?>

    <?php // echo $form->field($model, 'report_date') ?>

    <?php // echo $form->field($model, 'd_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
