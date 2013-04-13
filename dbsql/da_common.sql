/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : da_common

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-04-13 03:11:22
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `comm_note`
-- ----------------------------
DROP TABLE IF EXISTS `comm_note`;
CREATE TABLE `comm_note` (
  `n_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '便签id',
  `n_ntid` int(10) NOT NULL COMMENT '便签簿id',
  `n_title` varchar(500) NOT NULL COMMENT '便签标题',
  `n_abstract` varchar(1000) NOT NULL COMMENT '便签摘要',
  `n_content` text NOT NULL COMMENT '便签详细内容',
  `n_puid` int(10) NOT NULL COMMENT '便签记录人id',
  `n_date` datetime NOT NULL COMMENT '便签记录日期',
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='便签信息表';

-- ----------------------------
-- Records of comm_note
-- ----------------------------

-- ----------------------------
-- Table structure for `comm_notetype`
-- ----------------------------
DROP TABLE IF EXISTS `comm_notetype`;
CREATE TABLE `comm_notetype` (
  `nt_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '便签簿id',
  `nt_name` varchar(100) NOT NULL COMMENT '便签簿名称',
  `nt_puid` int(10) NOT NULL COMMENT '便签簿拥有人id',
  PRIMARY KEY (`nt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='便签簿表';

-- ----------------------------
-- Records of comm_notetype
-- ----------------------------
