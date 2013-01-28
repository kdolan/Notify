-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Host: 
-- Generation Time: Jan 28, 2013 at 10:51 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `notify`
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
  `username` text NOT NULL,
  `subscriptionService` int(11) NOT NULL COMMENT '0 is regular service. 1 is subscriptionService',
  `key` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;


-- --------------------------------------------------------

--
-- Table structure for table `cellCarrierInfo`
--

CREATE TABLE IF NOT EXISTS `cellCarrierInfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrierName` tinytext NOT NULL,
  `domain` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cellCarrierInfo`
--

INSERT INTO `cellCarrierInfo` (`id`, `carrierName`, `domain`) VALUES
(1, 'at&t', 'txt.att.net'),
(2, 'Verizon', 'vtext.com'),
(3, 'T-Mobile', 'tmomail.net'),
(4, 'Sprint', 'messaging.sprintpcs.com'),
(5, 'US Cellular', 'email.uscc.net'),
(6, 'Metro PCS', 'mymetropcs.com');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notificationService` tinytext NOT NULL COMMENT 'service that sent the notification.',
  `email` tinytext NOT NULL,
  `notificationText` tinytext NOT NULL,
  `active` tinyint(4) NOT NULL COMMENT '0 if notification sent. 1 if notification still needs to be sent.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

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
  `Game Jam` int(11) NOT NULL DEFAULT '3' COMMENT 'Subscription preference for Game Jam. 0=email only. 1=text message. 2=Both. 3=No notifications (Not subscribed)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
