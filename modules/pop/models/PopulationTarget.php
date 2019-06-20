<?php

namespace app\modules\pop\models;

use Yii;

/**
 * This is the model class for table "population_target".
 *
 * @property string $ampurcode รหัสอำเภอ
 * @property string $changwatcode รหัสจังหวัด
 * @property string $byear พุธศักราช
 * @property int $pop_male ประชากรกลางปี(ชาย)
 * @property int $pop_female ประชากรกลางปี(ชาย)
 */
class PopulationTarget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'population_target';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ampurcode', 'byear'], 'required'],
            [['pop_male', 'pop_female'], 'integer'],
            [['ampurcode', 'byear'], 'string', 'max' => 4],
            [['changwatcode'], 'string', 'max' => 2],
            [['ampurcode', 'byear'], 'unique', 'targetAttribute' => ['ampurcode', 'byear']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ampurcode' => 'อำเภอ',
            'changwatcode' => 'จังหวัด',
            'byear' => 'ปีพุทธศักราช (พ.ศ.)',
            'pop_male' => 'เด็ก0-15ปี(ชาย)',
            'pop_female' => 'เด็ก0-15ปี(หญิง)',
        ];
    }
    
     public function getCchangwat(){
        return $this->hasOne(\app\models\Cchangwat::className(), ['changwatcode'=>'changwatcode']);
    }
    
    public function getCampur(){
        return $this->hasOne(\app\models\Campur::className(), ['ampurcodefull'=>'ampurcode']);
    }
}
