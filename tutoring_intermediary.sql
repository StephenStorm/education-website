/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : tutoring_intermediary

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-08-11 14:52:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for announcement
-- ----------------------------
DROP TABLE IF EXISTS `announcement`;
CREATE TABLE `announcement` (
  `et_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  KEY `announcement_fk` (`et_id`),
  CONSTRAINT `announcement_fk` FOREIGN KEY (`et_id`) REFERENCES `user_edu_tea` (`et_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for apply_lis
-- ----------------------------
DROP TABLE IF EXISTS `apply_lis`;
CREATE TABLE `apply_lis` (
  `p_id` varchar(255) NOT NULL,
  `c_id` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_id`,`c_id`),
  KEY `apply_lis_al` (`c_id`),
  CONSTRAINT `apply_lis_al` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apply_lis_al1` FOREIGN KEY (`p_id`) REFERENCES `user_parent` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `fee` float DEFAULT NULL,
  `teacher_name` varchar(255) DEFAULT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `es_id` int(11) DEFAULT NULL,
  `classroom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `course_fk` (`es_id`),
  CONSTRAINT `course_fk` FOREIGN KEY (`es_id`) REFERENCES `edu_store` (`es_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for edu_store
-- ----------------------------
DROP TABLE IF EXISTS `edu_store`;
CREATE TABLE `edu_store` (
  `es_id` int(11) NOT NULL AUTO_INCREMENT,
  `et_id` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`es_id`),
  KEY `et_store_fk` (`et_id`),
  CONSTRAINT `et_store_fk` FOREIGN KEY (`et_id`) REFERENCES `user_edu_tea` (`et_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for evaluate_course
-- ----------------------------
DROP TABLE IF EXISTS `evaluate_course`;
CREATE TABLE `evaluate_course` (
  `p_id` varchar(255) NOT NULL,
  `c_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `star_level` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`p_id`,`c_id`),
  KEY `evaluate_course_fk2` (`c_id`),
  CONSTRAINT `evaluate_course_fk1` FOREIGN KEY (`p_id`) REFERENCES `user_parent` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `evaluate_course_fk2` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for evaluate_et
-- ----------------------------
DROP TABLE IF EXISTS `evaluate_et`;
CREATE TABLE `evaluate_et` (
  `p_id` varchar(255) NOT NULL,
  `et_id` varchar(255) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `star_level` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`p_id`,`et_id`),
  KEY `evaluate_et_fk1` (`et_id`),
  CONSTRAINT `evaluate_et_fk` FOREIGN KEY (`p_id`) REFERENCES `user_parent` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `evaluate_et_fk1` FOREIGN KEY (`et_id`) REFERENCES `user_edu_tea` (`et_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `a_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  KEY `news_fk` (`a_id`),
  CONSTRAINT `news_fk` FOREIGN KEY (`a_id`) REFERENCES `user_admin` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for purchase
-- ----------------------------
DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `p_id` varchar(255) NOT NULL,
  `c_id` int(11) NOT NULL,
  `length` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`p_id`,`c_id`),
  KEY `apply_lis_fk2` (`c_id`),
  CONSTRAINT `apply_lis_fk1` FOREIGN KEY (`p_id`) REFERENCES `user_parent` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apply_lis_fk2` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for section
-- ----------------------------
DROP TABLE IF EXISTS `section`;
CREATE TABLE `section` (
  `c_id` int(11) DEFAULT NULL,
  `time_slot_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `homework` varchar(255) DEFAULT NULL,
  KEY `section_fk` (`c_id`),
  KEY `section_fk1` (`time_slot_id`),
  CONSTRAINT `section_fk` FOREIGN KEY (`c_id`) REFERENCES `course` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `section_fk1` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`time_slot_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `p_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `s_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `birth` date DEFAULT NULL,
  `sex` int(255) DEFAULT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `fee_from` float DEFAULT NULL,
  `fee_to` float DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`p_id`,`s_name`),
  CONSTRAINT `student_fk` FOREIGN KEY (`p_id`) REFERENCES `user_parent` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `et_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `years` int(11) DEFAULT NULL,
  PRIMARY KEY (`et_id`),
  CONSTRAINT `teacher_fk` FOREIGN KEY (`et_id`) REFERENCES `user_edu_tea` (`et_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for time_slot
-- ----------------------------
DROP TABLE IF EXISTS `time_slot`;
CREATE TABLE `time_slot` (
  `time_slot_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  PRIMARY KEY (`time_slot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_admin
-- ----------------------------
DROP TABLE IF EXISTS `user_admin`;
CREATE TABLE `user_admin` (
  `a_id` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_edu_tea
-- ----------------------------
DROP TABLE IF EXISTS `user_edu_tea`;
CREATE TABLE `user_edu_tea` (
  `et_id` varchar(255) NOT NULL,
  `identify` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `state` int(11) NOT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `age_from` int(11) DEFAULT NULL,
  `age_to` int(11) DEFAULT NULL,
  `area` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `evaluation` int(11) DEFAULT '0',
  PRIMARY KEY (`et_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_parent
-- ----------------------------
DROP TABLE IF EXISTS `user_parent`;
CREATE TABLE `user_parent` (
  `p_id` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `p_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for video
-- ----------------------------
DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `a_id` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  KEY `video_fk` (`a_id`),
  CONSTRAINT `video_fk` FOREIGN KEY (`a_id`) REFERENCES `user_admin` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
