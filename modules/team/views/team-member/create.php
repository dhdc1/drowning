<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\team\models\TeamMember */

$this->title = 'Create Team Member';
$this->params['breadcrumbs'][] = ['label' => 'Team Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-member-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
