-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2022 at 10:41 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_nakhonratchasima`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cm_id` int(11) NOT NULL COMMENT 'รหัสคอมเม้น',
  `cm_text` text NOT NULL COMMENT 'ข้อความ',
  `cm_datetime` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันเวลาที่คอมเม้น',
  `res_id` int(11) NOT NULL COMMENT 'รหัสร้านอาหาร',
  `user_id` int(11) NOT NULL COMMENT 'รหัสผู้ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `res_id` int(11) NOT NULL COMMENT 'รหัสร้านอาหาร',
  `res_name` varchar(255) NOT NULL COMMENT 'ชื่อร้านอาหาร',
  `res_short_desc` text NOT NULL COMMENT 'คำอธิบายย่อ',
  `res_full_desc` longtext NOT NULL COMMENT 'คำอธิบายเต็ม',
  `res_url` text NOT NULL COMMENT 'ลิ้ง url',
  `res_office_time` text NOT NULL COMMENT 'เวลาทำการ',
  `res_image` text NOT NULL COMMENT 'รูปภาพร้านอาหาร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'รหัสผู้ใช้งาน',
  `user_username` varchar(255) NOT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `user_firstname` varchar(255) NOT NULL COMMENT 'ชื่อจริง',
  `user_lastname` varchar(255) NOT NULL COMMENT 'นามสกุล',
  `user_email` varchar(255) NOT NULL COMMENT 'อีเมล',
  `user_password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน',
  `user_role` int(1) NOT NULL COMMENT '0 = Admin ,1 = Member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_role`) VALUES
(1, 'admin', 'เจ้าหน้าที่', 'ดูแลระบบ', 'admin@gmail.com', 'x123456', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cm_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคอมเม้น';

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสร้านอาหาร';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ใช้งาน', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
