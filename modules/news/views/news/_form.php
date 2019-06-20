<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\news\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'picture')->fileInput()->hint('เฉพาะไฟล์ png,jpg เท่านั้น') ?>

<?= $form->field($model, 'attach')->fileInput()->hint('เฉพาะไฟล์ zip,rar,pdf,docx,doc,xls,xlsx,ppt,pptx,png,jpg เท่านั้น') ?>





    <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
