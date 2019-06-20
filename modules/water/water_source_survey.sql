/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100309
 Source Host           : localhost:3306
 Source Schema         : yii2basic

 Target Server Type    : MySQL
 Target Server Version : 100309
 File Encoding         : 65001

 Date: 10/10/2018 19:11:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for water_source_survey
-- ----------------------------
DROP TABLE IF EXISTS `water_source_survey`;
CREATE TABLE `water_source_survey`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'จังหวัด',
  `amphur` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'อำเภอ',
  `tambon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ตำบล',
  `village_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'หมู่ที่',
  `village_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'หมู่บ้าน',
  `source_type` enum('แม่น้ำ','อ่าง-ฝายเก็บน้ำ','เขื่อน','ห้วย-คลองสาธารณะ','บ่อน้ำ-สระขุดทางการเกษตร','สระว่ายน้ำ','ภาชนะเก็บน้ำ-อ่างอาบน้ำ','อ่างเลี้ยงปลา-อ่างบัว') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ประเภท',
  `distance_village_mater` int(11) NULL DEFAULT NULL COMMENT 'ระยะห่างจากชุมชน(เมตร)',
  `safty_manage` enum('มีแนวกั้น-รั้วกัน','มีป้ายคำเตือน','มีวัสดุอุปกรณ์ช่วยคนตกน้ำ') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'การจัดการป้องกัน',
  `lat` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ละติจูด',
  `lon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ลองจิจูด',
  `survey_date` date NULL DEFAULT NULL,
  `surveyer` enum('จนท.สาธารณสุข','อาสาสมัครสาธารณสุข','กำนัน-ผู้ใหญ่บ้าน','องค์การปกครองส่วนท้องถิ่น') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of water_source_survey
-- ----------------------------
INSERT INTO `water_source_survey` VALUES (2, '53', '5302', '530203', '', '', 'อ่าง-ฝายเก็บน้ำ', NULL, 'มีแนวกั้น-รั้วกัน', '', '', '2018-10-05', 'จนท.สาธารณสุข', NULL, NULL, NULL, NULL);
INSERT INTO `water_source_survey` VALUES (3, '63', '6302', '630202', '', '', 'เขื่อน', NULL, 'มีวัสดุอุปกรณ์ช่วยคนตกน้ำ', '', '', '2018-10-11', 'จนท.สาธารณสุข', NULL, NULL, NULL, NULL);
INSERT INTO `water_source_survey` VALUES (4, '53', '5302', '530203', '', '', 'เขื่อน', NULL, 'มีป้ายคำเตือน', '13.723418599999999', '100.4762319', '2018-10-18', 'จนท.สาธารณสุข', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
