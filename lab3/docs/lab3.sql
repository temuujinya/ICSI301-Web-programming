-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2018 at 09:45 AM
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
-- Database: `lab3`
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
-- Table structure for table `courseTakenHistory`
--

CREATE TABLE `courseTakenHistory` (
  `studentID` varchar(15) NOT NULL,
  `courseIndex` varchar(8) NOT NULL,
  `takenDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courseTakenHistory`
--

INSERT INTO `courseTakenHistory` (`studentID`, `courseIndex`, `takenDate`) VALUES
('16b1seas3369', 'CSII203', '0000-00-00'),
('16b1seas3369', 'ICSI201', '0000-00-00'),
('16b1seas3369', 'CSII202', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `programIndex` varchar(8) NOT NULL,
  `programName` varchar(50) NOT NULL,
  `issuedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`programIndex`, `programName`, `issuedDate`) VALUES
('D061301', 'Компьютерийн ухаан', '2014-06-01'),
('D061302', 'Програм хангамж ', '2014-06-01'),
('D061303', 'Мэдээллийн систем', '2014-06-01'),
('D061304', 'Мэдээллийн технологи', '2014-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(15) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `dob` date NOT NULL,
  `programIndex` varchar(8) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `lastName`, `firstName`, `gender`, `dob`, `programIndex`, `password`) VALUES
('15b1seas3370', 'Steve', 'Jobs', 'm', '1997-08-02', 'D061302', '123456'),
('15b1seas3371', 'Bill', 'Gates', 'm', '1997-02-03', 'D061301', '123456'),
('16b1seas3369', 'Temuujin', 'Ya', 'm', '1998-01-01', 'D061302', '123456'),
('16b1seas3372', 'Uzumaki', 'Naruto', 'm', '1998-08-05', 'D061304', '123456'),
('16b1seas3373', 'San', 'Sakura', 'f', '1998-05-06', 'D061303', '123456');

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
-- Indexes for table `courseTakenHistory`
--
ALTER TABLE `courseTakenHistory`
  ADD KEY `FK_courseTakenHistoryStudentID` (`studentID`),
  ADD KEY `FK_courseTakenHistoryCourseIndex` (`courseIndex`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`programIndex`),
  ADD UNIQUE KEY `programIndex` (`programIndex`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD UNIQUE KEY `studentID` (`studentID`),
  ADD KEY `FK_StudentProgramIndex` (`programIndex`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courseTakenHistory`
--
ALTER TABLE `courseTakenHistory`
  ADD CONSTRAINT `FK_courseTakenHistoryCourseIndex` FOREIGN KEY (`courseIndex`) REFERENCES `course` (`courseIndex`),
  ADD CONSTRAINT `FK_courseTakenHistoryStudentID` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_StudentProgramIndex` FOREIGN KEY (`programIndex`) REFERENCES `program` (`programIndex`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
