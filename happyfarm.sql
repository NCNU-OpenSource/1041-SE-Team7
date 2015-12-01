-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2015-12-01: 12:08:13
-- 伺服器版本: 5.6.24
-- PHP 版本： 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `happyfarm`
--

-- --------------------------------------------------------

--
-- 資料表結構 `crops`
--

CREATE TABLE IF NOT EXISTS `crops` (
  `cID` int(11) NOT NULL,
  `cname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `costtime` int(11) NOT NULL,
  `pcostenergy` int(11) NOT NULL,
  `hcostenergy` int(11) NOT NULL,
  `costmoney` int(11) NOT NULL,
  `sellmoney` int(11) NOT NULL,
  `pexp` int(11) NOT NULL,
  `hexp` int(11) NOT NULL,
  `needlevel` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `crops`
--

INSERT INTO `crops` (`cID`, `cname`, `costtime`, `pcostenergy`, `hcostenergy`, `costmoney`, `sellmoney`, `pexp`, `hexp`, `needlevel`) VALUES
(1, '玉米', 10, 1, 1, 1, 1, 1, 1, 1),
(2, '罌粟花', 20, 2, 2, 2, 2, 2, 2, 1),
(3, '貴到靠盃的菜', 50, 3, 3, 500, 300, 3, 3, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `farm`
--

CREATE TABLE IF NOT EXISTS `farm` (
  `farmID` int(11) NOT NULL,
  `costmoney` int(11) NOT NULL,
  `needlevel` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `farm`
--

INSERT INTO `farm` (`farmID`, `costmoney`, `needlevel`) VALUES
(1, 0, 1),
(2, 0, 1),
(3, 100, 2),
(4, 200, 3),
(5, 300, 4),
(6, 400, 5),
(7, 500, 6),
(8, 600, 7),
(9, 700, 8);

-- --------------------------------------------------------

--
-- 資料表結構 `farmplayer`
--

CREATE TABLE IF NOT EXISTS `farmplayer` (
  `ID` int(11) NOT NULL,
  `farmID` int(11) NOT NULL,
  `pname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cID` int(11) NOT NULL DEFAULT '0',
  `ptime` time NOT NULL,
  `htime` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `farmplayer`
--

INSERT INTO `farmplayer` (`ID`, `farmID`, `pname`, `cID`, `ptime`, `htime`) VALUES
(1, 1, '精子', 1, '18:29:02', '18:29:12'),
(2, 2, '精子', 3, '18:29:47', '00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `food`
--

CREATE TABLE IF NOT EXISTS `food` (
  `fID` int(11) NOT NULL,
  `fname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `energyup` int(11) NOT NULL,
  `costmoney` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `food`
--

INSERT INTO `food` (`fID`, `fname`, `energyup`, `costmoney`) VALUES
(1, '有媽媽味道的肉', 400, 20);

-- --------------------------------------------------------

--
-- 資料表結構 `player`
--

CREATE TABLE IF NOT EXISTS `player` (
  `pID` int(11) NOT NULL,
  `pname` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `exp` int(11) NOT NULL DEFAULT '0',
  `energy` int(11) NOT NULL DEFAULT '30',
  `money` int(11) NOT NULL DEFAULT '100',
  `logintime` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `player`
--

INSERT INTO `player` (`pID`, `pname`, `account`, `password`, `level`, `exp`, `energy`, `money`, `logintime`) VALUES
(1, '精子', 'a87569650', 'a7741520', 5, 0, 30, 100, 0),
(2, 'a', '111', '111', 3, 0, 30, 100, 2147483647),
(3, '222', '222', '222', 1, 0, 30, 100, 2147483647);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`cID`);

--
-- 資料表索引 `farm`
--
ALTER TABLE `farm`
  ADD PRIMARY KEY (`farmID`);

--
-- 資料表索引 `farmplayer`
--
ALTER TABLE `farmplayer`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`fID`);

--
-- 資料表索引 `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`pID`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `crops`
--
ALTER TABLE `crops`
  MODIFY `cID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- 使用資料表 AUTO_INCREMENT `farm`
--
ALTER TABLE `farm`
  MODIFY `farmID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- 使用資料表 AUTO_INCREMENT `farmplayer`
--
ALTER TABLE `farmplayer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- 使用資料表 AUTO_INCREMENT `food`
--
ALTER TABLE `food`
  MODIFY `fID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `player`
--
ALTER TABLE `player`
  MODIFY `pID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
