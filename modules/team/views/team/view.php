<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\team\models\Team */

$this->title = $model->team_name;
$this->params['breadcrumbs'][] = ['label' => 'ทีมผู้ก่อการดี', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-view">



    <p>
        <?= Html::a('Update', '#', ['class' => 'btn btn-primary', 'id' => 'btn-update-team']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a('<i class="glyphicon glyphicon-user"></i> เพิ่มสมาชิก', '#', ['class' => 'btn btn-primary pull-right member']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'team_name',
            [
                'attribute' => 'ampur',
                'value' => $model->campur->ampurname
            ],
            [
                'attribute' => 'changwat',
                'value' => $model->cchangwat->changwatname
            ],
            'team_level',
            'approv_date',
        ],
    ])
    ?>
    สมาชิก
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout' => '{items}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'fullname',
            'team_position',
            'office',
            'tel',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{memberView}',
                'buttons' => [
                    'memberView' => function ($url, $model) {
                        $url = Url::to(['team-member/view', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => 'view']);
                    },
                ]
            ],
        //'email:email',
        //'team_id',
        ],
    ]);
    ?>


</div>

<?php
Modal::begin([
    //'header' => 'เพิ่มสมาชิก',
    'id' => 'modal',
    'size' => 'modal-lg'
]);

echo '<div class="modalContent"></div>';

Modal::end();

$route_create_member = Url::to(['/team/team-member/create', 'team_id' => $model->id]);
$route_update_team = Url::to(['update', 'id' => $model->id]);
$js = <<<JS
   $('#btn-update-team').click(function(e){
      $('#modal').modal('show').find('.modalContent').load('$route_update_team');  
   });   
     
    $('.member').click(function(e){
        $('#modal').modal('show').find('.modalContent').load('$route_create_member');
    });
JS;
$this->registerJs($js);
