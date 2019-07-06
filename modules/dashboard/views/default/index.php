<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\db\Command;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;

$byear = (int) $cyear + 543;
$syear = $byear - 1;
?>


<div class="row">
    <div class="col-md-6">
        <?php
        $form = ActiveForm::begin([
                    'method' => 'get',
                    'action' => Url::to(['index'])
        ]);
      
        ?>
        <div class="form-group row">

            <div class="col-xs-9">
                ปี พ.ศ.
                <select class="form-control" name="cyear" id='cyear'>
                    <?php
                    $cur_year = (int)date('Y');
                    $min_year = 2018;
                    for($y=$cur_year;$y>=$min_year;$y--):
                    ?>
                    <option value="<?=$y?>" <?= $cyear == $y ? 'selected' : '' ?>><?=$y+543?></option>
                    <?php
                    endfor;
                    ?>
                </select>
            </div>
            <div class="col-xs-3">
                <br>
                <?= Html::submitButton('ตกลง', ['class' => 'btn btn-blue']); ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>


        <div class="row" >
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><object>แผนที่แสดงอัตราเสียชีวิต ปีพ.ศ.<?= $syear ?></object> <object align='right'>
                            <?= Html::a('<i class="glyphicon glyphicon-fullscreen"></i>', ['/gis/default/map-changwat']); ?>
                        </object></div>
                    <div class="panel-body">
                        <?php
                        echo $this->render('map',[
                            'cyear'=>$cyear
                        ]);
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php
                /* $sql = "SELECT * from tmp_count_pop";

                  $model = \Yii::$app->db->createCommand($sql);
                  $data = $model->queryAll();

                  for ($i = 0; $i < sizeof($data); $i++) {
                  $m = $data[$i]['m'];
                  $f = $data[$i]['f'];
                  }
                  $sum = $m + $f;

                  $sql = "SELECT * from tmp_count_dead";

                  $model = \Yii::$app->db->createCommand($sql);
                  $data = $model->queryAll();
                  for ($i = 0; $i < sizeof($data); $i++) {
                  $cname[] = $data[$i]['changwatname'];
                  $death[] = ($data[$i]['cc'] * 100000) / $sum;
                  $color[] = $data[$i]['color'];
                  }

                  echo Highcharts::widget([
                  'options' => [
                  'title' => ['text' => 'อัตราจมน้ำเสียชีวิต เขตสุขภาพที่ 2'],
                  'xAxis' => [
                  'categories' => $cname
                  ],
                  'yAxis' => [
                  'title' => ['text' => 'อัตราจมน้ำเสียชีวิต เขตสุขภาพที่ 2']
                  ],
                  'series' => [
                  ['type' => 'column',
                  'name' => 'จังหวัด',
                  'data' => $death,
                  'colorByPoint' => true,
                  'pointWidth' => 50
                  ],
                  ]
                  ]
                  ]); */
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">เพศเสียชีวิต (ชาย:หญิง) ปีพ.ศ.<?= $byear ?></div>
                    <div class="panel-body">
                        <?php
                        $sql = "SELECT * from tmp_count_sex where sex = 'ชาย'";
                        $model = \Yii::$app->db->createCommand($sql);
                        $data = $model->queryAll();
                        for ($i = 0; $i < sizeof($data); $i++) {
                            $male = $data[$i]['cc'];
                        }
                        $sql = "SELECT * from tmp_count_sex where sex = 'หญิง'";
                        $model = \Yii::$app->db->createCommand($sql);
                        $data = $model->queryAll();
                        for ($i = 0; $i < sizeof($data); $i++) {
                            $female = $data[$i]['cc'];
                        }
                        ?>
                        <div class="row">
                            <div style="text-align: center;">
                                <img src="img/children.png" width="100px" height="100px" style="margin-left:  10px;">
                            </div>
                            <h3 class="text-center"><?php echo $male . ":" . $female; ?>
                        </div>
                    </div>


                </div>

            </div>
            <div class="col-md-6">
                <?php
                $sqlcc = "SELECT * from tmp_count_type ORDER BY cc desc limit 5";
                $modelcc = \Yii::$app->db->createCommand($sqlcc);
                $datacc = $modelcc->queryAll();
                for ($i = 0; $i < sizeof($datacc); $i++) {
                    $name[] = $datacc[$i]['drowning_type'];
                    $cc[] = $datacc[$i]['cc'] * 1;
                }

                echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => 'แหล่งน้ำเสียชีวิต ปีพ.ศ.' . $byear],
                        'credits' => false,
                        'xAxis' => [
                            'categories' => $name
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'จำนวน(แห่ง)']
                        ],
                        'series' => [
                            [
                                'type' => 'column',
                                'name' => 'จมน้ำ',
                                'data' => $cc,
                                'colorByPoint' => true,
                                'pointWidth' => 50
                            ],
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">

            <div class="col-md-12">
                <h3 class="text-center">จำนวนเด็กไทยอายุ<15ปี จมน้ำ ปีพ.ศ.<?= $byear ?></h3>
                <?php
                $sql = " SELECT c.changwatname 'prov'
,COUNT(t.drowning_province) 'total'
,COUNT(if(t.drowning_after_dead !='ไม่เสียชีวิต',1,null)) 'dead'
,COUNT(if(t.drowning_after_dead ='ไม่เสียชีวิต',1,null)) 'surviv'
from report_dead t  left JOIN cchangwat c on c.changwatcode = t.drowning_province
GROUP BY t.drowning_province ";

                $model = \Yii::$app->db->createCommand($sql);
                $data = $model->queryAll();
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $data,
                ]);
                echo GridView::widget([
                    'responsiveWrap' => false,
                    'dataProvider' => $dataProvider,
                    'layout' => "<div class='text-center'>{items}</div>",
                    'columns' => [
                        [
                            'attribute' => 'prov',
                            'headerOptions' => ['style' => 'width:30%', 'class' => 'text-center'],
                            'format' => 'text',
                            'label' => 'จังหวัด',
                            'pageSummary' => 'เขตสุขภาพที่ 2',
                        ],
                        [
                            'attribute' => 'total',
                            'headerOptions' => ['style' => 'width:30%', 'class' => 'text-center'],
                            'format' => 'integer',
                            'label' => 'รวม (คน)',
                            'pageSummary' => true
                        ],
                        [
                            'attribute' => 'dead',
                            'headerOptions' => ['style' => 'width:20%', 'class' => 'text-center'],
                            'format' => 'integer',
                            'label' => 'เสียชีวิต (คน)',
                            'pageSummary' => true
                        ],
                        [
                            'attribute' => 'surviv',
                            'headerOptions' => ['style' => 'width:20%', 'class' => 'text-center'],
                            'label' => 'รอดชีวิต (คน)',
                            'pageSummary' => true
                        /* 'pageSummary' => function() {
                          $sql = " SELECT  round(sum(result)*100000/sum(target),2) sum_avg from sum_dead_changwat WHERE byear = '2559' ";
                          return \Yii::$app->db->createCommand($sql)->queryScalar();
                          }, */
                        ]
                    ],
                    'showPageSummary' => true
                ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                $sqldate = "SELECT * from tmp_count_month";
                $modeldate = \Yii::$app->db->createCommand($sqldate);
                $datadate = $modeldate->queryAll();
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $datadate,
                ]);
                $raw = $dataProvider->getModels();
                $data = [];
                foreach ($raw as $value) {
                    $data[] = [$value['cc'] * 1];
                }

                echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => 'ช่วงเวลาการเสียชีวิต ปีพ.ศ.' . $byear],
                        'credits' => false,
                        'xAxis' => [
                            'categories' => ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤษจิกายน', 'ธันวาคม']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'จำนวนการเสียชีวิต(คน)']
                        ],
                        'plotOptions' => [
                            'line' => [
                                'dataLabels' => [
                                    'enabled' => true
                                ],
                                'enableMouseTracking' => false
                            ]
                        ],
                        'series' => [
                            ['type' => 'line',
                                'name' => 'เดือน',
                                'data' => $data,
                                'pointWidth' => 50
                            ],
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
