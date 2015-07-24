-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015 年 6 朁E10 日 12:36
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shift`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `business_time`
--

CREATE TABLE IF NOT EXISTS `business_time` (
  `workshop_id` varchar(10) NOT NULL,
  `day` varchar(1) NOT NULL,
  `start_time` time(6) NOT NULL,
  `end_time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Day is "月","火","水","木","金","土"or"日".';

-- --------------------------------------------------------

--
-- テーブルの構造 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `number` int(100) NOT NULL,
  `mail_address` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(10) NOT NULL,
  `workshop_id` varchar(10) NOT NULL,
  `admin_or_not` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `member`
--

INSERT INTO `member` (`number`, `mail_address`, `password`, `name`, `workshop_id`, `admin_or_not`) VALUES
(1, '1111@1111', '1111', 'いちさん', '1111', 1),
(2, '2222@2222', '2222', 'じろう', '1111', 0),
(3, '3333@3333', '3333', 'さぶろう', '1111', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `shift_plan`
--

CREATE TABLE IF NOT EXISTS `shift_plan` (
  `member_number` int(100) NOT NULL,
  `date` date NOT NULL,
  `start_time` time(6) NOT NULL,
  `end_time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `shift_plan`
--

INSERT INTO `shift_plan` (`member_number`, `date`, `start_time`, `end_time`) VALUES
(1, '2015-05-31', '10:00:00.000000', '12:00:00.000000'),
(1, '2015-06-01', '01:00:00.000000', '05:00:00.000000'),
(1, '2015-06-17', '08:00:00.000000', '15:00:00.000000'),
(1, '2015-06-22', '14:00:00.000000', '21:00:00.000000'),
(2, '2015-05-31', '04:00:00.000000', '10:00:00.000000'),
(2, '2015-06-12', '10:00:00.000000', '14:00:00.000000'),
(2, '2015-06-13', '12:00:00.000000', '20:00:00.000000'),
(3, '2015-05-31', '16:00:00.000000', '20:00:00.000000'),
(3, '2015-06-04', '10:00:00.000000', '16:00:00.000000'),
(3, '2015-06-16', '18:00:00.000000', '21:00:00.000000');

-- --------------------------------------------------------

--
-- テーブルの構造 `workshop`
--

CREATE TABLE IF NOT EXISTS `workshop` (
  `id` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `workshop`
--

INSERT INTO `workshop` (`id`, `password`) VALUES
('1111', '1111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_time`
--
ALTER TABLE `business_time`
 ADD PRIMARY KEY (`workshop_id`,`day`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
 ADD PRIMARY KEY (`number`), ADD KEY `workshop_id` (`workshop_id`);

--
-- Indexes for table `shift_plan`
--
ALTER TABLE `shift_plan`
 ADD PRIMARY KEY (`member_number`,`date`);

--
-- Indexes for table `workshop`
--
ALTER TABLE `workshop`
 ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `business_time`
--
ALTER TABLE `business_time`
ADD CONSTRAINT `business_time_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshop` (`id`),
ADD CONSTRAINT `business_time_ibfk_2` FOREIGN KEY (`workshop_id`) REFERENCES `workshop` (`id`),
ADD CONSTRAINT `business_time_ibfk_3` FOREIGN KEY (`workshop_id`) REFERENCES `workshop` (`id`);

--
-- テーブルの制約 `member`
--
ALTER TABLE `member`
ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`workshop_id`) REFERENCES `workshop` (`id`);

--
-- テーブルの制約 `shift_plan`
--
ALTER TABLE `shift_plan`
ADD CONSTRAINT `shift_plan_ibfk_1` FOREIGN KEY (`member_number`) REFERENCES `member` (`number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
