/*
 Navicat Premium Data Transfer

 Source Server         : dbw
 Source Server Type    : MySQL
 Source Server Version : 50544
 Source Host           : 195.154.71.198
 Source Database       : dbw

 Target Server Type    : MySQL
 Target Server Version : 50544
 File Encoding         : utf-8

 Date: 12/07/2015 20:19:00 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `Administrator`
-- ----------------------------
DROP TABLE IF EXISTS `Administrator`;
CREATE TABLE `Administrator` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_admin` FOREIGN KEY (`id`) REFERENCES `IndividualUser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `Authority`
-- ----------------------------
DROP TABLE IF EXISTS `Authority`;
CREATE TABLE `Authority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeName` int(11) NOT NULL,
  `authority` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `typeName_idx` (`typeName`),
  KEY `authority_idx` (`authority`),
  CONSTRAINT `authority` FOREIGN KEY (`authority`) REFERENCES `Privilege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `typeName` FOREIGN KEY (`typeName`) REFERENCES `UserType` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `CorporateUser`
-- ----------------------------
DROP TABLE IF EXISTS `CorporateUser`;
CREATE TABLE `CorporateUser` (
  `id` int(11) NOT NULL,
  `verified` int(11) NOT NULL,
  `corpName` varchar(255) NOT NULL,
  `registeredTime` date NOT NULL,
  `applicationTime` date NOT NULL,
  `verificationTime` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `IndividualUser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `Email`
-- ----------------------------
DROP TABLE IF EXISTS `Email`;
CREATE TABLE `Email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `sendTime` date NOT NULL,
  `sentBy` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sentBy_idx` (`sentBy`),
  CONSTRAINT `sentBy` FOREIGN KEY (`sentBy`) REFERENCES `IndividualUser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `HouseInformation`
-- ----------------------------
DROP TABLE IF EXISTS `HouseInformation`;
CREATE TABLE `HouseInformation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `largeImage` varchar(200) DEFAULT NULL,
  `listImage` varchar(200) DEFAULT NULL,
  `typeName` int(11) DEFAULT NULL,
  `buildYear` date NOT NULL,
  `location` varchar(200) NOT NULL,
  `brNumber` int(11) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(1000) NOT NULL,
  `verified` int(11) NOT NULL,
  `postTime` date NOT NULL,
  `deleteStatus` int(11) NOT NULL,
  `topPost` int(11) NOT NULL,
  `viewTimes` int(11) NOT NULL DEFAULT '0',
  `averageRating` double DEFAULT NULL,
  `updateTime` date DEFAULT NULL,
  `postedBy` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `houseType_idx` (`typeName`),
  KEY `postedBy_houseInfo_idx` (`postedBy`),
  CONSTRAINT `houseType` FOREIGN KEY (`typeName`) REFERENCES `HouseType` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `postedBy_HI` FOREIGN KEY (`postedBy`) REFERENCES `IndividualUser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `HouseRating`
-- ----------------------------
DROP TABLE IF EXISTS `HouseRating`;
CREATE TABLE `HouseRating` (
  `relatedTo` int(11) NOT NULL,
  `postedBy` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`relatedTo`,`postedBy`),
  KEY `houseRating_idx` (`rating`),
  KEY `postedBy_house_idx` (`postedBy`),
  CONSTRAINT `houseRating` FOREIGN KEY (`rating`) REFERENCES `Rating` (`rating`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `relatedTo_house` FOREIGN KEY (`relatedTo`) REFERENCES `HouseInformation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `postedBy_house` FOREIGN KEY (`postedBy`) REFERENCES `IndividualUser` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `HouseType`
-- ----------------------------
DROP TABLE IF EXISTS `HouseType`;
CREATE TABLE `HouseType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `houseType` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `houseType_UNIQUE` (`houseType`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `IndividualUser`
-- ----------------------------
DROP TABLE IF EXISTS `IndividualUser`;
CREATE TABLE `IndividualUser` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `averageRating` double DEFAULT NULL,
  `viewPreference` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `user` FOREIGN KEY (`id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `Privilege`
-- ----------------------------
DROP TABLE IF EXISTS `Privilege`;
CREATE TABLE `Privilege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `privilege_UNIQUE` (`privilege`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `Rating`
-- ----------------------------
DROP TABLE IF EXISTS `Rating`;
CREATE TABLE `Rating` (
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`rating`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ReadStatus`
-- ----------------------------
DROP TABLE IF EXISTS `ReadStatus`;
CREATE TABLE `ReadStatus` (
  `receive` int(11) NOT NULL,
  `receivedBy` int(11) NOT NULL,
  `readStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`receive`,`receivedBy`),
  KEY `receivedBy_idx` (`receivedBy`),
  CONSTRAINT `receivedBy` FOREIGN KEY (`receivedBy`) REFERENCES `IndividualUser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `receive` FOREIGN KEY (`receive`) REFERENCES `Email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `Review`
-- ----------------------------
DROP TABLE IF EXISTS `Review`;
CREATE TABLE `Review` (
  `postedBy` int(11) NOT NULL,
  `belongsTo` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`postedBy`,`belongsTo`),
  KEY `belongsTo_Review_idx` (`belongsTo`),
  CONSTRAINT `belongsTo_Review` FOREIGN KEY (`belongsTo`) REFERENCES `HouseInformation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `postedBy_Review` FOREIGN KEY (`postedBy`) REFERENCES `IndividualUser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `Tag`
-- ----------------------------
DROP TABLE IF EXISTS `Tag`;
CREATE TABLE `Tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `TagStatistics`
-- ----------------------------
DROP TABLE IF EXISTS `TagStatistics`;
CREATE TABLE `TagStatistics` (
  `usedBy` int(11) NOT NULL,
  `tagId` int(11) NOT NULL,
  `counts` int(11) DEFAULT NULL,
  PRIMARY KEY (`usedBy`,`tagId`),
  KEY `tagId_idx` (`tagId`),
  CONSTRAINT `tag` FOREIGN KEY (`tagId`) REFERENCES `Tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usedBy` FOREIGN KEY (`usedBy`) REFERENCES `HouseInformation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `User`
-- ----------------------------
DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userType` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userType_idx` (`userType`),
  CONSTRAINT `userType` FOREIGN KEY (`userType`) REFERENCES `UserType` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `UserRating`
-- ----------------------------
DROP TABLE IF EXISTS `UserRating`;
CREATE TABLE `UserRating` (
  `relatedTo` int(11) NOT NULL,
  `postedBy` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`relatedTo`,`postedBy`),
  KEY `rating_idx` (`rating`),
  KEY `postedBy_idx` (`postedBy`),
  CONSTRAINT `postedBy` FOREIGN KEY (`postedBy`) REFERENCES `IndividualUser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `relatedTo` FOREIGN KEY (`relatedTo`) REFERENCES `IndividualUser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rating` FOREIGN KEY (`rating`) REFERENCES `Rating` (`rating`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `UserType`
-- ----------------------------
DROP TABLE IF EXISTS `UserType`;
CREATE TABLE `UserType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userType` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userType_UNIQUE` (`userType`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
