-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2020 at 09:27 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kptm_aduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `com_id` varchar(15) NOT NULL,
  `com_about` varchar(15) NOT NULL,
  `com_subject` varchar(30) NOT NULL,
  `com_details` varchar(1005) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `b_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`com_id`, `com_about`, `com_subject`, `com_details`, `c_email`, `b_id`) VALUES
('5e9aab6e0a115', 'Service', 'test', 'test', 'a@yahoo.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `complaint_attachments`
--

CREATE TABLE `complaint_attachments` (
  `coma_id` int(10) NOT NULL,
  `coma_name` varchar(255) NOT NULL,
  `com_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_attachments`
--

INSERT INTO `complaint_attachments` (`coma_id`, `coma_name`, `com_id`) VALUES
(7, 'Image 1.jpg', '5e9aab6e0a115');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_email` varchar(50) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `c_phonenum` varchar(11) NOT NULL,
  `ct_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_email`, `c_name`, `c_phonenum`, `ct_id`) VALUES
('a@yahoo.com', 'test', '0198228418', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `ct_id` int(5) NOT NULL,
  `ct_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`ct_id`, `ct_type`) VALUES
(1, 'Student'),
(2, 'Staff'),
(3, 'Visitor/Outsider');

-- --------------------------------------------------------

--
-- Table structure for table `university_branch`
--

CREATE TABLE `university_branch` (
  `b_id` int(5) NOT NULL,
  `b_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `university_branch`
--

INSERT INTO `university_branch` (`b_id`, `b_name`) VALUES
(1, 'Headquarters'),
(2, 'KUPTM KL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`com_id`),
  ADD UNIQUE KEY `com_id` (`com_id`),
  ADD KEY `c_email` (`c_email`),
  ADD KEY `b_id` (`b_id`);

--
-- Indexes for table `complaint_attachments`
--
ALTER TABLE `complaint_attachments`
  ADD PRIMARY KEY (`coma_id`),
  ADD UNIQUE KEY `coma_id` (`coma_id`),
  ADD KEY `com_id` (`com_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_email`),
  ADD UNIQUE KEY `c_email` (`c_email`),
  ADD KEY `ct_id` (`ct_id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`ct_id`),
  ADD UNIQUE KEY `ct_id` (`ct_id`);

--
-- Indexes for table `university_branch`
--
ALTER TABLE `university_branch`
  ADD PRIMARY KEY (`b_id`),
  ADD UNIQUE KEY `b_id` (`b_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint_attachments`
--
ALTER TABLE `complaint_attachments`
  MODIFY `coma_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
