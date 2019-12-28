-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2019 at 07:07 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samurdhi_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `idcustomer` int(11) NOT NULL,
  `memnumber` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `nic` varchar(45) DEFAULT NULL,
  `address` text NOT NULL,
  `occupation` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idcustomer`, `memnumber`, `name`, `nic`, `address`, `occupation`, `date`, `status`, `is_delete`) VALUES
(25197, 2514655, 'Buddi Hasanka hh', '923054758V', 'Samagi Mawatha, Elpitiya', 'Driver', '2019-03-02', 'Active', 1),
(25198, 12211, 'Buddi Hasanka', '15465446466546v', 'Samagi Mawatha, Elpitiya', 'sdfsdf', '2019-03-11', 'Active', 1),
(25223, 2514656, 'Kushan Pabasara', '921234567V', 'Pituwala', 'Driver', '2019-07-07', 'Active', 1),
(25226, 121212, 'Buddi Hasanka', '923054738V', 'Samagi Mawatha, Elpitiya', 'Driver', '2019-07-12', 'Active', 1),
(25227, 124578, 'Buddi Hasanka', '15465446464546v', 'Samagi Mawatha, Elpitiya', 'Driver', '2019-07-12', 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `idloan` int(11) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `idloan_type` int(11) NOT NULL,
  `interest` double NOT NULL,
  `duration` varchar(45) DEFAULT NULL,
  `amount` double NOT NULL,
  `installment` float DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `iduser` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`idloan`, `idcustomer`, `idloan_type`, `interest`, `duration`, `amount`, `installment`, `status`, `date`, `iduser`, `is_delete`) VALUES
(62, 25198, 1, 12, '10', 500000, NULL, 'Preparing', '2019-08-11', 1, 1),
(63, 25198, 1, 12, '60', 500000, NULL, 'Preparing', '2019-09-05', 1, 1),
(64, 25198, 1, 10, '50', 200000, NULL, 'Preparing', '2019-09-05', 1, 1),
(65, 25198, 1, 12, '60', 500000, NULL, 'Preparing', '2019-09-05', 1, 1),
(66, 25198, 1, 12, '60', 500000, NULL, 'Preparing', '2019-09-05', 1, 1),
(67, 25198, 1, 12, '60', 500000, NULL, 'Preparing', '2019-09-05', 1, 1),
(68, 25198, 1, 12, '60', 500000, 9333.34, 'Preparing', '2019-09-05', 1, 1),
(69, 25198, 1, 12, '60', 1000000, 18666.7, 'Preparing', '2019-09-05', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `idloan_type` int(11) NOT NULL,
  `loan_name` varchar(100) DEFAULT NULL,
  `duration_min` int(11) DEFAULT NULL,
  `duration_max` int(11) DEFAULT NULL,
  `interest_min` float DEFAULT NULL,
  `interest_max` float DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`idloan_type`, `loan_name`, `duration_min`, `duration_max`, `interest_min`, `interest_max`, `status`, `is_delete`) VALUES
(1, 'Housing', 3, 24, 2, 12, 'Active', 1),
(2, 'Test 01', NULL, NULL, NULL, NULL, 'Active', 1),
(3, 'Test 02', NULL, NULL, NULL, NULL, 'Deactive', 1),
(4, 'Test 03', NULL, NULL, NULL, NULL, 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_log`
--

CREATE TABLE `payment_log` (
  `idpayment_log` int(11) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `idloan` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `premium` float DEFAULT NULL,
  `interest` float DEFAULT NULL,
  `penalty` float DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `iduser` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_schedule`
--

CREATE TABLE `payment_schedule` (
  `idpayment_schedule` int(11) NOT NULL,
  `idloan` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `installment_balance` float DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `fine_status` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_schedule`
--

INSERT INTO `payment_schedule` (`idpayment_schedule`, `idloan`, `date`, `installment_balance`, `status`, `fine_status`, `is_delete`) VALUES
(1, 68, '2019-10-05', 9333.34, '0', 0, 0),
(2, 68, '2019-11-05', 9333.34, '0', 0, 0),
(3, 68, '2019-12-05', 9333.34, '0', 0, 0),
(4, 68, '2020-01-05', 9333.34, '0', 0, 0),
(5, 68, '2020-02-05', 9333.34, '0', 0, 0),
(6, 68, '2020-03-05', 9333.34, '0', 0, 0),
(7, 68, '2020-04-05', 9333.34, '0', 0, 0),
(8, 68, '2020-05-05', 9333.34, '0', 0, 0),
(9, 68, '2020-06-05', 9333.34, '0', 0, 0),
(10, 68, '2020-07-05', 9333.34, '0', 0, 0),
(11, 68, '2020-08-05', 9333.34, '0', 0, 0),
(12, 68, '2020-09-05', 9333.34, '0', 0, 0),
(13, 68, '2020-10-05', 9333.34, '0', 0, 0),
(14, 68, '2020-11-05', 9333.34, '0', 0, 0),
(15, 68, '2020-12-05', 9333.34, '0', 0, 0),
(16, 68, '2021-01-05', 9333.34, '0', 0, 0),
(17, 68, '2021-02-05', 9333.34, '0', 0, 0),
(18, 68, '2021-03-05', 9333.34, '0', 0, 0),
(19, 68, '2021-04-05', 9333.34, '0', 0, 0),
(20, 68, '2021-05-05', 9333.34, '0', 0, 0),
(21, 68, '2021-06-05', 9333.34, '0', 0, 0),
(22, 68, '2021-07-05', 9333.34, '0', 0, 0),
(23, 68, '2021-08-05', 9333.34, '0', 0, 0),
(24, 68, '2021-09-05', 9333.34, '0', 0, 0),
(25, 68, '2021-10-05', 9333.34, '0', 0, 0),
(26, 68, '2021-11-05', 9333.34, '0', 0, 0),
(27, 68, '2021-12-05', 9333.34, '0', 0, 0),
(28, 68, '2022-01-05', 9333.34, '0', 0, 0),
(29, 68, '2022-02-05', 9333.34, '0', 0, 0),
(30, 68, '2022-03-05', 9333.34, '0', 0, 0),
(31, 68, '2022-04-05', 9333.34, '0', 0, 0),
(32, 68, '2022-05-05', 9333.34, '0', 0, 0),
(33, 68, '2022-06-05', 9333.34, '0', 0, 0),
(34, 68, '2022-07-05', 9333.34, '0', 0, 0),
(35, 68, '2022-08-05', 9333.34, '0', 0, 0),
(36, 68, '2022-09-05', 9333.34, '0', 0, 0),
(37, 68, '2022-10-05', 9333.34, '0', 0, 0),
(38, 68, '2022-11-05', 9333.34, '0', 0, 0),
(39, 68, '2022-12-05', 9333.34, '0', 0, 0),
(40, 68, '2023-01-05', 9333.34, '0', 0, 0),
(41, 68, '2023-02-05', 9333.34, '0', 0, 0),
(42, 68, '2023-03-05', 9333.34, '0', 0, 0),
(43, 68, '2023-04-05', 9333.34, '0', 0, 0),
(44, 68, '2023-05-05', 9333.34, '0', 0, 0),
(45, 68, '2023-06-05', 9333.34, '0', 0, 0),
(46, 68, '2023-07-05', 9333.34, '0', 0, 0),
(47, 68, '2023-08-05', 9333.34, '0', 0, 0),
(48, 68, '2023-09-05', 9333.34, '0', 0, 0),
(49, 68, '2023-10-05', 9333.34, '0', 0, 0),
(50, 68, '2023-11-05', 9333.34, '0', 0, 0),
(51, 68, '2023-12-05', 9333.34, '0', 0, 0),
(52, 68, '2024-01-05', 9333.34, '0', 0, 0),
(53, 68, '2024-02-05', 9333.34, '0', 0, 0),
(54, 68, '2024-03-05', 9333.34, '0', 0, 0),
(55, 68, '2024-04-05', 9333.34, '0', 0, 0),
(56, 68, '2024-05-05', 9333.34, '0', 0, 0),
(57, 68, '2024-06-05', 9333.34, '0', 0, 0),
(58, 68, '2024-07-05', 9333.34, '0', 0, 0),
(59, 68, '2024-08-05', 9333.34, '0', 0, 0),
(60, 68, '2024-09-05', 9333.34, '0', 0, 0),
(61, 69, '2019-10-05', 18666.7, '0', 0, 0),
(62, 69, '2019-11-05', 18666.7, '0', 0, 0),
(63, 69, '2019-12-05', 18666.7, '0', 0, 0),
(64, 69, '2020-01-05', 18666.7, '0', 0, 0),
(65, 69, '2020-02-05', 18666.7, '0', 0, 0),
(66, 69, '2020-03-05', 18666.7, '0', 0, 0),
(67, 69, '2020-04-05', 18666.7, '0', 0, 0),
(68, 69, '2020-05-05', 18666.7, '0', 0, 0),
(69, 69, '2020-06-05', 18666.7, '0', 0, 0),
(70, 69, '2020-07-05', 18666.7, '0', 0, 0),
(71, 69, '2020-08-05', 18666.7, '0', 0, 0),
(72, 69, '2020-09-05', 18666.7, '0', 0, 0),
(73, 69, '2020-10-05', 18666.7, '0', 0, 0),
(74, 69, '2020-11-05', 18666.7, '0', 0, 0),
(75, 69, '2020-12-05', 18666.7, '0', 0, 0),
(76, 69, '2021-01-05', 18666.7, '0', 0, 0),
(77, 69, '2021-02-05', 18666.7, '0', 0, 0),
(78, 69, '2021-03-05', 18666.7, '0', 0, 0),
(79, 69, '2021-04-05', 18666.7, '0', 0, 0),
(80, 69, '2021-05-05', 18666.7, '0', 0, 0),
(81, 69, '2021-06-05', 18666.7, '0', 0, 0),
(82, 69, '2021-07-05', 18666.7, '0', 0, 0),
(83, 69, '2021-08-05', 18666.7, '0', 0, 0),
(84, 69, '2021-09-05', 18666.7, '0', 0, 0),
(85, 69, '2021-10-05', 18666.7, '0', 0, 0),
(86, 69, '2021-11-05', 18666.7, '0', 0, 0),
(87, 69, '2021-12-05', 18666.7, '0', 0, 0),
(88, 69, '2022-01-05', 18666.7, '0', 0, 0),
(89, 69, '2022-02-05', 18666.7, '0', 0, 0),
(90, 69, '2022-03-05', 18666.7, '0', 0, 0),
(91, 69, '2022-04-05', 18666.7, '0', 0, 0),
(92, 69, '2022-05-05', 18666.7, '0', 0, 0),
(93, 69, '2022-06-05', 18666.7, '0', 0, 0),
(94, 69, '2022-07-05', 18666.7, '0', 0, 0),
(95, 69, '2022-08-05', 18666.7, '0', 0, 0),
(96, 69, '2022-09-05', 18666.7, '0', 0, 0),
(97, 69, '2022-10-05', 18666.7, '0', 0, 0),
(98, 69, '2022-11-05', 18666.7, '0', 0, 0),
(99, 69, '2022-12-05', 18666.7, '0', 0, 0),
(100, 69, '2023-01-05', 18666.7, '0', 0, 0),
(101, 69, '2023-02-05', 18666.7, '0', 0, 0),
(102, 69, '2023-03-05', 18666.7, '0', 0, 0),
(103, 69, '2023-04-05', 18666.7, '0', 0, 0),
(104, 69, '2023-05-05', 18666.7, '0', 0, 0),
(105, 69, '2023-06-05', 18666.7, '0', 0, 0),
(106, 69, '2023-07-05', 18666.7, '0', 0, 0),
(107, 69, '2023-08-05', 18666.7, '0', 0, 0),
(108, 69, '2023-09-05', 18666.7, '0', 0, 0),
(109, 69, '2023-10-05', 18666.7, '0', 0, 0),
(110, 69, '2023-11-05', 18666.7, '0', 0, 0),
(111, 69, '2023-12-05', 18666.7, '0', 0, 0),
(112, 69, '2024-01-05', 18666.7, '0', 0, 0),
(113, 69, '2024-02-05', 18666.7, '0', 0, 0),
(114, 69, '2024-03-05', 18666.7, '0', 0, 0),
(115, 69, '2024-04-05', 18666.7, '0', 0, 0),
(116, 69, '2024-05-05', 18666.7, '0', 0, 0),
(117, 69, '2024-06-05', 18666.7, '0', 0, 0),
(118, 69, '2024-07-05', 18666.7, '0', 0, 0),
(119, 69, '2024-08-05', 18666.7, '0', 0, 0),
(120, 69, '2024-09-05', 18666.7, '0', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `idprivilege` int(11) NOT NULL,
  `privilege` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`idprivilege`, `privilege`, `status`) VALUES
(1, 'test1', 'deactive'),
(2, 'test2', 'test2'),
(3, 'test3', 'active'),
(4, 'test4', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `idrole` int(11) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idrole`, `role`, `status`) VALUES
(1, 'new role', 'state 1'),
(2, 'role 2', 'active'),
(3, 'role 3', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_privilege`
--

CREATE TABLE `role_has_privilege` (
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_has_privilege`
--

INSERT INTO `role_has_privilege` (`role_id`, `privilege_id`) VALUES
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `idrole` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `idrole`, `name`, `password`, `date`, `status`) VALUES
(1, 2, 'root', 'mysqlA', '2019-03-02', 'active'),
(2, 2, 'admin', 'admin', '2019-06-23', 'active'),
(3, 2, 'test admin', '123', '2019-07-06', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idcustomer`),
  ADD UNIQUE KEY `memnumber` (`memnumber`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`idloan`),
  ADD KEY `fk_loan_customer1` (`idcustomer`),
  ADD KEY `fk_loan_loan_type1` (`idloan_type`),
  ADD KEY `fk_loan_user1` (`iduser`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`idloan_type`);

--
-- Indexes for table `payment_log`
--
ALTER TABLE `payment_log`
  ADD PRIMARY KEY (`idpayment_log`),
  ADD KEY `fk_payment_log_customer1` (`idcustomer`),
  ADD KEY `fk_payment_log_loan1` (`idloan`),
  ADD KEY `fk_payment_log_user1` (`iduser`);

--
-- Indexes for table `payment_schedule`
--
ALTER TABLE `payment_schedule`
  ADD PRIMARY KEY (`idpayment_schedule`),
  ADD KEY `fk_payment_schedule_loan1` (`idloan`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`idprivilege`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idrole`);

--
-- Indexes for table `role_has_privilege`
--
ALTER TABLE `role_has_privilege`
  ADD PRIMARY KEY (`role_id`,`privilege_id`),
  ADD KEY `fk_role_has_privilege_privilege1` (`privilege_id`),
  ADD KEY `fk_role_has_privilege_role` (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `fk_user_role1` (`idrole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `idcustomer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25228;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `idloan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `idloan_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_log`
--
ALTER TABLE `payment_log`
  MODIFY `idpayment_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_schedule`
--
ALTER TABLE `payment_schedule`
  MODIFY `idpayment_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `idprivilege` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `fk_loan_customer1` FOREIGN KEY (`idcustomer`) REFERENCES `customer` (`idcustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_loan_loan_type1` FOREIGN KEY (`idloan_type`) REFERENCES `loan_type` (`idloan_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_loan_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_log`
--
ALTER TABLE `payment_log`
  ADD CONSTRAINT `fk_payment_log_customer1` FOREIGN KEY (`idcustomer`) REFERENCES `customer` (`idcustomer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payment_log_loan1` FOREIGN KEY (`idloan`) REFERENCES `loan` (`idloan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payment_log_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_schedule`
--
ALTER TABLE `payment_schedule`
  ADD CONSTRAINT `fk_payment_schedule_loan1` FOREIGN KEY (`idloan`) REFERENCES `loan` (`idloan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role_has_privilege`
--
ALTER TABLE `role_has_privilege`
  ADD CONSTRAINT `fk_role_has_privilege_privilege1` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`idprivilege`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_role_has_privilege_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`idrole`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
