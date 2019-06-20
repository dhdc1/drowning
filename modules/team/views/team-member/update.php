<?php

use yii\helpers\Html;
use app\modules\team\models\Team;

/* @var $this yii\web\View */
/* @var $model app\modules\team\models\TeamMember */

$team_name = Team::find()->where(['id'=>$model->team_id])->one();
/* @var $this yii\web\View */
/* @var $model app\modules\team\models\TeamMember */

$this->title = 'สมาชิกคนที่ '.$model->id;
$this->params['breadcrumbs'][] = ['label' => $team_name->team_name, 'url' => ['team/view','id'=>$model->team_id]];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['team-member/view','id'=>$model->id]];;
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="team-member-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
