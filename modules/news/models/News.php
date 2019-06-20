<?php

namespace app\modules\news\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $picture
 * @property string $attach
 * @property string $d_update
 */
class News extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['content'], 'string'],
                [['d_update'], 'safe'],
                [['title'], 'string', 'max' => 255],
                [['picture'], 'file',
                    'skipOnEmpty' => true,
                    'extensions' => 'png,jpg'
                ],
            [['attach'], 'file',
                    'skipOnEmpty' => true,
                    'extensions' => 'zip,rar,pdf,docx,doc,xls,xlsx,ppt,pptx,png,jpg'
                ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'ชื่อเรื่อง',
            'content' => 'เนื้อหา',
            'picture' => 'รูปภาพ',
            'attach' => 'แนบไฟล์',
            'd_update' => 'อัพเดทล่าสุด',
        ];
    }

}
