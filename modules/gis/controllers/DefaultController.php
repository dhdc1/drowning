<?php

namespace app\modules\gis\controllers;

use yii\web\Controller;
use yii\helpers\Json;
use app\components\MyHelper;

/**
 * Default controller for the `gis` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionMapChangwat($cyear=NULL) {
        if(empty($cyear)){
            $cyear = date('Y');
        }
        return $this->render('map-changwat',[
            'cyear' => $cyear
        ]);
    }
    
    public function actionMapWater(){
        return $this->render('map-water');
    }

    protected function color($n) {
        $color = '';
        $red = '#ff0000';
        $green = '#0df280';
        $yellow = '#e5ff00';
        $orrange = '#ff7700';

        $n = (float) $n;
        if ($n < 5) {
            return $green;
        }
        if ($n >=5 && $n <= 7.4) {
            return $yellow;
        }
        
        if ($n >= 7.5) {
            return $red;
        }
    }

    public function actionJsonChangwat($cyear=NULL) {
        
        if(empty($cyear)){
            $cyear = date('Y');
        }

        $sql = "SELECT t.changwatcode,t.changwatname,t.geodata,c.dyear,c.rate from gis_changwat t
LEFT JOIN tmp_rate_changwat c on t.changwatcode = c.changwatcode AND c.dyear = '$cyear'";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        $feature = [];

        foreach ($raw as $value) {
            $feature[] = [
                'type' => 'Feature',
                'properties' => [
                    'changwatcode' => $value['changwatcode'],
                    'changwatname' => $value['changwatname'],
                    'note1'=>$value['rate'],
                    "stroke" => "#363636",
                    "stroke-width" => 2,
                    "stroke-opacity" => 1,
                    "fill" => $this->color($value['rate']),
                    "fill-opacity" => 0.5
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => json_decode($value['geodata'])
                ]
            ];
        }

        return Json::encode($feature);
    }

    public function actionJsonAmpur($cyear = NULL) {
        
        if(empty($cyear)){
            $cyear = date('Y');
        }

        $sql = "SELECT a.ampurcode,a.ampurname,a.geodata
,count(t.amphur_addr) d_case
,p.pop_female+p.pop_male as pop_total 
,ROUND(count(t.amphur_addr)  *100000/ (p.pop_female+p.pop_male),2) rate
FROM gis_ampur a 
INNER JOIN  population_base p on a.ampurcode = p.ampurcode
LEFT JOIN report_dead	t on t.drowning_amphur = a.ampurcode
GROUP BY a.ampurcode";
        
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        $feature = [];

        foreach ($raw as $value) {
            $feature[] = [
                'type' => 'Feature',
                'properties' => [
                    'ampurcode' => $value['ampurcode'],
                    'ampurname' => $value['ampurname'],
                    'rate'=>$value['rate'],
                    "stroke" => "#363636",
                    "stroke-width" => 2,
                    "stroke-opacity" => 1,
                    "fill" => $this->color($value['rate']),
                    "fill-opacity" => 0.5
                ],
                'geometry' => [
                    'type' => 'Polygon',
                    'coordinates' => json_decode($value['geodata'])
                ]
            ];
        }

        return Json::encode($feature);
    }

    public function actionPointIncident($cyear=NULL) {
        if(empty($cyear)){
            $cyear = date('Y');
        }
        //$cyear = '2019';
        $sql = " SELECT t.id,t.drowning_date,t.tmp_picture pic,t.sex,t.age,t.drowning_type,ISNULL(t.dead_date) not_dead
,concat('ต.',c1.tambonname,' อ.',c2.ampurname,' จ.',c3.changwatname) area
, t.location_lon lon,t.location_lat lat  from report_dead t 

LEFT JOIN ctambon c1 ON c1.tamboncodefull = t.drowning_tambon
LEFT JOIN campur c2 ON c2.ampurcodefull = t.drowning_amphur 
LEFT JOIN cchangwat c3 ON c3.changwatcode = t.drowning_province

WHERE (t.location_lat <> '' or t.location_lon <> '') and YEAR(t.drowning_date) = '$cyear'";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        //$feature = [];
        $point = [];
        foreach ($raw as $value) {
            $p['type'] = 'Feature';
            $p['properties']['pic'] = empty($value['pic'])?'img/placeholder.jpg':$value['pic'];
            $p['properties']['area'] = $value['area'];
            $p['properties']['drowning_date'] = MyHelper::thaiDate($value['drowning_date']);
            $p['properties']['case_info'] = ' เพศ '.$value['sex'] . " อายุ " . $value['age']." ปี";
            $p['properties']['marker-size'] = 'large';
            $p['properties']['marker-color'] = $value['not_dead']=='0'?'#333333':'#5DFC0A';
            $p['properties']['marker-symbol'] = $value['not_dead']=='0'?'danger':'heart';
            $p['geometry']['type'] = "Point";
            $p['geometry']['coordinates'][0] = $value['lon'] * 1;
            $p['geometry']['coordinates'][1] = $value['lat'] * 1;
            $point[] = $p;
        }
        return Json::encode($point);
        //return Json::encode($feature);
    }
    
    
    public function actionPointWater() {
        $sql = " SELECT t.* FROM water_source_survey t 
WHERE t.lat < 22
AND trim(t.lat) <> ''
AND t.lat is NOT NULL
AND t.lon < 150
AND trim(t.lon) <> ''
AND t.lon is NOT NULL ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        //$feature = [];
        $point = [];
        foreach ($raw as $value) {
            $p['type'] = 'Feature';            
            $p['properties']['title'] = $value['source_type'];
            $p['properties']['village'] = $value['village_name'];
            //$p['properties']['marker-size'] = 'large';
            $p['properties']['marker-color'] = '#ff0000';
            $p['properties']['marker-symbol'] = 'swimming';
            $p['geometry']['type'] = "Point";
            $p['geometry']['coordinates'][0] = $value['lon'] * 1;
            $p['geometry']['coordinates'][1] = $value['lat'] * 1;
            $point[] = $p;
        }
        return Json::encode($point);
        //return Json::encode($feature);
    }

}
