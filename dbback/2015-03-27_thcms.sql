-- ----------------------------
-- 日期：2015-03-27 00:18:21
-- Power by 李关生(1096831030@qq.com)
-- 仅用于测试和学习,本程序不适合处理超大量数据
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='广告位表';

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Table structure for `th_article`
-- ----------------------------
DROP TABLE IF EXISTS `th_article`;
CREATE TABLE `th_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL COMMENT '栏目id',
  `title` varchar(150) NOT NULL COMMENT '标题',
  `litpic` varchar(150) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='文章表';

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
  `typetpl` varchar(150) NOT NULL COMMENT '栏目模板',
  `typelink` varchar(150) NOT NULL,
  `litpic` varchar(150) NOT NULL COMMENT '栏目缩略图',
  `typedesc` varchar(400) NOT NULL,
  `typecontent` text NOT NULL,
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(11) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `keyword` varchar(250) NOT NULL COMMENT '栏目关键字',
  `m_id` tinyint(4) NOT NULL COMMENT '管理员id',
  `creattime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COMMENT='栏目表';

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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='节点表';

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='节点类型表';

-- ----------------------------
-- Table structure for `th_role`
-- ----------------------------
DROP TABLE IF EXISTS `th_role`;
CREATE TABLE `th_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='角色表';

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
  `isnewwindow` tinyint(4) NOT NULL,
  `litpic` varchar(150) NOT NULL COMMENT '轮换图',
  `sort` tinyint(3) unsigned NOT NULL COMMENT '排序',
  `status` tinyint(4) NOT NULL COMMENT '状态',
  `m_id` tinyint(4) NOT NULL,
  `creattime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='轮换图内容表';

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='轮换图专用表';

-- ----------------------------
-- Table structure for `th_website`
-- ----------------------------
DROP TABLE IF EXISTS `th_website`;
CREATE TABLE `th_website` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `web_host` varchar(100) NOT NULL,
  `web_name` varchar(100) NOT NULL,
  `web_keyword` varchar(200) NOT NULL,
  `web_description` varchar(300) NOT NULL,
  `web_beian` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='网站信息表';

-- ----------------------------
-- Records for `th_access`
-- ----------------------------
INSERT INTO `th_access` VALUES ('2', '29');
INSERT INTO `th_access` VALUES ('2', '28');
INSERT INTO `th_access` VALUES ('2', '27');
INSERT INTO `th_access` VALUES ('2', '26');
INSERT INTO `th_access` VALUES ('2', '24');
INSERT INTO `th_access` VALUES ('2', '23');
INSERT INTO `th_access` VALUES ('2', '22');
INSERT INTO `th_access` VALUES ('2', '20');
INSERT INTO `th_access` VALUES ('2', '19');
INSERT INTO `th_access` VALUES ('2', '18');
INSERT INTO `th_access` VALUES ('2', '16');
INSERT INTO `th_access` VALUES ('2', '15');
INSERT INTO `th_access` VALUES ('2', '14');
INSERT INTO `th_access` VALUES ('2', '12');
INSERT INTO `th_access` VALUES ('22', '23');
INSERT INTO `th_access` VALUES ('22', '22');
INSERT INTO `th_access` VALUES ('22', '16');
INSERT INTO `th_access` VALUES ('22', '15');
INSERT INTO `th_access` VALUES ('22', '14');
INSERT INTO `th_access` VALUES ('22', '12');
INSERT INTO `th_access` VALUES ('22', '11');
INSERT INTO `th_access` VALUES ('21', '25');
INSERT INTO `th_access` VALUES ('21', '24');
INSERT INTO `th_access` VALUES ('21', '23');
INSERT INTO `th_access` VALUES ('21', '22');
INSERT INTO `th_access` VALUES ('21', '21');
INSERT INTO `th_access` VALUES ('21', '20');
INSERT INTO `th_access` VALUES ('21', '19');
INSERT INTO `th_access` VALUES ('21', '18');
INSERT INTO `th_access` VALUES ('21', '17');
INSERT INTO `th_access` VALUES ('21', '16');
INSERT INTO `th_access` VALUES ('21', '15');
INSERT INTO `th_access` VALUES ('21', '14');
INSERT INTO `th_access` VALUES ('21', '13');
INSERT INTO `th_access` VALUES ('21', '12');
INSERT INTO `th_access` VALUES ('21', '11');
INSERT INTO `th_access` VALUES ('21', '10');
INSERT INTO `th_access` VALUES ('2', '11');
INSERT INTO `th_access` VALUES ('2', '10');
INSERT INTO `th_access` VALUES ('2', '6');
INSERT INTO `th_access` VALUES ('2', '2');

-- ----------------------------
-- Records for `th_ad`
-- ----------------------------
INSERT INTO `th_ad` VALUES ('8', '联系我们--电话', '<p style="line-height: 1.5em;"><a href="http://www.crcn.hk/Email:gzcrcn@yeah.net" _src="http://www.crcn.hk/Email:gzcrcn@yeah.net">www.crcn.hk/Email:gzcrcn@yeah.net</a>&nbsp;</p><p style="line-height: 1.5em;">TEL:+86 020-1234&amp;1234 &nbsp;FAX:+86 020-1234&amp;1234</p><p style="line-height: 1.5em;">中国-广州市海珠区工业大道南大干围 38 号海珠创意园10栋211室</p>', '1', '1', '1427378504');

-- ----------------------------
-- Records for `th_admin`
-- ----------------------------
INSERT INTO `th_admin` VALUES ('1', 'tenghoo', '21232f297a57a5a743894a0e4a801fc3', 'y', '1426827647');
INSERT INTO `th_admin` VALUES ('21', 'test', 'e10adc3949ba59abbe56e057f20f883e', 'y', '1426946954');

-- ----------------------------
-- Records for `th_article`
-- ----------------------------
INSERT INTO `th_article` VALUES ('17', '21', '玖姿女装 直筒名媛奢华风衣外套', '/ueditor/php/upload/image/20150325/1427288144810933.jpg', ' 玖姿女装 直筒名媛奢华风衣外套玖姿女装 直筒名媛奢华风衣外套玖姿女装 直筒名媛奢华风衣外套玖姿女装 直筒名媛奢华风衣外套玖姿女装 直筒名媛奢华风衣外套玖姿女装 直筒名媛奢华风衣', '<p>品名:玖姿女装 直筒名媛奢华风衣外套</p><p>此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p>采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p>能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p>用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p>反光片规格：1、48cm*48cm</p><p>2、48cm*100米</p><p>反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p>', '1427285128', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('18', '21', 'OL收腰显瘦短风衣 玖姿女装2014新款', '/ueditor/php/upload/image/20150325/1427288154637687.jpg', ' OL收腰显瘦短风衣 玖姿女装2014新款 OL收腰显瘦短风衣 玖姿女装2014新款 OL收腰显瘦短风衣 玖姿女装2014新款 OL收腰显瘦短风衣 玖姿女装2014新款 OL收腰显瘦短风衣 玖姿女装2014新款 OL收腰显瘦短', '<p style="white-space: normal;">品名:OL收腰显瘦短风衣 玖姿女装2014新款</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p style="white-space: normal;">反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285147', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('19', '21', '简洁大气款风衣 玖姿休闲修身系腰带女装', '/ueditor/php/upload/image/20150325/1427288164108616.jpg', ' 简洁大气款风衣 玖姿休闲修身系腰带女装 简洁大气款风衣 玖姿休闲修身系腰带女装 简洁大气款风衣 玖姿休闲修身系腰带女装 简洁大气款风衣 玖姿休闲修身系腰带女装 简洁大气款风衣 玖姿', '<p style="white-space: normal;">品名:简洁大气款风衣 玖姿休闲修身系腰带女装</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p style="white-space: normal;">反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285167', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('20', '21', '时尚新款风衣系列 玖姿泡泡袖连帽风衣', '/ueditor/php/upload/image/20150325/1427288175189985.jpg', ' 玖姿女装 直筒名媛奢华风衣外套 玖姿女装 直筒名媛奢华风衣外套 玖姿女装 直筒名媛奢华风衣外套 玖姿女装 直筒名媛奢华风衣外套 玖姿女装 直筒名媛奢华风衣外套 玖姿女装 直筒名媛奢华风', '<p style="white-space: normal;">品名:时尚新款风衣系列 玖姿泡泡袖连帽风衣</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p style="white-space: normal;">反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285188', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('21', '21', '玖姿女装欧美时尚系带长袖风衣', '/ueditor/php/upload/image/20150325/1427293565717770.jpg', ' 玖姿女装欧美时尚系带长袖风衣 玖姿女装欧美时尚系带长袖风衣 玖姿女装欧美时尚系带长袖风衣 玖姿女装欧美时尚系带长袖风衣 玖姿女装欧美时尚系带长袖风衣 玖姿女装欧美时尚系带长袖风', '<p style="white-space: normal;">品名:玖姿女装欧美时尚系带长袖风衣</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p style="white-space: normal;">反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285211', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('22', '21', '玖姿英伦风女装 通勤大气格纹风衣系列', '/ueditor/php/upload/image/20150325/1427288190168899.jpg', ' 玖姿英伦风女装 通勤大气格纹风衣系列 玖姿英伦风女装 通勤大气格纹风衣系列 玖姿英伦风女装 通勤大气格纹风衣系列 玖姿英伦风女装 通勤大气格纹风衣系列 玖姿英伦风女装 通勤大气格纹', '<p style="white-space: normal;">品名:玖姿英伦风女装 通勤大气格纹风衣系列</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p style="white-space: normal;">反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285227', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('23', '21', '奢华复古感双排扣修身短风衣', '/ueditor/php/upload/image/20150325/1427288201259481.jpg', ' 奢华复古感双排扣修身短风衣 奢华复古感双排扣修身短风衣 奢华复古感双排扣修身短风衣 奢华复古感双排扣修身短风衣 奢华复古感双排扣修身短风衣 奢华复古感双排扣修身短风衣 奢华复古', '<p style="white-space: normal;">品名:奢华复古感双排扣修身短风衣</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p>反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p>反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285244', '4', '1', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('24', '27', 'Topsky 远行客 户外登山包双肩包男女户外旅游旅行登山背包户外包', '/ueditor/php/upload/image/20150325/1427295489764244.jpg', ' 多层设计，专业的配件设计：D型扣，求生口哨，饮水系统扣件，弹力水壶仓，便于放更多物品。 悬浮透气背负系统，大蜂巢16D透气网格，加厚防震肩带，有效的给使用者提供舒适无压的背负平', '<p>多层设计，专业的配件设计：D型扣，求生口哨，饮水系统扣件，弹力水壶仓，便于放更多物品。</p><p>悬浮透气背负系统，大蜂巢16D透气网格，加厚防震肩带，有效的给使用者提供舒适无压的背负平台。</p><p>432D高密度STORM BREATH防水尼龙科技面料的特殊性结构赋予它优质的防水性，耐磨性，耐撕裂和无与伦比的速度，具有良好的手感和质感。</p><p>链采用进口SBS拉链，经过严格测试实验，可拉合32万次以上，雨天防生锈。</p><p>顶级储存系统，大容量便于放更多物品。</p><p><br/></p>', '1427295170', '3', '1', '1', '1', '1', '0');
INSERT INTO `th_article` VALUES ('25', '22', 'KING BIKE 金巴克 KINGBIKE夏季男款短袖套装山地车服装 吸湿排汗骑行套装', '/ueditor/php/upload/image/20150325/1427296089869500.jpg', ' 上市时间: 2013年春季 品牌: KING BIKE/金巴克 型号: 龙沙2 颜色分类: 魔界绿 绿野仙踪 火山 魔界兰 烈锋 货号: JBK-651A 骑行服款式: 短袖骑行套装 适用对象: 男 适用季节: 夏季 尺码: S M L XL XXL XXXL', '<p>上市时间: 2013年春季</p><p>品牌: KING BIKE/金巴克</p><p>型号: 龙沙2</p><p>颜色分类: 魔界绿 绿野仙踪 火山 魔界兰 烈锋</p><p>货号: JBK-651A</p><p>骑行服款式: 短袖骑行套装</p><p>适用对象: 男</p><p>适用季节: 夏季</p><p>尺码: S M L XL XXL XXXL</p><p><br/></p>', '1427296115', '2', '1', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('26', '22', 'Lance SoBike速盟 春秋骑行服 长袖抓绒套装 自行车服装 男款 脸谱', '/ueditor/php/upload/image/20150325/1427296165375753.jpg', ' 1.采用升级版CATHE抓绒材料,弹力较之前的增加1.6倍,兼具排汗和保暖效果。 2.后置三个专业竞赛口袋,方便放置水壶等一些小物品。后口袋两侧反光片设计,使骑行时更加安全。 3.使用意大利进口墨', '<p>1.采用升级版CATHE抓绒材料,弹力较之前的增加1.6倍,兼具排汗和保暖效果。</p><p>2.后置三个专业竞赛口袋,方便放置水壶等一些小物品。后口袋两侧反光片设计,使骑行时更加安全。</p><p>3.使用意大利进口墨水热转印技术，颜色亮丽且永不褪色。</p><p>4.采用新型升级DOBY3D抗菌坐垫, 坐垫面布特别添加绒面设计,在秋冬季节骑行时更加舒适</p><p>5.脚口装有防滑皮筋,防止骑行时裤脚上移.脚口采用YKK拉链,穿脱更方便.适合10——20℃左右骑行</p><p><br/></p>', '1427296181', '1', '1', '0', '1', '1', '10');
INSERT INTO `th_article` VALUES ('27', '16', '中国户外文化运动联盟来岚皋考察全域旅游', '', ' 由南宫山旅游公司组织举办的中国户外文化运动联盟全域旅游推介会在岚皋举行。来自省市周边30个团队40余个户外运动旅行社参加会议。 推介会上，各旅行社负责人对岚皋的旅游基础设施、环', '<p>&nbsp;&nbsp;&nbsp;&nbsp;由南宫山旅游公司组织举办的中国户外文化运动联盟全域旅游推介会在岚皋举行。来自省市周边30个团队40余个户外运动旅行社参加会议。</p><p>　　推介会上，各旅行社负责人对岚皋的旅游基础设施、环境保障、经营理念、包装项目等旅游后期开发的提出了很好的意见和建议。并表示，岚皋的山水优势将会成为户外运动爱好者追逐的首选地方，回去以后，将进一步加大宣传岚皋旅游，让更多的人来岚皋观光、投资、旅游。</p><p><br/></p>', '1427298561', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('28', '16', ' 合肥桃花节主题活动精彩上演 可体验农耕文化听户外音乐会', '', ' 3月21日，合肥三十岗桃花节开幕后首个周末。当天，不少市民来此赏桃花，很多年轻人手持自拍神器为自己留下照片。 ', '<p>3月21日，合肥三十岗桃花节开幕后首个周末。当天，不少市民来此赏桃花，很多年轻人手持自拍神器为自己留下照片。</p>', '1427298592', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('29', '16', ' 杨浦区江浦社区志愿者中心举办“绿色文化月”户外主题活动', '', '近日，杨浦区江浦路街道社区志愿者中心以海港陵园、滴水湖、临港自贸区等为目的地，组织群团成员及部分居民40余人，举办了一次“绿色文化月”户外主题活动。 大家领略了人工淡水湖景', '<p>&nbsp;&nbsp;&nbsp;&nbsp;近日，杨浦区江浦路街道社区志愿者中心以海港陵园、滴水湖、临港自贸区等为目的地，组织群团成员及部分居民40余人，举办了一次“绿色文化月”户外主题活动。</p><p>　　大家领略了人工淡水湖景区的美丽风光和清新空气，浏览了新兴自贸区进口食品繁荣的商贸景象。特别是在人文纪念陵园，了解了翻译巨匠傅雷、近代物理奠基人叶企孙、版画泰斗杨克杨等名人的生平事迹，对已逝先贤故人表达了感恩和敬仰。</p><p>　　据介绍，此次活动是配合清明节绿色殡葬宣传，突出了“致敬生命，融于自然”的绿色文化主题。</p><p><br/></p>', '1427298630', '50', '0', '0', '1', '1', '2');
INSERT INTO `th_article` VALUES ('30', '45', '清明去踏青 乌鲁木齐户外用品销售升温', '', ' 央广网乌鲁木齐3月24日消息（记者张雷、乌鲁木齐台记者张灿）随着清明小长假的临近，越来越多的乌鲁木齐市民开始为踏青出游做准备，与之相关的户外用品销售也开始升温。 上午十一点刚', '<p>&nbsp;&nbsp;&nbsp;&nbsp;央广网乌鲁木齐3月24日消息（记者张雷、乌鲁木齐台记者张灿）随着清明小长假的临近，越来越多的乌鲁木齐市民开始为踏青出游做准备，与之相关的户外用品销售也开始升温。</p><p><br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;上午十一点刚过，乌鲁木齐西虹路立交桥旁的各家品牌自行车店已经开始了一天的忙碌，一家名为单车生活馆的销售人员虎子告诉记者：今年气温回升早，自行车也提前进入了销售旺季。前天有些车型就卖完了，今天才把缺的货源补上，店里面4个人都忙不过来。</p><p><br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;来一场说走就走的旅行，自行车成为户外郊游的热销运动装备之一。而在位于乌鲁木齐火车站商圈的国贸大厦五楼户外用品区，各经营摊位都将春季用品摆在了最显眼的位置，部分产品还挂上了“热销”的标签，前来咨询、购买的顾客络绎不绝。</p><p><br/></p>', '1427299938', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('31', '45', '春来踏青正当时 户外用品受欢迎', '', ' 本报消息（记者 楼志明 通讯员 吴峰宇）3月19日，记者在义乌国际商贸城看到，琳琅满目的春季户外用品吸引了省内外旅游团和采购商的眼球。“我们准备买一些帐篷和其他户外用品。”来自', '<p>&nbsp;&nbsp;&nbsp;&nbsp;本报消息（记者 楼志明 通讯员 吴峰宇）3月19日，记者在义乌国际商贸城看到，琳琅满目的春季户外用品吸引了省内外旅游团和采购商的眼球。“我们准备买一些帐篷和其他户外用品。”来自建德的王女士告诉记者。</p><p><br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;随着清明小长假临近，许多消费者开始为踏青出游作准备，户外用品也迎来了销售旺季。市场经营户朱先生说，其他行业都有淡旺季之分，户外用品做的却是四季生意。春季的户外帐篷、登山包、登山鞋等都是热销商品。</p><p><br/></p>', '1427299966', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('32', '45', '春来踏青正当时 户外用品又热销', '', ' 春天是出游踏春的好时节，随着天气逐渐转暖，不少市民计划和家人朋友趁空闲时间赏花、踏青，体验出游乐趣。而随着清明小长假的近临，户外用品也随之进入销售旺季。 近日，笔者走访市', '<p>&nbsp;&nbsp;&nbsp;&nbsp;春天是出游踏春的好时节，随着天气逐渐转暖，不少市民计划和家人朋友趁空闲时间赏花、踏青，体验出游乐趣。而随着清明小长假的近临，户外用品也随之进入销售旺季。</p><p><br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;近日，笔者走访市区多家商场发现，进入3月份以来，不少运动及户外品牌都搞起了特卖活动，销量增加明显。运动服饰、鞋履、户外用品已进入畅销期。春夏新款全面上市，老款运动装、冲锋衣三折起销售，更是惹来不少有出游计划的消费者热情抢购。</p><p><br/></p>', '1427299989', '50', '0', '0', '1', '1', '5');

-- ----------------------------
-- Records for `th_article_type`
-- ----------------------------
INSERT INTO `th_article_type` VALUES ('11', '0', '0', '关于我们', '', 'page', 'about_page.php', '', '', '', '<h3 class="gongsi_jianjie" style="margin: 0px 0px 15px; padding: 0px; font-size: 16px; color: rgb(230, 33, 41); text-indent: 27px; font-family: 方正大黑简体; white-space: normal; background-color: rgb(255, 255, 255);">公司简介</h3><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: 黑体; font-weight: bold; text-indent: 29px; line-height: normal; white-space: normal; background-color: rgb(255, 255, 255);">广州市云途商贸有限公司成立于2014年，广州市云途商贸有限公司成立于2014年， 广州市云途商贸有限公司成立于2014年，广州市云途商贸有限公司成立于2014年， 广州市云途商贸有限公司成立于2014年，广州市云途商贸有限公司成立于2014年， 广州市云途商贸有限公司成立于2014年，广州市云途商贸有限公司成立于2014年， 广州市云途商贸有限公司成立于2014年。</p><p class="gongsi_miaoshu" style="margin-top: 20px; margin-bottom: 18px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: 黑体; font-weight: bold; text-indent: 29px; line-height: normal; white-space: normal; background-color: rgb(255, 255, 255);">公司致力于时尚、休闲、运动、安全相结合，倡导精彩生活、时尚生活、低碳生活。</p><h3 class="gongsi_pinpai" style="margin: 0px; padding: 0px; font-size: 16px; color: rgb(230, 33, 41); text-indent: 27px; font-family: 方正大黑简体; white-space: normal; background-color: rgb(255, 255, 255);">品牌概述</h3><p class="yun" style="margin-top: 20px; margin-bottom: 18px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: 黑体; font-weight: bold; text-indent: 29px; line-height: normal; white-space: normal; background-color: rgb(255, 255, 255);"><span style="margin: 0px; padding: 0px; font-family: 方正大黑简体; color: rgb(229, 190, 46); font-size: 15px;">云</span>，代表自由、无限、高端、光彩；</p><p class="tu" style="margin-top: 17px; margin-bottom: 20px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: 黑体; font-weight: bold; text-indent: 29px; line-height: normal; white-space: normal; background-color: rgb(255, 255, 255);"><span style="margin: 0px; padding: 0px; font-family: 方正大黑简体; color: rgb(205, 178, 81); font-size: 15px;">途</span>，代表人生是一场旅程，让生命在这场旅程中更加光彩照人、更有价值、更有意义、 拓展无限的可能、让生命与生活更精彩。</p><p class="gongsi_neirong" style="margin-top: 20px; margin-bottom: 18px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: 黑体; font-weight: bold; text-indent: 29px; line-height: normal; white-space: normal; background-color: rgb(255, 255, 255);">我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后。</p>', '1', '1', '', '21', '1426961414');
INSERT INTO `th_article_type` VALUES ('13', '0', '0', '产品中心', '', 'list', 'product_index.php', '', '', '', '', '2', '1', '', '21', '1426961487');
INSERT INTO `th_article_type` VALUES ('14', '13', '13', '服 装', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '21', '1426961508');
INSERT INTO `th_article_type` VALUES ('16', '0', '0', '户外文化', 'Outdoor culture', 'list', 'outdoors_list.php', '', '', '', '', '3', '1', '法律文书', '1', '1427030384');
INSERT INTO `th_article_type` VALUES ('18', '13', '13', '箱 包', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185811');
INSERT INTO `th_article_type` VALUES ('19', '13', '13', '反光制品', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185829');
INSERT INTO `th_article_type` VALUES ('20', '13', '13', '反光材料', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185842');
INSERT INTO `th_article_type` VALUES ('21', '14', '13', '风衣系列', '', 'list', 'product_list.php', '', '', '风衣系列', '', '0', '1', '风衣系列,风衣', '1', '1427185943');
INSERT INTO `th_article_type` VALUES ('22', '14', '13', '骑行系列', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185957');
INSERT INTO `th_article_type` VALUES ('23', '14', '13', '马甲系列', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185970');
INSERT INTO `th_article_type` VALUES ('24', '14', '13', 'T恤系列', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185986');
INSERT INTO `th_article_type` VALUES ('25', '14', '13', '羽绒系列', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185998');
INSERT INTO `th_article_type` VALUES ('26', '14', '13', '跑步系列', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186010');
INSERT INTO `th_article_type` VALUES ('27', '18', '13', '双肩背包', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186033');
INSERT INTO `th_article_type` VALUES ('28', '18', '13', '单肩背包', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186046');
INSERT INTO `th_article_type` VALUES ('29', '18', '13', '腰包/腰袋', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186058');
INSERT INTO `th_article_type` VALUES ('30', '18', '13', '斜跨胸包', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186076');
INSERT INTO `th_article_type` VALUES ('31', '18', '13', '包    套', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186093');
INSERT INTO `th_article_type` VALUES ('32', '18', '13', '简易收缩袋', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186109');
INSERT INTO `th_article_type` VALUES ('33', '19', '13', '骑行头盔', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186128');
INSERT INTO `th_article_type` VALUES ('34', '19', '13', '保暖头套', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186142');
INSERT INTO `th_article_type` VALUES ('35', '19', '13', '头 盔 套', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186155');
INSERT INTO `th_article_type` VALUES ('36', '19', '13', '手    套', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186172');
INSERT INTO `th_article_type` VALUES ('37', '19', '13', '雨    伞', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186185');
INSERT INTO `th_article_type` VALUES ('38', '19', '13', '帽    子', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186199');
INSERT INTO `th_article_type` VALUES ('39', '20', '13', '反 光 贴', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186214');
INSERT INTO `th_article_type` VALUES ('40', '20', '13', '反 光 带', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186231');
INSERT INTO `th_article_type` VALUES ('41', '20', '13', '手 腕 带', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186243');
INSERT INTO `th_article_type` VALUES ('42', '20', '13', '玩具挂件', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186255');
INSERT INTO `th_article_type` VALUES ('43', '20', '13', '反光面料', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186277');
INSERT INTO `th_article_type` VALUES ('44', '20', '13', '其他反光', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186291');
INSERT INTO `th_article_type` VALUES ('45', '0', '0', '新闻中心', 'News center', 'list', 'news_list.php', '', '', '', '', '0', '1', '', '1', '1427186335');
INSERT INTO `th_article_type` VALUES ('46', '0', '0', '合作代理', 'Cooperation agency', 'page', 'cooperate_page.php', '', '', '', '<p>◇&nbsp;加盟商&nbsp;:&nbsp;专卖店</p><p><br/></p><p>◇&nbsp;代理商&nbsp;:&nbsp;<span style="line-height: 1em;">一级代理/省级代理</span></p><ul style="margin: 0px; padding: 0px;" class=" list-paddingleft-2"><li><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 二级代理/市级代理</p></li><li><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 三级代理/县级代理</p></li></ul><p><br/></p>', '0', '1', '', '1', '1427186357');
INSERT INTO `th_article_type` VALUES ('47', '0', '0', '联系我们', 'Contact    us', 'page', 'contact_page.php', '', '', '', '', '0', '1', '', '1', '1427186375');

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

-- ----------------------------
-- Records for `th_node_type`
-- ----------------------------
INSERT INTO `th_node_type` VALUES ('3', '栏目内容管理', '1', '1427254989');
INSERT INTO `th_node_type` VALUES ('2', '用户管理', '1', '1427253634');
INSERT INTO `th_node_type` VALUES ('4', '轮换图管理', '1', '1427268982');
INSERT INTO `th_node_type` VALUES ('5', '系统设置', '1', '1427277372');
INSERT INTO `th_node_type` VALUES ('6', '广告位管理', '1', '1427303301');

-- ----------------------------
-- Records for `th_role`
-- ----------------------------
INSERT INTO `th_role` VALUES ('1', '超级管理员');
INSERT INTO `th_role` VALUES ('2', '普通管理员');
INSERT INTO `th_role` VALUES ('21', '高级管理员');

-- ----------------------------
-- Records for `th_role_user`
-- ----------------------------
INSERT INTO `th_role_user` VALUES ('2', '21');
INSERT INTO `th_role_user` VALUES ('2', '15');
INSERT INTO `th_role_user` VALUES ('21', '22');
INSERT INTO `th_role_user` VALUES ('1', '1');

-- ----------------------------
-- Records for `th_rotation`
-- ----------------------------
INSERT INTO `th_rotation` VALUES ('10', '1', '诚信、品牌、双赢、感恩', '', '0', '/ueditor/php/upload/image/20150325/1427274790128819.jpg', '1', '1', '1', '1427274797');
INSERT INTO `th_rotation` VALUES ('11', '1', '共创、友好、合作、发展', '', '0', '/ueditor/php/upload/image/20150325/1427274830119998.jpg', '2', '1', '1', '1427274835');
INSERT INTO `th_rotation` VALUES ('12', '1', '云途户外，安全为您', '', '0', '/ueditor/php/upload/image/20150325/1427274868123501.jpg', '3', '1', '1', '1427274871');
INSERT INTO `th_rotation` VALUES ('13', '1', '有云途，有光彩，更出众', '', '0', '/ueditor/php/upload/image/20150325/1427274910116745.jpg', '4', '1', '1', '1427274913');

-- ----------------------------
-- Records for `th_rotation_type`
-- ----------------------------
INSERT INTO `th_rotation_type` VALUES ('1', '头部轮换图', '1', '1427187947');

-- ----------------------------
-- Records for `th_website`
-- ----------------------------
INSERT INTO `th_website` VALUES ('1', 'http://www.yuntu.com', '广州云途时尚户外用品有限公司', '时尚,户外用品,云途,广州,用品', '广州云途户外用品有限公司', '闽ICP备08105208号 ');

-- ----------------------------
-- phpMyAdmin SQL Dump
-- 日期：2015-03-27 00:33:32
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='广告位表';

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Table structure for `th_article`
-- ----------------------------
DROP TABLE IF EXISTS `th_article`;
CREATE TABLE `th_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL COMMENT '栏目id',
  `title` varchar(150) NOT NULL COMMENT '标题',
  `litpic` varchar(150) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='文章表';

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
  `typetpl` varchar(150) NOT NULL COMMENT '栏目模板',
  `typelink` varchar(150) NOT NULL,
  `litpic` varchar(150) NOT NULL COMMENT '栏目缩略图',
  `typedesc` varchar(400) NOT NULL,
  `typecontent` text NOT NULL,
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(11) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `keyword` varchar(250) NOT NULL COMMENT '栏目关键字',
  `m_id` tinyint(4) NOT NULL COMMENT '管理员id',
  `creattime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COMMENT='栏目表';

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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='节点表';

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='节点类型表';

-- ----------------------------
-- Table structure for `th_role`
-- ----------------------------
DROP TABLE IF EXISTS `th_role`;
CREATE TABLE `th_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='角色表';

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
  `isnewwindow` tinyint(4) NOT NULL,
  `litpic` varchar(150) NOT NULL COMMENT '轮换图',
  `sort` tinyint(3) unsigned NOT NULL COMMENT '排序',
  `status` tinyint(4) NOT NULL COMMENT '状态',
  `m_id` tinyint(4) NOT NULL,
  `creattime` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='轮换图内容表';

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='轮换图专用表';

-- ----------------------------
-- Table structure for `th_website`
-- ----------------------------
DROP TABLE IF EXISTS `th_website`;
CREATE TABLE `th_website` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `web_host` varchar(100) NOT NULL,
  `web_name` varchar(100) NOT NULL,
  `web_keyword` varchar(200) NOT NULL,
  `web_description` varchar(300) NOT NULL,
  `web_beian` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='网站信息表';

-- ----------------------------
-- Records for `th_access`
-- ----------------------------
INSERT INTO `th_access` VALUES ('2', '29');
INSERT INTO `th_access` VALUES ('2', '28');
INSERT INTO `th_access` VALUES ('2', '27');
INSERT INTO `th_access` VALUES ('2', '26');
INSERT INTO `th_access` VALUES ('2', '24');
INSERT INTO `th_access` VALUES ('2', '23');
INSERT INTO `th_access` VALUES ('2', '22');
INSERT INTO `th_access` VALUES ('2', '20');
INSERT INTO `th_access` VALUES ('2', '19');
INSERT INTO `th_access` VALUES ('2', '18');
INSERT INTO `th_access` VALUES ('2', '16');
INSERT INTO `th_access` VALUES ('2', '15');
INSERT INTO `th_access` VALUES ('2', '14');
INSERT INTO `th_access` VALUES ('2', '12');
INSERT INTO `th_access` VALUES ('22', '23');
INSERT INTO `th_access` VALUES ('22', '22');
INSERT INTO `th_access` VALUES ('22', '16');
INSERT INTO `th_access` VALUES ('22', '15');
INSERT INTO `th_access` VALUES ('22', '14');
INSERT INTO `th_access` VALUES ('22', '12');
INSERT INTO `th_access` VALUES ('22', '11');
INSERT INTO `th_access` VALUES ('21', '25');
INSERT INTO `th_access` VALUES ('21', '24');
INSERT INTO `th_access` VALUES ('21', '23');
INSERT INTO `th_access` VALUES ('21', '22');
INSERT INTO `th_access` VALUES ('21', '21');
INSERT INTO `th_access` VALUES ('21', '20');
INSERT INTO `th_access` VALUES ('21', '19');
INSERT INTO `th_access` VALUES ('21', '18');
INSERT INTO `th_access` VALUES ('21', '17');
INSERT INTO `th_access` VALUES ('21', '16');
INSERT INTO `th_access` VALUES ('21', '15');
INSERT INTO `th_access` VALUES ('21', '14');
INSERT INTO `th_access` VALUES ('21', '13');
INSERT INTO `th_access` VALUES ('21', '12');
INSERT INTO `th_access` VALUES ('21', '11');
INSERT INTO `th_access` VALUES ('21', '10');
INSERT INTO `th_access` VALUES ('2', '11');
INSERT INTO `th_access` VALUES ('2', '10');
INSERT INTO `th_access` VALUES ('2', '6');
INSERT INTO `th_access` VALUES ('2', '2');

-- ----------------------------
-- Records for `th_ad`
-- ----------------------------
INSERT INTO `th_ad` VALUES ('8', '联系我们--电话', '<p style="line-height: 1.5em;"><a href="http://www.crcn.hk/Email:gzcrcn@yeah.net" _src="http://www.crcn.hk/Email:gzcrcn@yeah.net">www.crcn.hk/Email:gzcrcn@yeah.net</a>&nbsp;</p><p style="line-height: 1.5em;">TEL:+86 020-1234&amp;1234 &nbsp;FAX:+86 020-1234&amp;1234</p><p style="line-height: 1.5em;">中国-广州市海珠区工业大道南大干围 38 号海珠创意园10栋211室</p>', '1', '1', '1427378504');

-- ----------------------------
-- Records for `th_admin`
-- ----------------------------
INSERT INTO `th_admin` VALUES ('1', 'tenghoo', '21232f297a57a5a743894a0e4a801fc3', 'y', '1426827647');
INSERT INTO `th_admin` VALUES ('21', 'test', 'e10adc3949ba59abbe56e057f20f883e', 'y', '1426946954');

-- ----------------------------
-- Records for `th_article`
-- ----------------------------
INSERT INTO `th_article` VALUES ('17', '21', '玖姿女装 直筒名媛奢华风衣外套', '/ueditor/php/upload/image/20150325/1427288144810933.jpg', ' 玖姿女装 直筒名媛奢华风衣外套玖姿女装 直筒名媛奢华风衣外套玖姿女装 直筒名媛奢华风衣外套玖姿女装 直筒名媛奢华风衣外套玖姿女装 直筒名媛奢华风衣外套玖姿女装 直筒名媛奢华风衣', '<p>品名:玖姿女装 直筒名媛奢华风衣外套</p><p>此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p>采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p>能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p>用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p>反光片规格：1、48cm*48cm</p><p>2、48cm*100米</p><p>反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p>', '1427285128', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('18', '21', 'OL收腰显瘦短风衣 玖姿女装2014新款', '/ueditor/php/upload/image/20150325/1427288154637687.jpg', ' OL收腰显瘦短风衣 玖姿女装2014新款 OL收腰显瘦短风衣 玖姿女装2014新款 OL收腰显瘦短风衣 玖姿女装2014新款 OL收腰显瘦短风衣 玖姿女装2014新款 OL收腰显瘦短风衣 玖姿女装2014新款 OL收腰显瘦短', '<p style="white-space: normal;">品名:OL收腰显瘦短风衣 玖姿女装2014新款</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p style="white-space: normal;">反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285147', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('19', '21', '简洁大气款风衣 玖姿休闲修身系腰带女装', '/ueditor/php/upload/image/20150325/1427288164108616.jpg', ' 简洁大气款风衣 玖姿休闲修身系腰带女装 简洁大气款风衣 玖姿休闲修身系腰带女装 简洁大气款风衣 玖姿休闲修身系腰带女装 简洁大气款风衣 玖姿休闲修身系腰带女装 简洁大气款风衣 玖姿', '<p style="white-space: normal;">品名:简洁大气款风衣 玖姿休闲修身系腰带女装</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p style="white-space: normal;">反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285167', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('20', '21', '时尚新款风衣系列 玖姿泡泡袖连帽风衣', '/ueditor/php/upload/image/20150325/1427288175189985.jpg', ' 玖姿女装 直筒名媛奢华风衣外套 玖姿女装 直筒名媛奢华风衣外套 玖姿女装 直筒名媛奢华风衣外套 玖姿女装 直筒名媛奢华风衣外套 玖姿女装 直筒名媛奢华风衣外套 玖姿女装 直筒名媛奢华风', '<p style="white-space: normal;">品名:时尚新款风衣系列 玖姿泡泡袖连帽风衣</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p style="white-space: normal;">反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285188', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('21', '21', '玖姿女装欧美时尚系带长袖风衣', '/ueditor/php/upload/image/20150325/1427293565717770.jpg', ' 玖姿女装欧美时尚系带长袖风衣 玖姿女装欧美时尚系带长袖风衣 玖姿女装欧美时尚系带长袖风衣 玖姿女装欧美时尚系带长袖风衣 玖姿女装欧美时尚系带长袖风衣 玖姿女装欧美时尚系带长袖风', '<p style="white-space: normal;">品名:玖姿女装欧美时尚系带长袖风衣</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p style="white-space: normal;">反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285211', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('22', '21', '玖姿英伦风女装 通勤大气格纹风衣系列', '/ueditor/php/upload/image/20150325/1427288190168899.jpg', ' 玖姿英伦风女装 通勤大气格纹风衣系列 玖姿英伦风女装 通勤大气格纹风衣系列 玖姿英伦风女装 通勤大气格纹风衣系列 玖姿英伦风女装 通勤大气格纹风衣系列 玖姿英伦风女装 通勤大气格纹', '<p style="white-space: normal;">品名:玖姿英伦风女装 通勤大气格纹风衣系列</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p style="white-space: normal;">反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285227', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('23', '21', '奢华复古感双排扣修身短风衣', '/ueditor/php/upload/image/20150325/1427288201259481.jpg', ' 奢华复古感双排扣修身短风衣 奢华复古感双排扣修身短风衣 奢华复古感双排扣修身短风衣 奢华复古感双排扣修身短风衣 奢华复古感双排扣修身短风衣 奢华复古感双排扣修身短风衣 奢华复古', '<p style="white-space: normal;">品名:奢华复古感双排扣修身短风衣</p><p style="white-space: normal;">此反光晶格具有良好反射性、抗雨淋性、耐候性、柔韧性和易施工性。</p><p style="white-space: normal;">采用A级反光晶格带制作的反光背心具有色彩艳丽，反光强度高，警示效果好，在雨、雾等不良天气状况下，亦能保持良好的反光效果。&nbsp;</p><p style="white-space: normal;">能够使穿着者在暮光条件下，在散射光的干扰下在遥远处即被行驶中心机动车驾驶员发现，极大的保障了生命财产的安全。</p><p style="white-space: normal;">用途: 用于各类型反光材料使用在旅游产品，箱包、服装、鞋、帽、手套、雨衣、商标、警示器等产品上除起到反光提醒安全作用外，进一步的使产品更加美观，提高了档次，从而增加了产品的附加值和市场的竟争力。</p><p style="white-space: normal;">反光片规格：1、48cm*48cm</p><p style="white-space: normal;">2、48cm*100米</p><p>反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p>反光晶格规格：1cm、1.5cm、2cm、2.5cm、3cm、3.5cm、4cm、4.5cm、5cm、7cm、9cm、10cm</p><p><br/></p>', '1427285244', '4', '1', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('24', '27', 'Topsky 远行客 户外登山包双肩包男女户外旅游旅行登山背包户外包', '/ueditor/php/upload/image/20150325/1427295489764244.jpg', ' 多层设计，专业的配件设计：D型扣，求生口哨，饮水系统扣件，弹力水壶仓，便于放更多物品。 悬浮透气背负系统，大蜂巢16D透气网格，加厚防震肩带，有效的给使用者提供舒适无压的背负平', '<p>多层设计，专业的配件设计：D型扣，求生口哨，饮水系统扣件，弹力水壶仓，便于放更多物品。</p><p>悬浮透气背负系统，大蜂巢16D透气网格，加厚防震肩带，有效的给使用者提供舒适无压的背负平台。</p><p>432D高密度STORM BREATH防水尼龙科技面料的特殊性结构赋予它优质的防水性，耐磨性，耐撕裂和无与伦比的速度，具有良好的手感和质感。</p><p>链采用进口SBS拉链，经过严格测试实验，可拉合32万次以上，雨天防生锈。</p><p>顶级储存系统，大容量便于放更多物品。</p><p><br/></p>', '1427295170', '3', '1', '1', '1', '1', '0');
INSERT INTO `th_article` VALUES ('25', '22', 'KING BIKE 金巴克 KINGBIKE夏季男款短袖套装山地车服装 吸湿排汗骑行套装', '/ueditor/php/upload/image/20150325/1427296089869500.jpg', ' 上市时间: 2013年春季 品牌: KING BIKE/金巴克 型号: 龙沙2 颜色分类: 魔界绿 绿野仙踪 火山 魔界兰 烈锋 货号: JBK-651A 骑行服款式: 短袖骑行套装 适用对象: 男 适用季节: 夏季 尺码: S M L XL XXL XXXL', '<p>上市时间: 2013年春季</p><p>品牌: KING BIKE/金巴克</p><p>型号: 龙沙2</p><p>颜色分类: 魔界绿 绿野仙踪 火山 魔界兰 烈锋</p><p>货号: JBK-651A</p><p>骑行服款式: 短袖骑行套装</p><p>适用对象: 男</p><p>适用季节: 夏季</p><p>尺码: S M L XL XXL XXXL</p><p><br/></p>', '1427296115', '2', '1', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('26', '22', 'Lance SoBike速盟 春秋骑行服 长袖抓绒套装 自行车服装 男款 脸谱', '/ueditor/php/upload/image/20150325/1427296165375753.jpg', ' 1.采用升级版CATHE抓绒材料,弹力较之前的增加1.6倍,兼具排汗和保暖效果。 2.后置三个专业竞赛口袋,方便放置水壶等一些小物品。后口袋两侧反光片设计,使骑行时更加安全。 3.使用意大利进口墨', '<p>1.采用升级版CATHE抓绒材料,弹力较之前的增加1.6倍,兼具排汗和保暖效果。</p><p>2.后置三个专业竞赛口袋,方便放置水壶等一些小物品。后口袋两侧反光片设计,使骑行时更加安全。</p><p>3.使用意大利进口墨水热转印技术，颜色亮丽且永不褪色。</p><p>4.采用新型升级DOBY3D抗菌坐垫, 坐垫面布特别添加绒面设计,在秋冬季节骑行时更加舒适</p><p>5.脚口装有防滑皮筋,防止骑行时裤脚上移.脚口采用YKK拉链,穿脱更方便.适合10——20℃左右骑行</p><p><br/></p>', '1427296181', '1', '1', '0', '1', '1', '10');
INSERT INTO `th_article` VALUES ('27', '16', '中国户外文化运动联盟来岚皋考察全域旅游', '', ' 由南宫山旅游公司组织举办的中国户外文化运动联盟全域旅游推介会在岚皋举行。来自省市周边30个团队40余个户外运动旅行社参加会议。 推介会上，各旅行社负责人对岚皋的旅游基础设施、环', '<p>&nbsp;&nbsp;&nbsp;&nbsp;由南宫山旅游公司组织举办的中国户外文化运动联盟全域旅游推介会在岚皋举行。来自省市周边30个团队40余个户外运动旅行社参加会议。</p><p>　　推介会上，各旅行社负责人对岚皋的旅游基础设施、环境保障、经营理念、包装项目等旅游后期开发的提出了很好的意见和建议。并表示，岚皋的山水优势将会成为户外运动爱好者追逐的首选地方，回去以后，将进一步加大宣传岚皋旅游，让更多的人来岚皋观光、投资、旅游。</p><p><br/></p>', '1427298561', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('28', '16', ' 合肥桃花节主题活动精彩上演 可体验农耕文化听户外音乐会', '', ' 3月21日，合肥三十岗桃花节开幕后首个周末。当天，不少市民来此赏桃花，很多年轻人手持自拍神器为自己留下照片。 ', '<p>3月21日，合肥三十岗桃花节开幕后首个周末。当天，不少市民来此赏桃花，很多年轻人手持自拍神器为自己留下照片。</p>', '1427298592', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('29', '16', ' 杨浦区江浦社区志愿者中心举办“绿色文化月”户外主题活动', '', '近日，杨浦区江浦路街道社区志愿者中心以海港陵园、滴水湖、临港自贸区等为目的地，组织群团成员及部分居民40余人，举办了一次“绿色文化月”户外主题活动。 大家领略了人工淡水湖景', '<p>&nbsp;&nbsp;&nbsp;&nbsp;近日，杨浦区江浦路街道社区志愿者中心以海港陵园、滴水湖、临港自贸区等为目的地，组织群团成员及部分居民40余人，举办了一次“绿色文化月”户外主题活动。</p><p>　　大家领略了人工淡水湖景区的美丽风光和清新空气，浏览了新兴自贸区进口食品繁荣的商贸景象。特别是在人文纪念陵园，了解了翻译巨匠傅雷、近代物理奠基人叶企孙、版画泰斗杨克杨等名人的生平事迹，对已逝先贤故人表达了感恩和敬仰。</p><p>　　据介绍，此次活动是配合清明节绿色殡葬宣传，突出了“致敬生命，融于自然”的绿色文化主题。</p><p><br/></p>', '1427298630', '50', '0', '0', '1', '1', '2');
INSERT INTO `th_article` VALUES ('30', '45', '清明去踏青 乌鲁木齐户外用品销售升温', '', ' 央广网乌鲁木齐3月24日消息（记者张雷、乌鲁木齐台记者张灿）随着清明小长假的临近，越来越多的乌鲁木齐市民开始为踏青出游做准备，与之相关的户外用品销售也开始升温。 上午十一点刚', '<p>&nbsp;&nbsp;&nbsp;&nbsp;央广网乌鲁木齐3月24日消息（记者张雷、乌鲁木齐台记者张灿）随着清明小长假的临近，越来越多的乌鲁木齐市民开始为踏青出游做准备，与之相关的户外用品销售也开始升温。</p><p><br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;上午十一点刚过，乌鲁木齐西虹路立交桥旁的各家品牌自行车店已经开始了一天的忙碌，一家名为单车生活馆的销售人员虎子告诉记者：今年气温回升早，自行车也提前进入了销售旺季。前天有些车型就卖完了，今天才把缺的货源补上，店里面4个人都忙不过来。</p><p><br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;来一场说走就走的旅行，自行车成为户外郊游的热销运动装备之一。而在位于乌鲁木齐火车站商圈的国贸大厦五楼户外用品区，各经营摊位都将春季用品摆在了最显眼的位置，部分产品还挂上了“热销”的标签，前来咨询、购买的顾客络绎不绝。</p><p><br/></p>', '1427299938', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('31', '45', '春来踏青正当时 户外用品受欢迎', '', ' 本报消息（记者 楼志明 通讯员 吴峰宇）3月19日，记者在义乌国际商贸城看到，琳琅满目的春季户外用品吸引了省内外旅游团和采购商的眼球。“我们准备买一些帐篷和其他户外用品。”来自', '<p>&nbsp;&nbsp;&nbsp;&nbsp;本报消息（记者 楼志明 通讯员 吴峰宇）3月19日，记者在义乌国际商贸城看到，琳琅满目的春季户外用品吸引了省内外旅游团和采购商的眼球。“我们准备买一些帐篷和其他户外用品。”来自建德的王女士告诉记者。</p><p><br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;随着清明小长假临近，许多消费者开始为踏青出游作准备，户外用品也迎来了销售旺季。市场经营户朱先生说，其他行业都有淡旺季之分，户外用品做的却是四季生意。春季的户外帐篷、登山包、登山鞋等都是热销商品。</p><p><br/></p>', '1427299966', '50', '0', '0', '1', '1', '0');
INSERT INTO `th_article` VALUES ('32', '45', '春来踏青正当时 户外用品又热销', '', ' 春天是出游踏春的好时节，随着天气逐渐转暖，不少市民计划和家人朋友趁空闲时间赏花、踏青，体验出游乐趣。而随着清明小长假的近临，户外用品也随之进入销售旺季。 近日，笔者走访市', '<p>&nbsp;&nbsp;&nbsp;&nbsp;春天是出游踏春的好时节，随着天气逐渐转暖，不少市民计划和家人朋友趁空闲时间赏花、踏青，体验出游乐趣。而随着清明小长假的近临，户外用品也随之进入销售旺季。</p><p><br/></p><p>&nbsp;&nbsp;&nbsp;&nbsp;近日，笔者走访市区多家商场发现，进入3月份以来，不少运动及户外品牌都搞起了特卖活动，销量增加明显。运动服饰、鞋履、户外用品已进入畅销期。春夏新款全面上市，老款运动装、冲锋衣三折起销售，更是惹来不少有出游计划的消费者热情抢购。</p><p><br/></p>', '1427299989', '50', '0', '0', '1', '1', '5');

-- ----------------------------
-- Records for `th_article_type`
-- ----------------------------
INSERT INTO `th_article_type` VALUES ('11', '0', '0', '关于我们', '', 'page', 'about_page.php', '', '', '', '<h3 class="gongsi_jianjie" style="margin: 0px 0px 15px; padding: 0px; font-size: 16px; color: rgb(230, 33, 41); text-indent: 27px; font-family: 方正大黑简体; white-space: normal; background-color: rgb(255, 255, 255);">公司简介</h3><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: 黑体; font-weight: bold; text-indent: 29px; line-height: normal; white-space: normal; background-color: rgb(255, 255, 255);">广州市云途商贸有限公司成立于2014年，广州市云途商贸有限公司成立于2014年， 广州市云途商贸有限公司成立于2014年，广州市云途商贸有限公司成立于2014年， 广州市云途商贸有限公司成立于2014年，广州市云途商贸有限公司成立于2014年， 广州市云途商贸有限公司成立于2014年，广州市云途商贸有限公司成立于2014年， 广州市云途商贸有限公司成立于2014年。</p><p class="gongsi_miaoshu" style="margin-top: 20px; margin-bottom: 18px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: 黑体; font-weight: bold; text-indent: 29px; line-height: normal; white-space: normal; background-color: rgb(255, 255, 255);">公司致力于时尚、休闲、运动、安全相结合，倡导精彩生活、时尚生活、低碳生活。</p><h3 class="gongsi_pinpai" style="margin: 0px; padding: 0px; font-size: 16px; color: rgb(230, 33, 41); text-indent: 27px; font-family: 方正大黑简体; white-space: normal; background-color: rgb(255, 255, 255);">品牌概述</h3><p class="yun" style="margin-top: 20px; margin-bottom: 18px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: 黑体; font-weight: bold; text-indent: 29px; line-height: normal; white-space: normal; background-color: rgb(255, 255, 255);"><span style="margin: 0px; padding: 0px; font-family: 方正大黑简体; color: rgb(229, 190, 46); font-size: 15px;">云</span>，代表自由、无限、高端、光彩；</p><p class="tu" style="margin-top: 17px; margin-bottom: 20px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: 黑体; font-weight: bold; text-indent: 29px; line-height: normal; white-space: normal; background-color: rgb(255, 255, 255);"><span style="margin: 0px; padding: 0px; font-family: 方正大黑简体; color: rgb(205, 178, 81); font-size: 15px;">途</span>，代表人生是一场旅程，让生命在这场旅程中更加光彩照人、更有价值、更有意义、 拓展无限的可能、让生命与生活更精彩。</p><p class="gongsi_neirong" style="margin-top: 20px; margin-bottom: 18px; padding: 0px; font-size: 13px; color: rgb(51, 51, 51); font-family: 黑体; font-weight: bold; text-indent: 29px; line-height: normal; white-space: normal; background-color: rgb(255, 255, 255);">我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后， 我们是一群有梦想、有追求、不断实现自我价值的80后。</p>', '1', '1', '', '21', '1426961414');
INSERT INTO `th_article_type` VALUES ('13', '0', '0', '产品中心', '', 'list', 'product_index.php', '', '', '', '', '2', '1', '', '21', '1426961487');
INSERT INTO `th_article_type` VALUES ('14', '13', '13', '服 装', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '21', '1426961508');
INSERT INTO `th_article_type` VALUES ('16', '0', '0', '户外文化', 'Outdoor culture', 'list', 'outdoors_list.php', '', '', '', '', '3', '1', '法律文书', '1', '1427030384');
INSERT INTO `th_article_type` VALUES ('18', '13', '13', '箱 包', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185811');
INSERT INTO `th_article_type` VALUES ('19', '13', '13', '反光制品', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185829');
INSERT INTO `th_article_type` VALUES ('20', '13', '13', '反光材料', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185842');
INSERT INTO `th_article_type` VALUES ('21', '14', '13', '风衣系列', '', 'list', 'product_list.php', '', '', '风衣系列', '', '0', '1', '风衣系列,风衣', '1', '1427185943');
INSERT INTO `th_article_type` VALUES ('22', '14', '13', '骑行系列', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185957');
INSERT INTO `th_article_type` VALUES ('23', '14', '13', '马甲系列', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185970');
INSERT INTO `th_article_type` VALUES ('24', '14', '13', 'T恤系列', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185986');
INSERT INTO `th_article_type` VALUES ('25', '14', '13', '羽绒系列', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427185998');
INSERT INTO `th_article_type` VALUES ('26', '14', '13', '跑步系列', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186010');
INSERT INTO `th_article_type` VALUES ('27', '18', '13', '双肩背包', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186033');
INSERT INTO `th_article_type` VALUES ('28', '18', '13', '单肩背包', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186046');
INSERT INTO `th_article_type` VALUES ('29', '18', '13', '腰包/腰袋', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186058');
INSERT INTO `th_article_type` VALUES ('30', '18', '13', '斜跨胸包', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186076');
INSERT INTO `th_article_type` VALUES ('31', '18', '13', '包    套', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186093');
INSERT INTO `th_article_type` VALUES ('32', '18', '13', '简易收缩袋', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186109');
INSERT INTO `th_article_type` VALUES ('33', '19', '13', '骑行头盔', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186128');
INSERT INTO `th_article_type` VALUES ('34', '19', '13', '保暖头套', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186142');
INSERT INTO `th_article_type` VALUES ('35', '19', '13', '头 盔 套', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186155');
INSERT INTO `th_article_type` VALUES ('36', '19', '13', '手    套', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186172');
INSERT INTO `th_article_type` VALUES ('37', '19', '13', '雨    伞', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186185');
INSERT INTO `th_article_type` VALUES ('38', '19', '13', '帽    子', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186199');
INSERT INTO `th_article_type` VALUES ('39', '20', '13', '反 光 贴', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186214');
INSERT INTO `th_article_type` VALUES ('40', '20', '13', '反 光 带', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186231');
INSERT INTO `th_article_type` VALUES ('41', '20', '13', '手 腕 带', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186243');
INSERT INTO `th_article_type` VALUES ('42', '20', '13', '玩具挂件', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186255');
INSERT INTO `th_article_type` VALUES ('43', '20', '13', '反光面料', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186277');
INSERT INTO `th_article_type` VALUES ('44', '20', '13', '其他反光', '', 'list', 'product_list.php', '', '', '', '', '0', '1', '', '1', '1427186291');
INSERT INTO `th_article_type` VALUES ('45', '0', '0', '新闻中心', 'News center', 'list', 'news_list.php', '', '', '', '', '0', '1', '', '1', '1427186335');
INSERT INTO `th_article_type` VALUES ('46', '0', '0', '合作代理', 'Cooperation agency', 'page', 'cooperate_page.php', '', '', '', '<p>◇&nbsp;加盟商&nbsp;:&nbsp;专卖店</p><p><br/></p><p>◇&nbsp;代理商&nbsp;:&nbsp;<span style="line-height: 1em;">一级代理/省级代理</span></p><ul style="margin: 0px; padding: 0px;" class=" list-paddingleft-2"><li><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 二级代理/市级代理</p></li><li><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 三级代理/县级代理</p></li></ul><p><br/></p>', '0', '1', '', '1', '1427186357');
INSERT INTO `th_article_type` VALUES ('47', '0', '0', '联系我们', 'Contact    us', 'page', 'contact_page.php', '', '', '', '', '0', '1', '', '1', '1427186375');

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

-- ----------------------------
-- Records for `th_node_type`
-- ----------------------------
INSERT INTO `th_node_type` VALUES ('3', '栏目内容管理', '1', '1427254989');
INSERT INTO `th_node_type` VALUES ('2', '用户管理', '1', '1427253634');
INSERT INTO `th_node_type` VALUES ('4', '轮换图管理', '1', '1427268982');
INSERT INTO `th_node_type` VALUES ('5', '系统设置', '1', '1427277372');
INSERT INTO `th_node_type` VALUES ('6', '广告位管理', '1', '1427303301');

-- ----------------------------
-- Records for `th_role`
-- ----------------------------
INSERT INTO `th_role` VALUES ('1', '超级管理员');
INSERT INTO `th_role` VALUES ('2', '普通管理员');
INSERT INTO `th_role` VALUES ('21', '高级管理员');

-- ----------------------------
-- Records for `th_role_user`
-- ----------------------------
INSERT INTO `th_role_user` VALUES ('2', '21');
INSERT INTO `th_role_user` VALUES ('2', '15');
INSERT INTO `th_role_user` VALUES ('21', '22');
INSERT INTO `th_role_user` VALUES ('1', '1');

-- ----------------------------
-- Records for `th_rotation`
-- ----------------------------
INSERT INTO `th_rotation` VALUES ('10', '1', '诚信、品牌、双赢、感恩', '', '0', '/ueditor/php/upload/image/20150325/1427274790128819.jpg', '1', '1', '1', '1427274797');
INSERT INTO `th_rotation` VALUES ('11', '1', '共创、友好、合作、发展', '', '0', '/ueditor/php/upload/image/20150325/1427274830119998.jpg', '2', '1', '1', '1427274835');
INSERT INTO `th_rotation` VALUES ('12', '1', '云途户外，安全为您', '', '0', '/ueditor/php/upload/image/20150325/1427274868123501.jpg', '3', '1', '1', '1427274871');
INSERT INTO `th_rotation` VALUES ('13', '1', '有云途，有光彩，更出众', '', '0', '/ueditor/php/upload/image/20150325/1427274910116745.jpg', '4', '1', '1', '1427274913');

-- ----------------------------
-- Records for `th_rotation_type`
-- ----------------------------
INSERT INTO `th_rotation_type` VALUES ('1', '头部轮换图', '1', '1427187947');

-- ----------------------------
-- Records for `th_website`
-- ----------------------------
INSERT INTO `th_website` VALUES ('1', 'http://www.yuntu.com', '广州云途时尚户外用品有限公司', '时尚,户外用品,云途,广州,用品', '广州云途户外用品有限公司', '闽ICP备08105208号 ');

