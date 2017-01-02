-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: mysql:3306
-- Generation Time: Nov 28, 2016 at 05:51 PM
-- Server version: 5.7.16
-- PHP Version: 5.6.9-1+deb.sury.org~trusty+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spurt`
--

-- --------------------------------------------------------

--
-- Table structure for table `causes`
--

CREATE TABLE `causes` (
  `id` int(11) NOT NULL,
  `name` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cause_orgasm_link`
--

CREATE TABLE `cause_orgasm_link` (
  `id` int(11) NOT NULL,
  `cause_id` int(11) NOT NULL,
  `orgasm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orgasms`
--

CREATE TABLE `orgasms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` text NOT NULL,
  `dataIsPrivate` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `createdDate` datetime NOT NULL,
  `lastUpdatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `causes`
--
ALTER TABLE `causes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `cause_orgasm_link`
--
ALTER TABLE `cause_orgasm_link`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cause_id` (`cause_id`,`orgasm_id`),
  ADD KEY `cause_orgasm_link_orgasm` (`orgasm_id`);

--
-- Indexes for table `orgasms`
--
ALTER TABLE `orgasms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `causes`
--
ALTER TABLE `causes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cause_orgasm_link`
--
ALTER TABLE `cause_orgasm_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orgasms`
--
ALTER TABLE `orgasms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cause_orgasm_link`
--
ALTER TABLE `cause_orgasm_link`
  ADD CONSTRAINT `cause_orgasm_link_cause` FOREIGN KEY (`cause_id`) REFERENCES `causes` (`id`),
  ADD CONSTRAINT `cause_orgasm_link_orgasm` FOREIGN KEY (`orgasm_id`) REFERENCES `orgasms` (`id`);

--
-- Constraints for table `orgasms`
--
ALTER TABLE `orgasms`
  ADD CONSTRAINT `orgasms_to_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;