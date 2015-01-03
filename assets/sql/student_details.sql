-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2014 at 01:12 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wsdc_hostels_new`
--

-- --------------------------------------------------------

--
-- Structure for view `student_details`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_details` AS select `s`.`regno` AS `registration_number`,`c`.`name` AS `class`,`at`.`name` AS `admissiontype`,`st`.`year` AS `year`,if((`st`.`gender` = '1'),'Male','Female') AS `gender`,`r`.`number` AS `room`,`r`.`floor` AS `floor`,`h`.`name` AS `hostel`,`m`.`name` AS `mess`,`s`.`timestamp` AS `timestamp`,`s`.`hosteltypeid` AS `hostelid`,`s`.`messid` AS `messid`,`s`.`roomid` AS `roomid`,`s`.`hosteltypeid` AS `studenttypeid`,`s`.`blocked` AS `blocked` from ((((((`students` `s` left join `studenttypes` `st` on((`s`.`hosteltypeid` = `st`.`id`))) left join `admissiontypes` `at` on((`st`.`admissiontypeid` = `at`.`id`))) left join `rooms` `r` on((`s`.`roomid` = `r`.`id`))) left join `classes` `c` on((`st`.`class` = `c`.`id`))) left join `hostels` `h` on((`r`.`hostelid` = `h`.`id`))) left join `messes` `m` on((`s`.`messid` = `m`.`id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
