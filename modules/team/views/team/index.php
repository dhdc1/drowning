<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\team\models\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ทีมผู้ก่อการดี';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <?php
        $bronze = $searchModel->find()->where(['team_level' => 'ทองแดง'])->count();
        $silver = $searchModel->find()->where(['team_level' => 'เงิน'])->count();
        $gold = $searchModel->find()->where(['team_level' => 'ทอง'])->count();
        ?>
        <div class="col-md-4">
            <div class="well">
                <div class ="row">

                    <div class ="col-md-6" style="padding-left: 40%;">
                        <?= Html::img('@web/img/medal_gold.png', ['class' => 'img-rounded', 'height' => '50px', 'width' => '50px']); ?>
                    </div>
                    <div class ="col-md-6">
                        <h3><span class="label label-warning"><?php echo $gold; ?></span></h3>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="well">
                <div class ="row">

                    <div class ="col-md-6" style="padding-left: 40%;">
                        <?= Html::img('@web/img/medal_silver.png', ['class' => 'img-rounded', 'height' => '50px', 'width' => '50px']); ?>
                    </div>
                    <div class ="col-md-6">
                        <h3><span class="label label-default"><?php echo $silver; ?></span></h3>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="well">
                <div class ="row">

                    <div class ="col-md-6" style="padding-left: 40%;">
                        <?= Html::img('@web/img/medal_bronze.png', ['class' => 'img-rounded', 'height' => '50px', 'width' => '50px']); ?>
                    </div>
                    <div class ="col-md-6">
                        <h3><span class="label label-danger"><?php echo $bronze; ?></span></h3>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มทีม', '#', ['class' => 'btn btn-success','id'=>'btn-create-team']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'team_name',
            ],
            [
                'attribute' => 'team_level',
                'filter' => [
                    'ทอง' => 'ทอง',
                    'เงิน' => 'เงิน',
                    'ทองแดง' => 'ทองแดง'
                ]
            ],
            [
                'attribute' => 'ampur',
                'value' => 'campur.ampurname'
            ],
            [
                'attribute' => 'changwat',
                'value' => 'cchangwat.changwatname'
            ],
            //'changwat',
            //'ampur',
            //'approv_date',
            /* [
              'label'=>'',
              'format'=>'raw',
              'value'=>function(){
              return Html::a('สมาชิก',['/team/member/index'],['class'=>'btn btn-info']);
              }
              ], */
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\bootstrap\Modal;
use yii\helpers\Url;
Modal::begin([
    'id' => 'modal-create-team',
    'size' => 'modal-lg'
]);
echo "<div id='modalContent'></div>";
Modal::end();

$route_create_team = Url::toRoute('create');
$js = <<<JS
   $('#btn-create-team').click(function(e){
        $('#modal-create-team').modal('show').find('#modalContent').load('$route_create_team');
   });     
JS;

$this->registerJs($js);
