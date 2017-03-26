-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2017 at 02:49 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ict_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblactivity`
--

CREATE TABLE `tblactivity` (
  `ActivityID` int(20) NOT NULL,
  `ActivityName` varchar(50) NOT NULL,
  `ActivityCTR` int(20) NOT NULL,
  `ActivityIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblactivity`
--

INSERT INTO `tblactivity` (`ActivityID`, `ActivityName`, `ActivityCTR`, `ActivityIsActive`) VALUES
(1, 'Educational Tour', 0, 1),
(2, 'Meeting', 0, 1),
(3, 'Testing', 0, 1),
(4, 'Field', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `CategoryID` int(20) NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `CategoryCTR` int(20) NOT NULL,
  `CategoryIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`CategoryID`, `CategoryName`, `CategoryCTR`, `CategoryIsActive`) VALUES
(1, 'Revenue', 0, 1),
(2, 'Non Revenue', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblgroup`
--

CREATE TABLE `tblgroup` (
  `GroupID` int(20) NOT NULL,
  `GroupName` varchar(50) NOT NULL,
  `GroupCTR` int(20) NOT NULL,
  `GroupIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblgroup`
--

INSERT INTO `tblgroup` (`GroupID`, `GroupName`, `GroupCTR`, `GroupIsActive`) VALUES
(1, 'Alpha', 0, 1),
(2, 'SME', 0, 1),
(3, 'PLDT Global', 0, 1),
(4, 'Meralco', 0, 1),
(5, 'Smart Laboratories', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbllocation`
--

CREATE TABLE `tbllocation` (
  `LocationID` int(20) NOT NULL,
  `LocationName` varchar(50) NOT NULL,
  `LocationCTR` int(20) NOT NULL,
  `LocationIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllocation`
--

INSERT INTO `tbllocation` (`LocationID`, `LocationName`, `LocationCTR`, `LocationIsActive`) VALUES
(1, 'Boni', 0, 1),
(2, 'Makati', 0, 1),
(3, 'Baguio', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblreports`
--

CREATE TABLE `tblreports` (
  `ReportID` int(20) NOT NULL,
  `ReportDate` date NOT NULL,
  `ReportLoc` int(20) NOT NULL,
  `ReportGroup` int(20) NOT NULL,
  `ReportCategory` int(20) NOT NULL,
  `ReportClient` varchar(50) NOT NULL,
  `ReportPerson` varchar(50) NOT NULL,
  `ReportActivity` int(20) NOT NULL,
  `ReportIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreports`
--

INSERT INTO `tblreports` (`ReportID`, `ReportDate`, `ReportLoc`, `ReportGroup`, `ReportCategory`, `ReportClient`, `ReportPerson`, `ReportActivity`, `ReportIsActive`) VALUES
(1, '2017-01-27', 1, 1, 1, 'PLDT Alpha Board Meeting', 'Harry Potter', 2, 1),
(4, '2017-01-27', 1, 3, 1, 'PLDT Global Testing', 'Hermione Granger', 3, 1),
(5, '2017-01-30', 1, 2, 2, 'PLDT SME Educ Tour', 'Ron Weasley', 1, 1),
(6, '2017-01-31', 2, 1, 1, 'Global Meeting', 'Albert Einstein', 2, 1),
(7, '2017-01-27', 2, 1, 1, 'saDSA', 'ASDASDA', 3, 1),
(8, '2017-01-29', 3, 2, 2, 'sdSAA', 'SADASDAS', 1, 1),
(9, '0000-00-00', 1, 5, 1, 'saDSADSAD', 'DSSAASDA', 1, 1),
(10, '2016-12-28', 1, 1, 1, 'sda', 'sdasd', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblactivity`
--
ALTER TABLE `tblactivity`
  ADD PRIMARY KEY (`ActivityID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `tblgroup`
--
ALTER TABLE `tblgroup`
  ADD PRIMARY KEY (`GroupID`);

--
-- Indexes for table `tbllocation`
--
ALTER TABLE `tbllocation`
  ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `tblreports`
--
ALTER TABLE `tblreports`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `ReportLocation` (`ReportLoc`,`ReportGroup`,`ReportCategory`,`ReportActivity`),
  ADD KEY `fk_activity_id` (`ReportActivity`),
  ADD KEY `fk_category_id` (`ReportCategory`),
  ADD KEY `fk_group_id` (`ReportGroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblactivity`
--
ALTER TABLE `tblactivity`
  MODIFY `ActivityID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `CategoryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblgroup`
--
ALTER TABLE `tblgroup`
  MODIFY `GroupID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbllocation`
--
ALTER TABLE `tbllocation`
  MODIFY `LocationID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblreports`
--
ALTER TABLE `tblreports`
  MODIFY `ReportID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblreports`
--
ALTER TABLE `tblreports`
  ADD CONSTRAINT `fk_activity_id` FOREIGN KEY (`ReportActivity`) REFERENCES `tblactivity` (`ActivityID`),
  ADD CONSTRAINT `fk_branch_id` FOREIGN KEY (`ReportLoc`) REFERENCES `tbllocation` (`LocationID`),
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`ReportCategory`) REFERENCES `tblcategory` (`CategoryID`),
  ADD CONSTRAINT `fk_group_id` FOREIGN KEY (`ReportGroup`) REFERENCES `tblgroup` (`GroupID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
