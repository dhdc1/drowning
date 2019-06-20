<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pop\models\PopulationTargetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เด็ก0-15ปี';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="population-target-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่ม', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'changwatcode',
                'value' => 'cchangwat.changwatname'
            ],
            [
                'attribute' => 'ampurcode',
                'value' => 'campur.ampurname'
            ],
            'byear',
            'pop_male',
            'pop_female',
            [
                'class' => 'yii\grid\ActionColumn',
                'visible' => \Yii::$app->user->can('admin')
            ],
        ],
    ]);
    ?>
</div>
