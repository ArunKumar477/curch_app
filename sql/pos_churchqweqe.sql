-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2017 at 12:29 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pos_church`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `expense_date` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `cat_id`, `amount`, `expense_date`, `created_by`, `created_at`, `updated_by`, `updated_at`, `active`) VALUES
(5, 2, 200, 1512896003, 1, 1512307830, 1, 1512971784, 0),
(6, 5, 329, 1512896003, 1, 1512309616, 1, 1512971308, 0),
(7, 3, 500, 1512896003, 1, 1512895959, NULL, NULL, 1),
(8, 4, 100, 1512671400, 1, 1512902124, NULL, NULL, 1),
(9, 5, 500, 1512153000, 1, 1512970631, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses_category`
--

CREATE TABLE IF NOT EXISTS `expenses_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `created_by` int(10) NOT NULL,
  `created_at` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `expenses_category`
--

INSERT INTO `expenses_category` (`id`, `name`, `active`, `created_by`, `created_at`) VALUES
(2, 'General', 1, 1, 1511626396),
(3, 'Travel Expenses', 1, 1, 1511626396),
(4, 'Beverages Charges', 1, 1, 1),
(5, 'Administrative Charges', 1, 1, 1512293086),
(6, 'Wages to Sexton', 1, 1, 1512313048);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `age` int(5) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `dob` int(11) DEFAULT NULL,
  `doa` int(11) DEFAULT NULL,
  `is_child_sch` int(2) DEFAULT NULL,
  `no_of_child_sch` int(2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `member_type` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `age`, `gender`, `email`, `mobile`, `address`, `dob`, `doa`, `is_child_sch`, `no_of_child_sch`, `created_by`, `created_at`, `updated_by`, `updated_at`, `active`, `member_type`) VALUES
(1, 'Dinesh Kumar', 27, 'M', 'dinesh_din09@yahoo.co.in', 9597207343, 'Alwarthiru Nagar', 636921000, 0, 0, 0, 1, 1512542876, 1, 1512824899, 1, 1),
(2, 'Kumar', 27, 'M', 'kumar@gmail.com', 9962090355, 'Test', 642249008, 1357727408, 1, 1, 1, 1512543040, 1, 1512825240, 0, 1),
(3, 'Sanjana', 25, 'F', 'sanju73@gmail.com', 8765432101, 'Tnagar', 702239400, 0, 1, 1, 1, 1512825388, NULL, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `offerings`
--

CREATE TABLE IF NOT EXISTS `offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(5) NOT NULL,
  `mtype` int(1) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `amount` int(11) NOT NULL,
  `mof` varchar(10) NOT NULL,
  `cheque_no` varchar(10) DEFAULT NULL,
  `cms_share` float(8,2) NOT NULL,
  `chruch_share` float(8,2) NOT NULL,
  `cat_id` int(5) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(5) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(5) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `offerings`
--

INSERT INTO `offerings` (`id`, `receipt_no`, `name`, `email`, `age`, `mtype`, `gender`, `mobile`, `address`, `amount`, `mof`, `cheque_no`, `cms_share`, `chruch_share`, `cat_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active`) VALUES
(1, 'RN1', 'Dinesh', 'dinesh@gmail.com', 25, 2, 'M', 8765432345, 'Porur', 5000, 'cheque', '101201', 5000.00, 0.00, 1, 1512807184, 1, 1512810829, 1, 1),
(2, 'RN1', 'Dinesh', 'dinesh@gmail.com', 25, 2, 'M', 8765432345, 'Porur', 1500, 'cash', '', 750.00, 750.00, 2, 1512807184, 1, 1512810877, 1, 1),
(3, 'RN2', 'Sanjana', 'sanjana@gmail.com', 26, 2, 'M', 9597207343, 'Tnagar', 1000, 'cash', '', 500.00, 500.00, 2, 1512815091, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `offerings_category`
--

CREATE TABLE IF NOT EXISTS `offerings_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `cms_share` varchar(5) NOT NULL,
  `church_share` varchar(5) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `offerings_category`
--

INSERT INTO `offerings_category` (`id`, `category`, `cms_share`, `church_share`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'tithes', '100%', '0%', 1, 1512570248, 1, NULL, NULL),
(2, 'Thanks Offerings', '50%', '50%', 1, 1512572508, 1, NULL, NULL),
(3, 'Birthday Offering', '50%', '50%', 1, 1512837450, 1, NULL, NULL),
(4, 'Dorcas Offering', '0%', '100%', 1, 1512837486, 1, NULL, NULL),
(5, 'Poor Fund Offering', '0%', '100%', 1, 1512837508, 1, NULL, NULL),
(6, 'Church Expenses Offering', '0%', '100%', 1, 1512837608, 1, NULL, NULL),
(7, 'Divine Service Offering', '50%', '50%', 1, 1512837633, 1, NULL, NULL),
(8, 'Sabbath School Offering', '50%', '50%', 1, 1512837657, 1, NULL, NULL),
(9, 'Investment Offering', '100%', '0%', 1, 1512837682, 1, NULL, NULL),
(10, 'Building Project', '0%', '100%', 1, 1512837742, 1, NULL, NULL),
(11, 'Sabbath School Lesson Cost Payment', '100%', '0%', 1, 1512837769, 1, NULL, NULL),
(12, 'Wedding Offering', '50%', '50%', 1, 1512837797, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `type`, `active`, `created_at`, `created_by`) VALUES
(1, 'SuperAdmin', 1, 1511626396, 1),
(2, 'Admin', 1, 1511626396, 1),
(3, 'User', 1, 1511626396, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` int(5) unsigned NOT NULL,
  `mac` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_type_foregin` (`user_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `password`, `user_type`, `mac`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Dinesh', 9597207343, '8f5aa53923b35b5a794d0f4c4d409c23', 1, 'F0-03-8C-5B-38-D7', 1, 1511626396, 1, 1512543653, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `expenses_category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
