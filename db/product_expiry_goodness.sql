-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2023 at 02:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_expiry_goodness`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `ID` int(10) NOT NULL,
  `task` varchar(5000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`ID`, `task`) VALUES
(1516, 'Ndueso Okorie Logged In On 2023-04-03 08:43:00'),
(1517, 'Ndueso Okorie Logged In On 2023-05-16 13:49:32'),
(1518, 'Ndueso Okorie Logged In On 2023-07-08 22:29:09'),
(1519, 'Ndueso Okorie Logged In On 2023-07-13 15:35:41'),
(1520, 'Ndueso Walter Logged In On 2023-08-22 15:49:42'),
(1521, 'Ndueso Walter Updated his Photo On 2023-08-22 15:52:54'),
(1522, 'Ndueso Walter Logged In On 2023-08-22 15:53:32'),
(1523, 'Ndueso Walter Okorie Updated his Profile On 2023-08-22 16:01:12'),
(1524, 'Ndueso Walter Deleted Category On 2023-08-22 16:04:01'),
(1525, 'Ndueso Walter Deleted Supplier On 2023-08-22 16:05:35'),
(1526, 'Ndueso Walter Okorie Changed Password On 2023-08-22 16:15:32'),
(1527, 'Ndueso Walter Okorie Logged In On 2023-08-22 16:15:39'),
(1528, 'Ndueso Walter Okorie Logged In On 2023-08-24 12:38:33'),
(1529, 'Ndueso Walter Okorie Deleted Drug On 2023-08-24 14:04:44'),
(1530, 'Ndueso Walter Okorie Deleted Drug On 2023-08-24 14:06:31'),
(1531, 'Ndueso Walter Okorie Deleted Drug On 2023-08-24 14:35:44'),
(1532, 'Ndueso Walter Okorie Updated his Photo On 2023-08-24 15:51:45'),
(1533, 'Ndueso Walter Okorie Updated his Photo On 2023-08-24 15:54:35'),
(1534, 'Goodness Monday Logged In On 2023-08-25 12:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` int(11) NOT NULL,
  `phone2` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `district` varchar(30) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `fullName`, `email`, `mobile`, `phone2`, `address`, `address2`, `city`, `district`, `status`, `createdOn`) VALUES
(43, 'Nneka Chuks', 'nnes_baby@gmail.com', 2147483647, 2147483647, '89 Ukam Rd', '12 Market rd', 'Aba', 'Abia', 'Active', '2023-07-30 20:28:10'),
(44, 'Stella Monday Ekanem', 'steco_2010@gmail.com', 2147483647, 2147483647, '23 Aba rd', '23 Aba rd', 'Ikot Ekpene', 'Akwa Ibom', 'Active', '2023-08-01 08:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `saleID` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `drugName` varchar(255) NOT NULL,
  `saleDate` date NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unitPrice` float(10,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`saleID`, `customerName`, `drugName`, `saleDate`, `quantity`, `unitPrice`) VALUES
(27, 'Nneka Chuks', 'Bosca', '0000-00-00', 10, 231),
(28, 'Stella Monday Ekanem', 'Panadol', '0000-00-00', 12, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(4) NOT NULL,
  `category_name` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `category_name`) VALUES
(1, 'Syrup'),
(3, 'Tablet'),
(4, 'pills');

-- --------------------------------------------------------

--
-- Table structure for table `tblgroup`
--

CREATE TABLE `tblgroup` (
  `ID` int(4) NOT NULL,
  `groupname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblgroup`
--

INSERT INTO `tblgroup` (`ID`, `groupname`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `ID` int(4) NOT NULL,
  `productID` varchar(15) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `category` varchar(45) NOT NULL,
  `expirydate` varchar(25) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `price` varchar(12) NOT NULL,
  `photo` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`ID`, `productID`, `product_name`, `category`, `expirydate`, `qty`, `price`, `photo`) VALUES
(1, '23764', 'Bosca', 'Tablet', '2023-11-03', '111', '231', 'uploadImage/drug.jpeg'),
(2, '23423', 'Panadol', 'Tablet', '2023-08-28', '227', '233', 'uploadImage/home.jpg'),
(3, '908876', 'Paracetamol', 'pills', '2023-08-29', '22', '50', 'uploadImage/logo-banner.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblstock`
--

CREATE TABLE `tblstock` (
  `purchaseID` int(11) NOT NULL,
  `productID` int(12) NOT NULL,
  `stockDate` date NOT NULL,
  `drugName` varchar(255) NOT NULL,
  `unitPrice` float NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstock`
--

INSERT INTO `tblstock` (`purchaseID`, `productID`, `stockDate`, `drugName`, `unitPrice`, `quantity`) VALUES
(63, 23764, '2023-08-24', 'Bosca', 231, 10),
(64, 23423, '2023-08-25', 'Panadol', 233, 110);

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `ID` int(4) NOT NULL,
  `supplier_name` varchar(35) NOT NULL,
  `address` varchar(44) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsupplier`
--

INSERT INTO `tblsupplier` (`ID`, `supplier_name`, `address`) VALUES
(1, 'emmasco drugs', '90 Imek rd'),
(2, 'Orange drugs ltd', '11 Aba rd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(5) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `password` varchar(15) NOT NULL,
  `lastaccess` varchar(30) NOT NULL,
  `last_ip` varchar(30) NOT NULL,
  `groupname` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `status` varchar(1) NOT NULL,
  `photo` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `email`, `fullname`, `password`, `lastaccess`, `last_ip`, `groupname`, `phone`, `status`, `photo`) VALUES
(1, 'newleastpaysolution@gmail.com', 'Goodness Monday', 'escobar2012', '2023-08-25 12:41:43', 'NA', 'Super Admin', '08067361023', '1', 'uploadImage/gr_table_reading.9f6101a1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`saleID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblgroup`
--
ALTER TABLE `tblgroup`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblstock`
--
ALTER TABLE `tblstock`
  ADD PRIMARY KEY (`purchaseID`);

--
-- Indexes for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1535;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `saleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblgroup`
--
ALTER TABLE `tblgroup`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblstock`
--
ALTER TABLE `tblstock`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
