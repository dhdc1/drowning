

L.mapbox.accessToken = 'pk.eyJ1IjoidGVobm5uIiwiYSI6ImNpZzF4bHV4NDE0dTZ1M200YWxweHR0ZzcifQ.lpRRelYpT0ucv1NN08KUWQ';
var map = L.mapbox.map('map', 'mapbox.streets').setView([16, 100], 8);





// หมุดจมน้ำ
var featureLayerIncident = L.mapbox.featureLayer().loadURL('index.php?r=gis/default/point-incident').on('ready', () => {
    featureLayerIncident.eachLayer((layer) => {
        var info = '<div>';
        info += '<b>วันที่ ' + layer.feature.properties.drowning_date + '</b>';
        info += ' ' + layer.feature.properties.title;
        info += '<br><img height="250" width="270" src="./' + layer.feature.properties.pic + '"/>';
        info += '<br>พื้นที่ ' + layer.feature.properties.area;
        info += '</div>';
        layer.bindPopup(info);
        //console.log(layer.feature.properties.title);
    })
    
});

// หมุดแหล่งน้ำ
var featureLayerWater = L.mapbox.featureLayer().loadURL('index.php?r=gis/default/point-water').on('ready', () => {
    map.fitBounds(featureLayerWater.getBounds());
    featureLayerIncident.eachLayer((layer) => {
        var info = '<div>';
        info += '<b>' + layer.feature.properties.title + '</b>';
        info += '<br>'+ layer.feature.properties.village ;
        info += '</div>';
        layer.bindPopup(info);
        //console.log(layer.feature.properties.title);
    })
    
});


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
    'จุดเสี่ยง' : featureLayerWater.addTo(map),
    'จุดเกิดเหตุ': featureLayerIncident,
   
};
var layerControl = L.control.layers(baseLayers, overlays).addTo(map);


L.control.scale().addTo(map);

map.on('overlayadd', function (e) {
    console.log(e.name);
    if (e.name === 'อัตราตายภาพรวมอำเภอ') {
       //alert();
      
    }

});



