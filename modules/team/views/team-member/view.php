<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\team\models\Team;

$team_name = Team::find()->where(['id'=>$model->team_id])->one();
/* @var $this yii\web\View */
/* @var $model app\modules\team\models\TeamMember */

$this->title = 'สมาชิกคนที่ '.$model->id;
$this->params['breadcrumbs'][] = ['label' => $team_name->team_name, 'url' => ['team/view','id'=>$model->team_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-member-view">

    
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fullname',
            'team_position',
            'office',
            'tel',
            'email:email',
            'team_id',
        ],
    ]) ?>

</div>
