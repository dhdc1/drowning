<div id="map" style="width: 100%;height: 300px">

</div>

<?php
$this->registerJsFile('//api.mapbox.com/mapbox.js/v3.1.1/mapbox.js');
$this->registerCssFile('//api.mapbox.com/mapbox.js/v3.1.1/mapbox.css');
$this->registerCss($this->render('style.css'));

$this->registerJs($this->render('map.js'));
