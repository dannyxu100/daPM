/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : da_bizform

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2013-04-06 22:11:57
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `b_bizcase`
-- ----------------------------
DROP TABLE IF EXISTS `b_bizcase`;
CREATE TABLE `b_bizcase` (
  `bc_id` int(10) NOT NULL auto_increment COMMENT '业务表单实例id',
  `bc_btid` int(10) NOT NULL COMMENT '表单模板id',
  `bc_tcid` int(10) NOT NULL COMMENT '工作流事务变迁实例id(过程表单)',
  `bc_wfcid` int(10) NOT NULL COMMENT '工作流实例id(主表单)',
  `bc_dbsourceid` varchar(50) NOT NULL COMMENT '数据源联系字段值（一般为主键值）',
  `bc_lastlog` text NOT NULL COMMENT '业务单最新日志内容',
  PRIMARY KEY  (`bc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='业务表单实例表';

-- ----------------------------
-- Records of b_bizcase
-- ----------------------------
INSERT INTO b_bizcase VALUES ('9', '1', '0', '10', '1', '');
INSERT INTO b_bizcase VALUES ('10', '1', '0', '11', '2', '');
INSERT INTO b_bizcase VALUES ('11', '1', '0', '12', '3', '');
INSERT INTO b_bizcase VALUES ('13', '2', '0', '14', '9', '');
INSERT INTO b_bizcase VALUES ('14', '2', '0', '15', '10', '');
INSERT INTO b_bizcase VALUES ('15', '2', '0', '16', '11', '');
INSERT INTO b_bizcase VALUES ('16', '2', '0', '17', '12', '');
INSERT INTO b_bizcase VALUES ('17', '2', '0', '18', '13', '');
INSERT INTO b_bizcase VALUES ('18', '2', '0', '19', '14', '希望客户转为\"商派\"更加合理。');
INSERT INTO b_bizcase VALUES ('19', '2', '0', '20', '15', '<p>\n	客户好像对图片显示方式有点异议。\n</p>\n<p>\n	<br />\n</p>\n<p>\n	<img src=\"http://localhost:8800/plugin/kindeditor/plugins/emoticons/images/9.gif\" border=\"0\" alt=\"\" />\n</p>');
INSERT INTO b_bizcase VALUES ('20', '2', '0', '21', '16', '');
INSERT INTO b_bizcase VALUES ('21', '2', '0', '22', '17', '');
INSERT INTO b_bizcase VALUES ('22', '2', '0', '23', '18', '');
INSERT INTO b_bizcase VALUES ('23', '2', '0', '24', '19', '');
INSERT INTO b_bizcase VALUES ('24', '2', '0', '25', '20', '');
INSERT INTO b_bizcase VALUES ('25', '2', '0', '26', '21', '');
INSERT INTO b_bizcase VALUES ('26', '2', '0', '27', '22', '');
INSERT INTO b_bizcase VALUES ('27', '2', '0', '28', '23', '');
INSERT INTO b_bizcase VALUES ('28', '2', '0', '29', '24', '');
INSERT INTO b_bizcase VALUES ('29', '2', '0', '30', '25', '');
INSERT INTO b_bizcase VALUES ('30', '2', '0', '31', '26', '');
INSERT INTO b_bizcase VALUES ('31', '2', '0', '32', '27', '');
INSERT INTO b_bizcase VALUES ('32', '2', '0', '33', '28', '');
INSERT INTO b_bizcase VALUES ('33', '2', '0', '34', '29', '');
INSERT INTO b_bizcase VALUES ('34', '2', '0', '35', '30', '');
INSERT INTO b_bizcase VALUES ('35', '2', '0', '36', '31', '');
INSERT INTO b_bizcase VALUES ('36', '2', '0', '37', '32', '');
INSERT INTO b_bizcase VALUES ('37', '2', '0', '38', '33', '');
INSERT INTO b_bizcase VALUES ('38', '2', '0', '39', '34', '');
INSERT INTO b_bizcase VALUES ('39', '2', '0', '40', '35', '');
INSERT INTO b_bizcase VALUES ('40', '2', '0', '41', '36', '');
INSERT INTO b_bizcase VALUES ('41', '2', '0', '42', '37', '');
INSERT INTO b_bizcase VALUES ('42', '2', '0', '43', '38', '');
INSERT INTO b_bizcase VALUES ('43', '2', '0', '44', '39', '');
INSERT INTO b_bizcase VALUES ('44', '2', '0', '45', '40', '');

-- ----------------------------
-- Table structure for `b_bizlog`
-- ----------------------------
DROP TABLE IF EXISTS `b_bizlog`;
CREATE TABLE `b_bizlog` (
  `l_id` int(10) NOT NULL auto_increment COMMENT '业务单日志id',
  `l_bcid` int(10) NOT NULL COMMENT '业务单实例id',
  `l_content` text NOT NULL COMMENT '业务单日志内容',
  `l_date` datetime NOT NULL COMMENT '业务单日志日期',
  `l_puid` int(10) NOT NULL COMMENT '写日志用户id',
  `l_puname` varchar(50) NOT NULL COMMENT '写日志用户名',
  `l_tagname` varchar(50) NOT NULL COMMENT '业务单日志标签名称',
  PRIMARY KEY  (`l_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='业务单处理日志';

-- ----------------------------
-- Records of b_bizlog
-- ----------------------------
INSERT INTO b_bizlog VALUES ('5', '18', '<p>\n	这个单子很麻烦，客户需求有偏差，部分功能希望以商城的方式体现，现有建站后台实现不了。\n</p>\n<p>\n	<br />\n</p>\n<p>\n	定制开发的功能完全没有时间和人力完成。\n</p>\n<p>\n	<br />\n</p>\n<p>\n	<img src=\"http://localhost:8800/plugin/kindeditor/plugins/emoticons/images/26.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost:8800/plugin/kindeditor/plugins/emoticons/images/27.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost:8800/plugin/kindeditor/plugins/emoticons/images/27.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost:8800/plugin/kindeditor/plugins/emoticons/images/27.gif\" border=\"0\" alt=\"\" />\n</p>', '2013-03-28 01:35:28', '1', '徐飞', '1');
INSERT INTO b_bizlog VALUES ('6', '18', '希望客户转为\"商派\"更加合理。', '2013-03-28 01:36:33', '1', '徐飞', '1');
INSERT INTO b_bizlog VALUES ('7', '19', '<p>\n	客户好像对图片显示方式有点异议。\n</p>\n<p>\n	<br />\n</p>\n<p>\n	<img src=\"http://localhost:8800/plugin/kindeditor/plugins/emoticons/images/9.gif\" border=\"0\" alt=\"\" />\n</p>', '2013-03-30 10:57:15', '3', '张凯', '1');

-- ----------------------------
-- Table structure for `b_bizreply`
-- ----------------------------
DROP TABLE IF EXISTS `b_bizreply`;
CREATE TABLE `b_bizreply` (
  `r_id` int(10) NOT NULL auto_increment COMMENT '日志回复id',
  `r_lid` int(10) NOT NULL COMMENT '日志id',
  `r_bcid` int(10) NOT NULL COMMENT '业务单实例id',
  `r_content` text NOT NULL COMMENT '回复内容',
  `r_date` datetime NOT NULL COMMENT '回复日期',
  `r_puid` int(10) NOT NULL COMMENT '回复人id',
  `r_puname` varchar(50) NOT NULL COMMENT '回复人姓名',
  PRIMARY KEY  (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='表单实例日志回复表';

-- ----------------------------
-- Records of b_bizreply
-- ----------------------------

-- ----------------------------
-- Table structure for `b_biztemplet`
-- ----------------------------
DROP TABLE IF EXISTS `b_biztemplet`;
CREATE TABLE `b_biztemplet` (
  `bt_id` int(10) NOT NULL auto_increment COMMENT '业务单据id',
  `bt_name` varchar(50) NOT NULL COMMENT '业务单名称',
  `bt_bttid` int(10) NOT NULL COMMENT '业务单分类id',
  `bt_sort` int(10) NOT NULL COMMENT '排序',
  `bt_dbsource` varchar(100) NOT NULL COMMENT '数据源（da_userform库中的数据表）',
  `bt_dbfld` varchar(100) NOT NULL COMMENT '与数据源的关联字段',
  `bt_listsearch` text NOT NULL COMMENT '搜索条代码',
  `bt_listhtml` text NOT NULL COMMENT '业务单list页面html代码',
  `bt_listscript` text NOT NULL COMMENT '业务表单列表页自定义脚本',
  `bt_formhtml` text NOT NULL COMMENT '业务单form页面html代码',
  `bt_formscript` text NOT NULL COMMENT '业务表单详细页自定义脚本',
  `bt_form2html` text NOT NULL COMMENT '业务表单模板查看页html代码',
  `bt_form2script` text NOT NULL COMMENT '业务表单模板查看页script代码',
  `bt_remark` text NOT NULL COMMENT '备注',
  `bt_user` varchar(50) NOT NULL COMMENT '业务单创建者',
  `bt_date` datetime NOT NULL COMMENT '业务单创建日期',
  `bt_edituser` varchar(50) NOT NULL COMMENT '最近一次变更者',
  `bt_editdate` datetime NOT NULL COMMENT '最近一次变更日期',
  PRIMARY KEY  (`bt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='业务表单模板表';

-- ----------------------------
-- Records of b_biztemplet
-- ----------------------------
INSERT INTO b_biztemplet VALUES ('1', '请假单', '2', '99', 'hsd_leave', 'l_id', '<br />', '<table id=\"tb_list\" style=\"width:100%;\">\n	<tbody name=\"head\">\n		<tr>\n			<td style=\"width:50px;\">\n				序\n			</td>\n			<td>\n				请假人\n			</td>\n			<td style=\"width:100px;\">\n				请假日期\n			</td>\n			<td>\n				请假事由\n			</td>\n			<td style=\"width:80px;\">\n				部门经理\n			</td>\n			<td style=\"width:80px;\">\n				部门总监\n			</td>\n			<td style=\"width:100px;\">\n				审核日期\n			</td>\n			<td style=\"width:100px;\">\n				&nbsp;\n			</td>\n		</tr>\n	</tbody>\n	<tbody name=\"body\">\n		<tr>\n			<td name=\"order\">\n				{order}\n			</td>\n			<td name=\"l_puname\">\n				{l_puname}\n			</td>\n			<td name=\"l_date\" fmt=\"yyyy-mm-dd\">\n				{l_date}\n			</td>\n			<td name=\"l_content\">\n				{l_content}\n			</td>\n			<td>\n				{l_manager}\n			</td>\n			<td>\n				{l_general}\n			</td>\n			<td name=\"l_date2\" fmt=\"yyyy-mm-dd\">\n				{l_date2}\n			</td>\n			<td>\n				{tools}\n			</td>\n		</tr>\n		<tr name=\"tranpad\" style=\"display:none;background-color:#444;\">\n			<td style=\"border-right:0px;\">\n				&nbsp;\n			</td>\n			<td colspan=\"8\" name=\"workflowinfo\" style=\"padding:0px;padding-bottom:10px;\">\n				&nbsp;\n			</td>\n		</tr>\n	</tbody>\n	<tbody>\n		<tr>\n			<td colspan=\"9\">\n				共<span id=\"tb_list_recordcount2\" style=\"color:#c26220;\">0</span>&nbsp;条， \n				共<span id=\"tb_list_pagecount2\" style=\"color:#c26220;\">0</span>&nbsp;页， \n				当前在第<span id=\"tb_list_pageindex2\" style=\"color:#c26220;\">0</span>&nbsp;页　&nbsp; <span id=\"tb_list_pageinfo\" style=\"color:#c26220;\">&nbsp;</span> \n			</td>\n		</tr>\n	</tbody>\n</table>', '\n/**搜索筛选\n*/\nfunction searchkey(){\n	g_searchfld = da(\"#fld_search\").val();\n	g_searchkey = da(\"#key_search\").val();\n	g_searchtran = da(\"#tran_search\").val();\n	\n	loaddata();\n}\n\n/**清空筛选\n*/\nfunction clearkey(){\n	g_searchfld = \"\";\n	g_searchkey = \"\";\n	\n	da(\"#key_search\").val(\"\");\n	loaddata();\n}', '<p style=\"text-align:center;\">\n	<span style=\"font-size:24px;line-height:1.5;font-family:KaiTi_GB2312;\">请假单</span> \n</p>\n<table style=\"width:100%;\" cellpadding=\"5\" cellspacing=\"0\" border=\"1\" bordercolor=\"#CCCCCC\">\n	<tbody>\n		<tr>\n			<td style=\"width:80px;text-align:right;\">\n				请假人：\n			</td>\n			<td>\n				<input id=\"l_puname\" valid=\"account,false\" source=\"user\" /> \n			</td>\n			<td style=\"width:80px;text-align:right;\">\n				日期：\n			</td>\n			<td>\n				<input id=\"l_date\" source=\"date\" /> \n			</td>\n			<td style=\"width:80px;text-align:right;\">\n				编号：\n			</td>\n			<td>\n				<input id=\"l_id\" disabled=\"disabled\" /> \n			</td>\n		</tr>\n		<tr>\n			<td style=\"text-align:right;\">\n				假期始于：\n			</td>\n			<td>\n				<input id=\"l_fromdate\" source=\"date\" /> \n			</td>\n			<td style=\"text-align:right;\">\n				止于：\n			</td>\n			<td>\n				<input id=\"l_todate\" source=\"date\" /> \n			</td>\n			<td>\n				<br />\n			</td>\n			<td>\n				<br />\n			</td>\n		</tr>\n		<tr>\n			<td style=\"text-align:right;vertical-align:top;\">\n				事 &nbsp; 由：\n			</td>\n			<td colspan=\"5\">\n				<textarea id=\"l_content\" style=\"width:100%;height:100px;\"></textarea> \n			</td>\n		</tr>\n		<tr>\n			<td style=\"text-align:right;\">\n				部门经理：\n			</td>\n			<td>\n				<input id=\"l_manager\" disabled=\"disabled\" /> \n			</td>\n			<td style=\"text-align:right;\">\n				部门总监：\n			</td>\n			<td>\n				<input id=\"l_general\" disabled=\"disabled\" /> \n			</td>\n			<td style=\"text-align:right;\">\n				审批日期：\n			</td>\n			<td>\n				<input id=\"l_date2\" disabled=\"disabled\" /> \n			</td>\n		</tr>\n	</tbody>\n</table>', '', 'fdsfdsfds<br />\nfdsfdsfds', '', '', '徐飞', '2013-02-16 19:43:01', '', '2013-04-03 19:06:09');
INSERT INTO b_biztemplet VALUES ('2', '企业网建业务单', '2', '1', 'td_website', 'ws_id', '<select id=\"tran_search\" style=\"float:left;\"> <option value=\"\">全部</option>\n   <option value=\"5\">填写企业建站单</option>\n   <option value=\"14\">网页设计</option>\n   <option value=\"15\">编写程序</option>\n   <option value=\"9\">技术总监审核</option>\n</select> <select id=\"fld_search\" style=\"float:left;\"> <option value=\"ws_cstname\">客户名称</option>\n   <option value=\"tc_puname\">执行人</option>\n   <option value=\"ws_code\">合同号</option>\n   <option value=\"ws_solename\">销售人员</option>\n   <option value=\"ws_connphone\">手机号码</option>\n</select> <input id=\"key_search\" style=\"float:left;height:20px;\" /> <a class=\"item\" style=\"float:left;\" href=\"javascript:void(0)\" onclick=\"clearkey()\">清空</a> <a class=\"item\" style=\"float:left;\" href=\"javascript:void(0)\" onclick=\"searchkey()\"><img src=\"/images/sys_icon/search.png\" />搜索</a>', '<table id=\"tb_list\" style=\"width:100%;\">\n	<tbody name=\"head\">\n		<tr>\n			<td style=\"width:50px;\">\n				序\n			</td>\n			<td>\n				客户名称\n			</td>\n			<td style=\"width:120px;\">\n				合同号\n			</td>\n			<td style=\"width:80px;\">\n				销售人员\n			</td>\n			<td style=\"width:80px;\">\n				联系人\n			</td>\n			<td style=\"width:80px;\">\n				联系电话\n			</td>\n			<td style=\"width:100px;\">\n				提交日期\n			</td>\n			<td style=\"width:100px;\">\n				&nbsp;\n			</td>\n		</tr>\n	</tbody>\n	<tbody name=\"body\">\n		<tr>\n			<td name=\"order\">\n				{order}\n			</td>\n			<td>\n				{ws_cstname}\n			</td>\n			<td>\n				{ws_code}\n			</td>\n			<td>\n				{ws_solename}\n			</td>\n			<td>\n				{ws_connname}\n			</td>\n			<td>\n				{ws_connphone}\n			</td>\n			<td name=\"ws_date\" fmt=\"yyyy-mm-dd/p\">\n				{ws_date}\n			</td>\n			<td>\n				{tools}\n			</td>\n		</tr>\n		<tr name=\"tranpad\" style=\"display:none;background-color:#444;\">\n			<td style=\"border-right:0px;\">\n				&nbsp;\n			</td>\n			<td colspan=\"7\" name=\"workflowinfo\" style=\"padding:0px;padding-bottom:10px;\">\n				&nbsp;\n			</td>\n		</tr>\n	</tbody>\n	<tbody>\n		<tr>\n			<td colspan=\"8\">\n				共<span id=\"tb_list_recordcount2\" style=\"color:#c26220;\">0</span>&nbsp;条， \n                            共<span id=\"tb_list_pagecount2\" style=\"color:#c26220;\">0</span>&nbsp;页， \n                            当前在第<span id=\"tb_list_pageindex2\" style=\"color:#c26220;\">0</span>&nbsp;页　&nbsp; <span id=\"tb_list_pageinfo\" style=\"color:#c26220;\">&nbsp;</span> \n			</td>\n		</tr>\n	</tbody>\n</table>', '/**添加用户参数\n*/\nfunction setuserparam( param ){\n	param [\"searchfld\"] =  da(\"#fld_search\").val();\n	param [\"searchkey\"] =  da(\"#key_search\").val();\n	param [\"searchtran\"] = da(\"#tran_search\").val();\n        g_key = param [\"searchkey\"];     //设置搜索关键字高亮\n}\n\n/**搜索筛选\n*/\nfunction searchkey(){\n	loaddata();\n}\n\n/**清空筛选\n*/\nfunction clearkey(){\n	da(\"#key_search\").val(\"\");\n	loaddata();\n}', '<div style=\"text-align:center;\">\n	<span style=\"font-family:KaiTi_GB2312;line-height:1.5;font-size:24px;\">企业建站单</span> \n</div>\n<p>\n	<span style=\"font-family:KaiTi_GB2312;\"> \n	<table style=\"width:100%;\" cellpadding=\"2\" cellspacing=\"0\" border=\"1\" bordercolor=\"#CCCCCC\">\n		<tbody>\n			<tr>\n				<td style=\"text-align:right;width:80px;\">\n					客户名称：\n				</td>\n				<td>\n					<input id=\"ws_cstname\" style=\"width:200px;\" valid=\"account,false\" validinfo=\"不能为空\" /> \n				</td>\n				<td style=\"text-align:right;width:80px;\">\n					销售人员：\n				</td>\n				<td>\n					<input id=\"ws_solename\" valid=\"account,false\" validinfo=\"不能为空\" source=\"user\" /> \n				</td>\n				<td style=\"text-align:right;width:80px;\">\n					合同号：\n				</td>\n				<td>\n					<input id=\"ws_code\" valid=\"abcnumber,false\" validinfo=\"不能为空\" /> \n				</td>\n			</tr>\n			<tr>\n				<td style=\"text-align:right;\">\n					联系人：\n				</td>\n				<td>\n					<input id=\"ws_connname\" /> \n				</td>\n				<td style=\"text-align:right;\">\n					联系电话：\n				</td>\n				<td>\n					<input id=\"ws_connphone\" valid=\"phone,false\" /> \n				</td>\n				<td style=\"text-align:right;\">\n					提单日期：\n				</td>\n				<td>\n					<input id=\"ws_date\" valid=\"anything,false\" source=\"date\" /> \n				</td>\n			</tr>\n			<tr>\n				<td style=\"text-align:right;\">\n					地 &nbsp; 址：\n				</td>\n				<td colspan=\"5\">\n					<input id=\"ws_connaddr\" style=\"width:300px;\" /> \n				</td>\n			</tr>\n			<tr>\n				<td style=\"text-align:right;vertical-align:top;\">\n					备 &nbsp; 注：\n				</td>\n				<td colspan=\"5\">\n					<textarea id=\"ws_remark\" name=\"ws_remark\" style=\"width:100%;height:600px;\" source=\"editorbox\"></textarea> \n				</td>\n			</tr>\n		</tbody>\n	</table>\n<br />\n<br />\n</span> \n</p>\n<p>\n	<br />\n</p>', '', '<div style=\"white-space:normal;text-align:center;\">\n	<span style=\"font-family:KaiTi_GB2312;line-height:1.5;font-size:24px;\">企业建站单</span> \n</div>\n<p style=\"white-space:normal;\">\n	<span style=\"font-family:KaiTi_GB2312;\"> \n	<table class=\"tablesolid\" cellpadding=\"2\" cellspacing=\"0\" border=\"1\" bordercolor=\"#CCCCCC\" style=\"width:837px;\">\n		<tbody>\n			<tr>\n				<td class=\"header\" style=\"width:80px;\">\n					客户名称：\n				</td>\n				<td>\n					{ws_cstname}\n				</td>\n				<td class=\"header\" style=\"width:80px;\">\n					销售人员：\n				</td>\n				<td>\n					{ws_solename}\n				</td>\n				<td class=\"header\" style=\"width:80px;\">\n					合同号：\n				</td>\n				<td>\n					{ws_code}\n				</td>\n			</tr>\n			<tr>\n				<td class=\"header\" style=\"width:80px;\">\n					联系人：\n				</td>\n				<td>\n					{ws_connname}\n				</td>\n				<td class=\"header\" style=\"width:80px;\">\n					联系电话：\n				</td>\n				<td>\n					{ws_connphone}\n				</td>\n				<td class=\"header\" style=\"width:80px;\">\n					提单日期：\n				</td>\n				<td fmt=\"yyyy-mm-dd/p\">\n					{ws_date}\n				</td>\n			</tr>\n			<tr>\n				<td class=\"header\" style=\"width:80px;\">\n					地 &nbsp; 址：\n				</td>\n				<td colspan=\"5\">\n					{ws_connaddr}\n				</td>\n			</tr>\n			<tr>\n				<td class=\"header\" style=\"width:80px;\">\n					备 &nbsp; 注：\n				</td>\n				<td colspan=\"5\">\n					{ws_remark}\n				</td>\n			</tr>\n		</tbody>\n	</table>\n<br />\n<br />\n</span> \n</p>', '', '3232', '徐飞', '2013-02-16 19:48:36', '', '2013-04-03 19:06:16');
INSERT INTO b_biztemplet VALUES ('3', 'SEO业务单', '2', '3', '', '', '', '', '', '<p>\n	fdsfdsfdsafdsfdsf\n</p>\n<p>\n	ds\n</p>\n<p>\n	f\n</p>\n<p>\n	ds\n</p>\n<p>\n	af\n</p>\n<p>\n	d\n</p>\n<p>\n	safdddddddddddddddddddd\n</p>', '', '', '', '', '徐飞', '2013-02-16 19:50:12', '徐飞', '2013-02-16 20:09:42');

-- ----------------------------
-- Table structure for `b_biztemplettype`
-- ----------------------------
DROP TABLE IF EXISTS `b_biztemplettype`;
CREATE TABLE `b_biztemplettype` (
  `btt_id` int(10) NOT NULL auto_increment COMMENT '业务单分类id',
  `btt_pid` int(10) NOT NULL COMMENT '业务单分类父id',
  `btt_name` varchar(50) NOT NULL COMMENT '业务单分类名称',
  `btt_sort` int(10) NOT NULL COMMENT '排序',
  `btt_date` datetime NOT NULL COMMENT '创建日期',
  `btt_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`btt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='业务表单模板分类表';

-- ----------------------------
-- Records of b_biztemplettype
-- ----------------------------
INSERT INTO b_biztemplettype VALUES ('1', '-1', '成都网联天下（业务单分类）', '0', '2013-02-16 18:44:22', '');
INSERT INTO b_biztemplettype VALUES ('2', '1', '技术部', '1', '2013-02-16 00:00:00', '');
