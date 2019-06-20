<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WaterSourceSurveySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="water-source-survey-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'province') ?>

    <?= $form->field($model, 'amphur') ?>

    <?= $form->field($model, 'tambon') ?>

    <?= $form->field($model, 'village_no') ?>

    <?php // echo $form->field($model, 'village_name') ?>

    <?php // echo $form->field($model, 'source_type') ?>

    <?php // echo $form->field($model, 'distance_village_mater') ?>

    <?php // echo $form->field($model, 'safty_manage') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'lon') ?>

    <?php // echo $form->field($model, 'survey_date') ?>

    <?php // echo $form->field($model, 'surveyer') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
