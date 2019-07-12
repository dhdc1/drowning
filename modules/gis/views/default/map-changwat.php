<?php

use yii\helpers\Html;
use yii\helpers\Url;

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
    <div class="pull-left" style="">
        <?php
        $cur_year = date('Y');
        $cur_year = (int) $cur_year;
        $begin_yaer = 2018;
        $items = [];
        while ($cur_year >= $begin_yaer) {
            $items[$cur_year] = $cur_year + 543;
            $cur_year--;
        }
        ?>
        ปี พ.ศ. <?= Html::dropDownList($cyear, $cyear, $items, ['style' => 'width:100px', 'id' => 'cyear']) ?>

    </div>

</div>
<div id="map" style="width: 100%;height: 560px;margin-top: 25px">

</div>

<?php
$this->registerJsFile('//api.mapbox.com/mapbox.js/v3.1.1/mapbox.js');
$this->registerCssFile('//api.mapbox.com/mapbox.js/v3.1.1/mapbox.css');
$this->registerCss($this->render('style.css'));
$r = Url::toRoute('map-changwat');

$by = (int) $cyear - 1;
$y = (int) $cyear + 542;

$js = <<<JS
 
$('#cyear').change(function(){
    val = $(this).val();
    window.location = '$r&cyear='+val;
});
 
 

L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
var map = L.mapbox.map('map', 'mapbox.streets').setView([16, 100], 8);

//จังหวัด
var featureLayerChangwat = L.mapbox.featureLayer().loadURL('index.php?r=gis/default/json-changwat&cyear=$by').on('ready', () => {
    map.fitBounds(featureLayerChangwat.getBounds());
    featureLayerChangwat.on('click', function (e) {
        if (e.layer.feature)
            var desc = e.layer.feature.properties.changwatname + ' อัตราตาย ' + e.layer.feature.properties.note1 + " ต่อแสน ปชก.";
        //console.log(desc);

    });

    featureLayerChangwat.on('mouseover', function (e) {

        var desc = 'จ.' + e.layer.feature.properties.changwatname + ' อัตราตาย ' + e.layer.feature.properties.note1 + " ต่อแสน ปชก.";
        //console.log(desc);
        $('#show_desc').html(desc);
        e.layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });
        //console.log(e.layer);
        $('#show_desc').html(desc);
        $('#show_color').css("background-color", e.layer.feature.properties.fill);
        if (e.layer.feature.properties.fill == '#ff0000') {
            $('#show_color').css("color", 'white');
        } else {
            $('#show_color').css("color", 'black');
        }
    });

    featureLayerChangwat.on('mouseout', function (e) {
        e.layer.setStyle({
            weight: 2,
            color: '#363636',
            dashArray: '',
            fillOpacity: 0.5
        });
    });

    featureLayerChangwat.eachLayer((layer) => {
        var info = layer.feature.properties.note1;
        layer.bindTooltip(info,
                {permanent: true, direction: "center"}
        ).openTooltip()
    });


}).addTo(map);

/*
//อำเภอ
var featureLayerAmpur = L.mapbox.featureLayer().loadURL('index.php?r=gis/default/json-ampur').on('ready', () => {
    featureLayerAmpur.on('click', function (e) {
        if (e.layer.feature)
            var desc = 'อ.' + e.layer.feature.properties.ampurname + ' อัตราตาย ' + e.layer.feature.properties.rate + " ต่อแสน ปชก.";
        $('#show_desc').html(desc);
        $('#show_color').css("background-color", e.layer.feature.properties.fill);
    });

    featureLayerAmpur.on('mouseover', function (e) {
        if (e.layer.feature)
            var desc = 'อ.' + e.layer.feature.properties.ampurname + ' อัตราตาย ' + e.layer.feature.properties.rate + " ต่อแสน ปชก.";
        $('#show_desc').html(desc);
        $('#show_color').css("background-color", e.layer.feature.properties.fill);

        e.layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });
    });
    featureLayerAmpur.on('mouseout', function (e) {
        e.layer.setStyle({
            weight: 2,
            color: '#363636',
            dashArray: '',
            fillOpacity: 0.5
        });
    });

});

// อำเภอ
*/

// หมุดจมน้ำ
var featureLayerIncident = L.mapbox.featureLayer().loadURL('index.php?r=gis/default/point-incident&cyear=$cyear').on('ready', () => {
    featureLayerIncident.eachLayer((layer) => {
        var lat = layer.getLatLng().lat;
        var lng = layer.getLatLng().lng;
        var info = '<div>';
        //info += '<b>ข้อมูลเหตุการณ์<b><br>';
        info += '<b>เหตุการณ์วันที่ ' + layer.feature.properties.drowning_date + '</b>';
        info += '<br>' + layer.feature.properties.case_info;
        info += '<br><img height="250" width="270" src="./' + layer.feature.properties.pic + '"/>';
        info += '<br>พื้นที่ ' + layer.feature.properties.area;
        info += '<br><a href="https://maps.google.com?q='+lat+','+lng+'" target="_blank">นำทาง</a>';
        info += '</div>';
        
        console.log(layer);
        layer.on('mouseover',function(e){
            layer.bindPopup(info);
        });
    })
    
});

// หมุดแหล่งน้ำ
var featureLayerWater = L.mapbox.featureLayer().loadURL('index.php?r=gis/default/point-water').on('ready', () => {
    featureLayerIncident.eachLayer((layer) => {
        var info = '<div>';
        info += '<b>' + layer.feature.properties.title + '</b>';
        info += '</div>';
        layer.bindPopup(info);
        //console.log(layer.feature.properties.title);
    })
    
});


/*
//wms
//ฝน
// by Mr.UTEHN JADYANGTONE //
var base_url = 'http://rain.tvis.in.th/';
var radar = 'NongKham';
var radars = '["NongKham","KKN","PHS","CRI","UBN","OMK"]';
var latlng_topright = '["15.09352819610486,101.7458188486135","18.793550,105.026265","19.094393,102.475537","22.305437,102.143387","17.558854,107.095363","19.904425,100.770048"]';
var latlng_bottomleft = '["12.38196058009694,98.97206140040996","14.116192,100.541459","14.411350,97.983591","17.596297,97.611690","12.918883,102.646771","15.630408,96.114592"]';
var d = new Date();
var time = d.getTime();
//console.log(time);
radars = JSON.parse(radars);
latlng_topright = JSON.parse(latlng_topright);
latlng_bottomleft = JSON.parse(latlng_bottomleft);
var rain = L.layerGroup();
var urllast;
var boundlast;
$.each(radars, function (key, value) {
    var top_right = latlng_topright[key].split(",");
    var bottom_left = latlng_bottomleft[key].split(",");
    var imageUrl = base_url + "/output/" + value + ".png?" + time,
            imageBounds = [[top_right[0], top_right[1]], [bottom_left[0], bottom_left[1]]];
    L.imageOverlay(imageUrl, imageBounds).addTo(rain).setOpacity(0.95);
});
//จบฝน
*/

/*
//นำท่วม
var flood_update = L.tileLayer.wms('http://tile.gistda.or.th/geoserver/flood/wms?', {
    layers: "floodarea_tambon",
    transparent: true,
    format: 'image/png',
    tiles: true,
    attribution: '<a href="http://flood.gistda.or.th" target="_blank"><b>GISTDA THAILAND</b></a>'
});
var flood_percent = L.tileLayer.wms('http://tile.gistda.or.th/geoserver/wms?', {
    layers: "flood:flood_percent",
    transparent: true,
    format: 'image/png',
    //opacity:1,
    tiles: true,
    attribution: '<a href="http://flood.gistda.or.th" target="_blank"><b>GISTDA THAILAND</b></a>'
});
//จบน้ำท่วม
*/

//wms

// base layer
var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}&hl=th', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],

});

var googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}&hl=th', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});


var osm_street = L.mapbox.tileLayer('mapbox.streets');

let baseLayers = {
    'แผนที่ถนน': osm_street.addTo(map),
    'แผนที่ดาวเทียม': googleHybrid,
    'แผนที่ภูมิประเทศ': googleTerrain

};// end base layer

let overlays = {
    'จุดเสี่ยง' : featureLayerWater,
    'จุดเกิดเหตุ': featureLayerIncident.addTo(map),
    'อัตราตาย': featureLayerChangwat,
    //'อัตราตายภาพรวมอำเภอ': featureLayerAmpur,
    //'เรดาห์น้ำฝน': rain,
    //'พื้นที่น้ำท่วมรายตำบลรอบ 7 วัน': flood_percent,
    //'พื้นที่น้ำท่วมรอบ7วัน': flood_update,
};
var layerControl = L.control.layers(baseLayers, overlays).addTo(map);

var label = '<b>อัตราตาย ปีพ.ศ. $y</b>';
label += '<br><span style="background-color: #f44242;color: #f44242 ">..........</span> มากกว่า 7.5 ต่อแสน ปชก.';
label += '<br><span style="background-color: yellow;color: yellow ">..........</span> 5.0 - 7.4 ต่อแสน ปชก.';
label += '<br><span style="background-color: #42f47d;color: #42f47d ">..........</span> น้อยกว่า 5.0 ต่อแสน ปชก.';
map.legendControl.addLegend(label);

L.control.scale().addTo(map);

map.on('overlayadd', function (e) {
    console.log(e.name);
    if (e.name === 'อัตราตายภาพรวมอำเภอ') {
       //alert();
      
    }

});



  
        
        
JS;


$this->registerJs($js, yii\web\View::POS_READY);
