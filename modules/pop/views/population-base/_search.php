<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pop\models\PopulationBaseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="population-base-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ampurcode') ?>

    <?= $form->field($model, 'changwatcode') ?>

    <?= $form->field($model, 'byear') ?>

    <?= $form->field($model, 'pop_male') ?>

    <?= $form->field($model, 'pop_female') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
