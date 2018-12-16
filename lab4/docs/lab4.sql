-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2018 at 09:44 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab4`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseIndex` varchar(8) NOT NULL,
  `courseName` varchar(50) NOT NULL,
  `courseCredit` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseIndex`, `courseName`, `courseCredit`) VALUES
('CSII200', 'Алгоритмын үндэс', 3),
('CSII202', 'Өгөгдлийн сангийн үндэс', 3),
('CSII203', 'Интернэт технологийн үндэс', 3),
('ICSI201', 'Объект хандлагат програмчлал', 3),
('ICSI202', 'Өгөгдлийн бүтэц', 3),
('ICSI203', 'Магадлал статистик', 3),
('ICSI301', 'Веб програмчлал', 3),
('ICSI432', 'Компьютер график', 3);

-- --------------------------------------------------------

--
-- Table structure for table `coursetakenhistory`
--

CREATE TABLE `coursetakenhistory` (
  `studentID` varchar(15) NOT NULL,
  `courseIndex` varchar(8) NOT NULL,
  `takenDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coursetakenhistory`
--

INSERT INTO `coursetakenhistory` (`studentID`, `courseIndex`, `takenDate`) VALUES
('16b1seas3369', 'CSII200', '2018-11-25 16:17:03'),
('16b1seas3369', 'ICSI202', '2018-11-26 18:28:35'),
('16b1seas3373', 'CSII200', '2018-11-26 18:55:31'),
('16dddd11dd11', 'CSII202', '2018-11-27 13:51:06'),
('16dddd11dd11', 'ICSI201', '2018-11-27 13:51:10'),
('16dddd11dd11', 'ICSI203', '2018-11-27 13:51:23'),
('16dddd11dd11', 'ICSI301', '2018-11-27 13:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `programIndex` varchar(8) NOT NULL,
  `programName` varchar(50) NOT NULL,
  `issuedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`programIndex`, `programName`, `issuedDate`) VALUES
('D061301', 'Компьютерийн ухаан', '2014-06-01 00:00:00'),
('D061302', 'Програм хангамж ', '2014-06-01 00:00:00'),
('D061303', 'Мэдээллийн систем', '2014-06-01 00:00:00'),
('D061304', 'Мэдээллийн технологи', '2014-06-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` varchar(20) NOT NULL,
  `userName` varchar(32) NOT NULL,
  `position` varchar(25) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `dateJoined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `userName`, `position`, `firstName`, `lastName`, `dateJoined`) VALUES
('', 'te____', '', '', '', '0000-00-00 00:00:00'),
('E10001000E10', 'te____', 'CEO', 'teee', 'Teasdasd', '0000-00-00 00:00:00'),
('E100110000001', 'temuujin', 'HOD', 'Temuujin', 'Ya', '2008-08-16 00:00:00'),
('E100120000001', 'emuujin', 'Manager', 'Emuujin', 'Kh', '2009-08-16 00:00:00'),
('E100130000001', 'bold', 'Supervisor', 'Bold', 'CH', '2009-09-16 00:00:00'),
('E100140000001', 'jinjoo', 'Staff', 'Jinjoo', 'languu', '2009-08-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(15) NOT NULL,
  `userName` varchar(32) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `dob` date NOT NULL,
  `programIndex` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `userName`, `lastName`, `firstName`, `gender`, `dob`, `programIndex`) VALUES
('1231321321321', 'te____ss', 'Teasdasd', 'teee', 'm', '0000-00-00', 'D061301'),
('14b1seas0072', 'javkhlan', 'Rentsendorj', 'Javkhlan', 'm', '1996-05-06', 'D061303'),
('15b1seas3370', 'jobs', 'Steve', 'Jobs', 'm', '1997-08-02', 'D061302'),
('15b1seas3371', 'gates', 'Bill', 'Gates', 'm', '1997-02-03', 'D061301'),
('16b1seas3369', 'temuujinya', 'Temuujin', 'Ya', 'm', '1998-01-01', 'D061302'),
('16b1seas3372', 'naruto', 'Uzumaki', 'Naruto', 'm', '1998-08-05', 'D061304'),
('16b1seas3373', 'sakura', 'San', 'Sakura', 'f', '1998-05-06', 'D061303'),
('16dddd11dd11', 'newstudent_', 'Teasdasd', 'jkjljlkjlkjljlkj', 'f', '2018-08-11', 'D061301');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userName` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `userType` tinyint(4) NOT NULL DEFAULT '2',
  `changePass` tinyint(4) NOT NULL DEFAULT '0',
  `isBlocked` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userName`, `password`, `regDate`, `role`, `userType`, `changePass`, `isBlocked`) VALUES
('bold', 'd6a0c0253f3e544744013711c52f4ca2', '2018-10-07 16:00:00', 1, 1, 127, 0),
('emuujin', 'd6a0c0253f3e544744013711c52f4ca2', '2018-09-08 16:00:00', 1, 1, 0, 0),
('gates', 'd6a0c0253f3e544744013711c52f4ca2', '2019-10-07 16:00:00', 0, 2, 127, 0),
('javkhlan', 'd6a0c0253f3e544744013711c52f4ca2', '2019-10-07 16:00:00', 0, 2, 0, 0),
('jinjoo', 'd6a0c0253f3e544744013711c52f4ca2', '2018-10-07 16:00:00', 1, 1, 0, 0),
('jobs', 'd6a0c0253f3e544744013711c52f4ca2', '2019-10-07 16:00:00', 0, 2, 0, 1),
('naruto', 'd6a0c0253f3e544744013711c52f4ca2', '2019-10-07 16:00:00', 0, 2, 0, 0),
('newstudent_', '5f72170a9037020bc2573300f36bc385', '2018-11-27 05:49:58', 0, 2, 0, 0),
('sakura', 'd6a0c0253f3e544744013711c52f4ca2', '2019-10-07 16:00:00', 0, 2, 0, 0),
('sdsf', '4a8519fc47db72d678a25696f9422a4e', '2018-11-27 02:35:15', 0, 1, 0, 0),
('temuujin', 'd6a0c0253f3e544744013711c52f4ca2', '2018-09-07 16:00:00', 1, 1, 0, 0),
('temuujinya', 'd6a0c0253f3e544744013711c52f4ca2', '2019-10-07 16:00:00', 0, 2, 0, 0),
('te____', '5f72170a9037020bc2573300f36bc385', '2018-11-27 02:13:18', 0, 1, 0, 0),
('te____ss', '5f72170a9037020bc2573300f36bc385', '2018-11-27 02:52:46', 0, 2, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseIndex`),
  ADD UNIQUE KEY `courseIndex` (`courseIndex`);

--
-- Indexes for table `coursetakenhistory`
--
ALTER TABLE `coursetakenhistory`
  ADD PRIMARY KEY (`studentID`,`courseIndex`),
  ADD KEY `FK_courseTakenHistoryStudentID` (`studentID`),
  ADD KEY `FK_courseTakenHistoryCourseIndex` (`courseIndex`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`programIndex`),
  ADD UNIQUE KEY `programIndex` (`programIndex`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`),
  ADD UNIQUE KEY `staffID` (`staffID`),
  ADD KEY `fk_staff_username` (`userName`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD UNIQUE KEY `studentID` (`studentID`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD KEY `FK_StudentProgramIndex` (`programIndex`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userName`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coursetakenhistory`
--
ALTER TABLE `coursetakenhistory`
  ADD CONSTRAINT `FK_courseTakenHistoryCourseIndex` FOREIGN KEY (`courseIndex`) REFERENCES `course` (`courseIndex`),
  ADD CONSTRAINT `FK_courseTakenHistoryStudentID` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk_staff_username` FOREIGN KEY (`userName`) REFERENCES `users` (`userName`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_StudentProgramIndex` FOREIGN KEY (`programIndex`) REFERENCES `program` (`programIndex`),
  ADD CONSTRAINT `fk_student_username` FOREIGN KEY (`userName`) REFERENCES `users` (`userName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
