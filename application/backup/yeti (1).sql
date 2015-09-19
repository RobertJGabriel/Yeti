-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 19, 2015 at 05:32 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yeti`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `companyId` int(100) NOT NULL,
  `companyName` varchar(200) NOT NULL,
  `paided` int(10) NOT NULL,
  `plan` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyId`, `companyName`, `paided`, `plan`) VALUES
(1, 'JAJAJAJAJAJAJ', 0, 0),
(2, 'rdtfyghjknlm', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `searches`
--

CREATE TABLE IF NOT EXISTS `searches` (
  `id` int(11) NOT NULL,
  `search_term` varchar(200) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `searches`
--

INSERT INTO `searches` (`id`, `search_term`, `userID`, `date`, `time`, `location`) VALUES
(7, 'batman', 2, '08-02-15', '07:01:24am', ''),
(8, 'ign', 2, '08-02-15', '07:03:16am', ''),
(9, 'ign', 2, '08-02-15', '07:04:12am', ''),
(10, 'tiger', 2, '08-02-15', '02:54:23pm', ''),
(11, '', 1, '15-03-15', '02:08:49pm', ''),
(12, 'ign', 1, '15-03-15', '02:08:54pm', ''),
(13, 'ign', 1, '15-03-15', '02:14:03pm', ''),
(14, 'batman', 1, '15-03-15', '02:23:34pm', ''),
(15, 'ign', 4, '15-03-15', '02:38:04pm', ''),
(16, 'ign', 4, '15-03-15', '02:38:59pm', ''),
(17, 'twitter', 4, '15-03-15', '02:45:18pm', ''),
(18, 'ign', 6, '15-03-15', '02:51:36pm', ''),
(19, 'tadhg foley', 10, '15-03-15', '03:13:18pm', ''),
(20, 'ign', 10, '15-03-15', '03:14:10pm', ''),
(21, 'ign', 10, '15-03-15', '03:15:59pm', ''),
(22, 'ign', 10, '15-03-15', '03:21:44pm', ''),
(23, 'ign', 10, '15-03-15', '03:22:20pm', ''),
(24, 'ign', 10, '15-03-15', '03:29:17pm', ''),
(25, 'ign', 12, '15-03-15', '03:53:34pm', ''),
(26, 'ign', 12, '15-03-15', '04:38:24pm', ''),
(27, 'ign', 12, '15-03-15', '04:39:30pm', ''),
(28, 'ign', 12, '15-03-15', '04:39:30pm', ''),
(29, 'ign', 12, '15-03-15', '04:40:12pm', ''),
(30, 'ign', 12, '15-03-15', '04:40:54pm', ''),
(31, 'facebook', 12, '15-03-15', '04:41:39pm', ''),
(32, 'twitter', 12, '15-03-15', '04:42:44pm', ''),
(33, 'ign', 12, '15-03-15', '04:43:33pm', ''),
(34, 'ign', 12, '15-03-15', '04:45:18pm', ''),
(35, 'twitter', 12, '15-03-15', '04:45:53pm', ''),
(36, 'twitter', 12, '15-03-15', '04:46:53pm', ''),
(37, 'facebook', 12, '15-03-15', '04:47:47pm', ''),
(38, 'twitter', 12, '15-03-15', '04:48:33pm', ''),
(39, 'ign', 12, '15-03-15', '04:49:50pm', ''),
(40, 'ign', 12, '15-03-15', '04:50:24pm', ''),
(41, 'batman', 12, '15-03-15', '04:52:53pm', ''),
(42, 'ign', 12, '15-03-15', '04:53:43pm', ''),
(43, 'ign', 12, '15-03-15', '04:56:00pm', ''),
(44, 'batman', 12, '15-03-15', '05:02:09pm', ''),
(45, 'facebook]', 12, '15-03-15', '05:03:30pm', ''),
(46, 'facebook', 12, '15-03-15', '05:03:30pm', ''),
(47, 'facebook', 12, '15-03-15', '05:06:07pm', ''),
(48, 'ign', 12, '15-03-15', '05:10:41pm', ''),
(49, 'batman', 12, '15-03-15', '05:11:09pm', ''),
(50, 'spider', 12, '15-03-15', '05:14:47pm', ''),
(51, 'ign', 12, '15-03-15', '05:16:40pm', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `companyId` int(11) NOT NULL,
  `twitter` varchar(3) NOT NULL DEFAULT 'No',
  `gogoduck` varchar(3) NOT NULL DEFAULT 'No',
  `google` varchar(3) NOT NULL DEFAULT 'No',
  `bing` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`companyId`, `twitter`, `gogoduck`, `google`, `bing`) VALUES
(2, 'No', 'No', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `website` varchar(200) NOT NULL,
  `twitter` varchar(11) NOT NULL,
  `hash` char(32) NOT NULL,
  `companyId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `website`, `twitter`, `hash`, `companyId`) VALUES
(12, '', '', 'robert_gabriel@outlook.com', '', '', '', '', 1),
(13, 'g', 'f', 'rgh', 'werftghj', 'erfghj', '3', '', 0),
(14, 'Rob', 'Gabriel', 'gtirob@gmail.com', 's', 'test.ie', '', '', 0),
(15, 'robert', 'gabriel', 's@GMAIL.COM', 'ZZZZ', 'SSS', '', '', 0),
(16, 'rffg', 'edfgh', 'dfghj@j.com', 'q', 'fghj', '', '', 0),
(17, '', '', '', '04b80367f481fafc835322dc7422a6d7dfda20e0', '', '', '', 0),
(18, 'tghj', '4rtyghjk', 'robert_gabriel2@outlook.com', '11b493b702360f7b1342fbf53c6dfb2ab0104fd2', 'robert_gabriel2@outlook.com', '', '', 0),
(19, 'Keenth', 'HHHH', 'robert_gabSSSriel@outlook.com', '7ce119b3bc8842083b46f189fcf17175b014d8da', 'JAAAJ', '', '', 0),
(20, 'robert_gabriel', 'g', 'hsss@batman.com', '11b493b702360f7b1342fbf53c6dfb2ab0104fd2', 'ssss', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyId`),
  ADD UNIQUE KEY `companyId` (`companyName`);

--
-- Indexes for table `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`companyId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyId` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `searches`
--
ALTER TABLE `searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
