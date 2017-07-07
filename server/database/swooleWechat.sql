/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 80001
Source Host           : 127.0.0.1:3306
Source Database       : swooleWechat

Target Server Type    : MYSQL
Target Server Version : 80001
File Encoding         : 65001

Date: 2017-07-07 23:27:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sys_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `sys_auth_rule`;
CREATE TABLE `sys_auth_rule` (
  `ruleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ruleName` varchar(50) NOT NULL DEFAULT '' COMMENT '规则名称',
  `url` varchar(20) NOT NULL DEFAULT '' COMMENT '规则URL',
  `parentId` int(10) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `orderNum` mediumint(5) NOT NULL DEFAULT '0' COMMENT '排序数字，值越小越靠前',
  `condition` varchar(100) NOT NULL DEFAULT '' COMMENT '条件',
  `isDel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(0:正常,1:删除）',
  `addUserId` int(10) NOT NULL DEFAULT '0' COMMENT '添加用户ID',
  `addTime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`ruleId`),
  UNIQUE KEY `name` (`ruleName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户认证规则表';

-- ----------------------------
-- Records of sys_auth_rule
-- ----------------------------
INSERT INTO `sys_auth_rule` VALUES ('1', '后台模块', '/Admin/Index/index', '0', '0', '', '0', '0', '0');
INSERT INTO `sys_auth_rule` VALUES ('2', '系统管理', '/Admin/System/index', '1', '0', '', '0', '0', '0');

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu` (
  `menuId` int(10) NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `moduleType` varchar(10) NOT NULL DEFAULT '' COMMENT '模块名称',
  `menuName` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '链接',
  `iconClass` varchar(100) NOT NULL DEFAULT '' COMMENT '图标样式',
  `parentId` int(10) NOT NULL DEFAULT '0' COMMENT '父级菜单ID',
  `orderNum` mediumint(5) NOT NULL DEFAULT '0' COMMENT '排序数字，值越小越靠前',
  `isDel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `addUserId` int(10) NOT NULL DEFAULT '0' COMMENT '添加用户ID',
  `addTime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`menuId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='系统菜单表';

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', 'admin', '仪表盘', '/Admin/Dashboard/index', 'fa fa-dashboard', '0', '0', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('2', 'admin', '控制面板', '/Admin/Index/index', 'fa fa-desktop', '1', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('3', 'admin', '系统管理', '/Admin/System/index', 'fa fa-cog', '0', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('4', 'admin', '菜单管理', '/Admin/SysMenu/index', 'fa fa-sitemap', '3', '0', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('5', 'admin', '用户组管理', '/Admin/SysUserGroup/index', 'fa fa-group', '3', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('6', 'admin', '用户管理', '/Admin/SysUser/Index', 'fa fa-user', '3', '2', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('7', 'admin', '权限管理', '/Admin/SysAuthRule/index', 'fa fa-gavel', '3', '3', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('8', 'admin', '系统信息', '/Admin/Index/sysinfo', 'fa fa-linux', '1', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `groupId` int(10) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `userName` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名称',
  `account` varchar(100) NOT NULL DEFAULT '' COMMENT '账号',
  `password` varchar(200) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `ruleIds` mediumtext NOT NULL COMMENT '访问规则ID列表,servlize字符串',
  `loginTime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `loginIp` varchar(50) NOT NULL DEFAULT '' COMMENT '登录IP',
  `createTime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='系统用户表';

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('2', '0', '超级管理员', 'qianxun', 'c8396d9aeb430d0828d248c79f8788194c9b3b6b', 'zhaojianhui129@163.com', ' ', '2017-07-03 13:28:15', '127.0.0.1', '2017-07-03 13:28:15');

-- ----------------------------
-- Table structure for sys_user_group
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_group`;
CREATE TABLE `sys_user_group` (
  `groupId` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户组ID',
  `groupName` varchar(50) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `parentId` int(10) NOT NULL DEFAULT '0' COMMENT '上级用户组ID',
  `orderNum` mediumint(5) NOT NULL DEFAULT '0' COMMENT '排序数字，值越小越靠前',
  `isDel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(0:正常,1:删除)',
  `ruleIds` mediumtext NOT NULL COMMENT '访问规则ID列表,servlize字符串',
  `addUserId` int(10) NOT NULL DEFAULT '0' COMMENT '添加用户ID',
  `addTime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`groupId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='系统用户分组表';

-- ----------------------------
-- Records of sys_user_group
-- ----------------------------
INSERT INTO `sys_user_group` VALUES ('1', '超级管理', '0', '0', '0', 'a:0:{}', '2', '1499311306');
INSERT INTO `sys_user_group` VALUES ('2', '微信运营', '0', '1', '0', 'a:0:{}', '2', '1499327471');
INSERT INTO `sys_user_group` VALUES ('3', '客服组', '0', '2', '0', 'a:0:{}', '2', '1499327554');

-- ----------------------------
-- Table structure for sys_user_to_group
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_to_group`;
CREATE TABLE `sys_user_to_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `userId` int(10) unsigned NOT NULL COMMENT '用户ID',
  `groupId` int(10) unsigned NOT NULL COMMENT '分组ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_group_id` (`userId`,`groupId`),
  KEY `uid` (`userId`),
  KEY `group_id` (`groupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统用户分组访问权限表';

-- ----------------------------
-- Records of sys_user_to_group
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_event_location
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_event_location`;
CREATE TABLE `wx_rec_event_location` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgType` varchar(10) NOT NULL COMMENT 'event',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `Event` varchar(100) NOT NULL DEFAULT '' COMMENT '事件类型，LOCATION',
  `Latitude` varchar(20) NOT NULL DEFAULT '' COMMENT '地理位置纬度',
  `Longitude` varchar(20) NOT NULL DEFAULT '' COMMENT '地理位置经度',
  `Precision` varchar(20) NOT NULL DEFAULT '' COMMENT '地理位置精度',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='上报地理位置事件记录表';

-- ----------------------------
-- Records of wx_rec_event_location
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_event_menu
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_event_menu`;
CREATE TABLE `wx_rec_event_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgType` varchar(10) NOT NULL COMMENT 'event',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `Event` varchar(100) NOT NULL DEFAULT '' COMMENT '事件类型，CLICK/VIEW',
  `EventKey` varchar(50) NOT NULL DEFAULT '' COMMENT '事件KEY值，与自定义菜单接口中KEY值对应',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='自定义菜单事件记录表';

-- ----------------------------
-- Records of wx_rec_event_menu
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_event_scan
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_event_scan`;
CREATE TABLE `wx_rec_event_scan` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgType` varchar(10) NOT NULL COMMENT 'event',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `Event` varchar(100) NOT NULL DEFAULT '' COMMENT '事件类型，SCAN/subscribe',
  `EventKey` varchar(50) NOT NULL DEFAULT '' COMMENT '事件KEY值，即创建二维码时的二维码scene_id',
  `Ticket` varchar(50) NOT NULL DEFAULT '' COMMENT '二维码的ticket，可用来换取二维码图片',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='扫码事件记录表';

-- ----------------------------
-- Records of wx_rec_event_scan
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_event_subscribe
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_event_subscribe`;
CREATE TABLE `wx_rec_event_subscribe` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgType` varchar(10) NOT NULL COMMENT 'voice',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `Event` varchar(100) NOT NULL DEFAULT '' COMMENT '事件类型，subscribe(订阅)、unsubscribe(取消订阅)',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='关注与取关注事件消息记录表';

-- ----------------------------
-- Records of wx_rec_event_subscribe
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_msg_image
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_msg_image`;
CREATE TABLE `wx_rec_msg_image` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgId` varchar(20) NOT NULL COMMENT '消息id，64位整型',
  `MsgType` varchar(10) NOT NULL COMMENT 'image',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `PicUrl` varchar(150) NOT NULL DEFAULT '' COMMENT '图片链接（由系统生成）',
  `MediaId` varchar(100) NOT NULL DEFAULT '' COMMENT '图片消息媒体id，可以调用多媒体文件下载接口拉取数据。',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='图片接收消息记录表';

-- ----------------------------
-- Records of wx_rec_msg_image
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_msg_link
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_msg_link`;
CREATE TABLE `wx_rec_msg_link` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgId` varchar(20) NOT NULL COMMENT '消息id，64位整型',
  `MsgType` varchar(10) NOT NULL COMMENT 'link',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `Title` varchar(100) NOT NULL DEFAULT '' COMMENT '消息标题',
  `Description` varchar(200) NOT NULL DEFAULT '' COMMENT '消息描述',
  `Url` varchar(150) NOT NULL DEFAULT '' COMMENT '消息链接',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='链接接收消息记录表';

-- ----------------------------
-- Records of wx_rec_msg_link
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_msg_location
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_msg_location`;
CREATE TABLE `wx_rec_msg_location` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgId` varchar(20) NOT NULL COMMENT '消息id，64位整型',
  `MsgType` varchar(10) NOT NULL COMMENT 'location',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `Location_X` varchar(30) NOT NULL DEFAULT '' COMMENT '地理位置维度',
  `Location_Y` varchar(30) NOT NULL DEFAULT '' COMMENT '地理位置经度',
  `Scale` tinyint(2) NOT NULL DEFAULT '0' COMMENT '地图缩放大小',
  `Label` varchar(150) NOT NULL DEFAULT '' COMMENT '地理位置信息',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='地理位置接收消息记录表';

-- ----------------------------
-- Records of wx_rec_msg_location
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_msg_shortvideo
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_msg_shortvideo`;
CREATE TABLE `wx_rec_msg_shortvideo` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgId` varchar(20) NOT NULL COMMENT '消息id，64位整型',
  `MsgType` varchar(10) NOT NULL COMMENT 'shortvideo',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `MediaId` varchar(100) NOT NULL DEFAULT '' COMMENT '语音消息媒体id，可以调用多媒体文件下载接口拉取数据。',
  `ThumbMediaId` varchar(100) NOT NULL DEFAULT '' COMMENT '视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短视频接收消息记录表';

-- ----------------------------
-- Records of wx_rec_msg_shortvideo
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_msg_text
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_msg_text`;
CREATE TABLE `wx_rec_msg_text` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgId` varchar(20) NOT NULL COMMENT '消息id，64位整型',
  `MsgType` varchar(10) NOT NULL COMMENT 'text',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `Content` text NOT NULL COMMENT '文本消息内容',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='文本接收消息记录表';

-- ----------------------------
-- Records of wx_rec_msg_text
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_msg_video
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_msg_video`;
CREATE TABLE `wx_rec_msg_video` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgId` varchar(20) NOT NULL COMMENT '消息id，64位整型',
  `MsgType` varchar(10) NOT NULL COMMENT 'voice',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `MediaId` varchar(100) NOT NULL DEFAULT '' COMMENT '视频消息媒体id，可以调用多媒体文件下载接口拉取数据。',
  `ThumbMediaId` varchar(100) NOT NULL DEFAULT '' COMMENT '视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='视频接收消息记录表';

-- ----------------------------
-- Records of wx_rec_msg_video
-- ----------------------------

-- ----------------------------
-- Table structure for wx_rec_msg_voice
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_msg_voice`;
CREATE TABLE `wx_rec_msg_voice` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgId` varchar(20) NOT NULL COMMENT '消息id，64位整型',
  `MsgType` varchar(10) NOT NULL COMMENT 'voice',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `MediaId` varchar(100) NOT NULL DEFAULT '' COMMENT '语音消息媒体id，可以调用多媒体文件下载接口拉取数据。',
  `Format` varchar(30) NOT NULL DEFAULT '' COMMENT '语音格式，如amr，speex等',
  `Recognition` text NOT NULL COMMENT '语音识别文字',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='语音接收消息记录表';

-- ----------------------------
-- Records of wx_rec_msg_voice
-- ----------------------------

-- ----------------------------
-- Table structure for wx_send_msg
-- ----------------------------
DROP TABLE IF EXISTS `wx_send_msg`;
CREATE TABLE `wx_send_msg` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgType` varchar(10) NOT NULL COMMENT 'text',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `ContentDetail` text NOT NULL COMMENT '回复的消息内容',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='文本接收消息记录表';

-- ----------------------------
-- Records of wx_send_msg
-- ----------------------------

-- ----------------------------
-- Table structure for wx_user
-- ----------------------------
DROP TABLE IF EXISTS `wx_user`;
CREATE TABLE `wx_user` (
  `userId` int(10) NOT NULL AUTO_INCREMENT COMMENT 'userId',
  `subscribe` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否订阅该公众号标识',
  `openid` varchar(30) NOT NULL DEFAULT '' COMMENT '用户的标识，对当前公众号唯一',
  `unionid` varchar(30) NOT NULL DEFAULT '' COMMENT '只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。',
  `groupid` int(10) NOT NULL,
  `tagidList` varchar(150) NOT NULL DEFAULT '' COMMENT '用户被打上的标签ID列表',
  `nickname` varchar(20) NOT NULL DEFAULT '' COMMENT '用户的昵称',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
  `country` varchar(30) NOT NULL DEFAULT '' COMMENT '用户所在国家',
  `province` varchar(50) NOT NULL DEFAULT '' COMMENT '用户所在省份',
  `city` varchar(30) NOT NULL DEFAULT '' COMMENT '用户所在城市',
  `language` varchar(20) NOT NULL COMMENT '用户的语言，简体中文为zh_CN',
  `headimgurl` varchar(50) NOT NULL COMMENT '用户头像，最后一个数值代表正方形头像大小',
  `remark` varchar(150) NOT NULL DEFAULT '' COMMENT '公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注',
  `subscribeTime` int(10) NOT NULL DEFAULT '0' COMMENT '用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间',
  `firstSubscribeTime` int(10) NOT NULL DEFAULT '0' COMMENT '时间',
  `createTime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`userId`),
  KEY `openid` (`openid`,`unionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信用户表';

-- ----------------------------
-- Records of wx_user
-- ----------------------------

-- ----------------------------
-- Table structure for wx_user_subscribe_log
-- ----------------------------
DROP TABLE IF EXISTS `wx_user_subscribe_log`;
CREATE TABLE `wx_user_subscribe_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `openid` varchar(30) NOT NULL DEFAULT '',
  `subscribe` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否订阅该公众号标识，值为0时，代表此用户没有关注该公众号',
  `createTime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`,`subscribe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信用户关注日志';

-- ----------------------------
-- Records of wx_user_subscribe_log
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
