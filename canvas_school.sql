-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 05:48 PM
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
-- Database: `canvas_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `user_id`, `password`, `status`) VALUES
(1, 'admin@test.com', '123456', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admission_fees`
--

CREATE TABLE `tb_admission_fees` (
  `id` int(11) NOT NULL,
  `class_id` varchar(255) DEFAULT NULL,
  `sess_id` varchar(255) DEFAULT NULL,
  `fee_amt` varchar(255) DEFAULT NULL,
  `fee_head` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admission_fees`
--

INSERT INTO `tb_admission_fees` (`id`, `class_id`, `sess_id`, `fee_amt`, `fee_head`) VALUES
(1, '1', '2', '3500', 'Admission Charges'),
(2, '1', '2', '1000', 'Activity Charges'),
(3, '1', '2', '4100', 'Kit Charges');

-- --------------------------------------------------------

--
-- Table structure for table `tb_class`
--

CREATE TABLE `tb_class` (
  `id` int(11) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_class`
--

INSERT INTO `tb_class` (`id`, `class`, `status`) VALUES
(1, 'Play Group', '1'),
(2, 'Nursery', '1'),
(3, 'KG', '1'),
(4, 'Prep', '1'),
(5, 'Grade 1', '1'),
(6, 'Grade 2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fees_collected`
--

CREATE TABLE `tb_fees_collected` (
  `id` int(11) NOT NULL,
  `stu_adm_no` varchar(255) DEFAULT NULL,
  `month_id` varchar(255) DEFAULT NULL,
  `class_id` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `tot_fee` varchar(255) DEFAULT NULL,
  `amt_paid` varchar(255) DEFAULT NULL,
  `pay_mode` varchar(255) DEFAULT NULL,
  `bill_id` varchar(255) DEFAULT NULL,
  `cash_amount` varchar(255) DEFAULT NULL,
  `card_amount` varchar(255) DEFAULT NULL,
  `upi_amount` varchar(255) DEFAULT NULL,
  `due_fee` varchar(255) DEFAULT NULL,
  `fee_date` varchar(255) DEFAULT NULL,
  `fee_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_fees_collected`
--

INSERT INTO `tb_fees_collected` (`id`, `stu_adm_no`, `month_id`, `class_id`, `session_id`, `tot_fee`, `amt_paid`, `pay_mode`, `bill_id`, `cash_amount`, `card_amount`, `upi_amount`, `due_fee`, `fee_date`, `fee_type`) VALUES
(1, '123456', '4,5,6', '1', '2', '13100', '13100', 'cash,', 'CANVAS_05001211082024', '13100', '', '', '0', '2021-01-01', 'Admission'),
(2, '123456', '7', '1', '2', '1500', '1000', 'cash,', 'CANVAS_05202611082024', '1000', '', '', '500', '2024-08-29', 'Monthly'),
(3, '123456', '9', '1', '2', '2000', '2000', 'cash,', 'CANVAS_05342511082024', '2000', '', '', '0', '2024-08-28', 'Monthly'),
(4, '123456', '8', '1', '2', '1500', '1500', 'card,', 'CANVAS_05382311082024', '', '1500', '', '0', '2021-01-01', 'Monthly'),
(5, 'hh', '4,5,6', '1', '2', '13100', '13100', 'cash,', 'CANVAS_05395911082024', '13100', '', '', '0', '2021-01-01', 'Admission'),
(7, 'adm_no', '4,5,6', '1', '2', '13100', '13100', 'cash,', 'CANVAS_05480311082024', '13100', '', '', '0', '2024-08-11', 'Admission');

-- --------------------------------------------------------

--
-- Table structure for table `tb_month`
--

CREATE TABLE `tb_month` (
  `id` int(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `days` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_month`
--

INSERT INTO `tb_month` (`id`, `month`, `days`) VALUES
(1, 'January', ''),
(2, 'February', ''),
(3, 'March', ''),
(4, 'April', ''),
(5, 'May', ''),
(6, 'June', ''),
(7, 'July', ''),
(8, 'August', ''),
(9, 'September', ''),
(10, 'October', ''),
(11, 'November', ''),
(12, 'December', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_monthly_fees`
--

CREATE TABLE `tb_monthly_fees` (
  `id` int(11) NOT NULL,
  `class_id` varchar(255) DEFAULT NULL,
  `sess_id` varchar(255) DEFAULT NULL,
  `fee_amt` varchar(255) DEFAULT NULL,
  `fee_head` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_monthly_fees`
--

INSERT INTO `tb_monthly_fees` (`id`, `class_id`, `sess_id`, `fee_amt`, `fee_head`, `month`) VALUES
(1, '1', '2', '1500', 'Tution Fee', '4'),
(2, '1', '2', '1500', 'Tution Fee', '5'),
(3, '1', '2', '1500', 'Tution Fee', '6'),
(4, '1', '2', '1500', 'Tution Fee', '7'),
(5, '1', '2', '1500', 'Tution Fee', '8'),
(6, '1', '2', '1500', 'Tution Fee', '9'),
(7, '1', '2', '1500', 'Tution Fee', '10'),
(8, '1', '2', '1500', 'Tution Fee', '11'),
(9, '1', '2', '1500', 'Tution Fee', '12'),
(10, '1', '2', '1500', 'Tution Fee', '1'),
(11, '1', '2', '1500', 'Tution Fee', '2'),
(12, '1', '2', '1500', 'Tution Fee', '3'),
(13, '1', '1', '1500', 'Tution Fee', '4'),
(14, '1', '1', '1500', 'Tution Fee', '5'),
(15, '1', '1', '1500', 'Tution Fee', '6'),
(16, '1', '1', '1500', 'Tution Fee', '7'),
(17, '1', '1', '1500', 'Tution Fee', '8'),
(18, '1', '1', '1500', 'Tution Fee', '9'),
(19, '1', '1', '1500', 'Tution Fee', '10'),
(20, '1', '1', '1500', 'Tution Fee', '11'),
(21, '1', '1', '1500', 'Tution Fee', '12'),
(22, '1', '1', '1500', 'Tution Fee', '1'),
(23, '1', '1', '1500', 'Tution Fee', '2'),
(24, '1', '1', '1500', 'Tution Fee', '3'),
(25, '1', '2', '0', 'Extras', '4'),
(26, '1', '2', '0', 'Extras', '5'),
(27, '1', '2', '0', 'Extras', '6'),
(28, '1', '2', '0', 'Extras', '7'),
(29, '1', '2', '0', 'Extras', '8'),
(30, '1', '2', '0', 'Extras', '9'),
(31, '1', '2', '0', 'Extras', '10'),
(32, '1', '2', '0', 'Extras', '11'),
(33, '1', '2', '0', 'Extras', '12'),
(34, '1', '2', '0', 'Extras', '1'),
(35, '1', '2', '0', 'Extras', '2'),
(36, '1', '2', '0', 'Extras', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_session`
--

CREATE TABLE `tb_session` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_session`
--

INSERT INTO `tb_session` (`id`, `session`, `status`) VALUES
(1, '2023-2024', 1),
(2, '2024-2025', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_students`
--

CREATE TABLE `tb_students` (
  `id` int(11) NOT NULL,
  `sess_id` varchar(255) DEFAULT NULL,
  `class_id` varchar(255) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `stu_adhar_no` varchar(255) DEFAULT NULL,
  `birth_certi_no` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `father_adhar_no` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mother_adhar_no` varchar(255) DEFAULT NULL,
  `adm_no` varchar(255) DEFAULT NULL,
  `adm_date` varchar(255) DEFAULT NULL,
  `dues_amt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_students`
--

INSERT INTO `tb_students` (`id`, `sess_id`, `class_id`, `student_name`, `stu_adhar_no`, `birth_certi_no`, `father_name`, `father_adhar_no`, `mother_name`, `mother_adhar_no`, `adm_no`, `adm_date`, `dues_amt`) VALUES
(1, '2', '1', 'hhh', 'hhh', 'hh', 'h', 'hh', 'h', 'h', 'hh', '2020-01-01', '0'),
(2, '2', '1', 'Saurabh', 'kjhkjh', 'kjh', 'jkh', 'hk', 'hk', 'hk', '123456', '2020-01-01', '0'),
(3, '2', '1', 'yyy', 'adhar', 'birth', 'father', 'adar', 'mother', 'adhar', 'adm_no', '2021-01-01', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admission_fees`
--
ALTER TABLE `tb_admission_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_class`
--
ALTER TABLE `tb_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_fees_collected`
--
ALTER TABLE `tb_fees_collected`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_month`
--
ALTER TABLE `tb_month`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_monthly_fees`
--
ALTER TABLE `tb_monthly_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_session`
--
ALTER TABLE `tb_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_students`
--
ALTER TABLE `tb_students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_admission_fees`
--
ALTER TABLE `tb_admission_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_class`
--
ALTER TABLE `tb_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_fees_collected`
--
ALTER TABLE `tb_fees_collected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_month`
--
ALTER TABLE `tb_month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_monthly_fees`
--
ALTER TABLE `tb_monthly_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_session`
--
ALTER TABLE `tb_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_students`
--
ALTER TABLE `tb_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
