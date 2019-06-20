<?php

namespace app\modules\pop\models;

use Yii;
use app\models\Cchangwat;

/**
 * This is the model class for table "population_base".
 *
 * @property string $ampurcode รหัสอำเภอ
 * @property string $changwatcode รหัสจังหวัด
 * @property string $byear พุธศักราช
 * @property int $pop_male ประชากรกลางปี(ชาย)
 * @property int $pop_female ประชากรกลางปี(ชาย)
 */
class PopulationBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'population_base';
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
            'pop_male' => 'ประชากรกลางปี(ชาย)',
            'pop_female' => 'ประชากรกลางปี(หญิง)',
        ];
    }
    public function getCchangwat(){
        return $this->hasOne(Cchangwat::className(), ['changwatcode'=>'changwatcode']);
    }
    
    public function getCampur(){
        return $this->hasOne(\app\models\Campur::className(), ['ampurcodefull'=>'ampurcode']);
    }
}
