-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2019 at 12:09 PM
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
  `date` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `status` varchar(45) DEFAULT NULL,
  `iduser` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'test', 'test2'),
(2, 'test2', 'test2');

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
(1, 'new role', 'state 1');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_privilege`
--

CREATE TABLE `role_has_privilege` (
  `role_idrole` int(11) NOT NULL,
  `privilege_idprivilege` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idcustomer`);

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
  ADD PRIMARY KEY (`role_idrole`,`privilege_idprivilege`),
  ADD KEY `fk_role_has_privilege_privilege1` (`privilege_idprivilege`),
  ADD KEY `fk_role_has_privilege_role` (`role_idrole`);

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
  MODIFY `idcustomer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `idloan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `idloan_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_log`
--
ALTER TABLE `payment_log`
  MODIFY `idpayment_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `idprivilege` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `role_has_privilege`
--
ALTER TABLE `role_has_privilege`
  ADD CONSTRAINT `fk_role_has_privilege_privilege1` FOREIGN KEY (`privilege_idprivilege`) REFERENCES `privilege` (`idprivilege`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_role_has_privilege_role` FOREIGN KEY (`role_idrole`) REFERENCES `role` (`idrole`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
