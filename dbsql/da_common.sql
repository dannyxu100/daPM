/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : da_common

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2013-04-14 21:41:09
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
  `n_abstract` varchar(2000) NOT NULL COMMENT '便签摘要',
  `n_content` text NOT NULL COMMENT '便签详细内容',
  `n_puid` int(10) NOT NULL COMMENT '便签记录人id',
  `n_date` datetime NOT NULL COMMENT '便签记录日期',
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='便签信息表';

-- ----------------------------
-- Records of comm_note
-- ----------------------------
INSERT INTO `comm_note` VALUES ('1', '1', '明天做个通知公告模块', '明天做个通知公告模块\n明天做个通知公告模块\n明天做个通知公告模块', '', '1', '2013-04-13 22:18:53');
INSERT INTO `comm_note` VALUES ('2', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:34');
INSERT INTO `comm_note` VALUES ('3', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:36');
INSERT INTO `comm_note` VALUES ('4', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:36');
INSERT INTO `comm_note` VALUES ('5', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:37');
INSERT INTO `comm_note` VALUES ('6', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:37');
INSERT INTO `comm_note` VALUES ('7', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:38');
INSERT INTO `comm_note` VALUES ('8', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:39');
INSERT INTO `comm_note` VALUES ('9', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:40');
INSERT INTO `comm_note` VALUES ('10', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:41');
INSERT INTO `comm_note` VALUES ('11', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:41');
INSERT INTO `comm_note` VALUES ('12', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:42');
INSERT INTO `comm_note` VALUES ('13', '1', '111111111111111111111111111111111111111111111', '', '', '1', '2013-04-13 23:33:44');
INSERT INTO `comm_note` VALUES ('14', '1', '22222222222222222222222222222222222222222222222222222222222222222222233333333333333333', '', '', '1', '2013-04-13 23:35:11');
INSERT INTO `comm_note` VALUES ('15', '1', '当前在第当前在第当前在第当前在第当前在第当前在第当前在第当前在第当前在第当前在第当前在第当前在第当前在第当前在第当前在第当前在第', '', '', '1', '2013-04-13 23:40:24');
INSERT INTO `comm_note` VALUES ('16', '1', '翻滚吧，金正恩.....翻滚吧，金正恩.....翻滚吧，金正恩.....', '翻滚吧，金正恩.....翻滚吧，金正恩.....翻滚吧，金正恩.....', '<img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" /><img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/19.gif\" border=\"0\" alt=\"\" />', '1', '2013-04-13 23:45:48');
INSERT INTO `comm_note` VALUES ('17', '1', '添加便签本添加便签本添加便签本添加便签本添加便签本添加便签本', '添加便签本添加便签本添加便签本添加便签本\n\n添加便签本添加便签本添加便签本\n添加便签本添加便签本添加便签本', 'undefined', '1', '2013-04-13 23:47:46');
INSERT INTO `comm_note` VALUES ('18', '1', 'Photoshop绘制一杯香浓的热咖啡教程', '关键词:Photoshop绘制一杯香浓的热咖啡教程\n本教程介绍文字有点简略，不过大致的过程都有说明。制作的时候需要根据作者的提示慢慢处理光感和质感。新手制作的时候最好是多新建一些图层，这样修改起来就非常方便', '<img src=\"http://www.wzsky.net/img2013/uploadimg/20130412/1024320.jpg\" width=\"450\" height=\"600\" alt=\"\" />', '1', '2013-04-13 23:51:29');

-- ----------------------------
-- Table structure for `comm_notetype`
-- ----------------------------
DROP TABLE IF EXISTS `comm_notetype`;
CREATE TABLE `comm_notetype` (
  `nt_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '便签簿id',
  `nt_name` varchar(100) NOT NULL COMMENT '便签簿名称',
  `nt_puid` int(10) NOT NULL COMMENT '便签簿拥有人id',
  PRIMARY KEY (`nt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='便签簿表';

-- ----------------------------
-- Records of comm_notetype
-- ----------------------------
INSERT INTO `comm_notetype` VALUES ('1', '我的便签', '1');

-- ----------------------------
-- Table structure for `comm_notice`
-- ----------------------------
DROP TABLE IF EXISTS `comm_notice`;
CREATE TABLE `comm_notice` (
  `n_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '通知公告id',
  `n_ntid` int(10) NOT NULL COMMENT '通知公告分类id',
  `n_title` varchar(500) NOT NULL COMMENT '通知公告标题',
  `n_subhead` varchar(500) NOT NULL COMMENT '通知公告副标题',
  `n_sort` int(10) NOT NULL COMMENT '排序',
  `n_abstract` varchar(2000) NOT NULL COMMENT '通知公告摘要',
  `n_content` text NOT NULL COMMENT '通知公告内容',
  `n_date` datetime NOT NULL COMMENT '通知公告发布日期',
  `n_status` varchar(100) NOT NULL COMMENT '通知公告状态（OPEN:启用；CLOSE：停用）',
  `n_puid` int(10) NOT NULL COMMENT '发布人',
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='通知公告表';

-- ----------------------------
-- Records of comm_notice
-- ----------------------------
INSERT INTO `comm_notice` VALUES ('1', '3', '企业网建注意事项', '', '999', '', '', '0000-00-00 00:00:00', 'OPEN', '1');
INSERT INTO `comm_notice` VALUES ('2', '3', '2222@333', '', '1111', '', '', '0000-00-00 00:00:00', 'OPEN', '1');
INSERT INTO `comm_notice` VALUES ('3', '3', 'SEO注意事项SEO注意事项', 'SEO注意事项', '999', 'SEO注意事项SEO注意事项SEO注意事项\nSEO注意事项SEO注意事项SEO注意事项\nSEO注意事项SEO注意事项SEO注意事项', '<img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/23.gif\" border=\"0\" alt=\"\" />SEO注意事项SEO注意事项<br />\n<br />\n<img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/32.gif\" border=\"0\" alt=\"\" /><br />\n<img src=\"http://api.map.baidu.com/staticimage?center=104.067923%2C30.679943&zoom=11&width=558&height=360&markers=104.067923%2C30.679943&markerStyles=l%2CA\" alt=\"\" />', '0000-00-00 00:00:00', 'OPEN', '1');
INSERT INTO `comm_notice` VALUES ('4', '3', '饭非分反复反复反复反复', '饭非分反复反复反复反复', '999', '饭非分反复反复反复反复饭非分反复反复反复反复饭非分反复反复反复反复\n饭非分反复反复反复反复饭非分反复反复反复反复饭非分反复反复反复反复\n饭非分反复反复反复反复饭非分反复反复反复反复饭非分反复反复反复反复饭非分反复反复反复反复饭非分反复反复反复反复饭非分反复反复反复反复饭非分反复反复反复反复', '饭非分反复反复反复反复饭非分反复反复反复反复饭非分反复反复反复反复<img src=\"http://localhost/plugin/kindeditor/plugins/emoticons/images/21.gif\" border=\"0\" alt=\"\" /><br />\n饭非分反复反复反复反复饭非分反复反复反复反复<img src=\"http://api.map.baidu.com/staticimage?center=121.473704%2C31.230393&zoom=11&width=558&height=360&markers=121.473704%2C31.230393&markerStyles=l%2CA\" alt=\"\" />', '2013-04-14 16:08:04', 'OPEN', '1');
INSERT INTO `comm_notice` VALUES ('5', '3', '8 岁儿童就应该开始学习编程', '我有两个孩子，一个九岁，一个六岁；一个是男孩，一个是女孩。他们接触到了大量的技术。', '1', '如今“学习编程”创业公司如雨后春笋般涌现，但是有一家创业公司开始专注于培训儿童，并在全美小学中取得了一定的成功。', '<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	<img src=\"http://static.oschina.net/uploads/img/201304/14075654_6MmW.jpg\" alt=\"\" /><br />\n在 1991年，克里斯纳-魏达提从印度毕业来到美国。他获得了计算机科学硕士学位，然后在众多创业公司中经历了互联网浪潮，包括他自己创建的一家公司。在经 历过上市、收购和最终倒闭等一系列事件后，他发现自己成熟了十岁，变得聪明了很多。但是，他仍然希望利用技术来解决更重要的问题。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	“我有两个孩子，一个九岁，一个六岁；一个是男孩，一个是女孩。他们接触到了大量的技术。”他昨日在一次电话聊天中说，“但是，他们的学校50年不变。他们总是以各种不同的方式来教授相同的东西。”\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	尤其是在预算较低的学校，一些学习工具按照现代的标准来说早已过时了。魏达提在Code.org网站的同行指出，有很多学校根本就没有技术或计算机科学方面的预算。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	魏达提决定，解决的办法必须是为他们提供免费服务——也就是基于网络的服务，从而让孩子们可以在家里自己练习，而不必劳烦老师们来进行大量的<span class=\"a-tips-Article-QQ\" style=\"margin:0px;padding:0px;\">下载</span>工作。与其他课程不同，它必须以孩子们喜欢的东西为基础。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	“如果你到中学看看，你就会发现孩子们都喜爱游戏；他们都希望自己开发游戏。”他说，“在高中，他们喜欢上了社交互动。因此，在Tynker公司，他们会学到很多有趣的东西，但是他们需要学习编程。”\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	需要澄清的是，这些孩子需要学习编程的逻辑。Tynker公司开发了一种可视化的编程语言；它使用了电脑程序算法的基本元素，而不包含开发者的编程技巧，其中包括花括号和分号等这些看起来无关紧要的东西，但是一旦错位或遗漏，就可能会导致数天或数月的功夫白费。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	“编程规则并不重要。”魏达提说，“这是你可以挑选的东西。可视化编程语言会迫使孩子们思考如何解决问题，如何编写程序。随着时间的推移，他们就会学会编程规则，并慢慢地学会使用PHP或Python语言。”\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	因此，为了让孩子们起步，Tynker公司专注于所有编程语言共有的更为重要的、更为基础的概念，例如如何进行循环，如何解决计算问题以及如何向电脑指派任务。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	总体而言，他说，这完全符合孩子们已被要求学习的STEM内容。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	“电脑科学源于数学。如果他们学习数学，他们也应该学习逻辑学，而这就是学习逻辑的一种方式。我们希望培养孩子们的编程思维，而让编程仅成为一种副产品。”\n</p>', '2013-04-14 16:22:38', 'OPEN', '1');
INSERT INTO `comm_notice` VALUES ('6', '3', '程序员妻子自述: 那些程序员教给我的', '', '1', '我曾经跟朋友开玩笑说，这个时代，有两种人的妻子应该要受人尊敬，第一种是军嫂，这是毫无争议的，第二种就是像我这样的，程序员的老婆', '<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	我曾经跟朋友开玩笑说，这个时代，有两种人的妻子应该要受人尊敬，第一种是军嫂，这是毫无争议的，第二种就是像我这样的，程序员的老婆。当然，这个 玩笑半分自嘲半分真。我的本科是穿着大白褂在各种挂着植物、动物、有机化学、无机化学的门牌的实验室里度过的，在显微镜下给三段生的夹竹桃画过横切片图， 在大头针和解剖剪子的辅助下找过蚯蚓的三条神经，闻过带有臭鸡蛋味的硫化氢气体……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	是的，你们都猜对了，我确实是相貌平平，不修边幅，素面朝天的理科女。见了人就开始习惯性地科普：蝴跟蝶，蜻跟蜓，其实是不一样的，还有，白菜跟萝卜其实都是属于十字花科啦，香港的市花根本就不是紫荆，那是马蹄甲，还有，还有，那个康乃馨的学名其实更好听的，叫石竹花……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	没有人欣赏我。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	因 为没有人在意我在说什么。是啊，我说的那些东西根本就没什么用处，别人还不如去微博上关注科学松鼠会。他们说，女生就应该好好打扮自己嫁个好老公，谁关心 什么纲目科属种。他们说，女生就应该多读点张小娴和亦舒。他们说，女生就应该多学点礼仪和瑜伽。他们说，你要是什么都不会，就学点厨艺啊。他们说，理科的 女生就是木讷，又没有情调，不如去选修一个文科的双学位吧？\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	——为什么呢？\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	——为什么？！你不想嫁个好老公吗？！\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	——哦。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	其 实，虽然我没有读过张小娴和亦舒，但是我读过三毛，读过张爱玲，读过严歌苓，读过杨绛，读过席慕容，读过冰心，读过安妮宝贝，读过七堇年，读过王安忆，读 过《飘》，读过《安娜·卡列尼娜》读过《苏菲的世界》……不是只有清新文学和治愈系才能诠释一个女性啊，难道严肃文学就不能解读一个女性了么？\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	虽然没有学过礼仪，可是我大一就开始报名学习街舞。难道只有学过礼仪的女生才值得被疼惜被怜爱，而一个戴着鸭舌帽跳街舞的女生就应该遭到集体鄙视么？\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	是的，你们都比我聪明，知道我会遇到一个正眼看我的男生。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	他告诉我，你很特别啊，很好啊，不需要改变啊……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	我顿时就觉得他的周围笼罩了耶稣一般的光辉。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	他是个程序员。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	当然我不否认我从小到大确实有被一些审美有问题的男生夸奖过长得好，或许是他们深知白富美不会给予垂怜，像我这样的不入流的长相应该可以徒添他们的自信。但是，从来没有一个人跟我说过那么一句话：\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	你很特别。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	可惜晴天霹雳是个贬义词，不然我真的很想用来形容我当时听到这句话的心情。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	然后呢，然后我就义无返顾地成了一位程序员的老婆。我继续给他科普各种知识，他从来都是饶有兴致地看着我，就算我口沫横飞手舞足蹈他都不会嫌我聒噪。我甚至在他的鼓励下一天一天觉得自己确实长得不错。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	直到有一天，我看到了那个小黑窗，看到了各种在小黑窗上面跳跃的白色字符。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	——这是什么意思啊？\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	——这个表示创建一个目录，这个表示进入这个目录，这个表示查看这个目录的列表内容……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	——哦……我给你洗个苹果吧……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	后来，我们一个房间两台电脑，我们都不知道彼此在做什么。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	后来，我说要不你教教我学编程吧。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	后 来，他告诉我一个网站，里面是《笨办法学python》，告诉我他常常看cnbeta，看爱范儿，看瘾科技，看糗事百科，告诉我他用 google&nbsp;reader，gmail，告诉我什么是单核什么是双核，告诉我什么是bug，告诉我固件指的不是一个固态的硬件而是软件，他送给我手机， 然后帮我刷机，送给我ipod&nbsp;touch然后帮我越狱，给我的电脑里面装上ubuntu……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	他不让我在手机上面贴膜，并花时间跟我解释为什么不需要这么做。也是摔了几次之后他才答应我给手机买个保护壳。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	他常常给我普及隐私的重要性，告诉我要及时备份我的各种文件。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	后来，我陪他看《生活大爆炸》看《行尸走肉》看《生化危机》……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	后来，我陪他逛华强北，逛博物馆，陪他加班……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	后来，我考上了研究生，我们结了婚，分隔两地。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	我开始学习PHP，学习HTML，学习Java，学习Dreamweaver，学习PS……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	然后我开始给身边的女生普及各种计算机知识，陪她们去买电脑，挑手机，告诉她们不要给手机贴膜……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	后来，我认识了很多很多很多程序员。从我的老师到同学，从我的朋友到朋友的朋友，从我读的书里面。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	我从他们身上学到了很多。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	我知道了Steve&nbsp;Jobs，知道了为什么less&nbsp;is&nbsp;more，知道了为什么用户体验那么重要，知道了stay&nbsp;hunger&nbsp;stay&nbsp;foolish.\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	我知道了Steve&nbsp;Krug，知道了为什么面包屑会叫做面包屑，也知道了为什么网页要做得Don’t&nbsp;make&nbsp;me&nbsp;think。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	我还知道了Norman，知道了诺曼门，知道了如果东西使用不便不是我的错，而是设计的问题。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	……\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	我懂得了程序员的幽默。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	看到了不一样的世界。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	我真正开始从心底里肯定自己，也是因为他。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	这是一个好男人带给我的。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	所谓的独立，便是不向别人过多索求，也不过多抱怨。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	很遗憾的是，我没能带给他什么不一样的东西。\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	于是就想起了张卫健那首很老的歌：\n</p>\n<p style=\"margin-top:0px;margin-bottom:15pt;padding:0px;font-family:微软雅黑, Verdana, sans-serif, 宋体;font-size:14px;line-height:22px;white-space:normal;background-color:#FFFFFF;\">\n	“我什么都没有，就是有一点吵，如果你感到寂寞，我带给你热闹……”\n</p>', '2013-04-14 16:25:40', 'OPEN', '1');
INSERT INTO `comm_notice` VALUES ('7', '3', '天天天天天天', '', '-1', '', '', '2013-04-14 16:33:16', 'OPEN', '1');

-- ----------------------------
-- Table structure for `comm_noticetype`
-- ----------------------------
DROP TABLE IF EXISTS `comm_noticetype`;
CREATE TABLE `comm_noticetype` (
  `nt_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '通知公告分类id',
  `nt_pid` int(10) NOT NULL COMMENT '通知公告分类父id',
  `nt_name` varchar(500) NOT NULL COMMENT '通知公告分类名称',
  `nt_code` varchar(50) NOT NULL COMMENT '通知公告分类编码',
  `nt_sort` int(10) NOT NULL COMMENT '排序',
  `nt_remark` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`nt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='通知公告分类表';

-- ----------------------------
-- Records of comm_noticetype
-- ----------------------------
INSERT INTO `comm_noticetype` VALUES ('1', '-1', '成都网联天下通知公告', '', '0', '');
INSERT INTO `comm_noticetype` VALUES ('3', '1', '技术部通知', 'notice_jsb', '0', '大大大大的大大大大大大');
