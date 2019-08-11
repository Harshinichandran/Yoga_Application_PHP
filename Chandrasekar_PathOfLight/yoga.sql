-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2017 at 04:08 AM
-- Server version: 10.1.25-MariaDB
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
-- Database: `yoga`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classid` int(100) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `description` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `class`:
--

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classid`, `classname`, `description`) VALUES
(1, 'Gentle Hatha Yoga ', 'Intended for beginners and anyone wishing a grounded foundation in the practice of yoga, this 60 minute class of poses and slow movement focuses on asana (proper alignment and posture), pranayama (breath work), and guided meditation to foster your mind and body connection.'),
(2, 'Vinyasa Yoga', 'Although designed for intermediate to advanced students, beginners are welcome to sample this 60 minute class that focuses on breath-synchronized movement -- you will inhale and exhale as you flow energetically through yoga poses.'),
(3, 'Restorative Yoga', 'This 90 minute class features very slow movement and long poses that are supported by a chair or wall. This calming, restorative experience is suitable for students of any level of experience. This practice can be a perfect way to help rehabilitate an injury.');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clientid` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `client`:
--

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientid`, `name`, `address`, `phone`, `email`, `password`) VALUES
(139, 'Bob Smith', '222 E Work Ln, Arlington', '123 456 7890', 'bob.smith@gmail.com', 'Abcd1234'),
(140, 'Alex Smith', '222 E Work Ln, Euless', '123-456-7867', 'alex.smith@gmail.com', 'Abcd1234'),
(141, 'Tammy Hahn', '222 E Work Ln, Plano', '123-456-7890', 'tammy.hahn@gmail.com', 'Abcd1234'),
(142, 'Steve Framil', '222 E Work Ln, Little Elm', '123-222-2222', 'steve.framil@gmail.com', 'Abcd1234');

-- --------------------------------------------------------

--
-- Table structure for table `client-schedule`
--

CREATE TABLE `client-schedule` (
  `clientid` int(100) NOT NULL,
  `timeid` int(100) NOT NULL,
  `classid` int(100) NOT NULL,
  `daysid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `client-schedule`:
--   `clientid`
--       `client` -> `clientid`
--

--
-- Dumping data for table `client-schedule`
--

INSERT INTO `client-schedule` (`clientid`, `timeid`, `classid`, `daysid`) VALUES
(139, 5, 1, 2),
(140, 2, 2, 1),
(141, 9, 3, 2),
(142, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comments/questions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `contact`:
--

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `comments/questions`) VALUES
('Trey jones', 'trey@xmail.com', 'Yoga related'),
('Linda barasch', 'Linda@xmail.com', 'Gentle yoga'),
('David L', 'David@xmail.com', 'Vinyasa Yoga'),
('David P', 'DavidP@xmail.com', 'Restorative Yoga');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `daysid` int(100) NOT NULL,
  `daysname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `days`:
--

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`daysid`, `daysname`) VALUES
(1, 'Monday - Friday'),
(2, 'Saturday And Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `timeid` int(100) NOT NULL,
  `classid` int(100) NOT NULL,
  `daysid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `schedule`:
--   `classid`
--       `class` -> `classid`
--   `daysid`
--       `days` -> `daysid`
--   `timeid`
--       `time` -> `timeid`
--

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`timeid`, `classid`, `daysid`) VALUES
(2, 2, 1),
(3, 3, 1),
(4, 1, 1),
(5, 1, 2),
(6, 2, 2),
(7, 1, 2),
(8, 2, 2),
(9, 3, 2),
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `timeid` int(100) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `time`:
--

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`timeid`, `time`) VALUES
(1, '9:00am'),
(2, '10:30am'),
(3, '5:30pm'),
(4, '7:00pm'),
(5, '10:30am'),
(6, 'Noon'),
(7, '1:30pm'),
(8, '3:00pm'),
(9, '5:30pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientid`);

--
-- Indexes for table `client-schedule`
--
ALTER TABLE `client-schedule`
  ADD KEY `clientid` (`clientid`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`daysid`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD KEY `timeid` (`timeid`),
  ADD KEY `classid` (`classid`),
  ADD KEY `days_fk` (`daysid`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`timeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clientid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `daysid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `timeid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `client-schedule`
--
ALTER TABLE `client-schedule`
  ADD CONSTRAINT `client_fk` FOREIGN KEY (`clientid`) REFERENCES `client` (`clientid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `class_fk` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `days_fk` FOREIGN KEY (`daysid`) REFERENCES `days` (`daysid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `time_fk` FOREIGN KEY (`timeid`) REFERENCES `time` (`timeid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
