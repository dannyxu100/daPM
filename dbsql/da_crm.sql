/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : da_crm

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2013-04-06 22:12:17
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `crm_cst2user`
-- ----------------------------
DROP TABLE IF EXISTS `crm_cst2user`;
CREATE TABLE `crm_cst2user` (
  `c2u_id` int(10) NOT NULL auto_increment COMMENT '客户映射员工id',
  `c2u_cid` int(10) NOT NULL COMMENT '客户id',
  `c2u_puid` int(10) NOT NULL COMMENT '员工id',
  PRIMARY KEY  (`c2u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='客户、员工映射表';

-- ----------------------------
-- Records of crm_cst2user
-- ----------------------------
INSERT INTO crm_cst2user VALUES ('1', '2', '1');
INSERT INTO crm_cst2user VALUES ('12', '21', '1');
INSERT INTO crm_cst2user VALUES ('13', '22', '1');
INSERT INTO crm_cst2user VALUES ('14', '23', '3');
INSERT INTO crm_cst2user VALUES ('15', '5', '1');
INSERT INTO crm_cst2user VALUES ('16', '16', '1');
INSERT INTO crm_cst2user VALUES ('17', '13', '1');
INSERT INTO crm_cst2user VALUES ('18', '14', '1');
INSERT INTO crm_cst2user VALUES ('19', '17', '1');
INSERT INTO crm_cst2user VALUES ('20', '15', '1');
INSERT INTO crm_cst2user VALUES ('21', '18', '1');
INSERT INTO crm_cst2user VALUES ('22', '20', '3');
INSERT INTO crm_cst2user VALUES ('23', '7', '3');
INSERT INTO crm_cst2user VALUES ('24', '6', '1');

-- ----------------------------
-- Table structure for `crm_customer`
-- ----------------------------
DROP TABLE IF EXISTS `crm_customer`;
CREATE TABLE `crm_customer` (
  `c_id` int(10) NOT NULL auto_increment COMMENT '客户id',
  `c_name` varchar(500) NOT NULL COMMENT '客户名称',
  `c_type` varchar(100) NOT NULL COMMENT '客户分类',
  `c_source` varchar(100) NOT NULL COMMENT '客户来源',
  `c_level` varchar(100) NOT NULL COMMENT '客户等级',
  `c_addr` varchar(1000) NOT NULL COMMENT '客户地址',
  `c_telephone` varchar(100) NOT NULL COMMENT '客户电话',
  `c_email` varchar(100) NOT NULL COMMENT '客户电子邮箱',
  `c_website` varchar(1000) NOT NULL COMMENT '客户官方网址',
  `c_fax` varchar(100) NOT NULL COMMENT '客户传真',
  `c_phone` varchar(100) NOT NULL COMMENT '客户手机',
  `c_user` varchar(50) NOT NULL COMMENT '客户负责人',
  `c_qq` varchar(200) NOT NULL COMMENT '客户qq号码',
  `c_trade` varchar(500) NOT NULL COMMENT '客户行业',
  `c_createpuid` int(10) NOT NULL COMMENT '创建人id',
  `c_createpuname` varchar(50) NOT NULL COMMENT '创建人名称',
  `c_createdate` datetime NOT NULL COMMENT '注册日期',
  `c_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='客户基本信息表';

-- ----------------------------
-- Records of crm_customer
-- ----------------------------
INSERT INTO crm_customer VALUES ('2', '成都立德粉', '潜在客户', '网络', 'A', '', '13688387776', '', '', '', '13688387776', '徐某某', '', '', '0', '', '0000-00-00 00:00:00', '');
INSERT INTO crm_customer VALUES ('3', '成都23房管局', '意向客户', '电话', 'B', '', '33224432', '', '', '', '', '王正月', '', '', '0', '', '0000-00-00 00:00:00', '');
INSERT INTO crm_customer VALUES ('4', '上海烟草集团有限公司', '意向客户', '电话', 'B', '上海浦东', '13688473223', 'dannyxu100@163.com', 'http://www.shanghai.com', '9998324', '13877223332', '王副总', '8233922', '', '0', '', '0000-00-00 00:00:00', '中南海烟草老总，惹不起。');
INSERT INTO crm_customer VALUES ('5', '广州市佰健生物工程有限公司', '意向客户', '客户推荐', 'A', '广州市天河区珠江新城双城国际大厦A幢2305房', '13549944423', 'kangcheng@139.com', 'http://www.by-health.com', '77383442', '13632244723', '周总', '889923', '', '0', '', '0000-00-00 00:00:00', '汤臣倍健');
INSERT INTO crm_customer VALUES ('6', '百威（中国）销售有限公司', '潜在客户', '朋友介绍', 'C', '武汉市汉阳区琴断口上首', '40061112', '', 'http://genuine.com', '', '', '肖晓鹤', '', '旅游、餐饮、娱乐、休闲、购物', '1', '徐飞', '2013-04-05 12:22:27', '');
INSERT INTO crm_customer VALUES ('7', '成都新希臣药业有限公司', '潜在客户', '电话', 'E', '成都市浦江县寿安镇石鱼沱', '85134556', '', '', '', '', '席喜平', '', '医疗保健、社会福利', '1', '徐飞', '2013-04-05 12:37:24', '可以联系一下，有可能做优化');
INSERT INTO crm_customer VALUES ('23', '广州王老吉药业股份有限公司食品饮料分公司（A）', '潜在客户', '网络', 'B', '广州市白云区广花二路831号', '40023302', '', '', '', '', '李经理', '', '保险', '3', '张凯', '2013-04-05 14:39:30', '');
