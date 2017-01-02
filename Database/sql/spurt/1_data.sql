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

--
-- Dumping data for table `causes`
--

INSERT INTO `causes` (`id`, `name`) VALUES
(1, 'cheetah'),
(2, 'large insertion');

--
-- Dumping data for table `cause_orgasm_link`
--

INSERT INTO `cause_orgasm_link` (`id`, `cause_id`, `orgasm_id`) VALUES
(1, 1, 1),
(2, 2, 1);

--
-- Dumping data for table `orgasms`
--

INSERT INTO `orgasms` (`id`, `user_id`, `datetime`) VALUES
(1, 1, '2016-11-28 17:51:00');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `dataIsPrivate`, `createdDate`, `lastUpdatedDate`) VALUES
(1, 'geusebio', 'matthew@baggett.me', '$2y$10$VjQR8GgI4/mHr9AWEbstJ.hDPMnfRtq8wdk5fs4567oaCkinqykuG', 'Yes', '2016-11-28 17:47:00', '2016-11-28 17:47:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;