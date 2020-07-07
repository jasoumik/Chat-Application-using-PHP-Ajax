-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2020 at 06:17 PM
-- Server version: 10.3.23-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jasoumik_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_msg`
--

CREATE TABLE `chat_msg` (
  `chat_msg_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_msg` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `chat_msg`
--

INSERT INTO `chat_msg` (`chat_msg_id`, `to_user_id`, `from_user_id`, `chat_msg`, `timestamp`, `status`) VALUES
(61, 0, 1, 'sfdf', '2020-06-21 22:56:34', 2),
(62, 0, 2, 'fgvcvc', '2020-06-21 22:56:41', 1),
(63, 0, 1, 'xz', '2020-06-21 22:57:27', 2),
(64, 0, 3, 'sdsdsd', '2020-06-21 22:57:47', 1),
(65, 0, 1, '<p><img src=\"upload/Vat-1.jpg\" alt=\"\" class=\"img-thumbnail\" width=\"200\" height=\"160\"></p><br>', '2020-06-22 10:49:58', 2),
(66, 2, 1, 'hi', '2020-06-22 11:01:12', 2),
(67, 0, 1, '<p><img src=\"upload/D77_0026.JPG\" alt=\"\" class=\"img-thumbnail\" width=\"200\" height=\"160\"></p><br>', '2020-06-22 11:49:43', 2),
(68, 2, 1, 'hello', '2020-06-22 12:59:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`) VALUES
(1, 'jasoumik', '$2y$10$BTJbuSW.20yydZnrLnvKmuiWOD3iUoj48w69pjRSm0.6A1VUUpUVO'),
(2, 'nobin', '$2y$10$eoYICsHuXIflRR/uRK2uN.17SopLLwhB2lpyKhjyT6z0I//8vdMoq'),
(3, 'shouvick', '$2y$10$rIFn9X1vPL0kCcdd9Robo.dTqe4DGLOaozH/w4JaopeTs20L/fscq');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(28, 2, '2020-06-22 13:00:03', 'yes'),
(29, 1, '2020-06-25 22:06:53', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_msg`
--
ALTER TABLE `chat_msg`
  ADD PRIMARY KEY (`chat_msg_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_msg`
--
ALTER TABLE `chat_msg`
  MODIFY `chat_msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
