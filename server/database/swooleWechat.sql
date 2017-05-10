/*
Navicat MySQL Data Transfer

Source Server         : 阿里云
Source Server Version : 80001
Source Host           : 39.108.11.100:3306
Source Database       : swooleWechat

Target Server Type    : MYSQL
Target Server Version : 80001
File Encoding         : 65001

Date: 2017-05-10 23:26:19
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='自定义菜单事件记录表';

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
  `PicUrl` varchar(150) NOT NULL DEFAULT '' COMMENT '图片链接（由系统生成）',
  `MediaId` varchar(100) NOT NULL DEFAULT '' COMMENT '图片消息媒体id，可以调用多媒体文件下载接口拉取数据。',
  `CreateTime` int(10) NOT NULL DEFAULT '0' COMMENT '消息创建时间 （整型）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='图片接收消息记录表';

-- ----------------------------
-- Records of wx_rec_msg_image
-- ----------------------------
INSERT INTO `wx_rec_msg_image` VALUES ('1', '6418510779580815229', 'image', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'http://mmbiz.qpic.cn/mmbiz_jpg/TkwNNc2rue0ZFhiaOCcuyuTZbDB0JoR9gGaTBgayr1kJV1EtaZ0gq7YPfs22EH8Oeu3Yo2lqZxe7bjnTcuZE9Tg/0', 'C8lqeWDeNLd0L9l0UzfmlT5sTuJnZ25IoGN2YEaGKS0IQImV_0niSQgSJ_pisONX', '1494425996');
INSERT INTO `wx_rec_msg_image` VALUES ('2', '6418527487003597941', 'image', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'http://mmbiz.qpic.cn/mmbiz_jpg/TkwNNc2rue0ZFhiaOCcuyuTZbDB0JoR9gyz0j40aTymppfiagL1WSQt8qJw4wA2xjYfYVOg0hyJckuhwR3RYXe0Q/0', 'g2NGKt9I_xMu4g4wg3a61uDM78fPvP5MrLgxwWxXIliqARZomkwU2HSriQdxl3mS', '1494429886');
INSERT INTO `wx_rec_msg_image` VALUES ('3', '6418527487003597940', 'image', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'http://mmbiz.qpic.cn/mmbiz_jpg/TkwNNc2rue0ZFhiaOCcuyuTZbDB0JoR9gIgEn8D243uFpOZ5gW4hA9t1h3d6ZqbCibP1VjT2gRKsibfvlg30rp1iaw/0', 'SUVcU_sKhQ-wCviQ99KcNkSjUqkzt5mWlx_RUi_xODhj4f-ElDIcm2KhkN2CJ0Mo', '1494429886');
INSERT INTO `wx_rec_msg_image` VALUES ('4', '6418527487003597942', 'image', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'http://mmbiz.qpic.cn/mmbiz_jpg/TkwNNc2rue0ZFhiaOCcuyuTZbDB0JoR9gO7YIoUicrH5IJbf6RcpK2DYdDY9tibapvEGyQaM9CKP1s91cCUgSOicWA/0', 'k5s23T0qrAIsemEPFfOYYSljwmywRTie2Cl_TbG8mYknmU-b0rO8efVY2SQPhab8', '1494429886');

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
INSERT INTO `wx_rec_msg_link` VALUES ('1', '6418511329336629168', 'link', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '25 个常用的 Linux iptables 规则', '一些常用的 Linux iptables 规则，请根据自己的具体需要再修改。', '一些常用的 Linux iptables 规则，请根据自己的具体需要再修改。', '1494426124');
INSERT INTO `wx_rec_msg_link` VALUES ('2', '6418526473391316037', 'link', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '如何在不停机的情况下，完成百万级数据跨表迁移？', 'Stripe与大家分享了他们在不停服的情况下如何做大规模数据在线迁移的经验，尤其是数据模型发生改变时。', 'Stripe与大家分享了他们在不停服的情况下如何做大规模数据在线迁移的经验，尤其是数据模型发生改变时。', '1494429650');
INSERT INTO `wx_rec_msg_link` VALUES ('3', '6418527276550200423', 'link', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'WeUI', '为微信 Web 服务量身设计', '为微信 Web 服务量身设计', '1494429837');

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
INSERT INTO `wx_rec_msg_location` VALUES ('1', '6418527371039480942', 'location', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '23.163044', '113.382989', '15', '广州市天河区岑村圣堂大街福永商场(岑村小学南)', '1494429859');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='文本接收消息记录表';

-- ----------------------------
-- Records of wx_rec_msg_text
-- ----------------------------
INSERT INTO `wx_rec_msg_text` VALUES ('1', '6418509856162846471', 'text', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '还是基督教', '1494425781');
INSERT INTO `wx_rec_msg_text` VALUES ('2', '6418509899112519438', 'text', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '真的么？', '1494425791');
INSERT INTO `wx_rec_msg_text` VALUES ('3', '6418509997896767264', 'text', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '为什么接收消息这么慢？', '1494425814');
INSERT INTO `wx_rec_msg_text` VALUES ('4', '6418510027961538342', 'text', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '确定么？', '1494425821');
INSERT INTO `wx_rec_msg_text` VALUES ('5', '6418510667911665518', 'text', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '/::)', '1494425970');
INSERT INTO `wx_rec_msg_text` VALUES ('6', '6418511114588264346', 'text', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '哈喽哈喽哈喽，我要说话', '1494426074');
INSERT INTO `wx_rec_msg_text` VALUES ('7', '6418516951448820266', 'text', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', '高规格', '1494427433');

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
INSERT INTO `wx_rec_msg_video` VALUES ('1', '6418510990034212748', 'video', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'wIvUHGkFLdjbXK9TTnto4BkqA3BmgpxzgUcnN0WgfpvNpV8_JAo7qRYc2wW4_M-j', 'UNDVEiILx9bVZrDj1rZfEGtHwrD9E5R9KCFTS92MoS48QEJZKRah6mArx-Mq4qM9', '1494426045');
INSERT INTO `wx_rec_msg_video` VALUES ('2', '6418514133950273716', 'video', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'YcKkHz4xU76yjiRxYPR5lFwKd1UpBT8rPF6sCu8ZQT52EWQYIE_NKvSh1weOHFr-', 'fZo5NAAWc7_voaABWyEtF4_Xqhep6xyDq15Ysw6eSxCxZtjQbMBKLPI_AAhut_Re', '1494426777');
INSERT INTO `wx_rec_msg_video` VALUES ('3', '6418527706046930053', 'video', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'iBBo0kY7zkapRsUy0HALm3KQssj9Dnmo0IVCe1wgdoQ27T4D_BNMQ1oFLw7DWJPn', 'PjCwezhIoGHngTouX-oltQP417-1RvBGAMrLPkXGpUIUhLmm2ltsAFNFLkn4elyD', '1494429937');

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
INSERT INTO `wx_rec_msg_voice` VALUES ('1', '6418515907771767261', 'voice', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'wz3p3bc-kx70LDbS33BgiWwmuFuY0BdJgT27i0f7a_cHaS7FGkjYzxq3G0RFfjv6', 'amr', '', '1494427190');
INSERT INTO `wx_rec_msg_voice` VALUES ('2', '6418516023735884259', 'voice', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'q0bZNUEgwsPfbqxuBT33yuVx64vyns_sZ0Ql4gV5z9kHqBizXvTXBphAXp6SNb6_', 'amr', '', '1494427217');
INSERT INTO `wx_rec_msg_voice` VALUES ('3', '6418527413989153905', 'voice', 'gh_570de6da66f2', 'ogKdPt-LQTpRjBSRQYEZwNN2dGE4', 'BcIn76CIFkNX4rMhjDaPpFRhzO4261sBk9VmbyCehd-MFUh7TmDrOaH0OANxKlzC', 'amr', '', '1494429869');
SET FOREIGN_KEY_CHECKS=1;
