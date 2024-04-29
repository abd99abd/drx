-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2024 at 09:39 PM
-- Server version: 5.7.17-log
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `username1` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `disabled` int(11) NOT NULL,
  `wrong_logins` int(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `username1`, `password`, `Email`, `telephone`, `disabled`, `wrong_logins`) VALUES
(5, 'doctor', '$2y$10$dTlyGDXpIe.DttfrQu7Nh.G9VV5RiDBxmqQLCWIk571ThtOIvRYey', 'dr1@gmail.com', '07800000000', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(400) CHARACTER SET utf8 NOT NULL,
  `id_p` int(11) NOT NULL,
  `date` varchar(333) CHARACTER SET utf8 NOT NULL,
  `title` varchar(333) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `id_p`, `date`, `title`) VALUES
(2, 'images/835259.jpg', 1, '2024-04-12 22:14:48', 'اشعة');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `ID_P` int(11) NOT NULL,
  `Name` varchar(333) CHARACTER SET utf8 NOT NULL,
  `Age` varchar(333) CHARACTER SET utf8 NOT NULL,
  `Mobile` varchar(333) CHARACTER SET utf8 NOT NULL,
  `Date` varchar(333) CHARACTER SET utf8 NOT NULL,
  `cc_t` text CHARACTER SET utf8 NOT NULL,
  `investigation_t` text CHARACTER SET utf8 NOT NULL,
  `diagnises_t` text CHARACTER SET utf8 NOT NULL,
  `gender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`ID_P`, `Name`, `Age`, `Mobile`, `Date`, `cc_t`, `investigation_t`, `diagnises_t`, `gender`) VALUES
(1, 'اسم ثلاثي للتجربة', '28', '07800000000', '2024-04-11 08:12:02', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pharmaceutical`
--

CREATE TABLE `pharmaceutical` (
  `id` int(11) NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 NOT NULL,
  `origin` varchar(300) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmaceutical`
--

INSERT INTO `pharmaceutical` (`id`, `name`, `origin`) VALUES
(4, 'فولام', 'سعودي'),
(5, 'براسيتول', 'عراقي'),
(6, 'دولبرام', 'الماني'),
(7, 'اوموكسيلين', 'عراقي');

-- --------------------------------------------------------

--
-- Table structure for table `pharmaceutical_patients`
--

CREATE TABLE `pharmaceutical_patients` (
  `id` int(11) NOT NULL,
  `name` varchar(333) CHARACTER SET utf8 NOT NULL,
  `ammount` varchar(333) CHARACTER SET utf8 NOT NULL,
  `times_t` varchar(333) CHARACTER SET utf8 NOT NULL,
  `timing_t` varchar(333) CHARACTER SET utf8 NOT NULL,
  `origin` varchar(333) CHARACTER SET utf8 NOT NULL,
  `id_p` int(11) NOT NULL,
  `date` varchar(333) CHARACTER SET utf8 NOT NULL,
  `notice` text CHARACTER SET utf8 NOT NULL,
  `id_pres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmaceutical_patients`
--

INSERT INTO `pharmaceutical_patients` (`id`, `name`, `ammount`, `times_t`, `timing_t`, `origin`, `id_p`, `date`, `notice`, `id_pres`) VALUES
(1, 'دولبرام', '22', '21', 'ليلاً', 'الماني', 1, '2024/04/11 08:13', '', 1),
(2, 'براسيتول', '2', '21', 'ليلاً', 'عراقي', 1, '2024/04/11 08:13', '', 1),
(3, 'اوموكسيلين', '22', '21', 'ليلاً', 'عراقي', 1, '2024/04/12 22:21', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `id` int(11) NOT NULL,
  `username2` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `disabled` int(11) NOT NULL,
  `wrong_logins` int(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`id`, `username2`, `password`, `Email`, `telephone`, `disabled`, `wrong_logins`) VALUES
(5, 'pharmcy', '$2y$10$dTlyGDXpIe.DttfrQu7Nh.G9VV5RiDBxmqQLCWIk571ThtOIvRYey', 'ph1@gmail.com', '07811111111', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id_Pre` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `date` varchar(333) CHARACTER SET utf8 NOT NULL,
  `checked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id_Pre`, `id_p`, `date`, `checked`) VALUES
(1, 1, '2024/04/11 08:13', 1),
(2, 1, '2024/04/12 22:20', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID_P`);

--
-- Indexes for table `pharmaceutical`
--
ALTER TABLE `pharmaceutical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmaceutical_patients`
--
ALTER TABLE `pharmaceutical_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id_Pre`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `ID_P` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pharmaceutical`
--
ALTER TABLE `pharmaceutical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pharmaceutical_patients`
--
ALTER TABLE `pharmaceutical_patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id_Pre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
