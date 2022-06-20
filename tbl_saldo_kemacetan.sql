/*
Navicat MySQL Data Transfer

Source Server         : slametwidodo.web.id
Source Server Version : 50734
Source Host           : 103.120.232.2:3306
Source Database       : slametwi_leasing

Target Server Type    : MYSQL
Target Server Version : 50734
File Encoding         : 65001

Date: 2021-06-23 13:01:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_saldo_kemacetan`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_saldo_kemacetan`;
CREATE TABLE `tbl_saldo_kemacetan` (
  `saldo_macet_id` int(11) NOT NULL AUTO_INCREMENT,
  `macet_bulan` char(10) NOT NULL,
  `macet_nominal` decimal(10,0) NOT NULL,
  PRIMARY KEY (`saldo_macet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_saldo_kemacetan
-- ----------------------------
INSERT INTO `tbl_saldo_kemacetan` VALUES ('1', '2021-04', '150000');
INSERT INTO `tbl_saldo_kemacetan` VALUES ('2', '2021-05', '25000000');
