set charset utf8;

DROP TABLE IF EXISTS `p_group`;
CREATE TABLE `p_group` (
  `pg_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '组id',
  `pg_pid` int(10) NOT NULL COMMENT '所属父组id',
  `pg_sort` int(10) NOT NULL COMMENT '排序',
  `pg_name` varchar(50) NOT NULL COMMENT '组名称',
  `pg_date` datetime NOT NULL COMMENT '组创建时间',
  `pg_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='工作组表';

insert into `p_group`(`pg_id`,`pg_pid`,`pg_sort`,`pg_name`,`pg_date`,`pg_remark`) values('1','-1','0','成都网联天下（工作组）','0000-00-00 00:00:00','');
insert into `p_group`(`pg_id`,`pg_pid`,`pg_sort`,`pg_name`,`pg_date`,`pg_remark`) values('2','1','10','行政1组','0000-00-00 00:00:00','');
insert into `p_group`(`pg_id`,`pg_pid`,`pg_sort`,`pg_name`,`pg_date`,`pg_remark`) values('3','1','0','总监1组','0000-00-00 00:00:00','');
insert into `p_group`(`pg_id`,`pg_pid`,`pg_sort`,`pg_name`,`pg_date`,`pg_remark`) values('4','1','5','经理1组','0000-00-00 00:00:00','');
insert into `p_group`(`pg_id`,`pg_pid`,`pg_sort`,`pg_name`,`pg_date`,`pg_remark`) values('5','1','30','员工','0000-00-00 00:00:00','');

DROP TABLE IF EXISTS `p_group2role`;
CREATE TABLE `p_group2role` (
  `g2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '工作组映射角色流水id',
  `g2r_pgid` int(10) NOT NULL COMMENT '组id',
  `g2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`g2r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='工作组映射角色表';

insert into `p_group2role`(`g2r_id`,`g2r_pgid`,`g2r_prid`) values('1','3','2');
insert into `p_group2role`(`g2r_id`,`g2r_pgid`,`g2r_prid`) values('2','6','2');

DROP TABLE IF EXISTS `p_log`;
CREATE TABLE `p_log` (
  `pl_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '日志id',
  `pl_type` varchar(20) NOT NULL COMMENT '操作类型',
  `pl_conent` varchar(2000) NOT NULL COMMENT '操作内容',
  `pl_puid` int(10) NOT NULL COMMENT '操作人',
  `pl_date` datetime NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`pl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='日志表';


DROP TABLE IF EXISTS `p_menu`;
CREATE TABLE `p_menu` (
  `pm_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `pm_pid` int(10) NOT NULL COMMENT '菜单父id',
  `pm_name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '菜单名',
  `pm_level` int(10) NOT NULL COMMENT '菜单级别',
  `pm_sort` int(10) NOT NULL COMMENT '排序',
  `pm_url` varchar(1000) CHARACTER SET utf8 NOT NULL COMMENT '页面链接地址',
  `pm_img` varchar(1000) CHARACTER SET utf8 NOT NULL COMMENT '图标文件地址',
  `pm_remark` text CHARACTER SET utf8 NOT NULL COMMENT '备注',
  PRIMARY KEY (`pm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1 COMMENT='系统菜单表';

insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('1','-1','成都网联天下（菜单管理）','0','1','#','/image/menu/logo.jpg','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('2','1','项目进度','1','99','/main.php?menu=2','/images/menu_icon/time.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('3','1','权限管理','1','50','/sys_power/index.php?menu=3','/images/menu_icon/power.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('5','3','部门管理','2','1','/sys_power/org_manage.php','/images/menu_icon/depart.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('6','3','人员管理','2','10','/sys_power/user_manage.php','/images/menu_icon/user.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('7','3','工作组管理','2','20','/sys_power/group_manage.php','/images/menu_icon/group.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('8','3','角色管理','2','30','/sys_power/role_manage.php','/images/menu_icon/role.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('9','3','模块管理','2','40','/sys_power/power_manage.php','/images/menu_icon/module.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('10','3','权限类型管理','2','50','/sys_power/powertype_manage.php','/images/menu_icon/keytype.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('11','1','流程管理','1','40','/sys_workflow/index.php?menu=11','/images/menu_icon/workflow.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('12','11','工作流管理','2','10','/sys_workflow/workflow_manage.php','/images/menu_icon/flow.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('13','11','表单管理','2','1','/sys_bizform/biztemplet_manage.php','/images/menu_icon/form.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('14','3','导航菜单管理','2','60','/sys_power/menu_manage.php','/images/menu_icon/menu.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('21','1','系统管理','1','100','/sys_setting/index.php?menu=21','/images/menu_icon/setting.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('22','1','业务面板','1','10','/sys_common/biz/index.php','/images/menu_icon/business.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('23','21','可选项配置','2','0','/sys_setting/item/item_manage.php','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('24','21','基本信息配置','2','0','','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('25','1','OA办公','1','30','/sys_common/oa/index.php?menu=25','/images/menu_icon/book.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('26','25','日记便签','2','0','/sys_common/note/note_manage.php','/images/menu_icon/edit.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('28','25','通知公告','2','0','/sys_common/notice/notice_manage.php','/images/menu_icon/speaker.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('29','3','上下级管理','2','5','/sys_power/relation_manage.php','/images/menu_icon/relation.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('30','11','数据库管理','2','30','/sys_userform/db_manage.php','/images/menu_icon/database.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('31','25','投票','2','0','','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('32','3','角色流程权限','2','33','','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('33','3','角色模块权限','2','32','','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('34','3','角色菜单权限','2','31','','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('35','1','我的桌面','1','0','/sys_common/mydesk/mydesk.php','/images/menu_icon/desk.png','/sys_msg/sendemail.php
/desk.php');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('36','21','帮助文档','2','99','/sys_setting/helper/helper_manage.php','/images/sys_icon/help.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('38','1','CRM系统','1','20','/sys_crm/index.php?menu=38','/images/menu_icon/group.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('39','1','统计分析','1','35','/sys_common/chart/index.htm?menu=39','/images/menu_icon/chart_bar.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('40','39','企业建站项目统计','2','20','/sys_common/chart/website.htm','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('41','25','发送邮件','2','99','/sys_common/email/action/sendmail.php','/images/sys_icon/email_go.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('42','39','员工假事统计','2','99','/sys_common/chart/leave.htm','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('43','25','倒计时','2','0','','/images/menu_icon/time.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('44','25','总经理意见箱','2','0','','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('45','1','产品库','1','37','','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('46','25','企业制度文档','2','0','','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('47','25','新建菜单','0','0','','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('48','21','系统意见反馈','2','0','','','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('55','38','公海客户','2','10','/sys_crm/publiccst.php','/images/sys_icon/crm_public.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('56','38','我的客户','2','0','/sys_crm/mycst.php','/images/sys_icon/crm_my.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('57','38','客户转移','2','20','/sys_crm/cst_move.php','/images/sys_icon/crm_move.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('58','38','回收站','2','99','','/images/sys_icon/recycle.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('59','21','数据库备份','2','0','/sys_setting/backupdb/backupdb.php','/images/menu_icon/database_save.png','');
insert into `p_menu`(`pm_id`,`pm_pid`,`pm_name`,`pm_level`,`pm_sort`,`pm_url`,`pm_img`,`pm_remark`) values('60','21','数据库还原','2','0','','/images/menu_icon/database_refresh.png','');

DROP TABLE IF EXISTS `p_menu2role`;
CREATE TABLE `p_menu2role` (
  `m2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单角色映射id',
  `m2r_pmid` int(10) NOT NULL COMMENT '菜单id',
  `m2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`m2r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COMMENT='菜单角色映射表';

insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('1','1','3');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('2','2','3');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('3','22','3');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('4','35','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('5','38','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('6','25','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('7','22','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('8','26','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('9','28','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('10','31','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('11','43','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('12','44','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('13','46','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('14','47','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('15','41','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('16','39','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('17','42','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('18','40','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('19','45','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('20','11','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('21','13','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('22','12','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('23','30','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('24','3','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('25','5','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('26','6','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('27','29','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('28','7','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('29','8','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('30','34','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('31','33','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('32','32','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('33','9','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('34','10','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('35','14','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('36','2','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('37','21','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('38','23','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('39','24','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('40','48','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('41','36','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('42','1','5');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('43','22','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('44','25','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('45','26','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('46','28','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('47','31','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('48','43','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('49','44','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('50','46','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('51','47','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('52','41','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('53','39','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('54','42','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('55','40','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('56','45','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('73','38','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('74','35','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('75','1','16');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('76','22','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('77','35','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('78','38','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('79','25','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('80','26','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('81','28','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('82','31','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('83','43','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('84','44','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('85','46','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('86','47','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('87','41','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('88','45','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('106','43','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('105','28','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('104','31','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('103','26','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('102','25','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('101','38','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('100','22','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('98','1','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('99','35','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('107','44','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('108','46','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('109','47','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('110','41','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('111','39','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('112','42','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('113','40','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('114','45','19');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('115','35','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('116','1','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('117','22','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('118','25','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('119','26','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('120','28','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('121','31','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('122','43','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('123','44','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('124','46','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('128','22','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('126','41','20');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('129','35','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('130','1','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('131','38','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('132','25','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('133','28','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('134','26','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('135','43','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('136','31','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('137','44','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('138','46','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('139','47','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('140','41','21');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('141','56','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('142','55','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('143','57','4');
insert into `p_menu2role`(`m2r_id`,`m2r_pmid`,`m2r_prid`) values('144','58','4');

DROP TABLE IF EXISTS `p_org`;
CREATE TABLE `p_org` (
  `po_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '部门id',
  `po_pid` int(10) NOT NULL COMMENT '父级部门id',
  `po_sort` int(10) NOT NULL COMMENT '排序',
  `po_name` varchar(50) NOT NULL COMMENT '部门名称',
  `po_date` datetime NOT NULL COMMENT '创建时间',
  `po_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`po_id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='部门表';

insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('0','-1','0','成都网联天下（部门）','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('1','0','1','技术部','2013-01-30 16:09:42','网联天下技术部，网页设计、SHOPEX、人人帮。');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('2','0','10','客服部','2013-01-23 16:10:50','SEO网络优化推广。');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('3','1','0','程序组','2013-01-29 16:11:47','PHP,ASP,切片。');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('38','1','0','设计组','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('57','2','0','商友客服组','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('58','0','0','总经办','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('59','0','0','财务部','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('60','66','0','商友市场部','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('61','66','0','商派市场部','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('62','2','0','SEO客服组','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('64','0','0','人事行政部','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('65','2','0','ShopEx客服组','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('66','0','5','市场部','0000-00-00 00:00:00','');
insert into `p_org`(`po_id`,`po_pid`,`po_sort`,`po_name`,`po_date`,`po_remark`) values('69','66','0','新建部门','0000-00-00 00:00:00','');

DROP TABLE IF EXISTS `p_power`;
CREATE TABLE `p_power` (
  `pp_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `pp_pid` int(10) NOT NULL COMMENT '父权限id',
  `pp_name` varchar(50) NOT NULL COMMENT '权限名称',
  `pp_code` varchar(50) NOT NULL COMMENT '权限编码',
  `pp_sort` int(10) NOT NULL COMMENT '排序',
  `pp_date` datetime NOT NULL COMMENT '创建日期',
  `pp_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='功能权限表';

insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('1','-1','成都网联天下（权限模块）','rootpower','0','0000-00-00 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('3','1','系统功能','sys','0','2013-02-12 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('4','3','桌面','sys_desk','0','2013-02-12 00:00:00','工作桌面');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('5','3','部门管理','sys_depart','0','2013-02-12 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('6','3','人员管理','sys_user','0','2013-02-12 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('7','3','工作组管理','sys_group','0','2013-02-12 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('8','3','角色管理','sys_role','0','2013-02-12 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('9','3','权限管理','sys_power','0','2013-02-12 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('10','1','业务功能','biz','10','2013-02-12 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('11','10','创建项目','biz_project','0','2013-02-12 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('12','10','创建日志','biz_log','0','2013-02-12 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('13','3','权限类型管理','sys_powertype','0','2013-02-12 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('14','10','修改密码','biz_updatepwd','0','2013-02-13 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('15','1','业务流程','','20','2013-02-13 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('16','15','人事请假','','0','2013-02-13 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('17','15','企业网建','','10','0000-00-00 00:00:00','');
insert into `p_power`(`pp_id`,`pp_pid`,`pp_name`,`pp_code`,`pp_sort`,`pp_date`,`pp_remark`) values('18','15','商派项目','','30','0000-00-00 00:00:00','');

DROP TABLE IF EXISTS `p_power2group`;
CREATE TABLE `p_power2group` (
  `p2g_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '组映射权限id',
  `p2g_pgid` int(10) NOT NULL COMMENT '组id',
  `p2g_ppid` int(10) NOT NULL COMMENT '权限id',
  `p2g_ptid` int(10) NOT NULL COMMENT '权限类型id',
  PRIMARY KEY (`p2g_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='功能权限映射工作组表';


DROP TABLE IF EXISTS `p_power2role`;
CREATE TABLE `p_power2role` (
  `p2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '角色映射权限id',
  `p2r_prid` int(10) NOT NULL COMMENT '角色id',
  `p2r_ppid` int(10) NOT NULL COMMENT '权限id',
  `p2r_ptid` int(10) NOT NULL COMMENT '权限类型id',
  PRIMARY KEY (`p2r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='功能权限映射角色表';

insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('7','5','5','1');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('8','5','6','1');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('9','5','7','4');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('10','5','7','3');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('11','5','13','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('12','5','13','3');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('13','5','9','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('15','2','4','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('16','2','5','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('17','2','7','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('18','2','6','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('19','2','8','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('20','2','9','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('21','2','13','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('23','2','11','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('24','2','12','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('25','2','14','2');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('29','6','6','4');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('30','3','7','3');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('31','3','8','3');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('32','3','9','4');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('33','3','13','4');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('34','5','18','1');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('35','5','17','1');
insert into `p_power2role`(`p2r_id`,`p2r_prid`,`p2r_ppid`,`p2r_ptid`) values('37','5','16','1');

DROP TABLE IF EXISTS `p_power2user`;
CREATE TABLE `p_power2user` (
  `p2u_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户映射权限id',
  `p2u_puid` int(10) NOT NULL COMMENT '用户id',
  `p2u_ppid` int(10) NOT NULL COMMENT '权限id',
  `p2u_ptid` int(10) NOT NULL COMMENT '权限类型id',
  PRIMARY KEY (`p2u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='功能权限映射用户表';


DROP TABLE IF EXISTS `p_powertype`;
CREATE TABLE `p_powertype` (
  `pt_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '权限类型id',
  `pt_code` varchar(20) NOT NULL COMMENT '权限类型编码',
  `pt_name` varchar(100) NOT NULL COMMENT '权限类型名称',
  `pt_sort` int(10) NOT NULL COMMENT '排序',
  `pt_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='功能权限分类表';

insert into `p_powertype`(`pt_id`,`pt_code`,`pt_name`,`pt_sort`,`pt_remark`) values('1','read','可访问','0','');
insert into `p_powertype`(`pt_id`,`pt_code`,`pt_name`,`pt_sort`,`pt_remark`) values('2','manage','可管理','30','');
insert into `p_powertype`(`pt_id`,`pt_code`,`pt_name`,`pt_sort`,`pt_remark`) values('3','delete','可删除','20','');
insert into `p_powertype`(`pt_id`,`pt_code`,`pt_name`,`pt_sort`,`pt_remark`) values('4','create','可新建','10','');

DROP TABLE IF EXISTS `p_relation`;
CREATE TABLE `p_relation` (
  `pr_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '上下属关系id',
  `pr_poid` int(10) NOT NULL COMMENT '所在部门id',
  `pr_leaderid` int(10) NOT NULL COMMENT '领导人id',
  `pr_puid` int(10) NOT NULL COMMENT '从属人id',
  PRIMARY KEY (`pr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='上下属关系表';

insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('1','1','1','2');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('2','1','1','3');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('3','1','1','4');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('4','1','1','6');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('5','1','1','9');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('6','1','1','24');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('7','1','1','25');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('8','1','12','1');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('9','1','12','3');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('10','1','12','4');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('11','1','27','1');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('12','1','27','3');
insert into `p_relation`(`pr_id`,`pr_poid`,`pr_leaderid`,`pr_puid`) values('13','1','27','4');

DROP TABLE IF EXISTS `p_role`;
CREATE TABLE `p_role` (
  `pr_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `pr_pid` int(10) NOT NULL COMMENT '父级角色id',
  `pr_name` varchar(50) NOT NULL COMMENT '角色名称',
  `pr_sort` int(10) NOT NULL COMMENT '排序',
  `pr_date` datetime NOT NULL COMMENT '角色创建时间',
  `pr_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='角色表';

insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('1','-1','成都网联天下（角色）','0','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('4','1','员工','999','2013-02-13 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('5','1','超级管理员','0','2013-02-13 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('9','1','技术部门','0','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('10','9','技术总监','1','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('11','9','首席设计师','30','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('12','9','高级软件工程师','40','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('13','9','设计师','30','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('14','9','软件工程师','50','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('15','1','总经办','0','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('16','15','总经理','1','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('17','9','总监助理','10','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('18','15','总经理助理','10','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('19','1','财务总监','0','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('20','9','切片师','35','0000-00-00 00:00:00','');
insert into `p_role`(`pr_id`,`pr_pid`,`pr_name`,`pr_sort`,`pr_date`,`pr_remark`) values('21','9','技术维护','60','0000-00-00 00:00:00','');

DROP TABLE IF EXISTS `p_user`;
CREATE TABLE `p_user` (
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
  `pu_email` varchar(200) NOT NULL COMMENT '用户电子邮箱',
  `pu_qq` varchar(50) NOT NULL COMMENT '用户qq',
  `pu_lastlogin` datetime NOT NULL COMMENT '最后一次登陆系统',
  `pu_logincount` int(11) NOT NULL COMMENT '登陆系统次数',
  `pu_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`pu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='用户表';

insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('1','1','xufei','c4ca4238a0b923820dcc509a6f75849b','徐飞','/uploads/userico/徐飞_1.jpg','男','13688387776','','成都市青羊区八宝街','1113149812@qq.com','1113149812','2013-04-22 22:40:31','0','徐飞');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('2','3','yangjun','fae0b27c451c728867a567e8c1bb4e53','杨俊','','男','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('3','3','zhangkai','fae0b27c451c728867a567e8c1bb4e53','张凯','/uploads/userico/张凯_3.jpg','男','','','','1113149812@qq.com','','2013-04-22 19:57:47','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('4','38','xiaodan','fae0b27c451c728867a567e8c1bb4e53','肖丹','/uploads/userico/肖丹_4.jpg','女','','','','1113149812@qq.com','994579648','2013-04-21 20:49:20','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('5','62','gaoyan','fae0b27c451c728867a567e8c1bb4e53','高燕','','女','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('6','38','jiujun','fae0b27c451c728867a567e8c1bb4e53','刘峻','','男','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('7','1','wangzheng','fae0b27c451c728867a567e8c1bb4e53','王正','','','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('8','1','wangyuting','fae0b27c451c728867a567e8c1bb4e53','王钰婷','','','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('9','38','wangxiujuan','fae0b27c451c728867a567e8c1bb4e53','王秀娟','/uploads/userico/王秀娟_9.jpg','女','','','','1113149812@qq.com','1176107989','2013-04-06 22:04:40','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('10','1','dongting','fae0b27c451c728867a567e8c1bb4e53','董婷','','','','','','','','2013-04-19 22:30:46','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('11','1','chencong','fae0b27c451c728867a567e8c1bb4e53','陈聪','','','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('12','58','gaosiwei','fae0b27c451c728867a567e8c1bb4e53','高思伟','/uploads/userico/高思伟_12.jpg','','','','','','','2013-04-12 00:01:20','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('13','1','zhuyunsheng','fae0b27c451c728867a567e8c1bb4e53','朱芸生','','','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('14','1','yantao','fae0b27c451c728867a567e8c1bb4e53','闫涛','','','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('15','1','zhouwei','fae0b27c451c728867a567e8c1bb4e53','周维','','','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('16','1','dengshuai','fae0b27c451c728867a567e8c1bb4e53','邓帅','','','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('17','1','lidan','fae0b27c451c728867a567e8c1bb4e53','李丹','','','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('18','58','666','fae0b27c451c728867a567e8c1bb4e53','测试数据','','','12312321321','321321321','fdsfdsfds发的身份的','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('19','58','666','fae0b27c451c728867a567e8c1bb4e53','测试数据','','','12312321321','321321321','fdsfdsfds发的身份的','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('20','64','zhangxiang','fae0b27c451c728867a567e8c1bb4e53','张祥','','','13688387777','13688387777','北京12318文化市场举报热线药品服务许可证(京)-经营-2010-0048','','','2013-03-16 00:30:01','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('22','64','leijiaxin','fae0b27c451c728867a567e8c1bb4e53','雷佳欣','','','','','','','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('23','64','zhouyunpeng','fae0b27c451c728867a567e8c1bb4e53','周澐芃','','','','','','','','2013-04-12 00:12:25','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('24','38','lina','fae0b27c451c728867a567e8c1bb4e53','李娜','/uploads/userico/李娜_24.jpg','','','','','1113149812@qq.com','1349098589','2013-04-06 21:26:08','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('25','3','fengxin','fae0b27c451c728867a567e8c1bb4e53','冯欣','/uploads/userico/冯欣_25.jpg','','','','','1113149812@qq.com','','2013-04-21 21:48:55','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('26','3','wangbo','fae0b27c451c728867a567e8c1bb4e53','王博','','','','','','1113149812@qq.com','','0000-00-00 00:00:00','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('27','59','qiulin','fae0b27c451c728867a567e8c1bb4e53','邱琳','/uploads/userico/邱琳_27.png','','','','','','','2013-04-19 22:30:26','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('28','1','liyuxiao','fae0b27c451c728867a567e8c1bb4e53','李雨萧','','','','','','','','2013-04-11 23:58:38','0','');
insert into `p_user`(`pu_id`,`pu_oid`,`pu_code`,`pu_pwd`,`pu_name`,`pu_icon`,`pu_gender`,`pu_phone`,`pu_telephone`,`pu_address`,`pu_email`,`pu_qq`,`pu_lastlogin`,`pu_logincount`,`pu_remark`) values('29','1','tangyong','fae0b27c451c728867a567e8c1bb4e53','唐勇','','','','','','','','0000-00-00 00:00:00','0','');

DROP TABLE IF EXISTS `p_user2group`;
CREATE TABLE `p_user2group` (
  `u2g_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户映射组id',
  `u2g_puid` int(10) NOT NULL COMMENT '用户id',
  `u2g_pgid` int(10) NOT NULL COMMENT '组id',
  PRIMARY KEY (`u2g_id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COMMENT='用户映射工作组表';

insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('107','20','2');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('108','22','2');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('109','23','2');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('110','1','3');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('111','4','3');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('115','2','5');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('116','3','5');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('117','25','5');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('118','4','5');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('119','6','5');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('120','9','5');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('121','24','5');
insert into `p_user2group`(`u2g_id`,`u2g_puid`,`u2g_pgid`) values('122','1','5');

DROP TABLE IF EXISTS `p_user2role`;
CREATE TABLE `p_user2role` (
  `u2r_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户映射角色id',
  `u2r_puid` int(10) NOT NULL COMMENT '用户id',
  `u2r_prid` int(10) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`u2r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='用户映射角色表';

insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('7','12','2');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('9','1','5');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('13','2','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('14','3','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('15','25','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('16','4','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('17','6','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('18','9','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('19','24','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('20','3','3');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('21','4','3');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('22','1','8');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('24','20','8');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('26','9','13');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('27','25','14');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('28','3','12');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('29','4','11');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('30','6','13');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('31','24','13');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('32','2','14');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('33','1','10');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('34','12','16');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('35','1','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('36','12','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('37','20','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('38','22','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('39','23','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('40','5','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('41','7','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('42','8','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('43','10','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('44','11','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('45','13','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('46','14','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('47','15','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('48','16','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('49','17','4');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('50','26','14');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('51','27','19');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('52','28','20');
insert into `p_user2role`(`u2r_id`,`u2r_puid`,`u2r_prid`) values('53','29','21');
