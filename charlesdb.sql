-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 15, 2026 at 12:16 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charlesdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'superadmin', 'Admin@123'),
(2, 'hr_manager', 'HRPass2026'),
(3, 'exec_user', 'Executive!'),
(4, 'system_op', 'SysOp99'),
(5, 'lead_hr', 'LeadPass44'),
(6, 'admin_one', 'SimplePass1'),
(7, 'admin_two', 'SimplePass2'),
(8, 'security_ref', 'Guard77!'),
(9, 'audit_user', 'Audit#2026'),
(10, 'root_admin', 'PowerUser0');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `status` enum('Passed','Ongoing','Interviewed') DEFAULT 'Ongoing',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `address`, `birthdate`, `department`, `status`, `created_at`) VALUES
(12, 'test', '1@GMAIL.COM', '312412', 'fwfw', '2026-01-07', NULL, 'Passed', '2026-02-15 12:13:00'),
(11, 'test', 'TEST@GMAIL.COM', '312412', '1@GMAIL.COM', '2026-01-07', NULL, 'Interviewed', '2026-02-15 12:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Human Resources'),
(2, 'Finance'),
(3, 'IT Department'),
(4, 'Marketing'),
(5, 'Operations'),
(6, 'Sales'),
(7, 'Customer Support'),
(8, 'Administration'),
(9, 'Research & Development'),
(10, 'Management Council');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'employee',
  `department` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `username`, `full_name`, `email`, `password`, `role`, `department`, `status`, `created_at`) VALUES
(2, 'finance_manager', 'Sarah Miller', 'sarah.m@company.com', 'money123', 'manager', 'Finance', 'active', '2026-01-11 13:29:44'),
(3, 'it_lead', 'David Chen', 'david.c@company.com', 'serverDown!', 'admin', 'IT Support', 'active', '2026-01-11 13:29:44'),
(4, 'recruiter_jane', 'Jane Doe', 'jane.d@company.com', 'hiringNow', 'staff', 'HR', 'active', '2026-01-11 13:29:44'),
(5, 'intern_mike', 'Mike Ross', 'mike.r@company.com', 'coffee2go', 'intern', 'Marketing', 'active', '2026-01-11 13:29:44'),
(6, 'ceo_assist', 'Emily Blunt', 'emily.b@company.com', 'topsecret', 'admin', 'Executive', 'active', '2026-01-11 13:29:44'),
(7, 'warehouse_sup', 'Tom Hardy', 'tom.h@company.com', 'cargoSafe', 'supervisor', 'Logistics', 'active', '2026-01-11 13:29:44'),
(8, 'sales_rep_1', 'Chris Evans', 'chris.e@company.com', 'sellHigh', 'staff', 'Sales', 'active', '2026-01-11 13:29:44'),
(9, 'security_guard', 'Dwayne Johnson', 'rock.j@company.com', 'gymLife', 'security', 'Facilities', 'active', '2026-01-11 13:29:44'),
(10, 'accountant_tim', 'Tim Cook', 'tim.c@company.com', 'excelMaster', 'staff', 'Finance', 'active', '2026-01-11 13:29:44'),
(11, 'receptionist', 'Pam Beesly', 'pam.b@company.com', 'dundermifflin', 'staff', 'Front Desk', 'active', '2026-01-11 13:29:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
