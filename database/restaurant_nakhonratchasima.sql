-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 04:23 PM
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
  `cm_report` int(1) NOT NULL COMMENT '0=ไม่ถูกรายงาน,1=ถูกรายงาน',
  `cm_report_reason` varchar(255) DEFAULT NULL COMMENT 'สาเหตุถูกรายงาน',
  `res_id` int(11) NOT NULL COMMENT 'รหัสร้านอาหาร',
  `user_id` int(11) NOT NULL COMMENT 'รหัสผู้ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cm_id`, `cm_text`, `cm_datetime`, `cm_report`, `cm_report_reason`, `res_id`, `user_id`) VALUES
(23, 'อาหารอร่อยมากครับ', '2022-03-26 19:44:16', 0, NULL, 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `fav_id` int(11) NOT NULL COMMENT 'รหัสรายการโปรด',
  `user_id` int(11) NOT NULL COMMENT 'รหัสผู้ใช้งาน',
  `res_id` int(11) NOT NULL COMMENT 'รหัสร้านอาหาร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`fav_id`, `user_id`, `res_id`) VALUES
(13, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `food_types`
--

CREATE TABLE `food_types` (
  `ft_id` int(11) NOT NULL COMMENT 'รหัสประเภทอาหาร',
  `ft_name` varchar(255) NOT NULL COMMENT 'ชื่อประเภทอาหาร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_types`
--

INSERT INTO `food_types` (`ft_id`, `ft_name`) VALUES
(3, 'อาหารไทย'),
(4, 'อาหารอีสาน');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `mn_id` int(11) NOT NULL COMMENT 'รหัสเมนู',
  `mn_name` varchar(255) NOT NULL COMMENT 'ชื่อเมนู',
  `mn_description` text NOT NULL COMMENT 'คำอธิบาย',
  `mn_image` text NOT NULL COMMENT 'ภาพเมนู',
  `mn_price` decimal(10,2) NOT NULL COMMENT 'ราคา',
  `res_id` int(11) NOT NULL COMMENT 'รหัสร้านอาหาร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`mn_id`, `mn_name`, `mn_description`, `mn_image`, `mn_price`, `res_id`) VALUES
(12, 'ยำลูกชื้นปลากรายโบราณ', 'ยำลูกชื้นปลากรายโบราณ', '61ffc0952ad55.jpg', '100.00', 9),
(13, 'ปลาช่อนเผาเกลือ', 'ปลาช่อนเผาเกลือ', '61ffcea3d06b7.jpg', '300.00', 9),
(14, 'ไก่ย่าง', 'ไก่ย่าง', '61ffcea407ab6.jpg', '189.00', 9),
(15, 'Dirty Latte', 'Dirty Latte', '62011862228ae.jpg', '80.00', 10),
(16, 'ข้าวหมูสามชั้นพริกแห้ง ไข่ดาว', 'ข้าวหมูสามชั้นพริกแห้ง ไข่ดาว', '620118622ec2b.jpg', '60.00', 10),
(17, 'เฟรนฟรายชีย กุ๋ยช๋ายทอด', 'เฟรนฟรายชีย กุ๋ยช๋ายทอด', '6201186240bec.jpg', '100.00', 10),
(18, 'ทอดมันปลากราย', 'ทอดมันปลากราย', '6201198287b8d.jpg', '120.00', 11),
(19, 'ต้มยำปลาม้า', 'ต้มยำปลาม้า', '62011982b223a.jpg', '150.00', 11),
(20, 'เนื้อแดดเดียวทอด', 'เนื้อแดดเดียวทอด', '62011982c050b.webp', '130.00', 11);

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
  `res_image` text NOT NULL COMMENT 'รูปภาพร้านอาหาร',
  `res_map` text NOT NULL COMMENT 'แผนที่',
  `res_status` int(1) NOT NULL COMMENT '0=ไม่เผยแพร่,1=เผยแพร่',
  `ft_id` int(11) DEFAULT NULL COMMENT 'รหัสประเภทอาหาร',
  `user_id` int(11) NOT NULL COMMENT 'รหัสผู้ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`res_id`, `res_name`, `res_short_desc`, `res_full_desc`, `res_url`, `res_office_time`, `res_image`, `res_map`, `res_status`, `ft_id`, `user_id`) VALUES
(9, 'บ้านอีสาน นครสวรรค์', '', '', 'https://www.facebook.com/baanesan/', 'ทุกวัน 11.00-23.00 น.', '61ffc09516d52.jpg', '', 1, 4, 1),
(10, 'Cup and away', '', '', 'https://www.facebook.com/cupandawaycafe/', 'จันทร์-พุธ เวลา 07.00 - 18.00 น. , ศุกร์-อาทิตย์ เวลา 07.00-18.00 น.', '62011861e810f.jpg', '', 1, 3, 1),
(11, 'หน้าผา ปลาทอดมัน', '', '', 'https://www.facebook.com/ampbeatbox/', 'ทุกวัน 09.00-21.00 น.', '6201198264a01.jpg', '', 1, 3, 1);

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
(1, 'admin', 'เจ้าหน้าที่', 'ดูแลระบบ', 'admin@gmail.com', 'x123456', 0),
(4, 'test', 'Test', 'Member', 'test@gmail.com', '123456', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cm_id`),
  ADD KEY `res_id` (`res_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `res_id` (`res_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `food_types`
--
ALTER TABLE `food_types`
  ADD PRIMARY KEY (`ft_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`mn_id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `ft_id` (`ft_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคอมเม้น', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการโปรด', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `food_types`
--
ALTER TABLE `food_types`
  MODIFY `ft_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทอาหาร', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `mn_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเมนู', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสร้านอาหาร', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ใช้งาน', AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `restaurants` (`res_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `restaurants` (`res_id`),
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `restaurants` (`res_id`);

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`ft_id`) REFERENCES `food_types` (`ft_id`),
  ADD CONSTRAINT `restaurants_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
