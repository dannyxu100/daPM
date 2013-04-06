/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : da_userform

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2013-04-06 22:12:36
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `hsd_leave`
-- ----------------------------
DROP TABLE IF EXISTS `hsd_leave`;
CREATE TABLE `hsd_leave` (
  `l_id` int(10) NOT NULL auto_increment COMMENT '请假单id',
  `l_puname` varchar(50) NOT NULL COMMENT '请假人',
  `l_puid` int(10) NOT NULL COMMENT '请假人id',
  `l_date` datetime NOT NULL COMMENT '请假日期',
  `l_fromdate` datetime NOT NULL COMMENT '假期开始时间',
  `l_todate` datetime NOT NULL COMMENT '假期结束时间',
  `l_content` text NOT NULL COMMENT '请假事由',
  `l_manager` varchar(50) NOT NULL COMMENT '部门经理',
  `l_general` varchar(50) NOT NULL COMMENT '部门总监',
  `l_date2` datetime NOT NULL COMMENT '审核日期',
  PRIMARY KEY  (`l_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='人力资源部请假单表';

-- ----------------------------
-- Records of hsd_leave
-- ----------------------------
INSERT INTO hsd_leave VALUES ('1', '徐飞', '0', '2013-03-27 00:00:00', '2013-03-27 09:00:00', '2013-03-27 18:00:00', '', '', '', '0000-00-00 00:00:00');
INSERT INTO hsd_leave VALUES ('2', '王秀娟', '0', '2013-03-27 00:00:00', '2013-03-27 09:00:00', '2013-03-27 18:00:00', '', '', '', '0000-00-00 00:00:00');
INSERT INTO hsd_leave VALUES ('3', '王秀娟', '0', '2013-03-27 00:00:00', '2013-03-27 09:00:00', '2013-03-27 18:00:00', '发的身份的撒旦是', '', '', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `tb_bill`
-- ----------------------------
DROP TABLE IF EXISTS `tb_bill`;
CREATE TABLE `tb_bill` (
  `b_id` int(10) NOT NULL COMMENT '订单流水号',
  `b_name` varchar(50) NOT NULL COMMENT '订单标题',
  `b_user` varchar(50) NOT NULL COMMENT '下定订单销售人员',
  `b_date` datetime NOT NULL COMMENT '下单日期'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单';

-- ----------------------------
-- Records of tb_bill
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_test`
-- ----------------------------
DROP TABLE IF EXISTS `tb_test`;
CREATE TABLE `tb_test` (
  `a_id` int(10) NOT NULL auto_increment COMMENT '流水号',
  `a_name` varchar(50) NOT NULL COMMENT '名称',
  `a_date` datetime default NULL COMMENT '日期',
  PRIMARY KEY  (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='测试表';

-- ----------------------------
-- Records of tb_test
-- ----------------------------

-- ----------------------------
-- Table structure for `td_website`
-- ----------------------------
DROP TABLE IF EXISTS `td_website`;
CREATE TABLE `td_website` (
  `ws_id` int(10) NOT NULL auto_increment COMMENT '企业建站订单id',
  `ws_code` varchar(20) NOT NULL COMMENT '合同编号',
  `ws_soleid` int(10) NOT NULL COMMENT '销售人员id',
  `ws_solename` varchar(50) NOT NULL COMMENT '销售人员名称',
  `ws_cstid` int(10) NOT NULL COMMENT '客户id',
  `ws_cstname` varchar(200) NOT NULL COMMENT '客户名称',
  `ws_connname` varchar(50) NOT NULL COMMENT '联系人名称',
  `ws_connphone` varchar(200) NOT NULL COMMENT '联系人手机',
  `ws_conntel` varchar(200) NOT NULL COMMENT '联系人座机',
  `ws_connaddr` varchar(500) NOT NULL COMMENT '联系地址',
  `ws_date` datetime NOT NULL COMMENT ' 提交日期',
  `ws_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY  (`ws_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='企业建站订单表';

-- ----------------------------
-- Records of td_website
-- ----------------------------
INSERT INTO td_website VALUES ('9', '20130114438', '0', '高燕', '0', '成都优贝思特学生托管教育机构', '赵老师', '13980568273', '', '二环路西一段59号双楠所有阳光一栋二单元3楼8号', '2013-01-14 00:00:00', '');
INSERT INTO td_website VALUES ('10', '20130110427', '0', '段海霞', '0', '成都顺元水泥制品厂', '何元良', '13348888157', '', '', '2013-01-10 00:00:00', '<img src=\"/plugin/kindeditor/attached/image/20130327/20130327155808_15449.jpg\" alt=\"\" /><br />\n<img src=\"/plugin/kindeditor/attached/image/20130327/20130327155821_97871.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('11', '20130115454', '0', '段海霞', '0', '成都尚品展览展示有限公司', '黄平高', '81685525', '', ' 成都永丰路20号黄金时代4-1-823', '2013-01-15 00:00:00', '<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327160229_57982.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327160229_34342.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('12', '20130123468', '0', '李莉娜', '0', '成都智巢科技有限公司', '胡岩', '13908013207', '', '永丰路26号', '2013-01-23 00:00:00', '网站页面参照科利暖通和尚佳暖通。客户自己有域名，转过来，第二年网站续费800.<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327160617_70251.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327160618_28693.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('13', '20130217568', '0', '陈杰', '0', '成都民华有害生物防治有害公司', '黄姐', '15196666636', '', '解放路一段204号603室', '2013-02-17 00:00:00', '网站建设，域名<a href=\"http://www.ymzms.com\" target=\"_blank\">www.ymzms.com</a>（域名是我们新注册），<br />\n空间200M <br />\n参考网站是：<a href=\"http://www.bjshachong.com.cn\" target=\"_blank\">www.bjshachong.com.cn</a>和 <a href=\"http://www.mhyhsw.com\" target=\"_blank\">www.mhyhsw.com</a> &nbsp;<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327160948_48031.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327160949_77445.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('14', '20130220587', '0', '刘力瑞', '0', '帝仪科技_杨微的客户', '黄总', '15928409245', '', '二环路南一段（现在的地址，之后要搬家）', '2013-02-20 00:00:00', '具体在合同里 然后还有些客户的资料我给肖丹<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327161304_50792.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327161304_88544.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327161305_81921.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('15', '20130220589', '0', '李丹', '0', '成都宝林苑户外休闲家具有限公司', '幸凌燕', '13699491600', '', '金府路555号7栋15楼1510', '2013-02-20 00:00:00', '<img src=\"/plugin/kindeditor/attached/image/20130327/20130327161612_74857.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('16', '20130221599', '0', '谢茂林', '0', '成都市永纪电器有限责任公司', '纪丹', '13880075179', '', '成都市花圃路25号红运大厦三楼', '2013-02-21 00:00:00', '参考网站 王正清楚 具体与王正沟通<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327161846_61841.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327161846_20437.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('17', '20130221605', '0', '高燕', '0', '成都智车星科技有限公司', '彭伟祺', '18615778819', '', '成都武侯区红牌楼66号', '2013-02-21 00:00:00', '增加个下载系统，导航栏的常见问题取消，<br />\n<br />\n改成资料下载，请技术在做的时候跟我说下，<br />\n<br />\n我发资料，修改完了之后再给钱 500');
INSERT INTO td_website VALUES ('18', '20130222639', '0', '蔡金辉', '0', '四川省住房和城乡建设厅分校', '雷老师', '13880384924', '', '牛王庙路口东恒国际一幢一单元2010房', '2013-02-22 00:00:00', 'ftp 地 址：203.142.26.157<br />\nftp用户名：webmaster@cdjypx.org<br />\n密码webmaster@cdjypx.org<br />\n站转到我们公司！！再加个浮动QQ<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327162205_73717.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327162205_49320.jpg\" alt=\"\" /><br />');
INSERT INTO td_website VALUES ('19', '20130227644', '0', '王正', '0', '光华缘', '都邻', '87353530', '', '青羊区光华村街55号西南财大光华楼11-12', '2013-02-27 00:00:00', '<img src=\"/plugin/kindeditor/attached/image/20130327/20130327162406_82919.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('20', '20130304675', '0', '唐铃善', '0', '四川金来缘科技有限公司', '陈凯辉', '13678190368', '', '成都市外北南丰工业区(洞子', '2013-03-04 00:00:00', '网站改版2800。<br />\n<br />\n<img src=\"/plugin/kindeditor/attached/image/20130327/20130327162643_67790.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('21', '20130305711', '0', '李瑶', '0', '成都信步楼梯', '李雪艳', '15228874078', '', '龙泉驿区博美装饰城', '2013-03-05 00:00:00', '网站域名注册<a href=\"http://www.cdxblt.com\" target=\"_blank\">www.cdxblt.com</a>；<br />\n<br />\n网站签的是两年，这个网站后期是要做优化的，请技术部的同事在制作上方便日后的优化； <br />\n<br />\n信步楼梯联系人李雪艳 15228874078 028-66255971；<br />\n<br />\n地址：成都市成龙大道博美银河装饰城A区3栋43号；<br />\n<br />\n<img src=\"/plugin/kindeditor/attached/image/20130327/20130327162839_30451.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('22', '20130305715', '0', '高燕', '0', '成都市康达橡塑门帘经营', '艾洪超', '13666252506', '', '成都市金牛区一环路北四段平福路149号', '2013-03-05 00:00:00', '<img src=\"/plugin/kindeditor/attached/image/20130327/20130327163034_59633.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('23', '20130305705', '0', '羊欢', '0', '成都环尖科技有限公司', '耿天舒', '13258330003', '', '西安北路2号芙蓉花园5006', '2013-03-05 00:00:00', '<span style=\"line-height:1.5;\"></span><span style=\"line-height:1.5;\">首付款3600，尾款在网站建设起来之后付尾款，</span><br />\n<br />\n域名用他自己的。<br />\n<br />\n参考网站成都世纪方舟。<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327163345_55362.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327163345_98796.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('24', '20130306773', '0', '郭媛媛', '0', '成都佳效文化传播有限公司', '刘洪', '13550129391', '', '成都市金牛区乡农寺街59号金港大厦A-304', '2013-03-06 00:00:00', '营销型网站：公司简介、新闻动态、主营产品、成功案例、解决方案、在线留言、联系我们、友情链接<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327163601_94152.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327163601_94188.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('25', '20130306737', '0', '何小华', '0', '成都君悦汽车代驾服务有限公司', '邓君', '13808225525', '', '成都五大花园', '2013-03-06 00:00:00', '赠送一级域名：<a href=\"http://www.028junyue.com\" target=\"_blank\">www.028junyue.com</a> &nbsp;/年 &nbsp;<br />\n<br />\n前期支付1000元整 &nbsp;<br />\n<br />\n网站建设好在支付200元整。<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327163812_91048.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327163812_25419.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('26', '20130304688', '0', '高燕', '0', '成都威鹏达光电科技有限公司', '杨威', '15982265212', '', '二环路北一段241号营门商厦6-24', '2013-03-04 00:00:00', '参考网站<a href=\"http://www.lotusqmj.net\" target=\"_blank\">http://www.lotusqmj.net/</a> &nbsp; &nbsp; &nbsp;<a href=\"http://www.szgtled.cn\" target=\"_blank\">http://www.szgtled.cn/<br />\n<br />\n</a>');
INSERT INTO td_website VALUES ('27', '20130305721', '0', '朱勋铫', '0', '成都科迪仪器仪表有限公司', '高先生', '13880280241', '', '金府路502号金府机电城A区17幢11-12号', '2013-03-05 00:00:00', '');
INSERT INTO td_website VALUES ('28', '20130311808', '0', '高思伟', '0', '成都市鑫神鹰电器有限责任公司', '邹元清、吴总', '13880970168', '', '四川省成都市龙泉驿区柏合镇梨花街270号', '2013-03-11 00:00:00', '<img src=\"/plugin/kindeditor/attached/image/20130327/20130327164158_11216.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('29', '20130222626', '0', '何小华', '0', '成都林锐机机械设备制造有限公司', '樊延兵', '18280110810', '', '成都', '2013-02-22 00:00:00', '送一个域名：<a href=\"http://www.cd-linrui.com\" target=\"_blank\">www.cd-linrui.com</a>； &nbsp; &nbsp;<br />\n<br />\n送个性化网站一个，参考网站：<a href=\"http://www.xrcssj.com\" target=\"_blank\">www.xrcssj.com</a> &nbsp; <br />\n<br />\n成都输送机 &nbsp; 四川输送机 &nbsp;四川皮带输送机 &nbsp;四川链板输送机 &nbsp;四川网带输送机 &nbsp;<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327164406_82312.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327164406_62165.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('30', '20130314839', '0', '郭媛媛', '0', '成都天任水处理设备有限责任公司', '杨维建先生', '18982126099', '', '川省 成都市', '2013-03-14 00:00:00', '魔方建站 NO:129 域名<a href=\"http://www.cdtrscl.com\" target=\"_blank\">www.cdtrscl.com<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327164618_47326.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327164618_99008.jpg\" alt=\"\" /></a>');
INSERT INTO td_website VALUES ('31', '20130318849', '0', '高燕', '0', '成都启源环保设备有限公司', '朱洪亮', '15881062482', '', '成都', '2013-03-18 00:00:00', '参考网站 &nbsp; <a href=\"http://028water.com\" target=\"_blank\">028water.com<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327165101_29635.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327165102_23570.jpg\" alt=\"\" /></a>');
INSERT INTO td_website VALUES ('32', '20130314826', '0', '王升立', '0', '成都市步升液压机械有限公司', '唐小娟', '15828142713', '', '成都市郫县安靖镇高桥村六村', '2013-03-14 00:00:00', '域名客户还没选定，后期添加。<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327165353_62124.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327165353_30179.jpg\" alt=\"\" /><br />');
INSERT INTO td_website VALUES ('33', '20130315843', '0', '蔡金辉', '0', '金龙池酵素浴科技有限公司', '潘东华', '13688082672', '', '成都', '2013-03-15 00:00:00', '<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327165517_76099.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327165517_68411.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('34', '20130304672', '0', '梁洁', '0', '成都金富祥建筑工程有限公司', '朱成明', '13980734660', '', '温江', '2013-03-04 00:00:00', '<table class=\"x-grid3-row-table ke-zeroborder\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"ext-gen2150\" style=\"margin:0px;padding:0px;color:#333333;font-family:宋体, arial;font-size:12px;width:895px;\">\n	<tbody id=\"ext-gen2149\">\n		<tr id=\"ext-gen2148\">\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-1 \" id=\"ext-gen2158\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-1\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					wzjs\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-2 \" id=\"ext-gen2157\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-2\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					网站建设\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-3 \" id=\"ext-gen2156\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-3\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					2800\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-4 \" id=\"ext-gen2155\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-4\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					1\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-5 \" id=\"ext-gen2152\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-5\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					年\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-6 \" id=\"ext-gen2147\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-6\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					0\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-ext-gen980  x-grid3-check-col-td\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-ext-gen980\" style=\"margin:0px;padding:1px 0px 0px !important;\">\n					<div class=\"x-grid3-check-col-on x-grid3-cc-ext-gen980\" style=\"margin:0px;padding:0px;\">\n					</div>\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-8 \" id=\"ext-gen2153\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-8\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					2014-03-04\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-9 x-grid3-cell-last \" id=\"ext-gen2154\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-9\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					周年庆价格\n				</div>\n			</td>\n		</tr>\n	</tbody>\n</table>\n<br />\n<img src=\"/plugin/kindeditor/attached/image/20130327/20130327165650_72797.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('35', '20130319861', '0', '李丹', '0', '跳三刀', '陈文建', '13438236056', '', '工农院街107附97号', '2013-03-19 00:00:00', '<table class=\"x-grid3-row-table ke-zeroborder\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"ext-gen2179\" style=\"margin:0px;padding:0px;color:#333333;font-family:宋体, arial;font-size:12px;width:895px;\">\n	<tbody id=\"ext-gen2178\">\n		<tr id=\"ext-gen2177\">\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-2 \" id=\"ext-gen2176\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-2\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					如E宝魔方建站\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-3 \" id=\"ext-gen2187\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-3\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					1800\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-4 \" id=\"ext-gen2185\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-4\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					0\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-5 \" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-5\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					&nbsp;\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-6 \" id=\"ext-gen2184\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-6\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					0\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-ext-gen980  x-grid3-check-col-td\" id=\"ext-gen2183\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-ext-gen980\" id=\"ext-gen2182\" style=\"margin:0px;padding:1px 0px 0px !important;\">\n					<div class=\"x-grid3-check-col-on x-grid3-cc-ext-gen980\" style=\"margin:0px;padding:0px;\">\n					</div>\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-8 \" id=\"ext-gen2181\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-8\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					2014-03-19\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-9 x-grid3-cell-last \" id=\"ext-gen2186\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-9\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					客户已有域名:\n				</div>\n			</td>\n		</tr>\n	</tbody>\n</table>\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327165836_26372.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327165836_72089.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('36', '20130319863', '0', '陈杰', '0', '成都龙皓建筑机械有限公司', '庞总', '13056688556', '', '成都市武侯区一环路南一段20号1幢5楼6号', '2013-03-19 00:00:00', '这个客户是周年庆签的网站2800。<br />\n<br />\n一直都没有去拿备案资料就都没提。<br />\n<br />\n他们是新做营销型网站。注册个新域名。<br />\n<br />\n<a href=\"http://www.sclhjx.com\" target=\"_blank\">www.sclhjx.com</a> &nbsp;域名他是要以个人名义注册。<br />\n<br />\n网站空间是以企业名义备案。参考网站是<a href=\"http://www.cdalxdc.com\" target=\"_blank\">www.cdalxdc.com</a> 空间200m。<br />\n<br />\n<img src=\"/plugin/kindeditor/attached/image/20130327/20130327170035_90463.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('37', '20130320875', '0', '高燕', '0', '成都市金牛区巧居活动板房厂', '周先生   唐小姐', '13568857272', '', '成都市金牛区天回镇', '2013-03-20 00:00:00', '参考网站 &nbsp; <a href=\"http://hyrpgg.com\" target=\"_blank\">hyrpgg.com</a> &nbsp;算是网站改版<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327170211_19445.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327170211_51121.jpg\" alt=\"\" />');
INSERT INTO td_website VALUES ('38', '20130321887', '0', '刘力瑞', '0', '四川达州会欧建材机械工程有限公司', '唐总', '13981488798', '', '达州西外经济开发区塔石路中段', '2013-03-21 00:00:00', '<table class=\"x-grid3-row-table ke-zeroborder\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"ext-gen2242\" style=\"margin:0px;padding:0px;color:#333333;font-family:宋体, arial;font-size:12px;width:895px;\">\n	<tbody id=\"ext-gen2241\">\n		<tr id=\"ext-gen2240\">\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-2 \" id=\"ext-gen2239\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-2\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					网站建设\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-3 \" id=\"ext-gen2251\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-3\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					3500\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-4 \" id=\"ext-gen2250\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-4\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					1\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-5 \" id=\"ext-gen2246\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-5\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					年\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-6 \" id=\"ext-gen2245\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-6\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					0\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-ext-gen980  x-grid3-check-col-td\" id=\"ext-gen2248\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-ext-gen980\" id=\"ext-gen2247\" style=\"margin:0px;padding:1px 0px 0px !important;\">\n					<div class=\"x-grid3-check-col-on x-grid3-cc-ext-gen980\" style=\"margin:0px;padding:0px;\">\n					</div>\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-8 \" id=\"ext-gen2244\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-8\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					2014-03-21\n				</div>\n			</td>\n			<td class=\"x-grid3-col x-grid3-cell x-grid3-td-9 x-grid3-cell-last \" id=\"ext-gen2249\" style=\"vertical-align:top;font-family:宋体;\">\n				<div class=\"x-grid3-cell-inner x-grid3-col-9\" style=\"margin:0px;padding:3px 3px 3px 5px;\">\n					&nbsp;\n				</div>\n			</td>\n		</tr>\n	</tbody>\n</table>\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327170633_66994.bmp\" alt=\"\" /><br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327170633_58944.bmp\" alt=\"\" />');
INSERT INTO td_website VALUES ('39', '20130325899', '0', '张洋', '0', '成都亿豪橱柜有限公司', '苏总', '13980861262', '', '成都市新繁镇泡菜园区', '2013-03-25 00:00:00', '参考网站<a href=\"http://www.altk.net\" target=\"_blank\">www.altk.net<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327170832_76810.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327170833_74437.jpg\" alt=\"\" /></a>');
INSERT INTO td_website VALUES ('40', '20130320872', '0', '谢茂林', '0', '成都兰德华电子科技有限公司', '邓进', '13808174028', '', '成都新光路9号新加坡花园5栋5单元502室', '2013-03-20 00:00:00', '参考网站：<a href=\"http://www.hnsafe.net\" target=\"_blank\">www.hnsafe.net</a><br />\n参考颜色和线条<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327171107_96819.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327171107_88164.jpg\" alt=\"\" /><img src=\"/plugin/kindeditor/php/../attached/image/20130327/20130327171107_40481.jpg\" alt=\"\" /><br />');
INSERT INTO td_website VALUES ('41', '20130331962', '0', '李瑶', '0', '成都色尔咖啡有限公司', '张姐', '13980464559', '', '成都市锦江区青石桥市场二楼B-5', '2013-03-31 00:00:00', '这个客户目前还不急，网站可以慢一点，域名也还没选好，办公场所也还没选好，<br />\n本来都要5月份在做的，为了冲单，这个月就把钱收完了（老客户）<br />\n<br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130402/20130402043146_51217.jpg\" alt=\"\" /><br />\n<img src=\"/plugin/kindeditor/php/../attached/image/20130402/20130402043148_58430.jpg\" alt=\"\" />');
