<?php

namespace app\modules\water\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

use app\modules\water\models\Cchangwat;
use app\modules\water\models\Campur;
use app\modules\water\models\Ctambon;

/**
 * This is the model class for table "water_source_survey".
 *
 * @property int $id
 * @property string $province จังหวัด
 * @property string $amphur อำเภอ
 * @property string $tambon ตำบล
 * @property string $village_no หมู่ที่
 * @property string $village_name หมู่บ้าน
 * @property string $source_type ประเภท
 * @property int $distance_village_mater ระยะห่างจากชุมชน(เมตร)
 * @property string $safty_manage การจัดการป้องกัน
 * @property string $lat ละติจูด
 * @property string $lon ลองจิจูด
 * @property string $survey_date
 * @property string $surveyer
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class WaterSourceSurvey extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'water_source_survey';
    }

    public function behaviors() {
        parent::behaviors();

        return [
            //TimestampBehavior::className(),
            BlameableBehavior::className()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['province', 'amphur', 'tambon', 'source_type'], 'required'],
            [['source_type', 'safty_manage', 'surveyer'], 'string'],
            [['distance_village_mater'], 'integer'],
            [['survey_date', 'created_at', 'updated_at'], 'safe'],
            [['province', 'amphur', 'tambon', 'village_no', 'village_name', 'created_by', 'updated_by'], 'string', 'max' => 255],
            [['lat', 'lon'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'province' => 'จังหวัด',
            'amphur' => 'อำเภอ',
            'tambon' => 'ตำบล',
            'village_no' => 'หมู่ที่',
            'village_name' => 'หมู่บ้าน',
            'source_type' => 'ประเภท',
            'distance_village_mater' => 'ระยะห่างจากชุมชน(เมตร)',
            'safty_manage' => 'การจัดการป้องกัน',
            'lat' => 'ละติจูด',
            'lon' => 'ลองจิจูด',
            'survey_date' => 'วันที่สำรวจ',
            'surveyer' => 'ผู้สำรวจ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function getCchangwat(){
        return $this->hasOne(Cchangwat::className(), ['changwatcode'=>'province']);
    }
    
    public function getCampur(){
        return $this->hasOne(Campur::className(), ['ampurcodefull'=>'amphur']);
    }
    
    public function getCtambon(){
        return $this->hasOne(Ctambon::className(),['tamboncodefull'=>'tambon']);
    }
}


