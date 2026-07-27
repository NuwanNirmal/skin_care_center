-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2026 at 06:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skin_care_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `appointment_no` int(11) DEFAULT NULL,
  `appointment_time` varchar(50) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `age` varchar(10) NOT NULL,
  `appoint_date` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phNo` varchar(20) NOT NULL,
  `diseases` varchar(255) NOT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `appointment_no`, `appointment_time`, `user_id`, `fullName`, `gender`, `age`, `appoint_date`, `email`, `phNo`, `diseases`, `doctor_name`, `address`, `status`, `created_at`, `updated_at`) VALUES
(20, 20260017, '04:00 PM', 6, 'dilani', 'Female', '52', '2026-07-09', 'dilani@gmail.com', '078365458', 'Impetigo', 'Dr. Roshana Wickramage', 'kandy/ampitiya', 'Approved', NULL, NULL),
(21, 20260021, '09:00 AM', 6, 'dulanjana', 'Male', '20', '2026-07-10', 'dulanjana@gmail.com', '07745860', 'warts', 'Dr. Hasitha', 'matale/pallegama', 'Pending', NULL, NULL),
(22, 20260022, '01:00 PM', 6, 'kumara', 'Male', '28', '2026-07-04', 'kumara@gmail.com', '06695354', 'Melasma', 'Dr. Roshana', 'matale/raththota', 'Pending', NULL, NULL),
(23, 20260023, '06:00 PM', 6, 'dulanjana', 'Male', '20', '2026-07-01', 'dulanjana@gmail.com', '07745860', 'warts', 'Dr. Dinithi', 'matale/pallegama', 'Pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `dob` varchar(45) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `specialist` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobNo` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `full_name`, `dob`, `qualification`, `specialist`, `email`, `mobNo`, `password`) VALUES
(2, 'Dr. Melan Silva', '1988-12-05', 'MBBS, Diploma in Skin Care', 'Skin', 'melan@gmail.com', '0771234567', 'melan123'),
(3, 'Dr. Kasuni Fernando', '1999-12-02', 'MBBS, MD (Dermatology)', 'Skin', 'kasuni@gmail.com', '0759876543', 'kasuni123'),
(4, 'Dr. Hasitha Rathnayake', '19982-12-30', 'MBBS, MS (Plastic Surgery)', 'Skin', 'hasitha@gmail.com', '0701122334', 'hasitha123'),
(5, 'Dr. Pasan Gunawardena', '1993-07-09', 'MBBS, Dip. in Laser Surgery', 'Surgeon', 'pasan@gmail.com', '0765544332', 'pasan123'),
(6, 'Dr. Roshana Wickramage', '1987-05-05', 'MBBS, MD (Pediatrics)', 'Skin', 'roshana@gmail.com', '0788877665', 'roshana123'),
(7, 'DR.Dinithi madushika', '1998-04-06', 'MBBS skin care', 'Skin', 'dinithi@gmail.com', '078564321', 'dinithi123');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specialist`
--

CREATE TABLE `specialist` (
  `id` int(11) NOT NULL,
  `specialist_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialist`
--

INSERT INTO `specialist` (`id`, `specialist_name`) VALUES
(1, 'Dinithi'),
(2, 'Melan'),
(3, 'Kasuni'),
(4, 'Hasitha'),
(5, 'Pasan'),
(6, 'Roshana');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(5, 'nuwan', 'nuwan@gmail.com', 'nuwan123', '2026-07-06 10:25:36', '2026-07-06 10:25:36'),
(6, 'dulanjanaa', 'dulanjana@gmail.com', 'dula123', '2026-07-08 06:22:32', '2026-07-08 08:55:57'),
(8, 'kamal kamal', 'kamal@gmail.com', 'kamal', '2026-07-08 10:40:02', '2026-07-08 10:40:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid_idx` (`user_id`),
  ADD KEY `did_idx` (`doctor_name`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specialist`
--
ALTER TABLE `specialist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_appointment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
