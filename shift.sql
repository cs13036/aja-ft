-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015 年 7 朁E01 日 18:45
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

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

--
-- テーブルのデータのダンプ `business_time`
--

INSERT INTO `business_time` (`workshop_id`, `day`, `start_time`, `end_time`) VALUES
('1111', '1', '08:00:00.000000', '17:00:00.000000');

-- --------------------------------------------------------

--
-- テーブルの構造 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
`number` int(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `mail_address` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `workshop_id` varchar(30) NOT NULL,
  `admin_or_not` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `member`
--

INSERT INTO `member` (`number`, `name`, `mail_address`, `password`, `workshop_id`, `admin_or_not`) VALUES
(1, 'qqq', 'zaq', 'da89a65e5debe0601141', 'zaq', 0),
(4, 'a', 'a', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'a', 0),
(5, 'ã”ã¡ã†', 'hentai@yahoo.co.jp', 'dcd7c6ef54d01e3e3a4cc96508ff0bca57a3b771', 'koko', 0);

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
(4, '2015-06-19', '07:00:00.000000', '13:00:00.000000'),
(4, '2015-06-30', '08:00:00.000000', '12:00:00.000000'),
(4, '2015-07-01', '06:30:00.000000', '09:30:00.000000'),
(4, '2015-07-02', '07:30:00.000000', '12:00:00.000000'),
(5, '2015-06-28', '11:30:00.000000', '15:30:00.000000'),
(5, '2015-06-30', '07:30:00.000000', '11:00:00.000000'),
(5, '2015-07-02', '07:30:00.000000', '11:00:00.000000');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
MODIFY `number` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
-- テーブルの制約 `shift_plan`
--
ALTER TABLE `shift_plan`
ADD CONSTRAINT `shift_plan_ibfk_1` FOREIGN KEY (`member_number`) REFERENCES `member` (`number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
