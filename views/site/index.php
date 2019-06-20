<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

</div>

<?php
use app\components\SessionStorageHelper;

SessionStorageHelper::setData('name', 'ok....');
