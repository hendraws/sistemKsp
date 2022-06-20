/*
Navicat MySQL Data Transfer

Source Server         : slametwidodo.web.id
Source Server Version : 50734
Source Host           : 103.120.232.2:3306
Source Database       : slametwi_leasing

Target Server Type    : MYSQL
Target Server Version : 50734
File Encoding         : 65001

Date: 2021-06-23 13:02:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_anggota_awal`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_anggota_awal`;
CREATE TABLE `tbl_anggota_awal` (
  `anggota_awal_id` int(11) NOT NULL AUTO_INCREMENT,
  `anggota_awal` int(11) DEFAULT NULL,
  `anggota_bulan` char(10) DEFAULT NULL,
  PRIMARY KEY (`anggota_awal_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_anggota_awal
-- ----------------------------
INSERT INTO `tbl_anggota_awal` VALUES ('1', '21', '2021-05');
INSERT INTO `tbl_anggota_awal` VALUES ('2', '1872', '2021-06-01');
