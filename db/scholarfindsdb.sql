-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 12:18 PM
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
-- Database: `scholarfindsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `theses`
--

CREATE TABLE `theses` (
  `thesis_id` int(4) NOT NULL,
  `archived` tinytext NOT NULL DEFAULT '0',
  `date` varchar(7) NOT NULL COMMENT 'MM-YYYY',
  `course` varchar(7) NOT NULL COMMENT 'BSXX-XX',
  `title` text NOT NULL,
  `authors` text NOT NULL,
  `abstract` text NOT NULL,
  `keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(4) NOT NULL,
  `access` varchar(10) NOT NULL DEFAULT 'regular' COMMENT 'regular, admin, superadmin',
  `username` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `personalization` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `access`, `username`, `name`, `email`, `password`, `personalization`) VALUES
(1, 'superadmin', 'Renzjan', 'Renzjan Moncinilla', 'renzjan.moncinilla@umak.edu.ph', 'dev01@umak', ''),
(2, 'superadmin', 'Andrei', 'Paul Andrei Valencia', 'paul.valencia@umak.edu.ph', 'dev02@umak', ''),
(3, 'superadmin', 'Dhanica', 'Ma. Dhanica Ballesteros', 'ma.ballesteros@umak.edu.ph', 'dev03@umak', ''),
(4, 'superadmin', 'Lilxianaze', 'Lilxianaze Garcia', 'lilxianaze.garcia@umak.edu.ph', 'dev04@umak', ''),
(5, 'superadmin', 'Superadmin Faculty', 'SA_Faculty', 'SA_Faculty', 'safacul@umak', ''),
(6, 'admin', 'Admin Faculty', 'A_Faculty', 'A_Faculty', 'afacul@umak', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `theses`
--
ALTER TABLE `theses`
  ADD PRIMARY KEY (`thesis_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `theses`
--
ALTER TABLE `theses`
  MODIFY `thesis_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
