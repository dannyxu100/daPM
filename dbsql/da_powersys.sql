/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : da_powersys

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2013-04-06 22:12:25
*/

SET FOREIGN_KEY_CHECKS=0;
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
  `c_createdate` datetime NOT NULL COMMENT '注册日期',
  `c_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客户基本信息表';

-- ----------------------------
-- Records of crm_customer
-- ----------------------------

-- ----------------------------
-- Table structure for `p_group`
-- ----------------------------
DROP TABLE IF EXISTS `p_group`;
CREATE TABLE `p_group` (
  `pg_id` int(10) NOT NULL auto_increment COMMENT '组id',
  `pg_pid` int(10) NOT NULL COMMENT '所属父组id',
  `pg_sort` int(10) NOT NULL COMMENT '排序',
  `pg_name` varchar(50) NOT NULL COMMENT '组名称',
  `pg_date` datetime NOT NULL COMMENT '组创建时间',
  `pg_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`pg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='工作组表';

-- ----------------------------
-- Records of p_group
-- ----------------------------
INSERT INTO p_group VALUES ('1', '-1', '0', '成都网联天下（工作组）', '0000-00-00 00:00:00', '');
INSERT INTO p_group VALUES ('2', '1', '10', '行政1组', '0000-00-00 00:00:00', '');
INSERT INTO p_group VALUES ('3', '1', '0', '总监1组', '0000-00-00 00:00:00', '');
INSERT INTO p_group VALUES ('4', '1', '5', '经理1组', '0000-00-00 00:00:00', '');
INSERT INTO p_group VALUES ('5', '1', '30', '员工', '0000-00-00 00:00:00', '');

-- ----------------------------
-- Table structure for `p_group2role`
-- ----------------------------
DROP TABLE IF EXISTS `p_group2role`;
CREATE TABLE `p_group2role` (
  `g2r_id` int(10) NOT NULL auto_increment COMMENT '工作组映射角色流水id',
  `g2r_pgid` int(10) NOT NULL COMMENT '组id',
  `g2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY  (`g2r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='工作组映射角色表';

-- ----------------------------
-- Records of p_group2role
-- ----------------------------
INSERT INTO p_group2role VALUES ('1', '3', '2');
INSERT INTO p_group2role VALUES ('2', '6', '2');

-- ----------------------------
-- Table structure for `p_log`
-- ----------------------------
DROP TABLE IF EXISTS `p_log`;
CREATE TABLE `p_log` (
  `pl_id` int(10) NOT NULL auto_increment COMMENT '日志id',
  `pl_type` varchar(20) NOT NULL COMMENT '操作类型',
  `pl_conent` varchar(2000) NOT NULL COMMENT '操作内容',
  `pl_puid` int(10) NOT NULL COMMENT '操作人',
  `pl_date` datetime NOT NULL COMMENT '操作时间',
  PRIMARY KEY  (`pl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='日志表';

-- ----------------------------
-- Records of p_log
-- ----------------------------

-- ----------------------------
-- Table structure for `p_menu`
-- ----------------------------
DROP TABLE IF EXISTS `p_menu`;
CREATE TABLE `p_menu` (
  `pm_id` int(10) NOT NULL auto_increment COMMENT '菜单id',
  `pm_pid` int(10) NOT NULL COMMENT '菜单父id',
  `pm_name` varchar(50) character set utf8 NOT NULL COMMENT '菜单名',
  `pm_level` int(10) NOT NULL COMMENT '菜单级别',
  `pm_sort` int(10) NOT NULL COMMENT '排序',
  `pm_url` varchar(1000) character set utf8 NOT NULL COMMENT '页面链接地址',
  `pm_img` varchar(1000) character set utf8 NOT NULL COMMENT '图标文件地址',
  `pm_remark` text character set utf8 NOT NULL COMMENT '备注',
  PRIMARY KEY  (`pm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COMMENT='系统菜单表';

-- ----------------------------
-- Records of p_menu
-- ----------------------------
INSERT INTO p_menu VALUES ('1', '-1', '成都网联天下（菜单管理）', '0', '1', '#', '/image/menu/logo.jpg', '');
INSERT INTO p_menu VALUES ('2', '1', '项目进度', '1', '99', '/main.php?menu=2', '/images/menu_icon/time.png', '');
INSERT INTO p_menu VALUES ('3', '1', '权限管理', '1', '50', '/sys_power/index.php?menu=3', '/images/menu_icon/power.png', '');
INSERT INTO p_menu VALUES ('5', '3', '部门管理', '2', '1', '/sys_power/org_manage.php', '/images/menu_icon/depart.png', '');
INSERT INTO p_menu VALUES ('6', '3', '人员管理', '2', '10', '/sys_power/user_manage.php', '/images/menu_icon/user.png', '');
INSERT INTO p_menu VALUES ('7', '3', '工作组管理', '2', '20', '/sys_power/group_manage.php', '/images/menu_icon/group.png', '');
INSERT INTO p_menu VALUES ('8', '3', '角色管理', '2', '30', '/sys_power/role_manage.php', '/images/menu_icon/role.png', '');
INSERT INTO p_menu VALUES ('9', '3', '模块管理', '2', '40', '/sys_power/power_manage.php', '/images/menu_icon/module.png', '');
INSERT INTO p_menu VALUES ('10', '3', '权限类型管理', '2', '50', '/sys_power/powertype_manage.php', '/images/menu_icon/keytype.png', '');
INSERT INTO p_menu VALUES ('11', '1', '流程管理', '1', '40', '/sys_workflow/index.php?menu=11', '/images/menu_icon/workflow.png', '');
INSERT INTO p_menu VALUES ('12', '11', '工作流管理', '2', '10', '/sys_workflow/workflow_manage.php', '/images/menu_icon/flow.png', '');
INSERT INTO p_menu VALUES ('13', '11', '表单管理', '2', '1', '/sys_bizform/biztemplet_manage.php', '/images/menu_icon/form.png', '');
INSERT INTO p_menu VALUES ('14', '3', '导航菜单管理', '2', '60', '/sys_power/menu_manage.php', '/images/menu_icon/menu.png', '');
INSERT INTO p_menu VALUES ('21', '1', '系统管理', '1', '100', '/sys_setting/index.php?menu=21', '/images/menu_icon/setting.png', '');
INSERT INTO p_menu VALUES ('22', '1', '业务面板', '1', '10', '/sys_common/biz/index.php', '/images/menu_icon/business.png', '');
INSERT INTO p_menu VALUES ('23', '21', '可选项配置', '2', '0', '/sys_setting/item/item_manage.php', '', '');
INSERT INTO p_menu VALUES ('24', '21', '基本信息配置', '2', '0', '', '', '');
INSERT INTO p_menu VALUES ('25', '1', 'OA办公', '1', '30', '/sys_common/oa/index.php?menu=25', '/images/menu_icon/book.png', '');
INSERT INTO p_menu VALUES ('26', '25', '日记便签', '2', '0', '', '', '');
INSERT INTO p_menu VALUES ('28', '25', '通知公告', '2', '0', '', '', '');
INSERT INTO p_menu VALUES ('29', '3', '上下级管理', '2', '5', '/sys_power/relation_manage.php', '/images/menu_icon/relation.png', '');
INSERT INTO p_menu VALUES ('30', '11', '数据库管理', '2', '30', '/sys_userform/db_manage.php', '/images/menu_icon/database.png', '');
INSERT INTO p_menu VALUES ('31', '25', '投票', '2', '0', '', '', '');
INSERT INTO p_menu VALUES ('32', '3', '角色流程权限', '2', '33', '', '', '');
INSERT INTO p_menu VALUES ('33', '3', '角色模块权限', '2', '32', '', '', '');
INSERT INTO p_menu VALUES ('34', '3', '角色菜单权限', '2', '31', '', '', '');
INSERT INTO p_menu VALUES ('35', '1', '我的桌面', '1', '0', '/sys_common/mydesk/mydesk.php', '/images/menu_icon/desk.png', '/sys_msg/sendemail.php\n/desk.php');
INSERT INTO p_menu VALUES ('36', '21', '帮助文档', '2', '99', '/sys_setting/helper/helper_manage.php', '/images/sys_icon/help.png', '');
INSERT INTO p_menu VALUES ('38', '1', 'CRM系统', '1', '20', '/sys_crm/index.php?menu=38', '/images/menu_icon/group.png', '');
INSERT INTO p_menu VALUES ('39', '1', '统计分析', '1', '35', '/sys_common/chart/index.htm?menu=39', '/images/menu_icon/chart_bar.png', '');
INSERT INTO p_menu VALUES ('40', '39', '企业建站项目统计', '2', '20', '/sys_common/chart/website.htm', '', '');
INSERT INTO p_menu VALUES ('41', '25', '发送邮件', '2', '99', '/sys_common/email/sendmail.php', '/images/sys_icon/email_go.png', '');
INSERT INTO p_menu VALUES ('42', '39', '员工假事统计', '2', '99', '/sys_common/chart/leave.htm', '', '');
INSERT INTO p_menu VALUES ('43', '25', '倒计时', '2', '0', '', '/images/menu_icon/time.png', '');
INSERT INTO p_menu VALUES ('44', '25', '总经理意见箱', '2', '0', '', '', '');
INSERT INTO p_menu VALUES ('45', '1', '产品库', '1', '37', '', '', '');
INSERT INTO p_menu VALUES ('46', '25', '企业制度文档', '2', '0', '', '', '');
INSERT INTO p_menu VALUES ('47', '25', '新建菜单', '0', '0', '', '', '');
INSERT INTO p_menu VALUES ('48', '21', '系统意见反馈', '2', '0', '', '', '');
INSERT INTO p_menu VALUES ('55', '38', '公海客户', '2', '10', '/sys_crm/publiccst.php', '/images/sys_icon/crm_public.png', '');
INSERT INTO p_menu VALUES ('56', '38', '我的客户', '2', '0', '/sys_crm/mycst.php', '/images/sys_icon/crm_my.png', '');
INSERT INTO p_menu VALUES ('57', '38', '客户转移', '2', '20', '/sys_crm/cst_move.php', '/images/sys_icon/crm_move.png', '');
INSERT INTO p_menu VALUES ('58', '38', '回收站', '2', '99', '', '/images/sys_icon/recycle.png', '');

-- ----------------------------
-- Table structure for `p_menu2role`
-- ----------------------------
DROP TABLE IF EXISTS `p_menu2role`;
CREATE TABLE `p_menu2role` (
  `m2r_id` int(10) NOT NULL auto_increment COMMENT '菜单角色映射id',
  `m2r_pmid` int(10) NOT NULL COMMENT '菜单id',
  `m2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY  (`m2r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COMMENT='菜单角色映射表';

-- ----------------------------
-- Records of p_menu2role
-- ----------------------------
INSERT INTO p_menu2role VALUES ('1', '1', '3');
INSERT INTO p_menu2role VALUES ('2', '2', '3');
INSERT INTO p_menu2role VALUES ('3', '22', '3');
INSERT INTO p_menu2role VALUES ('4', '35', '5');
INSERT INTO p_menu2role VALUES ('5', '38', '5');
INSERT INTO p_menu2role VALUES ('6', '25', '5');
INSERT INTO p_menu2role VALUES ('7', '22', '5');
INSERT INTO p_menu2role VALUES ('8', '26', '5');
INSERT INTO p_menu2role VALUES ('9', '28', '5');
INSERT INTO p_menu2role VALUES ('10', '31', '5');
INSERT INTO p_menu2role VALUES ('11', '43', '5');
INSERT INTO p_menu2role VALUES ('12', '44', '5');
INSERT INTO p_menu2role VALUES ('13', '46', '5');
INSERT INTO p_menu2role VALUES ('14', '47', '5');
INSERT INTO p_menu2role VALUES ('15', '41', '5');
INSERT INTO p_menu2role VALUES ('16', '39', '5');
INSERT INTO p_menu2role VALUES ('17', '42', '5');
INSERT INTO p_menu2role VALUES ('18', '40', '5');
INSERT INTO p_menu2role VALUES ('19', '45', '5');
INSERT INTO p_menu2role VALUES ('20', '11', '5');
INSERT INTO p_menu2role VALUES ('21', '13', '5');
INSERT INTO p_menu2role VALUES ('22', '12', '5');
INSERT INTO p_menu2role VALUES ('23', '30', '5');
INSERT INTO p_menu2role VALUES ('24', '3', '5');
INSERT INTO p_menu2role VALUES ('25', '5', '5');
INSERT INTO p_menu2role VALUES ('26', '6', '5');
INSERT INTO p_menu2role VALUES ('27', '29', '5');
INSERT INTO p_menu2role VALUES ('28', '7', '5');
INSERT INTO p_menu2role VALUES ('29', '8', '5');
INSERT INTO p_menu2role VALUES ('30', '34', '5');
INSERT INTO p_menu2role VALUES ('31', '33', '5');
INSERT INTO p_menu2role VALUES ('32', '32', '5');
INSERT INTO p_menu2role VALUES ('33', '9', '5');
INSERT INTO p_menu2role VALUES ('34', '10', '5');
INSERT INTO p_menu2role VALUES ('35', '14', '5');
INSERT INTO p_menu2role VALUES ('36', '2', '5');
INSERT INTO p_menu2role VALUES ('37', '21', '5');
INSERT INTO p_menu2role VALUES ('38', '23', '5');
INSERT INTO p_menu2role VALUES ('39', '24', '5');
INSERT INTO p_menu2role VALUES ('40', '48', '5');
INSERT INTO p_menu2role VALUES ('41', '36', '5');
INSERT INTO p_menu2role VALUES ('42', '1', '5');
INSERT INTO p_menu2role VALUES ('43', '22', '16');
INSERT INTO p_menu2role VALUES ('44', '25', '16');
INSERT INTO p_menu2role VALUES ('45', '26', '16');
INSERT INTO p_menu2role VALUES ('46', '28', '16');
INSERT INTO p_menu2role VALUES ('47', '31', '16');
INSERT INTO p_menu2role VALUES ('48', '43', '16');
INSERT INTO p_menu2role VALUES ('49', '44', '16');
INSERT INTO p_menu2role VALUES ('50', '46', '16');
INSERT INTO p_menu2role VALUES ('51', '47', '16');
INSERT INTO p_menu2role VALUES ('52', '41', '16');
INSERT INTO p_menu2role VALUES ('53', '39', '16');
INSERT INTO p_menu2role VALUES ('54', '42', '16');
INSERT INTO p_menu2role VALUES ('55', '40', '16');
INSERT INTO p_menu2role VALUES ('56', '45', '16');
INSERT INTO p_menu2role VALUES ('73', '38', '16');
INSERT INTO p_menu2role VALUES ('74', '35', '16');
INSERT INTO p_menu2role VALUES ('75', '1', '16');
INSERT INTO p_menu2role VALUES ('76', '22', '4');
INSERT INTO p_menu2role VALUES ('77', '35', '4');
INSERT INTO p_menu2role VALUES ('78', '38', '4');
INSERT INTO p_menu2role VALUES ('79', '25', '4');
INSERT INTO p_menu2role VALUES ('80', '26', '4');
INSERT INTO p_menu2role VALUES ('81', '28', '4');
INSERT INTO p_menu2role VALUES ('82', '31', '4');
INSERT INTO p_menu2role VALUES ('83', '43', '4');
INSERT INTO p_menu2role VALUES ('84', '44', '4');
INSERT INTO p_menu2role VALUES ('85', '46', '4');
INSERT INTO p_menu2role VALUES ('86', '47', '4');
INSERT INTO p_menu2role VALUES ('87', '41', '4');
INSERT INTO p_menu2role VALUES ('88', '45', '4');
INSERT INTO p_menu2role VALUES ('106', '43', '19');
INSERT INTO p_menu2role VALUES ('105', '28', '19');
INSERT INTO p_menu2role VALUES ('104', '31', '19');
INSERT INTO p_menu2role VALUES ('103', '26', '19');
INSERT INTO p_menu2role VALUES ('102', '25', '19');
INSERT INTO p_menu2role VALUES ('101', '38', '19');
INSERT INTO p_menu2role VALUES ('100', '22', '19');
INSERT INTO p_menu2role VALUES ('98', '1', '19');
INSERT INTO p_menu2role VALUES ('99', '35', '19');
INSERT INTO p_menu2role VALUES ('107', '44', '19');
INSERT INTO p_menu2role VALUES ('108', '46', '19');
INSERT INTO p_menu2role VALUES ('109', '47', '19');
INSERT INTO p_menu2role VALUES ('110', '41', '19');
INSERT INTO p_menu2role VALUES ('111', '39', '19');
INSERT INTO p_menu2role VALUES ('112', '42', '19');
INSERT INTO p_menu2role VALUES ('113', '40', '19');
INSERT INTO p_menu2role VALUES ('114', '45', '19');
INSERT INTO p_menu2role VALUES ('115', '35', '20');
INSERT INTO p_menu2role VALUES ('116', '1', '20');
INSERT INTO p_menu2role VALUES ('117', '22', '20');
INSERT INTO p_menu2role VALUES ('118', '25', '20');
INSERT INTO p_menu2role VALUES ('119', '26', '20');
INSERT INTO p_menu2role VALUES ('120', '28', '20');
INSERT INTO p_menu2role VALUES ('121', '31', '20');
INSERT INTO p_menu2role VALUES ('122', '43', '20');
INSERT INTO p_menu2role VALUES ('123', '44', '20');
INSERT INTO p_menu2role VALUES ('124', '46', '20');
INSERT INTO p_menu2role VALUES ('128', '22', '21');
INSERT INTO p_menu2role VALUES ('126', '41', '20');
INSERT INTO p_menu2role VALUES ('129', '35', '21');
INSERT INTO p_menu2role VALUES ('130', '1', '21');
INSERT INTO p_menu2role VALUES ('131', '38', '21');
INSERT INTO p_menu2role VALUES ('132', '25', '21');
INSERT INTO p_menu2role VALUES ('133', '28', '21');
INSERT INTO p_menu2role VALUES ('134', '26', '21');
INSERT INTO p_menu2role VALUES ('135', '43', '21');
INSERT INTO p_menu2role VALUES ('136', '31', '21');
INSERT INTO p_menu2role VALUES ('137', '44', '21');
INSERT INTO p_menu2role VALUES ('138', '46', '21');
INSERT INTO p_menu2role VALUES ('139', '47', '21');
INSERT INTO p_menu2role VALUES ('140', '41', '21');
INSERT INTO p_menu2role VALUES ('141', '56', '4');
INSERT INTO p_menu2role VALUES ('142', '55', '4');
INSERT INTO p_menu2role VALUES ('143', '57', '4');
INSERT INTO p_menu2role VALUES ('144', '58', '4');

-- ----------------------------
-- Table structure for `p_org`
-- ----------------------------
DROP TABLE IF EXISTS `p_org`;
CREATE TABLE `p_org` (
  `po_id` int(10) NOT NULL auto_increment COMMENT '部门id',
  `po_pid` int(10) NOT NULL COMMENT '父级部门id',
  `po_sort` int(10) NOT NULL COMMENT '排序',
  `po_name` varchar(50) NOT NULL COMMENT '部门名称',
  `po_date` datetime NOT NULL COMMENT '创建时间',
  `po_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`po_id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='部门表';

-- ----------------------------
-- Records of p_org
-- ----------------------------
INSERT INTO p_org VALUES ('0', '-1', '0', '成都网联天下（部门）', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('1', '0', '1', '技术部', '2013-01-30 16:09:42', '网联天下技术部，网页设计、SHOPEX、人人帮。');
INSERT INTO p_org VALUES ('2', '0', '10', '客服部', '2013-01-23 16:10:50', 'SEO网络优化推广。');
INSERT INTO p_org VALUES ('3', '1', '0', '程序组', '2013-01-29 16:11:47', 'PHP,ASP,切片。');
INSERT INTO p_org VALUES ('38', '1', '0', '设计组', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('57', '2', '0', '商友客服组', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('58', '0', '0', '总经办', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('59', '0', '0', '财务部', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('60', '66', '0', '商友市场部', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('61', '66', '0', '商派市场部', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('62', '2', '0', 'SEO客服组', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('64', '0', '0', '人事行政部', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('65', '2', '0', 'ShopEx客服组', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('66', '0', '5', '市场部', '0000-00-00 00:00:00', '');
INSERT INTO p_org VALUES ('69', '66', '0', '新建部门', '0000-00-00 00:00:00', '');

-- ----------------------------
-- Table structure for `p_power`
-- ----------------------------
DROP TABLE IF EXISTS `p_power`;
CREATE TABLE `p_power` (
  `pp_id` int(10) NOT NULL auto_increment COMMENT '权限id',
  `pp_pid` int(10) NOT NULL COMMENT '父权限id',
  `pp_name` varchar(50) NOT NULL COMMENT '权限名称',
  `pp_code` varchar(50) NOT NULL COMMENT '权限编码',
  `pp_sort` int(10) NOT NULL COMMENT '排序',
  `pp_date` datetime NOT NULL COMMENT '创建日期',
  `pp_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`pp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='功能权限表';

-- ----------------------------
-- Records of p_power
-- ----------------------------
INSERT INTO p_power VALUES ('1', '-1', '成都网联天下（权限模块）', 'rootpower', '0', '0000-00-00 00:00:00', '');
INSERT INTO p_power VALUES ('3', '1', '系统功能', 'sys', '0', '2013-02-12 00:00:00', '');
INSERT INTO p_power VALUES ('4', '3', '桌面', 'sys_desk', '0', '2013-02-12 00:00:00', '工作桌面');
INSERT INTO p_power VALUES ('5', '3', '部门管理', 'sys_depart', '0', '2013-02-12 00:00:00', '');
INSERT INTO p_power VALUES ('6', '3', '人员管理', 'sys_user', '0', '2013-02-12 00:00:00', '');
INSERT INTO p_power VALUES ('7', '3', '工作组管理', 'sys_group', '0', '2013-02-12 00:00:00', '');
INSERT INTO p_power VALUES ('8', '3', '角色管理', 'sys_role', '0', '2013-02-12 00:00:00', '');
INSERT INTO p_power VALUES ('9', '3', '权限管理', 'sys_power', '0', '2013-02-12 00:00:00', '');
INSERT INTO p_power VALUES ('10', '1', '业务功能', 'biz', '10', '2013-02-12 00:00:00', '');
INSERT INTO p_power VALUES ('11', '10', '创建项目', 'biz_project', '0', '2013-02-12 00:00:00', '');
INSERT INTO p_power VALUES ('12', '10', '创建日志', 'biz_log', '0', '2013-02-12 00:00:00', '');
INSERT INTO p_power VALUES ('13', '3', '权限类型管理', 'sys_powertype', '0', '2013-02-12 00:00:00', '');
INSERT INTO p_power VALUES ('14', '10', '修改密码', 'biz_updatepwd', '0', '2013-02-13 00:00:00', '');
INSERT INTO p_power VALUES ('15', '1', '业务流程', '', '20', '2013-02-13 00:00:00', '');
INSERT INTO p_power VALUES ('16', '15', '人事请假', '', '0', '2013-02-13 00:00:00', '');
INSERT INTO p_power VALUES ('17', '15', '企业网建', '', '10', '0000-00-00 00:00:00', '');
INSERT INTO p_power VALUES ('18', '15', '商派项目', '', '30', '0000-00-00 00:00:00', '');

-- ----------------------------
-- Table structure for `p_power2group`
-- ----------------------------
DROP TABLE IF EXISTS `p_power2group`;
CREATE TABLE `p_power2group` (
  `p2g_id` int(10) NOT NULL auto_increment COMMENT '组映射权限id',
  `p2g_pgid` int(10) NOT NULL COMMENT '组id',
  `p2g_ppid` int(10) NOT NULL COMMENT '权限id',
  `p2g_ptid` int(10) NOT NULL COMMENT '权限类型id',
  PRIMARY KEY  (`p2g_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='功能权限映射工作组表';

-- ----------------------------
-- Records of p_power2group
-- ----------------------------

-- ----------------------------
-- Table structure for `p_power2role`
-- ----------------------------
DROP TABLE IF EXISTS `p_power2role`;
CREATE TABLE `p_power2role` (
  `p2r_id` int(10) NOT NULL auto_increment COMMENT '角色映射权限id',
  `p2r_prid` int(10) NOT NULL COMMENT '角色id',
  `p2r_ppid` int(10) NOT NULL COMMENT '权限id',
  `p2r_ptid` int(10) NOT NULL COMMENT '权限类型id',
  PRIMARY KEY  (`p2r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='功能权限映射角色表';

-- ----------------------------
-- Records of p_power2role
-- ----------------------------
INSERT INTO p_power2role VALUES ('7', '5', '5', '1');
INSERT INTO p_power2role VALUES ('8', '5', '6', '1');
INSERT INTO p_power2role VALUES ('9', '5', '7', '4');
INSERT INTO p_power2role VALUES ('10', '5', '7', '3');
INSERT INTO p_power2role VALUES ('11', '5', '13', '2');
INSERT INTO p_power2role VALUES ('12', '5', '13', '3');
INSERT INTO p_power2role VALUES ('13', '5', '9', '2');
INSERT INTO p_power2role VALUES ('15', '2', '4', '2');
INSERT INTO p_power2role VALUES ('16', '2', '5', '2');
INSERT INTO p_power2role VALUES ('17', '2', '7', '2');
INSERT INTO p_power2role VALUES ('18', '2', '6', '2');
INSERT INTO p_power2role VALUES ('19', '2', '8', '2');
INSERT INTO p_power2role VALUES ('20', '2', '9', '2');
INSERT INTO p_power2role VALUES ('21', '2', '13', '2');
INSERT INTO p_power2role VALUES ('23', '2', '11', '2');
INSERT INTO p_power2role VALUES ('24', '2', '12', '2');
INSERT INTO p_power2role VALUES ('25', '2', '14', '2');
INSERT INTO p_power2role VALUES ('29', '6', '6', '4');
INSERT INTO p_power2role VALUES ('30', '3', '7', '3');
INSERT INTO p_power2role VALUES ('31', '3', '8', '3');
INSERT INTO p_power2role VALUES ('32', '3', '9', '4');
INSERT INTO p_power2role VALUES ('33', '3', '13', '4');
INSERT INTO p_power2role VALUES ('34', '5', '18', '1');
INSERT INTO p_power2role VALUES ('35', '5', '17', '1');
INSERT INTO p_power2role VALUES ('37', '5', '16', '1');

-- ----------------------------
-- Table structure for `p_power2user`
-- ----------------------------
DROP TABLE IF EXISTS `p_power2user`;
CREATE TABLE `p_power2user` (
  `p2u_id` int(10) NOT NULL auto_increment COMMENT '用户映射权限id',
  `p2u_puid` int(10) NOT NULL COMMENT '用户id',
  `p2u_ppid` int(10) NOT NULL COMMENT '权限id',
  `p2u_ptid` int(10) NOT NULL COMMENT '权限类型id',
  PRIMARY KEY  (`p2u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='功能权限映射用户表';

-- ----------------------------
-- Records of p_power2user
-- ----------------------------

-- ----------------------------
-- Table structure for `p_powertype`
-- ----------------------------
DROP TABLE IF EXISTS `p_powertype`;
CREATE TABLE `p_powertype` (
  `pt_id` int(10) NOT NULL auto_increment COMMENT '权限类型id',
  `pt_code` varchar(20) NOT NULL COMMENT '权限类型编码',
  `pt_name` varchar(100) NOT NULL COMMENT '权限类型名称',
  `pt_sort` int(10) NOT NULL COMMENT '排序',
  `pt_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`pt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='功能权限分类表';

-- ----------------------------
-- Records of p_powertype
-- ----------------------------
INSERT INTO p_powertype VALUES ('1', 'read', '可访问', '0', '');
INSERT INTO p_powertype VALUES ('2', 'manage', '可管理', '30', '');
INSERT INTO p_powertype VALUES ('3', 'delete', '可删除', '20', '');
INSERT INTO p_powertype VALUES ('4', 'create', '可新建', '10', '');

-- ----------------------------
-- Table structure for `p_relation`
-- ----------------------------
DROP TABLE IF EXISTS `p_relation`;
CREATE TABLE `p_relation` (
  `pr_id` int(10) NOT NULL auto_increment COMMENT '上下属关系id',
  `pr_poid` int(10) NOT NULL COMMENT '所在部门id',
  `pr_leaderid` int(10) NOT NULL COMMENT '领导人id',
  `pr_puid` int(10) NOT NULL COMMENT '从属人id',
  PRIMARY KEY  (`pr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='上下属关系表';

-- ----------------------------
-- Records of p_relation
-- ----------------------------
INSERT INTO p_relation VALUES ('1', '1', '1', '2');
INSERT INTO p_relation VALUES ('2', '1', '1', '3');
INSERT INTO p_relation VALUES ('3', '1', '1', '4');
INSERT INTO p_relation VALUES ('4', '1', '1', '6');
INSERT INTO p_relation VALUES ('5', '1', '1', '9');
INSERT INTO p_relation VALUES ('6', '1', '1', '24');
INSERT INTO p_relation VALUES ('7', '1', '1', '25');
INSERT INTO p_relation VALUES ('8', '1', '12', '1');
INSERT INTO p_relation VALUES ('9', '1', '12', '3');
INSERT INTO p_relation VALUES ('10', '1', '12', '4');
INSERT INTO p_relation VALUES ('11', '1', '27', '1');
INSERT INTO p_relation VALUES ('12', '1', '27', '3');
INSERT INTO p_relation VALUES ('13', '1', '27', '4');

-- ----------------------------
-- Table structure for `p_role`
-- ----------------------------
DROP TABLE IF EXISTS `p_role`;
CREATE TABLE `p_role` (
  `pr_id` int(10) NOT NULL auto_increment COMMENT '角色id',
  `pr_pid` int(10) NOT NULL COMMENT '父级角色id',
  `pr_name` varchar(50) NOT NULL COMMENT '角色名称',
  `pr_sort` int(10) NOT NULL COMMENT '排序',
  `pr_date` datetime NOT NULL COMMENT '角色创建时间',
  `pr_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`pr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of p_role
-- ----------------------------
INSERT INTO p_role VALUES ('1', '-1', '成都网联天下（角色）', '0', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('4', '1', '员工', '999', '2013-02-13 00:00:00', '');
INSERT INTO p_role VALUES ('5', '1', '超级管理员', '0', '2013-02-13 00:00:00', '');
INSERT INTO p_role VALUES ('9', '1', '技术部门', '0', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('10', '9', '技术总监', '1', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('11', '9', '首席设计师', '30', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('12', '9', '高级软件工程师', '40', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('13', '9', '设计师', '30', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('14', '9', '软件工程师', '50', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('15', '1', '总经办', '0', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('16', '15', '总经理', '1', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('17', '9', '总监助理', '10', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('18', '15', '总经理助理', '10', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('19', '1', '财务总监', '0', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('20', '9', '切片师', '35', '0000-00-00 00:00:00', '');
INSERT INTO p_role VALUES ('21', '9', '技术维护', '60', '0000-00-00 00:00:00', '');

-- ----------------------------
-- Table structure for `p_user`
-- ----------------------------
DROP TABLE IF EXISTS `p_user`;
CREATE TABLE `p_user` (
  `pu_id` int(10) NOT NULL auto_increment COMMENT '用户id号',
  `pu_oid` int(10) NOT NULL COMMENT '所属组织id号',
  `pu_code` varchar(50) NOT NULL COMMENT '账号',
  `pu_pwd` varchar(50) NOT NULL COMMENT '密码',
  `pu_name` varchar(20) NOT NULL COMMENT '姓名',
  `pu_icon` text NOT NULL COMMENT '用户头像图片地址',
  `pu_gender` varchar(4) NOT NULL COMMENT '性别',
  `pu_phone` varchar(50) NOT NULL COMMENT '手机',
  `pu_telephone` varchar(50) NOT NULL COMMENT '电话',
  `pu_address` varchar(500) NOT NULL COMMENT '地址',
  `pu_lastlogin` datetime NOT NULL COMMENT '最后一次登陆系统',
  `pu_logincount` int(11) NOT NULL COMMENT '登陆系统次数',
  `pu_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`pu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of p_user
-- ----------------------------
INSERT INTO p_user VALUES ('1', '1', 'xufei', 'c4ca4238a0b923820dcc509a6f75849b', '徐飞', '/uploads/userico/徐飞_1.jpg', '男', '13688387776', '', '成都市青羊区八宝街', '2013-04-06 22:07:30', '0', '徐飞');
INSERT INTO p_user VALUES ('2', '3', 'yangjun', 'fae0b27c451c728867a567e8c1bb4e53', '杨俊', '', '男', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('3', '3', 'zhangkai', 'fae0b27c451c728867a567e8c1bb4e53', '张凯', '/uploads/userico/张凯_3.jpg', '男', '', '', '', '2013-04-06 22:02:43', '0', '');
INSERT INTO p_user VALUES ('4', '38', 'xiaodan', 'fae0b27c451c728867a567e8c1bb4e53', '肖丹', '/uploads/userico/肖丹_4.jpg', '女', '', '', '', '2013-04-06 17:31:29', '0', '');
INSERT INTO p_user VALUES ('5', '62', 'gaoyan', 'fae0b27c451c728867a567e8c1bb4e53', '高燕', '', '女', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('6', '38', 'jiujun', 'fae0b27c451c728867a567e8c1bb4e53', '刘峻', '', '男', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('7', '1', 'wangzheng', 'fae0b27c451c728867a567e8c1bb4e53', '王正', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('8', '1', 'wangyuting', 'fae0b27c451c728867a567e8c1bb4e53', '王钰婷', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('9', '38', 'wangxiujuan', 'fae0b27c451c728867a567e8c1bb4e53', '王秀娟', '/uploads/userico/王秀娟_9.jpg', '女', '', '', '', '2013-04-06 22:04:40', '0', '');
INSERT INTO p_user VALUES ('10', '1', 'dongting', 'fae0b27c451c728867a567e8c1bb4e53', '董婷', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('11', '1', 'chencong', 'fae0b27c451c728867a567e8c1bb4e53', '陈聪', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('12', '58', 'gaosiwei', 'fae0b27c451c728867a567e8c1bb4e53', '高思伟', '/uploads/userico/高思伟_12.jpg', '', '', '', '', '2013-04-06 22:05:04', '0', '');
INSERT INTO p_user VALUES ('13', '1', 'zhuyunsheng', 'fae0b27c451c728867a567e8c1bb4e53', '朱芸生', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('14', '1', 'yantao', 'fae0b27c451c728867a567e8c1bb4e53', '闫涛', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('15', '1', 'zhouwei', 'fae0b27c451c728867a567e8c1bb4e53', '周维', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('16', '1', 'dengshuai', 'fae0b27c451c728867a567e8c1bb4e53', '邓帅', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('17', '1', 'lidan', 'fae0b27c451c728867a567e8c1bb4e53', '李丹', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('18', '58', '666', 'fae0b27c451c728867a567e8c1bb4e53', '测试数据', '', '', '12312321321', '321321321', 'fdsfdsfds发的身份的', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('19', '58', '666', 'fae0b27c451c728867a567e8c1bb4e53', '测试数据', '', '', '12312321321', '321321321', 'fdsfdsfds发的身份的', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('20', '64', 'zhangxiang', 'fae0b27c451c728867a567e8c1bb4e53', '张祥', '', '', '13688387777', '13688387777', '北京12318文化市场举报热线药品服务许可证(京)-经营-2010-0048', '2013-03-16 00:30:01', '0', '');
INSERT INTO p_user VALUES ('22', '64', 'leijiaxin', 'fae0b27c451c728867a567e8c1bb4e53', '雷佳欣', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('23', '64', 'zhouyunpeng', 'fae0b27c451c728867a567e8c1bb4e53', '周澐芃', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('24', '38', 'lina', 'fae0b27c451c728867a567e8c1bb4e53', '李娜', '/uploads/userico/李娜_24.jpg', '', '', '', '', '2013-04-06 21:26:08', '0', '');
INSERT INTO p_user VALUES ('25', '3', 'fengxin', 'fae0b27c451c728867a567e8c1bb4e53', '冯欣', '/uploads/userico/冯欣_25.jpg', '', '', '', '', '2013-04-02 11:41:52', '0', '');
INSERT INTO p_user VALUES ('26', '3', 'wangbo', 'fae0b27c451c728867a567e8c1bb4e53', '王博', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');
INSERT INTO p_user VALUES ('27', '59', 'qiulin', 'fae0b27c451c728867a567e8c1bb4e53', '邱琳', '/uploads/userico/邱琳_27.png', '', '', '', '', '2013-04-02 09:47:46', '0', '');
INSERT INTO p_user VALUES ('28', '1', 'liyuxiao', 'fae0b27c451c728867a567e8c1bb4e53', '李雨萧', '', '', '', '', '', '2013-04-06 22:02:15', '0', '');
INSERT INTO p_user VALUES ('29', '1', 'tangyong', 'fae0b27c451c728867a567e8c1bb4e53', '唐勇', '', '', '', '', '', '0000-00-00 00:00:00', '0', '');

-- ----------------------------
-- Table structure for `p_user2group`
-- ----------------------------
DROP TABLE IF EXISTS `p_user2group`;
CREATE TABLE `p_user2group` (
  `u2g_id` int(10) NOT NULL auto_increment COMMENT '用户映射组id',
  `u2g_puid` int(10) NOT NULL COMMENT '用户id',
  `u2g_pgid` int(10) NOT NULL COMMENT '组id',
  PRIMARY KEY  (`u2g_id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COMMENT='用户映射工作组表';

-- ----------------------------
-- Records of p_user2group
-- ----------------------------
INSERT INTO p_user2group VALUES ('107', '20', '2');
INSERT INTO p_user2group VALUES ('108', '22', '2');
INSERT INTO p_user2group VALUES ('109', '23', '2');
INSERT INTO p_user2group VALUES ('110', '1', '3');
INSERT INTO p_user2group VALUES ('111', '4', '3');
INSERT INTO p_user2group VALUES ('115', '2', '5');
INSERT INTO p_user2group VALUES ('116', '3', '5');
INSERT INTO p_user2group VALUES ('117', '25', '5');
INSERT INTO p_user2group VALUES ('118', '4', '5');
INSERT INTO p_user2group VALUES ('119', '6', '5');
INSERT INTO p_user2group VALUES ('120', '9', '5');
INSERT INTO p_user2group VALUES ('121', '24', '5');
INSERT INTO p_user2group VALUES ('122', '1', '5');

-- ----------------------------
-- Table structure for `p_user2role`
-- ----------------------------
DROP TABLE IF EXISTS `p_user2role`;
CREATE TABLE `p_user2role` (
  `u2r_id` int(10) NOT NULL auto_increment COMMENT '用户映射角色id',
  `u2r_puid` int(10) NOT NULL COMMENT '用户id',
  `u2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY  (`u2r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='用户映射角色表';

-- ----------------------------
-- Records of p_user2role
-- ----------------------------
INSERT INTO p_user2role VALUES ('7', '12', '2');
INSERT INTO p_user2role VALUES ('9', '1', '5');
INSERT INTO p_user2role VALUES ('13', '2', '4');
INSERT INTO p_user2role VALUES ('14', '3', '4');
INSERT INTO p_user2role VALUES ('15', '25', '4');
INSERT INTO p_user2role VALUES ('16', '4', '4');
INSERT INTO p_user2role VALUES ('17', '6', '4');
INSERT INTO p_user2role VALUES ('18', '9', '4');
INSERT INTO p_user2role VALUES ('19', '24', '4');
INSERT INTO p_user2role VALUES ('20', '3', '3');
INSERT INTO p_user2role VALUES ('21', '4', '3');
INSERT INTO p_user2role VALUES ('22', '1', '8');
INSERT INTO p_user2role VALUES ('24', '20', '8');
INSERT INTO p_user2role VALUES ('26', '9', '13');
INSERT INTO p_user2role VALUES ('27', '25', '14');
INSERT INTO p_user2role VALUES ('28', '3', '12');
INSERT INTO p_user2role VALUES ('29', '4', '11');
INSERT INTO p_user2role VALUES ('30', '6', '13');
INSERT INTO p_user2role VALUES ('31', '24', '13');
INSERT INTO p_user2role VALUES ('32', '2', '14');
INSERT INTO p_user2role VALUES ('33', '1', '10');
INSERT INTO p_user2role VALUES ('34', '12', '16');
INSERT INTO p_user2role VALUES ('35', '1', '4');
INSERT INTO p_user2role VALUES ('36', '12', '4');
INSERT INTO p_user2role VALUES ('37', '20', '4');
INSERT INTO p_user2role VALUES ('38', '22', '4');
INSERT INTO p_user2role VALUES ('39', '23', '4');
INSERT INTO p_user2role VALUES ('40', '5', '4');
INSERT INTO p_user2role VALUES ('41', '7', '4');
INSERT INTO p_user2role VALUES ('42', '8', '4');
INSERT INTO p_user2role VALUES ('43', '10', '4');
INSERT INTO p_user2role VALUES ('44', '11', '4');
INSERT INTO p_user2role VALUES ('45', '13', '4');
INSERT INTO p_user2role VALUES ('46', '14', '4');
INSERT INTO p_user2role VALUES ('47', '15', '4');
INSERT INTO p_user2role VALUES ('48', '16', '4');
INSERT INTO p_user2role VALUES ('49', '17', '4');
INSERT INTO p_user2role VALUES ('50', '26', '14');
INSERT INTO p_user2role VALUES ('51', '27', '19');
INSERT INTO p_user2role VALUES ('52', '28', '20');
INSERT INTO p_user2role VALUES ('53', '29', '21');
