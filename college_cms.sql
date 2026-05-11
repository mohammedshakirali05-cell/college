-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 12, 2026 at 05:37 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

DROP TABLE IF EXISTS `login_logs`;
CREATE TABLE IF NOT EXISTS `login_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default-user.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `department`, `avatar_url`) VALUES
(4, 4, 'rajesab', 'mirja', '6363091015', 'bca', NULL),
(5, 5, 'saad', 'mirja', '8095091813', 'bca', NULL),
(7, 7, 'moin', 'mulla', '8951199655', 'developer', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`, `created_at`) VALUES
(1, 'Admin', 'Full system access', '2026-03-10 03:17:49'),
(2, 'Faculty', 'Academic and student management', '2026-03-10 03:17:49'),
(3, 'Student', 'View grades and attendance', '2026-03-10 03:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int NOT NULL,
  `status` enum('active','inactive','suspended') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `email`, `password_hash`, `role_id`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(2, 'adminuuid001', 'admin@college.com', '$2y$10$z7F3Ph7KYKmfUqLASsPCX.K3bld0c73nu8Cdd.pdOpQsAGT5TdNnm', 1, 'active', '2026-03-12 11:05:24', '2026-03-11 07:26:20', '2026-03-12 05:35:24'),
(4, '7dac8e56b22a0f90', 'rajesabmirjanavar7@gmail.com', '$2y$10$Wim.f7koGvlxrN7d5iWLceeCcU16O.sRtRWPxoXeXcme3nGXJvVkG', 2, 'active', '2026-03-11 20:09:17', '2026-03-11 14:35:56', '2026-03-11 14:39:17'),
(5, 'c4140d296ade5562', 'mrsaadmirjanavar@gmail.com', '$2y$10$wir7t5PneCWDLPsVPTPNkOPHaZ6qGtUsxHGoocE.FUdtqMbAt8KUu', 3, 'active', NULL, '2026-03-12 02:05:21', '2026-03-12 02:05:21'),
(7, 'ad10df904acd8f7e', 'tufmoin6646@gmail.com', '$2y$10$MNcANy2duqg2.dFyQTH1wOO5GdmuoiBl/01obEOeDZcL2jLAebp6u', 3, 'active', '2026-03-12 11:00:55', '2026-03-12 05:27:46', '2026-03-12 05:30:55');

-- --------------------------------------------------------
--
-- Table structure for table `admissions`
--

DROP TABLE IF EXISTS `admissions`;
CREATE TABLE IF NOT EXISTS `admissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(32) NOT NULL,
  `admission_number` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `aadhar_number` varchar(20) NOT NULL,
  `puc_institute` varchar(255) NOT NULL,
  `last_attended` varchar(255) NOT NULL,
  `puc_subjects` text NOT NULL,
  `payment_method` enum('none','online','cash') NOT NULL DEFAULT 'none',
  `payment_status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `status` varchar(50) NOT NULL DEFAULT 'payment_in_progress',
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `admission_number` (`admission_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
