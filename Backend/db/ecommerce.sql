-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2020 at 04:24 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `review` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  `shortDis` text NOT NULL,
  `longDis` text NOT NULL,
  `color` text,
  `size` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `manufacturer` varchar(255) NOT NULL,
  `primaryCategory` varchar(100) NOT NULL,
  `category` text NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `images` text NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `name`, `rating`, `review`, `price`, `shortDis`, `longDis`, `color`, `size`, `quantity`, `manufacturer`, `primaryCategory`, `category`, `thumbnail`, `images`, `tags`) VALUES
(2, 'Lenovo - 510-23ISH', 4, 1200, 849.99, 'Lenovo - 510-23ISH 23 Touch-Screen All-In-One - Intel Core i5 - 8GB Memory - 2TB Hard Drive - Black', 'Lenovo - 510-23ISH 23 Touch-Screen All-In-One - Intel Core i5 - 8GB Memory - 2TB Hard Drive - BlackLenovo - 510-23ISH 23 Touch-Screen All-In-One - Intel Core i5 - 8GB Memory - 2TB Hard Drive - BlackLenovo - 510-23ISH 23 Touch-Screen All-In-One - Intel Core i5 - 8GB Memory - 2TB Hard Drive - BlackLenovo - 510-23ISH 23 Touch-Screen All-In-One - Intel Core i5 - 8GB Memory - 2TB Hard Drive - BlackLenovo - 510-23ISH 23 Touch-Screen All-In-One - Intel Core i5 - 8GB Memory - 2TB Hard Drive - BlackLenovo - 510-23ISH 23 Touch-Screen All-In-One - Intel Core i5 - 8GB Memory - 2TB Hard Drive - Black', 'black,grey,metallic', NULL, 10000, 'Lenovo', 'Electronics', 'Touch-Screen All-in-One Computers,Computers & Accessories,Computer Components,Frys,Electronics,Desktop Barebones,Computers & Tablets,All Desktops,Desktops,Desktop & All-in-One Computers,PC Computers,All-in-One Computers', 'laptop.jpg', 'old-macbook-air_404x580-pc-_200409164428.png,MacBook-Air_1824.webp,Security_MacOS_1139417587.jpg,uninstall-mac.jpg', 'Touch-Screen,Desktops,Tablets'),
(3, 'iPod', 4, 500, 24.99, '128GB iPod touch (Gold) (6th Generation)', 'We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.', 'white,black', NULL, 110, 'Apple', 'Electronics', 'MP3 & MP4 Players,Portable Audio & Video,Electronics,iPod and MP3 Players,TVs Entertainment,Portable Audio,MP3 Players Recorders,Apple iPods,iPod & MP3 Players,iPods Media Players,iPod Touch,iPods,MP3 Players Accessories,Audio', '40ab561bfc00061bf0c1783a057d62fd.jpg', 'old-macbook-air_404x580-pc-_200409164428.png,MacBook-Air_1824.webp,Security_MacOS_1139417587.jpg,uninstall-mac.jpg', 'iPod,Apple'),
(4, 'Boytone Home Theater System', 4, 500, 24.99, 'Boytone - 2500W 2.1-Ch. Home Theater System - Black Diamond', 'We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.', 'white,black', NULL, 5, 'Boytone', 'Electronics', 'Stereos,Portable Bluetooth Speakers,TV, Video & Home Audio,Speaker Systems,Portable Audio & Video,Electronics,See more Black BOYTONE Bt-210f 30 Watt FM Radio Bluetoo...,Speakers,Home Audio & Theater,All Home Speakers,Consumer Electronics,See more BOYTONE Bt-210f Bluetooth Wireless Speaker Mp3...,Home Theater Systems,MP3 Player Accessories,Home Audio,Audio,Cell,Stereo Shelf Systems', '40ab561bfc00061bf0c1783a057d62fd.jpg', 'old-macbook-air_404x580-pc-_200409164428.png,MacBook-Air_1824.webp,Security_MacOS_1139417587.jpg,uninstall-mac.jpg', 'Stereos,Speaker,Portable,Bluetooth'),
(5, 'Samsung Smart - HDTV"', 4, 500, 450.99, 'Samsung - 50 Class (49.5" Diag.) - LED - 1080p - Smart - HDTV"', 'We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.', 'white,black', NULL, 343, 'Samsung', 'Electronics', 'LCD TVs,Samsung TVs,Electronics,Shop TVs by Type,Televisions,TVs Entertainment,TV & Home Theater,TVs by Brand,All Flat-Panel TVs,All TVs,LED & LCD TVs,TVs,TV & Video,Television & Video,LED TVs', '40ab561bfc00061bf0c1783a057d62fd.jpg', 'old-macbook-air_404x580-pc-_200409164428.png,MacBook-Air_1824.webp,Security_MacOS_1139417587.jpg,uninstall-mac.jpg', 'Televisions,LCD,Samsung '),
(6, 'Russound - Acclaim 5', 4, 500, 128.59, 'Russound - Acclaim 5 Series 6-1/2 Indoor/Outdoor Speaker (Each) - White"', 'We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.', 'white,black', NULL, 343, 'Russound', 'Electronics', 'Stereos,Outdoor Speakers,Speaker Systems,Wireless and Bluetooth Speakers,Electronics,Portable Audio,Portable Wireless & Bluetooth Speakers,Home Audio,Speakers,Home Audio & Theater,Audio,Wireless & Portable Bluetooth Speakers', '40ab561bfc00061bf0c1783a057d62fd.jpg', 'old-macbook-air_404x580-pc-_200409164428.png,MacBook-Air_1824.webp,Security_MacOS_1139417587.jpg,uninstall-mac.jpg', 'Stereos,Speakers,Wireless'),
(7, 'iSimple ISBC01', 3, 345, 27.43, 'iSimple ISBC01 BluClik Bluetooth Remote Control with Steering Wheel and Dash Mounts', 'We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.', 'white,black', NULL, 165, 'iSimple', 'Electronics', 'Auto & Tires,Auto Electronics,Auto Accessories,All Auto Accessories,Consumer Electronics,Portable Audio & Headphones,iPod, Audio Player Accessories,Remotes,Vehicle Electronics & GPS,Car Electronics Accessories,Audio/Video Remotes,eBay Motors,Parts & Accessories,Car Electronics,Other Car Audio,Remote Controls,Car Electronics & GPS,Car Installation Parts & Accessories,Bluetooth/Hands-Free Car Kits,Electronics,Frys', '40ab561bfc00061bf0c1783a057d62fd.jpg', 'old-macbook-air_404x580-pc-_200409164428.png,MacBook-Air_1824.webp,Security_MacOS_1139417587.jpg,uninstall-mac.jpg', 'Car Electronics,Accessories'),
(8, 'Sony LBT-GPX555', 3, 345, 488, 'Sony LBT-GPX555 Mini-System with Bluetooth and NFC', 'We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.', '', 0, 1653, 'Sony', 'Electronics', 'Electronics,Home Audio & Theater,Home Theater,Home Theater Systems,Consumer Electronics,Portable Audio & Headphones,iPod, Audio Player Accessories,Audio Docks & Mini Speakers,TVs Entertainment,Tabletop Audio,Mini Hi-Fi Systems,Audio,Home Audio,Stereo Shelf Systems,Frys,Shelf Systems,CD Players,Portable Audio', '40ab561bfc00061bf0c1783a057d62fd.jpg', 'old-macbook-air_404x580-pc-_200409164428.png,MacBook-Air_1824.webp,Security_MacOS_1139417587.jpg,uninstall-mac.jpg', 'Theater,Entertainment'),
(9, 'Sony LBT-GPX555', 3, 345, 488, 'Sony LBT-GPX555 Mini-System with Bluetooth and NFC', 'We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.We can use underscore as wildcard for one character space and use them along with LIKE statement and apply to table columns. For example we want to collect all the account numbers ending with 044 in a five digit account number field. Here is the query for this.', '', NULL, 1653, 'Sony', 'Electronics', 'Electronics,Home Audio & Theater,Home Theater,Home Theater Systems,Consumer Electronics,Portable Audio & Headphones,iPod, Audio Player Accessories,Audio Docks & Mini Speakers,TVs Entertainment,Tabletop Audio,Mini Hi-Fi Systems,Audio,Home Audio,Stereo Shelf Systems,Frys,Shelf Systems,CD Players,Portable Audio', '40ab561bfc00061bf0c1783a057d62fd.jpg', 'old-macbook-air_404x580-pc-_200409164428.png,MacBook-Air_1824.webp,Security_MacOS_1139417587.jpg,uninstall-mac.jpg', 'Theater,Entertainment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
