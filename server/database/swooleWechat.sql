/*
Navicat MySQL Data Transfer

Source Server         : 本地链接
Source Server Version : 80001
Source Host           : 172.17.0.2:3306
Source Database       : swooleWechat

Target Server Type    : MYSQL
Target Server Version : 80001
File Encoding         : 65001

Date: 2017-05-09 23:10:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL,
  `account` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `loginTime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `createTime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户';

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('1', '赵建辉', 'admin', '123456', 'zhaojianhui129@163.com', '2017-02-06 17:13:54', '2017-02-06 17:14:12');

-- ----------------------------
-- Table structure for wx_rec_event_subscribe
-- ----------------------------
DROP TABLE IF EXISTS `wx_rec_event_subscribe`;
CREATE TABLE `wx_rec_event_subscribe` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `MsgId` varchar(20) NOT NULL COMMENT '消息id，64位整型',
  `MsgType` varchar(10) NOT NULL COMMENT 'voice',
  `ToUserName` varchar(50) NOT NULL COMMENT '开发者微信号',
  `FromUserName` varchar(50) NOT NULL COMMENT '发送方帐号（一个OpenID）',
  `Event` varchar(100) NOT NULL COMMENT '事件类型，subscribe(订阅)、unsubscribe(取消订阅)',
  `CreateTime` int(10) NOT NULL COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关注与取关注事件消息记录表';

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
  `PicUrl` varchar(150) NOT NULL COMMENT '图片链接（由系统生成）',
  `MediaId` varchar(100) NOT NULL COMMENT '图片消息媒体id，可以调用多媒体文件下载接口拉取数据。',
  `CreateTime` int(10) NOT NULL COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图片接收消息记录表';

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
  `Title` varchar(100) NOT NULL COMMENT '消息标题',
  `Description` varchar(200) NOT NULL COMMENT '消息描述',
  `Url` varchar(150) NOT NULL COMMENT '消息链接',
  `CreateTime` int(10) NOT NULL COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='链接接收消息记录表';

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
  `Location_X` varchar(30) NOT NULL COMMENT '地理位置维度',
  `Location_Y` varchar(30) NOT NULL COMMENT '地理位置经度',
  `Scale` tinyint(2) NOT NULL COMMENT '地图缩放大小',
  `Label` varchar(150) NOT NULL COMMENT '地理位置信息',
  `CreateTime` int(10) NOT NULL COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='地理位置接收消息记录表';

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
  `MediaId` varchar(100) NOT NULL COMMENT '语音消息媒体id，可以调用多媒体文件下载接口拉取数据。',
  `ThumbMediaId` varchar(100) NOT NULL COMMENT '视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。',
  `CreateTime` int(10) NOT NULL COMMENT '消息创建时间 （整型）',
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
  `CreateTime` int(10) NOT NULL COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文本接收消息记录表';

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
  `MediaId` varchar(100) NOT NULL COMMENT '视频消息媒体id，可以调用多媒体文件下载接口拉取数据。',
  `ThumbMediaId` varchar(100) NOT NULL COMMENT '视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。',
  `CreateTime` int(10) NOT NULL COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='视频接收消息记录表';

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
  `MediaId` varchar(100) NOT NULL COMMENT '语音消息媒体id，可以调用多媒体文件下载接口拉取数据。',
  `Format` varchar(30) NOT NULL COMMENT '语音格式，如amr，speex等',
  `Recognition` text NOT NULL COMMENT '语音识别文字',
  `CreateTime` int(10) NOT NULL COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='语音接收消息记录表';

-- ----------------------------
-- Records of wx_rec_msg_voice
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
