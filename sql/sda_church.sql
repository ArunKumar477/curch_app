-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2021 at 04:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sda_church`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `closing_balance` decimal(10,2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `cid`, `month`, `year`, `closing_balance`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(19, 2, 12, 2017, '-1300.00', 2, 1513773001, NULL, NULL),
(21, 2, 12, 2018, '0.00', 2, 1513773266, NULL, NULL),
(22, 2, 12, 0, '0.00', 2, 1513829212, NULL, NULL),
(23, 2, 12, 2019, '0.00', 2, 1513829330, NULL, NULL),
(24, 2, 3, 2021, '0.00', 7, 1614623072, NULL, NULL),
(25, 2, 4, 2021, '0.00', 7, 1617346967, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
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
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `logo`, `address`, `phone`, `alternate_no`, `email`, `subscription`, `created_at`, `created_by`, `updated_by`, `updated_at`, `expires_at`, `active`) VALUES
(1, 'Dev', 'images/uploads/site-storms-logo.png', '18,Avvai Street', 9003585477, 0, 'arundotcue@gmail.com', 8, 1513751330, 1, 1, 1513753013, 1829112951, 1),
(2, 'Client', 'images/uploads/100x80.png', 'Vepery,chennai-600007', 9962090355, 0, 'dineshkp220@gmail.com', 4, 1513752259, 1, 1, 1513753039, 1545289039, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `expense_date` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `cid`, `cat_id`, `amount`, `expense_date`, `created_by`, `created_at`, `updated_by`, `updated_at`, `active`) VALUES
(5, 2, 2, 200, 1512896003, 1, 1512307830, 1, 1512971784, 0),
(6, 2, 5, 329, 1512896003, 1, 1512309616, 1, 1512971308, 0),
(7, 2, 3, 500, 1512896003, 1, 1512895959, 7, 1614667525, 0),
(8, 2, 4, 100, 1512671400, 1, 1512902124, NULL, NULL, 1),
(9, 2, 5, 500, 1512153000, 1, 1512970631, NULL, NULL, 1),
(10, 1, 5, 500, 1512153000, 1, 1512970631, NULL, NULL, 1),
(11, 2, 2, 200, 1513621800, 2, 1513762839, NULL, NULL, 1),
(12, 2, 3, 1000, 1618079400, 7, 1618112208, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses_category`
--

CREATE TABLE `expenses_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `created_by` int(10) NOT NULL,
  `created_at` int(10) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses_category`
--

INSERT INTO `expenses_category` (`id`, `name`, `active`, `created_by`, `created_at`, `cid`) VALUES
(2, 'General', 1, 1, 1511626396, 2),
(3, 'Travel Expenses', 1, 1, 1511626396, 2),
(4, 'Beverages Charges', 0, 1, 1, 2),
(5, 'Administrative Charges', 0, 1, 1512293086, 2),
(6, 'Wages to Sexton', 0, 1, 1512313048, 2);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
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
  `active` int(1) DEFAULT 1,
  `member_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `cid`, `name`, `age`, `gender`, `email`, `mobile`, `address`, `dob`, `doa`, `is_child_sch`, `no_of_child_sch`, `created_by`, `created_at`, `updated_by`, `updated_at`, `active`, `member_type`) VALUES
(1, 2, 'Arun Kumar-1', 27, 'M', 'arunkumar07@yahoo.co.in', 9597207343, 'Alwarthiru Nagar', 636921000, 766521000, 0, 0, 1, 1512542876, 7, 1617038288, 1, 1),
(2, 2, 'Kumar', 27, 'M', 'kumar@gmail.com', 9962090355, 'Test', 642249008, 1357727408, 1, 1, 1, 1512543040, 1, 1512825240, 1, 1),
(3, 2, 'Sanjana', 25, 'F', 'sanju73@gmail.com', 8765432101, 'Tnagar', 702239400, 0, 1, 0, 1, 1512825388, 7, 1617905770, 1, 1),
(4, 2, 'aravindh', 25, 'M', 'aravind07j@gmail.com', 9790973433, 'urrapakam', 795983400, 1616869800, 0, 0, 7, 1616554450, 7, 1616554460, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `offerings`
--

CREATE TABLE `offerings` (
  `id` int(11) NOT NULL,
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
  `active` int(11) NOT NULL DEFAULT 1,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offerings`
--

INSERT INTO `offerings` (`id`, `receipt_no`, `offer_date`, `name`, `email`, `age`, `mtype`, `gender`, `mobile`, `address`, `amount`, `mof`, `cheque_no`, `cms_share`, `chruch_share`, `cat_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `active`, `cid`) VALUES
(14, 'SNO1', 1616956200, 'test', 'test-1@gmail.com', 23, 1, 'M', 9035854756, 'sdfsdff', 4012, 'cash', '0', 4012.00, 0.00, -1, 1614623398, 7, 1617036222, 7, 1, 2),
(15, 'SNO2', 1618079400, 'Arun Kumar-1', 'arunkumar07@yahoo.co.in', 27, 1, 'M', 9597207343, 'Alwarthiru Nagar', 1000, 'cash', '0', 1000.00, 0.00, 1, 1617905539, 7, 1618122389, 7, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `offerings_category`
--

CREATE TABLE `offerings_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `cms_share` varchar(5) NOT NULL,
  `church_share` varchar(5) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offerings_category`
--

INSERT INTO `offerings_category` (`id`, `category`, `cms_share`, `church_share`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`, `cid`) VALUES
(1, 'tithes-', '100%', '0', 1, 1512570248, 1, 1618126848, 7, 2),
(2, 'Thanks Offerings', '50%', '50%', 1, 1512572508, 1, 1618126853, 7, 2),
(3, 'Birthday Offering', '50%', '50%', 1, 1512837450, 1, 1618126861, 7, 2),
(4, 'Dorcas Offering', '0%', '100%', 1, 1512837486, 1, NULL, NULL, 2),
(5, 'Poor Fund Offering', '0%', '100%', 1, 1512837508, 1, NULL, NULL, 2),
(6, 'Church Expenses Offering', '0%', '100%', 1, 1512837608, 1, NULL, NULL, 2),
(7, 'Divine Service Offering', '50%', '50%', 1, 1512837633, 1, NULL, NULL, 2),
(8, 'Sabbath School Offering', '50%', '50%', 1, 1512837657, 1, NULL, NULL, 2),
(9, 'Investment Offering', '100%', '0%', 1, 1512837682, 1, 1618126866, 7, 2),
(10, 'Building Project', '0%', '100%', 1, 1512837742, 1, NULL, NULL, 2),
(11, 'Sabbath School Lesson Cost Payment', '0%', '100%', 1, 1512837769, 1, 1618122214, NULL, 2),
(12, 'Wedding Offering', '50%', '50%', 1, 1512837797, 1, NULL, NULL, 2),
(16, 'Old Year Offering', '0%', '100%', 1, 1618125489, 7, 1618125520, NULL, 2),
(17, 'New Year Offering', '0%', '100%', 1, 1618125512, 7, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(5) NOT NULL,
  `type` varchar(50) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `otp` varchar(20) DEFAULT NULL,
  `otp_phone` bigint(20) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` int(5) UNSIGNED NOT NULL,
  `mac` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `cid`, `name`, `otp`, `otp_phone`, `phone`, `password`, `user_type`, `mac`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Site', '264148', 0, 9597207343, '8f5aa53923b35b5a794d0f4c4d409c23', 4, 'E0-2A-82-43-97-66', 1, 1511626396, 1, 1512543653, 1),
(3, 2, 'Prince', '166025', 0, 9791835193, 'cc03e747a6afbbcbf8be7668acfebee5', 1, 'E0-2A-82-43-97-66', 1, 1511626396, 1, 1515236427, 3),
(4, 2, 'Demo', '264148', 0, 9597207343, 'cc03e747a6afbbcbf8be7668acfebee5', 1, 'E0-2A-82-43-97-66', 1, 1511626396, 1, 1512543653, 1),
(5, 2, 'Dinesh', '264148', 9597207343, 9597207343, 'cc03e747a6afbbcbf8be7668acfebee5', 2, 'E0-2A-82-43-97-66', 1, 1515230250, 1, NULL, NULL),
(6, 2, 'Vinith', '159970', 0, 9600072047, 'fcea920f7412b5da7be0cf42b8c93759', 1, 'E0-2A-82-43-97-66', 1, 1511626396, 1, 1512543653, 1),
(7, 2, 'AKM', '252996', 9962090355, 9003585477, '7174', 1, 'E0-2A-82-43-97-66', 1, 1511626396, 1, 1512543653, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `expenses_category`
--
ALTER TABLE `expenses_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offerings`
--
ALTER TABLE `offerings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offerings_category`
--
ALTER TABLE `offerings_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type_foregin` (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expenses_category`
--
ALTER TABLE `expenses_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offerings`
--
ALTER TABLE `offerings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `offerings_category`
--
ALTER TABLE `offerings_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `expenses_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
