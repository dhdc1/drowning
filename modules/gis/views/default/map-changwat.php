<?php
$this->params['breadcrumbs'][] = 'ระบบสารสนเทศทางภูมิศาสตร์แสดงข้อมูลการจมน้ำ';
?>
<div >
    <div class="pull-right">
        <span id='show_color'>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
        </span>
        &nbsp;
        <span id='show_desc' style="font-weight: bolder;">

        </span>
    </div>
    <div class="pull-left">
        ปี พ.ศ.<select id='map_select_byear' >
            <option>2560</option>
            <option value="2561" selected>2561</option>
        </select> 
    </div>

</div>
<div id="map" style="width: 100%;height: 560px">

</div>

<?php
$this->registerJsFile('//api.mapbox.com/mapbox.js/v3.1.1/mapbox.js');
$this->registerCssFile('//api.mapbox.com/mapbox.js/v3.1.1/mapbox.css');
$this->registerCss($this->render('style.css'));

$this->registerJs($this->render('map-changwat.js'));
