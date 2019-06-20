<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\team\models\TeamMember */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="team-member-form">

    <?php $form = ActiveForm::begin([
        'id'=>'form-member'
    ]); ?>

   

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'team_position')->dropDownList([
        'หัวหน้าทีม'=>'หัวหน้าทีม',
        'ผู้ประสานงาน'=>'ผู้ประสานงาน',
        'สมาชิกทีม'=>'สมาชิกทีม',
        'อื่นๆ'=>'อื่นๆ'
    ],['prompt'=>'--ตำแหน่ง--']) ?>

    <?= $form->field($model, 'office')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'team_id')->textInput(['disabled'=>TRUE]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
