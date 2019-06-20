<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = 'ข้อผิดพลาด';
?>
<div class="site-error" style="margin-top: 25px">

    
    <div style="text-align: center">
        <?= Html::img('./img/stop.png',['height'=>"100" ,'width'=>"100"])?>
    </div>
    <div class="alert alert-danger" style="font-size: 24px;margin: 25px;padding: 25px;text-align: center">
        <?= nl2br(Html::encode($message)) ?>
    </div>

   

</div>
