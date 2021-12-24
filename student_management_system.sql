-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2021 at 08:21 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_marks`
--

CREATE TABLE `assignment_marks` (
  `id` int(100) NOT NULL,
  `classno` varchar(100) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `marks` varchar(100) NOT NULL,
  `is_deleted` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_names`
--

CREATE TABLE `assignment_names` (
  `id` int(100) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `is_deleted` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `behaviour`
--

CREATE TABLE `behaviour` (
  `id` int(100) NOT NULL,
  `classno` varchar(100) NOT NULL,
  `behaviour` mediumtext NOT NULL,
  `teacher` varchar(1000) NOT NULL,
  `date` varchar(1000) NOT NULL,
  `is_deleted` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_marks`
--

CREATE TABLE `group_marks` (
  `id` int(100) NOT NULL,
  `classno` varchar(100) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `marks` varchar(100) NOT NULL,
  `average` varchar(100) NOT NULL,
  `rank` varchar(100) NOT NULL,
  `is_deleted` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_names`
--

CREATE TABLE `group_names` (
  `id` int(100) NOT NULL,
  `group_name` varchar(1000) NOT NULL,
  `is_deleted` varchar(1000) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(100) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `content` mediumtext NOT NULL,
  `author` varchar(1000) NOT NULL,
  `sendtime` varchar(1000) NOT NULL,
  `is_deleted` varchar(100) DEFAULT '0',
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sample_usertable`
--

CREATE TABLE `sample_usertable` (
  `id` int(100) NOT NULL,
  `first_name` varchar(1000) NOT NULL,
  `last_name` varchar(1000) NOT NULL,
  `user_type` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `indexno` varchar(1000) NOT NULL,
  `grade` varchar(1000) NOT NULL,
  `class` varchar(1000) NOT NULL,
  `classno` varchar(1000) NOT NULL,
  `pwd` varchar(1000) NOT NULL,
  `is_deleted` varchar(1000) DEFAULT '0',
  `telno` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sample_usertable`
--

INSERT INTO `sample_usertable` (`id`, `first_name`, `last_name`, `user_type`, `email`, `indexno`, `grade`, `class`, `classno`, `pwd`, `is_deleted`, `telno`) VALUES
(1, 'Admin', '-', 'Teacher', 'admin@gmail.com', '51907', '9', '7', '1', '@admin2021', '0', '-');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(100) NOT NULL,
  `user_login` varchar(100) DEFAULT 'Yes',
  `user_exam` varchar(100) DEFAULT 'Yes',
  `user_assignment` varchar(100) DEFAULT 'Yes',
  `user_notice` varchar(100) NOT NULL DEFAULT 'Yes',
  `user_behaviour` varchar(1000) NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_login`, `user_exam`, `user_assignment`, `user_notice`, `user_behaviour`) VALUES
(1, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment_marks`
--
ALTER TABLE `assignment_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_names`
--
ALTER TABLE `assignment_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `behaviour`
--
ALTER TABLE `behaviour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_marks`
--
ALTER TABLE `group_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_names`
--
ALTER TABLE `group_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample_usertable`
--
ALTER TABLE `sample_usertable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment_marks`
--
ALTER TABLE `assignment_marks`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignment_names`
--
ALTER TABLE `assignment_names`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `behaviour`
--
ALTER TABLE `behaviour`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_marks`
--
ALTER TABLE `group_marks`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_names`
--
ALTER TABLE `group_names`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sample_usertable`
--
ALTER TABLE `sample_usertable`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
