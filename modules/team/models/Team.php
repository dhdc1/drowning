<?php

namespace app\modules\team\models;

use Yii;
use app\modules\team\models\Cchangwat;
use app\modules\team\models\Campur;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string $team_name
 * @property string $changwat
 * @property string $ampur
 * @property string $team_level
 * @property string $approv_date
 * @property string $myear Description
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['team_name'], 'required'],
            [['approv_date'], 'safe'],
            [['team_name', 'changwat', 'ampur', 'team_level','myear'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_name' => 'ชื่อทีม',
            'changwat' => 'จังหวัด',
            'ampur' => 'อำเภอ',
            'team_level' => 'ระดับ',
            'approv_date' => 'วันรับรองผล',
            'myear'=>'ปีงบประมาณ'
        ];
    }
    
    public function getCchangwat(){
        return $this->hasOne(Cchangwat::className(), ['changwatcode'=>'changwat']);
        
    }
    
    public function getCampur(){
        return $this->hasOne(Campur::className(), ['ampurcodefull'=>'ampur']);
    }
}
