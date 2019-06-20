<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use app\models\Cchangwat;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use kartik\select2\Select2;
use kartik\date\DatePicker;

$this->registerCss($this->render('style.css'));
/* @var $this yii\web\View */
/* @var $model app\models\ReportDead */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]);
?>



<div class="container-fluid">
    <div class="row">

        <!--panel left-->
        <div class="col-lg-6">

            <div class="hu">
                <label>0) รหัส ICD10 สาเหตุการตาย</label>
            </div>

            <?= $form->field($model, 'cid')->textInput(['placeholder' => 'เลขประจำตัวประชาชน'])->label(FALSE) ?>

            <?=
                    $form->field($model, 'icd_code')
                    ->label(FALSE)
                    ->dropDownList([
                        'W65' => 'จมน้ำตายและดำน้ำในขณะอาบน้ำ (W65)',
                        'W66' => 'การจมน้ำตายและการแช่น้ำอันเนื่องมาจากการล้มลงสู่อ่าง (W66)',
                        'W67' => 'จมน้ำตายขณะอยู่ในสระว่ายน้ำ (W67) ',
                        'W68' => 'จมน้ำตายและดำน้ำอันเป็นผลมาจากการล้มลงในสระว่ายน้ำ (W68)',
                        'W69' => 'จมน้ำตายและแช่ในบ่อน้ำธรรมชาติ (W69)',
                        'W70' => 'การจมน้ำและการแช่น้ำอันเนื่องมาจากการตกลงไปในบ่อน้ำธรรมชาติ (W70)',
                        'W73' => 'กรณีที่จมน้ำตายและการจมน้ำตายอื่น ๆ (W73)',
                        'W74' => 'จมน้ำและจมน้ำที่ไม่ระบุรายละเอียด (W74)',
                        'V90' => 'อุบัติเหตุการขนส่งทางน้ำ (V90)',
                        'X36' => 'ผู้ประสบภัยจากอุทกภัย/พายุ/แรงธรรมชาติอื่นๆ (X36)'
                            ], ['prompt' => '--เลือก--']);
            ?>

            <div class="hu">
                <label>1) วันที่เกิดเหตุ</label>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">                       
                        <?=
                        $form->field($model, 'drowning_date')->widget(DatePicker::ClassName(), [
                            'type' => DatePicker::TYPE_INPUT,
                            'language' => 'th',
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose' => true,
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">

                        <?= $form->field($model, 'drowning_time')->textInput(['type' => 'time']) ?>

                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">                        
                        <?=
                        $form->field($model, 'dead_date')->widget(DatePicker::ClassName(), [
                            'type' => DatePicker::TYPE_INPUT,
                            'language' => 'th',
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose' => true,
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>

            <div class="hu">
                <label>2) ชื่อ-นามสกุล คนที่จมน้ำ</label>
            </div>

            <div class="form-group row">
                <div class="col-sm-4">
                    <?=
                            $form->field($model, 'pname')->
                            dropDownList([
                                'ด.ช.' => 'ด.ช.',
                                'ด.ญ.' => 'ด.ญ.',
                                'นาย' => 'นาย', 'นาง' => 'นาง',
                                'นางสาว' => 'นางสาว',
                                    ], ['prompt' => '--เลือก--']
                    );
                    ?>

                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="hu">
                <label>3) เพศ</label>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'sex')->dropDownList(['ชาย' => 'ชาย', 'หญิง' => 'หญิง',], ['prompt' => ''])->label(FALSE); ?>
            </div>

            <div class="hu">
                <label>4) ที่พักอาศัยคนจมน้ำ</label>

            </div>

            <div class="row">
                <div class="col-xs-4">
                    <?= $form->field($model, 'home_addr')->dropDownList(['ตามบัตรประชาชน' => 'ตามบัตรประชาชน', 'ไม่ตรงตามบัตรประชาชน' => 'ไม่ตรงตามบัตรประชาชน',], ['prompt' => '']) ?>
                </div>

                <div class="col-xs-4">
                    <div class="form-group">
                        <?= $form->field($model, 'no_addr')->textInput() ?>

                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <?= $form->field($model, 'moo_addr')->textInput() ?>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">

                        <?php
                        $items = Cchangwat::find()->all();
                        $items = ArrayHelper::map($items, 'changwatcode', 'changwatname');
                        //$items = ['53' => 'อุตรดิตถ์', '63' => 'ตาก', '64' => 'สุโขทัย', '65' => 'พิษณุโลก', '67' => 'เพชรบูรณ์']
                        ?>
                        <?php
                        // จังหวัด ที่อยู่ของคนจมน้ำ
                        echo $form->field($model, 'province_addr')->widget(Select2::classname(), [
                            'data' => $items,
                            'options' => ['placeholder' => '--เลือก--'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                ''
                            ],
                            'pluginEvents' => [
                                "change" => 'function() { 
                                    var data_id = $(this).val();
                                    $("#province_addr").val(data_id).change();
                                }'
                            ],
                        ]);
                        ?>
                        <?= $form->field($model, 'province_addr')->dropDownList($items, ['id' => 'province_addr', 'prompt' => '--เลือก--', 'style' => 'display:none'])->label(FALSE) ?>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <?php
                        echo Html::hiddenInput('amphur_addr', $model->amphur_addr, ['id' => 'amphur_selected']);
                        echo $form->field($model, 'amphur_addr')->widget(DepDrop::classname(), [
                            'options' => ['id' => 'amphur_addr'],
                            'pluginOptions' => [
                                'depends' => ['province_addr'],
                                'initialize' => true,
                                'placeholder' => '-- เลือก --',
                                'url' => Url::to(['/report-dead/list-amp']),
                                'params' => ['amphur_selected']
                            ]
                        ]);
                        ?>

                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <?php
                        echo Html::hiddenInput('tambon_addr', $model->tambon_addr, ['id' => 'tambon_selected']);
                        echo $form->field($model, 'tambon_addr')->widget(DepDrop::classname(), [
                            'options' => ['id' => 'tambon_addr'],
                            'pluginOptions' => [
                                'depends' => ['amphur_addr'],
                                'initialize' => true,
                                'placeholder' => '-- เลือก --',
                                'url' => Url::to(['/report-dead/list-tmb']),
                                'params' => ['tambon_selected']
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>

            <div class="hu">
                <label>5) อายุ</label>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6">
                        <?=
                        $form->field($model, 'age', [
                            'template' => '<div class="input-group">{input}<span class="input-group-addon">ปี</span></div>{error}{hint}'
                        ]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?=
                        $form->field($model, 'ageMonth', [
                            'template' => '<div class="input-group">{input}<span class="input-group-addon">เดือน</span></div>{error}{hint}'
                        ]);
                        ?>
                    </div>
                </div>


            </div>
            <div class="hu">
                <label>6) สัญชาติ</label>
            </div>
            <div class="form-group">
                <?=
                $form->field($model, 'national')->dropDownList(
                        ['คนไทย' => 'ไทย', 'ต่างชาติ' => 'ต่างชาติ'], ['prompt' => '']
                )->label(FALSE);
                ?>
            </div>
            <div class="hu">
                <label>7) ความสามารถในการว่ายน้ำ</label>
            </div>
            <div class="form-group">
                <?=
                $form->field($model, 'can_swim')->dropDownList(
                        ['ว่ายน้ำเป็น' => 'ว่ายน้ำเป็น', 'ว่ายน้ำไม่เป็น' => 'ว่ายน้ำไม่เป็น', 'มีทักษะการเอาชีวิตรอดในน้ำ' => 'มีทักษะการเอาชีวิตรอดในน้ำ'], ['prompt' => '']
                )->label(FALSE)->hint('มีทักษะการเอาตัวรอดในน้ำ หมายถึง 1)สามารถลอยน้ำตัวเปล่า (ไม่ใช้อุปกรณ์ช่วย) อยู่ในน้ำได้นานมากวว่า 3นาที 2)เคลื่อนที่ไปในน้ำได้ไกล 25 เมตร');
                ?>

            </div>


            <div>
                <div class="hu">
                    <label>8) ประเภทแหล่งน้ำที่เกิดเหตุ</label>
                </div>
                <div class="row">

                    <div class="col-xs-6">
                        <?=
                        $form->field($model, 'drowning_type')->dropDownList([
                            'อ่างอาบน้ำ' => 'อ่างอาบน้ำ',
                            'โอ่งน้ำ' => 'โอ่งน้ำ',
                            'ถังน้ำ' => 'ถังน้ำ',
                            'กะละมัง' => 'กะละมัง',
                            'สระว่ายน้ำยาง' => 'สระว่ายน้ำยาง',
                            'อ่างเลี้ยงปลา' => 'อ่างเลี้ยงปลา',
                            'บ่อน้ำโยก' => 'บ่อน้ำโยก',
                            'แอ่งน้ำขัง' => 'แอ่งน้ำขัง',
                            'ท่อระบายน้ำ' => 'ท่อระบายน้ำ',
                            'สระว่ายน้ำ' => 'สระว่ายน้ำ',
                            'บ่อน้ำ-สระน้ำเพื่อการเกษตร' => 'บ่อน้ำ-สระน้ำเพื่อการเกษตร',
                            'คลอง' => 'คลอง', //
                            'บึง/หนอง' => 'บึง/หนอง',
                            'ห้วย' => 'ห้วย',
                            'แม่น้ำ' => 'แม่น้ำ',
                            'น้ำตก' => 'น้ำตก',
                            'เขื่อน' => 'เขื่อน',
                            'อ่างเก็บน้ำ' => 'อ่างเก็บน้ำ',
                            'ทะเล' => 'ทะเล',
                            'ฝายเก็บน้ำ-ฝายชะลอน้ำ' => 'ฝายเก็บน้ำ-ฝายชะลอน้ำ'
                                ], ['prompt' => '']
                        );
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?=
                        $form->field($model, 'pool_depth', [
                            'template' => '{label}<div class="input-group">{input}<span class="input-group-addon">เมตร</span></div>{error}{hint}'
                        ])->textInput(['maxlength' => true])
                        ?>
                    </div>

                </div>
                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <?= $form->field($model, 'location_lat')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">

                            <?=
                            $form->field($model, 'location_lon', [
                                'template' => '{label}<div class="input-group">{input}<span  id="gps" class="btn btn-default input-group-addon"><i class="glyphicon glyphicon-screenshot"></i></span></div>{error}{hint}'
                            ])->textInput(['maxlength' => true])
                            ?>
                        </div>
                    </div>
                </div>                <div class="form-group">

                    <?= $form->field($model, 'upload_pic')->fileInput() ?>
                </div>
            </div>


            <div class="form-group">
                <?= $form->field($model, 'drowning_location')->textarea(['rows' => 6]) ?>
            </div>


            <div class="row">
                <div class="col-xs-4">
                    <div class="form-group">
                        <?php
                        $items = ['53' => 'อุตรดิตถ์', '63' => 'ตาก', '64' => 'สุโขทัย', '65' => 'พิษณุโลก', '67' => 'เพชรบูรณ์']
                        ?>
                        <?= $form->field($model, 'drowning_province')->dropDownList($items, ['id' => 'drowning_province', 'prompt' => '--เลือก--']) ?>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">


                        <?php
                        echo Html::hiddenInput('drowning_amphur', $model->drowning_amphur, ['id' => 'amphur_selected_2']);
                        echo $form->field($model, 'drowning_amphur')->widget(DepDrop::classname(), [
                            'options' => ['id' => 'drowning_amphur'],
                            'pluginOptions' => [
                                'depends' => ['drowning_province'],
                                'initialize' => true,
                                'placeholder' => '-- เลือก --',
                                'url' => Url::to(['/report-dead/list-amp2']),
                                'params' => ['amphur_selected_2']
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">


                        <?php
                        echo Html::hiddenInput('drowning_tambon', $model->drowning_tambon, ['id' => 'tambon_selected_2']);
                        echo $form->field($model, 'drowning_tambon')->widget(DepDrop::classname(), [
                            'options' => ['id' => 'drowning_tambon'],
                            'pluginOptions' => [
                                'depends' => ['drowning_amphur'],
                                'initialize' => true,
                                'placeholder' => '-- เลือก --',
                                'url' => Url::to(['/report-dead/list-tmb2']),
                                'params' => ['tambon_selected_2']
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <?php
                    $radio_ary = [
                        'ไม่มี' => 'ไม่มี',
                        'มี' => 'มี'
                            ]
                    ?>
                    <?=
                    $form->field($model, 'drowning_safty')->radioList($radio_ary, [
                        'unselect' => null,
                        'separator' => '<br>'
                    ])
                    ?>
                </div>


                <?=
                        $form->field($model, 'drowning_safty_des')
                        ->textInput(['maxlength' => true])
                        ->hint('การจัดการสิ่งแวดล้อม/อุปกรณ์ เช่น รั้ว ป้ายคำเตือน ห่วงชูชีพอไม้ แกลลอนพลาสติก ขวดพลาสติก เชือก')
                ?>


            </div>

            <div class="hu">
                <label>9) ก่อนเกิดเหตุ(ในช่วงปกติ) ใครเป็นผู้ดูแล</label>
            </div>
            <div class="form-group">
                <?=
                $form->field($model, 'before_with')->dropDownList(
                        ['พ่อแม่' => 'พ่อแม่',
                    'ปู่ย่าตายาย' => 'ปู่ย่าตายาย',
                    'ญาติ' => 'ญาติ',
                    'พี่ น้อง' => 'พี่ น้อง',
                    'เพื่อน' => 'เพื่อน',
                    'อยู่ลำพังคนเดียว' => 'อยู่ลำพังคนเดียว'
                        ], ['prompt' => '']
                )->label(FALSE);
                ?>
            </div>

            <div class="hu">
                <label>10) ขณะเกิดเหตุ(ณ จุดเกิดเหตุ)คนที่จมน้ำอยู่กับใคร</label>
            </div>
            <div class="form-group">
                <?=
                $form->field($model, 'drowning_with')->dropDownList(
                        ['พ่อแม่' => 'พ่อแม่',
                    'ปู่ย่าตายาย' => 'ปู่ย่าตายาย',
                    'ญาติ' => 'ญาติ',
                    'พี่ น้อง' => 'พี่ น้อง',
                    'เพื่อน' => 'เพื่อน',
                    'อยู่ลำพังคนเดียว' => 'อยู่ลำพังคนเดียว'
                        ], ['prompt' => '']
                )->label(FALSE);
                ?>

            </div>
            <div class="hu">
                <label>11) จำนวนคนที่เกิดเหตุในเหตุการณ์เดียวกัน</label>
            </div>
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <?= $form->field($model, 'drowning_number')->input('number') ?> 
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?= $form->field($model, 'drowning_number_dead')->input('number') ?> 
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?= $form->field($model, 'drowning_number_alive')->input('number') ?> 
                    </div>
                </div>
            </div>
        </div>  

        <!--panel right-->
        <div class="col-lg-6">


            <div class="hu">
                <label>12) เหตุจูงใจการเกิดเหตุ</label>
            </div>

            <div class="form-group">
                <?=
                $form->field($model, 'drowning_why')->dropDownList(
                        ['ลื่น' => 'ลื่น',
                    'พลัดตกหกล้ม' => 'พลัดตกหกล้ม',
                    'เล่นน้ำ' => 'เล่นน้ำ',
                    'เก็บของ' => 'เก็บของ',
                    'เดินลงตามสัตว์' => 'เดินลงตามสัตว์',
                    'ตกปลา' => 'ตกปลา',
                    'งมกุ้ง/หอย/ปลา' => 'งมกุ้ง/หอย/ปลา',
                    'อยากรู้ความลึกของน้ำ' => 'อยากรู้ความลึกของน้ำ'
                        ], ['prompt' => '']
                )->label(FALSE);
                ?>
                <?= $form->field($model, 'drowning_why_des')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="hu">
                <label>13) พฤติกรรมเสี่ยงต่อการเกิดเหตุ (ตอบได้มากกว่า 1 ข้อ)</label>
            </div>
            <div class="form-group">
                <?=
                $form->field($model, 'drowning_risk_alcohol')->checkbox([
                    'label' => 'เมาสุรา',
                    'uncheck' => 'ไม่ใช่',
                    'value' => 'ใช่'
                ])
                ?>


                <?=
                $form->field($model, 'drowning_risk_addicted')->checkbox([
                    'label' => 'ยาเสพติด',
                    'uncheck' => 'ไม่ใช่',
                    'value' => 'ใช่'
                ])
                ?>

                <?=
                $form->field($model, 'drowning_risk_drug')->checkbox([
                    'label' => 'ใช้ยา',
                    'uncheck' => 'ไม่ใช่',
                    'value' => 'ใช่'
                ])
                ?>

                <?=
                $form->field($model, 'drowning_risk_disability')->checkbox([
                    'label' => 'ทุพพลภาพ',
                    'uncheck' => 'ไม่ใช่',
                    'value' => 'ใช่'
                ])
                ?>

                <?=
                $form->field($model, 'drowning_risk_none')->checkbox([
                    'label' => 'ไม่มี',
                    'uncheck' => 'ไม่ใช่',
                    'value' => 'ใช่'
                ])
                ?>

                <div class="form-inline">
                    <?=
                    $form->field($model, 'drowning_risk_disease')->checkbox([
                        'label' => 'มีโรคประจำตัว',
                        'uncheck' => 'ไม่ใช่',
                        'value' => 'ใช่'
                    ])
                    ?>

                    <?= $form->field($model, 'drowning_risk_disease_des')->textInput() ?>
                </div>

                <div class="form-inline">
                    <?=
                    $form->field($model, 'drowning_risk_other')->checkbox([
                        'label' => 'อื่นๆ',
                        'uncheck' => 'ไม่ใช่',
                        'value' => 'ใช่'
                    ])
                    ?>

                    <?= $form->field($model, 'drowning_risk_other_des')->textInput() ?>
                </div>


            </div>
            <div class="hu">
                <label>14) ระยะทางโดยประมาณระหว่างบ้านถึงที่เกิดเหตุ</label>
            </div>
            <div class="form-group">
                <?=
                $form->field($model, 'drowning_length', [
                    'template' => '<div class="input-group">{input}<span class="input-group-addon">เมตร</span></div>{error}{hint}'
                ])->hint('ไม่ต้องระบุ หากสถานที่เกิดเหตุอยู่ภายในบ้าน');
                ?>

            </div>

            <div class="hu">
                <label>15) การใช้อุปกรณ์ช่วยลอยน้ำขณะเกิดเหตุ</label>
            </div>
            <div class="form-group">
                <?php
                $radio_ary2 = [
                    'ไม่มี' => 'ไม่มี',
                    'มี' => 'มี'
                        ]
                ?>
                <?=
                $form->field($model, 'drowning_accessory')->radioList($radio_ary2, [
                    'unselect' => null,
                    'separator' => '<br>'
                ])->label(FALSE);
                ?>
                <div class="form-inline">
                    <?=
                    $form->field($model, 'drowning_accessory_yes')->dropDownList(
                            ['ขวดพลาสติก' => 'ขวดพลาสติก ',
                        'สวมเสื้อชูชีพ/เสื้อพยุงตัว' => 'สวมเสื้อชูชีพ/เสื้อพยุงตัว ',
                        'ถังแกลลอน' => 'ถังแกลลอน'
                            ], ['prompt' => '']
                    );
                    ?>
                    <?= $form->field($model, 'drowning_accessory_yes_des')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="hu">
                <label>16) ผู้อยู่ในเหตุการณ์ ช่วยเหลือคนจมน้ำขึ้นมาจากน้ำด้วยวิธีการใด</label>
            </div>
            <div class="form-group">
                <?=
                $form->field($model, 'drowning_helper')->dropDownList(
                        ['นำศพขึ้นมาจากน้ำ' => 'นำศพขึ้นมาจากน้ำ เนื่องจากเสียชีวิตแล้ว',
                    'ช่วยด้วยการกระโดดลงไปช่วย' => 'ช่วยด้วยการกระโดดลงไปช่วย',
                    'ช่วยด้วยการหาอุปกรณ์โยนให้จับ' => 'ช่วยด้วยการหาอุปกรณ์โยนให้จับ',
                    'อื่นๆ ' => 'อื่นๆ ระบุ'
                        ], ['prompt' => '']
                )->label(FALSE);
                ?>
                <?= $form->field($model, 'drowning_helper_drop_des')->textInput(['maxlength' => true]) ?>

            </div>


            <div class="hu">
                <label>17) ภายหลังจากนำคนจมน้ำขึ้นมาจากน้ำ  </label>
            </div>
            <div class="form-group">


                <?=
                $form->field($model, 'drowning_rescue_water')->dropDownList(
                        ['ไม่ได้ปฐมพยาบาล' => 'ไม่ได้ปฐมพยาบาล',
                            'ทำการปฐมพยาบาล' => 'ทำการปฐมพยาบาล'
                        ]
                )->label(FALSE);
                ?>
                <?= $form->field($model, 'drowning_recue_no_des')->textInput(['maxlength' => true]); ?>
                <?=
                $form->field($model, 'drowning_recue_yes')->dropDownList(
                        ['cprmouth' => 'CPR+เป่าปาก',
                    'CPR' => 'CPR',
                    'แบกบ่า' => 'แบกบ่า',
                    'กดท้อง' => 'กดท้อง'
                        ], ['prompt' => '']
                );
                ?>



                <?= $form->field($model, 'drowning_rescue_yes_des')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="hu">
                <label>18) ภายหลังการปฐมพยาบาลได้นำส่งสถานบริการสาธารณสุข/โดยใคร/ที่ใด</label>
            </div>
            <div class="form-group">
                <?php
                $radio_refer = [
                    'ไม่ได้นำส่งสถานบริการสาธารณสุข' => 'ไม่ได้นำส่งสถานบริการสาธารณสุข ',
                    'นำส่งสถานบริการสาธารณสุข' => 'นำส่งสถานบริการสาธารณสุข '
                        ]
                ?>
                <?=
                $form->field($model, 'drowning_refer')->radioList($radio_refer, [
                    'unselect' => null,
                    'separator' => '<br>'
                ])->label(FALSE);
                ?>

                <?= $form->field($model, 'drowning_refer_hosp')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="hu">
                <label>19) หลังเกิดเหตุจมน้ำ</label>
            </div>


            <div class="form-group">
                <?=
                $form->field($model, 'drowning_after_dead')->dropDownList(
                        ['ไม่เสียชีวิต' => 'ไม่เสียชีวิต',
                    'เสียชีวิต ณ ที่เกิดเหต' => 'เสียชีวิต ณ ที่เกิดเหต',
                    'เสียชีวิตขณะนำส่งโรงพยาบาล' => 'เสียชีวิตขณะนำส่งโรงพยาบาล',
                    'เสียชีวิต ณ โรงพยาบาล' => 'เสียชีวิต ณ โรงพยาบาล'
                        ], ['prompt' => '']
                )->label(FALSE);
                ?>
            </div>
            <div class="hu">
                <label>20) บรรยายเหตุการณ์ก่อนเกิดเหตุจนกระทั่งจมน้ำ</label>
            </div>
            <div class="form-group">
                <?=
                        $form->field($model, 'drowning_des')
                        ->textarea(['rows' => 6], ['placeholder' => "จำกัด ไม่เกิน 1,000ตัวอักษร"])
                        ->label(FALSE)->hint('เหตุการณ์เกิดอย่างไร จากอะไร คนที่จมน้ำทำอะไร บาดเจ็บ/เสียชีวิตอย่างไร ทำอะไรหลังจากนั้น')
                ?>

            </div>
            <div class="hu">
                <label>21) <u>หลังเกิดเหตุการณ์</u> มีการจัดแหล่งน้ำที่เกิดเหตุเพื่อป้องกันการจมน้ำ</label>
            </div>
            <div class="form-group">
                <?php
                $radio_after = [
                    'ไม่มี' => 'ไม่มี ',
                    'มี' => 'มี '
                        ]
                ?>
                <?=
                $form->field($model, 'defend_drowning')->radioList($radio_after, [
                    'unselect' => null,
                    'separator' => '<br>'
                ])->label(FALSE);
                ?>

                <?=
                        $form->field($model, 'defend_drowning_des')
                        ->textInput(['maxlength' => true])
                        ->hint('การจัดการแหล่งน้ำที่เกิดเหตุ เช่น สร้างรั้ว ติดป้ายคำเตือน มีอุปกรณ์เพื่อความปลอดภัยบริเวณแหล่งน้ำ(ห่วงชูชีพ ไม้ แกลลอนพลาสติก ขวดน้ำพลาสติก เชือก)')
                ?>

            </div>


        </div> 

    </div>


    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'report_name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'report_job')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-3">

            <?= $form->field($model, 'report_office')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-3">
            <?php
            $items = ['53' => 'อุตรดิตถ์', '63' => 'ตาก', '64' => 'สุโขทัย', '65' => 'พิษณุโลก', '67' => 'เพชรบูรณ์']
            ?>
            <?= $form->field($model, 'report_province')->dropDownList($items, ['prompt' => '--เลือก--']); ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'report_tel')->textInput(); ?>
        </div>


        <div class="col-lg-3">
            <?= $form->field($model, 'report_fax')->textInput(); ?>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-6">
            <?=
            $form->field($model, 'report_date')->widget(DatePicker::ClassName(), [
                'type' => DatePicker::TYPE_INPUT,
                'language' => 'th',
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

</div> <!-- container -->

<?php ActiveForm::end(); ?>

