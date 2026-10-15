-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2026 at 04:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `power_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `account_num` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `consumption_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) DEFAULT 0.00,
  `remaining_amount` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT 'Unpaid',
  `bill_date` date NOT NULL DEFAULT current_timestamp(),
  `period_start` date NOT NULL,
  `period_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `account_num`, `customer_id`, `consumption_id`, `amount`, `paid_amount`, `remaining_amount`, `status`, `bill_date`, `period_start`, `period_end`) VALUES
(54, 'BI-1', 44, 22, 1000.00, 1000.00, 0.00, '1', '2026-10-09', '2026-09-09', '2026-09-28'),
(55, 'BI-2', 49, 26, 15000.00, 15000.00, 0.00, '1', '2026-10-09', '2026-09-09', '2026-10-08'),
(56, 'BI-3', 48, 28, 50000.00, 50000.00, 0.00, '1', '2026-10-09', '2026-09-09', '2026-10-09'),
(57, 'BI-4', 45, 24, 1750.00, 1250.00, 500.00, '0', '2026-10-10', '2026-09-10', '2026-09-29'),
(58, 'BI-5', 44, 29, 4000.00, 1000.00, 3000.00, '0', '2026-10-10', '2026-09-10', '2026-10-10'),
(59, 'BI-6', 46, 27, 12500.00, 500.00, 12000.00, '0', '2026-10-10', '2026-09-10', '2026-10-08'),
(60, 'BI-7', 53, 30, 20000.00, 20000.00, 0.00, '1', '2026-10-12', '2026-09-12', '2026-10-12'),
(61, 'BI-8', 52, 32, 10000.00, 0.00, 10000.00, '0', '2026-10-12', '2026-09-12', '2026-10-12'),
(62, 'BI-9', 51, 33, 75000.00, 0.00, 75000.00, '0', '2026-10-13', '2026-09-13', '2026-10-13');

-- --------------------------------------------------------

--
-- Table structure for table `consumption`
--

CREATE TABLE `consumption` (
  `consumption_id` int(11) NOT NULL,
  `account_number` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `previous_reading` decimal(10,5) NOT NULL,
  `current_reading` decimal(10,5) NOT NULL,
  `consumption_value` decimal(10,5) NOT NULL,
  `statuss` varchar(10) NOT NULL,
  `reading_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumption`
--

INSERT INTO `consumption` (`consumption_id`, `account_number`, `customer_id`, `previous_reading`, `current_reading`, `consumption_value`, `statuss`, `reading_date`) VALUES
(22, 'CN-1', 44, 0.00000, 20.00000, 20.00000, '1', '2026-09-28'),
(24, 'CN-2', 45, 0.00000, 35.00000, 35.00000, '1', '2026-09-29'),
(26, 'CN-4', 49, 0.00000, 100.00000, 100.00000, '1', '2026-10-08'),
(27, 'CN-5', 46, 0.00000, 250.00000, 250.00000, '1', '2026-10-08'),
(28, 'CN-5', 48, 0.00000, 500.00000, 500.00000, '1', '2026-10-09'),
(29, 'CN-6', 44, 20.00000, 100.00000, 80.00000, '1', '2026-10-10'),
(30, 'CN-7', 53, 0.00000, 200.00000, 200.00000, '1', '2026-10-12'),
(32, 'CN-8', 52, 0.00000, 100.00000, 100.00000, '1', '2026-10-12'),
(33, 'CN-9', 51, 0.00000, 500.00000, 500.00000, '1', '2026-10-13'),
(34, 'CN-10', 52, 0.00000, 100.00000, 100.00000, '0', '2026-10-13'),
(35, 'CN-11', 44, 100.00000, 200.00000, 100.00000, '0', '2026-10-13'),
(36, 'CN-12', 48, 500.00000, 700.00000, 200.00000, '0', '2026-10-13'),
(37, 'CN-13', 45, 35.00000, 100.00000, 65.00000, '0', '2026-10-13');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `customer_type` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `Phone` int(20) NOT NULL,
  `Address_details` varchar(200) DEFAULT NULL,
  `statuse` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `account_number`, `name`, `address`, `customer_type`, `created_at`, `Phone`, `Address_details`, `statuse`) VALUES
(44, 'CU-1', 'جبر مسعد', 'الاسدي', 'سكني', '2026-09-28 22:14:04', 2147483647, '', 1),
(45, 'CU-2', 'يوسف الظاهري', 'المواصلات', 'سكني', '2026-09-28 22:14:27', 2147483647, '', 1),
(46, 'CU-3', 'عبدالرحمن الجرادي', 'قاع الجبر', 'سكني', '2026-09-28 22:14:49', 2147483647, 'جوار اسامه', 1),
(47, 'CU-4', 'اسامه المثيل', 'قاع الجبر', 'سكني', '2026-09-28 22:15:13', 2147483647, 'جوار الجرادي', 1),
(48, 'CU-5', 'طه تاج الدين', 'المواصلات', 'تجاري', '2026-10-04 22:48:33', 2147483647, '', 1),
(49, 'CU-6', 'مصنع امزان', 'الدائري', 'صناعي', '2026-10-04 22:49:33', 554466882, 'العكرة', 1),
(50, 'CU-7', 'ادارة الامن', 'المواصلات', 'حكومي', '2026-10-04 22:50:20', 21111111, 'الحرضة', 1),
(51, 'CU-8', 'مخابز البركه', 'الشارع العام', 'صناعي', '2026-10-04 22:53:29', 554477886, '', 1),
(52, 'CU-9', 'الياس احمد', 'شارع عامر', 'تجاري', '2026-10-10 21:59:26', 444444444, 'جوار يوسف', 1),
(53, 'CU-10', 'mohammed', 'عاطف', 'تجاري', '2026-10-12 15:39:50', 2147483647, 'damt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `electricity_rates`
--

CREATE TABLE `electricity_rates` (
  `rate_id` int(11) NOT NULL,
  `customer_type` varchar(20) NOT NULL,
  `price_per_kwh` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `electricity_rates`
--

INSERT INTO `electricity_rates` (`rate_id`, `customer_type`, `price_per_kwh`) VALUES
(10, 'سكني', 50.00),
(11, 'تجاري', 100.00),
(12, 'صناعي', 150.00),
(13, 'حكومي', 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `account_emp` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `job_type` varchar(20) NOT NULL,
  `phone` int(20) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `account_emp`, `name`, `address`, `job_type`, `phone`, `salary`, `created_at`) VALUES
(2, 'E-2', 'يوسف', 'الاسدي', 'فني', 717777733, 90000.00, '2026-09-19 22:39:58'),
(3, 'E-3', 'جبر مسعد', 'قاع الجبر', 'الصيانة', 778899665, 50000.00, '2026-09-19 22:42:11'),
(4, 'EM-3', 'اسامه المثيل', 'قاع الجبر', 'خدمة العملاء', 555555555, 40000.00, '2026-09-28 16:39:50'),
(5, 'EM-4', 'قاسم الخلقي', 'المبياض', 'التحصيل', 774411002, 100000.00, '2026-10-10 22:00:57'),
(6, 'EM-5', 'عبدالرحمن الجرادي', 'عاطف', 'الصيانة', 445566998, 100000.00, '2026-10-13 20:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `logees`
--

CREATE TABLE `logees` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logees`
--

INSERT INTO `logees` (`id`, `name`, `role`, `date`) VALUES
(4, 'يوسف الظاهري', 'اداري', '2026-10-15'),
(5, 'جبر الضحياني', 'موظف', '2026-10-15'),
(6, 'يوسف الظاهري', 'اداري', '2026-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(30) NOT NULL,
  `payment_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `bill_id`, `customer_id`, `amount`, `method`, `payment_date`) VALUES
(24, 54, 44, 500.00, 'نقدًا', '2026-10-09 23:21:54'),
(25, 54, 44, 500.00, 'نقدًا', '2026-10-09 23:24:36'),
(26, 55, 49, 15000.00, 'نقدًا', '2026-10-09 23:27:41'),
(27, 56, 48, 25000.00, 'نقدًا', '2026-10-09 23:33:21'),
(28, 56, 48, 10000.00, 'نقدًا', '2026-10-09 23:33:33'),
(29, 56, 48, 1000.00, 'نقدًا', '2026-10-09 23:34:00'),
(30, 56, 48, 1000.00, 'تحويل بنكي', '2026-10-10 22:18:00'),
(31, 57, 45, 750.00, 'بطاقة', '2026-10-10 22:18:42'),
(32, 58, 44, 1000.00, 'نقدًا', '2026-10-10 22:24:53'),
(33, 59, 46, 500.00, 'تحويل بنكي', '2026-10-10 22:25:17'),
(34, 60, 53, 10000.00, 'نقدًا', '2026-10-12 15:43:40'),
(35, 60, 53, 1000.00, 'نقدًا', '2026-10-12 15:44:08'),
(36, 60, 53, 9000.00, 'نقدًا', '2026-10-12 15:44:49'),
(37, 56, 48, 1000.00, 'نقدًا', '2026-10-12 16:28:06'),
(38, 56, 48, 12000.00, 'نقدًا', '2026-10-12 21:53:55'),
(39, 57, 45, 500.00, 'نقدًا', '2026-10-12 21:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `power_station`
--

CREATE TABLE `power_station` (
  `station_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `capacity_mw` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `power_station`
--

INSERT INTO `power_station` (`station_id`, `name`, `location`, `capacity_mw`) VALUES
(1, 'محطة الشهيد هشام الغرباني', 'دمت', 2.50);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id_User` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `phone` int(20) NOT NULL,
  `data` varchar(200) NOT NULL,
  `profileImge` varchar(200) NOT NULL,
  `typing_user` varchar(200) NOT NULL,
  `permission` int(10) NOT NULL,
  `loginDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id_User`, `Name`, `username`, `pass`, `phone`, `data`, `profileImge`, `typing_user`, `permission`, `loginDate`) VALUES
(4, 'جبر الضحياني', 'J123', 'm456m', 777777778, '2000-01-01', 'موظف', 'C:xampphtdocsmyprojectlevel-power-manager-mainpublicimageo.jpg', 14, '2026-09-25'),
(5, 'يوسف الظاهري', 'admin', '456', 111222333, '2005-01-01', 'اداري', 'C:xampphtdocsmyprojectlevel-power-manager-mainpublicimageo.jpg', -1, '2026-09-25'),
(6, 'قاسم الخلقي', 'q', '789', 777755558, '1950-01-01', 'اداري', 'C:xampphtdocsmyprojectlevel-power-manager-mainpublicimageo.jpg', -1, '2026-09-26'),
(7, 'koko', '456', 'rv', 771144558, '2000-01-01', 'موظف', 'C:xampphtdocsmyprojectlevel-power-manager-mainpublicimagephoto_2026-02-19_22-44-22.jpg', 3, '2026-09-27'),
(8, 'فضل ', 'ff', 'ii', 774411002, '2017-01-01', 'اداري', 'C:xampphtdocsmyprojectlevel-power-manager-mainpublicimagestudent.png', -1, '2026-10-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `consumption_id` (`consumption_id`);

--
-- Indexes for table `consumption`
--
ALTER TABLE `consumption`
  ADD PRIMARY KEY (`consumption_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `account_number` (`account_number`);

--
-- Indexes for table `electricity_rates`
--
ALTER TABLE `electricity_rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `logees`
--
ALTER TABLE `logees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `power_station`
--
ALTER TABLE `power_station`
  ADD PRIMARY KEY (`station_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `consumption`
--
ALTER TABLE `consumption`
  MODIFY `consumption_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `electricity_rates`
--
ALTER TABLE `electricity_rates`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logees`
--
ALTER TABLE `logees`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `power_station`
--
ALTER TABLE `power_station`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`consumption_id`) REFERENCES `consumption` (`consumption_id`);

--
-- Constraints for table `consumption`
--
ALTER TABLE `consumption`
  ADD CONSTRAINT `consumption_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
