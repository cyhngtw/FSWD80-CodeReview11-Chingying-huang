-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 09:31 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_ching_travelmatic`
--
CREATE DATABASE IF NOT EXISTS `cr11_ching_travelmatic` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_ching_travelmatic`;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `tel` int(10) NOT NULL,
  `web` varchar(255) NOT NULL,
  `style` varchar(50) NOT NULL,
  `locdate` datetime NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `type`, `image`, `city`, `zip`, `address`, `tel`, `web`, `style`, `locdate`, `price`) VALUES
(1, 'Le petit jardin', 'restaurant', 'rest1.jpg', 'wien', 1010, 'rathaus 8', 99998888, 'www.petitjardin.at', 'french', '0000-00-00 00:00:00', 0),
(2, 'Gelonojad', 'restaurant', 'rest2.jpg', 'wien', 1010, 'stefanplatz 1', 88887777, 'www.stefanplatz.at', 'medidterrean', '0000-00-00 00:00:00', 0),
(3, 'Scene', 'restaurant', 'rest3.jpg', 'Salzburg', 8020, 'hauptstrasse 8', 7777666, 'www.hauptstrasse.at', 'fusion', '0000-00-00 00:00:00', 0),
(4, 'Hello', 'restaurant', 'rest4.jpg', 'wien', 1060, 'volktheater 8', 66665555, 'www.volktheater.at', 'steakhaus', '0000-00-00 00:00:00', 0),
(5, 'Belvedere', 'sightseeing', 'sight1.jpg', 'wien', 1030, 'belevedere 1', 55554444, 'www.belevedere.at', '', '0000-00-00 00:00:00', 0),
(6, 'Schoenbrunn', 'sightseeing', 'sight2.jpg', 'wien', 1200, 'schoenbrunn 1', 44443333, 'wwww.schoenbrunn.at', '', '0000-00-00 00:00:00', 0),
(7, 'Salzburg', 'sightseeing', 'sight3.jpg', 'salzburg', 8020, 'haupstrasse 1', 33332222, 'www.salzburg.at', '', '0000-00-00 00:00:00', 0),
(8, 'Linz', 'sightseeing', 'sight4.jpg', 'Linz', 4020, 'rathaus platz 1', 22221111, 'wwww.linz.at', '', '0000-00-00 00:00:00', 0),
(9, 'Quartet', 'concert', 'concert1.jpg', 'wien', 1010, 'opering 1', 11110000, 'www.oper.at', 'symphony orchestra', '2019-11-23 14:00:00', 60),
(10, 'Cello solo', 'concert', 'concert2.jpg', 'wien', 1030, 'Lothringerstraße 20', 22223333, 'www.konzerthaus.at', 'cello classical', '2019-12-07 20:00:00', 60),
(11, 'TREVINO, KOZHUKHIN, RETT / LISZT, MAHLER', 'concert', 'concert3.jpg', 'wien', 1030, 'Lothringerstraße 20', 22223333, 'www.konzerthaus.at', 'symphony orchestra', '2020-01-04 20:00:00', 60),
(12, 'Transfigured Night for string orchestra op. 4', 'concert', 'concert4.jpg', 'wien', 1010, 'Musikvereinsplatz 1,', 33334444, 'www.Musikvereins.at', 'piano violin', '2019-11-30 20:00:00', 60);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `role`) VALUES
(1, 'ching', 'c@c.c', '123123', 'admin'),
(2, 'sun', 's@s.s', '123123', 'user'),
(3, 'Hhh', 'h@h.h', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
