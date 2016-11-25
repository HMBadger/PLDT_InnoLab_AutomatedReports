-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2016 at 08:18 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_innolab`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblactivity`
--

CREATE TABLE `tblactivity` (
  `Activity_ID` int(20) NOT NULL,
  `Activity_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblactivity`
--

INSERT INTO `tblactivity` (`Activity_ID`, `Activity_Name`) VALUES
(1, 'Tour'),
(2, 'Meeting'),
(3, 'Tourism');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `Categ_ID` int(20) NOT NULL,
  `Categ_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`Categ_ID`, `Categ_Name`) VALUES
(1, 'Revenue'),
(2, 'Non-Revenue');

-- --------------------------------------------------------

--
-- Table structure for table `tblgroup`
--

CREATE TABLE `tblgroup` (
  `Group_ID` int(20) NOT NULL,
  `Group_Vis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblgroup`
--

INSERT INTO `tblgroup` (`Group_ID`, `Group_Vis`) VALUES
(1, 'PLDT Alpha'),
(3, 'PLDT SME Nation');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocation`
--

CREATE TABLE `tbllocation` (
  `Location_ID` int(20) NOT NULL,
  `Location_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllocation`
--

INSERT INTO `tbllocation` (`Location_ID`, `Location_Name`) VALUES
(1, 'Davao'),
(2, 'Makati'),
(3, 'Cebu'),
(4, 'Manila');

-- --------------------------------------------------------

--
-- Table structure for table `tblreport`
--

CREATE TABLE `tblreport` (
  `ReportID` int(10) NOT NULL,
  `ReportDate` date NOT NULL,
  `ReportLoc` int(10) NOT NULL,
  `ReportGroup` int(10) NOT NULL,
  `ReportCateg` int(10) NOT NULL,
  `ReportCName` varchar(50) NOT NULL,
  `ReportPerson` varchar(50) NOT NULL,
  `ReportAct` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreport`
--

INSERT INTO `tblreport` (`ReportID`, `ReportDate`, `ReportLoc`, `ReportGroup`, `ReportCateg`, `ReportCName`, `ReportPerson`, `ReportAct`) VALUES
(1, '2016-11-30', 4, 1, 2, 'Camille', 'Camzie', 1),
(2, '2016-11-30', 1, 1, 1, 'sda', 'uadjksaldas', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblactivity`
--
ALTER TABLE `tblactivity`
  ADD PRIMARY KEY (`Activity_ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`Categ_ID`);

--
-- Indexes for table `tblgroup`
--
ALTER TABLE `tblgroup`
  ADD PRIMARY KEY (`Group_ID`);

--
-- Indexes for table `tbllocation`
--
ALTER TABLE `tbllocation`
  ADD PRIMARY KEY (`Location_ID`);

--
-- Indexes for table `tblreport`
--
ALTER TABLE `tblreport`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `idx_loc_id` (`ReportLoc`),
  ADD KEY `ReportGroup` (`ReportGroup`),
  ADD KEY `ReportCateg` (`ReportCateg`),
  ADD KEY `ReportAct` (`ReportAct`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblactivity`
--
ALTER TABLE `tblactivity`
  MODIFY `Activity_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `Categ_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblgroup`
--
ALTER TABLE `tblgroup`
  MODIFY `Group_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbllocation`
--
ALTER TABLE `tbllocation`
  MODIFY `Location_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblreport`
--
ALTER TABLE `tblreport`
  MODIFY `ReportID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblreport`
--
ALTER TABLE `tblreport`
  ADD CONSTRAINT `fk_act_id` FOREIGN KEY (`ReportAct`) REFERENCES `tblactivity` (`Activity_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cat_id` FOREIGN KEY (`ReportCateg`) REFERENCES `tblcategory` (`Categ_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_grp_id` FOREIGN KEY (`ReportGroup`) REFERENCES `tblgroup` (`Group_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_loc_id` FOREIGN KEY (`ReportLoc`) REFERENCES `tbllocation` (`Location_ID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
