/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50716
Source Host           : localhost:3306
Source Database       : basecms

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2016-12-17 14:39:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1481941481');
INSERT INTO `migration` VALUES ('m161217_012603_statistics', '1481957754');

-- ----------------------------
-- Table structure for `session`
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of session
-- ----------------------------
INSERT INTO `session` VALUES ('2n23paqqnj6a58nikpft6h2cq6', '1481960240', 0x5F5F666C6173687C613A313A7B733A32303A22636F6E74616374466F726D5375626D6974746564223B693A2D313B7D5F5F76697369746F725F5F7C733A36343A2261623364656165393761323466353638613662316261326436663361643064396230656663353166326135646234396434633132623930333035633235363662223B636F6E74616374466F726D5375626D69747465647C623A313B);
INSERT INTO `session` VALUES ('6fqci4fdmc967idqjf70hbvae4', '1481959413', 0x5F5F666C6173687C613A303A7B7D5F5F76697369746F725F5F7C733A36343A2262613066663130626433393562363465306436323633336331663162373931376465336132633837373238653466326134393362623536393439393039343236223B);
INSERT INTO `session` VALUES ('6p2j34dpgljnc90lcov5ighfk6', '1481953473', 0x5F5F666C6173687C613A303A7B7D76697369746F727C733A36343A2236396164636261313335316466373035663666336532323138303764643565306131613934636337356535666433366337626538663330643862333139363034223B);
INSERT INTO `session` VALUES ('9f7d3lqgiren1g0vsa3nf93220', '1481954935', 0x5F5F666C6173687C613A303A7B7D76697369746F727C733A36343A2239666433636563626564323033663664313762363165313936373439323133323831346530333763376138663066623933366565663934626564626261393332223B);
INSERT INTO `session` VALUES ('k0snfinnjiad808ml2of74aff4', '1481953669', 0x5F5F666C6173687C613A303A7B7D76697369746F727C733A36343A2236633931303266303232623963613135343838313166346331313065643437643266353766316439356332386164653066623937633261356161336266666130223B);
INSERT INTO `session` VALUES ('lkjk3n584elf6314p2foj17j40', '1481959432', 0x5F5F666C6173687C613A313A7B733A32303A22636F6E74616374466F726D5375626D6974746564223B693A2D313B7D76697369746F727C733A36343A2263316238343963623465313730343138326462663365616431353035613336636636626662656137316135383264623635626637666334363266653530653465223B5F5F72657475726E55726C7C733A393A222F74686F6E672D6B65223B5F5F69647C733A333A22313030223B5F5F636170746368612F736974652F636170746368617C733A373A227175686F6F6575223B5F5F636170746368612F736974652F63617074636861636F756E747C693A333B636F6E74616374466F726D5375626D69747465647C623A313B5F5F76697369746F725F5F7C733A36343A2230393065653562616634366631636238313634343535323136623935386266656535376665666261323766646264356365376437643237613932313461303237223B);
INSERT INTO `session` VALUES ('t3ji7pbpkpl3ve5n7n5djn4g65', '1481953321', 0x5F5F666C6173687C613A303A7B7D76697369746F727C733A36343A2236633263346233383631353164643034316130336663653930326138616435613061326139306634356262353762633065636133646662636239396334363236223B);
INSERT INTO `session` VALUES ('tdn4hamb41v3isa7bjugnlvl11', '1481952584', 0x5F5F666C6173687C613A303A7B7D76697369746F727C733A36343A2266316262653035326330363961343762623761333461666331636461643362353363383830303564643237616332313663616563356266303236316332633864223B);
INSERT INTO `session` VALUES ('v8bres8q63g5shq765t2lh04d7', '1481953434', 0x5F5F666C6173687C613A303A7B7D76697369746F727C733A36343A2239373361383663613633646531616633376364633162623466666137663139666565643464376462336232346236653263316632363734323865663432393735223B);

-- ----------------------------
-- Table structure for `statistics`
-- ----------------------------
DROP TABLE IF EXISTS `statistics`;
CREATE TABLE `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_log` timestamp NULL DEFAULT NULL,
  `sources` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opera` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_contact` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_sessions` (`sessions`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of statistics
-- ----------------------------
INSERT INTO `statistics` VALUES ('1', 'ba0ff10bd395b64e0d62633c1f1b7917de3a2c87728e4f2a493bb56949909426', '2016-12-17 13:59:33', 'Truy cập trực tiếp', '192.168.0.254', '- - - - -', 'Windows 10.0', 'Chrome 55.0.2883.87', null, null, null, null, null);
INSERT INTO `statistics` VALUES ('2', 'ab3deae97a24f568a6b1ba2d6f3ad0d9b0efc51f2a5db49d4c12b90305c2566b', '2016-12-17 14:00:03', 'Truy cập trực tiếp', '192.168.0.254', '- - - - -', 'Windows 10.0', 'Chrome 55.0.2883.87', '2016-12-17 14:13:19', 'abd', 'ad@sdfjk.com', 'akdhfk', 'skdfhkdfksfjsf');
