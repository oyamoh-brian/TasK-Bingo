<?php 
 //1 create a db connection
 //
$server="localhost";
$dbuser="oyamo";
$dbpass="imsickandtired";
$dbname="6470";
$conn=mysqli_connect($server,$dbuser,$dbpass);
$sql="CREATE DATABASE IF NOT EXISTS 6470;
-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2019 at 12:43 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = \"+00:00\";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `6470`
--

-- --------------------------------------------------------

--
-- Table structure for table `6470users`
--

CREATE TABLE IF NOT EXISTS `6470users` (
  `ID` int(255) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD_HASH` varchar(500) NOT NULL,
  `PHONE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(255) NOT NULL,
  `title` varchar(101) NOT NULL,
  `start` int(70) NOT NULL,
  `end` int(70) NOT NULL,
  `USERNAME` varchar(700) NOT NULL,
  `completed` text NOT NULL,
  `comment` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `6470users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `6470users`
--
ALTER TABLE `6470users`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
		

					";
mysqli_query($conn,$sql);
mysqli_select_db($conn,$dbname);



// if(!$conn){
// 	//if conn failed kill the script
// 	die("Connection failed".mysqli_connect_error());
// }
#echo "<b>Connection Successfull</b>";

 ?>

