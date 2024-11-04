-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 08:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `common_fee_collection`
--

CREATE TABLE `common_fee_collection` (
  `collection_id` int(11) NOT NULL,
  `display_receipt_id` varchar(50) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `common_fee_collection_headwise`
--

CREATE TABLE `common_fee_collection_headwise` (
  `headwise_id` int(11) NOT NULL,
  `receipt_id` int(11) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `head_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entrymode`
--

CREATE TABLE `entrymode` (
  `entry_mode_id` int(11) NOT NULL,
  `entry_mode_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_trans`
--

CREATE TABLE `financial_trans` (
  `trans_id` int(11) NOT NULL,
  `voucher_no` varchar(50) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `entry_mode_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial_tran_details`
--

CREATE TABLE `financial_tran_details` (
  `detail_id` int(11) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `head_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_table`
--

CREATE TABLE `temp_table` (
  `id` int(250) NOT NULL,
  `sr` int(250) NOT NULL,
  `date` varchar(250) DEFAULT NULL,
  `academic_year` varchar(20) DEFAULT NULL,
  `session` varchar(20) DEFAULT NULL,
  `allotted_category` varchar(50) DEFAULT NULL,
  `voucher_type` varchar(50) DEFAULT NULL,
  `voucher_no` int(11) DEFAULT NULL,
  `roll_no` varchar(50) DEFAULT NULL,
  `admno_unique_id` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `fee_category` varchar(50) DEFAULT NULL,
  `faculty` varchar(50) DEFAULT NULL,
  `program` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `batch` varchar(50) DEFAULT NULL,
  `receipt_no` varchar(50) DEFAULT NULL,
  `fee_head` varchar(50) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `concession_amount` decimal(10,2) DEFAULT NULL,
  `scholarship_amount` decimal(10,2) DEFAULT NULL,
  `reverse_concession_amount` decimal(10,2) DEFAULT NULL,
  `write_off_amount` decimal(10,2) DEFAULT NULL,
  `adjusted_amount` decimal(10,2) DEFAULT NULL,
  `refund_amount` decimal(10,2) DEFAULT NULL,
  `fund_transfer_amount` decimal(10,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `common_fee_collection`
--
ALTER TABLE `common_fee_collection`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `common_fee_collection_headwise`
--
ALTER TABLE `common_fee_collection_headwise`
  ADD PRIMARY KEY (`headwise_id`),
  ADD KEY `receipt_id` (`receipt_id`);

--
-- Indexes for table `entrymode`
--
ALTER TABLE `entrymode`
  ADD PRIMARY KEY (`entry_mode_id`);

--
-- Indexes for table `financial_trans`
--
ALTER TABLE `financial_trans`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `entry_mode_id` (`entry_mode_id`);

--
-- Indexes for table `financial_tran_details`
--
ALTER TABLE `financial_tran_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `trans_id` (`trans_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `temp_table`
--
ALTER TABLE `temp_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `common_fee_collection`
--
ALTER TABLE `common_fee_collection`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `common_fee_collection_headwise`
--
ALTER TABLE `common_fee_collection_headwise`
  MODIFY `headwise_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entrymode`
--
ALTER TABLE `entrymode`
  MODIFY `entry_mode_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial_trans`
--
ALTER TABLE `financial_trans`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `financial_tran_details`
--
ALTER TABLE `financial_tran_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_table`
--
ALTER TABLE `temp_table`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `common_fee_collection_headwise`
--
ALTER TABLE `common_fee_collection_headwise`
  ADD CONSTRAINT `common_fee_collection_headwise_ibfk_1` FOREIGN KEY (`receipt_id`) REFERENCES `common_fee_collection` (`collection_id`);

--
-- Constraints for table `financial_trans`
--
ALTER TABLE `financial_trans`
  ADD CONSTRAINT `financial_trans_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`),
  ADD CONSTRAINT `financial_trans_ibfk_2` FOREIGN KEY (`entry_mode_id`) REFERENCES `entrymode` (`entry_mode_id`);

--
-- Constraints for table `financial_tran_details`
--
ALTER TABLE `financial_tran_details`
  ADD CONSTRAINT `financial_tran_details_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `financial_trans` (`trans_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
