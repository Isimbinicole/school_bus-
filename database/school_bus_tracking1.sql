-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2022 at 10:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_bus_tracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `admin_names` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_names`, `profile`, `email`, `password`, `status`) VALUES
(1, 'abayo himbaza enock', '', 'abayo.h.enock@gmail.com', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_ID` int(11) NOT NULL,
  `model` varchar(30) NOT NULL,
  `plate_number` varchar(30) NOT NULL,
  `seats` int(10) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_ID`, `model`, `plate_number`, `seats`, `longitude`, `latitude`, `status`) VALUES
(1, 'benz', 'RAF544S', 29, '30.0908544', '-1.96608', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `data_ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `board_time` varchar(30) NOT NULL,
  `arrival_time` varchar(30) NOT NULL,
  `longitude_d` varchar(30) NOT NULL,
  `latitude_d` varchar(30) NOT NULL,
  `driver_ID` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`data_ID`, `student_ID`, `board_time`, `arrival_time`, `longitude_d`, `latitude_d`, `driver_ID`, `status`) VALUES
(25, 2, '1670659346', '1670659446', '30.0908544', '-1.96608', 1, 0),
(26, 1, '1670659434', '1670659446', '30.0908544', '-1.96608', 1, 0),
(27, 1, '1670659493', '1670659515', '30.0908544', '-1.96608', 1, 0),
(28, 2, '1670659498', '1670659509', '30.0908544', '-1.96608', 1, 0),
(29, 2, '1670661277', '1670661302', '30.0908544', '-1.96608', 1, 0),
(30, 1, '1670661285', '1670661298', '30.0908544', '-1.96608', 1, 0),
(31, 1, '1670662058', '1670683899', '30.0908544', '-1.96608', 1, 0),
(32, 2, '1670662066', '1670683893', '30.0908544', '-1.96608', 1, 0),
(33, 2, '1670684037', '1670684917', '30.0908544', '-1.96608', 1, 0),
(34, 1, '1670684143', '1670684924', '30.0908544', '-1.96608', 1, 0),
(35, 2, '1670685020', '1670697822', '30.0908544', '-1.96608', 1, 0),
(36, 1, '1670685030', '1670697829', '30.0908544', '-1.96608', 1, 0),
(37, 2, '1670697925', '1670700446', '30.0908544', '-1.96608', 1, 0),
(38, 1, '1670697964', '1670700454', '30.0908544', '-1.96608', 1, 0),
(39, 2, '1670700474', '', '', '', 1, 1),
(40, 1, '1670700479', '', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_ID` int(11) NOT NULL,
  `driver_names` varchar(100) NOT NULL,
  `driver_NID` varchar(16) NOT NULL,
  `driver_image` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number1` varchar(20) NOT NULL,
  `phone_number2` varchar(20) NOT NULL,
  `bus_ID` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_added` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_ID`, `driver_names`, `driver_NID`, `driver_image`, `email`, `phone_number1`, `phone_number2`, `bus_ID`, `password`, `date_added`, `status`) VALUES
(1, 'ABAYO HIMBAZA ENOCK', '1234567890123456', '8182185776390a537cc1a6.jpg', 'abayoenock@gmail.com', '0786135953', '0786135953', 1, '202cb962ac59075b964b07152d234b70', '1670426478', 1);

-- --------------------------------------------------------

--
-- Table structure for table `legal_guardians`
--

CREATE TABLE `legal_guardians` (
  `g_ID` int(11) NOT NULL,
  `g_names` varchar(100) NOT NULL,
  `g_profile_img` varchar(100) NOT NULL,
  `parent_ID` int(11) NOT NULL,
  `date_added` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `legal_guardians`
--

INSERT INTO `legal_guardians` (`g_ID`, `g_names`, `g_profile_img`, `parent_ID`, `date_added`, `status`) VALUES
(1, 'isimbi', '205693849163947fea26e2b.jpg', 1, '1670426478', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mode`
--

CREATE TABLE `mode` (
  `m_id` int(11) NOT NULL,
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mode`
--

INSERT INTO `mode` (`m_id`, `mode`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parent_ID` int(11) NOT NULL,
  `mothers_names` varchar(100) NOT NULL,
  `fathers_names` varchar(100) NOT NULL,
  `fathers_NID` varchar(16) NOT NULL,
  `mothers_NID` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number1` varchar(13) NOT NULL,
  `phone_number2` varchar(13) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fathers_img` varchar(100) NOT NULL,
  `mothers_img` varchar(100) NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `date_added` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parent_ID`, `mothers_names`, `fathers_names`, `fathers_NID`, `mothers_NID`, `email`, `phone_number1`, `phone_number2`, `password`, `fathers_img`, `mothers_img`, `latitude`, `longitude`, `date_added`, `status`) VALUES
(1, 'isimbi', 'abayo himbaza enock', '1234567890123456', '1234567890123456', 'abayoenock@gmail.com', '0786135953', '0786135953', '202cb962ac59075b964b07152d234b70', '9281950726390a6844c153.jpg', '19643343036390a6844c157.png', '-1.96608', '30.0908544', '1670426478', 1),
(2, 'diane', 'simbi', '1234567890345234', '12345678', 'niyirorad@gmail.com', '0786135953', '0789590910', '202cb962ac59075b964b07152d234b70', '16533809046394d6ec1fa94.jpg', '17762386216394d6ec1fa97.jpg', '', '', '1670698732', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_ID` int(11) NOT NULL,
  `student_names` varchar(100) NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `DOB` varchar(30) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `parent_ID` int(11) NOT NULL,
  `date_added` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_ID`, `student_names`, `profile_image`, `DOB`, `sex`, `card_number`, `parent_ID`, `date_added`, `status`) VALUES
(1, 'iradukunda', '8470072906390a6d944467.jpg', '1670364000', 'Female', 'e793da9a7', 1, '1670426478', 1),
(2, 'isimbi', '181976679639365d06ad2e.png', '1670968800', 'Female', 'aecfe733b5', 1, '1670604240', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_ID`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`data_ID`),
  ADD KEY `driver_ID` (`driver_ID`),
  ADD KEY `student_ID` (`student_ID`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_ID`),
  ADD KEY `bus_ID` (`bus_ID`);

--
-- Indexes for table `legal_guardians`
--
ALTER TABLE `legal_guardians`
  ADD PRIMARY KEY (`g_ID`),
  ADD KEY `parent_ID` (`parent_ID`);

--
-- Indexes for table `mode`
--
ALTER TABLE `mode`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parent_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_ID`),
  ADD KEY `parent_ID` (`parent_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `bus_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `data_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `legal_guardians`
--
ALTER TABLE `legal_guardians`
  MODIFY `g_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mode`
--
ALTER TABLE `mode`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parent_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `data_ibfk_1` FOREIGN KEY (`driver_ID`) REFERENCES `drivers` (`driver_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_ibfk_2` FOREIGN KEY (`student_ID`) REFERENCES `students` (`student_ID`);

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`bus_ID`) REFERENCES `bus` (`bus_ID`);

--
-- Constraints for table `legal_guardians`
--
ALTER TABLE `legal_guardians`
  ADD CONSTRAINT `legal_guardians_ibfk_1` FOREIGN KEY (`parent_ID`) REFERENCES `parents` (`parent_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`parent_ID`) REFERENCES `parents` (`parent_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
