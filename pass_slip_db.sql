-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 01:02 PM
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
-- Database: `pass_slip_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pass_slips`
--

CREATE TABLE `pass_slips` (
  `id` int(11) NOT NULL,
  `requester` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `type` enum('Individual','Class') NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `subjectTeacher` varchar(100) NOT NULL,
  `adviser` varchar(100) NOT NULL,
  `csd` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `FormNumber` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usersdb`
--

CREATE TABLE `usersdb` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersdb`
--

INSERT INTO `usersdb` (`id`, `username`, `password`) VALUES
(2, 'belliezebub', 'kalimotko'),
(25, 'teach1', 'teacher1'),
(26, 'teacher2', 'teacher2');

-- --------------------------------------------------------

--
-- Table structure for table `usersprofile`
--

CREATE TABLE `usersprofile` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `batch` varchar(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `profile_picture` varchar(255) DEFAULT 'assets/img/default.png',
  `function` varchar(255) DEFAULT 'Student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersprofile`
--

INSERT INTO `usersprofile` (`id`, `firstname`, `lastname`, `batch`, `section`, `profile_picture`, `function`) VALUES
(2, 'Bellie', 'Jamboy', '32', 'H', 'uploads/pooh.jpg', 'student'),
(25, 'John', 'Doe', '32', 'H', NULL, 'Teacher'),
(26, 'Mark', 'Dela Cruz', '33', 'H', 'assets/img/default.png', 'Teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pass_slips`
--
ALTER TABLE `pass_slips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FormNumber` (`FormNumber`);

--
-- Indexes for table `usersdb`
--
ALTER TABLE `usersdb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `usersprofile`
--
ALTER TABLE `usersprofile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pass_slips`
--
ALTER TABLE `pass_slips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usersprofile`
--
ALTER TABLE `usersprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
