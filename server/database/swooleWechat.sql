/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 80001
Source Host           : 127.0.0.1:3306
Source Database       : swooleWechat

Target Server Type    : MYSQL
Target Server Version : 80001
File Encoding         : 65001

Date: 2017-07-27 23:28:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sys_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `sys_auth_rule`;
CREATE TABLE `sys_auth_rule` (
  `ruleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ruleName` varchar(50) NOT NULL DEFAULT '' COMMENT '规则中文名称',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '规则唯一标识',
  `parentId` int(10) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `orderNum` mediumint(5) NOT NULL DEFAULT '0' COMMENT '排序数字，值越小越靠前',
  `condition` varchar(100) NOT NULL DEFAULT '' COMMENT '规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  `isPublic` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否公共权限',
  `isOpen` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否展开(0：不展开,1:展开)',
  `isDel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(0:正常,1:删除）',
  `addUserId` int(10) NOT NULL DEFAULT '0' COMMENT '添加用户ID',
  `addTime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`ruleId`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='用户认证规则表';

-- ----------------------------
-- Records of sys_auth_rule
-- ----------------------------
INSERT INTO `sys_auth_rule` VALUES ('1', '后台模块', '/Admin/Index/index', '0', '0', '', '0', '1', '0', '0', '0');
INSERT INTO `sys_auth_rule` VALUES ('2', '系统管理', '/Admin/System/index', '1', '3', '', '0', '1', '0', '0', '0');
INSERT INTO `sys_auth_rule` VALUES ('3', '菜单管理', '/Admin/SysMenu/index', '2', '0', '', '0', '0', '0', '2', '1499521523');
INSERT INTO `sys_auth_rule` VALUES ('4', '用户组管理', '/Admin/SysUserGroup/index', '2', '1', '', '0', '0', '0', '2', '1499522110');
INSERT INTO `sys_auth_rule` VALUES ('5', '用户管理', '/Admin /SysUser/Index', '2', '3', '', '0', '0', '0', '2', '1499527060');
INSERT INTO `sys_auth_rule` VALUES ('6', '权限管理', '/Admin/SysAuthRule/index', '2', '4', '', '0', '0', '0', '2', '1499527114');
INSERT INTO `sys_auth_rule` VALUES ('7', '树结构Select Option', '/Admin/SysMenu/getTreeOption', '4', '5', '', '1', '1', '0', '2', '1499610132');
INSERT INTO `sys_auth_rule` VALUES ('8', '新增/编辑', '/Admin/SysMenu/save', '3', '2', '', '0', '1', '0', '2', '1499610151');
INSERT INTO `sys_auth_rule` VALUES ('12', '新增/编辑', '/Admin/SysUserGroup/save', '4', '1', '', '0', '1', '0', '2', '1499667234');
INSERT INTO `sys_auth_rule` VALUES ('13', '仪表盘', '/Admin/Index/index', '1', '2', '', '1', '0', '0', '2', '1500302417');
INSERT INTO `sys_auth_rule` VALUES ('14', '控制面板', '/Admin/Index/Index', '13', '6', '', '1', '1', '0', '2', '1500302487');
INSERT INTO `sys_auth_rule` VALUES ('15', '系统信息', '/Admin/Index/sysinfo', '13', '7', '', '1', '1', '0', '2', '1500302508');
INSERT INTO `sys_auth_rule` VALUES ('16', '异步载入皮肤配置', '/Admin/Index/skinConfig', '13', '8', '', '1', '1', '0', '2', '1500302552');
INSERT INTO `sys_auth_rule` VALUES ('17', '登录部分', '/Admin/Login/index', '1', '1', '', '1', '0', '0', '2', '1500302611');
INSERT INTO `sys_auth_rule` VALUES ('18', '登录界面', '/Admin/Login/index', '17', '9', '', '1', '1', '0', '2', '1500302653');
INSERT INTO `sys_auth_rule` VALUES ('19', '登录提交', '/Admin/Login/loginpost', '17', '10', '', '1', '1', '0', '2', '1500302678');
INSERT INTO `sys_auth_rule` VALUES ('20', '退出登录', '/Admin/Login/logout', '17', '11', '', '1', '1', '0', '2', '1500302705');
INSERT INTO `sys_auth_rule` VALUES ('21', '验证码展示', '/Admin/Login/captcha', '17', '12', '', '1', '1', '0', '2', '1500302738');
INSERT INTO `sys_auth_rule` VALUES ('22', '菜单首页', '/Admin/SysMenu/index', '3', '0', '', '0', '1', '0', '2', '1500303632');
INSERT INTO `sys_auth_rule` VALUES ('23', '树结构Select Option', '/Admin/SysMenu/getTreeOption', '3', '5', '', '1', '1', '0', '2', '1500303748');
INSERT INTO `sys_auth_rule` VALUES ('24', '获取菜单json结构数据', '/Admin/SysMenu/get', '3', '6', '', '1', '1', '0', '2', '1500303866');
INSERT INTO `sys_auth_rule` VALUES ('25', '保存排序和层级关系', '/Admin/SysMenu/saveSort', '3', '4', '', '0', '1', '0', '2', '1500303942');
INSERT INTO `sys_auth_rule` VALUES ('26', '删除', '/Admin/SysMenu/del', '3', '3', '', '0', '1', '0', '2', '1500303986');
INSERT INTO `sys_auth_rule` VALUES ('27', '用户组首页', '/Admin/SysUserGroup/index', '4', '0', '', '0', '1', '0', '2', '1500304045');
INSERT INTO `sys_auth_rule` VALUES ('28', '获取用户组json结构数据', '/Admin/SysUserGroup/get', '4', '6', '', '1', '1', '0', '2', '1500304336');
INSERT INTO `sys_auth_rule` VALUES ('29', '保存排序及层级关系', '/Admin/SysUserGroup/saveSort', '4', '4', '', '0', '1', '0', '2', '1500304378');
INSERT INTO `sys_auth_rule` VALUES ('30', '删除', '/Admin/SysUserGroup/del', '4', '2', '', '0', '1', '0', '2', '1500304402');
INSERT INTO `sys_auth_rule` VALUES ('31', '权限编辑', '/Admin/SysUserGroup/saveRule', '4', '3', '', '0', '1', '0', '2', '1500304466');
INSERT INTO `sys_auth_rule` VALUES ('32', '用户管理首页', '/Admin/SysUser/index', '5', '0', '', '0', '1', '0', '2', '1500304595');
INSERT INTO `sys_auth_rule` VALUES ('33', '用户列表json结构数据', '/Admin /SysUser/getPageList', '5', '4', '', '1', '1', '0', '2', '1500304646');
INSERT INTO `sys_auth_rule` VALUES ('34', '新增/编辑', '/Admin /SysUser/save', '5', '1', '', '0', '1', '0', '2', '1500304996');
INSERT INTO `sys_auth_rule` VALUES ('35', '获取用户json结构数据', '/Admin /SysUser/get', '5', '5', '', '1', '1', '0', '2', '1500305167');
INSERT INTO `sys_auth_rule` VALUES ('36', '设置用户状态', '/Admin/SysUser/setStatus', '5', '2', '', '0', '1', '0', '2', '1500305248');
INSERT INTO `sys_auth_rule` VALUES ('37', '权限编辑', '/Admin/SysUser/saveRule', '5', '3', '', '0', '1', '0', '2', '1500305283');
INSERT INTO `sys_auth_rule` VALUES ('38', '权限管理首页', '/Admin/SysAuthRule/index', '6', '0', '', '0', '1', '0', '2', '1500305352');
INSERT INTO `sys_auth_rule` VALUES ('39', '树结构Select Option', '/Admin/SysAuthRule/getTreeOption', '6', '4', '', '1', '1', '0', '2', '1500306156');
INSERT INTO `sys_auth_rule` VALUES ('40', '权限列表json结构数据', '/Admin/SysAuthRule/getJsTreeData', '6', '5', '', '1', '1', '0', '2', '1500306256');
INSERT INTO `sys_auth_rule` VALUES ('41', '新增/编辑', '/Admin/SysAuthRule/save', '6', '1', '', '0', '1', '0', '2', '1500306299');
INSERT INTO `sys_auth_rule` VALUES ('42', '获取权限json结构数据', '/Admin/SysAuthRule/get', '6', '6', '', '1', '1', '0', '2', '1500306331');
INSERT INTO `sys_auth_rule` VALUES ('43', '保存排序及层级关系', '/Admin/SysAuthRule/saveSort', '6', '3', '', '0', '1', '0', '2', '1500306392');
INSERT INTO `sys_auth_rule` VALUES ('44', '删除', '/Admin/SysAuthRule/del', '6', '2', '', '0', '1', '0', '2', '1500306442');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='系统菜单表';

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', 'admin', '仪表盘', '/Admin/Dashboard/index', 'fa fa-dashboard', '0', '0', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('2', 'admin', '控制面板', '/Admin/Index/index', 'fa fa-desktop', '1', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('3', 'admin', '系统管理', '/Admin/System/index', 'fa fa-cog', '0', '2', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('4', 'admin', '菜单管理', '/Admin/SysMenu/index', 'fa fa-sitemap', '3', '0', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('5', 'admin', '系统用户组管理', '/Admin/SysUserGroup/index', 'fa fa-group', '3', '1', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('6', 'admin', '系统用户管理', '/Admin/SysUser/Index', 'fa fa-user', '3', '2', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('7', 'admin', '权限管理', '/Admin/SysAuthRule/index', 'fa fa-gavel', '3', '3', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('8', 'admin', '系统信息', '/Admin/Index/sysinfo', 'fa fa-linux', '1', '0', '0', '0', '0');
INSERT INTO `sys_menu` VALUES ('9', 'admin', '微信用户', '/Admin/WxUser/index', 'fa fa-user', '0', '1', '0', '2', '1500474574');
INSERT INTO `sys_menu` VALUES ('10', 'admin', '用户组管理', '/Admin/WxUserGroup/index', 'fa fa-group', '9', '1', '0', '2', '1500474665');
INSERT INTO `sys_menu` VALUES ('11', 'admin', '微信用户管理', '/Admin/WxUser/index', 'fa fa-user', '9', '2', '0', '2', '1500474711');
INSERT INTO `sys_menu` VALUES ('12', 'admin', '用户标签管理', '/Admin/WxUserTag/Index', 'fa fa-tag', '9', '0', '0', '2', '1501164293');

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
  `loginTime` varchar(20) NOT NULL DEFAULT '' COMMENT '登录时间',
  `loginIp` varchar(50) NOT NULL DEFAULT '' COMMENT '登录IP',
  `isDel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  `addUserId` int(10) NOT NULL DEFAULT '0' COMMENT '添加用户ID',
  `addTime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `index1` (`userName`),
  KEY `index2` (`account`),
  KEY `index3` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='系统用户表';

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('1', '1', '超级管理员', 'qianxun', 'c8396d9aeb430d0828d248c79f8788194c9b3b6b', 'zhaojianhui129@163.com', 'a:3:{i:0;s:1:\"3\";i:1;s:1:\"5\";i:2;s:1:\"7\";}', '', '127.0.0.1', '0', '0', '0');
INSERT INTO `sys_user` VALUES ('2', '1', '千寻', 'admin', 'cd5ea73cd58f827fa78eef7197b8ee606c99b2e6', 'zhaojianhui@163.com', 'a:2:{i:0;s:1:\"4\";i:1;s:2:\"12\";}', '', '', '1', '2', '1499872453');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='系统用户分组表';

-- ----------------------------
-- Records of sys_user_group
-- ----------------------------
INSERT INTO `sys_user_group` VALUES ('1', '超级管理', '0', '0', '0', 'a:8:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";i:5;s:1:\"6\";i:6;s:1:\"7\";i:7;s:2:\"12\";}', '2', '1499311306');
INSERT INTO `sys_user_group` VALUES ('2', '微信运营', '0', '1', '0', 'a:0:{}', '2', '1499327471');
INSERT INTO `sys_user_group` VALUES ('3', '客服组', '0', '2', '0', 'a:4:{i:0;s:1:\"7\";i:1;s:1:\"3\";i:2;s:2:\"12\";i:3;s:1:\"4\";}', '2', '1499327554');
INSERT INTO `sys_user_group` VALUES ('4', '客服组长', '3', '0', '0', 'a:4:{i:0;s:1:\"3\";i:1;s:1:\"4\";i:2;s:1:\"7\";i:3;s:2:\"12\";}', '2', '1499609131');
INSERT INTO `sys_user_group` VALUES ('5', '客服专员', '3', '1', '0', 'a:2:{i:0;s:1:\"4\";i:1;s:2:\"12\";}', '2', '1499609143');

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
  `EventKey` varchar(200) NOT NULL DEFAULT '' COMMENT '事件KEY值，与自定义菜单接口中KEY值对应',
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
  `openId` varchar(30) NOT NULL DEFAULT '' COMMENT '用户的标识，对当前公众号唯一',
  `unionId` varchar(30) NOT NULL DEFAULT '' COMMENT '只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段。',
  `groupId` int(10) NOT NULL DEFAULT '0' COMMENT '微信分组ID',
  `tagidList` varchar(150) NOT NULL DEFAULT '' COMMENT '用户被打上的标签ID列表',
  `nickName` varchar(20) NOT NULL DEFAULT '' COMMENT '用户的昵称',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
  `country` varchar(30) NOT NULL DEFAULT '' COMMENT '用户所在国家',
  `province` varchar(50) NOT NULL DEFAULT '' COMMENT '用户所在省份',
  `city` varchar(30) NOT NULL DEFAULT '' COMMENT '用户所在城市',
  `language` varchar(20) NOT NULL COMMENT '用户的语言，简体中文为zh_CN',
  `headimgurl` varchar(200) NOT NULL COMMENT '用户头像，最后一个数值代表正方形头像大小',
  `remark` varchar(150) NOT NULL DEFAULT '' COMMENT '公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注',
  `isBlock` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否拉黑',
  `subscribeTime` int(10) NOT NULL DEFAULT '0' COMMENT '用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间',
  `firstSubscribeTime` int(10) NOT NULL DEFAULT '0' COMMENT '时间',
  `createTime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`userId`),
  KEY `openid` (`openId`,`unionId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='微信用户表';

-- ----------------------------
-- Records of wx_user
-- ----------------------------
INSERT INTO `wx_user` VALUES ('2', '1', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '', '100', '[]', '千寻', '1', '中国', '广东', '广州', 'zh_CN', 'http://wx.qlogo.cn/mmopen/N5k3j7jY0gEyjFdiarAI50Bia7ERBy8ITHKd1NaWNTxEyJXuLWgGP3pnyrP5wvxwm19Rwkoas4ApkKSYormQxo5ibYEYibicgPX3U/0', '测试备注', '0', '1500906186', '1500906186', '1500906211');
INSERT INTO `wx_user` VALUES ('3', '1', 'ogKdPt0tKAYQM4a1buEoJti1A1dk', '', '2', '[]', '霞文', '2', '中国', '广东', '广州', 'zh_CN', 'http://wx.qlogo.cn/mmopen/N5k3j7jY0gEyjFdiarAI50KMeTaia7qzfh6tccEWxoialovZym3WEYIw1c4ZZBSbMianOjLicOfpRfC4XWX5mk0iaZHbSpX3EiaBey8/0', '你好吗？', '0', '1500906325', '1500906325', '1500906327');

-- ----------------------------
-- Table structure for wx_user_group
-- ----------------------------
DROP TABLE IF EXISTS `wx_user_group`;
CREATE TABLE `wx_user_group` (
  `groupId` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `wxGroupId` int(10) NOT NULL DEFAULT '0' COMMENT '微信端用户组ID',
  `groupName` varchar(50) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `parentId` int(10) NOT NULL DEFAULT '0' COMMENT '上级用户组ID',
  `userCount` int(10) NOT NULL DEFAULT '0' COMMENT '用户数',
  `orderNum` mediumint(5) NOT NULL DEFAULT '0' COMMENT '排序数字，值越小越靠前',
  `isDel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(0:正常,1:删除)',
  `addUserId` int(10) NOT NULL DEFAULT '0' COMMENT '添加用户ID',
  `addTime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`groupId`),
  UNIQUE KEY `groupIdIndex` (`wxGroupId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='微信用户分组表';

-- ----------------------------
-- Records of wx_user_group
-- ----------------------------
INSERT INTO `wx_user_group` VALUES ('1', '0', '未分组', '0', '0', '0', '0', '2', '1500559958');
INSERT INTO `wx_user_group` VALUES ('2', '1', '黑名单', '0', '0', '1', '0', '2', '1500559958');
INSERT INTO `wx_user_group` VALUES ('3', '2', '星标组', '0', '1', '2', '0', '2', '1500559958');
INSERT INTO `wx_user_group` VALUES ('4', '100', '内部人员', '0', '1', '3', '0', '2', '1500564732');
INSERT INTO `wx_user_group` VALUES ('26', '112', '测试组', '4', '0', '0', '0', '2', '1500647210');
INSERT INTO `wx_user_group` VALUES ('27', '113', '开发组', '4', '0', '2', '0', '2', '1500647233');
INSERT INTO `wx_user_group` VALUES ('28', '114', '运营组', '4', '0', '1', '0', '2', '1500647240');

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

-- ----------------------------
-- Table structure for wx_user_tag
-- ----------------------------
DROP TABLE IF EXISTS `wx_user_tag`;
CREATE TABLE `wx_user_tag` (
  `tagId` int(10) NOT NULL AUTO_INCREMENT COMMENT '标签ID',
  `wxTagId` int(10) NOT NULL DEFAULT '0' COMMENT '微信标签ID',
  `tagName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标签名称',
  `userCount` int(10) NOT NULL DEFAULT '0' COMMENT '用户数',
  `parentId` int(10) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `orderNum` mediumint(5) NOT NULL DEFAULT '0' COMMENT '排序数字，值越小越靠前',
  `isDel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除(0:正常,1:删除)',
  `addUserId` int(10) NOT NULL DEFAULT '0' COMMENT '添加用户ID',
  `addTime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`tagId`),
  KEY `tagIdindex` (`wxTagId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='微信用户标签表';

-- ----------------------------
-- Records of wx_user_tag
-- ----------------------------
INSERT INTO `wx_user_tag` VALUES ('9', '117', '测试标签', '0', '0', '0', '1', '2', '1501168508');
INSERT INTO `wx_user_tag` VALUES ('10', '2', '星标组', '1', '0', '0', '0', '2', '1501168837');
INSERT INTO `wx_user_tag` VALUES ('11', '100', '内部人员', '1', '10', '3', '0', '2', '1501168837');
INSERT INTO `wx_user_tag` VALUES ('12', '112', '测试组', '0', '10', '2', '0', '2', '1501168837');
INSERT INTO `wx_user_tag` VALUES ('13', '114', '运营组', '0', '11', '0', '0', '2', '1501168837');
SET FOREIGN_KEY_CHECKS=1;
