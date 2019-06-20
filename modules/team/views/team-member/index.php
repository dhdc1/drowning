<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\team\models\TeamMemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Team Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Team Member', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fullname',
            'team_position',
            'office',
            'tel',
            //'email:email',
            //'team_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
