-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 03:11 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `import_csv`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `memberID` int(10) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `adminID` varchar(25) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Reg_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`memberID`, `fullName`, `adminID`, `user_type`, `password`, `Reg_Date`) VALUES
(3, 'Miracle Alao', 'admin@admin.com', 'Admin', '$2y$10$Cceg1NLSR3TMvCdZNg6Yp.KKnh1YPxQ.b65gk2wlsn1mO1PnbXdFu', '2020-11-27 09:53:09'),
(4, 'Miracle Alao', 'ola1@gmail.com', 'NormalUser', '$2y$10$4mUcijTB7sym/cDO9H/fCuJ.hL4iuL.ePBNeFQGE4ceHZ0w09DNEy', '2020-11-29 17:02:00'),
(5, 'Miracle Alao', 'ko@ymail.com', 'Admin', '$2y$10$XFmXlBXkPW2/3A0KeYpYdO1ot1g.fS8TuMKX6qfdN2YSLBijbASjG', '2020-11-29 17:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `banklog`
--

CREATE TABLE `banklog` (
  `BankName` varchar(255) NOT NULL,
  `BankCode` varchar(255) NOT NULL,
  `SortCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banklog`
--

INSERT INTO `banklog` (`BankName`, `BankCode`, `SortCode`) VALUES
('ACCESS BANK', '44', '44150149'),
('ACCESS DIAMOND', '63', '63150269'),
('ECOBANK', '50', '50150311'),
('FBN MORTGAGE', '413', '413150001'),
('FCMB', '214', '214150018'),
('FIDELITY BANK', '70', '70150003'),
('FINATRUST MFB', '608', '608150001'),
('FIRST BANK', '11', '11151003'),
('FSDH MERCHANT BANK LIMITED', '501', '501150000'),
('GLOBUS BANK', '103', '103150001'),
('GTBANK', '58', '58152052'),
('HERITAGE BANK', '30', '30150014'),
('JAIZ BANK', '301', '301080020'),
('JUBILEE LIFE MORTGAGE BANK', '402', '402150001'),
('KEYSTONE BANK', '82', '82150004'),
('NEW PRUDENTIAL BANK', '561', '561150001'),
('CITIBANK', '23', '23150005'),
('POLARIS BANK', '76', '76151006'),
('PROVIDUS BANK', '101', '101150001'),
('RAND MERCHANT BANK', '502', '502150018'),
('SAFETRUST MORTGAGE BANK', '403', '403150001'),
('SEED CAPITAL MFB', '609', '609150001'),
('STANBIC IBTC', '221', '221150014'),
('STANDARD CHARTERED BANK', '68', '68150015'),
('STERLING BANK', '232', '232150016'),
('STERLING MOBILE', '326', '326150001'),
('SUNTRUST BANK', '100', '100150001'),
('TAJ BANK', '302', '302080016'),
('TITAN TRUST BANK LTD', '102', '102150001'),
('UBA', '33', '33150011'),
('UNION BANK', '32', '32154568'),
('UNITY BANK', '215', '215153593'),
('VFD MFB', '566', '566150001'),
('WEMA BANK', '35', '35150103'),
('ZENITH BANK', '57', '57150001');

-- --------------------------------------------------------

--
-- Table structure for table `chairman`
--

CREATE TABLE `chairman` (
  `memberID` int(6) UNSIGNED NOT NULL,
  `clusterCode` varchar(30) NOT NULL,
  `State` varchar(255) NOT NULL,
  `fullName` varchar(30) NOT NULL,
  `phoneNumber` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chairman`
--

INSERT INTO `chairman` (`memberID`, `clusterCode`, `State`, `fullName`, `phoneNumber`, `email`, `password`, `reg_date`) VALUES
(1, '00', '', 'Mike', '14704359637', 'mikexenin@yahoo.cim', '$2y$10$t4k5tdSp1.WA/hFS7/B8AeNaiMPJwizQJDqeo.bsRQIzKpgIQd1Kq', '2020-11-27 08:27:02'),
(2, 'jhlj', '', 'Miracle Alao', '+2348144889589', 'alao@gmail.com', '$2y$10$xaO1IHGFbOlm.whnilNCKO4JWxWNUQL4IK..B7eIjo/1Az1rFQIQO', '2020-11-19 14:32:42'),
(3, 'jhlj', '', 'Miracle Alao', '+2348144889589', 'miraclealao@gmail.com', '$2y$10$w6rfaUh/rjNga/Ai9YJ/rem2oUCYQvjIN/Dc7yMWoa4VZ1Y6APD0q', '2020-11-19 15:35:16'),
(4, '0043', '', 'Alao-Oladipo', '08035737573', 'nikedipo62@gmail.com', '$2y$10$qojLNmlM7QfbGfxptvNlH.UivH/WSKPz7WiGh2gOUFCju8i/6mSC2', '2020-11-19 22:13:07'),
(5, '', '', '', '', 'admin101@admin', '6f5393979d674de36c433b47b7d8908e', '2020-11-20 10:57:50'),
(6, '0012', '', '', '08156606454', 'admin101@admin.com', '$2y$10$nVOjK161cf2WBn6QnOj3VeG/pH3aZSmrOC9KC9U52wsOt4Qukhjq.', '2020-11-20 11:06:50'),
(7, 'admin001', '', 'Administrator', 'admin', 'admin001@admin.com', '$2y$10$WWC4Y1FkfJLW94r1bc1JJOucVkYN.xs7PRLyJAYk2XfpEYbz0XGm6', '2020-11-20 11:11:27'),
(8, 'admin101', '', '', '', 'admin001@admin001.com', '$2y$10$6/rqQarJLQgqGhvtCVB33ugx/j28z4ftmZM91QkmFJTu5P458l0RK', '2020-11-20 12:01:22'),
(9, 'Ade1', '', 'ade1@gmail.com', 'ade1', 'ade1@gmail.com', '$2y$10$8wR4qUWad8IZtaUY4e5gVOxGJEP04yf6CMWtNY8X1sXjEojDu16PW', '2020-11-23 10:14:43'),
(10, 'ola1', 'NIGER state', 'olaoluwa', '08144889589', 'ola@gmail.com', '$2y$10$XD/2DA3ViFxEtEPQ2czrZu1wYUFTSVg00r3OSa56b/5cYj.rw1aWu', '2020-11-23 10:30:51'),
(11, '0081', 'Kwara', 'Alao Miracle', '08144889589', 'mikexenon@yahoo.com', '$2y$10$cDYXZuxRRTXYm1OyKGMmV.mZENlwqNmS9NCZuNm6lWjG/U0AhtC6G', '2020-11-26 16:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(55) NOT NULL,
  `Age` varchar(55) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `BankName` varchar(255) NOT NULL,
  `AccountNumber` varchar(255) NOT NULL,
  `BVN` varchar(255) NOT NULL,
  `clustercode` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `State` varchar(255) NOT NULL,
  `Project` varchar(255) NOT NULL,
  `Amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `chairman`
--
ALTER TABLE `chairman`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `memberID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chairman`
--
ALTER TABLE `chairman`
  MODIFY `memberID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36895;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
