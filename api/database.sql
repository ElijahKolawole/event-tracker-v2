-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 20, 2018 at 07:08 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `organization_id`, `title`, `description`, `email`, `phone`, `public`, `created`, `modified`) VALUES
(1, 1, 'Fake Event', 'This event doesn\'t really exist', 'event@email.com', '1800-111-2222', 1, '2018-09-05 23:40:52', '2018-09-05 23:40:52'),
(2, 2, 'GGC Event', 'This is a example event for GGC', 'events@ggc.edu', '(678) 407-5000', 1, '0000-00-00 00:00:00', '2018-09-11 00:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(16) DEFAULT NULL,
  `email` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `description`, `code`, `email`, `phone`, `created`) VALUES
(1, 'Test Organization', 'This is a test organization!', NULL, 'contact@email.com', '1800-111-1111', '2018-09-05 23:38:57'),
(2, 'Georgia Gwinnett College', 'Georgia Gwinnett College is a public college in Lawrenceville, Gwinnett County, Georgia. It is a member of the University System of Georgia.', 'GGCEvent10', 'contact@ggc.edu', '(678) 407-5000', '2018-09-05 23:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

DROP TABLE IF EXISTS `slots`;
CREATE TABLE IF NOT EXISTS `slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `min` int(11) NOT NULL DEFAULT '1',
  `max` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `event_id`, `title`, `description`, `date`, `starttime`, `endtime`, `min`, `max`, `created`, `modified`) VALUES
(1, 1, 'Job 1', 'Hand out food', '2018-09-10', '09:00:00', '20:00:00', 1, NULL, '2018-09-05 23:43:05', '2018-09-05 23:43:05'),
(2, 1, 'Job 2', 'Hand out drinks', '2018-09-10', '09:00:00', '17:00:00', 1, NULL, '2018-09-05 23:43:05', '2018-09-05 23:43:05'),
(3, 2, 'Greeter', 'You\'ll be greeting people!', '2018-09-22', '10:00:00', '14:00:00', 1, NULL, '2018-09-10 19:05:07', '2018-09-11 00:05:07'),
(7, 2, 'GGC Event Slot', 'Made using CreateTest.html', '2018-05-15', '00:00:05', '00:00:22', 1, 5, '2018-09-20 16:02:33', '2018-09-20 16:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `userorganization`
--

DROP TABLE IF EXISTS `userorganization`;
CREATE TABLE IF NOT EXISTS `userorganization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_userid` (`uid`),
  KEY `fk_slotid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL COMMENT 'SHA256',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Ammar', 'Huseinspahic', 'ammarhus@live.com', '4183AC4C8FE6969855D033D804AB4F4E8F2C095A06EDB1A903626C6D468D9094');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`);

--
-- Constraints for table `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `slots_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
