-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2019 at 05:52 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'R',
  `latt` varchar(50) NOT NULL,
  `lang` varchar(50) NOT NULL,
  `mno` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `oname` varchar(60) DEFAULT NULL,
  `omno` varchar(60) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `url` varchar(60) DEFAULT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `Name`, `type`, `latt`, `lang`, `mno`, `email`, `pass`, `oname`, `omno`, `address`, `url`, `image`) VALUES
(8, 'Rajj', 'R', '12.2225565', '23.2255656', '9824318964', '1234567896', 'Savaj@123', 'Raj', '8980353570', 'Jira', 'Jiraking.tk', '1555088042.png'),
(9, 'Raj', 'res', '12.9582317', '77.7087284', '9824318964', 'savaj7@gmail.com', 'Savaj@123', 'Raj Savaj', '8980353570', 'Savaj@123', 'jiraking.tk', '1555088113.jpg'),
(10, 'Sagar Ngo', 'ngo', '12.9582317', '77.7087284', '8980353570', 'New@gmail.com', '123455', NULL, NULL, '123455', 'jiraking', '1555088175.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
