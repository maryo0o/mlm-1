-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2014 at 10:30 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mlm`
--

-- --------------------------------------------------------

--
-- Table structure for table `epins`
--

CREATE TABLE IF NOT EXISTS `epins` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `pin` varchar(100) NOT NULL,
  `value` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `generation_date` datetime NOT NULL,
  `used_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `owner_id` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pin` (`pin`),
  KEY `owner_id` (`owner_id`),
  KEY `used_date` (`used_date`),
  KEY `purpose` (`purpose`),
  KEY `generation_date` (`generation_date`),
  KEY `status` (`status`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
