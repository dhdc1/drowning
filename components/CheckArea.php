<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use app\models\ReportDead;

/**
 * Description of CheckArea
 *
 * @author MyNB
 */
class CheckArea extends \yii\base\Component {

    public static function allowAccessCase($caseId) {
        //$caseId = \Yii::$app->request->get('id');
        $caseDrown = ReportDead::findOne($caseId);

        $user = \Yii::$app->user->identity->username;
        $sql = " SELECT  t.location FROM `profile`  t
INNER JOIN `user`  u  ON u.id = t.user_id
WHERE  u.username = '$user' ";
        $userArea = \Yii::$app->db->createCommand($sql)->queryScalar();
        $caseArea = $caseDrown->drowning_amphur;
        $isAdmin = \Yii::$app->user->can('admin');

        if (strlen($userArea) <> 2) {
            if (trim($userArea) <> trim($caseArea) && !$isAdmin) {
                throw new \yii\web\ForbiddenHttpException("ท่านไม่ได้รับอนุญาตให้เข้าถึงข้อมูลนี้!!");
            }
        }else{// กรณี PM จังหวัดให้ใส่รหัสอำเภอเป็นรหัสจังหวัด 2 หลัก
            if (trim($userArea) <> substr(trim($caseArea),0,2)) {
                throw new \yii\web\ForbiddenHttpException("ท่านไม่ได้รับอนุญาตให้เข้าถึงข้อมูลนี้!!");
            }
        }
    }

}
