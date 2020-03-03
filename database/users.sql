-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2020 at 05:10 PM
-- Server version: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pesona_optima_jasa`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(15) NOT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `update_by` bigint(15) DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `token`, `created_at`, `created_by`, `update_at`, `update_by`, `delete_at`, `role`) VALUES
(1, 'mugi', 'mugypleci@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 08:44:29', 0, NULL, NULL, NULL, 'admin'),
(2, 'mugi', 'mugyplecis@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 03:51:34', 0, NULL, NULL, NULL, ''),
(3, 'mugi', 'mugypleciss@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:30:15', 0, NULL, NULL, NULL, ''),
(4, 'mugi', 'mugyplecissd@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:30:19', 0, NULL, NULL, NULL, ''),
(5, 'mugi', 'mugyplecissda@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:30:22', 0, NULL, NULL, NULL, ''),
(6, 'mugi', 'mugyplecissdaa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:47:02', 0, NULL, NULL, NULL, ''),
(7, 'mugi', 'mugyplecissdaas@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:47:06', 0, NULL, NULL, NULL, ''),
(8, 'mugi', 'mugyplecissdaasa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:47:09', 0, NULL, NULL, NULL, ''),
(9, 'mugi', 'mugyplecissdaasad@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:47:12', 0, NULL, NULL, NULL, ''),
(10, 'mugi', 'mugyplecissdaasada@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:47:16', 0, NULL, NULL, NULL, ''),
(11, 'mugi', 'mugyplecissdaasadas@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:47:30', 0, NULL, NULL, NULL, ''),
(12, 'mugi', 'mugyplecissdaasadasa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:47:34', 0, NULL, NULL, NULL, ''),
(13, 'mugi', 'mugyplecissdaasadasad@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '2020-03-03 09:47:37', 0, NULL, NULL, NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
