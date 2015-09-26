-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2015 at 02:11 PM
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
  `description` varchar(100) NOT NULL DEFAULT 'none',
  `paided` int(10) NOT NULL,
  `plan` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyId`, `companyName`, `description`, `paided`, `plan`) VALUES
(1, 'sssss', '', 0, 0),
(2, 'sssw', '', 0, 0),
(3, 'q', '', 0, 0),
(4, 'ss', '', 0, 0),
(5, 's', '', 0, 0),
(6, 'aaarobert_gabriel@outlook.com', '', 0, 0),
(7, 'a', '', 0, 0),
(8, 'ssss', '', 0, 0),
(9, 'ssssssww', '', 0, 0),
(10, 'aaaa', 'none', 0, 0),
(11, 'arobert_gabriel@outlook.com', 'none', 0, 0),
(12, 'cgvhbjkn', 'none', 0, 0),
(13, 'drtfyughijkl', 'none', 0, 0),
(14, 'dftgyuhiojpkp', 'none', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `information` varchar(500) NOT NULL,
  `url` varchar(100) NOT NULL,
  `manual` int(1) NOT NULL DEFAULT '0',
  `companyId` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`title`, `description`, `information`, `url`, `manual`, `companyId`) VALUES
('rokas', 'is cool', '', 'ss', 1, 2),
('rokas', 'is cool', '', 'ss', 1, 0),
('rokas', 'is cool', '', 'ss', 1, 0),
('ugihj', 'yujkl', '', 'ygujklm', 0, 1),
('ugihj', 'yujkl', '', 'ygujklm', 0, 1),
('sss', 'sss', '', 'sss', 0, 1),
('s', 's', '', 'ssss', 1, 0),
('Robert', 'dfghjk', '', 'dfghjk', 1, 0),
('dfghjk', 'dfghjk', '["dfghjkl"]', 'fghjkl', 1, 0),
('dfghjk', 'dfghjk', '["dfghjkl"]', 'fghjkl', 1, 0),
('batman', 'dfghj', '{"a":"red","0":"dfghjk"}', 'dfghjk', 1, 0),
('', '', '{"a":"red","0":"batman"}', '', 1, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `searches`
--

INSERT INTO `searches` (`id`, `search_term`, `userID`, `date`, `time`, `location`) VALUES
(1, 'cat', 0, '22-09-15', '03:28:34pm', ''),
(2, 'cat', 0, '22-09-15', '03:28:36pm', '');

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
(4, 'No', 'No', 'No', 'No'),
(5, 'No', 'No', 'No', 'No'),
(6, 'No', 'No', 'No', 'No'),
(7, 'No', 'No', 'No', 'No'),
(8, 'No', 'No', 'No', 'No'),
(9, 'No', 'No', 'No', 'No'),
(10, 'No', 'No', 'No', 'No'),
(11, 'No', 'No', 'No', 'No'),
(12, 'No', 'No', 'No', 'No'),
(13, 'No', 'No', 'No', 'No'),
(14, 'No', 'No', 'No', 'No');

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
  `salt` varchar(100) NOT NULL,
  `companyId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `website`, `twitter`, `salt`, `companyId`) VALUES
(1, 'R', 'dfghj', 'robert_gabriel@outlook.com', 'b45ab43e298ae861a56c24ff7d1043dc79e5d92e', 'hjgjga', '', 'dsSfYSGb', 0),
(2, 'rofghjk', 'fghjkl;', 'w@w.com', '065c8b1908c67e9323e6baa1e3c63094a8269707', 'sss', '', 'tsqEqYYA', 0),
(3, 'Rw', 'j', 'gtirob@gmail.com', 'ed105009d8bd27d8647db8dd22824e65cd6d8129', 'tqqqq', '', 'yDBnrJL9', 0),
(4, 'rthjkl', 'xfcgvhbj', 'qrobert_gabriel@outlook.com', 'dfa7c115dea4cf1907b07fdb3c677f904bd5c01c', 'fgyhuijok', '', '2CoI0ADq', 0),
(5, 'cvbnm', 'fghj', 'arobert_gabriel@outlook.com', '6eb777014e9cb4953ac2623482b47707bc8591a4', 'dfghjkl', '', 'mKHklKXu', 0),
(6, 'dfghjk', 'fghjk', 'aaaasgtirob@gmail.com', '772b799394213cdbdb316650f81ca7af40d45af7', 'cgvhbjnkml', '', 'BI7iJHal', 0),
(7, 'Robert', 'sertdfyghujkl;', 'aaaa@a.com', 'c1c0fccd352f134a34273a9aadd2b664ad1042a0', 'dftyguhijk', '', 'Ahl931F8', 0),
(8, 'sdtfyguhij', 'sertdfyguhjkl', 's@s.com', '7591f376f7da4826e4d2ce7bdcf2776a83417092', 'drtyfugihjok', '', 'W9oaJYzd', 10),
(9, 'drtfyguhijo', 'drftyguhijok', 'q@q.com', '1b05a6151b93bf160d08632b6b53845d5a5caed8', 'sss', '', '4CPGef4B', 14);

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
  MODIFY `companyId` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `searches`
--
ALTER TABLE `searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
