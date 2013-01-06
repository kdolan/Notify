-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2012 at 10:31 PM
-- Server version: 5.5.28-0ubuntu0.12.04.3
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kevin_notify`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Table structure for table `apiKeys`
--

CREATE TABLE IF NOT EXISTS `apiKeys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serviceName` tinytext NOT NULL,
  `key` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- Table structure for table `cellCarrierInfo`
--

CREATE TABLE IF NOT EXISTS `cellCarrierInfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrierName` tinytext NOT NULL,
  `domain` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cellCarrierInfo`
--

INSERT INTO `cellCarrierInfo` (`id`, `carrierName`, `domain`) VALUES
(1, 'at&t', 'txt.att.net'),
(2, 'Verizon', 'vtext.com'),
(3, 'T-Mobile', 'tmomail.net'),
(4, 'Sprint', 'messaging.sprintpcs.com'),
(5, 'US Cellular', 'email.uscc.net');

-- --------------------------------------------------------

--
-- Table structure for table `kevin_notify`
--

CREATE TABLE IF NOT EXISTS `kevin_notify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notificationService` tinytext NOT NULL COMMENT 'service that sent the notification.',
  `email` tinytext NOT NULL,
  `notificationText` tinytext NOT NULL,
  `active` tinyint(4) NOT NULL COMMENT '0 if notification sent. 1 if notification still needs to be sent.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext NOT NULL,
  `cellphoneNumber` bigint(20) NOT NULL,
  `cellCarrier` tinytext NOT NULL,
  `RIDE` int(11) NOT NULL DEFAULT '0' COMMENT 'contact preference for RIDE. 0=email only. 1=text message. 2=Both. 3=No notifications',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
