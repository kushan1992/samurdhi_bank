-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2019 at 10:42 AM
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
  `date` datetime DEFAULT NULL,
  `iduser` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`idloan`, `idcustomer`, `idloan_type`, `interest`, `duration`, `amount`, `installment`, `status`, `date`, `iduser`, `is_delete`) VALUES
(84, 25226, 1, 12, '60', 500000, 8333.34, 'Active', '2019-01-31 00:00:00', 1, 0),
(85, 25226, 1, 12, '60', 500000, 8333.34, 'Active', '2019-05-21 00:00:00', 1, 0),
(86, 25226, 1, 12, '60', 300000, 5000, 'Active', '2019-11-03 14:25:42', 1, 0);

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
  `idloan` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `premium` float DEFAULT NULL,
  `interest` float DEFAULT NULL,
  `penalty` float DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `iduser` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_log`
--

INSERT INTO `payment_log` (`idpayment_log`, `idloan`, `date`, `premium`, `interest`, `penalty`, `status`, `iduser`, `is_delete`) VALUES
(22, 84, '2019-02-28', 10000, 4602.74, 0, NULL, 1, 0),
(23, 84, '2019-04-10', 18500, 6666.98, 563.47, NULL, 1, 0),
(24, 85, '2019-10-27', 30000, 26137, 2083.34, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_schedule`
--

CREATE TABLE `payment_schedule` (
  `idpayment_schedule` int(11) NOT NULL,
  `idloan` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `installment_balance` float DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `fine_status` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_schedule`
--

INSERT INTO `payment_schedule` (`idpayment_schedule`, `idloan`, `date`, `installment_balance`, `status`, `fine_status`, `is_delete`) VALUES
(516, 84, '2019-02-28 00:00:00', 0, '1', 1, 0),
(517, 84, '2019-03-31 00:00:00', 0, '1', 1, 0),
(518, 84, '2019-04-30 00:00:00', 8333.21, '0', 0, 0),
(519, 84, '2019-05-31 00:00:00', 8333.34, '0', 0, 0),
(520, 84, '2019-06-30 00:00:00', 8333.34, '0', 0, 0),
(521, 84, '2019-07-31 00:00:00', 8333.34, '0', 0, 0),
(522, 84, '2019-08-31 00:00:00', 8333.34, '0', 0, 0),
(523, 84, '2019-09-30 00:00:00', 8333.34, '0', 0, 0),
(524, 84, '2019-10-31 00:00:00', 8333.34, '0', 0, 0),
(525, 84, '2019-11-30 00:00:00', 8333.34, '0', 0, 0),
(526, 84, '2019-12-31 00:00:00', 8333.34, '0', 0, 0),
(527, 84, '2020-01-31 00:00:00', 8333.34, '0', 0, 0),
(528, 84, '2020-02-29 00:00:00', 8333.34, '0', 0, 0),
(529, 84, '2020-03-31 00:00:00', 8333.34, '0', 0, 0),
(530, 84, '2020-04-30 00:00:00', 8333.34, '0', 0, 0),
(531, 84, '2020-05-31 00:00:00', 8333.34, '0', 0, 0),
(532, 84, '2020-06-30 00:00:00', 8333.34, '0', 0, 0),
(533, 84, '2020-07-31 00:00:00', 8333.34, '0', 0, 0),
(534, 84, '2020-08-31 00:00:00', 8333.34, '0', 0, 0),
(535, 84, '2020-09-30 00:00:00', 8333.34, '0', 0, 0),
(536, 84, '2020-10-31 00:00:00', 8333.34, '0', 0, 0),
(537, 84, '2020-11-30 00:00:00', 8333.34, '0', 0, 0),
(538, 84, '2020-12-31 00:00:00', 8333.34, '0', 0, 0),
(539, 84, '2021-01-31 00:00:00', 8333.34, '0', 0, 0),
(540, 84, '2021-02-28 00:00:00', 8333.34, '0', 0, 0),
(541, 84, '2021-03-31 00:00:00', 8333.34, '0', 0, 0),
(542, 84, '2021-04-30 00:00:00', 8333.34, '0', 0, 0),
(543, 84, '2021-05-31 00:00:00', 8333.34, '0', 0, 0),
(544, 84, '2021-06-30 00:00:00', 8333.34, '0', 0, 0),
(545, 84, '2021-07-31 00:00:00', 8333.34, '0', 0, 0),
(546, 84, '2021-08-31 00:00:00', 8333.34, '0', 0, 0),
(547, 84, '2021-09-30 00:00:00', 8333.34, '0', 0, 0),
(548, 84, '2021-10-31 00:00:00', 8333.34, '0', 0, 0),
(549, 84, '2021-11-30 00:00:00', 8333.34, '0', 0, 0),
(550, 84, '2021-12-31 00:00:00', 8333.34, '0', 0, 0),
(551, 84, '2022-01-31 00:00:00', 8333.34, '0', 0, 0),
(552, 84, '2022-02-28 00:00:00', 8333.34, '0', 0, 0),
(553, 84, '2022-03-31 00:00:00', 8333.34, '0', 0, 0),
(554, 84, '2022-04-30 00:00:00', 8333.34, '0', 0, 0),
(555, 84, '2022-05-31 00:00:00', 8333.34, '0', 0, 0),
(556, 84, '2022-06-30 00:00:00', 8333.34, '0', 0, 0),
(557, 84, '2022-07-31 00:00:00', 8333.34, '0', 0, 0),
(558, 84, '2022-08-31 00:00:00', 8333.34, '0', 0, 0),
(559, 84, '2022-09-30 00:00:00', 8333.34, '0', 0, 0),
(560, 84, '2022-10-31 00:00:00', 8333.34, '0', 0, 0),
(561, 84, '2022-11-30 00:00:00', 8333.34, '0', 0, 0),
(562, 84, '2022-12-31 00:00:00', 8333.34, '0', 0, 0),
(563, 84, '2023-01-31 00:00:00', 8333.34, '0', 0, 0),
(564, 84, '2023-02-28 00:00:00', 8333.34, '0', 0, 0),
(565, 84, '2023-03-31 00:00:00', 8333.34, '0', 0, 0),
(566, 84, '2023-04-30 00:00:00', 8333.34, '0', 0, 0),
(567, 84, '2023-05-31 00:00:00', 8333.34, '0', 0, 0),
(568, 84, '2023-06-30 00:00:00', 8333.34, '0', 0, 0),
(569, 84, '2023-07-31 00:00:00', 8333.34, '0', 0, 0),
(570, 84, '2023-08-31 00:00:00', 8333.34, '0', 0, 0),
(571, 84, '2023-09-30 00:00:00', 8333.34, '0', 0, 0),
(572, 84, '2023-10-31 00:00:00', 8333.34, '0', 0, 0),
(573, 84, '2023-11-30 00:00:00', 8333.34, '0', 0, 0),
(574, 84, '2023-12-31 00:00:00', 8333.34, '0', 0, 0),
(575, 84, '2024-01-31 00:00:00', 8333.34, '0', 0, 0),
(576, 85, '2019-06-21 00:00:00', 6553.69, '0', 1, 0),
(577, 85, '2019-07-21 00:00:00', 8333.34, '0', 1, 0),
(578, 85, '2019-08-21 00:00:00', 8333.34, '0', 1, 0),
(579, 85, '2019-09-21 00:00:00', 8333.34, '0', 1, 0),
(580, 85, '2019-10-21 00:00:00', 8333.34, '0', 1, 0),
(581, 85, '2019-11-21 00:00:00', 8333.34, '0', 0, 0),
(582, 85, '2019-12-21 00:00:00', 8333.34, '0', 0, 0),
(583, 85, '2020-01-21 00:00:00', 8333.34, '0', 0, 0),
(584, 85, '2020-02-21 00:00:00', 8333.34, '0', 0, 0),
(585, 85, '2020-03-21 00:00:00', 8333.34, '0', 0, 0),
(586, 85, '2020-04-21 00:00:00', 8333.34, '0', 0, 0),
(587, 85, '2020-05-21 00:00:00', 8333.34, '0', 0, 0),
(588, 85, '2020-06-21 00:00:00', 8333.34, '0', 0, 0),
(589, 85, '2020-07-21 00:00:00', 8333.34, '0', 0, 0),
(590, 85, '2020-08-21 00:00:00', 8333.34, '0', 0, 0),
(591, 85, '2020-09-21 00:00:00', 8333.34, '0', 0, 0),
(592, 85, '2020-10-21 00:00:00', 8333.34, '0', 0, 0),
(593, 85, '2020-11-21 00:00:00', 8333.34, '0', 0, 0),
(594, 85, '2020-12-21 00:00:00', 8333.34, '0', 0, 0),
(595, 85, '2021-01-21 00:00:00', 8333.34, '0', 0, 0),
(596, 85, '2021-02-21 00:00:00', 8333.34, '0', 0, 0),
(597, 85, '2021-03-21 00:00:00', 8333.34, '0', 0, 0),
(598, 85, '2021-04-21 00:00:00', 8333.34, '0', 0, 0),
(599, 85, '2021-05-21 00:00:00', 8333.34, '0', 0, 0),
(600, 85, '2021-06-21 00:00:00', 8333.34, '0', 0, 0),
(601, 85, '2021-07-21 00:00:00', 8333.34, '0', 0, 0),
(602, 85, '2021-08-21 00:00:00', 8333.34, '0', 0, 0),
(603, 85, '2021-09-21 00:00:00', 8333.34, '0', 0, 0),
(604, 85, '2021-10-21 00:00:00', 8333.34, '0', 0, 0),
(605, 85, '2021-11-21 00:00:00', 8333.34, '0', 0, 0),
(606, 85, '2021-12-21 00:00:00', 8333.34, '0', 0, 0),
(607, 85, '2022-01-21 00:00:00', 8333.34, '0', 0, 0),
(608, 85, '2022-02-21 00:00:00', 8333.34, '0', 0, 0),
(609, 85, '2022-03-21 00:00:00', 8333.34, '0', 0, 0),
(610, 85, '2022-04-21 00:00:00', 8333.34, '0', 0, 0),
(611, 85, '2022-05-21 00:00:00', 8333.34, '0', 0, 0),
(612, 85, '2022-06-21 00:00:00', 8333.34, '0', 0, 0),
(613, 85, '2022-07-21 00:00:00', 8333.34, '0', 0, 0),
(614, 85, '2022-08-21 00:00:00', 8333.34, '0', 0, 0),
(615, 85, '2022-09-21 00:00:00', 8333.34, '0', 0, 0),
(616, 85, '2022-10-21 00:00:00', 8333.34, '0', 0, 0),
(617, 85, '2022-11-21 00:00:00', 8333.34, '0', 0, 0),
(618, 85, '2022-12-21 00:00:00', 8333.34, '0', 0, 0),
(619, 85, '2023-01-21 00:00:00', 8333.34, '0', 0, 0),
(620, 85, '2023-02-21 00:00:00', 8333.34, '0', 0, 0),
(621, 85, '2023-03-21 00:00:00', 8333.34, '0', 0, 0),
(622, 85, '2023-04-21 00:00:00', 8333.34, '0', 0, 0),
(623, 85, '2023-05-21 00:00:00', 8333.34, '0', 0, 0),
(624, 85, '2023-06-21 00:00:00', 8333.34, '0', 0, 0),
(625, 85, '2023-07-21 00:00:00', 8333.34, '0', 0, 0),
(626, 85, '2023-08-21 00:00:00', 8333.34, '0', 0, 0),
(627, 85, '2023-09-21 00:00:00', 8333.34, '0', 0, 0),
(628, 85, '2023-10-21 00:00:00', 8333.34, '0', 0, 0),
(629, 85, '2023-11-21 00:00:00', 8333.34, '0', 0, 0),
(630, 85, '2023-12-21 00:00:00', 8333.34, '0', 0, 0),
(631, 85, '2024-01-21 00:00:00', 8333.34, '0', 0, 0),
(632, 85, '2024-02-21 00:00:00', 8333.34, '0', 0, 0),
(633, 85, '2024-03-21 00:00:00', 8333.34, '0', 0, 0),
(634, 85, '2024-04-21 00:00:00', 8333.34, '0', 0, 0),
(635, 85, '2024-05-21 00:00:00', 8333.34, '0', 0, 0),
(636, 86, '2019-12-03 00:00:00', 5000, '0', 0, 0),
(637, 86, '2020-01-03 00:00:00', 5000, '0', 0, 0),
(638, 86, '2020-02-03 00:00:00', 5000, '0', 0, 0),
(639, 86, '2020-03-03 00:00:00', 5000, '0', 0, 0),
(640, 86, '2020-04-03 00:00:00', 5000, '0', 0, 0),
(641, 86, '2020-05-03 00:00:00', 5000, '0', 0, 0),
(642, 86, '2020-06-03 00:00:00', 5000, '0', 0, 0),
(643, 86, '2020-07-03 00:00:00', 5000, '0', 0, 0),
(644, 86, '2020-08-03 00:00:00', 5000, '0', 0, 0),
(645, 86, '2020-09-03 00:00:00', 5000, '0', 0, 0),
(646, 86, '2020-10-03 00:00:00', 5000, '0', 0, 0),
(647, 86, '2020-11-03 00:00:00', 5000, '0', 0, 0),
(648, 86, '2020-12-03 00:00:00', 5000, '0', 0, 0),
(649, 86, '2021-01-03 00:00:00', 5000, '0', 0, 0),
(650, 86, '2021-02-03 00:00:00', 5000, '0', 0, 0),
(651, 86, '2021-03-03 00:00:00', 5000, '0', 0, 0),
(652, 86, '2021-04-03 00:00:00', 5000, '0', 0, 0),
(653, 86, '2021-05-03 00:00:00', 5000, '0', 0, 0),
(654, 86, '2021-06-03 00:00:00', 5000, '0', 0, 0),
(655, 86, '2021-07-03 00:00:00', 5000, '0', 0, 0),
(656, 86, '2021-08-03 00:00:00', 5000, '0', 0, 0),
(657, 86, '2021-09-03 00:00:00', 5000, '0', 0, 0),
(658, 86, '2021-10-03 00:00:00', 5000, '0', 0, 0),
(659, 86, '2021-11-03 00:00:00', 5000, '0', 0, 0),
(660, 86, '2021-12-03 00:00:00', 5000, '0', 0, 0),
(661, 86, '2022-01-03 00:00:00', 5000, '0', 0, 0),
(662, 86, '2022-02-03 00:00:00', 5000, '0', 0, 0),
(663, 86, '2022-03-03 00:00:00', 5000, '0', 0, 0),
(664, 86, '2022-04-03 00:00:00', 5000, '0', 0, 0),
(665, 86, '2022-05-03 00:00:00', 5000, '0', 0, 0),
(666, 86, '2022-06-03 00:00:00', 5000, '0', 0, 0),
(667, 86, '2022-07-03 00:00:00', 5000, '0', 0, 0),
(668, 86, '2022-08-03 00:00:00', 5000, '0', 0, 0),
(669, 86, '2022-09-03 00:00:00', 5000, '0', 0, 0),
(670, 86, '2022-10-03 00:00:00', 5000, '0', 0, 0),
(671, 86, '2022-11-03 00:00:00', 5000, '0', 0, 0),
(672, 86, '2022-12-03 00:00:00', 5000, '0', 0, 0),
(673, 86, '2023-01-03 00:00:00', 5000, '0', 0, 0),
(674, 86, '2023-02-03 00:00:00', 5000, '0', 0, 0),
(675, 86, '2023-03-03 00:00:00', 5000, '0', 0, 0),
(676, 86, '2023-04-03 00:00:00', 5000, '0', 0, 0),
(677, 86, '2023-05-03 00:00:00', 5000, '0', 0, 0),
(678, 86, '2023-06-03 00:00:00', 5000, '0', 0, 0),
(679, 86, '2023-07-03 00:00:00', 5000, '0', 0, 0),
(680, 86, '2023-08-03 00:00:00', 5000, '0', 0, 0),
(681, 86, '2023-09-03 00:00:00', 5000, '0', 0, 0),
(682, 86, '2023-10-03 00:00:00', 5000, '0', 0, 0),
(683, 86, '2023-11-03 00:00:00', 5000, '0', 0, 0),
(684, 86, '2023-12-03 00:00:00', 5000, '0', 0, 0),
(685, 86, '2024-01-03 00:00:00', 5000, '0', 0, 0),
(686, 86, '2024-02-03 00:00:00', 5000, '0', 0, 0),
(687, 86, '2024-03-03 00:00:00', 5000, '0', 0, 0),
(688, 86, '2024-04-03 00:00:00', 5000, '0', 0, 0),
(689, 86, '2024-05-03 00:00:00', 5000, '0', 0, 0),
(690, 86, '2024-06-03 00:00:00', 5000, '0', 0, 0),
(691, 86, '2024-07-03 00:00:00', 5000, '0', 0, 0),
(692, 86, '2024-08-03 00:00:00', 5000, '0', 0, 0),
(693, 86, '2024-09-03 00:00:00', 5000, '0', 0, 0),
(694, 86, '2024-10-03 00:00:00', 5000, '0', 0, 0),
(695, 86, '2024-11-03 00:00:00', 5000, '0', 0, 0);

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
  MODIFY `idloan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `idloan_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_log`
--
ALTER TABLE `payment_log`
  MODIFY `idpayment_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payment_schedule`
--
ALTER TABLE `payment_schedule`
  MODIFY `idpayment_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696;

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
