<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Campur;
use app\models\Cchangwat;
use app\models\Ctambon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WaterSourceSurveySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'แหล่งน้ำเสี่ยง';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="water-source-survey-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มแหล่งน้า', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-globe"></i> แผนที่แสดงจุดเสี่ยง', ['/gis/default/map-water'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'source_type',
            'village_no',
            [
                'attribute' => 'tambon',
                'value' => 'ctambon.tambonname'
            ],
            [
                'attribute' => 'amphur',
                'value' => 'campur.ampurname'
            ],
            [
                'attribute' => 'province',
                'value' => 'cchangwat.changwatname',
            //'filter'=>["54"=>"Name1","63"=>"Name2"],
            ],
            //'village_name',
            //'distance_village_mater',
            //'safty_manage',
            //'lat',
            //'lon',
            //'survey_date',
            //'surveyer',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
