<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\MyHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportDeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ทะเบียนรายงานการสอบสวน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <?php
    //print_r($params);
    ?>

</div>
<div class="report-dead-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <?php
        $countid = $searchModel->find()->count('id');
        $notdead = $searchModel->find()->where(['drowning_after_dead' => 'ไม่เสียชีวิต'])->count();
        $sumdead = $countid - $notdead;

        $drowning = $searchModel->find()->sum('drowning_number');
        $dead = $searchModel->find()->sum('drowning_number_dead');
        $alive = $searchModel->find()->sum('drowning_number_alive');
        ?>
        <div class="col-md-4">
            <div class="well">
                <div class ="row">

                    <div class ="col-md-6" style="padding-left: 40%;">
                        <?= Html::img('@web/img/drowning.png', ['class' => 'img-rounded', 'height' => '50px', 'width' => '50px']); ?>
                    </div>
                    <div class ="col-md-6">
                        <h3><span class="label label-warning"><?php echo $countid; ?></span></h3>
                    </div>
                    <h3 class="text-center" style="color: blue">ทั้งหมด</h3>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="well">
                <div class ="row">

                    <div class ="col-md-6" style="padding-left: 40%;">
                        <?= Html::img('@web/img/grave.png', ['class' => 'img-rounded', 'height' => '50px', 'width' => '50px']); ?>
                    </div>
                    <div class ="col-md-6">
                        <h3><span class="label label-danger"><?php echo $sumdead; ?></span></h3>
                    </div>
                    <h3 class="text-center" style="color: blue">เสียชีวิต</h3>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="well">
                <div class ="row">

                    <div class ="col-md-6" style="padding-left: 40%;">
                        <?= Html::img('@web/img/heartbeat.png', ['class' => 'img-rounded', 'height' => '50px', 'width' => '50px']); ?>
                    </div>
                    <div class ="col-md-6">
                        <h3><span class="label label-success"><?php echo $notdead; ?></span></h3>
                    </div>
                    <h3 class="text-center" style="color: blue">รอดชีวิต</h3>
                </div>

            </div>
        </div>
    </div>



    <?php
    ActiveForm::begin([
        'method' => 'GET',
        'action' => Url::toRoute('index')
    ]);
    ?>

    <div>
        <span style="padding: 15px;background-color: whitesmoke">
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มรายงาน', ['create'], ['class' => 'btn btn-success']) ?>
        </span>

        <span style="margin-left: 100px;padding: 15px;background-color: yellow">

            เลือกปี 
            <?php
            $yy = [
                '2019' => '2562',
                '2018' => '2561',
            ];
            ?>
            <?=
            Html::dropDownList('s_year', $s_year, $yy, [
                'prompt' => '',
                'style' => 'height: 32px;width: 150px'
            ])
            ?>
            เลือกสัญชาติ   
            <?php
            $nat = [
                'ไทย' => 'ไทย',
                'เมียนมาร์' => 'เมียนมาร์',
                'กัมพูชา' => 'กัมพูชา',
                'ลาว' => 'ลาว',
                'เวียดนาม' => 'เวียดนาม',
                'จีน' => 'จีน',
                'อเมริกัน' => 'อเมริกัน',
                'อื่นๆ' => 'อื่นๆ'
            ];
            ?>
            <?=
            Html::dropDownList('s_nation', $s_nation, $nat, [
                'prompt' => '',
                'style' => 'height: 32px;width: 150px'
                    ]
            )
            ?>
            เลือกอายุ 
            <?php
            $cage = [
                '0-3' => '0-3  ปี',
                '0-4' => '0-4  ปี',
                '5-9' => '5-9  ปี',
                '10-14' => '10-14 ปี',
                '15-19' => '15-19 ปี',
                '20-24' => '20-24 ปี',
                '25-29' => '25-29 ปี',
                '30-34' => '30-34 ปี',
                '35-39' => '35-39 ปี',
                '40-44' => '40-44 ปี',
                '45-49' => '45-49 ปี',
                '50-54' => '50-54 ปี',
                '55-59' => '55-59 ปี',
                '60-120' => '60 ปีขึ้นไป',
            ];
            ?>
            <?=
            Html::dropDownList('s_age', $s_age, $cage, [
                'prompt' => '',
                'style' => 'height: 32px;width: 150px'
            ])
            ?>
            <button class="btn btn-blue"><i class="glyphicon glyphicon-search"></i></button>

        </span>

    </div>
    <?php
    ActiveForm::end();
    ?>

    <div style="margin-top: 15px">

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                //'id',
                [
                    'attribute' => 'id',
                    'headerOptions' => [
                        'style' => 'width:15px'
                    ]
                ],
                [
                    'header' => 'สถานะ',
                    'format' => 'raw',
                    'value' => function($model) {
                        if ($model->drowning_after_dead == 'ไม่เสียชีวิต') {
                            return '<div style="background-color:lime;color:lime">.</div>';
                        }
                        return '<div style="background-color:black;color:black">.</div>';
                    }
                ],
                //'drowning_after_dead',
                //'icd_code',
                [
                    'attribute' => 'drowning_date',
                    'value' => function($model) {
                        return MyHelper::thaiDate($model->drowning_date);
                    }
                ],
                //'drowning_time',
                //'dead_date',
                'pname',
                'fname',
                /* [
                  'attribute' => 'lname',
                  'value' => function() {
                  return "***";
                  }
                  ], */
                's_nation',
                //'s_year',
                //'sex',
                //'home_addr',
                //'no_addr',
                //'moo_addr',
                //'province_addr',
                //'amphur_addr',
                //'tambon_addr',
                'age',
                //'national',
                //'can_swim',
                //'drowning_type',
                //'pool_depth',
                //'location_lat',
                //'location_lon',
                //'picture',
                //'drowning_location:ntext',
                //'drowning_province',
                [
                    'attribute' => 'drowning_province',
                    'value' => 'changwatdrown.changwatname',
                    'filter' => ['65' => 'พิษณุโลก', '53' => 'อุตรดิตถ์', '63' => 'ตาก', '67' => 'เพชรบูรณ์', '64' => 'สุโขทัย']
                ],
                [
                    'attribute' => 'drowning_amphur',
                    'value' => 'ampurdrown.ampurname'
                ],
                //'drowning_amphur',
                //'drowning_tambon',
                //'drowning_safty',
                //'drowning_safty_des',
                //'before_with',
                //'drowning_with',
                //'drowning_number',
                //'drowning_number_dead',
                //'drowning_number_alive',
                //'drowning_why',
                //'drowning_why_des',
                //'drowning_risk_alcohol',
                //'drowning_risk_addicted',
                //'drowning_risk_drug',
                //'drowning_risk_disability',
                //'drowning_risk_none',
                //'drowning_risk_disease',
                //'drowning_risk_disease_des',
                //'drowning_risk_other',
                //'drowning_risk_other_des',
                //'drowning_length',
                //'drowning_accessory',
                //'drowning_accessory_yes',
                //'drowning_accessory_yes_des',
                //'drowning_after_dead',
                //'drowning_helper',
                //'drowning_helper_drop_des',
                //'drowning_rescue_water',
                //'drowning_recue_no_des',
                //'drowning_recue_yes',
                //'drowning_rescue_yes_des',
                //'drowning_refer',
                //'drowning_refer_hosp',
                //'drowning_des',
                //'defend_drowning',
                //'defend_drowning_des',
                //'report_name',
                //'report_job',
                //'report_office',
                //'report_province',
                //'report_tel',
                //'report_fax',
                //'report_date',
                //'d_update',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}'
                ],
            ],
        ]);
        ?>
    </div>
</div>
