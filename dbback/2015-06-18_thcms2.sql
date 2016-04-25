-- ----------------------------
-- phpMyAdmin SQL Dump
-- 日期：2015-06-18 18:45:55
-- Power by 李关生(1096831030@qq.com)
-- 用phpMyAdmin导入即可恢复数据库
-- ----------------------------

-- ----------------------------
-- Table structure for `th_access`
-- ----------------------------
DROP TABLE IF EXISTS `th_access`;
CREATE TABLE `th_access` (
  `role_id` smallint(6) NOT NULL COMMENT '角色id',
  `node_id` smallint(6) NOT NULL COMMENT '节点id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Table structure for `th_ad`
-- ----------------------------
DROP TABLE IF EXISTS `th_ad`;
CREATE TABLE `th_ad` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(30) NOT NULL,
  `ad_content` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `m_id` smallint(6) NOT NULL,
  `creattime` int(11) NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='广告位表';

-- ----------------------------
-- Table structure for `th_addarticle`
-- ----------------------------
DROP TABLE IF EXISTS `th_addarticle`;
CREATE TABLE `th_addarticle` (
  `article_id` int(11) NOT NULL COMMENT '文章id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `th_addshop`
-- ----------------------------
DROP TABLE IF EXISTS `th_addshop`;
CREATE TABLE `th_addshop` (
  `article_id` int(11) NOT NULL COMMENT '商品id',
  `shop_rule` text COMMENT '商品规格',
  `shop_three_link` varchar(300) DEFAULT NULL COMMENT '外链接'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `th_addtest`
-- ----------------------------
DROP TABLE IF EXISTS `th_addtest`;
CREATE TABLE `th_addtest` (
  `article_id` int(11) NOT NULL COMMENT '文章id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `th_admin`
-- ----------------------------
DROP TABLE IF EXISTS `th_admin`;
CREATE TABLE `th_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `creattime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Table structure for `th_article`
-- ----------------------------
DROP TABLE IF EXISTS `th_article`;
CREATE TABLE `th_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL COMMENT '栏目id',
  `title` varchar(150) NOT NULL COMMENT '标题',
  `litpic` varchar(150) NOT NULL,
  `litpics` text COMMENT '详情页多图',
  `description` varchar(250) NOT NULL COMMENT '简介',
  `content` text NOT NULL COMMENT '内容',
  `creattime` int(11) NOT NULL COMMENT '添加时间',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '排序',
  `c` tinyint(1) NOT NULL COMMENT '是否推荐',
  `h` tinyint(1) NOT NULL COMMENT '是否头条',
  `status` tinyint(4) NOT NULL,
  `m_id` tinyint(4) NOT NULL,
  `click` int(11) NOT NULL COMMENT '点击数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=162 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='文章表';

-- ----------------------------
-- Table structure for `th_article_type`
-- ----------------------------
DROP TABLE IF EXISTS `th_article_type`;
CREATE TABLE `th_article_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `topid` smallint(6) NOT NULL COMMENT '顶级栏目id',
  `typename` varchar(150) NOT NULL,
  `subtitle` varchar(30) NOT NULL COMMENT '副标题',
  `type` char(10) NOT NULL COMMENT '栏目类型',
  `model` char(10) NOT NULL COMMENT '模型',
  `typetpl` varchar(50) NOT NULL COMMENT '栏目模板',
  `viewtpl` varchar(50) NOT NULL COMMENT '内容模板',
  `pagetpl` varchar(50) NOT NULL,
  `typelink` varchar(150) NOT NULL,
  `litpic` varchar(150) NOT NULL COMMENT '栏目缩略图',
  `typedesc` varchar(400) NOT NULL,
  `typecontent` text NOT NULL,
  `page` smallint(5) DEFAULT '10',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(11) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `keyword` varchar(250) NOT NULL COMMENT '栏目关键字',
  `m_id` tinyint(4) NOT NULL COMMENT '管理员id',
  `creattime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='栏目表';

-- ----------------------------
-- Table structure for `th_flink`
-- ----------------------------
DROP TABLE IF EXISTS `th_flink`;
CREATE TABLE `th_flink` (
  `flink_id` int(11) NOT NULL AUTO_INCREMENT,
  `flink_name` varchar(100) DEFAULT NULL COMMENT '友情链接名称',
  `flink_link` varchar(150) DEFAULT NULL COMMENT '友情链接路径',
  `flink_logo` varchar(100) DEFAULT NULL COMMENT 'logo图标',
  `m_id` smallint(5) DEFAULT NULL COMMENT '管理员id',
  `creattime` int(11) DEFAULT NULL COMMENT '添加时间',
  `sort` smallint(5) DEFAULT '50' COMMENT '排序',
  `status` tinyint(2) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`flink_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `th_member`
-- ----------------------------
DROP TABLE IF EXISTS `th_member`;
CREATE TABLE `th_member` (
  `member_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_group_id` smallint(5) DEFAULT NULL COMMENT '会员组id',
  `member_account` varchar(50) DEFAULT NULL COMMENT '会员账号',
  `member_nickname` varchar(100) DEFAULT NULL COMMENT '会员昵称',
  `member_password` varchar(50) DEFAULT NULL COMMENT '会员密码',
  `member_face` varchar(100) DEFAULT NULL,
  `member_sex` char(5) DEFAULT NULL COMMENT '性别',
  `member_phone` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `member_tel` varchar(20) DEFAULT NULL COMMENT '座机',
  `member_email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `member_blog_account` varchar(50) DEFAULT NULL COMMENT '博客账号',
  `member_qq_account` varchar(50) DEFAULT NULL COMMENT 'QQ账号',
  `member_register_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `member_status` varchar(10) DEFAULT NULL COMMENT '会员状态/y为正常/n为禁止登陆/check为等待审核',
  `member_last_logintime` int(11) DEFAULT NULL COMMENT '会员上次登录时间',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='会员表';

-- ----------------------------
-- Table structure for `th_member_group`
-- ----------------------------
DROP TABLE IF EXISTS `th_member_group`;
CREATE TABLE `th_member_group` (
  `group_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员组id',
  `group_name` varchar(30) DEFAULT NULL COMMENT '会员组名称',
  `m_id` smallint(2) DEFAULT NULL COMMENT '管理员id',
  `creattime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `th_message`
-- ----------------------------
DROP TABLE IF EXISTS `th_message`;
CREATE TABLE `th_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL COMMENT '留言者名称',
  `phone` varchar(20) DEFAULT NULL COMMENT '留言者手机',
  `email` varchar(20) DEFAULT NULL COMMENT '留言者邮箱',
  `address` varchar(50) DEFAULT NULL COMMENT '留言者地址',
  `sex` varchar(2) DEFAULT NULL COMMENT '留言者性别',
  `content` text COMMENT '留言内容',
  `addtime` int(11) DEFAULT NULL COMMENT '留言时间',
  `status` tinyint(2) DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='留言表';

-- ----------------------------
-- Table structure for `th_model`
-- ----------------------------
DROP TABLE IF EXISTS `th_model`;
CREATE TABLE `th_model` (
  `model_id` smallint(4) NOT NULL AUTO_INCREMENT COMMENT '模型id',
  `model_name` varchar(20) NOT NULL COMMENT '模型名称',
  `model_list_tpl` varchar(50) NOT NULL COMMENT '模型列表模板',
  `model_view_tpl` varchar(50) NOT NULL COMMENT '模型视图模板',
  `model_page_tpl` varchar(50) DEFAULT NULL COMMENT '单页模板',
  `model_addfile` varchar(30) NOT NULL COMMENT '附加字段的文件名',
  `model_addtable` varchar(30) NOT NULL COMMENT '附加表名',
  `model_status` tinyint(4) NOT NULL COMMENT '状态,1为启用，0为禁用',
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `th_node`
-- ----------------------------
DROP TABLE IF EXISTS `th_node`;
CREATE TABLE `th_node` (
  `node_id` int(11) NOT NULL AUTO_INCREMENT,
  `node_type_id` smallint(6) NOT NULL COMMENT '节点分类id',
  `node_name` varchar(30) NOT NULL COMMENT '节点名称',
  `m_id` int(11) NOT NULL,
  `creattime` int(11) NOT NULL,
  PRIMARY KEY (`node_id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
-- Table structure for `th_node_type`
-- ----------------------------
DROP TABLE IF EXISTS `th_node_type`;
CREATE TABLE `th_node_type` (
  `node_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `node_type_name` varchar(30) NOT NULL,
  `m_id` smallint(6) NOT NULL,
  `creattime` int(11) NOT NULL,
  PRIMARY KEY (`node_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='节点类型表';

-- ----------------------------
-- Table structure for `th_role`
-- ----------------------------
DROP TABLE IF EXISTS `th_role`;
CREATE TABLE `th_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Table structure for `th_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `th_role_user`;
CREATE TABLE `th_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `th_rotation`
-- ----------------------------
DROP TABLE IF EXISTS `th_rotation`;
CREATE TABLE `th_rotation` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` tinyint(3) unsigned NOT NULL,
  `title` varchar(150) NOT NULL COMMENT '广告标题',
  `link` varchar(150) NOT NULL COMMENT '第三方链接',
  `litpic` varchar(150) NOT NULL COMMENT '轮换图',
  `sort` tinyint(3) unsigned NOT NULL COMMENT '排序',
  `status` tinyint(4) NOT NULL COMMENT '状态',
  `m_id` tinyint(4) NOT NULL,
  `creattime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='轮换图内容表';

-- ----------------------------
-- Table structure for `th_rotation_type`
-- ----------------------------
DROP TABLE IF EXISTS `th_rotation_type`;
CREATE TABLE `th_rotation_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rotation_type_name` varchar(150) NOT NULL COMMENT '轮换图分类名称',
  `m_id` tinyint(4) NOT NULL COMMENT '管理员id',
  `creattime` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='轮换图专用表';

-- ----------------------------
-- Records for `th_access`
-- ----------------------------
INSERT INTO `th_access` VALUES ('2', '39');
INSERT INTO `th_access` VALUES ('2', '38');
INSERT INTO `th_access` VALUES ('2', '37');
INSERT INTO `th_access` VALUES ('2', '36');
INSERT INTO `th_access` VALUES ('2', '35');
INSERT INTO `th_access` VALUES ('2', '34');
INSERT INTO `th_access` VALUES ('2', '29');
INSERT INTO `th_access` VALUES ('2', '27');
INSERT INTO `th_access` VALUES ('2', '32');
INSERT INTO `th_access` VALUES ('2', '26');
INSERT INTO `th_access` VALUES ('24', '29');
INSERT INTO `th_access` VALUES ('24', '27');
INSERT INTO `th_access` VALUES ('24', '26');
INSERT INTO `th_access` VALUES ('24', '24');
INSERT INTO `th_access` VALUES ('24', '23');
INSERT INTO `th_access` VALUES ('24', '22');
INSERT INTO `th_access` VALUES ('24', '18');
INSERT INTO `th_access` VALUES ('24', '12');
INSERT INTO `th_access` VALUES ('24', '11');
INSERT INTO `th_access` VALUES ('24', '10');
INSERT INTO `th_access` VALUES ('21', '29');
INSERT INTO `th_access` VALUES ('21', '27');
INSERT INTO `th_access` VALUES ('2', '25');
INSERT INTO `th_access` VALUES ('2', '24');
INSERT INTO `th_access` VALUES ('2', '23');
INSERT INTO `th_access` VALUES ('2', '22');
INSERT INTO `th_access` VALUES ('21', '26');
INSERT INTO `th_access` VALUES ('21', '25');
INSERT INTO `th_access` VALUES ('21', '24');
INSERT INTO `th_access` VALUES ('21', '23');
INSERT INTO `th_access` VALUES ('21', '22');
INSERT INTO `th_access` VALUES ('21', '20');
INSERT INTO `th_access` VALUES ('21', '18');
INSERT INTO `th_access` VALUES ('21', '16');
INSERT INTO `th_access` VALUES ('21', '15');
INSERT INTO `th_access` VALUES ('21', '14');
INSERT INTO `th_access` VALUES ('21', '12');
INSERT INTO `th_access` VALUES ('21', '11');
INSERT INTO `th_access` VALUES ('21', '10');
INSERT INTO `th_access` VALUES ('21', '4');
INSERT INTO `th_access` VALUES ('21', '2');
INSERT INTO `th_access` VALUES ('1', '2');
INSERT INTO `th_access` VALUES ('1', '3');
INSERT INTO `th_access` VALUES ('1', '4');
INSERT INTO `th_access` VALUES ('1', '5');
INSERT INTO `th_access` VALUES ('1', '6');
INSERT INTO `th_access` VALUES ('1', '7');
INSERT INTO `th_access` VALUES ('1', '8');
INSERT INTO `th_access` VALUES ('1', '9');
INSERT INTO `th_access` VALUES ('1', '31');
INSERT INTO `th_access` VALUES ('1', '10');
INSERT INTO `th_access` VALUES ('1', '11');
INSERT INTO `th_access` VALUES ('1', '12');
INSERT INTO `th_access` VALUES ('1', '13');
INSERT INTO `th_access` VALUES ('1', '14');
INSERT INTO `th_access` VALUES ('1', '15');
INSERT INTO `th_access` VALUES ('1', '16');
INSERT INTO `th_access` VALUES ('1', '17');
INSERT INTO `th_access` VALUES ('1', '18');
INSERT INTO `th_access` VALUES ('1', '19');
INSERT INTO `th_access` VALUES ('1', '20');
INSERT INTO `th_access` VALUES ('1', '21');
INSERT INTO `th_access` VALUES ('1', '22');
INSERT INTO `th_access` VALUES ('1', '23');
INSERT INTO `th_access` VALUES ('1', '24');
INSERT INTO `th_access` VALUES ('1', '25');
INSERT INTO `th_access` VALUES ('1', '26');
INSERT INTO `th_access` VALUES ('1', '32');
INSERT INTO `th_access` VALUES ('1', '27');
INSERT INTO `th_access` VALUES ('1', '28');
INSERT INTO `th_access` VALUES ('1', '29');
INSERT INTO `th_access` VALUES ('1', '30');
INSERT INTO `th_access` VALUES ('2', '20');
INSERT INTO `th_access` VALUES ('2', '18');
INSERT INTO `th_access` VALUES ('2', '17');
INSERT INTO `th_access` VALUES ('2', '16');
INSERT INTO `th_access` VALUES ('2', '15');
INSERT INTO `th_access` VALUES ('2', '14');
INSERT INTO `th_access` VALUES ('2', '13');
INSERT INTO `th_access` VALUES ('2', '12');
INSERT INTO `th_access` VALUES ('2', '11');
INSERT INTO `th_access` VALUES ('2', '10');
INSERT INTO `th_access` VALUES ('2', '31');
INSERT INTO `th_access` VALUES ('2', '9');
INSERT INTO `th_access` VALUES ('2', '8');
INSERT INTO `th_access` VALUES ('23', '15');
INSERT INTO `th_access` VALUES ('23', '16');
INSERT INTO `th_access` VALUES ('23', '17');
INSERT INTO `th_access` VALUES ('23', '18');
INSERT INTO `th_access` VALUES ('23', '19');
INSERT INTO `th_access` VALUES ('23', '20');
INSERT INTO `th_access` VALUES ('23', '21');
INSERT INTO `th_access` VALUES ('23', '22');
INSERT INTO `th_access` VALUES ('23', '23');
INSERT INTO `th_access` VALUES ('23', '24');
INSERT INTO `th_access` VALUES ('23', '25');
INSERT INTO `th_access` VALUES ('23', '26');
INSERT INTO `th_access` VALUES ('23', '32');
INSERT INTO `th_access` VALUES ('23', '27');
INSERT INTO `th_access` VALUES ('23', '28');
INSERT INTO `th_access` VALUES ('23', '29');
INSERT INTO `th_access` VALUES ('23', '30');
INSERT INTO `th_access` VALUES ('2', '7');
INSERT INTO `th_access` VALUES ('2', '6');
INSERT INTO `th_access` VALUES ('2', '5');
INSERT INTO `th_access` VALUES ('2', '4');
INSERT INTO `th_access` VALUES ('2', '3');
INSERT INTO `th_access` VALUES ('2', '2');
INSERT INTO `th_access` VALUES ('2', '40');
INSERT INTO `th_access` VALUES ('2', '41');
INSERT INTO `th_access` VALUES ('2', '42');
INSERT INTO `th_access` VALUES ('2', '43');
INSERT INTO `th_access` VALUES ('2', '44');
INSERT INTO `th_access` VALUES ('2', '45');
INSERT INTO `th_access` VALUES ('2', '46');
INSERT INTO `th_access` VALUES ('2', '47');

-- ----------------------------
-- Records for `th_ad`
-- ----------------------------
INSERT INTO `th_ad` VALUES ('8', '头部logo', '<p>
	<img src="/upload/image/20150410/1428596655409404.png" title="长沙心安装饰工程有限公司" alt="长沙心安装饰工程有限公司" width="218" height="79" border="0" style="width:218px;height:79px;" />
</p>', '1', '1', '1427378504');

-- ----------------------------
-- Records for `th_addshop`
-- ----------------------------
INSERT INTO `th_addshop` VALUES ('161', '222', '3123');

-- ----------------------------
-- Records for `th_admin`
-- ----------------------------
INSERT INTO `th_admin` VALUES ('1', 'admin', 'f5fd864e4b31818b9e9c9bb1787b309d', 'y', '1426827647');
INSERT INTO `th_admin` VALUES ('21', 'tenghoo', '21232f297a57a5a743894a0e4a801fc3', 'y', '1426946954');
INSERT INTO `th_admin` VALUES ('23', '小编', '21232f297a57a5a743894a0e4a801fc3', 'y', '1427619130');
INSERT INTO `th_admin` VALUES ('24', '小二', '21232f297a57a5a743894a0e4a801fc3', 'y', '1427619418');

-- ----------------------------
-- Records for `th_article`
-- ----------------------------
INSERT INTO `th_article` VALUES ('45', '53', '电脑放置的风水1122', '', '', ' 电脑在我们的生活工作中的作用，已经到了地球人都知道的程度了，如果说普通上班族的电脑，还是上班时间之用的话；对搜狐一族，宅男宅女来说，电脑就是他们的生命线，一日无鱼，三日', '<p>
	电脑在我们的生活工作中的作用，已经到了地球人都知道的程度了，如果说普通上班族的电脑，还是上班时间之用的话；对搜狐一族，宅男宅女来说，电脑就是他们的生命线，一日无鱼，三日无肉都可以忍受，唯独不能承受离开电脑。电脑已经成了他们生命中<span style="line-height:2;">不可或缺的一员了。想一想，电脑对他们的影响会有多大。电脑的影响不仅仅是其辐射可能对人的健康产生影响，而且电脑的摆放位置，方向，还会对风水产生作用，从而对人的运势产生影响。我们从家居电脑的摆放位置、方位，来讲讲电脑风水可能会带来的后果，大家不妨结合自己家的实际情况来看看。 </span> 
</p>
<p>
	<br />
</p>
<p>
	1、请勿将电脑置于你的喜用神方向。
</p>
<p>
	电脑置于喜用神方向，会压制你的贵人；如果你的命理还忌火的话，那就更要小心了。 举个例子，比如说你的喜用神为东方，你的命理忌火，你还把电脑放在了东方，这样的话木生火旺，对你的运势会产生极为不利的影响。
</p>
<p>
	<br />
</p>
<p>
	2、电脑最好放在电脑桌的左边。
</p>
<p>
	这对经常依靠电脑工作的人而言，是比较理想的方位。按风水方位学来说，就是“龙怕臭，虎怕动”，左方是吉方，放电脑最恰当。
</p>
<p>
	<br />
</p>
<p>
	3、电脑对床者为电脑摆放大忌
</p>
<p>
	电脑的显示器如果正对住了卧床，会影响人的精神和睡眠质量，建议最好做出调整。
</p>
<p>
	<br />
</p>
<p>
	4、电脑要避免阳光直射
</p>
<p>
	电脑放置的地方容易受到太阳直射的话，最易招惹是非，容易有口舌之争；但如果摆放在阴暗的地方，也容易情绪低沉，影响工作状态。
</p>
<p>
	<br />
</p>
<p>
	5、避免电脑摆放在空气不流畅的地方
</p>
<p>
	电脑最好摆放在空气比较流通的地方，这样不仅可以减小电脑的辐射，也不会对主人有太多影响；如果是摆在一个空气不太流通的地方会造你对外界反应缓慢，思路不清晰。
</p>
<p>
	<br />
</p>
<p>
	6、电脑位置一定要远离水池、鱼缸等近水的地方。
</p>
<p>
	近水的地方，容易让电脑受潮不说，还容易水火相克，诱发心血管类疾病。
</p>
<p>
	<br />
</p>
<p>
	7、电脑周围不要摆放太多杂物
</p>
<p>
	电脑周围有太多杂物，容易让人分心，产生杂念，无法专心工作。
</p>
<p>
	<br />
</p>
<p>
	8、显示器最好与空间匹配
</p>
<p>
	如果房间太小而却用了较大的显示器，容易造成亲朋疏远，同事远离，领导不太重视的情况；反之，如果房间大却用小的显示器，则容易被人忽略，甚至看不起。所以在显示器的选择上不是越大越好，而是与空间相匹配为宜。
</p>
<p>
	<br />
</p>', '1428599553', '50', '1', '0', '1', '1', '50');
INSERT INTO `th_article` VALUES ('36', '52', '美观、实用和安全以外，还要注意合理的空间规划', '', '', ' 我们打造出一个很好的办公 环境就能很好的提高我们企业员工的情绪，那么员工的工作效率就会有很大的提升， 这也就是在为我们企业创造更多的经济效益。 我们都知道办公室是来我们企业', '<p>&nbsp;　　我们打造出一个很好的办公 环境就能很好的提高我们企业员工的情绪，那么员工的工作效率就会有很大的提升， 这也就是在为我们企业创造更多的经济效益。</p><p>&nbsp;</p><p>　　我们都知道办公室是来我们企业拜访的拜访者看到我们企业的第一印象，那么我们办公室的设计效果第一印象是很重要的，这关系着我们企业的形象问题，那就是关系到我们企业的经济效益。所以我们必须提高办公室的环境。</p><p>&nbsp;</p><p>　　办公室设计是为我们办公室环境来做个很好的规划，能给我们先展示出我们未来办公室的环境会是怎样的。办公室设计我们要根据我们企业的性质和我们企业的文化来做，做出符合我们企业的最好的方案，当然我们在做设计时我们也要兼顾到对我们企业员工情绪的影响。</p><p>&nbsp;</p><p>　　最后，就是对企业办公空间整体设计与规划了，办公室除了美观，实用及安全外，还要充分考虑环境景观的设计，办公室装潢动线规划，噪音处理及搭配等等，一个完美的办公空间设计，不仅可以为客户增加工作效率，而且还能提升企业的整体形象。</p><p>&nbsp;</p><p><br/></p>', '1428599341', '50', '1', '0', '1', '1', '15');
INSERT INTO `th_article` VALUES ('37', '52', '尽量使办公室设计方案适合于各种需求', '', '', ' 所谓办公场所，实际上就是那些现代白领人士赖以度过其大半生的地方。从这个意义上来讲，实用性和功能性紧密相关的内部空间格局尚需配有一种舒适的办公氛围，以便使办事功能、效率的', '<p>　　所谓办公场所，实际上就是那些现代白领人士赖以度过其大半生的地方。从这个意义上来讲，实用性和功能性紧密相关的内部空间格局尚需配有一种舒适的办公氛围，以便使办事功能、效率的提高以及创造性的工作形式得以在这种环境里集中地体现出来。</p><p>&nbsp;</p><p>　　在开放式办公室设计上，应体现方便、舒适、亲情、明快、简洁的特点，门厅入口应有企业形象的符号、展墙及有接待功能的设施，高层管理小型办公室设计则应追求领域性、稳定性、文化性和实力感。一般情况下紧连高层管理办公室的功能空间有秘书、财务、下层主管等核心部门。开放式办公空间有大中小之分。</p><p>&nbsp;</p><p>　　设计公司应对与其设计方案有关的信息资料进行调查分析与研究。他应走访那些相似的工程现场，广纳各种信息资料，甚至于就某些特殊的要求直接与那些工作于此类办公场所的工作人员进行面对面的接触，以便使其设计方案适合于各种需求。</p><p>&nbsp;</p><p>　　同时在办公室装修设计中他们更多想到的是环保，因为办公室无疑是现代人的第二生命，可以抛开很多没有必要的装点，但是在环保材料上是不惜代价的，现在的社会处处充满了竞争和压力，人们在办公室的时间越来越长，所以健康是人们关注的首要问题，都要在环保材料这个环节上特别关注。</p><p><br/></p>', '1428599360', '50', '1', '0', '1', '1', '15');
INSERT INTO `th_article` VALUES ('38', '52', '美化办公室的同时要注意体现企业文化', '', '', ' 办公空间布局是一个非常重要的工作，经过研究发现，最大的因素影响员工的工作效率的是照明环境，其次是办公家具对员工影响很大，办公家具也是决定办公室员工的生产效率的重要元素，', '<p>　　办公空间布局是一个非常重要的工作，经过研究发现，最大的因素影响员工的工作效率的是照明环境，其次是办公家具对员工影响很大，办公家具也是决定办公室员工的生产效率的重要元素，所以，当办公室装修置办办公家具的时候，根据可用的空间确保办公家具满足员工的需求。</p><p>&nbsp;</p><p>　　当装修完成之后我们可能会觉得需要将办公室进一步的美化，主要是为了体现出企业的文化，企业老板的品味，这个时候就要注意到办公室的一些物品的选择和摆放，现在的很多办公家具不但具备了实用性，也具备了观赏性。</p><p>&nbsp;</p><p>　　很多办公室在装修过程中，因为规模小，弱电改造(包括网线和电话线)往往不会请专门的综合布线的公司来做。这时就要特别注意，数据和语音的标签一定要在放线的时候做好，不给后续工作带来麻烦。</p><p>&nbsp;</p><p>　　在办公室空间规划中一些小的细节也是非常重要的，办公室墙面、夹具、配件、装饰品等方面的装修都能够影响到办公室的整体风格效果，一个计划好的办公室只有当所有这些方面都取得协调，确保所有方面，其中包括购买家具，装饰品，墙面等整体看上去均匀、和谐。</p><p><br/></p>', '1428599377', '50', '1', '0', '1', '1', '15');
INSERT INTO `th_article` VALUES ('39', '52', '不同行业办公室的设计差异', '', '', ' 办公室设计是室内设计的一个分支，现在室内设计一直在提倡创意，但是究竟怎么能才算是有创意，这个要靠设计师自己把握的。 办公室装修设计就是为了提高办公效率的，因此他应该随着人', '<p>　 &nbsp;办公室设计是室内设计的一个分支，现在室内设计一直在提倡创意，但是究竟怎么能才算是有创意，这个要靠设计师自己把握的。</p><p>&nbsp;</p><p>　　办公室装修设计就是为了提高办公效率的，因此他应该随着人们审美还有生活状态的改变而改变，不然他就达不到社会赋予他的责任。时尚特性就是现代办公室所缺少的，特别是有一些新型的工作类型的办公室装修设计，不够时尚就无法刺激灵感。</p><p>&nbsp;</p><p>　　这是一个推崇个性的时代，办公室设计公司作品如果没有个性，不够时尚是很难吸引到新的力量的，而且也不能够对身处其中的工作人员产生好的影响，更不用说提高工作效率，特别是一些白领阶层和一些时尚类工作，他们对于生活环境是十分挑剔的，没有一个时尚的空间，他们是很难待下来的。</p><p>&nbsp;</p><p>　　我们可以在办公室装修设计的时候充分发掘这种特性，让人们在一个简洁大方的环境之中努力地工作，从而提升工作效率。调节、遮阳隔热等。</p><p><br/></p>', '1428599401', '50', '1', '0', '1', '1', '15');
INSERT INTO `th_article` VALUES ('40', '52', '办公室设计就是要有个好的规划111113333', '', '', ' 办公室是人们办公的场所，所以办公室室内的环境就显得尤为重要了，那么怎么才能让办公室的环境变得更舒适呢？ 办公室装修设计，办公室是一个很费脑力的一地方，办公室必定得是一个安', '<p>
	办公室是人们办公的场所，所以办公室室内的环境就显得尤为重要了，那么怎么才能让办公室的环境变得更舒适呢？
</p>
<p>
	<br />
</p>
<p>
	办公室装修设计，办公室是一个很费脑力的一地方，办公室必定得是一个安静优雅的场所，所以办公室装修设计的隔音问题就很重要了，比如在办公室可以配布窗帘，布窗帘是一个非常好的吸音效果，质地以棉、麻为佳。质量好的卷帘和百叶帘与窗户贴合紧密，也具有一定的隔音功能。而且这些设施也是很的装饰，与崇尚简约风格的现代办公楼装修设计感觉十分协调。
</p>
<p>
	<br />
</p>
<p>
	办公室设计是为我们办公室环境来做个很好的规划，能给我们先展示出我们未来办公室的环境会是怎样的。办公室设计我们要根据我们企业的性质和我们企业的文化来做，做出符合我们企业的最好的方案，当然我们在做设计时我们也要兼顾到对我们企业员工情绪的影响。
</p>
<p>
	<br />
</p>
<p>
	办公室设计是我们为我们企业做的最简单最容易的一件事，但如果公司办公室设计做好的话那就是能为我的活力的。
</p>
<p>
	<br />
</p>', '1428599422', '50', '1', '0', '1', '1', '15');
INSERT INTO `th_article` VALUES ('41', '53', '家庭装修风水,普及客厅装修知识', '', '', ' 客厅在新房装修中是特别重要装修的地方，是家人公共休息、休闲、娱乐的场所。客厅的风水也是对一家人运势影响最大的地方。你或许不知道的客厅装修禁忌： 1、客厅格局宜方正 客厅的格', '<p>　　客厅在新房装修中是特别重要装修的地方，是家人公共休息、休闲、娱乐的场所。客厅的风水也是对一家人运势影响最大的地方。你或许不知道的客厅装修禁忌：</p><p>&nbsp;</p><p>　　1、客厅格局宜方正</p><p>　　客厅的格局最好是正方形或长方形，座椅区不可冲煞到屋角，沙发不可压梁。如果有突出的屋角放出暗箭，可摆设盆景或家俱化解。如果客厅呈L形，可用家俱将之隔成两个方形区域，视为两个独立的房间。例如，可将一个区域当成会客室，另一个区域当成起居室。</p><p>&nbsp;</p><p>　　2、大门与客厅应设玄关</p><p>　　风水要诀“喜回旋、忌直冲”。大门与客厅设置玄关或矮柜遮档，使内外有所缓冲，理气得以回旋后聚集于客厅，住宅内部也得到隐蔽，外边不易窥探。住宅内部隐蔽深藏，象征福气绵延。</p><p>&nbsp;</p><p>　　3、客厅间隔、房主孤独</p><p>　　从位置上说客厅是家人共用的场所，若因客厅宽敞而隔一部分做卧房在堪舆学上称为“自裁”，抽象点来说就是人为地将一个带公共活动的磁场空间“裁剪”了，在这“裁剪”小卧室里面休息的人，容易造成心态上的孤独感，如果是未婚者居住更难免有“知音难寻”之忧。</p><p>&nbsp;</p><p>　　4、财位不宜泄</p><p>　　进门客厅的对角线为峦头堪舆学上的财位，此处如果有柱子、凹位，窗户、可用植物、酒柜、饰柜阻挡，一方面令“财气”不致外漏，另一方面可以塑造出一个良好的财位，一举二得。</p><p>&nbsp;</p><p>　　5、横梁当头压抑</p><p>　　如果客厅内正好被横梁所“压”，巨大的心理压抑会令屋内人会在社会上备受压抑，难于得志，遇到这种情况可以用假天花遮盖或在梁上悬挂福鼠饰品加以化解或者在装修上设计成两个客厅。</p><p>&nbsp;</p><p>　　6、沙发成套才和谐</p><p>　　一般沙发肯定是整套摆设的，但不排除有些朋友因为空间大而将两套沙发放在一起或在一套沙发外再加放零散的沙发椅，这些做法在堪舆学上说是不利家人和睦的，因为摆放完整一套的沙发喻意着全家人上下一心，团结一致。</p><p>&nbsp;</p><p>　　7、前通后通、人财两空</p><p>　　从空间上说客厅的动线最宜开阔，视野一眼望穿让人心境豁达，所以入门处不宜看到房间门和后门，否则便有“前进后出”、“无法聚财之患”;另外，走道也应避免直向或横向贯穿整个客厅，这种家相正好应了一句堪舆俗语“前通后通，人财两空”。</p><p><br/></p>', '1428599470', '50', '0', '0', '1', '1', '9');
INSERT INTO `th_article` VALUES ('42', '53', '金九银十结婚季，你家婚房怎么装', '', '', ' 家居室内的布置是非常重要的一个环节，家居内部我们都需要天天接触，他的风水效果并非外局所能比的。住宅的内部受到很多因素的牵扯，比如颜色布局、建材种类、光线照射、物品的凶吉', '<p>　　家居室内的布置是非常重要的一个环节，家居内部我们都需要天天接触，他的风水效果并非外局所能比的。住宅的内部受到很多因素的牵扯，比如颜色布局、建材种类、光线照射、物品的凶吉、动感设计等等，都是我们需要注意的一些因素。现在东易日盛小编就其中一些因素给大家予以说明。</p><p>&nbsp;</p><p><strong>　　【厕所忌在房屋中央位置】</strong></p><p>　　风水常说：中间污秽，一些房间的布局中央位置是厕所，在阳宅中被称为“污秽” ，应该及时避免。</p><p>&nbsp;</p><p><strong>　　【阳光充足】</strong></p><p>　　阳光充足的房间不仅仅对人身体好，在风水上阴暗较多的住宅也是极其不好的，就算是安装灯光去弥补，也不能修正内居。</p><p>&nbsp;</p><p>　　<strong>【内部线条要流畅</strong>】</p><p>　　东线流畅是内部布局第一应考量的事，一些刚刚学习阳宅的新手，为了得取心中理想的方位，内部线条修改的迂回难行，造成磁场紊乱。</p><p>&nbsp;</p><p><strong>　　【房间不宜过小】</strong></p><p>　　一些地产公司为了赢取大众的心理，把小面积的房间硬是挤成了三居室，房间非常小，放一张床之后几乎没有转身的余地，就会造成“气”进不来，就更称不上吉了。</p><p>&nbsp;</p><p><strong>　　【房顶不宜过低】</strong></p><p>　　楼层低压：早期有些房屋每层奇低无比，天花板装璜之后，头快顶到天了，这也要避免。</p><p>&nbsp;</p><p><strong>　　【鱼缸不宜过大】</strong></p><p>　　鱼缸：鱼缸在内部格局应用上相当普遍，除了造景之外，有隔间、化煞、催财等作用，加上灯光之后又有消除阴暗之效果。要注意的是水要保持干净，鱼缸要常清洗，鱼若有死亡应立及除去。鱼缸也不宜过大，以免造成室内湿气太大。</p><p><br/></p>', '1428599491', '50', '0', '0', '1', '1', '13');
INSERT INTO `th_article` VALUES ('43', '53', '家居风水招财——9大禁忌你必须知道', '', '', ' 财位要明亮 家里的财位要明亮，不能经常处在黑暗的地方，打开灯光这个地方不能有暗影，要灯光能直射到这里，因为明亮则财运顺。昏暗不利于财运，且会使得运势上出现不稳的状况。 ·财', '<p>　　财位要明亮</p><p>　　家里的财位要明亮，不能经常处在黑暗的地方，打开灯光这个地方不能有暗影，要灯光能直射到这里，因为明亮则财运顺。昏暗不利于财运，且会使得运势上出现不稳的状况。</p><p>&nbsp;</p><p>　　·财位要适合坐</p><p>　　家里的财位下面如果是沙发或者椅子，自己人可以经常坐在下面，可以多带一些财气在身上。财位下面这个位置尽量不要让客户或者外人去坐，否则家里的财气可能会被外人带走。</p><p>&nbsp;</p><p>　　·财位适合睡</p><p>　　财位的下面也可是是床，人的一生大多数时间是在床上度过的，所以床位的凶吉对我们的运势有很大的影响，如果能够在财位上睡一睡，对我们的财运有很大的帮助。</p><p>&nbsp;</p><p>　　·财位招吉祥物品</p><p>我们如果可以再财位那里摆放一些吉祥的物件、工艺品等，会给财位锦上添花，吉上加吉。特别是碗装的黄金，吸财力会更大。</p><p>&nbsp;</p><p>&nbsp;</p><p>　　·财位要有生机</p><p>　　我们可以放一些枝繁叶茂的植被，但是要留意，这些植物需要是泥土里生长出来的，切勿摆放水生养出来的植物，因为水生养则意味着根基不稳。财位不要摆放有刺的类似仙人掌之类的植物，植物选用叶片较大的阔叶类植物，大叶的植物寓意大展宏图。</p><p>&nbsp;</p><p>　　·财位忌放沉重物品</p><p>　　财位受压是绝对不适宜的，大的衣柜、书柜等沉重物压在财位上，那将会对全家和整个公司的财运不利，还会整天感到压力重重，为财而累。</p><p>&nbsp;</p><p>　　·财位后要为实物</p><p>　　财位背后应该为墙，因为象征着财运上有靠山，保证无后顾之忧，这样才可藏风聚气。避免后面是空空的玻璃，如果是窗户，这个位置的窗户要尽量少打开，以避免向外散财，一定要让这个位聚住气。</p><p>&nbsp;</p><p>　　·财位上忌尖角物品</p><p>&nbsp;</p><p>　　·保持干净</p><p>　　风水学最忌尖角冲射，财位附近不要有尖角物，还应尽量避免摆放有尖角的物品。尖角类的物品会把财运冲走。</p><p>　　平时要注意打扫一下财位上的灰尘，保持干净一些，不要堆放杂物和放垃圾筒等，要移走，否则会污损财位，令财运大打折扣。</p><p><br/></p>', '1428599511', '50', '1', '0', '1', '1', '12');
INSERT INTO `th_article` VALUES ('44', '53', '办公室风水的植物摆放', '', '', ' 从事多年办公风水的大师对办公室装修风水中植物摆放的建议： 1、东方五行属木，震卦，紫气东来：东方摆放红色的花对文案策划、编辑人员以及所有动脑工作的人员有利。 2、西方五行属金', '<p>　　从事多年办公风水的大师对办公室装修风水中植物摆放的建议：</p><p>　　1、东方五行属木，震卦，紫气东来：东方摆放红色的花对文案策划、编辑人员以及所有&quot;动脑&quot;工作的人员有利。</p><p>　　2、西方五行属金，兑卦，西方摆白、黄颜色的花可增加以“口”为生人员的&quot;锐气&quot;，比如如律师、销售、艺术家等有一定的帮助。</p><p>　　3、南方五行属火，离卦。南方摆放绿色植物可令办公室的女性提高个人美感和魅力;此方位摆红花则对投资者或弹性收入者有一定的催财旺财功效。</p><p>　　4、北方五行属水，坎卦，可摆放白色花，此举可有效改变员工之间以及上下级之间的紧张关系。</p><p>　　5、东南方五行属木，巽卦，是一个影响人际关系、恋爱和结婚运的方位，所以首选花卉颜色为粉色。</p><p>　　6、西南方五行属土，坤卦，办公室女领导的方位，最适宜放鲜艳的红色花;处于亚健康状态的人员可在此方摆放黄色花试试。</p><p>　　7、东北方五行属土，艮卦，该方位适合部门里的小字辈，摆放黄色的花有利于防止口舌是非发生。</p><p>　　8、西北五行属金，乾卦，是部门最高领导的方位，适合摆放白色和黄色的花卉，能提高领导威信和全体员工同心同德。</p><p>&nbsp;</p><p>　　上述是办公室设计时摆放鲜花的通用原则，如果需要仔细有个性化的摆放鲜花，那么，则需要考虑办公室人员的命理和办公室具体位理来进行，可谓是有的放矢吧。同时要注意的是，在办公室风水布局里，千万不要使用假花，因为其象征死亡与没落。</p><p>&nbsp;</p><p>　　如果在办公室中你觉得犯小人，老是有小人捣鬼，那么，建议你在办公桌左侧摆放或悬挂红色的鲜花或盆栽(仙人掌、仙人球为宜)，注意，鲜花要以3朵为宜。另外，办公桌右侧最好少摆放办公用品，因为是白虎位，需要谨慎。</p><p>&nbsp;</p><p>　　鲜花的寿命都很短，大多在一周之内，夏天会更短。尤其是象郁金香这样的鲜花两天左右就会凋谢。怎样能使鲜花保持的时间长一些呢?朋友们不妨试试：</p><p>　　1)首先鲜花的根部要斜着剪口，这样吸水的部位大，能够更多地吸收水分;</p><p>　　2)其次，要每天剪去一些，保证能够更好的吸收水分;</p><p>　　3)还有，花的叶子不要泡在水里，这样叶子会烂掉，所以一定要把浸在水里的叶子摘掉;</p><p>　　4)每天要换水。如果是夏天，为了保持水温不升高，还可以往花瓶里放几块冰;同时，花瓶里的水最好放满，这样不仅能使水的温度保持得长久些，还可以增加花瓶底部的重量，保证花瓶的稳定性。</p><p>　　5)为了使鲜花开的时间长一些，还可以往花瓶里放少许啤酒，或者将两片阿司匹林研成末放进去。可延长鲜花的寿命。</p><p>　　6)在一般家庭常买的几种鲜花中，郁金香的寿命最短，康乃馨的寿命最长。如果你的主人是又想漂亮又比较节约的人，你就要少买郁金香，多买康乃馨。尤其是夏天，郁金香很快就会枯萎。</p><p>　　7)还要注意一点，家庭中一般不要买菊花。因为菊花一般是用来上供的。</p><p>　　8)买几支绢花，与鲜花混合插入花瓶中，会使鲜花显得多而豪华。不同的绢花可与不同的鲜花相配反复使用。</p><p><br/></p>', '1428599532', '50', '1', '0', '1', '1', '12');
INSERT INTO `th_article` VALUES ('34', '52', '客厅装修,五条注意事项', '', '', ' 一、空间设计变化最多 若是家里的面积较小，客厅的面积不够大，在设计上就可以结合客餐厅的空间做开放式设计，只要弹性的放个隔屏或收纳柜，就可以提升客餐空间的使用功能，并且还可', '<p>&nbsp;&nbsp;&nbsp;&nbsp;一、空间设计变化最多</p><p>　　若是家里的面积较小，客厅的面积不够大，在设计上就可以结合客餐厅的空间做开放式设计，只要弹性的放个隔屏或收纳柜，就可以提升客餐空间的使用功能，并且还可以让客厅空间加大、视野变宽阔，就算全家用餐或多人用餐时，也可以很舒适。</p><p>&nbsp;</p><p>　　二、动线流畅</p><p>　　从一进家门到客厅；或从客厅到其它卧房空间，若是能掌握住出入动线的简化，将可让客厅看起来更清亮、宽敞，也可以提升整个房子的使用机能。</p><p>&nbsp;</p><p>　　三、空间比例最大、位置最明显</p><p>　　由于客厅空间会是家里最常有多人聚会的场所，所以一般住宅空间的比例规划，客厅的占比都是最大的，同时由于客厅正代表着主人的居家风格，所以客厅通常都是规划在进入家时最明显的位置。</p><p>&nbsp;</p><p>　　四、绿化与摆饰很重要</p><p>　　客厅的布置代表着主人的生活风格，所以客厅布置通常都是居家布置的重心，适当的在客厅中摆放适合的条毯、抱枕、挂画、古董摆饰等家庭软装配饰，不仅可以让空间充分发挥个人风格，并达到美化的画龙点睛之效，且适度的将花草搬进家中，无形中就像把大自然搬回家一样，自然将鲜活植物的蓬勃朝气引入客厅中，更让坐在客厅的人，都能感受一种绿化清新的舒畅感。</p><p>&nbsp;</p><p>　　五、通风与采光</p><p>　　通风、采光皆佳的居住空间，给人明亮、健康的感受，无形之中让住在里面的人都变的开朗起来，但客厅又常被规划在建筑的中央，若能在规划时注意到适当的引入自然光源，采落地窗或花窗、气密窗设计，将可为家里的空间带来更好、更自然的舒适感。</p><p><br/></p>', '1428599298', '50', '0', '0', '1', '1', '26');
INSERT INTO `th_article` VALUES ('35', '52', '未来办公空间的发展趋势', '', '', ' 作为社会活动的重要场所——办公空间，将承载怎样的使命？当下如何改变？发展趋势又将如何？材料、产品、工作形态如何完美结合？ 我们探讨办公环境事实上与工作的性质有着直接关系。', '<p>　　作为社会活动的重要场所——办公空间，将承载怎样的使命？当下如何改变？发展趋势又将如何？材料、产品、工作形态如何完美结合？</p><p>&nbsp;</p><p>　　我们探讨办公环境事实上与工作的性质有着直接关系。无论是互动开放式，还是私密封闭式，根据企业属性的不同，都需要适当的作调整和改变。我们可以从以下几个方面入手：</p><p>&nbsp;</p><p>　　第一，从功能上改变。时代需要更加人性化、科技化、人文化、多元化的办公空间。特别是在行政类办公空间里，我们应赋予办公空间柔和、轻明、端正、规矩的视觉，注重节能减排和智能化，让办公充满乐趣。</p><p>&nbsp;</p><p>　　第二，从环境上改变。如今奢华早已不再是办公空间的主流风格，从建筑环境角度上讲，注重节能、环保、低碳逐渐会成为一种趋势</p><p>&nbsp;</p><p>　　第三，从理念上改变。办公室是一个能让心灵安静的地方，而现实中绝大多数办公室偏中性化，缺少办公环境的男女性别之分，希望今后的办公室能从中性化氛围中汲取更多设计元素进行改变，期待环保、舒适、健康的未来办公室。</p><p>&nbsp;</p><p>　　第四，如今办公室可以适应目前所有使用需求，传统的办公空间走廊加隔间式和敞开式布局相对不人性化，未来取而代之为复合型办公室和企业俱乐部。复合型办公空间具有非常的灵活性，有独立的隔间，有开敞的办公区，有公共的研讨和会议区，有学习图书区，有休息交流区以及后勤服务区等。而企业俱乐部是针对不受时间与空间限制的企业办公特点而设置的，他成为一个进行交流、激发灵感和供员工聚集的地方，因此办公室应该设计得很有吸引力，以便支持配合团队精神。如有公司把这些员工们会面的地方称为“高级咖啡屋”，并且创造出一些空间，供员工们在一个舒适的氛围中与同事式商业伙伴进行交流。</p><p><br/></p>', '1428599320', '50', '0', '0', '1', '1', '15');
INSERT INTO `th_article` VALUES ('59', '53', '电脑放置的风水影响', '', '', ' 电脑在我们的生活工作中的作用，已经到了地球人都知道的程度了，如果说普通上班族的电脑，还是上班时间之用的话；对搜狐一族，宅男宅女来说，电脑就是他们的生命线，一日无鱼，三日', '
　　电脑在我们的生活工作中的作用，已经到了地球人都知道的程度了，如果说普通上班族的电脑，还是上班时间之用的话；对搜狐一族，宅男宅女来说，电脑就是他们的生命线，一日无鱼，三日无肉都可以忍受，唯独不能承受离开电脑。电脑已经成了他们生命中不可或缺的一员了。想一想，电脑对他们的影响会有多大。电脑的影响不仅仅是其辐射可能对人的健康产生影响，而且电脑的摆放位置，方向，还会对风水产生作用，从而对人的运势产生影响。我们从家居电脑的摆放位置、方位，来讲讲电脑风水可能会带来的后果，大家不妨结合自己家的实际情况来看看。 

 

　　1、请勿将电脑置于你的喜用神方向。 

　　电脑置于喜用神方向，会压制你的贵人；如果你的命理还忌火的话，那就更要小心了。 举个例子，比如说你的喜用神为东方，你的命理忌火，你还把电脑放在了东方，这样的话木生火旺，对你的运势会产生极为不利的影响。

 

　　2、电脑最好放在电脑桌的左边。 

　　这对经常依靠电脑工作的人而言，是比较理想的方位。按风水方位学来说，就是“龙怕臭，虎怕动”，左方是吉方，放电脑最恰当。 

 

　　3、电脑对床者为电脑摆放大忌 

　　电脑的显示器如果正对住了卧床，会影响人的精神和睡眠质量，建议最好做出调整。 

 

　　4、电脑要避免阳光直射 

　　电脑放置的地方容易受到太阳直射的话，最易招惹是非，容易有口舌之争；但如果摆放在阴暗的地方，也容易情绪低沉，影响工作状态。

 

　　5、避免电脑摆放在空气不流畅的地方

　　电脑最好摆放在空气比较流通的地方，这样不仅可以减小电脑的辐射，也不会对主人有太多影响；如果是摆在一个空气不太流通的地方会造你对外界反应缓慢，思路不清晰。

 

　　6、电脑位置一定要远离水池、鱼缸等近水的地方。

　　近水的地方，容易让电脑受潮不说，还容易水火相克，诱发心血管类疾病。

 

　　7、电脑周围不要摆放太多杂物

　　电脑周围有太多杂物，容易让人分心，产生杂念，无法专心工作。

 

　　8、显示器最好与空间匹配

　　如果房间太小而却用了较大的显示器，容易造成亲朋疏远，同事远离，领导不太重视的情况；反之，如果房间大却用小的显示器，则容易被人忽略，甚至看不起。所以在显示器的选择上不是越大越好，而是与空间相匹配为宜。



', '0', '50', '1', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('60', '53', '电脑放置的风水影响', '', '', ' 电脑在我们的生活工作中的作用，已经到了地球人都知道的程度了，如果说普通上班族的电脑，还是上班时间之用的话；对搜狐一族，宅男宅女来说，电脑就是他们的生命线，一日无鱼，三日', '<p>　　电脑在我们的生活工作中的作用，已经到了地球人都知道的程度了，如果说普通上班族的电脑，还是上班时间之用的话；对搜狐一族，宅男宅女来说，电脑就是他们的生命线，一日无鱼，三日无肉都可以忍受，唯独不能承受离开电脑。电脑已经成了他们生命中<span style="line-height: 2;">不可或缺的一员了。想一想，电脑对他们的影响会有多大。电脑的影响不仅仅是其辐射可能对人的健康产生影响，而且电脑的摆放位置，方向，还会对风水产生作用，从而对人的运势产生影响。我们从家居电脑的摆放位置、方位，来讲讲电脑风水可能会带来的后果，大家不妨结合自己家的实际情况来看看。&nbsp;</span></p><p>&nbsp;</p><p>　　1、请勿将电脑置于你的喜用神方向。&nbsp;</p><p>　　电脑置于喜用神方向，会压制你的贵人；如果你的命理还忌火的话，那就更要小心了。 举个例子，比如说你的喜用神为东方，你的命理忌火，你还把电脑放在了东方，这样的话木生火旺，对你的运势会产生极为不利的影响。</p><p>&nbsp;</p><p>　　2、电脑最好放在电脑桌的左边。&nbsp;</p><p>　　这对经常依靠电脑工作的人而言，是比较理想的方位。按风水方位学来说，就是“龙怕臭，虎怕动”，左方是吉方，放电脑最恰当。&nbsp;</p><p>&nbsp;</p><p>　　3、电脑对床者为电脑摆放大忌&nbsp;</p><p>　　电脑的显示器如果正对住了卧床，会影响人的精神和睡眠质量，建议最好做出调整。&nbsp;</p><p>&nbsp;</p><p>　　4、电脑要避免阳光直射&nbsp;</p><p>　　电脑放置的地方容易受到太阳直射的话，最易招惹是非，容易有口舌之争；但如果摆放在阴暗的地方，也容易情绪低沉，影响工作状态。</p><p>&nbsp;</p><p>　　5、避免电脑摆放在空气不流畅的地方</p><p>　　电脑最好摆放在空气比较流通的地方，这样不仅可以减小电脑的辐射，也不会对主人有太多影响；如果是摆在一个空气不太流通的地方会造你对外界反应缓慢，思路不清晰。</p><p>&nbsp;</p><p>　　6、电脑位置一定要远离水池、鱼缸等近水的地方。</p><p>　　近水的地方，容易让电脑受潮不说，还容易水火相克，诱发心血管类疾病。</p><p>&nbsp;</p><p>　　7、电脑周围不要摆放太多杂物</p><p>　　电脑周围有太多杂物，容易让人分心，产生杂念，无法专心工作。</p><p>&nbsp;</p><p>　　8、显示器最好与空间匹配</p><p>　　如果房间太小而却用了较大的显示器，容易造成亲朋疏远，同事远离，领导不太重视的情况；反之，如果房间大却用小的显示器，则容易被人忽略，甚至看不起。所以在显示器的选择上不是越大越好，而是与空间相匹配为宜。</p><p><br/></p>', '0', '50', '1', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('61', '53', '办公室风水的植物摆放', '', '', ' 从事多年办公风水的大师对办公室装修风水中植物摆放的建议： 1、东方五行属木，震卦，紫气东来：东方摆放红色的花对文案策划、编辑人员以及所有动脑工作的人员有利。 2、西方五行属金', '<p>　　从事多年办公风水的大师对办公室装修风水中植物摆放的建议：</p><p>　　1、东方五行属木，震卦，紫气东来：东方摆放红色的花对文案策划、编辑人员以及所有&quot;动脑&quot;工作的人员有利。</p><p>　　2、西方五行属金，兑卦，西方摆白、黄颜色的花可增加以“口”为生人员的&quot;锐气&quot;，比如如律师、销售、艺术家等有一定的帮助。</p><p>　　3、南方五行属火，离卦。南方摆放绿色植物可令办公室的女性提高个人美感和魅力;此方位摆红花则对投资者或弹性收入者有一定的催财旺财功效。</p><p>　　4、北方五行属水，坎卦，可摆放白色花，此举可有效改变员工之间以及上下级之间的紧张关系。</p><p>　　5、东南方五行属木，巽卦，是一个影响人际关系、恋爱和结婚运的方位，所以首选花卉颜色为粉色。</p><p>　　6、西南方五行属土，坤卦，办公室女领导的方位，最适宜放鲜艳的红色花;处于亚健康状态的人员可在此方摆放黄色花试试。</p><p>　　7、东北方五行属土，艮卦，该方位适合部门里的小字辈，摆放黄色的花有利于防止口舌是非发生。</p><p>　　8、西北五行属金，乾卦，是部门最高领导的方位，适合摆放白色和黄色的花卉，能提高领导威信和全体员工同心同德。</p><p>&nbsp;</p><p>　　上述是办公室设计时摆放鲜花的通用原则，如果需要仔细有个性化的摆放鲜花，那么，则需要考虑办公室人员的命理和办公室具体位理来进行，可谓是有的放矢吧。同时要注意的是，在办公室风水布局里，千万不要使用假花，因为其象征死亡与没落。</p><p>&nbsp;</p><p>　　如果在办公室中你觉得犯小人，老是有小人捣鬼，那么，建议你在办公桌左侧摆放或悬挂红色的鲜花或盆栽(仙人掌、仙人球为宜)，注意，鲜花要以3朵为宜。另外，办公桌右侧最好少摆放办公用品，因为是白虎位，需要谨慎。</p><p>&nbsp;</p><p>　　鲜花的寿命都很短，大多在一周之内，夏天会更短。尤其是象郁金香这样的鲜花两天左右就会凋谢。怎样能使鲜花保持的时间长一些呢?朋友们不妨试试：</p><p>　　1)首先鲜花的根部要斜着剪口，这样吸水的部位大，能够更多地吸收水分;</p><p>　　2)其次，要每天剪去一些，保证能够更好的吸收水分;</p><p>　　3)还有，花的叶子不要泡在水里，这样叶子会烂掉，所以一定要把浸在水里的叶子摘掉;</p><p>　　4)每天要换水。如果是夏天，为了保持水温不升高，还可以往花瓶里放几块冰;同时，花瓶里的水最好放满，这样不仅能使水的温度保持得长久些，还可以增加花瓶底部的重量，保证花瓶的稳定性。</p><p>　　5)为了使鲜花开的时间长一些，还可以往花瓶里放少许啤酒，或者将两片阿司匹林研成末放进去。可延长鲜花的寿命。</p><p>　　6)在一般家庭常买的几种鲜花中，郁金香的寿命最短，康乃馨的寿命最长。如果你的主人是又想漂亮又比较节约的人，你就要少买郁金香，多买康乃馨。尤其是夏天，郁金香很快就会枯萎。</p><p>　　7)还要注意一点，家庭中一般不要买菊花。因为菊花一般是用来上供的。</p><p>　　8)买几支绢花，与鲜花混合插入花瓶中，会使鲜花显得多而豪华。不同的绢花可与不同的鲜花相配反复使用。</p><p><br/></p>', '0', '50', '1', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('62', '53', '家居风水招财——9大禁忌你必须知道', '', '', ' 财位要明亮 家里的财位要明亮，不能经常处在黑暗的地方，打开灯光这个地方不能有暗影，要灯光能直射到这里，因为明亮则财运顺。昏暗不利于财运，且会使得运势上出现不稳的状况。 ·财', '<p>　　财位要明亮</p><p>　　家里的财位要明亮，不能经常处在黑暗的地方，打开灯光这个地方不能有暗影，要灯光能直射到这里，因为明亮则财运顺。昏暗不利于财运，且会使得运势上出现不稳的状况。</p><p>&nbsp;</p><p>　　·财位要适合坐</p><p>　　家里的财位下面如果是沙发或者椅子，自己人可以经常坐在下面，可以多带一些财气在身上。财位下面这个位置尽量不要让客户或者外人去坐，否则家里的财气可能会被外人带走。</p><p>&nbsp;</p><p>　　·财位适合睡</p><p>　　财位的下面也可是是床，人的一生大多数时间是在床上度过的，所以床位的凶吉对我们的运势有很大的影响，如果能够在财位上睡一睡，对我们的财运有很大的帮助。</p><p>&nbsp;</p><p>　　·财位招吉祥物品</p><p>我们如果可以再财位那里摆放一些吉祥的物件、工艺品等，会给财位锦上添花，吉上加吉。特别是碗装的黄金，吸财力会更大。</p><p>&nbsp;</p><p>&nbsp;</p><p>　　·财位要有生机</p><p>　　我们可以放一些枝繁叶茂的植被，但是要留意，这些植物需要是泥土里生长出来的，切勿摆放水生养出来的植物，因为水生养则意味着根基不稳。财位不要摆放有刺的类似仙人掌之类的植物，植物选用叶片较大的阔叶类植物，大叶的植物寓意大展宏图。</p><p>&nbsp;</p><p>　　·财位忌放沉重物品</p><p>　　财位受压是绝对不适宜的，大的衣柜、书柜等沉重物压在财位上，那将会对全家和整个公司的财运不利，还会整天感到压力重重，为财而累。</p><p>&nbsp;</p><p>　　·财位后要为实物</p><p>　　财位背后应该为墙，因为象征着财运上有靠山，保证无后顾之忧，这样才可藏风聚气。避免后面是空空的玻璃，如果是窗户，这个位置的窗户要尽量少打开，以避免向外散财，一定要让这个位聚住气。</p><p>&nbsp;</p><p>　　·财位上忌尖角物品</p><p>&nbsp;</p><p>　　·保持干净</p><p>　　风水学最忌尖角冲射，财位附近不要有尖角物，还应尽量避免摆放有尖角的物品。尖角类的物品会把财运冲走。</p><p>　　平时要注意打扫一下财位上的灰尘，保持干净一些，不要堆放杂物和放垃圾筒等，要移走，否则会污损财位，令财运大打折扣。</p><p><br/></p>', '0', '50', '1', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('63', '53', '金九银十结婚季，你家婚房怎么装', '', '', ' 家居室内的布置是非常重要的一个环节，家居内部我们都需要天天接触，他的风水效果并非外局所能比的。住宅的内部受到很多因素的牵扯，比如颜色布局、建材种类、光线照射、物品的凶吉', '<p>　　家居室内的布置是非常重要的一个环节，家居内部我们都需要天天接触，他的风水效果并非外局所能比的。住宅的内部受到很多因素的牵扯，比如颜色布局、建材种类、光线照射、物品的凶吉、动感设计等等，都是我们需要注意的一些因素。现在东易日盛小编就其中一些因素给大家予以说明。</p><p>&nbsp;</p><p><strong>　　【厕所忌在房屋中央位置】</strong></p><p>　　风水常说：中间污秽，一些房间的布局中央位置是厕所，在阳宅中被称为“污秽” ，应该及时避免。</p><p>&nbsp;</p><p><strong>　　【阳光充足】</strong></p><p>　　阳光充足的房间不仅仅对人身体好，在风水上阴暗较多的住宅也是极其不好的，就算是安装灯光去弥补，也不能修正内居。</p><p>&nbsp;</p><p>　　<strong>【内部线条要流畅</strong>】</p><p>　　东线流畅是内部布局第一应考量的事，一些刚刚学习阳宅的新手，为了得取心中理想的方位，内部线条修改的迂回难行，造成磁场紊乱。</p><p>&nbsp;</p><p><strong>　　【房间不宜过小】</strong></p><p>　　一些地产公司为了赢取大众的心理，把小面积的房间硬是挤成了三居室，房间非常小，放一张床之后几乎没有转身的余地，就会造成“气”进不来，就更称不上吉了。</p><p>&nbsp;</p><p><strong>　　【房顶不宜过低】</strong></p><p>　　楼层低压：早期有些房屋每层奇低无比，天花板装璜之后，头快顶到天了，这也要避免。</p><p>&nbsp;</p><p><strong>　　【鱼缸不宜过大】</strong></p><p>　　鱼缸：鱼缸在内部格局应用上相当普遍，除了造景之外，有隔间、化煞、催财等作用，加上灯光之后又有消除阴暗之效果。要注意的是水要保持干净，鱼缸要常清洗，鱼若有死亡应立及除去。鱼缸也不宜过大，以免造成室内湿气太大。</p><p><br/></p>', '0', '50', '0', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('64', '53', '家庭装修风水,普及客厅装修知识', '', '', ' 客厅在新房装修中是特别重要装修的地方，是家人公共休息、休闲、娱乐的场所。客厅的风水也是对一家人运势影响最大的地方。你或许不知道的客厅装修禁忌： 1、客厅格局宜方正 客厅的格', '<p>　　客厅在新房装修中是特别重要装修的地方，是家人公共休息、休闲、娱乐的场所。客厅的风水也是对一家人运势影响最大的地方。你或许不知道的客厅装修禁忌：</p><p>&nbsp;</p><p>　　1、客厅格局宜方正</p><p>　　客厅的格局最好是正方形或长方形，座椅区不可冲煞到屋角，沙发不可压梁。如果有突出的屋角放出暗箭，可摆设盆景或家俱化解。如果客厅呈L形，可用家俱将之隔成两个方形区域，视为两个独立的房间。例如，可将一个区域当成会客室，另一个区域当成起居室。</p><p>&nbsp;</p><p>　　2、大门与客厅应设玄关</p><p>　　风水要诀“喜回旋、忌直冲”。大门与客厅设置玄关或矮柜遮档，使内外有所缓冲，理气得以回旋后聚集于客厅，住宅内部也得到隐蔽，外边不易窥探。住宅内部隐蔽深藏，象征福气绵延。</p><p>&nbsp;</p><p>　　3、客厅间隔、房主孤独</p><p>　　从位置上说客厅是家人共用的场所，若因客厅宽敞而隔一部分做卧房在堪舆学上称为“自裁”，抽象点来说就是人为地将一个带公共活动的磁场空间“裁剪”了，在这“裁剪”小卧室里面休息的人，容易造成心态上的孤独感，如果是未婚者居住更难免有“知音难寻”之忧。</p><p>&nbsp;</p><p>　　4、财位不宜泄</p><p>　　进门客厅的对角线为峦头堪舆学上的财位，此处如果有柱子、凹位，窗户、可用植物、酒柜、饰柜阻挡，一方面令“财气”不致外漏，另一方面可以塑造出一个良好的财位，一举二得。</p><p>&nbsp;</p><p>　　5、横梁当头压抑</p><p>　　如果客厅内正好被横梁所“压”，巨大的心理压抑会令屋内人会在社会上备受压抑，难于得志，遇到这种情况可以用假天花遮盖或在梁上悬挂福鼠饰品加以化解或者在装修上设计成两个客厅。</p><p>&nbsp;</p><p>　　6、沙发成套才和谐</p><p>　　一般沙发肯定是整套摆设的，但不排除有些朋友因为空间大而将两套沙发放在一起或在一套沙发外再加放零散的沙发椅，这些做法在堪舆学上说是不利家人和睦的，因为摆放完整一套的沙发喻意着全家人上下一心，团结一致。</p><p>&nbsp;</p><p>　　7、前通后通、人财两空</p><p>　　从空间上说客厅的动线最宜开阔，视野一眼望穿让人心境豁达，所以入门处不宜看到房间门和后门，否则便有“前进后出”、“无法聚财之患”;另外，走道也应避免直向或横向贯穿整个客厅，这种家相正好应了一句堪舆俗语“前通后通，人财两空”。</p><p><br/></p>', '0', '50', '0', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('72', '53', '电脑放置的风水影响', '', '', ' 电脑在我们的生活工作中的作用，已经到了地球人都知道的程度了，如果说普通上班族的电脑，还是上班时间之用的话；对搜狐一族，宅男宅女来说，电脑就是他们的生命线，一日无鱼，三日', '<p>　　电脑在我们的生活工作中的作用，已经到了地球人都知道的程度了，如果说普通上班族的电脑，还是上班时间之用的话；对搜狐一族，宅男宅女来说，电脑就是他们的生命线，一日无鱼，三日无肉都可以忍受，唯独不能承受离开电脑。电脑已经成了他们生命中<span style="line-height: 2;">不可或缺的一员了。想一想，电脑对他们的影响会有多大。电脑的影响不仅仅是其辐射可能对人的健康产生影响，而且电脑的摆放位置，方向，还会对风水产生作用，从而对人的运势产生影响。我们从家居电脑的摆放位置、方位，来讲讲电脑风水可能会带来的后果，大家不妨结合自己家的实际情况来看看。&nbsp;</span></p><p>&nbsp;</p><p>　　1、请勿将电脑置于你的喜用神方向。&nbsp;</p><p>　　电脑置于喜用神方向，会压制你的贵人；如果你的命理还忌火的话，那就更要小心了。 举个例子，比如说你的喜用神为东方，你的命理忌火，你还把电脑放在了东方，这样的话木生火旺，对你的运势会产生极为不利的影响。</p><p>&nbsp;</p><p>　　2、电脑最好放在电脑桌的左边。&nbsp;</p><p>　　这对经常依靠电脑工作的人而言，是比较理想的方位。按风水方位学来说，就是“龙怕臭，虎怕动”，左方是吉方，放电脑最恰当。&nbsp;</p><p>&nbsp;</p><p>　　3、电脑对床者为电脑摆放大忌&nbsp;</p><p>　　电脑的显示器如果正对住了卧床，会影响人的精神和睡眠质量，建议最好做出调整。&nbsp;</p><p>&nbsp;</p><p>　　4、电脑要避免阳光直射&nbsp;</p><p>　　电脑放置的地方容易受到太阳直射的话，最易招惹是非，容易有口舌之争；但如果摆放在阴暗的地方，也容易情绪低沉，影响工作状态。</p><p>&nbsp;</p><p>　　5、避免电脑摆放在空气不流畅的地方</p><p>　　电脑最好摆放在空气比较流通的地方，这样不仅可以减小电脑的辐射，也不会对主人有太多影响；如果是摆在一个空气不太流通的地方会造你对外界反应缓慢，思路不清晰。</p><p>&nbsp;</p><p>　　6、电脑位置一定要远离水池、鱼缸等近水的地方。</p><p>　　近水的地方，容易让电脑受潮不说，还容易水火相克，诱发心血管类疾病。</p><p>&nbsp;</p><p>　　7、电脑周围不要摆放太多杂物</p><p>　　电脑周围有太多杂物，容易让人分心，产生杂念，无法专心工作。</p><p>&nbsp;</p><p>　　8、显示器最好与空间匹配</p><p>　　如果房间太小而却用了较大的显示器，容易造成亲朋疏远，同事远离，领导不太重视的情况；反之，如果房间大却用小的显示器，则容易被人忽略，甚至看不起。所以在显示器的选择上不是越大越好，而是与空间相匹配为宜。</p><p><br/></p>', '0', '50', '1', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('73', '53', '办公室风水的植物摆放', '', '', ' 从事多年办公风水的大师对办公室装修风水中植物摆放的建议： 1、东方五行属木，震卦，紫气东来：东方摆放红色的花对文案策划、编辑人员以及所有动脑工作的人员有利。 2、西方五行属金', '<p>　　从事多年办公风水的大师对办公室装修风水中植物摆放的建议：</p><p>　　1、东方五行属木，震卦，紫气东来：东方摆放红色的花对文案策划、编辑人员以及所有&quot;动脑&quot;工作的人员有利。</p><p>　　2、西方五行属金，兑卦，西方摆白、黄颜色的花可增加以“口”为生人员的&quot;锐气&quot;，比如如律师、销售、艺术家等有一定的帮助。</p><p>　　3、南方五行属火，离卦。南方摆放绿色植物可令办公室的女性提高个人美感和魅力;此方位摆红花则对投资者或弹性收入者有一定的催财旺财功效。</p><p>　　4、北方五行属水，坎卦，可摆放白色花，此举可有效改变员工之间以及上下级之间的紧张关系。</p><p>　　5、东南方五行属木，巽卦，是一个影响人际关系、恋爱和结婚运的方位，所以首选花卉颜色为粉色。</p><p>　　6、西南方五行属土，坤卦，办公室女领导的方位，最适宜放鲜艳的红色花;处于亚健康状态的人员可在此方摆放黄色花试试。</p><p>　　7、东北方五行属土，艮卦，该方位适合部门里的小字辈，摆放黄色的花有利于防止口舌是非发生。</p><p>　　8、西北五行属金，乾卦，是部门最高领导的方位，适合摆放白色和黄色的花卉，能提高领导威信和全体员工同心同德。</p><p>&nbsp;</p><p>　　上述是办公室设计时摆放鲜花的通用原则，如果需要仔细有个性化的摆放鲜花，那么，则需要考虑办公室人员的命理和办公室具体位理来进行，可谓是有的放矢吧。同时要注意的是，在办公室风水布局里，千万不要使用假花，因为其象征死亡与没落。</p><p>&nbsp;</p><p>　　如果在办公室中你觉得犯小人，老是有小人捣鬼，那么，建议你在办公桌左侧摆放或悬挂红色的鲜花或盆栽(仙人掌、仙人球为宜)，注意，鲜花要以3朵为宜。另外，办公桌右侧最好少摆放办公用品，因为是白虎位，需要谨慎。</p><p>&nbsp;</p><p>　　鲜花的寿命都很短，大多在一周之内，夏天会更短。尤其是象郁金香这样的鲜花两天左右就会凋谢。怎样能使鲜花保持的时间长一些呢?朋友们不妨试试：</p><p>　　1)首先鲜花的根部要斜着剪口，这样吸水的部位大，能够更多地吸收水分;</p><p>　　2)其次，要每天剪去一些，保证能够更好的吸收水分;</p><p>　　3)还有，花的叶子不要泡在水里，这样叶子会烂掉，所以一定要把浸在水里的叶子摘掉;</p><p>　　4)每天要换水。如果是夏天，为了保持水温不升高，还可以往花瓶里放几块冰;同时，花瓶里的水最好放满，这样不仅能使水的温度保持得长久些，还可以增加花瓶底部的重量，保证花瓶的稳定性。</p><p>　　5)为了使鲜花开的时间长一些，还可以往花瓶里放少许啤酒，或者将两片阿司匹林研成末放进去。可延长鲜花的寿命。</p><p>　　6)在一般家庭常买的几种鲜花中，郁金香的寿命最短，康乃馨的寿命最长。如果你的主人是又想漂亮又比较节约的人，你就要少买郁金香，多买康乃馨。尤其是夏天，郁金香很快就会枯萎。</p><p>　　7)还要注意一点，家庭中一般不要买菊花。因为菊花一般是用来上供的。</p><p>　　8)买几支绢花，与鲜花混合插入花瓶中，会使鲜花显得多而豪华。不同的绢花可与不同的鲜花相配反复使用。</p><p><br/></p>', '0', '50', '1', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('74', '53', '家居风水招财——9大禁忌你必须知道', '', '', ' 财位要明亮 家里的财位要明亮，不能经常处在黑暗的地方，打开灯光这个地方不能有暗影，要灯光能直射到这里，因为明亮则财运顺。昏暗不利于财运，且会使得运势上出现不稳的状况。 ·财', '<p>　　财位要明亮</p><p>　　家里的财位要明亮，不能经常处在黑暗的地方，打开灯光这个地方不能有暗影，要灯光能直射到这里，因为明亮则财运顺。昏暗不利于财运，且会使得运势上出现不稳的状况。</p><p>&nbsp;</p><p>　　·财位要适合坐</p><p>　　家里的财位下面如果是沙发或者椅子，自己人可以经常坐在下面，可以多带一些财气在身上。财位下面这个位置尽量不要让客户或者外人去坐，否则家里的财气可能会被外人带走。</p><p>&nbsp;</p><p>　　·财位适合睡</p><p>　　财位的下面也可是是床，人的一生大多数时间是在床上度过的，所以床位的凶吉对我们的运势有很大的影响，如果能够在财位上睡一睡，对我们的财运有很大的帮助。</p><p>&nbsp;</p><p>　　·财位招吉祥物品</p><p>我们如果可以再财位那里摆放一些吉祥的物件、工艺品等，会给财位锦上添花，吉上加吉。特别是碗装的黄金，吸财力会更大。</p><p>&nbsp;</p><p>&nbsp;</p><p>　　·财位要有生机</p><p>　　我们可以放一些枝繁叶茂的植被，但是要留意，这些植物需要是泥土里生长出来的，切勿摆放水生养出来的植物，因为水生养则意味着根基不稳。财位不要摆放有刺的类似仙人掌之类的植物，植物选用叶片较大的阔叶类植物，大叶的植物寓意大展宏图。</p><p>&nbsp;</p><p>　　·财位忌放沉重物品</p><p>　　财位受压是绝对不适宜的，大的衣柜、书柜等沉重物压在财位上，那将会对全家和整个公司的财运不利，还会整天感到压力重重，为财而累。</p><p>&nbsp;</p><p>　　·财位后要为实物</p><p>　　财位背后应该为墙，因为象征着财运上有靠山，保证无后顾之忧，这样才可藏风聚气。避免后面是空空的玻璃，如果是窗户，这个位置的窗户要尽量少打开，以避免向外散财，一定要让这个位聚住气。</p><p>&nbsp;</p><p>　　·财位上忌尖角物品</p><p>&nbsp;</p><p>　　·保持干净</p><p>　　风水学最忌尖角冲射，财位附近不要有尖角物，还应尽量避免摆放有尖角的物品。尖角类的物品会把财运冲走。</p><p>　　平时要注意打扫一下财位上的灰尘，保持干净一些，不要堆放杂物和放垃圾筒等，要移走，否则会污损财位，令财运大打折扣。</p><p><br/></p>', '0', '50', '1', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('75', '53', '金九银十结婚季，你家婚房怎么装', '', '', ' 家居室内的布置是非常重要的一个环节，家居内部我们都需要天天接触，他的风水效果并非外局所能比的。住宅的内部受到很多因素的牵扯，比如颜色布局、建材种类、光线照射、物品的凶吉', '<p>　　家居室内的布置是非常重要的一个环节，家居内部我们都需要天天接触，他的风水效果并非外局所能比的。住宅的内部受到很多因素的牵扯，比如颜色布局、建材种类、光线照射、物品的凶吉、动感设计等等，都是我们需要注意的一些因素。现在东易日盛小编就其中一些因素给大家予以说明。</p><p>&nbsp;</p><p><strong>　　【厕所忌在房屋中央位置】</strong></p><p>　　风水常说：中间污秽，一些房间的布局中央位置是厕所，在阳宅中被称为“污秽” ，应该及时避免。</p><p>&nbsp;</p><p><strong>　　【阳光充足】</strong></p><p>　　阳光充足的房间不仅仅对人身体好，在风水上阴暗较多的住宅也是极其不好的，就算是安装灯光去弥补，也不能修正内居。</p><p>&nbsp;</p><p>　　<strong>【内部线条要流畅</strong>】</p><p>　　东线流畅是内部布局第一应考量的事，一些刚刚学习阳宅的新手，为了得取心中理想的方位，内部线条修改的迂回难行，造成磁场紊乱。</p><p>&nbsp;</p><p><strong>　　【房间不宜过小】</strong></p><p>　　一些地产公司为了赢取大众的心理，把小面积的房间硬是挤成了三居室，房间非常小，放一张床之后几乎没有转身的余地，就会造成“气”进不来，就更称不上吉了。</p><p>&nbsp;</p><p><strong>　　【房顶不宜过低】</strong></p><p>　　楼层低压：早期有些房屋每层奇低无比，天花板装璜之后，头快顶到天了，这也要避免。</p><p>&nbsp;</p><p><strong>　　【鱼缸不宜过大】</strong></p><p>　　鱼缸：鱼缸在内部格局应用上相当普遍，除了造景之外，有隔间、化煞、催财等作用，加上灯光之后又有消除阴暗之效果。要注意的是水要保持干净，鱼缸要常清洗，鱼若有死亡应立及除去。鱼缸也不宜过大，以免造成室内湿气太大。</p><p><br/></p>', '0', '50', '0', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('76', '53', '家庭装修风水,普及客厅装修知识', '', '', ' 客厅在新房装修中是特别重要装修的地方，是家人公共休息、休闲、娱乐的场所。客厅的风水也是对一家人运势影响最大的地方。你或许不知道的客厅装修禁忌： 1、客厅格局宜方正 客厅的格', '<p>　　客厅在新房装修中是特别重要装修的地方，是家人公共休息、休闲、娱乐的场所。客厅的风水也是对一家人运势影响最大的地方。你或许不知道的客厅装修禁忌：</p><p>&nbsp;</p><p>　　1、客厅格局宜方正</p><p>　　客厅的格局最好是正方形或长方形，座椅区不可冲煞到屋角，沙发不可压梁。如果有突出的屋角放出暗箭，可摆设盆景或家俱化解。如果客厅呈L形，可用家俱将之隔成两个方形区域，视为两个独立的房间。例如，可将一个区域当成会客室，另一个区域当成起居室。</p><p>&nbsp;</p><p>　　2、大门与客厅应设玄关</p><p>　　风水要诀“喜回旋、忌直冲”。大门与客厅设置玄关或矮柜遮档，使内外有所缓冲，理气得以回旋后聚集于客厅，住宅内部也得到隐蔽，外边不易窥探。住宅内部隐蔽深藏，象征福气绵延。</p><p>&nbsp;</p><p>　　3、客厅间隔、房主孤独</p><p>　　从位置上说客厅是家人共用的场所，若因客厅宽敞而隔一部分做卧房在堪舆学上称为“自裁”，抽象点来说就是人为地将一个带公共活动的磁场空间“裁剪”了，在这“裁剪”小卧室里面休息的人，容易造成心态上的孤独感，如果是未婚者居住更难免有“知音难寻”之忧。</p><p>&nbsp;</p><p>　　4、财位不宜泄</p><p>　　进门客厅的对角线为峦头堪舆学上的财位，此处如果有柱子、凹位，窗户、可用植物、酒柜、饰柜阻挡，一方面令“财气”不致外漏，另一方面可以塑造出一个良好的财位，一举二得。</p><p>&nbsp;</p><p>　　5、横梁当头压抑</p><p>　　如果客厅内正好被横梁所“压”，巨大的心理压抑会令屋内人会在社会上备受压抑，难于得志，遇到这种情况可以用假天花遮盖或在梁上悬挂福鼠饰品加以化解或者在装修上设计成两个客厅。</p><p>&nbsp;</p><p>　　6、沙发成套才和谐</p><p>　　一般沙发肯定是整套摆设的，但不排除有些朋友因为空间大而将两套沙发放在一起或在一套沙发外再加放零散的沙发椅，这些做法在堪舆学上说是不利家人和睦的，因为摆放完整一套的沙发喻意着全家人上下一心，团结一致。</p><p>&nbsp;</p><p>　　7、前通后通、人财两空</p><p>　　从空间上说客厅的动线最宜开阔，视野一眼望穿让人心境豁达，所以入门处不宜看到房间门和后门，否则便有“前进后出”、“无法聚财之患”;另外，走道也应避免直向或横向贯穿整个客厅，这种家相正好应了一句堪舆俗语“前通后通，人财两空”。</p><p><br/></p>', '0', '50', '0', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('84', '53', '电脑放置的风水影响', '', '', ' 电脑在我们的生活工作中的作用，已经到了地球人都知道的程度了，如果说普通上班族的电脑，还是上班时间之用的话；对搜狐一族，宅男宅女来说，电脑就是他们的生命线，一日无鱼，三日', '<p>　　电脑在我们的生活工作中的作用，已经到了地球人都知道的程度了，如果说普通上班族的电脑，还是上班时间之用的话；对搜狐一族，宅男宅女来说，电脑就是他们的生命线，一日无鱼，三日无肉都可以忍受，唯独不能承受离开电脑。电脑已经成了他们生命中<span style="line-height: 2;">不可或缺的一员了。想一想，电脑对他们的影响会有多大。电脑的影响不仅仅是其辐射可能对人的健康产生影响，而且电脑的摆放位置，方向，还会对风水产生作用，从而对人的运势产生影响。我们从家居电脑的摆放位置、方位，来讲讲电脑风水可能会带来的后果，大家不妨结合自己家的实际情况来看看。&nbsp;</span></p><p>&nbsp;</p><p>　　1、请勿将电脑置于你的喜用神方向。&nbsp;</p><p>　　电脑置于喜用神方向，会压制你的贵人；如果你的命理还忌火的话，那就更要小心了。 举个例子，比如说你的喜用神为东方，你的命理忌火，你还把电脑放在了东方，这样的话木生火旺，对你的运势会产生极为不利的影响。</p><p>&nbsp;</p><p>　　2、电脑最好放在电脑桌的左边。&nbsp;</p><p>　　这对经常依靠电脑工作的人而言，是比较理想的方位。按风水方位学来说，就是“龙怕臭，虎怕动”，左方是吉方，放电脑最恰当。&nbsp;</p><p>&nbsp;</p><p>　　3、电脑对床者为电脑摆放大忌&nbsp;</p><p>　　电脑的显示器如果正对住了卧床，会影响人的精神和睡眠质量，建议最好做出调整。&nbsp;</p><p>&nbsp;</p><p>　　4、电脑要避免阳光直射&nbsp;</p><p>　　电脑放置的地方容易受到太阳直射的话，最易招惹是非，容易有口舌之争；但如果摆放在阴暗的地方，也容易情绪低沉，影响工作状态。</p><p>&nbsp;</p><p>　　5、避免电脑摆放在空气不流畅的地方</p><p>　　电脑最好摆放在空气比较流通的地方，这样不仅可以减小电脑的辐射，也不会对主人有太多影响；如果是摆在一个空气不太流通的地方会造你对外界反应缓慢，思路不清晰。</p><p>&nbsp;</p><p>　　6、电脑位置一定要远离水池、鱼缸等近水的地方。</p><p>　　近水的地方，容易让电脑受潮不说，还容易水火相克，诱发心血管类疾病。</p><p>&nbsp;</p><p>　　7、电脑周围不要摆放太多杂物</p><p>　　电脑周围有太多杂物，容易让人分心，产生杂念，无法专心工作。</p><p>&nbsp;</p><p>　　8、显示器最好与空间匹配</p><p>　　如果房间太小而却用了较大的显示器，容易造成亲朋疏远，同事远离，领导不太重视的情况；反之，如果房间大却用小的显示器，则容易被人忽略，甚至看不起。所以在显示器的选择上不是越大越好，而是与空间相匹配为宜。</p><p><br/></p>', '0', '50', '1', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('85', '53', '办公室风水的植物摆放', '', '', ' 从事多年办公风水的大师对办公室装修风水中植物摆放的建议： 1、东方五行属木，震卦，紫气东来：东方摆放红色的花对文案策划、编辑人员以及所有动脑工作的人员有利。 2、西方五行属金', '<p>　　从事多年办公风水的大师对办公室装修风水中植物摆放的建议：</p><p>　　1、东方五行属木，震卦，紫气东来：东方摆放红色的花对文案策划、编辑人员以及所有&quot;动脑&quot;工作的人员有利。</p><p>　　2、西方五行属金，兑卦，西方摆白、黄颜色的花可增加以“口”为生人员的&quot;锐气&quot;，比如如律师、销售、艺术家等有一定的帮助。</p><p>　　3、南方五行属火，离卦。南方摆放绿色植物可令办公室的女性提高个人美感和魅力;此方位摆红花则对投资者或弹性收入者有一定的催财旺财功效。</p><p>　　4、北方五行属水，坎卦，可摆放白色花，此举可有效改变员工之间以及上下级之间的紧张关系。</p><p>　　5、东南方五行属木，巽卦，是一个影响人际关系、恋爱和结婚运的方位，所以首选花卉颜色为粉色。</p><p>　　6、西南方五行属土，坤卦，办公室女领导的方位，最适宜放鲜艳的红色花;处于亚健康状态的人员可在此方摆放黄色花试试。</p><p>　　7、东北方五行属土，艮卦，该方位适合部门里的小字辈，摆放黄色的花有利于防止口舌是非发生。</p><p>　　8、西北五行属金，乾卦，是部门最高领导的方位，适合摆放白色和黄色的花卉，能提高领导威信和全体员工同心同德。</p><p>&nbsp;</p><p>　　上述是办公室设计时摆放鲜花的通用原则，如果需要仔细有个性化的摆放鲜花，那么，则需要考虑办公室人员的命理和办公室具体位理来进行，可谓是有的放矢吧。同时要注意的是，在办公室风水布局里，千万不要使用假花，因为其象征死亡与没落。</p><p>&nbsp;</p><p>　　如果在办公室中你觉得犯小人，老是有小人捣鬼，那么，建议你在办公桌左侧摆放或悬挂红色的鲜花或盆栽(仙人掌、仙人球为宜)，注意，鲜花要以3朵为宜。另外，办公桌右侧最好少摆放办公用品，因为是白虎位，需要谨慎。</p><p>&nbsp;</p><p>　　鲜花的寿命都很短，大多在一周之内，夏天会更短。尤其是象郁金香这样的鲜花两天左右就会凋谢。怎样能使鲜花保持的时间长一些呢?朋友们不妨试试：</p><p>　　1)首先鲜花的根部要斜着剪口，这样吸水的部位大，能够更多地吸收水分;</p><p>　　2)其次，要每天剪去一些，保证能够更好的吸收水分;</p><p>　　3)还有，花的叶子不要泡在水里，这样叶子会烂掉，所以一定要把浸在水里的叶子摘掉;</p><p>　　4)每天要换水。如果是夏天，为了保持水温不升高，还可以往花瓶里放几块冰;同时，花瓶里的水最好放满，这样不仅能使水的温度保持得长久些，还可以增加花瓶底部的重量，保证花瓶的稳定性。</p><p>　　5)为了使鲜花开的时间长一些，还可以往花瓶里放少许啤酒，或者将两片阿司匹林研成末放进去。可延长鲜花的寿命。</p><p>　　6)在一般家庭常买的几种鲜花中，郁金香的寿命最短，康乃馨的寿命最长。如果你的主人是又想漂亮又比较节约的人，你就要少买郁金香，多买康乃馨。尤其是夏天，郁金香很快就会枯萎。</p><p>　　7)还要注意一点，家庭中一般不要买菊花。因为菊花一般是用来上供的。</p><p>　　8)买几支绢花，与鲜花混合插入花瓶中，会使鲜花显得多而豪华。不同的绢花可与不同的鲜花相配反复使用。</p><p><br/></p>', '0', '50', '1', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('86', '53', '家居风水招财——9大禁忌你必须知道', '', '', ' 财位要明亮 家里的财位要明亮，不能经常处在黑暗的地方，打开灯光这个地方不能有暗影，要灯光能直射到这里，因为明亮则财运顺。昏暗不利于财运，且会使得运势上出现不稳的状况。 ·财', '<p>　　财位要明亮</p><p>　　家里的财位要明亮，不能经常处在黑暗的地方，打开灯光这个地方不能有暗影，要灯光能直射到这里，因为明亮则财运顺。昏暗不利于财运，且会使得运势上出现不稳的状况。</p><p>&nbsp;</p><p>　　·财位要适合坐</p><p>　　家里的财位下面如果是沙发或者椅子，自己人可以经常坐在下面，可以多带一些财气在身上。财位下面这个位置尽量不要让客户或者外人去坐，否则家里的财气可能会被外人带走。</p><p>&nbsp;</p><p>　　·财位适合睡</p><p>　　财位的下面也可是是床，人的一生大多数时间是在床上度过的，所以床位的凶吉对我们的运势有很大的影响，如果能够在财位上睡一睡，对我们的财运有很大的帮助。</p><p>&nbsp;</p><p>　　·财位招吉祥物品</p><p>我们如果可以再财位那里摆放一些吉祥的物件、工艺品等，会给财位锦上添花，吉上加吉。特别是碗装的黄金，吸财力会更大。</p><p>&nbsp;</p><p>&nbsp;</p><p>　　·财位要有生机</p><p>　　我们可以放一些枝繁叶茂的植被，但是要留意，这些植物需要是泥土里生长出来的，切勿摆放水生养出来的植物，因为水生养则意味着根基不稳。财位不要摆放有刺的类似仙人掌之类的植物，植物选用叶片较大的阔叶类植物，大叶的植物寓意大展宏图。</p><p>&nbsp;</p><p>　　·财位忌放沉重物品</p><p>　　财位受压是绝对不适宜的，大的衣柜、书柜等沉重物压在财位上，那将会对全家和整个公司的财运不利，还会整天感到压力重重，为财而累。</p><p>&nbsp;</p><p>　　·财位后要为实物</p><p>　　财位背后应该为墙，因为象征着财运上有靠山，保证无后顾之忧，这样才可藏风聚气。避免后面是空空的玻璃，如果是窗户，这个位置的窗户要尽量少打开，以避免向外散财，一定要让这个位聚住气。</p><p>&nbsp;</p><p>　　·财位上忌尖角物品</p><p>&nbsp;</p><p>　　·保持干净</p><p>　　风水学最忌尖角冲射，财位附近不要有尖角物，还应尽量避免摆放有尖角的物品。尖角类的物品会把财运冲走。</p><p>　　平时要注意打扫一下财位上的灰尘，保持干净一些，不要堆放杂物和放垃圾筒等，要移走，否则会污损财位，令财运大打折扣。</p><p><br/></p>', '0', '50', '1', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('87', '53', '金九银十结婚季，你家婚房怎么装', '', '', ' 家居室内的布置是非常重要的一个环节，家居内部我们都需要天天接触，他的风水效果并非外局所能比的。住宅的内部受到很多因素的牵扯，比如颜色布局、建材种类、光线照射、物品的凶吉', '<p>　　家居室内的布置是非常重要的一个环节，家居内部我们都需要天天接触，他的风水效果并非外局所能比的。住宅的内部受到很多因素的牵扯，比如颜色布局、建材种类、光线照射、物品的凶吉、动感设计等等，都是我们需要注意的一些因素。现在东易日盛小编就其中一些因素给大家予以说明。</p><p>&nbsp;</p><p><strong>　　【厕所忌在房屋中央位置】</strong></p><p>　　风水常说：中间污秽，一些房间的布局中央位置是厕所，在阳宅中被称为“污秽” ，应该及时避免。</p><p>&nbsp;</p><p><strong>　　【阳光充足】</strong></p><p>　　阳光充足的房间不仅仅对人身体好，在风水上阴暗较多的住宅也是极其不好的，就算是安装灯光去弥补，也不能修正内居。</p><p>&nbsp;</p><p>　　<strong>【内部线条要流畅</strong>】</p><p>　　东线流畅是内部布局第一应考量的事，一些刚刚学习阳宅的新手，为了得取心中理想的方位，内部线条修改的迂回难行，造成磁场紊乱。</p><p>&nbsp;</p><p><strong>　　【房间不宜过小】</strong></p><p>　　一些地产公司为了赢取大众的心理，把小面积的房间硬是挤成了三居室，房间非常小，放一张床之后几乎没有转身的余地，就会造成“气”进不来，就更称不上吉了。</p><p>&nbsp;</p><p><strong>　　【房顶不宜过低】</strong></p><p>　　楼层低压：早期有些房屋每层奇低无比，天花板装璜之后，头快顶到天了，这也要避免。</p><p>&nbsp;</p><p><strong>　　【鱼缸不宜过大】</strong></p><p>　　鱼缸：鱼缸在内部格局应用上相当普遍，除了造景之外，有隔间、化煞、催财等作用，加上灯光之后又有消除阴暗之效果。要注意的是水要保持干净，鱼缸要常清洗，鱼若有死亡应立及除去。鱼缸也不宜过大，以免造成室内湿气太大。</p><p><br/></p>', '0', '50', '0', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('88', '53', '家庭装修风水,普及客厅装修知识', '', '', ' 客厅在新房装修中是特别重要装修的地方，是家人公共休息、休闲、娱乐的场所。客厅的风水也是对一家人运势影响最大的地方。你或许不知道的客厅装修禁忌： 1、客厅格局宜方正 客厅的格', '<p>　　客厅在新房装修中是特别重要装修的地方，是家人公共休息、休闲、娱乐的场所。客厅的风水也是对一家人运势影响最大的地方。你或许不知道的客厅装修禁忌：</p><p>&nbsp;</p><p>　　1、客厅格局宜方正</p><p>　　客厅的格局最好是正方形或长方形，座椅区不可冲煞到屋角，沙发不可压梁。如果有突出的屋角放出暗箭，可摆设盆景或家俱化解。如果客厅呈L形，可用家俱将之隔成两个方形区域，视为两个独立的房间。例如，可将一个区域当成会客室，另一个区域当成起居室。</p><p>&nbsp;</p><p>　　2、大门与客厅应设玄关</p><p>　　风水要诀“喜回旋、忌直冲”。大门与客厅设置玄关或矮柜遮档，使内外有所缓冲，理气得以回旋后聚集于客厅，住宅内部也得到隐蔽，外边不易窥探。住宅内部隐蔽深藏，象征福气绵延。</p><p>&nbsp;</p><p>　　3、客厅间隔、房主孤独</p><p>　　从位置上说客厅是家人共用的场所，若因客厅宽敞而隔一部分做卧房在堪舆学上称为“自裁”，抽象点来说就是人为地将一个带公共活动的磁场空间“裁剪”了，在这“裁剪”小卧室里面休息的人，容易造成心态上的孤独感，如果是未婚者居住更难免有“知音难寻”之忧。</p><p>&nbsp;</p><p>　　4、财位不宜泄</p><p>　　进门客厅的对角线为峦头堪舆学上的财位，此处如果有柱子、凹位，窗户、可用植物、酒柜、饰柜阻挡，一方面令“财气”不致外漏，另一方面可以塑造出一个良好的财位，一举二得。</p><p>&nbsp;</p><p>　　5、横梁当头压抑</p><p>　　如果客厅内正好被横梁所“压”，巨大的心理压抑会令屋内人会在社会上备受压抑，难于得志，遇到这种情况可以用假天花遮盖或在梁上悬挂福鼠饰品加以化解或者在装修上设计成两个客厅。</p><p>&nbsp;</p><p>　　6、沙发成套才和谐</p><p>　　一般沙发肯定是整套摆设的，但不排除有些朋友因为空间大而将两套沙发放在一起或在一套沙发外再加放零散的沙发椅，这些做法在堪舆学上说是不利家人和睦的，因为摆放完整一套的沙发喻意着全家人上下一心，团结一致。</p><p>&nbsp;</p><p>　　7、前通后通、人财两空</p><p>　　从空间上说客厅的动线最宜开阔，视野一眼望穿让人心境豁达，所以入门处不宜看到房间门和后门，否则便有“前进后出”、“无法聚财之患”;另外，走道也应避免直向或横向贯穿整个客厅，这种家相正好应了一句堪舆俗语“前通后通，人财两空”。</p><p><br/></p>', '0', '50', '0', '0', '1', '0', '7');
INSERT INTO `th_article` VALUES ('161', '58', '1111111111', '/upload/image/20150617/20150617030132_21532.jpg', '', '11', '12', '1434510099', '50', '0', '0', '1', '1', '6');

-- ----------------------------
-- Records for `th_article_type`
-- ----------------------------
INSERT INTO `th_article_type` VALUES ('1', '0', '0', '公司简介', 'about', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', 'http://www.thcms.com/listhtml/45.html', '/upload/image/20150410/1428601018132348.jpg', '长沙心安装饰工程有限公司成立于2006年，于2011年增加注册资本金为600万元，是一家专业从事公共空间设计与施工的企业，本企业系国家建设部颁发的建筑装饰装修工程设计与施工一体化贰级资质；河南省建设厅建筑装饰协会理事单位；ISO9001质量、环境、职业健康安全管理体系认证通过企业。', '<p>
	长沙心安装饰工程有限公司成立于2006年，于2011年增加注册资本金为600万元，是一家专业从事公共空间设计与施工的企业，本企业系国家建设部颁发的建筑装饰装修工程设计与施工一体化贰级资质；河南省建设厅建筑装饰协会理事单位；ISO9001质量、环境、职业健康安全管理体系认证通过企业。
</p>
<p>
	<br />
</p>
<p>
	心安装饰为您提供企业整体解决方案，包括工程设计，装修施工、消防设计申报及工程、弱电安防空调机电工程、价值分析及成本估算、工程施工管理、企业VI标识系统设计及制作、产品推广及工业设计、人员招聘及岗前培训、办公家具及产品展柜定做、软装配饰等，致力于成为中国企业办公服务行业领导者。
</p>
<p>
	<br />
</p>
<p>
	企业目前拥有高级职称3人、中级职称6人、管理人员15人、各类工程技术人员20余人、各类中高级设计人员18人。目前，企业机构健全、机制灵活、设施齐全、内抓管理外树形象，能在较短的时间内完成一流的室内外装饰装修工程。
</p>
<p>
	<br />
</p>
<p>
	<span style="line-height:1em;"> 工程质量优良率占工程量的85%以上，工程质量合格率100%，各项技术指标都达到了合格以上标准，无发现一例质量安全及伤亡事故，多次获得省市级优质工程奖，连续3年获得河南省装饰装修行业先进企业称号，受到了上级主管部门和建设单位的一致好评，这些装修装饰工程的完成不仅取得良好的社会信誉，树立了企业形象，而且提高了企业的知名度，为企业发展奠定了更坚实的基础。</span> 
</p>
<p>
	<br />
</p>
<p>
	企业理念：培养一流企业团队，形成稳健企业作风，为客户提供专业、专人、专职的服务与支持，随时准备解决任何有关工程与设计服务的各种问题，与客户建立一种亲密的战略合作关系，公司以“以诚为本、以信立业”的经营理念，实现与客户朋友共同成长的目标。
</p>
<p>
	<br />
</p>
<p>
	只有客户的成功，我们才能成功。我们将以专业的精神、专业的技能、优质的服务为客户打造高品质的作品，努力争创一个令行业竞争对手尊敬的公司，客户青睐和首选的公司，员工值得依托、能够实现自我价值，为之而奋斗的家园。
</p>
<p>
	<br />
</p>
<p>
	企业目标：为客户提供一站式服务解决方案！全力打造中国公共空间设计与施工第一品牌！
</p>
<p>
	<br />
</p>', '10', '1', '1', '心安装饰', '1', '1427608081');
INSERT INTO `th_article_type` VALUES ('56', '54', '54', '办公室案例', '', 'list', '2', 'list_shop.html', 'article_shop.html', 'index_shop.html', '', '', '', '', '6', '50', '1', '', '1', '1428677134');
INSERT INTO `th_article_type` VALUES ('57', '54', '54', '专卖店案例', '', 'list', '2', 'list_shop.html', 'article_shop.html', 'index_shop.html', '', '', '', '', '6', '50', '1', '', '1', '1428677150');
INSERT INTO `th_article_type` VALUES ('58', '55', '54', '别墅案例', '', 'list', '2', 'list_shop.html', 'article_shop.html', 'index_shop.html', '', '', '', '', '6', '50', '1', '', '1', '1428677342');
INSERT INTO `th_article_type` VALUES ('59', '55', '54', '居家案例', '', 'list', '2', 'list_shop.html', 'article_shop.html', 'index_shop.html', '', '', '', '', '6', '50', '1', '', '1', '1428677361');
INSERT INTO `th_article_type` VALUES ('55', '54', '54', '家装案例', '', 'list', '2', 'list_shop.html', 'article_shop.html', 'index_shop.html', '', '', '', '', '6', '50', '1', '', '1', '1428677117');
INSERT INTO `th_article_type` VALUES ('54', '0', '0', '案例展示', '', 'list', '2', 'list_shop.html', 'article_shop.html', 'index_shop.html', '', '/upload/image/20150415/1429105870124736.jpg', '', '', '6', '3', '1', '', '1', '1428677078');
INSERT INTO `th_article_type` VALUES ('7', '0', '0', '装修知识', 'knowledge', 'list', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '/upload/image/20150410/1428601030579207.jpg', '', '', '2', '2', '1', '装饰公司', '1', '1427609708');
INSERT INTO `th_article_type` VALUES ('45', '1', '1', '关于我们', 'About', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', ' 长沙心安装饰工程有限公司成立于2006年，于2011年增加注册资本金为600万元，是一家专业从事公共空间设计与施工的企业，本企业系国家建设部颁发的建筑装饰装修工程设计与施工一体化贰级资', '<p>
	长沙心安装饰工程有限公司成立于2006年，于2011年增加注册资本金为600万元，是一家专业从事公共空间设计与施工的企业，本企业系国家建设部颁发的建筑装饰装修工程设计与施工一体化贰级资质；河南省建设厅建筑装饰协会理事单位；ISO9001质量、环境、职业健康安全管理体系认证通过企业。
</p>
<p>
	<br />
</p>
<p>
	心安装饰为您提供企业整体解决方案，包括工程设计，装修施工、消防设计申报及工程、弱电安防空调机电工程、价值分析及成本估算、工程施工管理、企业VI标识系统设计及制作、产品推广及工业设计、人员招聘及岗前培训、办公家具及产品展柜定做、软装配饰等，致力于成为中国企业办公服务行业领导者。
</p>
<p>
	<br />
</p>
<p>
	企业目前拥有高级职称3人、中级职称6人、管理人员15人、各类工程技术人员20余人、各类中高级设计人员18人。目前，企业机构健全、机制灵活、设施齐全、内抓管理外树形象，能在较短的时间内完成一流的室内外装饰装修工程。
</p>
<p>
	<br />
</p>
<p>
	工程质量优良率占工程量的85%以上，工程质量合格率100%，各项技术指标都达到了合格以上标准，无发现一例质量安全及伤亡事故，多次获得省市级优质工程奖，连续3年获得河南省装饰装修行业先进企业称号，受到了上级主管部门和建设单位的一致好评，这些装修装饰工程的完成不仅取得良好的社会信誉，树立了企业形象，而且提高了企业的知名度，为企业发展奠定了更坚实的基础。
</p>
<p>
	<br />
</p>
<p>
	企业理念：培养一流企业团队，形成稳健企业作风，为客户提供专业、专人、专职的服务与支持，随时准备解决任何有关工程与设计服务的各种问题，与客户建立一种亲密的战略合作关系，公司以“以诚为本、以信立业”的经营理念，实现与客户朋友共同成长的目标。
</p>
<p>
	<br />
</p>
<p>
	只有客户的成功，我们才能成功。我们将以专业的精神、专业的技能、优质的服务为客户打造高品质的作品，努力争创一个令行业竞争对手尊敬的公司，客户青睐和首选的公司，员工值得依托、能够实现自我价值，为之而奋斗的家园。
</p>
<p>
	<br />
</p>
<p>
	企业目标：为客户提供一站式服务解决方案！全力打造中国公共空间设计与施工第一品牌！
</p>
<p>
	1111111
</p>', '10', '50', '1', '', '1', '1427995666');
INSERT INTO `th_article_type` VALUES ('46', '1', '1', '经验理念', 'Believe', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', '​打造一流企业团队，形成稳健企业作风，为客户提供专业、专人、专职的服务与支持，随时准备解决任何有关工程与设计的各种问题，与客户建立一种亲密的战略合作伙伴，公司以“以诚为本、以信立业”的经营理念，实现与客户朋友共同成长的目标。', '<p>&nbsp;&nbsp;&nbsp;&nbsp;打造一流企业团队，形成稳健企业作风，为客户提供专业、专人、专职的服务与支持，随时准备解决任何有关工程与设计的各种问题，与客户建立一种亲密的战略合作伙伴，公司以“以诚为本、以信立业”的经营理念，实现与客户朋友共同成长的目标。</p><p>&nbsp;</p><p>　　公司的理念是只有客户的成功，我们才能成功。我们将以专业的精神、专业的技术、优质的服务为客户打造高品质的作品，努力争创一个令行业竞争对手尊敬的公司；客户青睐和首选的公司；员工值得依托、能实现自我价值，为之而奋斗的家园。</p><p>&nbsp;</p><p>　　企业目标：全力打造中国公共空间设计与施工第一品牌！为客户提供一站式服务解决方案！</p><p>&nbsp;</p><p>　　公司秉承“口碑相传，永续经营”的经营理念，力求达到“设计零缺憾、施工零缺点、材料零抱怨、品质零投诉”的“四 零”服务和“全过程、全天候、全方位、全身心”的“四全金牌”服务,秉承工厂化装修，为您省时，省心，省钱，省去多余的中间环节的省理念。</p><p>&nbsp;</p><p>　　教育和鼓励每一位员工“谦虚做人、努力做事”。以优秀的设计、严格的管理、精湛的工 艺、真诚的服务，让每一位客户都享受到独特而快乐的装修之旅。力求以舒适安逸、大气奢华的设计满足客户的多元需求</p><p><br/></p>', '10', '50', '1', '', '1', '1428247423');
INSERT INTO `th_article_type` VALUES ('49', '0', '0', '联系我们', 'Contact Us', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '/upload/image/20150415/1429105834351268.jpg', ' 湖南心安装饰工程有限公司 地址：长沙市郑汴路与建业路英协广场1号楼25C 电话：0731-3338888 全国服务热线：4000- 000-00 / 0731-3339999 联系人：冯先生 18733338888 乘车路线：BRT黄村站下车过人行天桥', '<p><br/></p><p>湖南心安装饰工程有限公司</p><p>地址：长沙市郑汴路与建业路英协广场1号楼25C</p><p>电话：0731-3338888 &nbsp; 全国服务热线：4000- 000-00 &nbsp;/ 0731-3339999</p><p>联系人：冯先生 18733338888</p><p>乘车路线：BRT黄村站下车过人行天桥，往东圃客运站方向前行200米园丁路即是。</p><p>公司传真：0731-3338888（座机暂时有故障，请拔打400电话或手机）</p><p>邮箱：service369@aliyun.com</p><p>网址：www.metinfo.cn</p><p><br/></p>', '0', '7', '1', '', '1', '1428285381');
INSERT INTO `th_article_type` VALUES ('52', '7', '7', '设计指南', 'Design', 'list', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', '', '', '3', '50', '1', '', '1', '1428599227');
INSERT INTO `th_article_type` VALUES ('53', '7', '7', '风水指南', 'Feng Shui', 'list', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', '', '', '5', '50', '1', '', '1', '1428599248');
INSERT INTO `th_article_type` VALUES ('50', '1', '1', '企业锋芒', 'Honor', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', '心安装饰，一个在十年前默默无闻的家装拓荒者，一个中国家装行业发展历程的见证者与推动者，一个如今满载盛誉的行业领袖…… ', '<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;五次装修革命 缔造川豪十年辉煌</strong></p><p>&nbsp;</p><p>　　心安装饰，一个在十年前默默无闻的家装拓荒者，一个中国家装行业发展历程的见证者与推动者，一个如今满载盛誉的行业领袖……&nbsp;</p><p>&nbsp;</p><p>　　回顾心安装饰十年来风风雨雨，从创业初期的几个人，发展到现在分公司遍布四川、贵州、重庆、安徽、广西等省市，拥有员工6000余人，集装饰、材料、木门生产销售于一体，年产值上亿元的集团化、集成化、工厂化和专业化的大型家居企业。其中的辛酸荣辱，也许只有心安装饰人自己才能感悟到，仰望无际的星空，闭目安神，川豪十年的铸剑历程就像电影胶片，一幕一幕在眼前闪过……&nbsp;</p><p>&nbsp;</p><p><strong>　　1、一个开启了家装精时代的行业领袖企业&nbsp;</strong></p><p>&nbsp;</p><p>　　国内家装行业从1997年开始成长，并逐渐走向有序。庞大的市场，高额的回报，使得其在高速发展的10年时间，诞生过很多行业新星，它们如雨后春笋般出现，又如昙花一现般消失，永久的成为了行业发展中的阶段性产物，无可奈何的充当了行业基石的角色，最终走进了历史的坟墓与边缘。&nbsp;</p><p>&nbsp;</p><p>　　靠着对工程与服务品质的不断提升与孜孜追求，并逐渐确立其核心竞争力地位，心安装饰以令人叹为观止的速度，日益发展壮大，在激烈的市场角逐中，沉淀下了一套基于市场，且已被业界与消费者公认领先行业体系标准，它就是“家装精时代”。&nbsp;</p><p>&nbsp;</p><p><strong>　　2、实景设计，现实空间与精准预算的操盘手&nbsp;</strong></p><p>&nbsp;</p><p>　　2006年底，心安装饰引进了震惊业界的实景设计系统，从此与各装饰龙头拉开了距离，逐步奠定了其以精为本的行业翘楚地位。“实景设计”系统，以其逼真的空间模拟功能，精准的材料预估与工程预价能力，成为家装行业之所以跨入“精时代”的一个重要科技支撑点，亦是川豪独步家装市场的专有法宝。实际操作中，只需将新房户型图输入实景设计系统，再输入设计、施工要求与所用材料、家居产品和配饰等信息，系统就会自动生成此套新房装修后的三维空间，由于空间效果逼真，且可以随意关注任何设计细节，基本实现了所见即所得，故称其为“实景”。&nbsp;</p><p>&nbsp;</p><p>　　 通过“实景设计”的仿真效果来检验设计是否合理，有效规避了由于设计不合理导致后期无法施工的问题，同时也能根据用户的需求，更换材料品种及颜色，还能通过其强大的材料方量统计功能，对材料用量作出精准的预算，甚至可以精确到半块砖的用量，第一次真正使顾客做到精确掌控装修预算。&nbsp;</p><p>&nbsp;</p><p><strong>　　3、远程监控，随时随地看自家工地&nbsp;</strong></p><p>&nbsp;</p><p>　　 施工环节是家装工程中最为核心的部分之一，工程品质的优劣直接关系到业主日后居住的安全与舒适。很多人根本没有条件进行现场监督，无奈家装工序繁复，环节众多，不监督不放心，请专业监理费用又太高。&nbsp;</p><p>&nbsp;</p><p>　　 心安装饰依托先进的互联网技术，结合业主的具体需求，通过在家装施工现场安装摄像头的方式，率先在行业内推出了“工地远程监控”系统，帮助业主实现了异地即时可视监控需求。&nbsp;</p><p>&nbsp;</p><p>　　 通过远程视频，可以清晰看到远在数十公里外的施工现场，整齐的材料码放，统一的工人着装，清洁的施工环境，有条不紊的施工进程……放心做家装，在川豪的科技演绎中，一切都成为了现实。&nbsp;</p><p>&nbsp;</p><p><strong>　　4、激光检测，家装领域的神秘武器&nbsp;</strong></p><p>&nbsp;</p><p>　　 传统家装施工中，由于缺乏必要的设备与技术，施工人员对踢脚线、辅设地砖、软饰、天花板十字线以及上下铅垂等基准情况，基本上都是采用目测手绘的方法来完成，必然造成较大误差。在后期施工中，极易出现很多无法弥补的问题，而传统家装从来没有这方面的检测仪器，业主没有具体数据，只能是听之任之。&nbsp;</p><p>&nbsp;</p><p>　　 在这种情况下，心安装饰再一次扮演了行业急先锋的角色，首家引进了激光检测设备，第一次将激光设备用在了家装行业。它可以对横平竖直的测量精确到毫米，一改过去靠目测手绘造成较大误差的情况，一个工地的工艺水准如何，一测便知，让业主对工程质量一目了然，心中有数，不用请人，也能对工程质量进行专家级的监督。&nbsp;</p><p>&nbsp;</p><p><strong>　　5、家装秘书，家装企业的升级服务模式&nbsp;</strong></p><p>&nbsp;</p><p>　 “买房子是上天堂，装修是下地狱！”&nbsp;</p><p>&nbsp;</p><p>　　 不少有过装修经历的人对这句话感触颇深。究其原因，乃是因为客户在装修过程中，通常会与家装公司多个部门多个负责人联系与交涉，使得信息的回馈显得比较分散，致使客户问题的处理协调不畅总是出现在家装公司内部，相互推委现象更是频有发生，以致客户怨声载道。&nbsp;</p><p>&nbsp;</p><p>　　 鉴于此，心安装饰率先在行业内推出了家装秘书服务体系。通过独立设置“家装秘书”服务岗位，面向广大客户，由专人负责从设计、选材、施工到后期服务的整个装修全程，统一受理各个装修环节中所有的客户问题。&nbsp;</p><p>&nbsp;</p><p>　　有了这个“神通广大”的秘书，客户在与川豪签单后遇到任何装修问题，都只需要与其进行单线联系，48小时之内就可以得到满意的解决。通过这种内部协调，快速反应的运作机制，真正让“省心做家装”的概念落到了实处。&nbsp;</p><p>&nbsp;</p><p>　　十年来，心安装饰创造了一个又一个行业神话，努力践行着自己“缔造完善空间，引领未来生活”的不懈使命。我们相信，在川豪管理者指挥家一般的睿智领导下，必将以其高远的志向为目标，昂首行进在行业的前沿！</p><p><br/></p>', '10', '50', '1', '', '1', '1428596997');
INSERT INTO `th_article_type` VALUES ('60', '0', '0', '心安服务', 'Service', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', 'http://www.thcms.com/listhtml/61.html', '/upload/image/20150415/1429105804193729.jpg', '', '', '10', '4', '1', '', '1', '1429104759');
INSERT INTO `th_article_type` VALUES ('61', '60', '60', '服务项目', 'Service Items', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', ' 多、快、好、省—天盛装饰为您打造全方位一站式家装服务！ 1 30天无理由退货 凡是客户在心安家居体验馆看到的材料工艺家具配饰等，支付定金之日起30天内，如对产品感到不满意、不合适、', '<p><strong>多、快、好、省—天盛装饰为您打造全方位一站式家装服务！</strong></p><p>&nbsp;</p><p><strong>　　1&gt;<span style="line-height: 2;">30天无理由退货</span></strong></p><p>　　凡是客户在心安家居体验馆看到的材料工艺家具配饰等，支付定金之日起30天内，如对产品感到不满意、不合适、不喜欢（不在30<span style="line-height: 2;">天无理由退货范围之内的除外)，可至</span>心安<span style="line-height: 2;">进行无理由退换货，不需作出任何解释。</span></p><p>&nbsp;</p><p><strong>　　2&gt;<span style="line-height: 2;">售出产品负全责</span></strong></p><p>　　凡在心安选购的产品，并持有心安装饰统一合同单据，或者有确实证据证明为在天盛家居体验馆内选购的产品，客户因<span style="line-height: 2;">产品质量问题(产品质量问题认定以国家相关法律法规为依据)而产生疑议与投诉，在国家法律规定的三包期限内，天盛装饰负责全</span><span style="line-height: 2;">程处理，并承担相应责任。</span></p><p>&nbsp;</p><p><strong>　　3&gt;<span style="line-height: 2;">倡导绿色环保政策</span></strong></p><p><span style="line-height: 2;">　　致力于倡导绿色环保，做行业领跑者，实行商户准入资质审查制度，力争达到所有材料工艺绿色环保，从健康、美观</span><span style="line-height: 2;">、实用角度出发，努力为客户营造温馨、和谐家园。郑重承诺装修不达标全额退款，另外支付5％赔偿金。</span></p><p>&nbsp;</p><p><strong>　　4&gt;<span style="line-height: 2;">送货安装准时达</span></strong></p><p>　　在心安家居体验馆经营的所有家具建材商家都必须按合同约定时间完成送货和安装任务否则就要承担违约责任。</p><p>&nbsp;</p><p><strong>　　5&gt;<span style="line-height: 2;">家居顾问全程导购</span></strong></p><p><span style="line-height: 2;">　　专业的家居顾问24时随时为您服务，根据您的生活需要，为您量身推荐家居采购方案为您省时省心。</span></p><p>&nbsp;</p><p><strong>　　6&gt;<span style="line-height: 2;">设计师免费咨询</span></strong></p><p><span style="line-height: 2;">　　所有</span>心安<span style="line-height: 2;">设计师可以根据您的需求为您提供免费的家装设计,家具设计咨询服务。</span></p><p><br/></p>', '0', '50', '1', '', '1', '1429104792');
INSERT INTO `th_article_type` VALUES ('62', '60', '60', '服务流程', 'Service Process ', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', ' 第1步 设计咨询 1.量房 2.设计方案 3.方案确认 ,沟通客户需求 4.签订合同 5.交纳首期款 第2步 施工前期 775影视 1.设计、施工现场交底，办理相关手续 2.填写专业服务流程单，现场工程量核准单', '<p><strong>第1步 设计咨询</strong></p><p>　　1.量房</p><p>　　2.设计方案</p><p>　　3.方案确认 ,沟通客户需求</p><p>　　4.签订合同</p><p>　　5.交纳首期款&nbsp;</p><p>&nbsp;</p><p><strong>　　第2步 施工前期 775影视</strong></p><p>　　1.设计、施工现场交底，办理相关手续</p><p>　　2.填写专业服务流程单，现场工程量核准单</p><p>　　3.进行拆除施工，布置现场</p><p>　　4.施工材料进场、验收</p><p>　　5.橱柜、卫浴柜、家具、成品木门测量</p><p>　　6.根据专业服务流程单选购产品，并参考</p><p>　　7.施工时间送货</p><p>　　8.隐蔽工程施工、验收，交纳合同中期款&nbsp;</p><p>&nbsp;</p><p><strong>　　第3步 施工中期&nbsp;</strong></p><p>　　1.水电管线完成</p><p>　　2.瓷砖进场，瓦工基层处理，厨房墙砖铺贴基本完成</p><p>　　3.橱柜、卫浴柜、家具复测（特殊情况下需进行木门复测）</p><p>　　4.木工收口</p><p>　　5.木工制作类吊顶材料进场、施工</p><p>　　6.五金类材料进场、安装</p><p>　　7.定制式产品签约</p><p>　　8.油工基层处理</p><p>　　9.中期验收，核算增减项并交纳增减项款&nbsp;</p><p>&nbsp;</p><p><strong>　　第4步 施工后期&nbsp;</strong></p><p>　　1.油工施工</p><p>　　2.非木工制作类吊顶材料进场、施工</p><p>　　3.地板、壁纸、散热器类产品铺装</p><p>　　4.木门、橱柜、卫浴柜、家具等安装</p><p>　　5.洁具、灯具、电工电料产品进场安装</p><p>　　6.自检清理&nbsp;</p><p>&nbsp;</p><p><strong>　　第5步 竣工验收&nbsp;</strong></p><p>　　1.自检清理</p><p>　　2.交纳尾款，办理保修&nbsp;</p><p>&nbsp;</p><p><strong>　　第6步 售后服务&nbsp;</strong></p><p><br/></p>', '0', '50', '1', '', '1', '1429104827');
INSERT INTO `th_article_type` VALUES ('63', '0', '0', '环保保障', 'Environmental Guarantee', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', 'http://www.thcms.com/listhtml/64.html', '/upload/image/20150415/1429105814700772.jpg', '', '', '10', '5', '1', '', '1', '1429104850');
INSERT INTO `th_article_type` VALUES ('64', '63', '63', '环境质量保障', 'Environmental Quality Assuranc', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', ' 环境质量保障: 决定工程品质的第三要素是环境，整洁、健康和人性的施工环境能够保障家装工程生态健康。生态型的施工环境，能够有效缓解疲劳，使施工人员神经放松，提高现场工作效率和', '<p><strong>　 &nbsp;环境质量保障:</strong></p><p>　　决定工程品质的第三要素是环境，整洁、健康和人性的施工环境能够保障家装工程生态健康。生态型的施工环境，能够有效缓解疲劳，使施工人员神经放松，提高现场工作效率和工作质量。 环保、整洁、以人为本，和谐之美，细节处彰显优质工程。</p><p>&nbsp;</p><p><span style="line-height: 2;">　　施工区和生活区严格区分：避免交叉&quot;感染&quot;。</span></p><p>　　辅材摆放处：正确码放，杜绝脏乱，提高效率。</p><p>　　甲供材料摆放处:一目了然，查缺补漏。</p><p>&nbsp;</p><p>　　木工操作台：精确制作，避免现场临时拼错，为木工质量助力。</p><p>　　更衣柜：衣有所归，鞋有所放。</p><p>　　饮水机：涓涓水流，保证健康。</p><p>　　水泥灰槽：杜绝水泥&quot;赖&quot;在地上。</p><p>　　临时坐便器：统一配置的临时洁具，保证施工环境整洁卫生。</p><p>　　工具箱：工具摆放有序，提高工作效率。现场杜绝明火，灭火器以防万一：为了保证施工现场的安<span style="line-height: 2;">防患于未然，杜绝火灾隐患，</span><span style="line-height: 2;">工程要求在施工现场至少要配置两个灭火器，复式和跃层每层至少配置1-2个。</span></p><p>　　施工铭牌、施工手册：两项举措监督施工进度。</p><p>　　施工基准线：精细施工，必不可少。</p><p>　　先行成品保护：不让客户的成品受半点&quot;伤害&quot;。</p><p>　　垃圾及时清理制度：杜绝垃圾&quot;藏身&quot;地下。</p><p>　　现场警告和温馨提示：监督提醒，严以律己。</p><p>　　确保整个施工过程和竣工后的管理服务完美无缺。</p><p><br/></p>', '0', '50', '1', '', '1', '1429104894');
INSERT INTO `th_article_type` VALUES ('65', '63', '63', '施工保障', 'Construction Guarantee', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', ' 对于每一项施工都建立了完善的系统管理监督机制，施工过程中的每一个环节都管理到位，力求确保工程质量从开始到结束的 完美。 专业的施工团队 专业的施工团队,规范的管理制度，先进的', '<p>&nbsp;&nbsp;&nbsp;&nbsp;对于每一项施工都建立了完善的系统管理监督机制，施工过程中的每一个环节都管理到位，力求确保工程质量从开始到结束的<span style="line-height: 2;">完美。</span></p><p>&nbsp;</p><p><strong>　　专业的施工团队</strong></p><p>　　专业的施工团队,规范的管理制度，先进的施工技能</p><p>&nbsp;</p><p><strong>　　全程有效的检验机制</strong></p><p>　　项目经理、巡检员、设计师定期巡检</p><p>　　总经理不定期抽检</p><p>　　客服专员回访</p><p>&nbsp;</p><p><strong>　　设计图纸标准化机制</strong></p><p>　　设计图纸的标准化规范化程度决定施工标准化和精准化的程度。为此心安装饰对于工程图纸制定了严格的标准。这些标准化的<span style="line-height: 2;">图纸能够确保施工按既定的规范和标准严格 执行，为客户的装修做保障</span></p><p>&nbsp;</p><p><strong>　　ERP质量信息登记机制</strong></p><p>　　心安装饰ERP系统，针对家装行业的特点，在售前咨询、工程实施及售后服务等几个方面加强了管理和跟踪，大大提高了工作精<span style="line-height: 2;">准度及服务质量和工作效率，实现了企业以客户为 本的价值理念</span></p><p>&nbsp;</p><p><strong>　　8小时快速反应机制</strong></p><p>　　心安装饰客服中心将由专人在8小时内就投诉内容建立详细的档案及解决方案</p><p>　　保证在24小时内圆满解决</p><p><br/></p>', '0', '50', '1', '', '1', '1429104955');
INSERT INTO `th_article_type` VALUES ('66', '63', '63', '施工标准', 'The Standard of Construction', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', ' 电路标准施工 标准水电路施工，先放线后施工，竣工线路做到横平竖直、电管在上水管在下。提倡厨卫水、电路顶面施工，既不费钱又能及时解决处理滴漏跑冒现象。使用安全无卤阻燃电线，', '<p><strong>　　电路标准施工</strong></p><p>　　标准水电路施工，先放线后施工，竣工线路做到横平竖直、电管在上水管在下。提倡厨卫水、电路顶面施工，既不费钱又能及时解决处理滴漏跑冒现象。使用安全无卤阻燃电线，取代黑胶布强弱线管有效间隔，采用电磁屏蔽技术，避免强电路和弱电路之间的干扰，保证良好的视频和音频效果。</p><p>&nbsp;</p><p><strong>　　轻钢龙骨标准施工</strong></p><p>　　轻钢龙骨取代木龙骨，全面升级，采用专用连接件</p><p>　　杜绝吊顶变形、开裂、虫蛀等现象，延长使用时间。</p><p>&nbsp;</p><p><strong>　　防水施工</strong></p><p>　　采用法国（韦伯）双组份防水灰浆，防水灰浆用于迎水及背水面防水工程，可密封发丝细的裂缝，可以省略防水完成后的拉毛处理。</p><p>&nbsp;</p><p><strong>　　材料码放</strong></p><p>　　整齐有序的材料码放会提高施工人员的施工质量要求，重要材料物流按照标准配额配送，杜绝偷工减料、以次充好。</p><p>&nbsp;</p><p><strong>　　涂料施工</strong></p><p>　　原装丹麦进口涂料，标准施工工艺，加上专属的调色设备，会为您涂刷出色彩亮丽的家。</p><p>&nbsp;</p><p><strong>　　现场勘察放线标识工艺</strong></p><p>　　施工现场进行精确勘测后，采用精确放线标示技术进行细致标注使得精细施工有据可依。</p><p>&nbsp;</p><p><strong>　　施工流程手册</strong></p><p>　　现场技术交底流程单，水电预算建立书面报告，各施工环节验收报告，使复杂的装修变成流程化，并明确客户经理岗位职责，留存联系方式。</p><p>　　客服人员24小时接听投诉、报修电话，2小时内安排施工人员联系客户，非紧急情况48小时上门维修。</p><p><br/></p>', '0', '50', '1', '', '1', '1429104987');
INSERT INTO `th_article_type` VALUES ('67', '0', '0', '设计理念', 'Design Concept', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '/upload/image/20150415/1429105823993173.jpg', ' 设计理念的诠释: 自然和谐、人文关怀、安全低耗 “自然一词有两个主要的含义：一是指的自然物的集合，二是指“本性”。而我们在此所提倡的健康家居设 和谐 中国古人关于“和谐”的概念', '<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;设计理念的诠释: 自然和谐、人文关怀、安全低耗</strong></p><p>　　“自然一词有两个主要的含义：一是指的自然物的集合，二是指“本性”。而我们在此所提倡的健康家居设</p><p>&nbsp;</p><p><strong>　　和谐</strong></p><p>　　中国古人关于“和谐”的概念中，首先就是把“和”与“利”联系在一起。古人说，利为义之和。也就是说，万物之间当然有利益冲突，只有消弭冲突，各自节制，不相争夺，才能达到和谐， 因此，“和谐”之“和”首先是调和、和解不同利益之“和”。</p><p>&nbsp;</p><p><strong>　　自然和谐</strong></p><p>　　通过自然物特有的属性遵循自然界的规律和法则，调和室内人文与物件，精神与物体，空间与结构，色调与采光，等多方面的冲突已达到心灵感受上的和谐舒适的健康居室环境。</p><p>&nbsp;</p><p><strong>　　人文</strong></p><p>　　人类的文化轨迹，人类现状文化背景，和通过改创未来人类文化的发展方向。它包括(历史的，民族的，区域的，个体的，集体的，宗教的，信仰的等)。而我们在这里只研究人类在室内环境的人文学科。</p><p>&nbsp;</p><p><strong>　　关怀</strong></p><p>　　关怀本是动词，但我们也经常用于形容词的范畴，如关怀式家装，它表示的是一种行为上的状态和程度，关怀代表着，服务，爱心，温馨、恬静、优雅、和谐、奋发向上。</p><p>&nbsp;</p><p><strong>　　人文关怀</strong></p><p>　　一个蕴含人文关怀的家居环境，会给人一个温馨、恬静、优雅、和谐、奋发向上的精神空间，从这个意义上来说，人文关怀与其说是民族文化的积淀，不如说是时代对室内设计的召唤。室内环境设计呼唤人文关怀！以人为本，关爱弱势人群，构筑无障碍生活。人文关怀设计倡导的是一种既与传统文脉相承、又结合现代功能与技术的要求与之相并进 。同时也记载了居住者在精神健康的文明程度的高低。</p><p>&nbsp;</p><p><strong>　　安全</strong></p><p>　　从英文SAFETY安全的解释是这样：保险，安全设备，保险装备。安全性在人居生活中体现的是一种生活状态的保障，那么健康家居设计将通过安全设备，安全用料，安全施工，安全的设计手法，便于维护等多方面使得人在任何时间任何状态都处于相对的健康状态。</p><p>&nbsp;</p><p><strong>　　低耗</strong></p><p>　　所谓健康家居的低耗，即是我们通过设计手段追求消耗最小的能源，资源和环境付出，而获取较大的室内环境质量和服务。低耗同时也是住者一种能源的储备。材料的再生和回收性。</p><p>&nbsp;</p><p><strong>　　安全低耗</strong></p><p>　　通过安全性的设计手段，在长期的居住环境中避免出现安全隐患问题，并达到最小的消耗获取最大的能源储备。体现出健康家居生活保障。我们有义务在更多的设计中找到低耗的每一种可能，不放过每一种低耗材料的替代品。</p><p><br/></p>', '0', '6', '1', '', '1', '1429105140');
INSERT INTO `th_article_type` VALUES ('68', '67', '67', '五大风格', 'Five Styles', 'page', '1', 'list_article.html', 'article_article.html', 'index_article.html', '', '', ' 在设计领域，心安更是领衔业界。业之峰的每一个设计风格、每一个设计元素、每一场发布会，都始终代表着业界的最前沿。早在2003年，心安就首次系统地提出室内设计应以人的生活方式为主', '<p>　　在设计领域，心安更是领衔业界。业之峰的每一个设计风格、每一个设计元素、每一场发布会，都始终代表着业界的最前沿。早在2003年，心安就首次系统地提出室内设计应以人的生活方式为主的理念，以此来提升室内设计文化及发展室内设计潮流。尤其是最近，结合现代都市人的生活特点，心安与国际知名设计机构联合研发出“五大主流风格”，更是成为了设计文化的中坚代表。</p><p>&nbsp;</p><p><strong>　　新古典风格</strong></p><p>　　新古典主义的设计风格是经过改良的古典主义风格。欧洲文化丰富的艺术底蕴，开放、创新的设计思想及其尊贵的姿容，一直以来颇受大众的喜爱。新古典风格从简单到繁杂、从整体到局部，精雕细琢，镶花刻金都给人一丝不苟的印象。新古典风格一方面保留了材质、色彩的大致风格，可以很强烈地感受传统的历史痕迹与浑厚的文化底蕴，同时又摒弃了过于复杂的肌理和装饰，简化了线条。</p><p>&nbsp;</p><p><strong>　　新中式风格</strong></p><p>　　新中式风格诞生于中国传统文化复兴的新时期，以含蓄秀美为主要特色。新中式风格表达的是对清雅含蓄、端庄丰华的东方式精神境界的追求。新中式风格通过对传统文化的认识，将现代元素和传统元素结合在一起，明清家具、窗棂、布艺床品相互辉映，以现代人的审美需求来打造富有传统韵味的事物，让传统艺术在当今社会得到合适的体现。</p><p>&nbsp;</p><p><strong>　　东南亚风格</strong></p><p>　　东南亚风格是东南亚民族岛屿特色及精致文化品位相结合的产物，是一种新兴的居住与休闲相结合的概念。对于追求理想，走在时代最前沿的人来说，东南亚风格不仅仅代表着一种地方风情，而是共同期待和追求的理想归宿。粗犷而狂放的线条，取源于大自然的真实质感，表达舒适、自由、放纵的想法，温馨的家透出高贵、典雅的气质。</p><p>&nbsp;</p><p><strong>　　美式风格</strong></p><p>　　美式风格由美国西部乡村的生活方式演变而来，它摒弃了过多的繁琐与奢华，兼具古典主义的优美造型与新古典主义的功能配备，既简洁明快，又温暖舒适，强调“回归自然”。美式风格讲求自在、随意不羁的生活方式，没有太多造作的修饰与约束，不经意中也成就了另外一种休闲式的浪漫。美式风格特点：空间要明快光鲜，通常使用大量的石材和木饰面装饰。</p><p>&nbsp;</p><p><strong>　　现代风格</strong></p><p>　　现代风格即现代主义风格，提倡突破传统，创造革新，重视功能和空间组织，注重发挥结构本身的形式美。现代主义造型简洁，反对多余装饰，崇尚合理的构成工艺，设计表现得简约而不简单，时尚而又典雅，整体空间表现得深沉、雅致又不失灵性。</p><p><br/></p>', '0', '50', '1', '', '1', '1429105172');
INSERT INTO `th_article_type` VALUES ('69', '49', '49', '在线反馈', 'Feedback', 'page', '1', 'list_article.html', 'article_article.html', 'index_message.html', '', '', '', '', '0', '50', '1', '', '1', '1429105260');

-- ----------------------------
-- Records for `th_flink`
-- ----------------------------
INSERT INTO `th_flink` VALUES ('1', '百度一下', 'http://www.baidu.com', '/upload/image/20150418/1429328701115742.jpg', '1', '1429328835', '2', '1');
INSERT INTO `th_flink` VALUES ('5', '123', 'http://www.baidu.com', '/upload/image/20150418/1429328701115742.jpg', '1', '1429332170', '1', '1');

-- ----------------------------
-- Records for `th_member`
-- ----------------------------
INSERT INTO `th_member` VALUES ('15', '1', 'abc1', '123123', '0ea21b1f7886895926e44d89865d7bd7', '/data/images/dfboy.png', 'b', '15013346978', '', '1096831030@qq.com', '', '', '1429458562', 'y', '');
INSERT INTO `th_member` VALUES ('16', '1', '123', '阳光小男孩', 'e10adc3949ba59abbe56e057f20f883e', '/upload/face/20150509172359.jpg', 'b', '15013346975', '8255446', '1096831032@qq.com', '1096831030', '1096831030', '1429459722', 'y', '1431184066');
INSERT INTO `th_member` VALUES ('17', '1', 'test', '粒粒', '0ea21b1f7886895926e44d89865d7bd7', '/data/images/dfboy.png', 'b', '15013346973', '', '1096831031@qq.com', '', '', '1432805483', 'y', '');

-- ----------------------------
-- Records for `th_member_group`
-- ----------------------------
INSERT INTO `th_member_group` VALUES ('1', '普通会员', '', '');
INSERT INTO `th_member_group` VALUES ('2', '中级会员', '', '');
INSERT INTO `th_member_group` VALUES ('3', '高级会员', '', '');

-- ----------------------------
-- Records for `th_message`
-- ----------------------------
INSERT INTO `th_message` VALUES ('32', '李关生', '15013346978', '3152238253@qq.com', '广州市天河区', 'b', '这是我的留言', '1429284194', '1');
INSERT INTO `th_message` VALUES ('33', '网站管理员', '15013346978', '123456@qq.com', '广州市天河区', 'b', 'fasdfsdfsafasdfsdfsadfsadfasfdasdfsadfsadfsadfsadfsafdsafdsafdafasdfsdfasdfasdfasdfasfdasdfasdfasdfasdfsafdsfasdfsdfsdfsdfsadfadfsdfsadfsadfsdf', '1429288595', '1');
INSERT INTO `th_message` VALUES ('34', '网站管理员', '15013346978', '3152238253@qq.com', '请输入您所在的城市', 'b', 'aaaaaaaaa', '1434608118', '0');

-- ----------------------------
-- Records for `th_model`
-- ----------------------------
INSERT INTO `th_model` VALUES ('1', '文章模型', 'list_article.html', 'article_article.html', 'index_article.html', 'arc_add.php', 'addarticle', '1');
INSERT INTO `th_model` VALUES ('2', '商品模型', 'list_shop.html', 'article_shop.html', 'index_shop.html', 'shop_add.php', 'addshop', '1');
INSERT INTO `th_model` VALUES ('3', '测试模型', 'list_test.html', 'article_test.html', 'index_test.html', 'test_add.php', 'addtest', '1');

-- ----------------------------
-- Records for `th_node`
-- ----------------------------
INSERT INTO `th_node` VALUES ('2', '2', '查看用户', '1', '1427261154');
INSERT INTO `th_node` VALUES ('3', '2', '添加用户', '1', '1427261179');
INSERT INTO `th_node` VALUES ('4', '2', '修改用户', '1', '1427268685');
INSERT INTO `th_node` VALUES ('5', '2', '删除用户', '1', '1427268722');
INSERT INTO `th_node` VALUES ('6', '2', '查看用户组', '1', '1427268767');
INSERT INTO `th_node` VALUES ('7', '2', '添加用户组', '1', '1427268774');
INSERT INTO `th_node` VALUES ('8', '2', '修改用户组', '1', '1427268783');
INSERT INTO `th_node` VALUES ('9', '2', '删除用户组', '1', '1427268826');
INSERT INTO `th_node` VALUES ('10', '3', '查看栏目', '1', '1427268873');
INSERT INTO `th_node` VALUES ('11', '3', '添加栏目', '1', '1427268885');
INSERT INTO `th_node` VALUES ('12', '3', '修改栏目', '1', '1427268897');
INSERT INTO `th_node` VALUES ('13', '3', '删除栏目', '1', '1427268910');
INSERT INTO `th_node` VALUES ('14', '3', '查看文章', '1', '1427268935');
INSERT INTO `th_node` VALUES ('15', '3', '添加文章', '1', '1427268948');
INSERT INTO `th_node` VALUES ('16', '3', '修改文章', '1', '1427268957');
INSERT INTO `th_node` VALUES ('17', '3', '删除文章', '1', '1427268964');
INSERT INTO `th_node` VALUES ('18', '4', '查看分类', '1', '1427268999');
INSERT INTO `th_node` VALUES ('19', '4', '添加分类', '1', '1427269007');
INSERT INTO `th_node` VALUES ('20', '4', '修改分类', '1', '1427269025');
INSERT INTO `th_node` VALUES ('21', '4', '删除分类', '1', '1427269034');
INSERT INTO `th_node` VALUES ('22', '4', '查看轮换图', '1', '1427269068');
INSERT INTO `th_node` VALUES ('23', '4', '添加轮换图', '1', '1427269082');
INSERT INTO `th_node` VALUES ('24', '4', '修改轮换图', '1', '1427269092');
INSERT INTO `th_node` VALUES ('25', '4', '删除轮换图', '1', '1427269104');
INSERT INTO `th_node` VALUES ('26', '5', '网站基本信息', '1', '1427277384');
INSERT INTO `th_node` VALUES ('27', '6', '查看广告位', '1', '1427303326');
INSERT INTO `th_node` VALUES ('28', '6', '添加广告位', '1', '1427303335');
INSERT INTO `th_node` VALUES ('29', '6', '修改广告位', '1', '1427303345');
INSERT INTO `th_node` VALUES ('30', '6', '删除广告位', '1', '1427303358');
INSERT INTO `th_node` VALUES ('31', '2', '分配权限', '1', '1427347742');
INSERT INTO `th_node` VALUES ('32', '5', '备份数据库', '1', '1427386829');
INSERT INTO `th_node` VALUES ('34', '7', '查看留言', '1', '1429284426');
INSERT INTO `th_node` VALUES ('35', '7', '删除留言', '1', '1429284451');
INSERT INTO `th_node` VALUES ('36', '8', '查看友情链接', '1', '1429326633');
INSERT INTO `th_node` VALUES ('37', '8', '添加友情链接', '1', '1429326652');
INSERT INTO `th_node` VALUES ('38', '8', '修改友情链接', '1', '1429326670');
INSERT INTO `th_node` VALUES ('39', '8', '删除友情链接', '1', '1429326693');
INSERT INTO `th_node` VALUES ('40', '9', '查看会员列表', '1', '1432804281');
INSERT INTO `th_node` VALUES ('41', '9', '添加会员', '1', '1432804310');
INSERT INTO `th_node` VALUES ('42', '9', '修改会员', '1', '1432804324');
INSERT INTO `th_node` VALUES ('43', '9', '删除会员', '1', '1432804341');
INSERT INTO `th_node` VALUES ('44', '9', '查看会员组', '1', '1432804371');
INSERT INTO `th_node` VALUES ('45', '9', '添加会员组', '1', '1432804402');
INSERT INTO `th_node` VALUES ('46', '9', '修改会员组', '1', '1432804417');
INSERT INTO `th_node` VALUES ('47', '9', '删除会员组', '1', '1432804435');

-- ----------------------------
-- Records for `th_node_type`
-- ----------------------------
INSERT INTO `th_node_type` VALUES ('3', '栏目内容管理', '1', '1427254989');
INSERT INTO `th_node_type` VALUES ('2', '用户管理', '1', '1427253634');
INSERT INTO `th_node_type` VALUES ('4', '轮换图管理', '1', '1427268982');
INSERT INTO `th_node_type` VALUES ('5', '系统设置', '1', '1427277372');
INSERT INTO `th_node_type` VALUES ('6', '广告位管理', '1', '1427303301');
INSERT INTO `th_node_type` VALUES ('7', '在线留言', '1', '1429284412');
INSERT INTO `th_node_type` VALUES ('8', '友情链接', '1', '1429288712');
INSERT INTO `th_node_type` VALUES ('9', '会员管理', '1', '1432803892');

-- ----------------------------
-- Records for `th_role`
-- ----------------------------
INSERT INTO `th_role` VALUES ('1', '特殊管理员');
INSERT INTO `th_role` VALUES ('2', '超级管理员');
INSERT INTO `th_role` VALUES ('24', '网站编辑');

-- ----------------------------
-- Records for `th_role_user`
-- ----------------------------
INSERT INTO `th_role_user` VALUES ('2', '21');
INSERT INTO `th_role_user` VALUES ('2', '15');
INSERT INTO `th_role_user` VALUES ('0', '22');
INSERT INTO `th_role_user` VALUES ('1', '1');
INSERT INTO `th_role_user` VALUES ('24', '23');
INSERT INTO `th_role_user` VALUES ('24', '24');

-- ----------------------------
-- Records for `th_rotation`
-- ----------------------------
INSERT INTO `th_rotation` VALUES ('25', '1', '2', '', '/upload/image/20150410/1428596288120196.jpg', '2', '1', '1', '1428596291');
INSERT INTO `th_rotation` VALUES ('24', '1', '1', 'http://www.baidu.com', '/upload/image/20150524/20150524173105_40119.jpg', '1', '1', '1', '1428596278');
INSERT INTO `th_rotation` VALUES ('27', '1', '4', '', '/upload/image/20150410/1428596482261030.jpg', '4', '1', '1', '1428596485');
INSERT INTO `th_rotation` VALUES ('26', '1', '3', '', '/upload/image/20150410/1428596301517500.jpg', '3', '1', '1', '1428596304');

-- ----------------------------
-- Records for `th_rotation_type`
-- ----------------------------
INSERT INTO `th_rotation_type` VALUES ('1', '首页轮换图', '1', '1427187947');

