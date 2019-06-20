<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Campur;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pop\models\PopulationBaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประชากรกลางปี';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="population-base-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่ม', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $get = Yii::$app->request->get();
    if (!empty($get['PopulationBaseSearch'])) {
        $ch = $get['PopulationBaseSearch']['changwatcode'];
        $sql = "select changwatcode from cchangwat where changwatname='$ch'";
        $chcode = \Yii::$app->db->createCommand($sql)->queryScalar();
        $model = Campur::find()->where(['changwatcode' => $chcode])->asArray()->all();
        //print_r($model);
        $items = ArrayHelper::map($model, 'ampurname', 'ampurname');
    } else {
        $items = ['' => ''];
    }
    ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'changwatcode',
                'value' => 'cchangwat.changwatname',
                'filter' => ['พิษณุโลก' => 'พิษณุโลก', 'อุตรดิตถ์' => 'อุตรดิตถ์', 'ตาก' => 'ตาก', 'เพชรบูรณ์' => 'เพชรบูรณ์', 'สุโขทัย' => 'สุโขทัย'],
            ],
            [
                'attribute' => 'ampurcode',
                'value' => 'campur.ampurname',
                'filter' => $items
            ],
            'byear',
            'pop_male:integer:ชาย',
            'pop_female:integer:หญิง',
            [
                'class' => 'yii\grid\ActionColumn',
                'visible' => \Yii::$app->user->can('admin')
            ],
        ],
    ]);
    ?>


</div>
