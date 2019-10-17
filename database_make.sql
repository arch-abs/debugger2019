-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 29, 2016 at 11:54 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1-log
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `debugger`
--

-- Dropping ALL table if exists initially
DROP TABLE IF EXISTS `answers`;
DROP TABLE IF EXISTS `manager`;
DROP TABLE IF EXISTS `questions`;
DROP TABLE IF EXISTS `quiz`;
DROP TABLE IF EXISTS `quiz2`;
DROP TABLE IF EXISTS `result`;
DROP TABLE IF EXISTS `solutions`;
DROP TABLE IF EXISTS `stages`;
DROP TABLE IF EXISTS `submissions`;
DROP TABLE IF EXISTS `teams`;



-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `teamname` varchar(16) NOT NULL,
  `questionid` tinyint(4) NOT NULL,
  `stageid` varchar(2) NOT NULL,
  `ans` longtext NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`teamname`,`questionid`,`stageid`),
  KEY `stageid` (`stageid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--


--
-- Table structure for table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `username` varchar(10) NOT NULL,
  `password` varchar(16) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `manager` (`username`, `password`) VALUES
('admin19', 'admin19');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `stageid` varchar(2) NOT NULL,
  `questionid` tinyint(4) NOT NULL,
  `question` longtext NOT NULL,
  `code` longtext NOT NULL,
  PRIMARY KEY (`stageid`,`questionid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `teamname` varchar(16) NOT NULL,
  `stageid` varchar(2) NOT NULL,
  `timeleft` int(11) NOT NULL,
  PRIMARY KEY (`teamname`,`stageid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz2`
--

CREATE TABLE IF NOT EXISTS `quiz2` (
  `teamname` varchar(30) NOT NULL,
  `stageid` varchar(4) NOT NULL,
  `starttime` datetime NOT NULL,
  PRIMARY KEY (`teamname`,`stageid`),
  KEY `stageid` (`stageid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz2`
--


-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `teamname` varchar(16) NOT NULL,
  `stageid` varchar(2) NOT NULL,
  `questionid` tinyint(4) NOT NULL,
  `status` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `changes` int(11) NOT NULL,
  PRIMARY KEY (`teamname`,`stageid`,`questionid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

CREATE TABLE IF NOT EXISTS `solutions` (
  `stageid` varchar(2) NOT NULL,
  `questionid` tinyint(4) NOT NULL,
  `solution` longtext NOT NULL,
  `input` longtext NOT NULL,
  `output` longtext NOT NULL,
  PRIMARY KEY (`stageid`,`questionid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solutions`
--

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE IF NOT EXISTS `stages` (
  `stageid` varchar(2) NOT NULL,
  `type` varchar(10) NOT NULL,
  `time` int(11) NOT NULL,
  `stageStart` int(2) NOT NULL,
  PRIMARY KEY (`stageid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stages`
--


-- change here for time
-- NOT sure if these stages are to be added
-- INSERT INTO `stages` (`stageid`, `type`, `time`, `stageStart`) VALUES
-- ('1a', 'syntax', 30, 0),
-- ('1b', 'syntax', 30, 0),
-- ('2a', 'logical', 30, 0),
-- ('2b', 'logical', 30, 0),
-- ('3a', 'obfuscated', 30, 0),
-- ('3b', 'obfuscated', 30, 0);
-- FOR STAGE START PROBLEM, CHANGE HERE
-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `teamname` varchar(30) NOT NULL,
  `stageid` varchar(4) NOT NULL,
  `questionid` tinyint(4) NOT NULL,
  `ans` longtext NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `changes` int(10) NOT NULL,
  `accept` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`teamname`,`stageid`,`questionid`),
  KEY `stageid` (`stageid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--
-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `contestant1` text NOT NULL,
  `contestant2` text NOT NULL,
  `teamname` varchar(16) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  `stage` varchar(2) NOT NULL,
  `language` int(11) NOT NULL,
  PRIMARY KEY (`teamname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`stageid`) REFERENCES `stages` (`stageid`),
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`teamname`) REFERENCES `teams` (`teamname`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`stageid`) REFERENCES `stages` (`stageid`);

--
-- Constraints for table `quiz2`
--
ALTER TABLE `quiz2`
  ADD CONSTRAINT `quiz2_ibfk_2` FOREIGN KEY (`teamname`) REFERENCES `teams` (`teamname`),
  ADD CONSTRAINT `quiz2_ibfk_1` FOREIGN KEY (`stageid`) REFERENCES `stages` (`stageid`);

--
-- Constraints for table `solutions`
--
ALTER TABLE `solutions`
  ADD CONSTRAINT `solutions_ibfk_1` FOREIGN KEY (`stageid`) REFERENCES `stages` (`stageid`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`stageid`) REFERENCES `stages` (`stageid`),
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`teamname`) REFERENCES `teams` (`teamname`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
