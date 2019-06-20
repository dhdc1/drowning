<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cchangwat".
 *
 * @property string $changwatcode
 * @property string $changwatname
 * @property string $zonecode
 */
class Cchangwat2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cchangwat2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['changwatcode'], 'required'],
            [['changwatcode', 'zonecode'], 'string', 'max' => 2],
            [['changwatname'], 'string', 'max' => 255],
            [['changwatcode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'changwatcode' => 'Changwatcode',
            'changwatname' => 'Changwatname',
            'zonecode' => 'Zonecode',
        ];
    }
}
