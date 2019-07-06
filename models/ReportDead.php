<?php

namespace app\models;

use Yii;
use app\models\Campur;
use app\models\Cchangwat;
use app\models\Ctambon;
use app\models\Campur2;
use app\models\Cchangwat2;
use app\models\Ctambon2;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "report_dead".
 *
 * @property int $id
 * @property int $cid
 * @property string $icd_code
 * @property string $drowning_date
 * @property string $drowning_time
 * @property string $dead_date
 * @property string $pname
 * @property string $fname
 * @property string $lname
 * @property string $sex
 * @property string $home_addr
 * @property string $no_addr
 * @property int $moo_addr
 * @property string $province_addr
 * @property string $amphur_addr
 * @property string $tambon_addr
 * @property int $age
 * @property string $national
 * @property string $can_swim
 * @property string $drowning_type
 * @property string $pool_depth
 * @property string $location_lat
 * @property string $location_lon
 * @property string $picture
 * @property string $drowning_location
 * @property string $drowning_province
 * @property string $drowning_amphur
 * @property string $drowning_tambon
 * @property string $drowning_safty
 * @property string $drowning_safty_des
 * @property string $before_with
 * @property string $drowning_with
 * @property int $drowning_number
 * @property int $drowning_number_dead
 * @property int $drowning_number_alive
 * @property string $drowning_why
 * @property string $drowning_why_des
 * @property string $drowning_risk_alcohol
 * @property string $drowning_risk_addicted
 * @property string $drowning_risk_drug
 * @property string $drowning_risk_disability
 * @property string $drowning_risk_none
 * @property string $drowning_risk_disease
 * @property string $drowning_risk_disease_des
 * @property string $drowning_risk_other
 * @property string $drowning_risk_other_des
 * @property string $drowning_length
 * @property string $drowning_accessory
 * @property string $drowning_accessory_yes
 * @property string $drowning_accessory_yes_des
 * @property string $drowning_after_dead
 * @property string $drowning_helper
 * @property string $drowning_helper_drop_des
 * @property string $drowning_rescue_water
 * @property string $drowning_recue_no_des
 * @property string $drowning_recue_yes
 * @property string $drowning_rescue_yes_des
 * @property string $drowning_refer
 * @property string $drowning_refer_hosp
 * @property string $drowning_des
 * @property string $defend_drowning
 * @property string $defend_drowning_des
 * @property string $report_name
 * @property string $report_job
 * @property string $report_office
 * @property string $report_province
 * @property int $report_tel
 * @property int $report_fax
 * @property string $report_date
 * @property string $d_update
 * @property string $s_year

 */
class ReportDead extends \yii\db\ActiveRecord {

    public $upload_pic;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'report_dead';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['cid', 'moo_addr', 'age', 'ageMonth', 'drowning_number', 'drowning_number_dead', 'drowning_number_alive', 'report_tel', 'report_fax'], 'integer'],
            [['drowning_date', 'drowning_time', 'dead_date', 'report_date', 'd_update', 'drowning_des','s_year'], 'safe'],
            [['sex', 'drowning_location'], 'string'],
            [['icd_code', 'can_swim', 'pool_depth', 'drowning_length', 'province_addr', 'amphur_addr', 'tambon_addr', 'drowning_province', 'drowning_amphur', 'drowning_tambon',], 'string', 'max' => 30],
            [['pname', 'drowning_accessory_yes', 'drowning_helper', 'drowning_rescue_water', 'report_province'], 'string', 'max' => 50],
            [['fname', 'lname', 'picture', 'drowning_safty_des', 'no_addr', 'drowning_why_des', 'drowning_risk_disease_des', 'drowning_risk_other_des', 'drowning_accessory_yes_des', 'drowning_helper_drop_des', 'drowning_recue_no_des', 'drowning_rescue_yes_des', 'drowning_refer_hosp', 'defend_drowning_des', 'report_name', 'report_job', 'report_office'], 'string', 'max' => 255],
            [['home_addr', 'before_with', 'drowning_with', 'national'], 'string', 'max' => 20],
            [['drowning_safty', 'report_tel', 'report_fax'], 'string', 'max' => 10],
            [['location_lat', 'location_lon'], 'string', 'max' => 30],
            [['drowning_why', 'drowning_type', 'drowning_after_dead', 'drowning_recue_yes'], 'string', 'max' => 50],
            [['drowning_risk_alcohol', 'drowning_risk_addicted', 'drowning_risk_drug', 'drowning_risk_disability', 'drowning_risk_none', 'drowning_risk_disease', 'drowning_risk_other', 'drowning_accessory', 'drowning_refer', 'defend_drowning'], 'string', 'max' => 100],
            [['upload_pic'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'เอกสารหมายเลข',
            'upload_pic' => 'ไฟล์ภาพ(JPG,PNG)',
            'cid' => 'เลขประจำตัวประชาชน',
            'icd_code' => 'รหัสกลุ่มโรค',
            'drowning_date' => 'วันที่พบ',
            'drowning_time' => 'เวลาที่พบ',
            'dead_date' => 'วันที่ตาย',
            'pname' => 'คำนำหน้า',
            'fname' => 'ชื่อ',
            'lname' => 'สกุล',
            'sex' => 'เพศ',
            'home_addr' => 'ที่อยู่',
            'no_addr' => 'บ้านเลขที่',
            'moo_addr' => 'หมู่ที่',
            'province_addr' => 'จังหวัด',
            'amphur_addr' => 'อำเภอ',
            'tambon_addr' => 'ตำบล',
            'age' => 'อายุ(ปี)',
            'ageMonth' => 'อายุ(เดือน)',
            'national' => 'สัญชาติ',
            'can_swim' => 'ความสามารถในการว่ายน้ำ',
            'drowning_type' => 'ประเภทแหล่งน้ำ',
            'pool_depth' => 'ระดับความลึก',
            'location_lat' => 'ละติจูด',
            'location_lon' => 'ลองติจูด',
            'picture' => 'แนบรูป',
            'drowning_location' => 'ที่ตั้งจุดเกิดเหตุ',
            'drowning_province' => 'จังหวัดเกิดเหตุ',
            'drowning_amphur' => 'อำเภอเกิดเหตุ',
            'drowning_tambon' => 'ตำบลเกิดเหตุ',
            'drowning_safty' => 'การจัดการความปลอดภัยในแหล่งน้ำ',
            'drowning_safty_des' => 'ถ้ามีระบุ',
            'before_with' => 'ใครเป็นผู้ดูแล',
            'drowning_with' => 'คนที่จมน้ำอยู่กับใคร',
            'drowning_number' => 'จำนวน',
            'drowning_number_dead' => 'เสียชีวิต',
            'drowning_number_alive' => 'จมน้ำแต่ไม่เสียชีวิต',
            'drowning_why' => 'เหตุจูงใจการเกิดเหตุ',
            'drowning_why_des' => 'อื่นๆระบุ',
            'drowning_risk_alcohol' => 'เมาสุรา',
            'drowning_risk_addicted' => 'ยาเสพติด',
            'drowning_risk_drug' => 'ใช้ยา',
            'drowning_risk_disability' => 'ทุพพลภาพ',
            'drowning_risk_none' => 'ไม่มี',
            'drowning_risk_disease' => 'มีโรคประจำตัว',
            'drowning_risk_disease_des' => 'ระบุ',
            'drowning_risk_other' => 'อื่นๆ',
            'drowning_risk_other_des' => 'ระบุ',
            'drowning_length' => 'ระยะทางจากบ้าน(เมตร)',
            'drowning_accessory' => 'การใช้อุปกรณ์ช่วยลอยน้ำขณะเกิดเหตุ',
            'drowning_accessory_yes' => 'ถ้ามีระบุ',
            'drowning_accessory_yes_des' => 'อื่นๆระบุ',
            'drowning_after_dead' => 'หลังเกิดเหตุจมน้ำ',
            'drowning_helper' => 'ช่วยเหลือคนจมน้ำขึ้นมาจากน้ำด้วยวิธีการใด',
            'drowning_helper_drop_des' => 'ระบุอุปกรณ์โยนให้จับ',
            'drowning_rescue_water' => 'ภายหลังจากนำคนจมน้ำขึ้นมาจากน้ำ',
            'drowning_recue_no_des' => 'ไม่ได้ปฐมพยาบาล เพราะ',
            'drowning_recue_yes' => 'ทำการปฐมพยาบาล โดย',
            'drowning_rescue_yes_des' => 'ผู้ปฐมพยาบาล',
            'drowning_refer' => 'ภายหลังการปฐมพยาบาลได้นำส่งสถานบริการสาธารณสุข',
            'drowning_refer_hosp' => 'ระบุสถานบริการสาธารณสุข',
            'drowning_des' => 'บรรยายเหตุการณ์ก่อนเกิดเหตุจนกระทั่งจมน้ำ',
            'defend_drowning' => 'มีการจัดแหล่งน้ำที่เกิดเหตุเพื่อป้องกันการจมน้ำ',
            'defend_drowning_des' => 'ถ้ามี โปรดระบุ',
            'report_name' => 'ชื่อ-สกุลผู้รายงาน',
            'report_job' => 'ตำแหน่ง',
            'report_office' => 'หน่วยงาน',
            'report_province' => 'จังหวัด',
            'report_tel' => 'โทรศัพท์',
            'report_fax' => 'โทรสาร',
            'report_date' => 'วันที่รายงาน',
            'd_update' => 'วันที่ update',
            's_year'=>'ปีที่จม',
            's_nation'=>'สัญชาติ',
            's_age'=>'กลุ่มอายุ'
        ];
    }

    public function behaviors() {
        return [
            [
                'class'=> BlameableBehavior::className()
            ],
            [
                'class'=> TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ]
           
        ];
    }

    public function getChangwataddr() {
        return $this->hasOne(Cchangwat2::className(), ['changwatcode' => 'province_addr']);
    }

    public function getAmpuraddr() {
        return $this->hasOne(Campur2::className(), ['ampurcodefull' => 'amphur_addr']);
    }

    public function getTambonaddr() {
        return $this->hasOne(Ctambon2::className(), ['tamboncodefull' => 'tambon_addr']);
    }

    public function getChangwatdrown() {
        return $this->hasOne(Cchangwat::className(), ['changwatcode' => 'drowning_province']);
    }

    public function getAmpurdrown() {
        return $this->hasOne(Campur::className(), ['ampurcodefull' => 'drowning_amphur']);
    }

    public function getTambondrown() {
        return $this->hasOne(Ctambon::className(), ['tamboncodefull' => 'drowning_tambon']);
    }

}
