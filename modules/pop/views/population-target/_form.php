<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\pop\models\PopulationTarget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="population-target-form">

    <?php $form = ActiveForm::begin(); ?>



    <?php
    $items = ['53' => 'อุตรดิตถ์', '63' => 'ตาก', '64' => 'สุโขทัย', '65' => 'พิษณุโลก', '67' => 'เพชรบูรณ์']
    ?>
    <?= $form->field($model, 'changwatcode')->dropDownList($items, ['id' => 'changwat', 'prompt' => '--เลือก--']) ?>

    <?php
    echo Html::hiddenInput('ampur_selected', $model->ampurcode, ['id' => 'ampur_selected']);
    echo $form->field($model, 'ampurcode')->widget(DepDrop::classname(), [
        'options' => ['id' => 'amp'],
        'pluginOptions' => [
            'depends' => ['changwat'],
            'initialize' => true,
            'placeholder' => '-- เลือก --',
            'url' => Url::to(['/pop/default/list-ampur']),
            'params' => ['ampur_selected']
        ]
    ]);
    ?>

    <?= $form->field($model, 'byear')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pop_male')->textInput() ?>

    <?= $form->field($model, 'pop_female')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
