-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2019 at 10:26 AM
-- Server version: 5.6.44
-- PHP Version: 7.2.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uplacein_common_db`
--
CREATE DATABASE IF NOT EXISTS `uplacein_common_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `uplacein_common_db`;

-- --------------------------------------------------------

--
-- Table structure for table `main_db`
--

DROP TABLE IF EXISTS `main_db`;
CREATE TABLE `main_db` (
  `id` int(11) NOT NULL,
  `host_name` varchar(255) NOT NULL,
  `db_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_db`
--

INSERT INTO `main_db` (`id`, `host_name`, `db_name`, `username`, `password`, `modified`) VALUES
(1, 'localhost', 'uplacein_project_2016_01', 'uplacein_admin', 'admin@123', '2017-10-20 10:43:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `main_db`
--
ALTER TABLE `main_db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `main_db`
--
ALTER TABLE `main_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
