-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2017 at 08:06 AM
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
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `closing_balance` decimal(10,2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `cid`, `month`, `year`, `closing_balance`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(19, 2, 12, 2017, '-1300.00', 2, 1513773001, NULL, NULL),
(21, 2, 12, 2018, '0.00', 2, 1513773266, NULL, NULL),
(22, 2, 12, 0, '0.00', 2, 1513829212, NULL, NULL),
(23, 2, 12, 2019, '0.00', 2, 1513829330, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  `alternate_no` bigint(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `subscription` int(5) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `expires_at` int(11) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `logo`, `address`, `phone`, `alternate_no`, `email`, `subscription`, `created_at`, `created_by`, `updated_by`, `updated_at`, `expires_at`, `active`) VALUES
(1, 'SiteStorms', 'images/uploads/site-storms-logo.png', '18,Avvai Street', 9597207343, 0, 'sitestorms@gmail.com', 8, 1513751330, 1, 1, 1513753013, 1829112951, 1),
(2, 'SDAEC', 'images/uploads/100x80.png', 'Vepery,chennai-600007', 9962090355, 0, 'dineshkp220@gmail.com', 4, 1513752259, 1, 1, 1513753039, 1545289039, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `cid`, `cat_id`, `amount`, `expense_date`, `created_by`, `created_at`, `updated_by`, `updated_at`, `active`) VALUES
(5, 2, 2, 200, 1512896003, 1, 1512307830, 1, 1512971784, 0),
(6, 2, 5, 329, 1512896003, 1, 1512309616, 1, 1512971308, 0),
(7, 2, 3, 500, 1512896003, 1, 1512895959, NULL, NULL, 1),
(8, 2, 4, 100, 1512671400, 1, 1512902124, NULL, NULL, 1),
(9, 2, 5, 500, 1512153000, 1, 1512970631, NULL, NULL, 1),
(10, 1, 5, 500, 1512153000, 1, 1512970631, NULL, NULL, 1),
(11, 2, 2, 200, 1513621800, 2, 1513762839, NULL, NULL, 1);

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
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `expenses_category`
--

INSERT INTO `expenses_category` (`id`, `name`, `active`, `created_by`, `created_at`, `cid`) VALUES
(2, 'General', 1, 1, 1511626396, 2),
(3, 'Travel Expenses', 1, 1, 1511626396, 2),
(4, 'Beverages Charges', 1, 1, 1, 2),
(5, 'Administrative Charges', 1, 1, 1512293086, 2),
(6, 'Wages to Sexton', 1, 1, 1512313048, 2);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
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

INSERT INTO `members` (`id`, `cid`, `name`, `age`, `gender`, `email`, `mobile`, `address`, `dob`, `doa`, `is_child_sch`, `no_of_child_sch`, `created_by`, `created_at`, `updated_by`, `updated_at`, `active`, `member_type`) VALUES
(1, 2, 'Dinesh Kumar', 27, 'M', 'dinesh_din09@yahoo.co.in', 9597207343, 'Alwarthiru Nagar', 636921000, 636921000, 0, 0, 1, 1512542876, 2, 1513763055, 1, 1),
(2, 2, 'Kumar', 27, 'M', 'kumar@gmail.com', 9962090355, 'Test', 642249008, 1357727408, 1, 1, 1, 1512543040, 1, 1512825240, 1, 1),
(3, 2, 'Sanjana', 25, 'F', 'sanju73@gmail.com', 8765432101, 'Tnagar', 702239400, 0, 1, 1, 1, 1512825388, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `offerings`
--

CREATE TABLE IF NOT EXISTS `offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` varchar(10) NOT NULL,
  `offer_date` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(5) DEFAULT NULL,
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
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `offerings`
--

INSERT INTO `offerings` (`id`, `receipt_no`, `offer_date`, `name`, `email`, `age`, `mtype`, `gender`, `mobile`, `address`, `amount`, `mof`, `cheque_no`, `cms_share`, `chruch_share`, `cat_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active`, `cid`) VALUES
(1, 'RN1', 1512807184, 'Dinesh', 'dinesh@gmail.com', 25, 2, 'M', 8765432345, 'Porur', 5000, 'cheque', '101201', 5000.00, 0.00, 1, 1512807184, 1, 1512810829, 1, 1, 2),
(2, 'RN1', 1512807184, 'Dinesh', 'dinesh@gmail.com', 25, 2, 'M', 8765432345, 'Porur', 1500, 'cash', '', 750.00, 750.00, 2, 1512807184, 1, 1512810877, 1, 1, 2),
(3, 'RN2', 1512815091, 'Sanjana', 'sanjana@gmail.com', 26, 2, 'M', 9597207343, 'Tnagar', 1000, 'cash', '', 500.00, 500.00, 2, 1512815091, 1, 0, 0, 1, 2),
(4, 'RN3', 1513103400, 'Sanjana', 'sanju@gmail.com', 0, 1, 'F', 8765432345, 'Tnagar', 3000, 'cash', '0', 1500.00, 1500.00, 7, 1513405197, 1, 0, 0, 1, 2),
(5, 'RN4', 1513708200, 'test', 'test@test.com', 28, 2, 'M', 9876543211, 'Test', 3000, 'card', '0', 1500.00, 1500.00, 3, 1513759276, 2, 1513760115, 2, 1, 2),
(8, 'RN5', 1483900200, 'test', 'test@gmail.com', 34, 1, 'M', 8765432129, 'Test', 3000, 'card', '0', 1500.00, 1500.00, 12, 1513760270, 2, 0, 0, 1, 1),
(9, 'RN5', 1483900200, 'test', 'test@gmail.com', 34, 1, 'M', 8765432129, 'Test', 2000, 'cheque', '456786', 1000.00, 1000.00, 3, 1513760270, 2, 0, 0, 1, 2);

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
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `offerings_category`
--

INSERT INTO `offerings_category` (`id`, `category`, `cms_share`, `church_share`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`, `cid`) VALUES
(1, 'tithes', '100%', '0%', 1, 1512570248, 1, NULL, NULL, 2),
(2, 'Thanks Offerings', '50%', '50%', 1, 1512572508, 1, NULL, NULL, 2),
(3, 'Birthday Offering', '50%', '50%', 1, 1512837450, 1, NULL, NULL, 2),
(4, 'Dorcas Offering', '0%', '100%', 1, 1512837486, 1, NULL, NULL, 2),
(5, 'Poor Fund Offering', '0%', '100%', 1, 1512837508, 1, NULL, NULL, 2),
(6, 'Church Expenses Offering', '0%', '100%', 1, 1512837608, 1, NULL, NULL, 2),
(7, 'Divine Service Offering', '50%', '50%', 1, 1512837633, 1, NULL, NULL, 2),
(8, 'Sabbath School Offering', '50%', '50%', 1, 1512837657, 1, NULL, NULL, 2),
(9, 'Investment Offering', '100%', '0%', 1, 1512837682, 1, NULL, NULL, 2),
(10, 'Building Project', '0%', '100%', 1, 1512837742, 1, NULL, NULL, 2),
(11, 'Sabbath School Lesson Cost Payment', '100%', '0%', 1, 1512837769, 1, NULL, NULL, 2),
(12, 'Wedding Offering', '50%', '50%', 1, 1512837797, 1, NULL, NULL, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `type`, `active`, `created_at`, `created_by`) VALUES
(1, 'SuperAdmin', 1, 1511626396, 1),
(2, 'Admin', 1, 1511626396, 1),
(3, 'User', 1, 1511626396, 1),
(4, 'SiteStorms', 1, 1513746188, 1),
(5, 'AV', 1, 1513746188, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` float(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `name`, `price`, `created_by`, `created_at`, `updated_at`, `updated_by`, `active`) VALUES
(1, '1 Month', 1000.00, 1, 1513746188, 1513746188, 1, 1),
(2, '3 Months', 4000.00, 1, 1513746188, 1513746188, 1, 1),
(3, '6 Months', 5000.00, 1, 1513746188, 1513746188, 1, 1),
(4, '1 Year', 8500.00, 1, 1513746188, 1513746188, 1, 1),
(5, '2 Years', 11500.00, 1, 1513746188, 1513746188, 1, 1),
(6, '3 Years', 14500.00, 1, 1513746188, 1513746188, 1, 1),
(7, '5 Years', 19500.00, 1, 1513746188, 1513746188, 1, 1),
(8, '10 Years', 25000.00, 1, 1513746188, 1513746188, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `cid`, `name`, `phone`, `password`, `user_type`, `mac`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Dinesh', 9597207343, '8f5aa53923b35b5a794d0f4c4d409c23', 4, 'E0-2A-82-43-97-66', 1, 1511626396, 1, 1512543653, 1),
(2, 2, 'Dinesh', 9962090355, '8f5aa53923b35b5a794d0f4c4d409c23', 1, 'F0-03-8C-5B-38-D7', 1, 1511626396, 1, 1512543653, 1);

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
