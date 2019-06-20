<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;


$this->title = 'ปฏิทินกิจกรรม';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-12">
            <iframe src="https://calendar.google.com/calendar/embed?src=drowning.dpc2%40gmail.com&ctz=Asia%2FBangkok" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
</div>
