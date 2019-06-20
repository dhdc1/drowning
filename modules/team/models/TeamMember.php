<?php

namespace app\modules\team\models;

use Yii;

/**
 * This is the model class for table "team_member".
 *
 * @property int $id
 * @property string $fullname
 * @property string $team_position
 * @property string $office
 * @property string $tel
 * @property string $email
 * @property int $team_id
 */
class TeamMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_id','team_position','fullname'], 'required'],
            [['id', 'team_id'], 'integer'],
            [['fullname', 'team_position', 'office', 'tel', 'email'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            //'id' => 'ID',
            'fullname' => 'ชื่อ-นามสกุล',
            'team_position' => 'ตำแหน่งในทีม',
            'office' => 'สังกัดหน่วยงาน',
            'tel' => 'โทรศัพท์',
            'email' => 'Email',
            'team_id' => 'รหัสทีม',
        ];
    }
}
