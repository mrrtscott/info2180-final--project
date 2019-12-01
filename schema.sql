/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : tracker

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-11-25 18:03:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for issues
-- ----------------------------
DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` longtext,
  `description` longtext,
  `type` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `updated` varchar(255) DEFAULT NULL,
  `assigned_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of issues
-- ----------------------------
INSERT INTO `issues` VALUES ('2', '1', 'Xss Vulerability in Add User Form', 'Google LLC is an American multinational technology company that specializes in Internet-related services and products, which include online advertising technologies, search engine, cloud computing, software, and hardware', 'Proposal', 'Major', '1', '2019/11/24', '2019/11/24', 'Tom Brady');
INSERT INTO `issues` VALUES ('3', '1', 'Location service isn\'t working', 'Google LLC is an American multinational technology company that specializes in Internet-related services and products, which include online advertising technologies,', 'Bug', 'Major', '1', '2019/11/24', '2019/11/24', 'Jan Brady');
INSERT INTO `issues` VALUES ('4', '1', 'Ajax is not working in html page', 'Google LLC is an American multinational technology company that specializes in Internet-related services and products, which include online advertising technologies,', 'Bug', 'Subject', '2', '2019/11/25', '2019/11/25', 'Miricle Group');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_joined` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('33', 'TEST', 'TEST', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', '2019/11/25', '1');
INSERT INTO `users` VALUES ('32', 'Romaro', 'M', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', '2019/11/25', '2');
INSERT INTO `users` VALUES ('34', 'sdaf', 'asdf', '57095311a5465e90837d64f6e29bca0a', 'asdf@asdf.com', '2019/11/25', '1');
