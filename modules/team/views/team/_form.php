<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\team\models\Team */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="team-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'frm-team'
    ]);
    ?>

    <?= $form->field($model, 'team_name')->textInput(['maxlength' => true]) ?>

    <?php
    $items = ['53' => 'อุตรดิตถ์', '63' => 'ตาก', '64' => 'สุโขทัย', '65' => 'พิษณุโลก', '67' => 'เพชรบูรณ์']
    ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'changwat')->dropDownList($items, ['prompt' => '-- เลือก --', 'id' => 'prov']) ?>

        </div>
        <div class="col-lg-6">
            <?php
            echo Html::hiddenInput('amphur', $model->ampur, ['id' => 'amphur']);
            echo $form->field($model, 'ampur')->widget(DepDrop::classname(), [
                'options' => ['id' => 'amp'],
                'pluginOptions' => [
                    'depends' => ['prov'],
                    'initialize' => true,
                    'placeholder' => '-- เลือก --',
                    'url' => Url::to(['/team/team/list-amp']),
                    'params' => ['amphur']
                ]
            ]);
            ?>
        </div>

    </div>

    <?php
    $items = [
        'ทอง' => '1-ทอง',
        'เงิน' => '2-เงิน',
        'ทองแดง' => '3-ทองแดง'
    ];
    ?>

    <?= $form->field($model, 'team_level')->dropDownList($items) ?>

    <?= $form->field($model, 'approv_date')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
