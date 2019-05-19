-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2019 at 07:46 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctorserpsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `auth_token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`, `auth_token`) VALUES
(1, 'admin', 'admin', '2019-05-19 15:22:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cashier_user`
--

CREATE TABLE `cashier_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashier_user`
--

INSERT INTO `cashier_user` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'cashier', 'cashier', '2019-05-19 22:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE `patient_info` (
  `id` bigint(20) NOT NULL,
  `patient_prn` bigint(20) NOT NULL,
  `patient_reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `patient_name` varchar(60) NOT NULL,
  `patient_surname` varchar(60) NOT NULL,
  `patient_middle_name` varchar(60) NOT NULL,
  `patient_gender` varchar(12) NOT NULL,
  `patient_age` int(11) NOT NULL,
  `patient_dob` date NOT NULL,
  `patient_mobile_num` bigint(13) NOT NULL,
  `patient_emergency_name` varchar(100) NOT NULL,
  `patient_emergency_num` bigint(13) NOT NULL,
  `patient_email_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_info`
--

INSERT INTO `patient_info` (`id`, `patient_prn`, `patient_reg_date`, `patient_name`, `patient_surname`, `patient_middle_name`, `patient_gender`, `patient_age`, `patient_dob`, `patient_mobile_num`, `patient_emergency_name`, `patient_emergency_num`, `patient_email_id`) VALUES
(21, 1365, '2019-05-19 19:55:30', 'POST', 'MAN', 'TEST', 'MALE', 36, '2012-02-28', 322155225, 'Dummy', 356324632, ''),
(25, 3, '2019-05-19 21:12:52', 'POST', 'MAN', 'TEST', 'MALE', 36, '2012-02-28', 999199999, 'Dummy', 8888818888, 'has@hedd.com'),
(27, 4, '2019-05-19 21:13:18', 'POST', 'MAN', 'TEST', 'FEMALE', 36, '2012-02-28', 999119999, 'Dummy', 8888818188, 'cas@hedd.com'),
(28, 5, '2019-05-19 21:13:51', 'POST', 'MAN', 'TEST', 'FEMALE', 36, '2012-02-28', 999219999, 'Dummy', 8888828188, 'cas@cedd.com'),
(29, 5, '2019-05-19 21:14:19', 'POST', 'MAN', 'PATEL', 'OTHERS', 40, '2012-02-28', 999211999, 'Dummy', 8888821188, 'cas@cbdd.com'),
(30, 9, '2019-05-19 21:14:42', 'PATEL', 'MAN', 'YESY', 'OTHERS', 40, '2012-02-28', 994211999, 'Dummy', 8848821188, 'cas@xbdd.com');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` bigint(20) NOT NULL,
  `patient_prn` bigint(20) NOT NULL,
  `patient_visit_date` datetime NOT NULL,
  `patient_payment_particulars` varchar(1000) DEFAULT NULL,
  `patient_amount_paid` double DEFAULT NULL,
  `patient_amount_balance` double DEFAULT NULL,
  `patient_total_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visit_history`
--

CREATE TABLE `visit_history` (
  `id` bigint(20) NOT NULL,
  `patient_prn` bigint(20) NOT NULL,
  `patient_visit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `patient_diagnosis_details` varchar(3000) DEFAULT NULL,
  `patient_prescription_details` varchar(2000) DEFAULT NULL,
  `patient_amount_paid` double DEFAULT NULL,
  `patient_visit_reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`,`username`),
  ADD UNIQUE KEY `auth_token` (`auth_token`);

--
-- Indexes for table `cashier_user`
--
ALTER TABLE `cashier_user`
  ADD PRIMARY KEY (`id`,`username`);

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD PRIMARY KEY (`id`,`patient_prn`),
  ADD UNIQUE KEY `patient_mobile_num` (`patient_mobile_num`),
  ADD UNIQUE KEY `patient_email_id` (`patient_email_id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`,`patient_prn`);

--
-- Indexes for table `visit_history`
--
ALTER TABLE `visit_history`
  ADD PRIMARY KEY (`id`,`patient_prn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashier_user`
--
ALTER TABLE `cashier_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visit_history`
--
ALTER TABLE `visit_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
