-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2020 at 10:16 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azmoon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `lname` text COLLATE utf8_persian_ci NOT NULL,
  `username` text COLLATE utf8_persian_ci NOT NULL,
  `password` text COLLATE utf8_persian_ci NOT NULL,
  `phone` text COLLATE utf8_persian_ci NOT NULL,
  `email` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `lname`, `username`, `password`, `phone`, `email`) VALUES
(1, 'امیرحسین   ', 'حسنی', 'ahhb', 'ahhb56114876', '09140912362', 'amirhosseinhassani@outlook.com');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `date` text COLLATE utf8_persian_ci NOT NULL,
  `time` text COLLATE utf8_persian_ci NOT NULL,
  `num` text COLLATE utf8_persian_ci NOT NULL,
  `t` text COLLATE utf8_persian_ci NOT NULL,
  `s` text COLLATE utf8_persian_ci NOT NULL,
  `username` text COLLATE utf8_persian_ci NOT NULL,
  `code` text COLLATE utf8_persian_ci NOT NULL,
  `end` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `massage`
--

DROP TABLE IF EXISTS `massage`;
CREATE TABLE IF NOT EXISTS `massage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `email` text COLLATE utf8_persian_ci NOT NULL,
  `text` text COLLATE utf8_persian_ci NOT NULL,
  `sh` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qu`
--

DROP TABLE IF EXISTS `qu`;
CREATE TABLE IF NOT EXISTS `qu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` text COLLATE utf8_persian_ci NOT NULL,
  `q` text COLLATE utf8_persian_ci NOT NULL,
  `a` text COLLATE utf8_persian_ci NOT NULL,
  `type` text COLLATE utf8_persian_ci NOT NULL,
  `c` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sh`
--

DROP TABLE IF EXISTS `sh`;
CREATE TABLE IF NOT EXISTS `sh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `lname` text COLLATE utf8_persian_ci NOT NULL,
  `code` text COLLATE utf8_persian_ci NOT NULL,
  `excode` text COLLATE utf8_persian_ci NOT NULL,
  `a` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8_persian_ci NOT NULL,
  `password` text COLLATE utf8_persian_ci NOT NULL,
  `phone` text COLLATE utf8_persian_ci NOT NULL,
  `name` text COLLATE utf8_persian_ci NOT NULL,
  `lname` text COLLATE utf8_persian_ci NOT NULL,
  `info` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
