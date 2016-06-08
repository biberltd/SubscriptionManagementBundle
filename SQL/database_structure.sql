/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50712
 Source Host           : localhost
 Source Database       : database_structure

 Target Server Type    : MySQL
 Target Server Version : 50712
 File Encoding         : utf-8

 Date: 06/08/2016 09:44:08 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `files_of_member`
-- ----------------------------
DROP TABLE IF EXISTS `files_of_member`;
CREATE TABLE `files_of_member` (
  `file` int(10) unsigned NOT NULL COMMENT 'File of member.',
  `member` int(10) unsigned NOT NULL COMMENT 'Member who owns the file',
  `count_view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'View count of file within member profile',
  PRIMARY KEY (`file`,`member`),
  UNIQUE KEY `idxUFilesOfMember` (`file`,`member`) USING BTREE,
  KEY `idx_f_files_of_member_file` (`file`) USING BTREE,
  KEY `idxFMemberOfFiles` (`member`) USING BTREE,
  CONSTRAINT `idxFFileOfMember` FOREIGN KEY (`file`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idxFMemberOfFiles` FOREIGN KEY (`member`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `member`
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'System given id.',
  `name_first` varchar(155) COLLATE utf8_turkish_ci DEFAULT NULL COMMENT 'First name of member.',
  `name_last` varchar(155) COLLATE utf8_turkish_ci DEFAULT NULL COMMENT 'Last Name of member',
  `email` varchar(255) COLLATE utf8_turkish_ci NOT NULL COMMENT 'Valid e-mail of user.',
  `username` varchar(155) COLLATE utf8_turkish_ci NOT NULL,
  `password` text COLLATE utf8_turkish_ci NOT NULL COMMENT 'Password of user.',
  `date_birth` datetime DEFAULT NULL COMMENT 'Date of birth of the user.',
  `file_avatar` text COLLATE utf8_turkish_ci COMMENT 'Avatar image of user.',
  `date_registration` datetime NOT NULL COMMENT 'Date of registration.',
  `date_activation` datetime DEFAULT NULL COMMENT 'Date of activation.',
  `date_status_changed` datetime DEFAULT NULL COMMENT 'Date when the user status last changed.',
  `status` varchar(1) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'i' COMMENT 'a:active,i:inactive,b:banned,n:never activated',
  `key_activation` text COLLATE utf8_turkish_ci COMMENT 'Activation key.',
  `language` int(10) unsigned DEFAULT NULL COMMENT 'Member selected language.',
  `site` int(10) unsigned DEFAULT NULL COMMENT 'Primary site that user has registered with.',
  `extra_info` text COLLATE utf8_turkish_ci COMMENT 'Holds extra information ',
  `date_last_login` datetime DEFAULT NULL,
  `gender` char(1) COLLATE utf8_turkish_ci DEFAULT 'f' COMMENT 'f:female, m:male',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxUMemberId` (`id`) USING BTREE,
  UNIQUE KEY `idxUMemberUsername` (`username`,`site`) USING BTREE,
  UNIQUE KEY `idxUMemberEmail` (`email`,`site`) USING BTREE,
  KEY `idxNFullNameOfMember` (`name_last`,`name_first`) USING BTREE,
  KEY `idxNMemberDateBirth` (`date_birth`) USING BTREE,
  KEY `idxNMemberDateRegitration` (`date_registration`) USING BTREE,
  KEY `idxNMemberDateActivation` (`date_activation`) USING BTREE,
  KEY `idxNMemberDateStatusChanged` (`date_status_changed`) USING BTREE,
  KEY `idxFDefaultLanguageOfMember` (`language`) USING BTREE,
  KEY `idxFDefaultSiteOfMember` (`site`) USING BTREE,
  CONSTRAINT `idxFDefaultLanguageOfMember` FOREIGN KEY (`language`) REFERENCES `language` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `idxFDefaultSiteOfMember` FOREIGN KEY (`site`) REFERENCES `site` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `member_group`
-- ----------------------------
DROP TABLE IF EXISTS `member_group`;
CREATE TABLE `member_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'System given id.',
  `code` varchar(45) COLLATE utf8_turkish_ci NOT NULL COMMENT 'Member group code. This is not editable.',
  `date_added` datetime NOT NULL COMMENT 'Date when the group is created.',
  `date_updated` datetime NOT NULL COMMENT 'Date when the group is created.',
  `date_removed` datetime DEFAULT NULL COMMENT 'Date when the group definition is last updated.',
  `type` varchar(1) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'r' COMMENT 'r:regular,a:admin,s:support',
  `count_members` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Number of members associated with this group.',
  `site` int(10) unsigned DEFAULT NULL COMMENT 'Site that member group is defined for.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxUMemberGroupId` (`id`) USING BTREE,
  UNIQUE KEY `idxUMemberGroupCode` (`code`,`site`) USING BTREE,
  KEY `idxNMemberGroupDateAdded` (`date_added`) USING BTREE,
  KEY `idxNMemberGroupDateUpdated` (`date_updated`) USING BTREE,
  KEY `idxNMemberGroupDateRemoved` (`date_removed`),
  KEY `idxFSiteOfMemberGroup` (`site`) USING BTREE,
  CONSTRAINT `idxFSiteOfMemberGroup` FOREIGN KEY (`site`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `member_group_localization`
-- ----------------------------
DROP TABLE IF EXISTS `member_group_localization`;
CREATE TABLE `member_group_localization` (
  `language` int(5) unsigned NOT NULL COMMENT 'Language of localization.',
  `member_group` int(10) unsigned NOT NULL COMMENT 'Localized member group.',
  `name` varchar(45) COLLATE utf8_turkish_ci NOT NULL COMMENT 'Localized name of member group.',
  `url_key` varchar(55) COLLATE utf8_turkish_ci NOT NULL COMMENT 'Localized url key of member group.',
  `description` text COLLATE utf8_turkish_ci COMMENT 'Localized description of member group.',
  PRIMARY KEY (`language`,`member_group`),
  UNIQUE KEY `idxUMemberGroupLocalization` (`member_group`,`language`) USING BTREE,
  UNIQUE KEY `idxUMemberGroupLocalizationUrlKey` (`language`,`url_key`) USING BTREE,
  KEY `idxFMemberGroupLocalizationLanguage` (`language`) USING BTREE,
  CONSTRAINT `idxFLocalizedMemberGroup` FOREIGN KEY (`member_group`) REFERENCES `member_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idx_f_member_group_localization_language` FOREIGN KEY (`language`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `member_localization`
-- ----------------------------
DROP TABLE IF EXISTS `member_localization`;
CREATE TABLE `member_localization` (
  `member` int(10) unsigned NOT NULL COMMENT 'Member of localization',
  `language` int(5) unsigned NOT NULL COMMENT 'Language of localization.',
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL COMMENT 'Localized title of member.',
  `biography` text COLLATE utf8_turkish_ci COMMENT 'Localized biography of member.',
  `extra_data` text COLLATE utf8_turkish_ci COMMENT 'Localized extra data - serializaed array - of member.',
  PRIMARY KEY (`member`,`language`),
  UNIQUE KEY `idxUMemberLocalization` (`member`,`language`) USING BTREE,
  KEY `idxFLocalizedMember` (`member`) USING BTREE,
  KEY `idxFMemberLocalizationLanguage` (`language`) USING BTREE,
  CONSTRAINT `idxFLocalizedMember` FOREIGN KEY (`member`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idxFMemberLocalizationLanguage` FOREIGN KEY (`language`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `members_of_group`
-- ----------------------------
DROP TABLE IF EXISTS `members_of_group`;
CREATE TABLE `members_of_group` (
  `member` int(10) unsigned NOT NULL COMMENT 'Member of group.',
  `group` int(10) unsigned NOT NULL COMMENT 'Group of member.',
  `date_added` datetime NOT NULL,
  `date_updated` datetime NOT NULL COMMENT 'Date when the entry is last updated.',
  `date_removed` datetime DEFAULT NULL COMMENT 'Date when the entry is amrked as removed.',
  UNIQUE KEY `idxUMembersOfGroup` (`member`,`group`) USING BTREE,
  KEY `idxNMembersOfGroupDateAdded` (`date_added`) USING BTREE,
  KEY `idxNMembersOfGroupDateRemoved` (`date_removed`),
  KEY `idxNMembersOfGroupDateUpdated` (`date_updated`),
  KEY `idxFMemberOfGroup` (`member`) USING BTREE,
  KEY `idxFGroupOfMember` (`group`) USING BTREE,
  CONSTRAINT `idxFGroupOfMember` FOREIGN KEY (`group`) REFERENCES `member_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idxFMemnerOfGroup` FOREIGN KEY (`member`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `members_of_site`
-- ----------------------------
DROP TABLE IF EXISTS `members_of_site`;
CREATE TABLE `members_of_site` (
  `member` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Associated member.',
  `site` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Associated site.',
  `date_added` datetime NOT NULL COMMENT 'Date when the member is added to site.',
  `date_updated` datetime NOT NULL COMMENT 'Date when the entry is last updated.',
  `date_removed` datetime DEFAULT NULL COMMENT 'Date when the entry is marked as removed from database.',
  PRIMARY KEY (`member`,`site`),
  UNIQUE KEY `idxUMembersOfSite` (`member`,`site`) USING BTREE,
  KEY `idxNMembersOfSiteDateAdded` (`date_added`) USING BTREE,
  KEY `idxNMembersOfSiteDateRemoved` (`date_removed`),
  KEY `idxNMembersOfSiteDateUpdated` (`date_updated`),
  KEY `idxFSiteOfMember` (`site`) USING BTREE,
  CONSTRAINT `idxFMemberOfSite` FOREIGN KEY (`member`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idxFSiteOfMember` FOREIGN KEY (`site`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `subscription`
-- ----------------------------
DROP TABLE IF EXISTS `subscription`;
CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `date_removed` datetime DEFAULT NULL,
  `current_status` varchar(255) DEFAULT NULL,
  `current_amount` decimal(10,0) DEFAULT NULL,
  `cycle` varchar(255) DEFAULT NULL,
  `cycle_start_date` datetime DEFAULT NULL,
  `cycle_update_date` datetime DEFAULT NULL,
  `cycle_next_start_date` datetime DEFAULT NULL,
  `member_id` int(10) unsigned DEFAULT NULL,
  `subscription_package_id` int(11) unsigned NOT NULL,
  `instructions` varchar(255) DEFAULT NULL,
  `subscription_date` datetime DEFAULT NULL,
  `tracked_member` int(11) DEFAULT NULL,
  `tracking_confirmation_date` datetime DEFAULT NULL,
  `cancellation_date` datetime DEFAULT NULL,
  `cancelling_side` varchar(255) DEFAULT NULL,
  `cancellation_reason` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `auto_renew` int(11) DEFAULT NULL,
  `daily_reminder` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member` (`member_id`),
  KEY `subscription_package_id` (`subscription_package_id`),
  CONSTRAINT `member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `subscription_package_id` FOREIGN KEY (`subscription_package_id`) REFERENCES `subscription_package` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `subscription_package`
-- ----------------------------
DROP TABLE IF EXISTS `subscription_package`;
CREATE TABLE `subscription_package` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `subscriber_count` int(11) unsigned DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `date_removed` datetime DEFAULT NULL,
  `current_price` decimal(10,0) DEFAULT NULL,
  `price_update_date` datetime DEFAULT NULL,
  `last_price` decimal(10,0) DEFAULT NULL,
  `query_credit` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
