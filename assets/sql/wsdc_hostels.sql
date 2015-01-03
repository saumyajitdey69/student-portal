-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 26, 2014 at 10:55 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wsdc_hostels_new`
--
CREATE DATABASE IF NOT EXISTS `wsdc_hostels_new` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `wsdc_hostels_new`;

-- --------------------------------------------------------

--
-- Table structure for table `admissiontypes`
--
-- Creation: Jul 13, 2014 at 07:45 PM
--

CREATE TABLE IF NOT EXISTS `admissiontypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `allowedhostels`
--
-- Creation: Jul 13, 2014 at 07:45 PM
--

CREATE TABLE IF NOT EXISTS `allowedhostels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostelid` int(11) NOT NULL,
  `studenttypeid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hostelid` (`hostelid`,`studenttypeid`),
  KEY `hosteltypeid` (`studenttypeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=951 ;

-- --------------------------------------------------------

--
-- Table structure for table `allowedmesses`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `allowedmesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messid` int(11) NOT NULL,
  `studenttypeid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mess and allowed messes` (`messid`),
  KEY `student type and allowed messes` (`studenttypeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1032 ;

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--
-- Creation: Jul 13, 2014 at 07:45 PM
--

CREATE TABLE IF NOT EXISTS `balances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(16) NOT NULL,
  `seatrent` int(11) DEFAULT '0',
  `maintenance` int(11) DEFAULT '0',
  `messdues` int(11) DEFAULT '0',
  `messadvance` int(11) DEFAULT '0',
  `others` int(11) DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--
-- Creation: Jul 13, 2014 at 07:45 PM
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `dasaiccr`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `dasaiccr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(16) DEFAULT NULL,
  `rollno` varchar(16) DEFAULT NULL,
  `admissiontypeid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=401 ;

-- --------------------------------------------------------

--
-- Table structure for table `dummystudents`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `dummystudents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(16) DEFAULT '0',
  `roll` varchar(11) NOT NULL,
  `current_year` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `admissiontypeid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41579 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `hostels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `numfloors` int(11) NOT NULL,
  `hostelfee` float NOT NULL,
  `maintenance` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messallotments`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `messallotments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(20) NOT NULL,
  `messid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=current, 0=removed',
  `allottedby` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `messid` (`messid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4384 ;

-- --------------------------------------------------------

--
-- Table structure for table `messdues`
--
-- Creation: Dec 12, 2014 at 11:44 PM
--

CREATE TABLE IF NOT EXISTS `messdues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) NOT NULL,
  `due` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `advance` int(11) NOT NULL COMMENT 'mess advance = 12000',
  `total` int(11) NOT NULL COMMENT 'student should pay this amount to get mess dues certificate',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique student` (`regno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5397 ;

-- --------------------------------------------------------

--
-- Table structure for table `messes`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `messes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` int(4) NOT NULL,
  `currentcount` int(4) NOT NULL DEFAULT '0',
  `messadvance` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `messtransactions`
--
-- Creation: Dec 15, 2014 at 08:01 AM
--

CREATE TABLE IF NOT EXISTS `messtransactions` (
  `bank_reference_no` varchar(64) NOT NULL,
  `transaction_date` varchar(16) NOT NULL,
  `amount` int(11) DEFAULT '0' COMMENT 'total amount paid',
  `status` varchar(64) NOT NULL,
  `name` varchar(256) NOT NULL,
  `father_name` varchar(256) DEFAULT NULL,
  `date_of_birth` varchar(32) NOT NULL,
  `registration_number` varchar(16) NOT NULL,
  `roll_number` varchar(16) NOT NULL,
  `degree` varchar(16) NOT NULL,
  `year_of_study` varchar(16) NOT NULL,
  `type` varchar(16) NOT NULL COMMENT 'DASA,Normal, ICCR',
  `contact` varchar(16) NOT NULL,
  `hostel_allotted` varchar(16) NOT NULL,
  `mobile` varchar(16) NOT NULL DEFAULT '0',
  `mess_dues` int(11) DEFAULT '0',
  `mess_advance` int(11) DEFAULT '0',
  `seatrent` int(11) DEFAULT '0',
  `emc` int(11) DEFAULT '0',
  `maintenance_charges` int(11) DEFAULT '0',
  `total_amount_paid` int(11) DEFAULT '0' COMMENT 'mess dues + other',
  `transaction_type` varchar(32) NOT NULL DEFAULT 'i-collect' COMMENT '0-icollect, 1-neft, 2-dd, 3-scholarship',
  `payment_mode` varchar(32) DEFAULT '0',
  `Category_Name` varchar(32) DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipaddress` varchar(512) NOT NULL,
  `uploaded_by` varchar(128) NOT NULL,
  UNIQUE KEY `bank_reference_no` (`bank_reference_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rawpayments`
--
-- Creation: Dec 12, 2014 at 11:42 PM
--

CREATE TABLE IF NOT EXISTS `rawpayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(10) NOT NULL,
  `transaction_id` varchar(32) NOT NULL,
  `transaction_date` varchar(32) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1 = chief warden, 0 = fee account',
  `category` int(11) NOT NULL COMMENT '1 = NEFT, 2 = DD',
  `total` varchar(16) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = send to hostel office, 1 = transaction updated/ not confirmed, 2 = rejected, 3 = payment confirmed ',
  `created_on` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipaddress` varchar(512) NOT NULL,
  `maintenance` float NOT NULL DEFAULT '0',
  `mess_advance` float NOT NULL DEFAULT '0',
  `EWC` float NOT NULL DEFAULT '0',
  `seat_rent` float NOT NULL DEFAULT '0',
  `fee_account` float NOT NULL DEFAULT '0',
  `other` float NOT NULL DEFAULT '0',
  `mess_dues` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=724 ;

-- --------------------------------------------------------

--
-- Table structure for table `roomallotments`
--
-- Creation: Oct 30, 2014 at 01:13 PM
--

CREATE TABLE IF NOT EXISTS `roomallotments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roomid` int(11) NOT NULL,
  `regno` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=current, 0=removed',
  `allottedby` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `roomid` (`roomid`,`regno`),
  KEY `regno` (`regno`),
  KEY `roomid_2` (`roomid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4312 ;

-- --------------------------------------------------------

--
-- Table structure for table `roomcondition`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `roomcondition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(64) COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `floor` int(2) NOT NULL DEFAULT '1',
  `hostelid` int(11) NOT NULL DEFAULT '38',
  `capacity` int(11) NOT NULL DEFAULT '1',
  `conditionid` int(11) NOT NULL DEFAULT '1',
  `description` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alloted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hostelid` (`hostelid`),
  KEY `status` (`conditionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5438 ;

-- --------------------------------------------------------

--
-- Table structure for table `studentpayments`
--
-- Creation: Dec 12, 2014 at 11:40 PM
--

CREATE TABLE IF NOT EXISTS `studentpayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regno` varchar(16) NOT NULL,
  `seatrent` int(11) DEFAULT '0',
  `maintenance_charges` int(11) DEFAULT '0',
  `mess_dues` int(11) DEFAULT '0',
  `mess_advance` int(11) DEFAULT '0',
  `emc` int(11) DEFAULT '0',
  `total_amount_paid` int(11) DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipaddress` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regno` (`regno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105591 ;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--
-- Creation: Oct 30, 2014 at 01:12 PM
--

CREATE TABLE IF NOT EXISTS `students` (
  `regno` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hosteltypeid` int(11) DEFAULT NULL COMMENT 'this is studententtypeid',
  `roomid` int(11) DEFAULT NULL,
  `messid` int(11) DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipaddress` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`regno`),
  KEY `hosteltype` (`hosteltypeid`,`roomid`,`messid`),
  KEY `messid` (`messid`),
  KEY `roomid` (`roomid`),
  KEY `hosteltype_2` (`hosteltypeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studenttypes`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `studenttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` int(11) NOT NULL,
  `year` int(2) NOT NULL,
  `gender` int(1) NOT NULL,
  `admissiontypeid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipaddress` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique entries only` (`class`,`year`,`gender`,`admissiontypeid`),
  KEY `admissiontypeid` (`admissiontypeid`),
  KEY `admissiontypeid_2` (`admissiontypeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=109 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp`
--
-- Creation: Nov 10, 2014 at 12:38 PM
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `roll_number` varchar(32) NOT NULL,
  `room_number` varchar(16) NOT NULL,
  `floor` int(4) NOT NULL,
  `hostel` varchar(256) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3016 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_reference_no` varchar(128) NOT NULL,
  `transaction_date` varchar(32) NOT NULL,
  `amount` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `registration_number` varchar(11) NOT NULL,
  `roll_number` varchar(11) NOT NULL,
  `degree` varchar(64) NOT NULL,
  `branch` varchar(32) NOT NULL,
  `type` varchar(64) NOT NULL COMMENT 'Dayscholar/ Hosteller',
  `hostel_allotted` varchar(128) NOT NULL,
  `contact` varchar(16) NOT NULL,
  `tuitionfee` int(11) DEFAULT NULL,
  `otherfee` int(11) DEFAULT NULL,
  `emc` int(11) DEFAULT NULL,
  `seatrent` int(11) DEFAULT NULL,
  `transaction_type` varchar(32) NOT NULL DEFAULT 'i-collect' COMMENT '0-icollect, 1-neft, 2-dd, 3-sholarship',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ipaddress` varchar(512) NOT NULL,
  `uploaded_by` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bank_reference` (`bank_reference_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--
-- Creation: Jul 13, 2014 at 07:46 PM
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allowedmesses`
--
ALTER TABLE `allowedmesses`
  ADD CONSTRAINT `mess and allowed messes` FOREIGN KEY (`messid`) REFERENCES `messes` (`id`),
  ADD CONSTRAINT `student type and allowed messes` FOREIGN KEY (`studenttypeid`) REFERENCES `studenttypes` (`id`);

--
-- Constraints for table `messallotments`
--
ALTER TABLE `messallotments`
  ADD CONSTRAINT `messallotments_ibfk_1` FOREIGN KEY (`messid`) REFERENCES `messes` (`id`);

--
-- Constraints for table `roomallotments`
--
ALTER TABLE `roomallotments`
  ADD CONSTRAINT `allotments_ibfk_1` FOREIGN KEY (`roomid`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`roomid`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`messid`) REFERENCES `messes` (`id`),
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`hosteltypeid`) REFERENCES `studenttypes` (`id`);

--
-- Constraints for table `studenttypes`
--
ALTER TABLE `studenttypes`
  ADD CONSTRAINT `studenttypes_ibfk_1` FOREIGN KEY (`admissiontypeid`) REFERENCES `admissiontypes` (`id`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
