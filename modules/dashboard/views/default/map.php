<?php
 $cyear = $cyear-1;
?>
<div id="map" style="width: 100%;height: 300px">

</div>

<?php
$this->registerJsFile('//api.mapbox.com/mapbox.js/v3.1.1/mapbox.js');
$this->registerCssFile('//api.mapbox.com/mapbox.js/v3.1.1/mapbox.css');
$this->registerCss($this->render('style.css'));

$js =<<<JS
        
L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
var map = L.mapbox.map('map', 'mapbox.streets').setView([15.7832294,101.43055945], 6);

//จังหวัด
var featureLayerChangwat = L.mapbox.featureLayer().loadURL('index.php?r=gis/default/json-changwat&cyear=$cyear').on('ready', () => {
    //map.fitBounds(featureLayerChangwat.getBounds());
    featureLayerChangwat.eachLayer(function (layer){
        
        //layer.feature.properties['title'] = 'xxxx';
        //console.log(layer.feature.properties)
        layer.bindTooltip(layer.feature.properties.changwatname + ' (' +layer.feature.properties.note1+')');
        layer.addTo(map);
    });
    
    
      
})


var label = '<b>อัตราตาย</b>';
label += '<br><span style="background-color: #f44242;color: #f44242 ">..........</span> มากกว่า 7.5 ต่อแสน ปชก.';
label += '<br><span style="background-color: yellow;color: yellow ">..........</span> 5.0 - 7.4 ต่อแสน ปชก.';
label += '<br><span style="background-color: #42f47d;color: #42f47d ">..........</span> น้อยกว่า 5.0 ต่อแสน ปชก.';
map.legendControl.addLegend(label,{position: 'topright'});




  

JS;

$this->registerJs($js);
