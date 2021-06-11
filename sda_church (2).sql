-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 07:21 PM
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
  `subscription` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `expires_at` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `logo`, `address`, `phone`, `alternate_no`, `email`, `subscription`, `created_at`, `created_by`, `updated_by`, `updated_at`, `expires_at`, `active`) VALUES
(1, 'Dev', 'images/uploads/site-storms-logo.png', '18,Avvai Street', 9003585477, 0, 'arundotcue@gmail.com', 8, 1513751330, 7, 1, 1513753013, 1829112951, 1),
(2, 'Client', 'images/uploads/100x80.png', 'Vepery,chennai-600007', 9962090355, 0, 'dineshkp220@gmail.com', 4, 1513752259, 7, 1, 1513753039, 1545289039, 1);

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
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_category`
--

CREATE TABLE `expenses_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `dob` int(11) DEFAULT NULL,
  `doa` int(11) DEFAULT NULL,
  `is_child_sch` int(11) DEFAULT NULL,
  `no_of_child_sch` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT 1,
  `member_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `cid`, `name`, `age`, `gender`, `email`, `mobile`, `address`, `dob`, `doa`, `is_child_sch`, `no_of_child_sch`, `created_by`, `created_at`, `updated_by`, `updated_at`, `active`, `member_type`) VALUES
(5, 2, 'Jenson Samuel V', 26, 'M', 'jensonsamuel777@gmail.com', 9940575968, '', 0, 0, 0, 0, 8, 1620274179, NULL, NULL, 1, 1),
(6, 2, 'DR.R.SAMUEL SUNDAR RAJ', 42, 'M', 'paldoctorsam@yahoo.co.in', 9884389080, '11/21, 1ST CROSS STREET\r\nGOPAL REDDY COLONY\r\nCHENNAI 82', 282421800, 1138213800, 1, 1, 8, 1622447423, NULL, NULL, 1, 1),
(7, 2, 'Jayakumar Wilson', 0, 'M', 'jayakumar.wilson@gmail.com', 9176141925, '4/509, Shanti avenue, Bhel Nagar, Medavakkam, Chennai. 600100\r\n', 1630521000, 1640543400, 0, 0, 8, 1622866962, NULL, NULL, 1, 1),
(8, 2, 'Jereta Jayakumar', 0, 'F', 'jayakumar.wilson@gmail.com', 1, '4/509, Shanti avenue, Bhel Nagar, Medavakkam, Chennai. 600100\r\n', 1640284200, 0, -1, 0, 8, 1622867342, NULL, NULL, 1, 1),
(9, 2, 'Abraham Gnanaprakasam G L', 0, 'M', 'louisabraham@gmail.com', 9787714329, '11/25, A1, Kannaiyan Illam, Valliammal Street, Kilpauk, Chennai - 600010\r\n', 1625855400, 1617906600, 0, 0, 8, 1622867426, 8, 1622867439, 1, 1),
(10, 2, 'Mohana P Abraham', 0, 'F', 'louisabraham@gmail.com', 8667070086, '11/25, A1, Kannaiyan Illam, Valliammal Street, Kilpauk, Chennai - 600010\r\n', 1635445800, 1617906600, -1, 0, 8, 1622867498, NULL, NULL, 1, 1),
(11, 2, 'Abishag Zelotes G L A', 0, 'F', 'louisabraham@gmail.com', 2, '11/25, A1, Kannaiyan Illam, Valliammal Street, Kilpauk, Chennai - 600010\r\n', 1618165800, 0, -1, 0, 8, 1622867711, NULL, NULL, 1, 1),
(12, 2, 'Jobish Joseph. Pr', 0, 'M', 'jobish.orpast@gmail.com', 7402018511, '#8 sda church, aiyya pilla street\r\nSchool road, chetpet,\r\n', 1631039400, 1620671400, 0, 0, 8, 1622867767, 8, 1622868614, 1, 1),
(13, 2, 'Christo Mighael Louis G L A', 0, 'M', 'louisabraham@gmail.com', 3, '11/25, A1, Kannaiyan Illam, Valliammal Street, Kilpauk, Chennai - 600010\r\n', 1628533800, 0, -1, 0, 8, 1622867906, NULL, NULL, 1, 1),
(14, 2, 'Mahila Jobish', 0, 'M', 'mahila.vl@gamail.com', 9791897953, '#8 sda church, aiyya pilla street\r\nSchool road, chetpet,\r\n', 1633113000, 1620671400, 0, 0, 8, 1622868047, 8, 1622868056, 1, 1),
(15, 2, 'Ashriel Jobish', 0, 'F', 'jobish.orpast@gmail.com', 4, '#8 sda church, aiyya pilla street\r\nSchool road, chetpet,\r\n', 1631817000, 0, -1, 0, 8, 1622868224, NULL, NULL, 1, 1),
(16, 2, 'Rega Jayakumar', 0, 'F', 'rega.jay@gmail.com', 9384661637, '4/509, Shanti avenue, Bhel Nagar, Medavakkam, Chennai. 600100\r\n', 1610994600, 1640543400, -1, 0, 8, 1622868271, NULL, NULL, 1, 1),
(17, 2, 'Jerwin Abraham Jayakumar', 0, 'M', 'jayakumar.wilson@gmail.com', 5, '4/509, Shanti avenue, Bhel Nagar, Medavakkam, Chennai. 600100\r\n', 1627497000, 0, -1, 0, 8, 1622868450, NULL, NULL, 1, 1),
(18, 2, 'Samuel  Joseph ', 0, 'M', 'samjoseph_1@yahoo.co.in', 9884076979, 'Plot 293,   18th Street \r\nAnnanagar west Extn.\r\nChennai 600101\r\n\r\n', 1623695400, 1633545000, -1, 0, 8, 1622868507, NULL, NULL, 1, 1),
(19, 2, 'Vethanayagam S', 0, 'M', 'vethanayagam777@gmail.com', 9840839470, 'Flat 4, swagatham apt, No 9, chellapa mudali street\r\nOtteri, Chennai 12\r\n', 1636569000, 0, -1, 0, 8, 1622868594, NULL, NULL, 1, 1),
(20, 2, 'SHALINI NINAN', 0, 'F', 'shalini.shalini.prathima10@gmail.com', 9551088335, 'Hno 05, first cross street, janakiram colony, arumbakkam, Chennai 106\r\n', 1636914600, 1620585000, -1, 0, 8, 1622868786, NULL, NULL, 1, 1),
(21, 2, 'NINAN DANIEL', 0, 'M', 'ninandnl@yahoo.co.in', 9094015588, 'Hno 05, first cross street, janakiram colony, arumbakkam, Chennai 106\r\n', 1638815400, 1620585000, -1, 0, 8, 1622868837, NULL, NULL, 1, 1),
(22, 2, 'NIMIKSHA NINAN', 0, 'F', 'shalini.prathima10@gmail.com', 6, 'Hno 05, first cross street, janakiram colony, Arumbakkam, Chennai 106\r\n', 1615660200, 0, -1, 0, 8, 1622868912, NULL, NULL, 1, 1),
(23, 2, 'NIKITHA NINAN', 0, 'F', 'ninandnl@yahoo.co.in', 7, 'Hno 05, first cross street, janakiram colony, arumbakkam, Chennai 106\r\n', 1617561000, 0, -1, 0, 8, 1622868952, NULL, NULL, 1, 1),
(24, 2, 'Charles Velankanni T', 0, 'F', 'johncharles9941122202@gmail.com', 7358007818, '253/53, Chellappa street, otteri,ch-12\r\n', 1609525800, 1629138600, 0, 0, 8, 1622869027, 8, 1622869095, 1, 1),
(25, 2, 'Deborah Sharlton. Dr', 0, 'F', 'glorytwinkle@gmail.com', 9884095832, 'No 56, Raj Paris Villa, new avadi road, kilpauk, Chennai 600010\r\n', 1630261800, 1628879400, 0, 0, 8, 1622869075, 8, 1622869088, 1, 1),
(26, 2, 'Sharlton Shadrac', 0, 'M', 'sharlton.shadrac@gmail.com', 9176045953, 'No 56, Raj Paris Villa, new avadi road, kilpauk, Chennai 600010\r\n', 1620498600, 1628879400, -1, 0, 8, 1622869291, NULL, NULL, 1, 1),
(27, 2, 'Shannon Fiona Sharlton', 0, 'F', 'sharlton.shadrac@gmail.com', 8, 'No 56, Raj Paris Villa, new avadi road, kilpauk, Chennai 600010\r\n', 1624732200, 0, -1, 0, 8, 1622869327, NULL, NULL, 1, 1),
(28, 2, 'AgapÃ© Theophilus Sharlton', 0, 'M', 'glorytwinkle@gmail.com', 9, 'No 56, Raj Paris Villa, new avadi road, kilpauk, Chennai 600010\r\n', 1636828200, 0, -1, 0, 8, 1622869369, NULL, NULL, 1, 1),
(29, 2, 'John Wilson Abraham', 0, 'M', 'jwilson.abraham@gmail.com', 9841219208, '4/509, Shanti avenue, Bhel Nagar, Medavakkam, Chennai. 600100\r\n', 1630175400, 1623004200, -1, 0, 8, 1622869417, NULL, NULL, 1, 1),
(30, 2, 'Vasantha Wilson', 0, '-1', 'jwilson.abraham@gmail.com', 10, '4/509, Shanti avenue, Bhel Nagar, Medavakkam, Chennai. 600100\r\n', 1626719400, 1623004200, -1, 0, 8, 1622869462, NULL, NULL, 1, 1),
(31, 2, 'Sashi Papolu', 0, 'M', 'sashipop@gmail.com', 9885687191, 'Pillaiyar Koil Street\r\nYuga Kalpataru Apartments\r\n', 1629397800, 1628101800, -1, 0, 8, 1622869509, NULL, NULL, 1, 1),
(32, 2, 'Prince Immanuel. Dr', 0, 'M', 'kprinceimmanuel@gmail.com', 9791835193, '1110 Maple Alliance Orchid Springs \r\n', 1614191400, 1628361000, -1, 0, 8, 1622869565, NULL, NULL, 1, 1),
(33, 2, 'Silpa Prince Immanuel. Dr', 0, 'F', 'shilpacmc@gmail.com', 9791185248, '1111 Maple Alliance Orchid Springs\r\n', 1611426600, 1628361000, -1, 0, 8, 1622869636, NULL, NULL, 1, 1),
(34, 2, 'Crystal Prince Immanuel', 0, 'F', 'kprinceimmanuel@gmail.com', 9791185940, '1112 Maple Alliance Orchid Springs\r\n', 1633372200, 0, -1, 0, 8, 1622869677, NULL, NULL, 1, 1),
(35, 2, 'Pearl Prince Immanuel', 0, 'F', 'shilpacmc@gmail.com', 9791185249, '1113 Maple Alliance Orchid Springs\r\n', 1621449000, 0, -1, 0, 8, 1622869726, NULL, NULL, 1, 1),
(36, 2, 'Elvis Besterwitch ', 0, 'M', 'ELRAZ17@GMAIL.COM', 11, 'Sindur orchid 23E perumal kovil street madhavaram 60\r\n', 1624732200, 0, -1, 0, 8, 1622869913, NULL, NULL, 1, 1),
(37, 2, 'Cynthia Joseph', 0, 'F', 'elraz2809@gmail.com', 12, 'Sindur orchid 23E Perumal kovil street madhavaram. Chennai 60\r\n', 1612463400, 0, -1, 0, 8, 1622870583, NULL, NULL, 1, 1),
(38, 2, 'Razeena Besterwitch', 0, 'F', 'elraz2809@gmail.com', 13, 'Sindur orchid 23E Perumal kovil street madhavaram Chennai 60\r\n', 1622140200, 1616092200, -1, 0, 8, 1622870621, NULL, NULL, 1, 1),
(39, 2, 'Ezra Zion Besterwitch', 0, 'M', 'elraz2809@gmail.com', 14, 'Sindur orchid 23E Perumal kovil street madhavaram Chennai 60\r\n', 1610562600, 0, -1, 0, 8, 1622870655, NULL, NULL, 1, 1),
(40, 2, 'Zadok Shem Besterwitch', 0, 'M', 'elraz2809@gmail.com', 15, 'Sindur orchid 23E Perumal kovil street madhavaram Chennai 60\r\n', 1626373800, 0, -1, 0, 8, 1622870696, NULL, NULL, 1, 1),
(41, 2, 'Susamma Jacob George', 0, 'F', 'jacob.shabbath@gmail.com', 7550285621, '4053, Sobha Meritta, Vandalur Road, Pudupakam, Kelambakkam, Chennai. 603103\r\n', 0, 0, -1, 0, 8, 1622870725, NULL, NULL, 1, 1),
(42, 2, 'Jacob George', 0, 'M', 'jacob.shabbath@gmail.com', 8220750643, '4053, Sobha Meritta, Vandalur Road, Pudupakam, Kelambakkam, Chennai. 603104\r\n', 0, 0, -1, 0, 8, 1622870771, NULL, NULL, 1, 1),
(43, 2, 'Rachel Vasu', 0, 'F', '', 9789040196, '', 0, 0, -1, 0, 8, 1622870850, NULL, NULL, 1, 1),
(44, 2, 'Manoj Meshach', 0, 'M', 'cookiemanny77@gmail.com', 9840314961, '9 akshara villa , alapakkam, new perungulathur, Chennai 63', 0, 0, 0, 0, 8, 1622870904, 8, 1622877378, 1, 1),
(45, 2, 'Dr Krishna and Dr Annie', 0, 'F', 'kanniephoebe@gmail.com', 9840469385, 'Vellore', 0, 0, -1, 0, 8, 1622871479, NULL, NULL, 1, 1),
(46, 2, 'Dipa Rani Manoj', 0, 'F', '', 8448508566, '9 akshara villa , alappakkam\r\nnew Perungalathur \r\nChennai 600063', 0, 0, -1, 0, 8, 1622877460, NULL, NULL, 1, 1),
(47, 2, 'Mrs. Esther Ravichandran ', 0, 'F', '', 9884472642, '9 akshara villa , alappakkam\r\nnew Perungalathur \r\nChennai 600063', 0, 0, 0, 0, 8, 1622877487, 8, 1622877564, 1, 1),
(48, 2, 'Mr. V Ravichandran', 0, 'M', '', 9444194521, '9 akshara villa , alappakkam\r\nnew Perungalathur \r\nChennai 600063', 0, 0, -1, 0, 8, 1622877517, NULL, NULL, 1, 1),
(49, 2, 'Monica Catherine R', 0, 'M', '', 6369964018, '9 akshara villa , alappakkam\r\nnew Perungalathur \r\nChennai 600063', 0, 0, -1, 0, 8, 1622877547, NULL, NULL, 1, 1),
(50, 2, 'Jane Sathya Vethanayagam', 0, 'F', 'janesathya777@gmail.com', 9790646265, '', 0, 0, -1, 0, 8, 1622877792, NULL, NULL, 1, 2),
(51, 2, 'Dr. Albert Sheih', 0, 'M', '', 6381031130, '', 0, 0, 0, 0, 8, 1622877835, 8, 1622877974, 1, 1),
(52, 2, 'Dr Sudharsanam D', 0, 'M', '', 9884407195, '', 0, 0, -1, 0, 8, 1622877953, NULL, NULL, 1, 1),
(53, 2, 'Kingsley Richard', 0, 'M', '', 9791859092, 'Ayanavaram', 0, 0, -1, 0, 8, 1622878020, NULL, NULL, 1, 1),
(54, 2, 'Pavana Kingsley', 0, 'F', '', 7708993016, 'Ayanavaram', 0, 0, -1, 0, 8, 1622878053, NULL, NULL, 1, 1),
(55, 2, 'Jesudason', 0, 'M', '', 9790987092, '', 0, 0, -1, 0, 8, 1622878108, NULL, NULL, 1, 1),
(56, 2, 'Pauline Nancy', 0, 'F', '', 9840672083, '', 0, 0, -1, 0, 8, 1622878138, NULL, NULL, 1, 1),
(57, 2, 'DR.D.ELLEN SAMUEL', 42, 'F', 'doctorellen98@gmail.com', 9884389636, '11/21, 1st Cross Street, Gopal Reddy Colony\r\nSembium', 326831400, 1138213800, 1, 1, 8, 1622878160, NULL, NULL, 1, 1),
(58, 2, 'Pearline Mary', 0, 'M', '', 16, '', 0, 0, -1, 0, 8, 1622878163, NULL, NULL, 1, 1),
(60, 2, 'SHARON FELICIA', 11, 'F', 'samuelramiah@gmail.com', 9025792550, '11/21, 1st Cross Street, Gopal Reddy Colony', 1274639400, 1274639400, 0, 0, 8, 1622897319, NULL, NULL, 1, 1);

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
  `age` int(11) DEFAULT NULL,
  `mtype` int(11) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `amount` int(11) NOT NULL,
  `mof` varchar(10) NOT NULL,
  `cheque_no` varchar(10) DEFAULT NULL,
  `cms_share` float(8,2) NOT NULL,
  `chruch_share` float(8,2) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offerings_category`
--

CREATE TABLE `offerings_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `cms_share` varchar(5) NOT NULL,
  `church_share` varchar(5) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
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
(4, 'AKM', 1, 1513746188, 1),
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
  `active` int(11) NOT NULL DEFAULT 1
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
  `user_type` int(10) UNSIGNED NOT NULL,
  `mac` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `cid`, `name`, `otp`, `otp_phone`, `phone`, `password`, `user_type`, `mac`, `active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(7, 2, 'Arun', '742335', 9962090355, 9003585477, '7174', 1, 'E0-2A-82-43-97-66', 1, 1511626396, 7, 1622952291, 7),
(8, 2, 'Jenson', '305094', 9962090355, 9940575968, '12345', 1, 'E0-2A-82-43-97-66', 1, 1511626396, 7, 1620398238, 8),
(9, 2, 'SAM', '119888', 9884389080, 9884389080, '12345', 1, 'E0-2A-82-43-97-66', 1, 1511626396, 7, 1620398238, 8);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses_category`
--
ALTER TABLE `expenses_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `offerings`
--
ALTER TABLE `offerings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offerings_category`
--
ALTER TABLE `offerings_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
