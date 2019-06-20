<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สื่อประชาสัมพันธ์';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มสื่อ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            //'content:ntext',
            //'picture',
            [
                //'label' => 'Upload Picture',
                'attribute' => 'picture',
                'format' => 'html',
                'value' => function($model){
                    return yii\bootstrap\Html::img($model->picture,['height'=>'100px','width'=>'100px']);
                }
            ],
            //'attach',
            'd_update',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}'
            ],
        ],
    ]); ?>
</div>
