<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\WaterSourceSurvey */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="water-source-survey-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4">

        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?php
            $items = ['53' => 'อุตรดิตถ์', '63' => 'ตาก', '64' => 'สุโขทัย', '65' => 'พิษณุโลก', '67' => 'เพชรบูรณ์']
            ?>
            <?= $form->field($model, 'province')->dropDownList($items, ['prompt' => '-- เลือก --', 'id' => 'prov']) ?>
        </div>
        <div class="col-lg-4">


            <?php
            echo Html::hiddenInput('amphur', $model->amphur, ['id' => 'amphur']);
            echo $form->field($model, 'amphur')->widget(DepDrop::classname(), [
                'options' => ['id' => 'amp'],
                'pluginOptions' => [
                    'depends' => ['prov'],
                    'initialize' => true,
                    'placeholder' => '-- เลือก --',
                    'url' => Url::to(['/water/water-source-survey/list-amp']),
                    'params' => ['amphur']
                ]
            ]);
            ?>

        </div>
        <div class="col-lg-4">
            <?php
            echo Html::hiddenInput('tambon', $model->tambon, ['id' => 'tambon']);
            echo $form->field($model, 'tambon')->widget(DepDrop::classname(), [
                'options' => ['id' => 'tmb'],
                'pluginOptions' => [
                    'depends' => ['amp'],
                    'initialize' => true,
                    'placeholder' => '-- เลือก --',
                    'url' => Url::to(['/water/water-source-survey/list-tmb']),
                    'params' => ['tambon']
                ]
            ]);
            ?>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'village_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'village_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'source_type')->dropDownList(['แม่น้ำ' => 'แม่น้ำ', 'อ่าง-ฝายเก็บน้ำ' => 'อ่าง-ฝายเก็บน้ำ', 'เขื่อน' => 'เขื่อน', 'ห้วย-คลองสาธารณะ' => 'ห้วย-คลองสาธารณะ', 'บ่อน้ำ-สระขุดทางการเกษตร' => 'บ่อน้ำ-สระขุดทางการเกษตร', 'สระว่ายน้ำ' => 'สระว่ายน้ำ', 'ภาชนะเก็บน้ำ-อ่างอาบน้ำ' => 'ภาชนะเก็บน้ำ-อ่างอาบน้ำ', 'อ่างเลี้ยงปลา-อ่างบัว' => 'อ่างเลี้ยงปลา-อ่างบัว',]) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'distance_village_mater')->textInput() ?>

        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'safty_manage')->dropDownList(['ไม่มีการป้องกัน' => 'ไม่มีการป้องกัน', 'มีแนวกั้น-รั้วกัน' => 'มีแนวกั้น-รั้วกัน', 'มีป้ายคำเตือน' => 'มีป้ายคำเตือน', 'มีวัสดุอุปกรณ์ช่วยคนตกน้ำ' => 'มีวัสดุอุปกรณ์ช่วยคนตกน้ำ',]) ?>


        </div>

    </div>


    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?=
            $form->field($model, 'lon', [
                'template' => '{label}<div class="input-group">{input}<span  id="gps" class="btn btn-default input-group-addon"><i class="glyphicon glyphicon-screenshot"></i></span></div>{error}{hint}'
            ])->textInput(['maxlength' => true])
            ?>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'survey_date')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-lg-6">
<?= $form->field($model, 'surveyer')->dropDownList(['จนท.สาธารณสุข' => 'จนท.สาธารณสุข', 'อาสาสมัครสาธารณสุข' => 'อาสาสมัครสาธารณสุข', 'กำนัน-ผู้ใหญ่บ้าน' => 'กำนัน-ผู้ใหญ่บ้าน', 'องค์การปกครองส่วนท้องถิ่น' => 'องค์การปกครองส่วนท้องถิ่น',]) ?>

        </div>

    </div>


    <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>



