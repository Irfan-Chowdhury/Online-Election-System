-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2019 at 04:38 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_election_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_canditate`
--

CREATE TABLE `tbl_canditate` (
  `canditateId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `voterId` varchar(255) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `commitment` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `electionId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_canditate`
--

INSERT INTO `tbl_canditate` (`canditateId`, `image`, `name`, `gender`, `age`, `country`, `address`, `voterId`, `designation`, `commitment`, `email`, `electionId`) VALUES
(6, 'admin/uploads/41f752091d.png', 'Kawsar Uddin', 'Male', 25, 'Bangladesh', 'Bohoddar Hat', 'C161001', 'CR', 'I want To be a Class Representitive', 'kawsar@fmail.com', '1'),
(7, 'admin/uploads/df0f4243a4.jpg', 'Irfan Chowdhury Fahim', 'Male', 23, 'Bangladesh', 'Muradpur,Panchlaish,Chittagong', 'C161016', 'CR', 'I want to be a CR', 'irfanchowdhury80@gmail.com', '1'),
(8, 'admin/uploads/829aef0731.jpg', 'Arman Ul Alam', 'Male', 26, 'Bangladesh', 'Aturar, Dipu', 'C161015', 'CR', 'testing', 'arman@gmail.com', '1'),
(9, 'admin/uploads/d0b07cfbbc.jpg', 'Raihan Sharif', 'Male', 19, 'Bangladesh', 'Aman Bazar', 'CIU123', 'CR', 'I want to work for all of you.', 'raihan@gmail.com', '1'),
(23, 'admin/uploads/631898a602.jpg', 'Warid Bin Azad', 'Male', 25, 'Bangladesh', 'Chittagong', 'C161008', 'CR', 'I want To be a Class Representitive', 'warid@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `countryId` int(11) NOT NULL,
  `countryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`countryId`, `countryName`) VALUES
(1, 'Bangladesh'),
(2, 'India'),
(3, 'Pakistan'),
(4, 'USA'),
(5, 'England');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designation`
--

CREATE TABLE `tbl_designation` (
  `designationId` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_designation`
--

INSERT INTO `tbl_designation` (`designationId`, `designation`) VALUES
(1, 'CR'),
(2, 'ACR'),
(3, 'General Secretary'),
(4, 'Assistant General Secretary');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_election`
--

CREATE TABLE `tbl_election` (
  `electionId` int(11) NOT NULL,
  `electionName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_election`
--

INSERT INTO `tbl_election` (`electionId`, `electionName`) VALUES
(1, 'Class Representive (CR)'),
(2, 'City Corporation'),
(3, 'Upozella Election'),
(4, 'Minister of Parlament (MP)'),
(6, 'City Corporation (CC)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `address` text NOT NULL,
  `voterId` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `image`, `name`, `gender`, `age`, `address`, `voterId`, `email`, `password`, `status`) VALUES
(1, 'admin/uploads/e47c761da3.jpg', 'Irfan Chowdhury Fahim', 'Male', 25, 'Chittagong', 'C161016', 'irfanchowdhury80@gmail.com', '202cb962ac59075b964b07152d234b70', '1'),
(5, 'admin/uploads/829aef0731.jpg', 'Arman Ul Alam', 'Male', 25, 'Chittagong', 'C161015', 'arman@gmail.com', '202cb962ac59075b964b07152d234b70', '1'),
(6, 'admin/uploads/3a1116c8cf.jpg', 'Shahed Shuzon', 'Male', 23, 'RaouJan', 'C161031', 'shuzon@gmail.com', 'd9b1d7db4cd6e70935368a1efb10e377', '1'),
(8, 'admin/uploads/3fb3872a6d.jpg', 'Anisul Islam', 'Male', 24, 'Sholokbohor', 'C161024', 'anis@gmail.com', '202cb962ac59075b964b07152d234b70', '1'),
(9, 'admin/uploads/941c655d4a.png', 'Kawsar Uddin', 'Male', 21, 'Bohoddar Hat', 'C161001', 'kawsar@fmail.com', '202cb962ac59075b964b07152d234b70', '1'),
(10, 'admin/uploads/d21896fa6b.jpg', 'Raihan Sharif', 'Male', 19, 'Aman Bazar', 'CIU123', 'raihan@gmail.com', '202cb962ac59075b964b07152d234b70', '1'),
(11, 'admin/uploads/f9a959b18d.jpg', 'Pai Nu Mong Marma', 'Male', 20, 'Kawkhali, Chittagong', 'C161099', 'namu@gmail.com', '202cb962ac59075b964b07152d234b70', '1'),
(15, 'admin/uploads/6e2f613174.jpg', 'Warid Bin Azad', 'Male', 25, 'Chittagong', 'C161008', 'warid@gmail.com', '202cb962ac59075b964b07152d234b70', '1'),
(16, 'admin/uploads/7e51ee7c35.jpg', 'Abrar Ibn', 'Male', 26, 'Chittagong', 'C161034', 'abrar@gmail.com', '202cb962ac59075b964b07152d234b70', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vote`
--

CREATE TABLE `tbl_vote` (
  `voteId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `canditateId` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `electionId` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vote`
--

INSERT INTO `tbl_vote` (`voteId`, `userId`, `canditateId`, `votes`, `electionId`, `status`) VALUES
(24, 5, 7, 1, 1, 'enabled'),
(27, 7, 8, 1, 1, 'enabled'),
(31, 8, 8, 1, 1, 'enabled'),
(38, 10, 6, 1, 1, 'enabled'),
(42, 9, 9, 1, 1, 'enabled'),
(45, 1, 8, 1, 1, 'enabled'),
(47, 14, 7, 1, 1, 'enabled'),
(48, 15, 7, 1, 1, 'enabled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_canditate`
--
ALTER TABLE `tbl_canditate`
  ADD PRIMARY KEY (`canditateId`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  ADD PRIMARY KEY (`designationId`);

--
-- Indexes for table `tbl_election`
--
ALTER TABLE `tbl_election`
  ADD PRIMARY KEY (`electionId`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_vote`
--
ALTER TABLE `tbl_vote`
  ADD PRIMARY KEY (`voteId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_canditate`
--
ALTER TABLE `tbl_canditate`
  MODIFY `canditateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_designation`
--
ALTER TABLE `tbl_designation`
  MODIFY `designationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_election`
--
ALTER TABLE `tbl_election`
  MODIFY `electionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_vote`
--
ALTER TABLE `tbl_vote`
  MODIFY `voteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
