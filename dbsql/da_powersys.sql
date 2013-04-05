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
-- 数据库: `da_powersys`
--
CREATE DATABASE `da_powersys` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `da_powersys`;

-- --------------------------------------------------------

--
-- 表的结构 `p_group`
--

CREATE TABLE IF NOT EXISTS `p_group` (
  `pg_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '组id',
  `pg_pid` int(10) NOT NULL COMMENT '所属父组id',
  `pg_sort` int(10) NOT NULL COMMENT '排序',
  `pg_name` varchar(50) NOT NULL COMMENT '组名称',
  `pg_date` datetime NOT NULL COMMENT '组创建时间',
  `pg_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='工作组表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `p_group`
--

INSERT INTO `p_group` (`pg_id`, `pg_pid`, `pg_sort`, `pg_name`, `pg_date`, `pg_remark`) VALUES
(1, -1, 0, '成都网联天下（工作组）', '0000-00-00 00:00:00', ''),
(2, 1, 10, '行政1组', '0000-00-00 00:00:00', ''),
(3, 1, 0, '总监1组', '0000-00-00 00:00:00', ''),
(4, 1, 5, '经理1组', '0000-00-00 00:00:00', ''),
(5, 1, 30, '员工', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- 表的结构 `p_group2role`
--

CREATE TABLE IF NOT EXISTS `p_group2role` (
  `g2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '工作组映射角色流水id',
  `g2r_pgid` int(10) NOT NULL COMMENT '组id',
  `g2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`g2r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='工作组映射角色表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `p_group2role`
--

INSERT INTO `p_group2role` (`g2r_id`, `g2r_pgid`, `g2r_prid`) VALUES
(1, 3, 2),
(2, 6, 2);

-- --------------------------------------------------------

--
-- 表的结构 `p_log`
--

CREATE TABLE IF NOT EXISTS `p_log` (
  `pl_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '日志id',
  `pl_type` varchar(20) NOT NULL COMMENT '操作类型',
  `pl_conent` varchar(2000) NOT NULL COMMENT '操作内容',
  `pl_puid` int(10) NOT NULL COMMENT '操作人',
  `pl_date` datetime NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`pl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='日志表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `p_menu`
--

CREATE TABLE IF NOT EXISTS `p_menu` (
  `pm_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `pm_pid` int(10) NOT NULL COMMENT '菜单父id',
  `pm_name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '菜单名',
  `pm_level` int(10) NOT NULL COMMENT '菜单级别',
  `pm_sort` int(10) NOT NULL COMMENT '排序',
  `pm_url` varchar(1000) CHARACTER SET utf8 NOT NULL COMMENT '页面链接地址',
  `pm_img` varchar(1000) CHARACTER SET utf8 NOT NULL COMMENT '图标文件地址',
  `pm_remark` text CHARACTER SET utf8 NOT NULL COMMENT '备注',
  PRIMARY KEY (`pm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='系统菜单表' AUTO_INCREMENT=59 ;

--
-- 转存表中的数据 `p_menu`
--

INSERT INTO `p_menu` (`pm_id`, `pm_pid`, `pm_name`, `pm_level`, `pm_sort`, `pm_url`, `pm_img`, `pm_remark`) VALUES
(1, -1, '成都网联天下（菜单管理）', 0, 1, '#', '/image/menu/logo.jpg', ''),
(2, 1, '项目进度', 1, 99, '/main.php?menu=2', '/images/menu_icon/time.png', ''),
(3, 1, '权限管理', 1, 50, '/sys_power/index.php?menu=3', '/images/menu_icon/power.png', ''),
(5, 3, '部门管理', 2, 1, '/sys_power/org_manage.php', '/images/menu_icon/depart.png', ''),
(6, 3, '人员管理', 2, 10, '/sys_power/user_manage.php', '/images/menu_icon/user.png', ''),
(7, 3, '工作组管理', 2, 20, '/sys_power/group_manage.php', '/images/menu_icon/group.png', ''),
(8, 3, '角色管理', 2, 30, '/sys_power/role_manage.php', '/images/menu_icon/role.png', ''),
(9, 3, '模块管理', 2, 40, '/sys_power/power_manage.php', '/images/menu_icon/module.png', ''),
(10, 3, '权限类型管理', 2, 50, '/sys_power/powertype_manage.php', '/images/menu_icon/keytype.png', ''),
(11, 1, '流程管理', 1, 40, '/sys_workflow/index.php?menu=11', '/images/menu_icon/workflow.png', ''),
(12, 11, '工作流管理', 2, 10, '/sys_workflow/workflow_manage.php', '/images/menu_icon/flow.png', ''),
(13, 11, '表单管理', 2, 1, '/sys_bizform/biztemplet_manage.php', '/images/menu_icon/form.png', ''),
(14, 3, '导航菜单管理', 2, 60, '/sys_power/menu_manage.php', '/images/menu_icon/menu.png', ''),
(21, 1, '系统管理', 1, 100, '/sys_setting/index.php?menu=21', '/images/menu_icon/setting.png', ''),
(22, 1, '业务面板', 1, 10, '/sys_common/biz/index.php', '/images/menu_icon/business.png', ''),
(23, 21, '可选项配置', 2, 0, '/sys_setting/item/item_manage.php', '', ''),
(24, 21, '基本信息配置', 2, 0, '', '', ''),
(25, 1, 'OA办公', 1, 30, '/sys_common/oa/index.php?menu=25', '/images/menu_icon/book.png', ''),
(26, 25, '日记便签', 2, 0, '', '', ''),
(28, 25, '通知公告', 2, 0, '', '', ''),
(29, 3, '上下级管理', 2, 5, '/sys_power/relation_manage.php', '/images/menu_icon/relation.png', ''),
(30, 11, '数据库管理', 2, 30, '/sys_userform/db_manage.php', '/images/menu_icon/database.png', ''),
(31, 25, '投票', 2, 0, '', '', ''),
(32, 3, '角色流程权限', 2, 33, '', '', ''),
(33, 3, '角色模块权限', 2, 32, '', '', ''),
(34, 3, '角色菜单权限', 2, 31, '', '', ''),
(35, 1, '我的桌面', 1, 0, '/sys_common/mydesk/mydesk.php', '/images/menu_icon/desk.png', '/sys_msg/sendemail.php\n/desk.php'),
(36, 21, '帮助文档', 2, 99, '/sys_setting/helper/helper_manage.php', '/images/sys_icon/help.png', ''),
(38, 1, 'CRM系统', 1, 20, '/sys_crm/index.php?menu=38', '/images/menu_icon/group.png', ''),
(39, 1, '统计分析', 1, 35, '/sys_common/chart/index.htm?menu=39', '/images/menu_icon/chart_bar.png', ''),
(40, 39, '企业建站项目统计', 2, 20, '/sys_common/chart/website.htm', '', ''),
(41, 25, '发送邮件', 2, 99, '/sys_common/email/sendmail.php', '/images/sys_icon/email_go.png', ''),
(42, 39, '员工假事统计', 2, 99, '/sys_common/chart/leave.htm', '', ''),
(43, 25, '倒计时', 2, 0, '', '/images/menu_icon/time.png', ''),
(44, 25, '总经理意见箱', 2, 0, '', '', ''),
(45, 1, '产品库', 1, 37, '', '', ''),
(46, 25, '企业制度文档', 2, 0, '', '', ''),
(47, 25, '新建菜单', 0, 0, '', '', ''),
(48, 21, '系统意见反馈', 2, 0, '', '', ''),
(55, 38, '公海客户', 2, 10, '/sys_crm/publiccst.php', '/images/sys_icon/crm_public.png', ''),
(56, 38, '我的客户', 2, 0, '/sys_crm/mycst.php', '/images/sys_icon/crm_my.png', ''),
(57, 38, '客户转移', 2, 20, '/sys_crm/cst_move.php', '/images/sys_icon/crm_move.png', ''),
(58, 38, '回收站', 2, 99, '', '/images/sys_icon/recycle.png', '');

-- --------------------------------------------------------

--
-- 表的结构 `p_menu2role`
--

CREATE TABLE IF NOT EXISTS `p_menu2role` (
  `m2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单角色映射id',
  `m2r_pmid` int(10) NOT NULL COMMENT '菜单id',
  `m2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`m2r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='菜单角色映射表' AUTO_INCREMENT=107 ;

--
-- 转存表中的数据 `p_menu2role`
--

INSERT INTO `p_menu2role` (`m2r_id`, `m2r_pmid`, `m2r_prid`) VALUES
(1, 1, 3),
(2, 2, 3),
(3, 22, 3),
(4, 35, 5),
(5, 38, 5),
(6, 25, 5),
(7, 22, 5),
(8, 26, 5),
(9, 28, 5),
(10, 31, 5),
(11, 43, 5),
(12, 44, 5),
(13, 46, 5),
(14, 47, 5),
(15, 41, 5),
(16, 39, 5),
(17, 42, 5),
(18, 40, 5),
(19, 45, 5),
(20, 11, 5),
(21, 13, 5),
(22, 12, 5),
(23, 30, 5),
(24, 3, 5),
(25, 5, 5),
(26, 6, 5),
(27, 29, 5),
(28, 7, 5),
(29, 8, 5),
(30, 34, 5),
(31, 33, 5),
(32, 32, 5),
(33, 9, 5),
(34, 10, 5),
(35, 14, 5),
(36, 2, 5),
(37, 21, 5),
(38, 23, 5),
(39, 24, 5),
(40, 48, 5),
(41, 36, 5),
(42, 1, 5),
(43, 22, 16),
(44, 25, 16),
(45, 26, 16),
(46, 28, 16),
(47, 31, 16),
(48, 43, 16),
(49, 44, 16),
(50, 46, 16),
(51, 47, 16),
(52, 41, 16),
(53, 39, 16),
(54, 42, 16),
(55, 40, 16),
(56, 45, 16),
(73, 38, 16),
(74, 35, 16),
(75, 1, 16),
(76, 22, 4),
(77, 35, 4),
(78, 38, 4),
(79, 25, 4),
(80, 26, 4),
(81, 28, 4),
(82, 31, 4),
(83, 43, 4),
(84, 44, 4),
(85, 46, 4),
(86, 47, 4),
(87, 41, 4),
(88, 45, 4),
(89, 3, 16),
(90, 5, 16),
(91, 29, 16),
(92, 6, 16),
(93, 7, 16),
(94, 8, 16),
(95, 9, 16),
(96, 10, 16),
(97, 14, 16),
(98, 55, 5),
(99, 56, 5),
(100, 57, 5),
(101, 58, 5),
(103, 56, 4),
(104, 55, 4),
(105, 57, 4),
(106, 58, 4);

-- --------------------------------------------------------

--
-- 表的结构 `p_org`
--

CREATE TABLE IF NOT EXISTS `p_org` (
  `po_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `po_pid` int(10) NOT NULL COMMENT '父级部门id',
  `po_sort` int(10) NOT NULL COMMENT '排序',
  `po_name` varchar(50) NOT NULL COMMENT '部门名称',
  `po_date` datetime NOT NULL COMMENT '创建时间',
  `po_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='部门表' AUTO_INCREMENT=70 ;

--
-- 转存表中的数据 `p_org`
--

INSERT INTO `p_org` (`po_id`, `po_pid`, `po_sort`, `po_name`, `po_date`, `po_remark`) VALUES
(0, -1, 0, '成都网联天下（部门）', '0000-00-00 00:00:00', ''),
(1, 0, 1, '技术部', '2013-01-30 16:09:42', '网联天下技术部，网页设计、SHOPEX、人人帮。'),
(2, 0, 10, '客服部', '2013-01-23 16:10:50', 'SEO网络优化推广。'),
(3, 1, 0, '程序组', '2013-01-29 16:11:47', 'PHP,ASP,切片。'),
(38, 1, 0, '设计组', '0000-00-00 00:00:00', ''),
(57, 2, 0, '商友客服组', '0000-00-00 00:00:00', ''),
(58, 0, 0, '总经办', '0000-00-00 00:00:00', ''),
(59, 0, 0, '财务部', '0000-00-00 00:00:00', ''),
(60, 66, 0, '商友市场部', '0000-00-00 00:00:00', ''),
(61, 66, 0, '商派市场部', '0000-00-00 00:00:00', ''),
(62, 2, 0, 'SEO客服组', '0000-00-00 00:00:00', ''),
(64, 0, 0, '人事行政部', '0000-00-00 00:00:00', ''),
(65, 2, 0, 'ShopEx客服组', '0000-00-00 00:00:00', ''),
(66, 0, 5, '市场部', '0000-00-00 00:00:00', ''),
(69, 66, 0, '新建部门', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- 表的结构 `p_power`
--

CREATE TABLE IF NOT EXISTS `p_power` (
  `pp_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `pp_pid` int(10) NOT NULL COMMENT '父权限id',
  `pp_name` varchar(50) NOT NULL COMMENT '权限名称',
  `pp_code` varchar(50) NOT NULL COMMENT '权限编码',
  `pp_sort` int(10) NOT NULL COMMENT '排序',
  `pp_date` datetime NOT NULL COMMENT '创建日期',
  `pp_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='功能权限表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `p_power`
--

INSERT INTO `p_power` (`pp_id`, `pp_pid`, `pp_name`, `pp_code`, `pp_sort`, `pp_date`, `pp_remark`) VALUES
(1, -1, '成都网联天下（权限模块）', 'rootpower', 0, '0000-00-00 00:00:00', ''),
(3, 1, '系统功能', 'sys', 0, '2013-02-12 00:00:00', ''),
(4, 3, '桌面', 'sys_desk', 0, '2013-02-12 00:00:00', '工作桌面'),
(5, 3, '部门管理', 'sys_depart', 0, '2013-02-12 00:00:00', ''),
(6, 3, '人员管理', 'sys_user', 0, '2013-02-12 00:00:00', ''),
(7, 3, '工作组管理', 'sys_group', 0, '2013-02-12 00:00:00', ''),
(8, 3, '角色管理', 'sys_role', 0, '2013-02-12 00:00:00', ''),
(9, 3, '权限管理', 'sys_power', 0, '2013-02-12 00:00:00', ''),
(10, 1, '业务功能', 'biz', 10, '2013-02-12 00:00:00', ''),
(11, 10, '创建项目', 'biz_project', 0, '2013-02-12 00:00:00', ''),
(12, 10, '创建日志', 'biz_log', 0, '2013-02-12 00:00:00', ''),
(13, 3, '权限类型管理', 'sys_powertype', 0, '2013-02-12 00:00:00', ''),
(14, 10, '修改密码', 'biz_updatepwd', 0, '2013-02-13 00:00:00', ''),
(15, 1, '业务流程', '', 20, '2013-02-13 00:00:00', ''),
(16, 15, '人事请假', '', 0, '2013-02-13 00:00:00', ''),
(17, 15, '企业网建', '', 10, '0000-00-00 00:00:00', ''),
(18, 15, '商派项目', '', 30, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- 表的结构 `p_power2group`
--

CREATE TABLE IF NOT EXISTS `p_power2group` (
  `p2g_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '组映射权限id',
  `p2g_pgid` int(10) NOT NULL COMMENT '组id',
  `p2g_ppid` int(10) NOT NULL COMMENT '权限id',
  `p2g_ptid` int(10) NOT NULL COMMENT '权限类型id',
  PRIMARY KEY (`p2g_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='功能权限映射工作组表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `p_power2role`
--

CREATE TABLE IF NOT EXISTS `p_power2role` (
  `p2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '角色映射权限id',
  `p2r_prid` int(10) NOT NULL COMMENT '角色id',
  `p2r_ppid` int(10) NOT NULL COMMENT '权限id',
  `p2r_ptid` int(10) NOT NULL COMMENT '权限类型id',
  PRIMARY KEY (`p2r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='功能权限映射角色表' AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `p_power2role`
--

INSERT INTO `p_power2role` (`p2r_id`, `p2r_prid`, `p2r_ppid`, `p2r_ptid`) VALUES
(7, 5, 5, 1),
(8, 5, 6, 1),
(9, 5, 7, 4),
(10, 5, 7, 3),
(11, 5, 13, 2),
(12, 5, 13, 3),
(13, 5, 9, 2),
(15, 2, 4, 2),
(16, 2, 5, 2),
(17, 2, 7, 2),
(18, 2, 6, 2),
(19, 2, 8, 2),
(20, 2, 9, 2),
(21, 2, 13, 2),
(23, 2, 11, 2),
(24, 2, 12, 2),
(25, 2, 14, 2),
(29, 6, 6, 4),
(30, 3, 7, 3),
(31, 3, 8, 3),
(32, 3, 9, 4),
(33, 3, 13, 4),
(34, 5, 18, 1),
(35, 5, 17, 1),
(37, 5, 16, 1);

-- --------------------------------------------------------

--
-- 表的结构 `p_power2user`
--

CREATE TABLE IF NOT EXISTS `p_power2user` (
  `p2u_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户映射权限id',
  `p2u_puid` int(10) NOT NULL COMMENT '用户id',
  `p2u_ppid` int(10) NOT NULL COMMENT '权限id',
  `p2u_ptid` int(10) NOT NULL COMMENT '权限类型id',
  PRIMARY KEY (`p2u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='功能权限映射用户表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `p_powertype`
--

CREATE TABLE IF NOT EXISTS `p_powertype` (
  `pt_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '权限类型id',
  `pt_code` varchar(20) NOT NULL COMMENT '权限类型编码',
  `pt_name` varchar(100) NOT NULL COMMENT '权限类型名称',
  `pt_sort` int(10) NOT NULL COMMENT '排序',
  `pt_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='功能权限分类表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `p_powertype`
--

INSERT INTO `p_powertype` (`pt_id`, `pt_code`, `pt_name`, `pt_sort`, `pt_remark`) VALUES
(1, 'read', '可访问', 0, ''),
(2, 'manage', '可管理', 30, ''),
(3, 'delete', '可删除', 20, ''),
(4, 'create', '可新建', 10, '');

-- --------------------------------------------------------

--
-- 表的结构 `p_relation`
--

CREATE TABLE IF NOT EXISTS `p_relation` (
  `pr_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '上下属关系id',
  `pr_poid` int(10) NOT NULL COMMENT '所在部门id',
  `pr_leaderid` int(10) NOT NULL COMMENT '领导人id',
  `pr_puid` int(10) NOT NULL COMMENT '从属人id',
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='上下属关系表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `p_relation`
--

INSERT INTO `p_relation` (`pr_id`, `pr_poid`, `pr_leaderid`, `pr_puid`) VALUES
(1, 1, 1, 2),
(2, 1, 1, 3),
(3, 1, 1, 4),
(4, 1, 1, 6),
(5, 1, 1, 9),
(6, 1, 1, 24),
(7, 1, 1, 25),
(8, 1, 12, 1),
(9, 1, 12, 3),
(10, 1, 12, 4);

-- --------------------------------------------------------

--
-- 表的结构 `p_role`
--

CREATE TABLE IF NOT EXISTS `p_role` (
  `pr_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `pr_pid` int(10) NOT NULL COMMENT '父级角色id',
  `pr_name` varchar(50) NOT NULL COMMENT '角色名称',
  `pr_sort` int(10) NOT NULL COMMENT '排序',
  `pr_date` datetime NOT NULL COMMENT '角色创建时间',
  `pr_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `p_role`
--

INSERT INTO `p_role` (`pr_id`, `pr_pid`, `pr_name`, `pr_sort`, `pr_date`, `pr_remark`) VALUES
(1, -1, '成都网联天下（角色）', 0, '0000-00-00 00:00:00', ''),
(4, 1, '员工', 999, '2013-02-13 00:00:00', ''),
(5, 1, '超级管理员', 0, '2013-02-13 00:00:00', ''),
(9, 1, '技术部门', 0, '0000-00-00 00:00:00', ''),
(10, 9, '技术总监', 1, '0000-00-00 00:00:00', ''),
(11, 9, '首席设计师', 30, '0000-00-00 00:00:00', ''),
(12, 9, '高级软件工程师', 40, '0000-00-00 00:00:00', ''),
(13, 9, '设计师', 30, '0000-00-00 00:00:00', ''),
(14, 9, '软件工程师', 50, '0000-00-00 00:00:00', ''),
(15, 1, '总经办', 0, '0000-00-00 00:00:00', ''),
(16, 15, '总经理', 1, '0000-00-00 00:00:00', ''),
(17, 9, '总监助理', 10, '0000-00-00 00:00:00', ''),
(18, 15, '总经理助理', 10, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- 表的结构 `p_user`
--

CREATE TABLE IF NOT EXISTS `p_user` (
  `pu_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户id号',
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
  PRIMARY KEY (`pu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `p_user`
--

INSERT INTO `p_user` (`pu_id`, `pu_oid`, `pu_code`, `pu_pwd`, `pu_name`, `pu_icon`, `pu_gender`, `pu_phone`, `pu_telephone`, `pu_address`, `pu_lastlogin`, `pu_logincount`, `pu_remark`) VALUES
(1, 1, 'xufei', 'c4ca4238a0b923820dcc509a6f75849b', '徐飞', '/uploads/userico/徐飞_1.jpg', '男', '13688387776', '', '成都市青羊区八宝街', '2013-04-05 19:42:40', 0, '徐飞'),
(2, 3, 'yangjun', 'fae0b27c451c728867a567e8c1bb4e53', '杨俊', '', '男', '', '', '', '0000-00-00 00:00:00', 0, ''),
(3, 3, 'zhangkai', 'fae0b27c451c728867a567e8c1bb4e53', '张凯', '/uploads/userico/张凯_3.jpg', '男', '', '', '', '2013-04-05 19:38:53', 0, ''),
(4, 38, 'xiaodan', 'fae0b27c451c728867a567e8c1bb4e53', '肖丹', '/uploads/userico/肖丹_4.jpg', '女', '', '', '', '2013-03-31 20:23:37', 0, ''),
(5, 1, 'gaoyan', 'fae0b27c451c728867a567e8c1bb4e53', '高燕', '', '女', '', '', '', '0000-00-00 00:00:00', 0, ''),
(6, 38, 'jiujun', 'fae0b27c451c728867a567e8c1bb4e53', '刘峻', '', '男', '', '', '', '0000-00-00 00:00:00', 0, ''),
(7, 1, 'wangzheng', 'fae0b27c451c728867a567e8c1bb4e53', '王正', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(8, 1, 'wangyuting', 'fae0b27c451c728867a567e8c1bb4e53', '王钰婷', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(9, 38, 'wangxiujuan', 'fae0b27c451c728867a567e8c1bb4e53', '王秀娟', '/uploads/userico/王秀娟_9.jpg', '女', '', '', '', '2013-04-05 12:59:18', 0, ''),
(10, 1, 'dongting', 'fae0b27c451c728867a567e8c1bb4e53', '董婷', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(11, 1, 'chencong', 'fae0b27c451c728867a567e8c1bb4e53', '陈聪', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(12, 58, 'gaosiwei', 'fae0b27c451c728867a567e8c1bb4e53', '高思伟', '/uploads/userico/高思伟_12.jpg', '', '', '', '', '2013-04-03 22:54:29', 0, ''),
(13, 1, 'zhuyunsheng', 'fae0b27c451c728867a567e8c1bb4e53', '朱芸生', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(14, 1, 'yantao', 'fae0b27c451c728867a567e8c1bb4e53', '闫涛', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(15, 1, 'zhouwei', 'fae0b27c451c728867a567e8c1bb4e53', '周维', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(16, 1, 'dengshuai', 'fae0b27c451c728867a567e8c1bb4e53', '邓帅', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(17, 1, 'lidan', 'fae0b27c451c728867a567e8c1bb4e53', '李丹', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(18, 58, '666', 'fae0b27c451c728867a567e8c1bb4e53', '测试数据', '', '', '12312321321', '321321321', 'fdsfdsfds发的身份的', '0000-00-00 00:00:00', 0, ''),
(19, 58, '666', 'fae0b27c451c728867a567e8c1bb4e53', '测试数据', '', '', '12312321321', '321321321', 'fdsfdsfds发的身份的', '0000-00-00 00:00:00', 0, ''),
(20, 64, 'zhangxiang', 'fae0b27c451c728867a567e8c1bb4e53', '张祥', '', '', '13688387777', '13688387777', '北京12318文化市场举报热线药品服务许可证(京)-经营-2010-0048', '2013-03-16 00:30:01', 0, ''),
(22, 64, 'leijiaxin', 'fae0b27c451c728867a567e8c1bb4e53', '雷佳欣', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(23, 64, 'zhouyunpeng', 'fae0b27c451c728867a567e8c1bb4e53', '周澐芃', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(24, 38, 'lina', 'fae0b27c451c728867a567e8c1bb4e53', '李娜', '/uploads/userico/李娜_24.jpg', '', '', '', '', '2013-03-28 01:20:14', 0, ''),
(25, 3, 'fengxin', 'fae0b27c451c728867a567e8c1bb4e53', '冯欣', '/uploads/userico/冯欣_25.jpg', '', '', '', '', '2013-03-30 11:16:52', 0, ''),
(26, 3, 'wangbo', 'fae0b27c451c728867a567e8c1bb4e53', '王博', '', '', '', '', '', '0000-00-00 00:00:00', 0, ''),
(27, 64, '', 'fae0b27c451c728867a567e8c1bb4e53', '', '', '', '', '', '', '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `p_user2group`
--

CREATE TABLE IF NOT EXISTS `p_user2group` (
  `u2g_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户映射组id',
  `u2g_puid` int(10) NOT NULL COMMENT '用户id',
  `u2g_pgid` int(10) NOT NULL COMMENT '组id',
  PRIMARY KEY (`u2g_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户映射工作组表' AUTO_INCREMENT=123 ;

--
-- 转存表中的数据 `p_user2group`
--

INSERT INTO `p_user2group` (`u2g_id`, `u2g_puid`, `u2g_pgid`) VALUES
(107, 20, 2),
(108, 22, 2),
(109, 23, 2),
(110, 1, 3),
(111, 4, 3),
(115, 2, 5),
(116, 3, 5),
(117, 25, 5),
(118, 4, 5),
(119, 6, 5),
(120, 9, 5),
(121, 24, 5),
(122, 1, 5);

-- --------------------------------------------------------

--
-- 表的结构 `p_user2role`
--

CREATE TABLE IF NOT EXISTS `p_user2role` (
  `u2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户映射角色id',
  `u2r_puid` int(10) NOT NULL COMMENT '用户id',
  `u2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`u2r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户映射角色表' AUTO_INCREMENT=50 ;

--
-- 转存表中的数据 `p_user2role`
--

INSERT INTO `p_user2role` (`u2r_id`, `u2r_puid`, `u2r_prid`) VALUES
(7, 12, 2),
(9, 1, 5),
(13, 2, 4),
(14, 3, 4),
(15, 25, 4),
(16, 4, 4),
(17, 6, 4),
(18, 9, 4),
(19, 24, 4),
(20, 3, 3),
(21, 4, 3),
(22, 1, 8),
(24, 20, 8),
(26, 9, 13),
(27, 25, 14),
(28, 3, 12),
(29, 4, 11),
(30, 6, 13),
(31, 24, 13),
(32, 2, 14),
(33, 1, 10),
(34, 12, 16),
(35, 1, 4),
(36, 12, 4),
(37, 20, 4),
(38, 22, 4),
(39, 23, 4),
(40, 5, 4),
(41, 7, 4),
(42, 8, 4),
(43, 10, 4),
(44, 11, 4),
(45, 13, 4),
(46, 14, 4),
(47, 15, 4),
(48, 16, 4),
(49, 17, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
