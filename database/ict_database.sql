-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2016 at 03:50 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

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
  `ActivityIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblactivity`
--

INSERT INTO `tblactivity` (`ActivityID`, `ActivityName`, `ActivityIsActive`) VALUES
(1, 'Educational Tour', 1),
(2, 'Meeting', 1),
(3, 'Training', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblbranch`
--

CREATE TABLE `tblbranch` (
  `BranchID` int(20) NOT NULL,
  `BranchName` varchar(50) NOT NULL,
  `BranchIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`BranchID`, `BranchName`, `BranchIsActive`) VALUES
(1, 'Boni', 1),
(2, 'Davao', 1),
(3, 'Clark', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `CategoryID` int(20) NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `CategoryIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`CategoryID`, `CategoryName`, `CategoryIsActive`) VALUES
(1, 'Revenue', 1),
(2, 'Non-Revenue', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblgroup`
--

CREATE TABLE `tblgroup` (
  `GroupID` int(20) NOT NULL,
  `GroupName` varchar(50) NOT NULL,
  `GroupIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblgroup`
--

INSERT INTO `tblgroup` (`GroupID`, `GroupName`, `GroupIsActive`) VALUES
(1, 'PLDT Alpha', 1),
(2, 'PLDT Global', 1),
(3, 'Digitel', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblreports`
--

CREATE TABLE `tblreports` (
  `ReportID` int(20) NOT NULL,
  `ReportDate` date NOT NULL,
  `ReportBranch` int(20) NOT NULL,
  `ReportGroup` int(20) NOT NULL,
  `ReportCategory` int(20) NOT NULL,
  `ReportClient` varchar(50) NOT NULL,
  `ReportPIC` varchar(50) NOT NULL,
  `ReportActivity` int(20) NOT NULL,
  `ReportIsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreports`
--

INSERT INTO `tblreports` (`ReportID`, `ReportDate`, `ReportBranch`, `ReportGroup`, `ReportCategory`, `ReportClient`, `ReportPIC`, `ReportActivity`, `ReportIsActive`) VALUES
(1, '2016-11-27', 1, 2, 1, 'PLDT Alpha Enterprise', 'Camille Escobar', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblactivity`
--
ALTER TABLE `tblactivity`
  ADD PRIMARY KEY (`ActivityID`);

--
-- Indexes for table `tblbranch`
--
ALTER TABLE `tblbranch`
  ADD PRIMARY KEY (`BranchID`);

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
-- Indexes for table `tblreports`
--
ALTER TABLE `tblreports`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `ReportLocation` (`ReportBranch`,`ReportGroup`,`ReportCategory`,`ReportActivity`),
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
  MODIFY `ActivityID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblbranch`
--
ALTER TABLE `tblbranch`
  MODIFY `BranchID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `CategoryID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblgroup`
--
ALTER TABLE `tblgroup`
  MODIFY `GroupID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblreports`
--
ALTER TABLE `tblreports`
  MODIFY `ReportID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblreports`
--
ALTER TABLE `tblreports`
  ADD CONSTRAINT `fk_activity_id` FOREIGN KEY (`ReportActivity`) REFERENCES `tblactivity` (`ActivityID`),
  ADD CONSTRAINT `fk_branch_id` FOREIGN KEY (`ReportBranch`) REFERENCES `tblbranch` (`BranchID`),
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`ReportCategory`) REFERENCES `tblcategory` (`CategoryID`),
  ADD CONSTRAINT `fk_group_id` FOREIGN KEY (`ReportGroup`) REFERENCES `tblgroup` (`GroupID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
