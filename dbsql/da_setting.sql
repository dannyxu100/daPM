-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 05 日 17:20
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `da_setting`
--
CREATE DATABASE `da_setting` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `da_setting`;

-- --------------------------------------------------------

--
-- 表的结构 `s_helper`
--

CREATE TABLE IF NOT EXISTS `s_helper` (
  `h_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '系统帮助文档id',
  `h_name` varchar(100) NOT NULL COMMENT '帮助文档标题',
  `h_code` varchar(100) NOT NULL COMMENT '帮助文档编码',
  `h_htid` int(10) NOT NULL COMMENT '系统帮助文档分类id',
  `h_sort` int(10) NOT NULL COMMENT '排序',
  `h_content` text NOT NULL COMMENT '帮助内容',
  `h_editordate` datetime NOT NULL COMMENT '撰写日期',
  `h_editorname` varchar(50) NOT NULL COMMENT '撰写人',
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统帮助文档表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `s_helper`
--

INSERT INTO `s_helper` (`h_id`, `h_name`, `h_code`, `h_htid`, `h_sort`, `h_content`, `h_editordate`, `h_editorname`) VALUES
(1, '默认简单代码', 'list_templet_code', 6, 1, '<span style="font-size:18px;"><strong> <span style="font-size:16px;">搜索条代</span><span style="font-size:16px;"></span><span style="font-size:16px;">码如下：</span></strong></span><br />\n<pre class="prettyprint lang-html">&lt;select id="tran_search" style="float:left;"&gt; &lt;option value=""&gt;全部&lt;/option&gt;\n   &lt;option value="5"&gt;填写企业建站单&lt;/option&gt;\n   &lt;option value="14"&gt;网页设计&lt;/option&gt;\n   &lt;option value="15"&gt;编写程序&lt;/option&gt;\n   &lt;option value="9"&gt;技术总监审核&lt;/option&gt;\n&lt;/select&gt; &lt;select id="fld_search" style="float:left;"&gt; &lt;option value="ws_cstname"&gt;客户名称&lt;/option&gt;\n   &lt;option value="tc_puname"&gt;执行人&lt;/option&gt;\n   &lt;option value="ws_code"&gt;合同号&lt;/option&gt;\n   &lt;option value="ws_solename"&gt;销售人员&lt;/option&gt;\n   &lt;option value="ws_connphone"&gt;手机号码&lt;/option&gt;\n&lt;/select&gt; \n&lt;input id="key_search" style="float:left;height:20px;" /&gt; \n&lt;a class="item" style="float:left;" href="javascript:void(0)" onclick="clearkey()"&gt;清空&lt;/a&gt; \n&lt;a class="item" style="float:left;" href="javascript:void(0)" onclick="searchkey()"&gt;&lt;img src="/images/sys_icon/search.png" /&gt;搜索&lt;/a&gt;</pre>\n<br />\n<br />\n<span style="font-size:16px;"> 列表代码如下：</span><br />\n<pre class="prettyprint lang-html">&lt;table id="tb_list" style="width:100%;"&gt;\n	&lt;tbody name="head"&gt;\n		&lt;tr&gt;\n			&lt;td style="width:30px;"&gt;\n				序\n			&lt;/td&gt;\n			&lt;td style="width:80px;"&gt;\n				请假人\n			&lt;/td&gt;\n			&lt;td style="width:100px;"&gt;\n				请假日期\n			&lt;/td&gt;\n			&lt;td&gt;\n				请假事由\n			&lt;/td&gt;\n			&lt;td style="width:80px;"&gt;\n				部门经理\n			&lt;/td&gt;\n			&lt;td style="width:80px;"&gt;\n				部门总监\n			&lt;/td&gt;\n			&lt;td style="width:100px;"&gt;\n				审核日期\n			&lt;/td&gt;\n			&lt;td style="width:100px;"&gt;\n				&amp;nbsp;\n			&lt;/td&gt;\n		&lt;/tr&gt;\n	&lt;/tbody&gt;\n	&lt;tbody name="body"&gt;\n		&lt;tr&gt;\n			&lt;td name="order"&gt;\n				{order}\n			&lt;/td&gt;\n			&lt;td name="l_puname"&gt;\n				{l_puname}\n			&lt;/td&gt;\n			&lt;td name="l_date" fmt="yyyy-mm-dd"&gt;\n				{l_date}\n			&lt;/td&gt;\n			&lt;td name="l_content"&gt;\n				{l_content}\n			&lt;/td&gt;\n			&lt;td&gt;\n				{l_manager}\n			&lt;/td&gt;\n			&lt;td&gt;\n				{l_general}\n			&lt;/td&gt;\n			&lt;td name="l_date2" fmt="yyyy-mm-dd"&gt;\n				{l_date2}\n			&lt;/td&gt;\n			&lt;td&gt;\n				{tools}\n			&lt;/td&gt;\n		&lt;/tr&gt;\n	&lt;/tbody&gt;\n	&lt;tbody&gt;\n		&lt;tr&gt;\n			&lt;td colspan="9"&gt;\n				共&lt;span id="tb_list_recordcount2"&gt;0&lt;/span&gt;&amp;nbsp;条，\n				共&lt;span id="tb_list_pagecount2"&gt;0&lt;/span&gt;&amp;nbsp;页，\n				当前在第&lt;span id="tb_list_pageindex2"&gt;0&lt;/span&gt;&amp;nbsp;页　 &lt;span id="tb_list_pageinfo"&gt;&amp;nbsp;&lt;/span&gt; \n			&lt;/td&gt;\n		&lt;/tr&gt;\n	&lt;/tbody&gt;\n&lt;/table&gt;</pre>\n<span style="font-size:16px;"><strong> \n<hr />\n<span style="font-size:16px;">呈现效果：</span></strong></span><br />\n<img src="/sys_setting/helper/image/20130317/20130317140147_48122.jpg" width="625" height="64" alt="" /><br />\n<br />\n<br />\n<img src="/sys_setting/helper/image/20130317/20130317140203_70515.jpg" width="640" height="85" alt="" /><br />\n<br />\n<span style="font-size:16px;"><strong>\n<hr />\n可调用功能函数：<br />\n</strong>\n<hr />\n<span style="font-size:14px;">加载表单数据：loaddata();<br />\n设置用户参数：setuserparam( param );<br />\n</span></span>', '2013-03-17 18:50:52', '徐飞'),
(4, '标识符', 'biz_templet_flag', 6, 2, '<span style="font-size:14px;">代码编写说明：</span><br />\n<span style="font-size:14px;"></span><br />\n<span style="font-size:14px;"></span><span style="font-size:14px;">&nbsp; &nbsp; 用花括号包裹数据源字段名，代表在该位置，加载该字段的值，如:</span><span style="font-size:14px;color:#E56600;">&nbsp;</span><span style="font-size:14px;color:#E56600;">{p_username}<br />\n<br />\n</span>', '2013-03-17 22:27:32', '徐飞'),
(6, '业务单详细页代码编写', 'form_templet_code', 7, 1, '<h3>\n	控件绑定字段值：\n</h3>\n&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:18px;font-family:SimHei;"><span style="font-family:SimSun;font-size:14px;">&lt;input <span style="color:#E53333;">id="l_date"</span> /&gt;&nbsp;</span><span style="font-family:SimSun;font-size:14px;"></span><span style="font-family:SimSun;font-size:14px;"></span><br />\n<br />\n</span> \n<h3>\n	数据验证： &nbsp; &nbsp;\n</h3>\n&nbsp;&nbsp;&nbsp;&nbsp;在input，textarea控件上加入valid属性，如&lt;input id="count"&nbsp;<span style="color:#E53333;">valid="abcnumber,false"</span> /&gt;<br />\n<br />\n&nbsp; &nbsp; 相关验证类型有：<br />\n<pre class="prettyprint lang-js">//验证函数映射表，可以通过名称获得对应的验证处理函数\ndaValid.mapFnValid = {\n	match: da.isMatch,						        //通用正则表达式判定函数\n	anything: da.isAnything,						//任意内容（通常为了判断非空用）\n	int: da.isInt,						//只能整数\n	plusint: da.isIntUp,							//只能正整数\n	plusint0: da.isInt0Up,							//只能非负整数（正整数 + "0"）\n	minusint: da.isIntLower,						//只能负整数\n	minusint0: da.isInt0Lower,						//只能非正整数（负整数 + "0"） \n	\n	float: da.isFloat,					//只能浮点数 \n	plusfloat: da.isFloatUp,						//只能正浮点数\n	plusfloat0: da.isFloat0Up, 						//只能非负浮点数（正浮点数 + "0"）\n	minusfloat: da.isFloatLower,					//只能负浮点数\n	minusfloat0: da.isFloat0Lower,					//只能非正浮点数（负浮点数 + 0） \n	\n	abc: da.isLetter,          			//只能26个英文字母 组成\n	upperabc: da.isLetterUpper,						//只能26个大写英文字母  组成\n	lowerabc: da.isLetterLower,						//只能26个小写英文字母  组成\n	abcnumber: da.isNumLetter,						//只能数字 和 26个英文字母 组成\n	\n	code: da.isCode,								//只能数字、26个英文字母 或者下划线 组成 \n	cn: da.isCN,									//只能中文字符串 组成\n	name: da.isName,								//只能中文字符串、26个英文字母 或者下划线（一般的名称验证）\n	account: da.isAccount,							//只能中文字符串、数字、26个英文字母 或者下划线（一般的账号验证）\n	phone: da.isPhone,								//判断是否电话号码（包括手机）\n	mobile: da.ismobile,							//判断是否手机号码\n	email: da.isEmail,								//判断是否电子邮件地址\n	http: da.isHTTP,								//判断是否是IP地址\n	html: da.isHTML,								//判断是否是HTML代码\n	\n	postcode: da.isPostCode,					//判断是否是中国邮政编码\n	idcard: da.isIDCard,						//判断是否中国身份证号码\n	backcard: da.isBankCard,					//判断是否是银行卡号码\n	ip:	da.isIP									//判断是否是IP地址\n	\n};</pre>\n<span style="font-size:16px;"><strong>弹出选择窗口：<br />\n</strong><br />\n<span style="font-size:12px;">设置source属性值<br />\n<br />\n</span><span style="font-size:12px;"></span><span style="font-size:12px;">选择人员：&lt;input <span style="color:#E53333;">source="user"</span>/&gt;<br />\n<br />\n<span style="white-space:normal;"></span><span style="white-space:normal;"></span><span style="white-space:normal;">选择客户：&lt;input&nbsp;<span style="color:#E53333;">source="cst"</span>/&gt;</span><br />\n<br />\n<br />\n<strong style="font-size:16px;line-height:24px;white-space:normal;">嵌入在线编辑器：</strong></span><span><br />\n<span style="font-size:12px;"><span style="white-space:normal;">设置source属性值</span><br />\n<span style="white-space:normal;">&lt;input&nbsp;</span><span style="white-space:normal;color:#E53333;">source="editorbox"</span><span style="white-space:normal;">/&gt;<br />\n<br />\n<br />\n</span></span></span></span>', '2013-03-17 22:47:57', '徐飞'),
(7, '数据源的作用', 'biz_dbsource', 8, 1, '<span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;项目可以自定义数据表，这些数据表可以作为，自定义业务单的数据来源</span><span style="white-space:normal;"><span style="font-size:14px;">（当然需要确定一个关联字段，一般为</span><span style="color:#E56600;font-size:14px;">主键</span></span><span style="white-space:normal;font-size:14px;">）</span><span style="font-size:14px;">。<br />\n<br />\n&nbsp;&nbsp;&nbsp;&nbsp;而自定义数据表可以在，“数据库管理”里面新建。<br />\n<br />\n&nbsp;&nbsp;&nbsp;&nbsp;<img src="/sys_setting/helper/image/20130317/20130317143709_57117.jpg" alt="" /><br />\n&nbsp;&nbsp;&nbsp;&nbsp;</span>', '2013-03-17 22:49:01', '徐飞');

-- --------------------------------------------------------

--
-- 表的结构 `s_helpertype`
--

CREATE TABLE IF NOT EXISTS `s_helpertype` (
  `ht_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '帮助文档分类id',
  `ht_pid` int(10) NOT NULL COMMENT '帮助文档分类父id',
  `ht_name` varchar(100) NOT NULL COMMENT '帮助文档分类名称',
  `ht_code` varchar(100) NOT NULL COMMENT '帮助文档分类编码',
  `ht_sort` int(10) NOT NULL COMMENT '排序',
  `ht_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`ht_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='帮助文档分类表' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `s_helpertype`
--

INSERT INTO `s_helpertype` (`ht_id`, `ht_pid`, `ht_name`, `ht_code`, `ht_sort`, `ht_remark`) VALUES
(1, -1, 'PM系统帮助文档', 'sys', 0, 'PM系统帮助文档'),
(2, 1, '业务单自定义', 'sys_bizform', 0, ''),
(4, 1, '流程自定义', 'sys_workflow', 0, ''),
(5, 1, '权限管理', 'sys_power', 0, ''),
(6, 2, '列表页模板', 'list_templet', 0, ''),
(7, 2, '详细页模板', 'form_templet', 0, ''),
(8, 2, '数据源', 'biz_dbsource', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `s_item`
--

CREATE TABLE IF NOT EXISTS `s_item` (
  `i_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '常量可选项id',
  `i_itid` int(10) NOT NULL COMMENT '常量可选项分类id',
  `i_name` varchar(200) NOT NULL COMMENT '可选项名称',
  `i_value` varchar(200) NOT NULL COMMENT '可选项对应值',
  `i_sort` int(10) NOT NULL COMMENT '可选项排序',
  `i_remark` text NOT NULL COMMENT '可选项备注',
  PRIMARY KEY (`i_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统常量可选项表' AUTO_INCREMENT=70 ;

--
-- 转存表中的数据 `s_item`
--

INSERT INTO `s_item` (`i_id`, `i_itid`, `i_name`, `i_value`, `i_sort`, `i_remark`) VALUES
(4, 2, '顺利', '1', 1, ''),
(5, 2, '麻烦', '5', 2, ''),
(6, 2, '需要研讨', '10', 3, ''),
(7, 2, '非常严重', '15', 4, ''),
(8, 3, '保险', '保险', 0, ''),
(9, 3, '城市建设', '城市建设', 0, ''),
(10, 3, '党政机关、社会团体', '党政机关、社会团体', 0, ''),
(11, 3, '电子电器、仪器仪表', '电子电器、仪器仪表', 0, ''),
(12, 3, '房地产业', '房地产业', 0, ''),
(13, 3, '纺织、皮革', '纺织、皮革', 0, ''),
(14, 3, '服装、鞋帽', '服装、鞋帽', 0, ''),
(15, 3, '广告、会展', '广告、会展', 0, ''),
(16, 3, '环境保护', '环境保护', 0, ''),
(17, 3, '机械设备、通用零部件', '机械设备、通用零部件', 0, ''),
(18, 3, '计算机、网络', '计算机、网络', 0, ''),
(19, 3, '家具', '家具', 0, ''),
(20, 3, '建筑、装潢业', '建筑、装潢业', 0, ''),
(21, 3, '建筑材料业', '建筑材料业', 0, ''),
(22, 3, '交通物流', '交通物流', 0, ''),
(23, 3, '交通运输设备', '交通运输设备', 0, ''),
(24, 3, '金融', '金融', 0, ''),
(25, 3, '金属及非金属制品', '金属及非金属制品', 0, ''),
(26, 3, '科研、教育', '科研、教育', 0, ''),
(27, 3, '旅游、餐饮、娱乐、休闲、购物', '旅游、餐饮、娱乐、休闲、购物', 0, ''),
(28, 3, '贸易、批发、市场', '贸易、批发、市场', 0, ''),
(29, 3, '农、林、牧、渔', '农、林、牧、渔', 0, ''),
(30, 3, '日常服务', '日常服务', 0, ''),
(31, 3, '商务、办公', '商务、办公', 0, ''),
(32, 3, '生活用品', '生活用品', 0, ''),
(33, 3, '石油化工、橡胶塑料', '石油化工、橡胶塑料', 0, ''),
(34, 3, '食品', '食品', 0, ''),
(35, 3, '通信、邮政', '通信、邮政', 0, ''),
(36, 3, '科研、教育', '科研、教育', 0, ''),
(37, 3, '旅游、餐饮、娱乐、休闲、购物', '旅游、餐饮、娱乐、休闲、购物', 0, ''),
(38, 3, '贸易、批发、市场', '贸易、批发、市场', 0, ''),
(39, 3, '农、林、牧、渔', '农、林、牧、渔', 0, ''),
(40, 3, '日常服务', '日常服务', 0, ''),
(41, 3, '商务、办公', '商务、办公', 0, ''),
(42, 3, '生活用品', '生活用品', 0, ''),
(43, 3, '石油化工、橡胶塑料', '石油化工、橡胶塑料', 0, ''),
(44, 3, '食品', '食品', 0, ''),
(45, 3, '通信、邮政', '通信、邮政', 0, ''),
(46, 3, '新闻、出版', '新闻、出版', 0, ''),
(47, 3, '冶金冶炼', '冶金冶炼', 0, ''),
(48, 3, '医疗保健、社会福利', '医疗保健、社会福利', 0, ''),
(49, 3, '印刷、包装', '印刷、包装', 0, ''),
(50, 3, '造纸、纸品', '造纸、纸品', 0, ''),
(51, 3, '证券、投资', '证券、投资', 0, ''),
(52, 3, '钟表眼镜、工艺品、礼品', '钟表眼镜、工艺品、礼品', 0, ''),
(53, 3, '咨询业', '咨询业', 0, ''),
(54, 6, 'A级', 'A', 1, ''),
(55, 6, 'B级', 'B', 10, ''),
(56, 6, 'C级', 'C', 20, ''),
(57, 6, 'D级', 'D', 30, ''),
(58, 6, 'E级', 'E', 40, ''),
(59, 6, 'F级', 'F', 50, ''),
(60, 7, '网络', '网络', 10, ''),
(61, 7, '电话', '电话', 20, ''),
(62, 7, '客户推荐', '客户推荐', 30, ''),
(63, 7, '朋友介绍', '朋友介绍', 40, ''),
(64, 5, '潜在客户', '潜在客户', 10, ''),
(65, 5, '意向客户', '意向客户', 20, ''),
(66, 5, '洽谈客户', '洽谈客户', 30, ''),
(67, 5, '签约客户', '签约客户', 40, ''),
(68, 5, '老客户', '老客户', 50, ''),
(69, 5, '飞单客户', '飞单客户', 60, '');

-- --------------------------------------------------------

--
-- 表的结构 `s_itemtype`
--

CREATE TABLE IF NOT EXISTS `s_itemtype` (
  `it_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '可选项分类id',
  `it_pid` int(10) NOT NULL COMMENT '可选项分类父id',
  `it_code` varchar(100) NOT NULL COMMENT '可选项分类编码',
  `it_name` varchar(50) NOT NULL COMMENT '可选项分类名称',
  `it_sort` int(10) NOT NULL COMMENT '可选项分类排序',
  `it_remark` text NOT NULL COMMENT '可选项分类备注',
  PRIMARY KEY (`it_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='可选项分类表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `s_itemtype`
--

INSERT INTO `s_itemtype` (`it_id`, `it_pid`, `it_code`, `it_name`, `it_sort`, `it_remark`) VALUES
(1, -1, '', '系统常量可选项', 0, '系统常量可选项，如地区、性别、客户等等'),
(2, 1, 'bizlog_tagtype', '业务单日志标签分类', 0, ''),
(3, 4, 'cst_trade', '行业分类', 0, ''),
(4, 1, '', 'CRM', 0, ''),
(5, 4, 'cst_type', '客户类型', 0, ''),
(6, 4, 'cst_level', '客户等级', 0, ''),
(7, 4, 'cst_source', '客户来源', 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
