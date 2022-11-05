-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2021 at 08:46 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sghospitaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `AppointmentID` varchar(20) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `appointmentdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`AppointmentID`, `PatientID`, `appointmentdate`, `status`) VALUES
('AP-00001', 4, '2021-12-15 07:51:59', 'Confirm Appointment'),
('AP-00002', 4, '2021-12-17 07:28:26', 'Confirm Appointment'),
('AP-00003', 4, '2021-12-16 05:26:32', 'Confirm Appointment'),
('AP-00004', 4, '2021-12-19 16:19:11', 'Appointment'),
('AP-00005', 4, '2021-12-19 16:19:49', 'Appointment'),
('AP-00006', 4, '2021-12-20 05:35:14', 'Appointment'),
('AP-00007', 4, '2021-12-20 05:36:11', 'Appointment');

-- --------------------------------------------------------

--
-- Table structure for table `appointmentdetail`
--

CREATE TABLE `appointmentdetail` (
  `AppointmentID` varchar(30) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `apdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointmentdetail`
--

INSERT INTO `appointmentdetail` (`AppointmentID`, `DoctorID`, `apdate`) VALUES
('AP-00001', 21, '0000-00-00'),
('AP-00002', 18, '0000-00-00'),
('AP-00003', 18, '0000-00-00'),
('AP-00005', 22, '2022-01-03'),
('', 22, '2022-01-03'),
('', 22, '2022-01-03'),
('AP-00007', 18, '2021-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `docregister`
--

CREATE TABLE `docregister` (
  `DoctorID` int(11) NOT NULL,
  `DoctorName` varchar(100) NOT NULL,
  `Dphone` varchar(30) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Email` varchar(75) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Specialities` varchar(100) NOT NULL,
  `Address` text NOT NULL,
  `Image` text NOT NULL,
  `RoomID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docregister`
--

INSERT INTO `docregister` (`DoctorID`, `DoctorName`, `Dphone`, `Gender`, `Email`, `Password`, `Specialities`, `Address`, `Image`, `RoomID`) VALUES
(18, 'Mue', '09267718971', 'Female', '0606@gmail.com', '060606', 'Internist', 'Sanchaung', 'docimage/_muedoc.jpg', 3),
(21, 'Oliver', '09267232452', 'Male', 'john012@gmail.com', '123', 'Heart', 'Yangon', 'docimage/_john.jpg', 3),
(22, 'Kwira', '0978231332', 'Female', 'kwira1998@gmail.com', '518', 'X-Ray', 'Sagaing', 'docimage/_kwira.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `docschedule`
--

CREATE TABLE `docschedule` (
  `ScheduleID` varchar(20) NOT NULL,
  `ScheDate` date NOT NULL,
  `StaffID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docschedule`
--

INSERT INTO `docschedule` (`ScheduleID`, `ScheDate`, `StaffID`) VALUES
('SCHE-00001', '2021-11-06', 1),
('SCHE-00002', '2021-11-06', 1),
('SCHE-00003', '2021-11-06', 1),
('SCHE-00004', '2021-11-06', 1),
('SCHE-00005', '2021-11-06', 1),
('SCHE-00006', '2021-12-14', 3),
('SCHE-00007', '2021-12-14', 3),
('SCHE-00008', '2021-12-17', 1),
('SCHE-00009', '2021-12-19', 1),
('SCHE-00010', '2021-12-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `PatientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `feedback`, `PatientID`) VALUES
(0, 'Good', 4);

-- --------------------------------------------------------

--
-- Table structure for table `patientregister`
--

CREATE TABLE `patientregister` (
  `PatientID` int(11) NOT NULL,
  `pName` varchar(60) NOT NULL,
  `pPhone` varchar(30) NOT NULL,
  `pGender` varchar(20) NOT NULL,
  `Birth` date NOT NULL,
  `pEmail` varchar(50) NOT NULL,
  `pPassword` varchar(30) NOT NULL,
  `pAddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patientregister`
--

INSERT INTO `patientregister` (`PatientID`, `pName`, `pPhone`, `pGender`, `Birth`, `pEmail`, `pPassword`, `pAddress`) VALUES
(3, 'Nadi', '934582234', 'Female', '2003-03-25', '999@gmail.com', '333222', 'Yangon'),
(4, 'May', '092384712', 'Female', '2003-03-25', '0300@gmail.com', '1212', 'Yangon'),
(5, 'Mei', '092348233', 'Female', '2016-02-25', '444@gmail.com', '111', 'Ygn'),
(6, 'Mei', '0934582234', 'Female', '1991-06-12', '111@gmail.com', '111', 'Yangon');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomID` int(11) NOT NULL,
  `RoomType` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomID`, `RoomType`) VALUES
(1, 'Meeting Room'),
(3, 'Office');

-- --------------------------------------------------------

--
-- Table structure for table `schedetail`
--

CREATE TABLE `schedetail` (
  `ScheduleID` varchar(20) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `DutyDate` date NOT NULL,
  `DutyTime` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedetail`
--

INSERT INTO `schedetail` (`ScheduleID`, `DoctorID`, `RoomID`, `DutyDate`, `DutyTime`) VALUES
('SCHE-00005', 21, 1, '2021-11-08', '12 PM to 3 PM'),
('SCHE-00006', 18, 3, '2021-12-21', '3 PM to 6 PM'),
('SCHE-00007', 18, 3, '2021-12-29', '6 PM to 9 PM'),
('SCHE-00007', 21, 3, '2021-12-31', '3 PM to 6 PM'),
('SCHE-00008', 18, 3, '2021-12-18', '3 PM to 6 PM'),
('SCHE-00009', 22, 3, '2022-01-03', '12 PM to 3 PM'),
('SCHE-00010', 18, 1, '2022-01-06', '12 PM to 3 PM');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `StaffName` varchar(50) NOT NULL,
  `SPhone` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(11) NOT NULL,
  `Address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffName`, `SPhone`, `Gender`, `Position`, `Email`, `Password`, `Address`) VALUES
(1, 'Ian', '0978231332', 'Male', 'Staff', 'Ian000@gmail.com', '111', 'Mandalay'),
(3, 'Olivia', '09795337196', 'Female', 'Staff', 'olivia0325@gmail.com', '123', 'Yangon');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `TreatmentID` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `TreatmentDate` date NOT NULL,
  `AppointmentID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`TreatmentID`, `status`, `TreatmentDate`, `AppointmentID`) VALUES
('TRE-00001', 'Treatment Done', '2021-11-08', 'AP-00001'),
('TRE-00002', 'Treatment Done', '2022-01-03', 'AP-00005'),
('TRE-00003', 'Treatment Done', '2021-11-08', 'AP-00001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`AppointmentID`);

--
-- Indexes for table `docregister`
--
ALTER TABLE `docregister`
  ADD PRIMARY KEY (`DoctorID`);

--
-- Indexes for table `docschedule`
--
ALTER TABLE `docschedule`
  ADD PRIMARY KEY (`ScheduleID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`);

--
-- Indexes for table `patientregister`
--
ALTER TABLE `patientregister`
  ADD PRIMARY KEY (`PatientID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `docregister`
--
ALTER TABLE `docregister`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patientregister`
--
ALTER TABLE `patientregister`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
