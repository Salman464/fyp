-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 03:39 PM
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
-- Database: `kagone_appdemo-fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accidental_report`
--

CREATE TABLE `accidental_report` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `total_cost` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accidental_report`
--

INSERT INTO `accidental_report` (`id`, `department_id`, `subject`, `description`, `total_cost`, `start_date`, `end_date`, `status`, `date_created`) VALUES
(1, 1, 'Electricity Breakdown in Boy\'s Hostel!', 'bsdcbjsadbcaskdcsdcsdcsdcasdcasd cas dc asdcasd cas dca sdc as dca sdc asd c asd\r\n\r\nCAUSE: jabsdcjbasdkbcjlaskdjbcaksjdbckjasbdckasjdbcaskjdcasjkbdcasdc', 400000, '2021-07-14 09:00:00', '2021-07-14 20:00:00', 1, '2021-08-10 15:46:15'),
(2, 8, 'Server Down', 'server down event occurred!', 23000, '2021-08-27 13:00:00', '2021-08-27 15:00:00', 1, '2021-08-31 08:39:06'),
(3, 6, 'checking', 'asdcasdcasdcbasjdhbcajsdc', 320000, '2021-09-07 03:04:00', '2021-09-08 03:04:00', 1, '2021-09-13 22:04:25'),
(4, 1, 'checking', 'vhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhg vhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhg vhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhg vhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhg vhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhg vhvhvghvggghvhgvhvhvghvggghvhgvhvhvghvggghvhg', 120000, '2021-10-07 16:46:00', '2021-10-08 16:46:00', 1, '2021-10-07 11:47:22'),
(5, 1, 'Checkinnng from Complaint Side', 'asdcsadcaasd asdcsadcaasd asdcsadcaasd asdcsadcaasd asdcsadcaasd ', 120000, '2021-10-05 14:43:00', '2021-10-05 18:43:00', 0, '2021-10-11 09:43:53'),
(6, 2, 'breakdown', 'descriptionn', 10000, '2021-10-04 14:59:00', '2021-10-05 14:59:00', 0, '2021-10-11 09:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `accidental_report_asset`
--

CREATE TABLE `accidental_report_asset` (
  `id` int(11) NOT NULL,
  `accidental_report_id` int(11) NOT NULL,
  `asset_name` text NOT NULL,
  `asset_details` text NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accidental_report_asset`
--

INSERT INTO `accidental_report_asset` (`id`, `accidental_report_id`, `asset_name`, `asset_details`, `qty`) VALUES
(1, 1, 'UPS', 'sdjcbasdkcbasdd', 3),
(2, 1, 'Electric Stuff', 'basdchjasdjcbvasjkdcvakjsdvcjkasdvcjkasvdcasdc\r\nasdc\r\nas\r\ndc\r\nasd\r\ncas\r\ndc\r\nasdcasdckjasndckbajsdc\r\nasdvasdvasdvadsfv\r\naavsdvasdvasbdjcasdbasdchjasdjcbvasjkdcvakjsdvcjkasdvcjkasvdcasdc\r\nasdc\r\nas\r\ndc\r\nasd\r\ncas\r\ndc\r\nasdcasdckjasndckbajsdc\r\nasdvasdvasdvadsfv\r\naavsdvasdvasbdjcasdbasdchjasdjcbvasjkdcvakjsdvcjkasdvcjkasvdcasdc\r\nasdc\r\nas\r\ndc\r\nasd\r\ncas\r\ndc\r\nasdcasdckjasndckbajsdc\r\nasdvasdvasdvadsfv\r\naavsdvasdvasbdjcasdbasdchjasdjcbvasjkdcvakjsdvcjkasdvcjkasvdcasdc\r\nasdc\r\nas\r\ndc\r\nasd\r\ncas\r\ndc\r\nasdcasdckjasndckbajsdc\r\nasdvasdvasdvadsfv\r\naavsdvasdvasbdjcasdbasdchjasdjcbvasjkdcvakjsdvcjkasdvcjkasvdcasdc\r\nasdc\r\nas\r\ndc\r\nasd\r\ncas\r\ndc\r\nasdcasdckjasndckbajsdc\r\nasdvasdvasdvadsfv\r\naavsdvasdvasbdjcasdbasdchjasdjcbvasjkdcvakjsdvcjkasdvcjkasvdcasdc\r\nasdc\r\nas\r\ndc\r\nasd\r\ncas\r\ndc\r\nasdcasdckjasndckbajsdc\r\nasdvasdvasdvadsfv\r\naavsdvasdvasbdjcasdbasdchjasdjcbvasjkdcvakjsdvcjkasdvcjkasvdcasdc\r\nasdc\r\nas\r\ndc\r\nasd\r\ncas\r\ndc\r\nasdcasdckjasndckbajsdc\r\nasdvasdvasdvadsfv\r\naavsdvasdvasbdjcasd', 4),
(3, 2, 'aything', 'asndcasdcajsd', 30),
(4, 2, 'gthdhdgfh', 'dghfghdfgh', 6),
(5, 2, 'new Item from model', 'asdcasdcnajsdbcasjhdb', 2323),
(6, 2, 'checas', 'asdca', 1),
(7, 2, 'asdcasd', 'dasdc', 232),
(8, 2, 'asdcasd', 'dscasdcasd', 32),
(10, 3, 'asdcasd', 'asdcasdcasdcasdc asd ca sdc asdcasdc asd c aasdcasdcasdcasdc asd ca sdc asdcasdc asd c aasdcasdcasdcasdc asd ca sdc asdcasdc asd c aasdcasdcasdcasdc asd ca sdc asdcasdc asd c aasdcasdcasdcasdc asd ca sdc asdcasdc asd c aasdcasdcasdcasdc asd ca sdc asdcasdc asd c a', 23),
(11, 4, 'new Item from model', 'hghghgh', 45),
(12, 4, 'asdcasd', 'vhvhv', 666),
(13, 3, 'name', 'dfsadsadfasdfasd', 12),
(14, 3, 'szdvzsd', 'sdfsdf', 44);

-- --------------------------------------------------------

--
-- Table structure for table `added_to_inv`
--

CREATE TABLE `added_to_inv` (
  `id` int(20) NOT NULL,
  `added_quantity` int(10) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `inv_id` int(11) DEFAULT NULL,
  `remark` varchar(255) DEFAULT 'No Remarks...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `added_to_inv`
--

INSERT INTO `added_to_inv` (`id`, `added_quantity`, `added_on`, `inv_id`, `remark`) VALUES
(1, 3, '2022-03-23 11:51:56', 42, 'No Remarks...'),
(3, 3, '2022-03-23 12:10:40', 1, 'No Remarks...'),
(5, 1, '2022-03-24 15:19:30', 43, 'No Remarks...'),
(6, 1, '2022-03-24 15:27:58', 43, 'No Remarks...'),
(7, 2, '2022-03-24 20:36:23', 43, 'No Remarks...'),
(8, 1, '2022-03-24 22:59:00', 43, 'No Remarks...'),
(10, 1, '2022-03-28 10:44:26', 52, 'No Remarks...'),
(11, 5, '2022-03-30 09:30:16', 1, 'No Remarks...'),
(12, 22, '2022-03-30 17:14:40', 53, 'No Remarks...'),
(13, 1, '2022-04-02 06:48:28', 1, 'No Remarks...'),
(15, 12, '2022-04-02 07:23:36', NULL, 'aaaaaaaaaaaaaaajsssssssssssssssssaaaaaadejdxsaaaaaaaaaaaaaaajsssssssssssssssssaaaaaadejdxsaaaaaaaaaaaaaaajsssssssssssssssssaaaaaadejdxsaaaaaaaaaaaaaaajsssssssssssssssssaaaaaadejdxsaaaaaaaaaaaaaaajsssssssssssssssssaaaaaadejdxsaaaaaaaaaaaaaaajsssssssssssss'),
(16, 2112324223, '2022-04-02 07:33:08', NULL, 'aaaaaaaaaaaaaaajsssssssssssssssssaaaaaadejdxsaaaa'),
(19, 1, '2022-04-02 08:14:14', 52, 'No Remarks...'),
(20, 3, '2022-04-14 07:12:37', 1, 'No Remarks...'),
(28, 3, '2022-04-15 17:11:28', 52, 'Thats a remark'),
(29, 1, '2022-04-15 17:12:51', 52, ''),
(30, 3, '2022-04-15 17:14:56', 52, 'No Remarks...'),
(31, 3, '2022-04-16 06:23:05', 48, 'No Remarks...'),
(32, 5, '2022-04-16 10:25:43', 51, 'No Remarks...');

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `asset_id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `details` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `reqToTreasurer` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`asset_id`, `complaint_id`, `name`, `details`, `quantity`, `total_amount`, `status`, `reqToTreasurer`) VALUES
(33, 6, 'hasdcba', 'basdcbasd', 232, 10000, 1, 0),
(34, 74, 'http%3A%2F%2Flocalhost%2FCMS1%2Findex.php%2FAdmin%2FsendMail', 'asdc', 0, 12000, 1, 0),
(35, 9, 'http%3A%2F%2Flocalhost%2FCMS1%2Findex.php%2FAdmin%2FsendMail', 'sdcas', 0, 10000, 1, 0),
(36, 10, 'http%3A%2F%2Flocalhost%2FCMS1%2Findex.php%2FAdmin%2FsendMail', 'afv', 0, 100, 0, 0),
(37, 10, '34', 'favdf', 0, 1000, 1, 0),
(38, 8, 'http%3A%2F%2Flocalhost%2FCMS1%2Findex.php%2FAdmin%2FsendMail', 'dsca', 0, 1000, 1, 0),
(39, 11, 'http%3A%2F%2Flocalhost%2FCMS1%2Findex.php%2FAdmin%2FsendMail', 'p1', 0, 1200, 1, 0),
(40, 12, 'p1', 'pd1', 1, 1000, 1, 0),
(41, 12, 'p2', 'pd2', 2, 5000, 1, 1),
(42, 20, 'product+1', 'product+details+1', 1, 12000, 1, 0),
(43, 20, 'product+23', 'produict+details+23', 23, 1233000, 2, 1),
(44, 14, 'hey there!', 'i want+that+thing!', 23, 0, 0, 0),
(45, 14, 'hey again', 'i want+another+thing!', 123, 0, 0, 0),
(46, 73, 'sadf hyty+23', 'wfw 23+gee', 12, 0, 0, 0),
(47, 73, 'hery ther', 'sadfsd ashgn+sdf234', 2342, 0, 0, 0),
(48, 19, 'asdf asd asdf asdrg', 'asfa asdgasdgf qwert23 sdrg', 234, 0, 0, 0),
(49, 19, 'hey there how are you', 'asjd asdfa sadfsad asd', 234, 0, 0, 0),
(50, 82, 'product nnumber 2 ', 'details of product%232', 4444, 0, 0, 0),
(51, 82, 'asdcasdc asdcjkasdcasdcsdc', 'sdcasdcasdc dscaskjdbcasdcasdc asdcasdc asdcadsc', 23, 0, 0, 0),
(52, 15, 'product 1 ', 'product details 1', 12, 0, 2, 0),
(53, 16, 'product 1', 'product details 1', 12, 0, 0, 0),
(54, 17, 'hey there!', 'product details!', 3, 0, 0, 0),
(55, 77, 'cab asd', '21jdas asd cd', 23, 0, 0, 0),
(56, 77, 'casd asdc', 'adcasd asdcasd', 23, 0, 0, 0),
(57, 77, 'jsad', 'asbdc', 12, 0, 0, 0),
(58, 83, 'dczxc asdcasd', 'asdc asdc', 12, 0, 0, 0),
(59, 83, 'hey add%60', 'sdac sd', 32, 0, 0, 0),
(60, 83, 'sdcasd', 'dasdcasdcas', 123, 0, 0, 0),
(61, 79, 'sc casd', 'asdc sd', 12, 0, 0, 0),
(62, 79, 'hasd sdfasd', 'dwfaw asdf', 123, 0, 0, 0),
(63, 79, 'asdfasd asdfasd', 'dfasdfa asdfasd', 2323, 0, 0, 0),
(64, 79, 'new 1', 'new d1', 1, 0, 0, 0),
(65, 79, 'new 2', 'new d2', 2, 0, 0, 0),
(66, 84, 'fdsdf sfg', 'dsfgsfbsf sfgs', 12, 0, 0, 0),
(67, 86, 'p n 1 f s', 'p d 1 f s', 1, 0, 0, 0),
(68, 86, 'p2', 'pd2', 2, 0, 0, 0),
(69, 88, 'product%20n%201', 'proiduycrt%20d%201', 12, 12000, 2, 1),
(70, 88, 'sadcasdc%20asd', 'asd%20asd', 1231, 0, 0, 0),
(71, 87, 'd%20d', 'swad%20asdc', 12341, 0, 2, 1),
(72, 87, 'h b', 'hb db', 12, 0, 2, 1),
(73, 99, 'p%20n%2022', 'p%20d%2022', 22, 2300, 1, 1),
(74, 99, 'p%20n%204', 'p%20d%204', 4, 22, 1, 1),
(75, 99, 'product%20n%201', 'p%20d%201', 1, 20, 1, 0),
(76, 99, 'p%20n%2011', 'p%20d%2011', 11, 2, 1, 0),
(77, 99, 'p%20nn.%203', 'p%20dd.%203', 33, 22, 1, 0),
(78, 99, 'ad%20d', 'dc%20s', 21, 2211, 1, 0),
(79, 99, 'c%20c', 'cc%20cc', 33, 440, 1, 0),
(80, 99, 'cc%20ccc%20', 'ddd%20dddd', 12, 120, 1, 0),
(81, 99, 'cc%20asdcas', 'sdcas%20dcasdcasd', 121, 1203000, 1, 1),
(82, 99, 'casdc asdcasdca', 'sadsdfg dfg sd fg sdf gsdcas dc asd c asdc asdcasdc', 12, 1200, 1, 0),
(83, 18, 'hv vv', 'dd dd', 12, 0, 0, 0),
(84, 18, 'casdc casdcsd', 'sacas casdcad', 12, 0, 0, 0),
(85, 105, 'prodcu%20bulb%201', 'deta%201', 23, 0, 0, 0),
(86, 100, 'hh', 'gffgh', 4, 33, 1, 0),
(87, 100, 'hh', 'nn', 3, 1200, 2, 1),
(88, 13, 'cc', 'dd', 33, 566, 1, 1),
(89, 106, 'hh', 'nnnnn', 66, 0, 0, 0),
(90, 108, 'ffff', 'ss', 12, 0, 0, 0),
(91, 107, 'cc%20ccdd', 'hd%20dd', 12, 0, 0, 0),
(92, 107, 'dc ff', 'd sdcasd', 12, 0, 0, 0),
(93, 91, 'asdcasd sadcasdc', 'asdcasdc asdcq', 12, 3500, 2, 1),
(94, 141, 'sdf asd', 'asd asd', 23, 122, 1, 0),
(95, 141, 'sdcasd', 'sadjbcasjdhbc', 12, 432, 2, 1),
(96, 141, 'sadc', 'asd asdcasdv', 123, 12000, 1, 0),
(97, 143, 'prodi1', 'details 2', 3, 1000, 1, 1),
(98, 143, 'product 1', 'product details 1', 2, 1000, 1, 0),
(99, 144, 'produc1', 'details', 12, 0, 2, 0),
(100, 145, 'bulb', 'watt', 212, 1200, 2, 1),
(101, 146, 'bhjbhb', 'ftdtdrt', 22, 0, 2, 1),
(102, 146, 'gghh', 'rdttrdtdrtr', 21, 0, 2, 1),
(103, 146, 'new', 'new de', 11, 100, 2, 0),
(104, 238, 'Outlet', 'Electric oultlet 2x2 with 2 button 2 sockets', 1, 4000, 2, 1),
(105, 239, 'Camera stand', 'Wall camera stand required', 3, 0, 2, 1),
(106, 239, 'camera', 'camera required', 1, 2500, 2, 1),
(107, 181, 'VGA', 'VGA Cable required', 7, 1300, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_status`
--

CREATE TABLE `asset_status` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asset_status`
--

INSERT INTO `asset_status` (`id`, `asset_id`, `status`, `date`) VALUES
(66, 33, 0, '2021-09-02 11:21:46'),
(67, 34, 0, '2021-09-13 18:07:32'),
(68, 35, 0, '2021-09-13 18:09:28'),
(69, 36, 0, '2021-09-13 18:31:01'),
(70, 37, 0, '2021-09-13 18:31:01'),
(71, 38, 0, '2021-09-13 18:31:59'),
(72, 39, 0, '2021-09-13 18:52:50'),
(73, 40, 0, '2021-09-13 19:01:35'),
(74, 41, 0, '2021-09-13 19:01:35'),
(75, 40, 1, '2021-09-13 19:03:18'),
(76, 41, 1, '2021-09-13 19:12:15'),
(77, 41, 1, '2021-09-13 19:15:17'),
(78, 33, 2, '2021-09-13 19:23:37'),
(79, 33, 2, '2021-09-13 19:24:37'),
(80, 41, 1, '2021-09-13 19:27:35'),
(81, 34, 1, '2021-09-13 19:27:51'),
(82, 35, 1, '2021-09-13 19:28:58'),
(83, 37, 2, '2021-09-13 19:31:48'),
(84, 37, 1, '2021-09-13 19:33:53'),
(85, 36, 1, '2021-09-13 19:35:04'),
(86, 38, 1, '2021-09-13 19:52:43'),
(87, 39, 1, '2021-09-13 19:52:57'),
(88, 41, 1, '2021-09-13 20:52:37'),
(89, 42, 0, '2021-09-16 10:12:22'),
(90, 43, 0, '2021-09-16 10:12:22'),
(91, 42, 1, '2021-09-16 10:14:17'),
(92, 43, 2, '2021-09-16 10:16:46'),
(93, 44, 0, '2021-09-16 13:19:59'),
(94, 45, 0, '2021-09-16 13:19:59'),
(95, 46, 0, '2021-09-16 13:24:07'),
(96, 47, 0, '2021-09-16 13:24:07'),
(97, 48, 0, '2021-09-16 13:53:04'),
(98, 49, 0, '2021-09-16 13:53:04'),
(99, 50, 0, '2021-09-20 02:29:33'),
(100, 51, 0, '2021-09-20 02:29:33'),
(101, 52, 0, '2021-09-20 02:45:59'),
(102, 53, 0, '2021-09-20 02:49:19'),
(103, 54, 0, '2021-09-20 11:06:36'),
(104, 55, 0, '2021-09-20 11:29:34'),
(105, 56, 0, '2021-09-20 11:33:09'),
(106, 57, 0, '2021-09-20 11:50:26'),
(107, 58, 0, '2021-09-20 11:51:38'),
(108, 59, 0, '2021-09-20 11:51:54'),
(109, 60, 0, '2021-09-20 11:52:21'),
(110, 61, 0, '2021-09-20 15:47:40'),
(111, 62, 0, '2021-09-20 15:48:56'),
(112, 63, 0, '2021-09-20 15:49:01'),
(113, 64, 0, '2021-09-20 15:51:54'),
(114, 65, 0, '2021-09-20 15:51:54'),
(115, 66, 0, '2021-09-23 11:12:58'),
(116, 67, 0, '2021-10-02 15:34:08'),
(117, 68, 0, '2021-10-02 15:44:50'),
(118, 69, 0, '2021-10-03 12:58:00'),
(119, 70, 0, '2021-10-03 12:58:31'),
(120, 71, 0, '2021-10-03 13:00:37'),
(121, 72, 0, '2021-10-03 13:02:49'),
(122, 69, 2, '2021-10-03 16:28:36'),
(123, 73, 0, '2021-10-06 15:50:15'),
(124, 74, 0, '2021-10-06 15:50:15'),
(125, 75, 0, '2021-10-06 15:50:15'),
(126, 76, 0, '2021-10-06 15:52:52'),
(127, 77, 0, '2021-10-06 15:53:32'),
(128, 78, 0, '2021-10-06 15:56:09'),
(129, 79, 0, '2021-10-06 16:03:03'),
(130, 80, 0, '2021-10-06 16:08:33'),
(131, 81, 0, '2021-10-06 16:11:07'),
(132, 82, 0, '2021-10-06 16:12:56'),
(133, 82, 1, '2021-10-06 16:15:28'),
(134, 81, 2, '2021-10-06 16:15:59'),
(135, 80, 1, '2021-10-06 16:17:53'),
(136, 73, 2, '2021-10-06 16:19:56'),
(137, 74, 2, '2021-10-06 16:20:12'),
(138, 75, 1, '2021-10-06 16:21:14'),
(139, 76, 1, '2021-10-06 16:21:28'),
(140, 77, 1, '2021-10-06 16:21:43'),
(141, 78, 1, '2021-10-06 16:22:05'),
(142, 79, 1, '2021-10-06 16:22:25'),
(143, 33, 1, '2021-10-06 16:36:13'),
(144, 73, 1, '2021-10-06 16:36:30'),
(145, 74, 1, '2021-10-06 16:36:43'),
(146, 81, 1, '2021-10-06 16:36:55'),
(147, 81, 1, '2021-10-06 16:39:04'),
(148, 83, 0, '2021-10-06 18:56:02'),
(149, 84, 0, '2021-10-06 18:58:17'),
(150, 85, 0, '2021-10-07 11:18:42'),
(151, 86, 0, '2021-10-07 11:32:04'),
(152, 87, 0, '2021-10-07 11:32:04'),
(153, 87, 2, '2021-10-07 11:33:47'),
(154, 86, 1, '2021-10-07 11:35:06'),
(155, 88, 0, '2021-10-07 11:40:08'),
(156, 88, 2, '2021-10-07 11:40:54'),
(157, 88, 1, '2021-10-07 11:42:59'),
(158, 89, 0, '2021-10-07 11:50:44'),
(159, 90, 0, '2021-10-07 12:11:42'),
(160, 91, 0, '2021-10-07 17:41:14'),
(161, 92, 0, '2021-10-07 17:42:38'),
(162, 93, 0, '2021-10-11 07:15:04'),
(163, 94, 0, '2021-10-11 08:15:21'),
(164, 95, 0, '2021-10-11 08:15:21'),
(165, 96, 0, '2021-10-11 08:15:22'),
(166, 94, 1, '2021-10-11 08:16:25'),
(167, 95, 2, '2021-10-11 08:16:52'),
(168, 96, 1, '2021-10-11 08:17:17'),
(169, 97, 0, '2021-10-11 09:30:59'),
(170, 98, 0, '2021-10-11 09:30:59'),
(171, 97, 2, '2021-10-11 09:33:19'),
(172, 98, 1, '2021-10-11 09:34:46'),
(173, 97, 1, '2021-10-11 09:38:01'),
(174, 99, 0, '2021-10-11 09:41:49'),
(175, 100, 0, '2022-01-24 08:33:49'),
(176, 100, 2, '2022-01-24 08:38:47'),
(177, 101, 0, '2022-01-24 08:51:05'),
(178, 102, 0, '2022-01-24 08:51:05'),
(179, 103, 0, '2022-01-24 08:51:23'),
(180, 103, 0, '2022-09-14 19:05:49'),
(181, 103, 0, '2022-09-14 19:05:57'),
(182, 103, 2, '2022-09-14 19:06:06'),
(183, 52, 2, '2022-09-14 19:07:44'),
(184, 99, 2, '2022-09-14 19:09:01'),
(185, 101, 2, '2022-09-14 19:29:03'),
(186, 72, 2, '2022-09-14 19:31:07'),
(187, 71, 2, '2022-09-14 19:31:25'),
(188, 104, 0, '2022-10-08 15:47:43'),
(189, 105, 0, '2022-10-08 19:10:36'),
(190, 105, 2, '2022-10-08 19:45:27'),
(191, 104, 2, '2022-10-08 20:26:45'),
(192, 102, 2, '2022-10-08 20:45:41'),
(193, 106, 0, '2022-10-08 20:59:39'),
(194, 107, 0, '2022-10-08 22:10:15'),
(195, 106, 2, '2022-10-08 22:17:46'),
(196, 93, 2, '2022-10-09 07:31:43'),
(197, 107, 2, '2022-10-09 08:46:11'),
(198, 106, 2, '2022-10-09 09:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `automate_status`
--

CREATE TABLE `automate_status` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `automate_status`
--

INSERT INTO `automate_status` (`id`, `status`, `time`) VALUES
(0, 0, '2022-07-05 17:20:28'),
(1, 0, '2022-07-11 09:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `technician_id` int(11) DEFAULT 1,
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `complaint_date` timestamp NULL DEFAULT current_timestamp(),
  `expected_completion_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `event_num` int(11) NOT NULL DEFAULT 0,
  `completion_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `user_id`, `department_id`, `technician_id`, `subject`, `description`, `complaint_date`, `expected_completion_time`, `status`, `event_num`, `completion_time`) VALUES
(2, 17137074, 2, 1, 'Subject______2', 'Description______2', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(3, 17137074, 2, 1, 'Subject______3', 'Description______3', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(4, 17137074, 2, 1122, 'Subject______4', 'Description______4', '2021-08-30 17:04:12', '2021-08-31 09:34:06', 3, 0, '2022-04-03 06:27:55'),
(5, 17137074, 2, 1122, 'Subject______5', 'Description______5', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(6, 17137074, 2, 43777, 'Subject______6', 'Description______6', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(7, 17137074, 2, 1122, 'Subject______7', 'Description______7', '2021-08-30 17:04:12', '2021-09-02 07:30:00', 3, 0, '2022-04-03 06:27:55'),
(8, 17137074, 2, 1, 'Subject______8', 'Description______8', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(9, 17137074, 2, 1, 'Subject______9', 'Description______9', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(10, 17137074, 2, 1, 'Subject______10', 'Description______10', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(11, 17137074, 2, 1, 'Subject______11', 'Description______11', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(12, 17137074, 2, 1, 'Subject______12', 'Description______12', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(13, 17137074, 2, 1122, 'Subject______13', 'Description______13', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(14, 17137074, 2, 1, 'Subject______14', 'Description______14', '2021-08-30 17:04:12', '2021-09-17 09:06:00', 2, 0, '2022-04-03 06:27:55'),
(15, 17137074, 2, 1122, 'Subject______15', 'Description______15', '2021-08-30 17:04:12', '2021-08-29 11:30:00', 2, 0, '2022-04-03 06:27:55'),
(16, 17137074, 2, 1122, 'Subject______16', 'Description______16', '2021-08-30 17:04:12', '2021-09-10 11:34:00', 2, 0, '2022-04-03 06:27:55'),
(17, 17137074, 2, 1, 'Subject______17', 'Description______17', '2021-08-30 17:04:12', '2021-09-08 11:35:00', 2, 0, '2022-04-03 06:27:55'),
(18, 17137074, 2, 1, 'Subject______18', 'Description______18', '2021-08-30 17:04:12', '2021-09-14 11:44:00', 2, 0, '2022-04-03 06:27:55'),
(19, 17137074, 2, 1, 'Subject______19', 'Description______19', '2021-08-30 17:04:12', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(20, 17137074, 2, 1122, 'Subject______20', 'Description______20', '2021-08-30 17:04:12', '2021-10-01 10:21:00', 2, 0, '2022-04-03 06:27:55'),
(72, 17137074, 4, 1, 'sdcasd', 'asdcasdc', '2021-08-31 07:15:42', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(73, 17137074, 4, 1, 'chekingn time', 'asdcasdc', '2021-09-13 16:49:53', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(74, 3, 2, 1, 'Chair Broken', 'adcasdcasdc', '2021-09-13 18:00:09', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(75, 3, 2, 1, 'checking mail', 'adcasdc', '2021-09-13 18:00:57', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(76, 3, 2, 1, 'casdcasd', 'asdcasdca', '2021-09-13 18:05:48', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(77, 3, 2, 1, 'asdcasdc', 'asdcasdcasd', '2021-09-13 18:07:04', '2021-09-13 18:30:00', 2, 0, '2022-04-03 06:27:55'),
(78, 17137074, 8, 111111, 'intenner', 'asdcasdc', '2021-09-13 22:01:32', '2021-09-16 12:24:00', 3, 0, '2022-04-03 06:27:55'),
(79, 17137074, 3, 1, 'asdcasdc', 'asdcasdc', '2021-09-13 22:01:42', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(80, 17137074, 8, 1, 'sdcasdcasd', 'sdcasdcasbdcj djsadc', '2021-09-20 02:24:53', '0000-00-00 00:00:00', 0, 0, '2022-04-03 06:27:55'),
(81, 17137074, 8, 1, 'it complainntttt', 'hey there, im having problem with my computer!', '2021-09-20 02:25:21', '0000-00-00 00:00:00', 0, 0, '2022-04-03 06:27:55'),
(82, 171370744, 8, 1, 'sdcasdcasdc', 'sdcasdcasdcasdc', '2021-09-20 02:28:46', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(83, 171370744, 8, 111111, 'sdcasd', 'asdcnasdc', '2021-09-20 11:51:26', '0000-00-00 00:00:00', 1, 0, '2022-04-03 06:27:55'),
(84, 17137074, 4, 1, 'Chair Broken', 'sdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgadsdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad sdasdgadfgad', '2021-09-23 11:12:36', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(85, 3, 2, 1122, 'Chair Broken', 'hkvgkhvkh', '2021-10-01 05:13:12', '2021-10-12 18:46:00', 3, 0, '2022-04-03 06:27:55'),
(86, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-02 05:21:52', '0000-00-00 00:00:00', 3, 1, '2022-04-03 06:27:55'),
(87, 17137074, 1, 1, 'updated event title', 'updated evennt description', '2021-10-02 14:56:00', '0000-00-00 00:00:00', 3, 2, '2022-04-03 06:27:55'),
(88, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-03 12:52:11', '2021-10-19 12:52:00', 2, 1, '2022-04-03 06:27:55'),
(89, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-03 13:08:43', '0000-00-00 00:00:00', 3, 1, '2022-04-03 06:27:55'),
(90, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-03 13:08:54', '0000-00-00 00:00:00', 1, 1, '2022-04-03 06:27:55'),
(91, 17137074, 1, 1, 'updated event title', 'updated evennt description', '2021-10-03 13:15:38', '0000-00-00 00:00:00', 2, 2, '2022-04-03 06:27:55'),
(92, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-03 14:19:00', '0000-00-00 00:00:00', 1, 1, '2022-04-03 06:27:55'),
(93, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-03 14:19:09', '0000-00-00 00:00:00', 1, 1, '2022-04-03 06:27:55'),
(94, 17137074, 2, 1, 'evev', 'vavasdv', '2021-10-05 06:51:33', '0000-00-00 00:00:00', 1, 3, '2022-04-03 06:27:55'),
(95, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-05 06:55:15', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(96, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-05 07:01:37', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(97, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-05 07:01:59', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(98, 17137074, 8, 1, 'check PCs', 'jnkasndcknaskdjcnkasd', '2021-10-05 08:08:41', '0000-00-00 00:00:00', 0, 4, '2022-04-03 06:27:55'),
(99, 3, 1, 112233, 'complaint check 1', 'complaint check 1', '2021-10-06 15:38:54', '2021-10-08 16:13:00', 3, 0, '2022-04-03 06:27:55'),
(100, 3, 2, 1, 'complaint check 2', 'complaint check 2', '2021-10-06 15:39:19', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(101, 3, 1, 1, 'complaint check 3', 'complaint check 3', '2021-10-06 15:39:50', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(102, 3, 2, 43777, 'complaint check 4', 'complaint check 4', '2021-10-06 15:40:04', '0000-00-00 00:00:00', 1, 0, '2022-04-03 06:27:55'),
(103, 3, 8, 1, 'complaint check 5', 'complaint check 5', '2021-10-06 15:40:26', '0000-00-00 00:00:00', 0, 0, '2022-04-03 06:27:55'),
(104, 3, 8, 1, 'complaint check 6', 'complaint check 6', '2021-10-06 15:40:44', '0000-00-00 00:00:00', 0, 0, '2022-04-03 06:27:55'),
(105, 3, 1, 112233, 'light bulb broken', 'light bulb is ot working during day time. please make it correct', '2021-10-07 11:12:07', '2021-10-09 11:14:00', 3, 0, '2022-04-03 06:27:55'),
(106, 17137074, 2, 1, 'bbb', 'hbhb', '2021-10-07 11:49:36', '0000-00-00 00:00:00', 2, 5, '2022-04-03 06:27:55'),
(107, 3, 2, 43777, 'checkingn emial', 'hhhhh', '2021-10-07 12:01:09', '2021-10-16 17:43:00', 3, 0, '2022-04-03 06:27:55'),
(108, 3, 1, 112233, 'checkingn emial', 'vgvvv', '2021-10-07 12:10:21', '2021-10-30 12:13:00', 3, 0, '2022-04-03 06:27:55'),
(109, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:01:00', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(110, 17137074, 2, 1, 'bbb', 'hbhb', '2021-10-11 06:01:10', '0000-00-00 00:00:00', 0, 5, '2022-04-03 06:27:55'),
(111, 17137074, 2, 1, 'bbb', 'hbhb', '2021-10-11 06:33:39', '0000-00-00 00:00:00', 0, 5, '2022-04-03 06:27:55'),
(112, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:34:01', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(113, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:44:05', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(114, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:45:35', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(115, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:46:05', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(116, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:53:36', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(117, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:53:56', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(118, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:53:57', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(119, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:53:58', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(120, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:53:58', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(121, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:53:59', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(122, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:00', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(123, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:00', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(124, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:01', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(125, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:01', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(126, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:01', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(127, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:01', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(128, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:01', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(129, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:02', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(130, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:02', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(131, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:02', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(132, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:02', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(133, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:02', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(134, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:03', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(135, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:03', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(136, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:03', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(137, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check,', '2021-10-11 06:54:03', '0000-00-00 00:00:00', 0, 1, '2022-04-03 06:27:55'),
(138, 17137074, 3, 1, 'sadcasdc', 'casdcasdcas asdfsadf', '2021-10-11 07:01:09', '0000-00-00 00:00:00', 0, 6, '2022-04-03 06:27:55'),
(139, 17137074, 5, 11223346, 'dcasd asdfas', 'asdfasdfasdfasdf', '2021-10-11 07:15:24', '0000-00-00 00:00:00', 1, 0, '2022-04-03 06:27:55'),
(140, 17137074, 3, 1, 'asdfasasdfasd fas df asd f asdf as df asd f asdf as dfasdfasdfasdfasdf', 'fasdfasdfa', '2021-10-11 07:59:05', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(141, 3, 3, 11223344, 'checkinng', 'checkingn complainnt!', '2021-10-11 08:14:14', '0000-00-00 00:00:00', 2, 0, '2022-04-03 06:27:55'),
(142, 1234, 2, 1122, 'complaint from store', 'sdcasdc', '2021-10-11 08:17:41', '2022-03-21 12:50:00', 3, 0, '2022-04-05 07:59:37'),
(143, 1232, 2, 1122, 'Chair Broken', 'description!', '2021-10-11 09:25:57', '2021-10-13 18:29:00', 3, 0, '2022-04-03 06:27:55'),
(144, 17137074, 8, 111111, 'Account Hacked!', 'details', '2021-10-11 09:40:04', '2021-10-13 18:41:00', 3, 0, '2022-04-03 06:27:55'),
(145, 3, 2, 1122, 'sdcasdcas dcasdcasd', 'sdcasdcasdc', '2021-10-15 07:46:44', '2021-10-22 16:46:00', 3, 0, '2022-04-03 06:27:55'),
(146, 17137074, 1, 1, 'UPS Batteries', 'UPS Batteries Check, vgvgvvgv', '2022-01-24 08:50:27', '0000-00-00 00:00:00', 2, 1, '2022-04-03 06:27:55'),
(147, 17137074, 2, 1, 'chair', 'need more chairs for student', '2022-01-25 13:33:50', '0000-00-00 00:00:00', 3, 0, '2022-04-03 06:27:55'),
(148, 17137074, 1, 1813701039, 'desk broken', 'ajiuthsgufd6', '2022-01-25 13:48:22', '0000-00-00 00:00:00', 1, 0, '2022-04-03 06:27:55'),
(149, 1813701031, 8, 1, 'PCs Check', 'Check all computer and their not working parts', '2022-03-17 09:42:03', '0000-00-00 00:00:00', 0, 7, '2022-04-03 06:27:55'),
(150, 1813701031, 1, 1813701039, 'Fan issue', 'Fan in class G1 is not working', '2022-03-19 13:14:19', '2022-03-24 13:14:00', 3, 0, '2022-04-03 06:27:55'),
(151, 1813701031, 1, 112233, 'with default ect', 'testing', '2022-04-03 06:29:50', '2022-04-14 06:48:00', 3, 0, '2022-04-03 06:29:50'),
(152, 1813701031, 1, 1813701039, 'with default ect 2', 'tes', '2022-04-03 07:05:14', '2022-04-03 07:06:00', 3, 0, '2022-04-03 07:05:14'),
(153, 1813701031, 1, 1813701039, 'with default ect 3', 'grfd', '2022-04-03 07:24:26', '2022-04-04 07:24:00', 3, 0, '2022-04-03 04:25:07'),
(154, 1813701031, 2, 1, 'grfed', 'grfd', '2022-04-03 07:30:08', '2022-04-03 07:30:08', 3, 0, '2022-04-03 04:30:13'),
(155, 1813701031, 2, 1122, 'trfeds', 'tredwsqa', '2022-04-05 14:10:19', '2022-04-06 14:10:00', 3, 0, '2022-04-05 14:10:46'),
(156, 1813701031, 6, 1, 'test-1-civil', 'civil-complaint', '2022-04-14 08:57:34', '2022-04-14 08:57:34', 0, 0, '2022-04-14 08:57:34'),
(157, 1813701031, 7, 1, 'test-surv', 'servil-1', '2022-04-14 08:58:16', '2022-04-14 08:58:16', 0, 0, '2022-04-14 08:58:16'),
(158, 1813701033, 8, 1, 'Faulty Keyboard', 'keyboard not working in C-lab-4 PC 4', '2022-07-11 08:37:43', '2022-07-11 08:37:43', 0, 0, '2022-07-11 08:37:43'),
(159, 1813701033, 8, 1, 'Faulty Keyboard', 'keyboard not working in C-lab-4 PC 4', '2022-07-11 08:37:48', '2022-07-11 08:37:48', 0, 0, '2022-07-11 08:37:48'),
(160, 1813701033, 1, 1, 'issue test', 'xv', '2022-07-11 09:46:13', '2022-07-12 09:56:00', 0, 0, '2022-07-11 09:46:13'),
(161, 1813701033, 8, 1, 'issue test', 'xv', '2022-07-11 09:46:27', '2022-07-11 09:46:27', 0, 0, '2022-07-11 09:46:27'),
(162, 1813701033, 4, 1, 'Pipe leakage', 'found pipe leakage', '2022-07-16 14:59:57', '2022-07-16 14:59:57', 3, 0, '2022-09-24 00:17:53'),
(163, 1813701033, 4, 564324532, 'Pipe leakage', 'found pipe leakage', '2022-07-16 15:00:39', '2022-07-18 15:00:40', 3, 0, '2022-09-24 00:13:02'),
(164, 1813701033, 1, 112233, 't2', 'xyz', '2022-07-16 15:13:33', '2022-07-18 15:13:33', 1, 0, '2022-07-16 15:13:33'),
(165, 1813701033, 2, 1, 'Broken chair', 'My office chair is broken', '2022-08-02 08:34:33', '2022-08-02 08:34:33', 3, 0, '2022-09-24 00:09:11'),
(166, 1813701033, 7, 1, 'Replace light', 'light broken', '2022-08-02 08:50:51', '2022-08-02 08:50:51', 3, 0, '2022-09-24 00:09:42'),
(167, 1813701033, 7, 1, 'broken chair', 'broken chair', '2022-08-03 09:09:13', '2022-09-05 11:18:00', 0, 0, '2022-08-03 09:09:13'),
(168, 1813701033, 7, 1, 'broken chair', 'broken chair', '2022-08-03 09:18:56', '2022-08-03 09:18:56', 0, 0, '2022-08-03 09:18:56'),
(169, 1813701033, 6, 1, 'broken chair', 'broken chair', '2022-08-03 09:47:10', '2022-08-03 09:47:10', 0, 0, '2022-08-03 09:47:10'),
(170, 1813701033, 6, 1, 'broken chair', 'broken chair', '2022-08-03 09:48:12', '2022-08-03 09:48:12', 0, 0, '2022-08-03 09:48:12'),
(171, 1813701033, 6, 1, 'broken chair', 'broken chair', '2022-08-03 10:06:40', '2022-08-03 10:06:40', 0, 0, '2022-08-03 10:06:40'),
(172, 1813701033, 6, 1, 'broken chair', 'broken chair', '2022-08-03 10:06:52', '2022-08-03 10:06:52', 0, 0, '2022-08-03 10:06:52'),
(173, 1813701033, 6, 1, 'broken chair', 'broken chair', '2022-08-03 10:11:47', '2022-08-03 10:11:47', 0, 0, '2022-08-03 10:11:47'),
(174, 1813701033, 6, 1, 'broken chair', 'broken chair', '2022-08-03 10:12:32', '2022-08-03 10:12:32', 0, 0, '2022-08-03 10:12:32'),
(175, 1813701033, 6, 1, 'broken chair', 'broken chair', '2022-08-03 11:00:45', '2022-08-03 11:00:45', 0, 0, '2022-08-03 11:00:45'),
(176, 1813701033, 6, 1, 'broken chair', 'broken chair', '2022-08-03 11:04:04', '2022-08-03 11:04:04', 0, 0, '2022-08-03 11:04:04'),
(177, 1813701033, 6, 1, 'broken chair', 'broken chair', '2022-08-03 11:11:48', '2022-08-03 11:11:48', 0, 0, '2022-08-03 11:11:48'),
(178, 1813701033, 2, 1, 'broken chair', 'bulb broken', '2022-08-04 07:23:44', '2022-08-04 07:23:44', 0, 0, '2022-08-04 07:23:44'),
(179, 1813701033, 2, 1, 'PC issue', 'My pc is not loging in in fyp lab', '2022-08-12 13:56:42', '2022-08-12 13:56:42', 0, 0, '2022-08-12 13:56:42'),
(180, 1813701033, 2, 1, 'PC issue', 'My pc is not loging in in fyp lab', '2022-08-12 13:59:04', '2022-08-12 13:59:04', 0, 0, '2022-08-12 13:59:04'),
(181, 1813701033, 8, 1813701028, 'PC issue', 'My pc is not loging in in fyp lab', '2022-08-12 14:08:46', '2022-08-12 14:08:46', 2, 0, '2022-08-12 14:08:46'),
(182, 1813701033, 8, 1, 'Faulty Keyboard ', 'fyp lab pc not loging in ', '2022-08-13 08:08:12', '2022-08-13 08:08:12', 0, 0, '2022-08-13 08:08:12'),
(183, 1813701033, 1, 1, 'Faulty Keyboard ', 'bulb is broken in my office', '2022-08-13 08:08:55', '2022-08-13 08:08:55', 0, 0, '2022-08-13 08:08:55'),
(184, 1813701033, 1, 1, 'Faulty Keyboard ', 'bulb is broken in my office', '2022-08-13 08:10:21', '2022-08-13 08:10:21', 0, 0, '2022-08-13 08:10:21'),
(185, 1813701033, 1, 1, 'Faulty Keyboard ', 'bulb is broken in my office', '2022-08-13 08:14:48', '2022-08-13 08:14:48', 0, 0, '2022-08-13 08:14:48'),
(186, 1813701033, 2, 1122, 'issue test', 'chairs need maintenance', '2022-08-13 08:29:35', '2022-08-15 08:29:36', 1, 0, '2022-08-13 08:29:35'),
(187, 1813701033, 2, 1122, 'issue test', 'chairs need maintenance', '2022-08-13 08:29:47', '2022-08-15 08:29:47', 1, 0, '2022-08-13 08:29:47'),
(188, 1813701033, 2, 1813701022, 'issue test', 'chairs need maintenance', '2022-08-13 10:24:04', '2022-08-13 10:24:04', 1, 0, '2022-08-13 10:24:04'),
(189, 1813701033, 2, 1, 'issue test', 'chairs need maintenance', '2022-08-13 10:25:08', '2022-08-15 10:25:08', 0, 0, '2022-08-13 10:25:08'),
(190, 1813701033, 2, 1, 'issue test', 'chairs need maintenance', '2022-08-13 10:25:45', '2022-08-15 10:25:45', 0, 0, '2022-08-13 10:25:45'),
(191, 1813701033, 2, 1122, 'issue test', 'chairs need maintenance', '2022-08-13 10:47:19', '2022-08-15 10:47:19', 1, 0, '2022-08-13 10:47:19'),
(192, 1813701033, 2, 1122, 'issue test', 'chairs need maintenance', '2022-08-13 10:49:00', '2022-08-15 10:49:00', 1, 0, '2022-08-13 10:49:00'),
(193, 1813701033, 2, 1122, 'issue test', 'chairs need maintenance', '2022-08-13 10:50:49', '2022-08-15 10:50:49', 1, 0, '2022-08-13 10:50:49'),
(194, 1813701033, 2, 1122, 'issue test', 'chairs need maintenance', '2022-08-13 10:54:15', '2022-08-15 10:54:15', 1, 0, '2022-08-13 10:54:15'),
(195, 1813701033, 2, 1122, 'issue test', 'chairs need maintenance', '2022-08-13 10:55:05', '2022-08-15 10:55:05', 1, 0, '2022-08-13 10:55:05'),
(196, 1813701033, 2, 1122, 'issue test', 'chairs need maintenance', '2022-08-13 10:55:48', '2022-08-15 10:55:48', 1, 0, '2022-08-13 10:55:48'),
(197, 1813701033, 2, 1122, 'issue test', 'chairs need maintenance', '2022-08-13 10:56:21', '2022-08-15 10:56:21', 1, 0, '2022-08-13 10:56:21'),
(198, 1813701033, 2, 1122, 'issue test', 'chairs need maintenance', '2022-08-13 10:57:54', '2022-08-15 10:57:54', 1, 0, '2022-08-13 10:57:54'),
(199, 1813701033, 2, 1, 'issue test', 'chairs need maintenance', '2022-08-13 10:58:45', '2022-08-13 10:58:45', 0, 0, '2022-08-13 10:58:45'),
(200, 1813701033, 2, 1, 'issue test', 'chairs need  maintanance', '2022-08-13 10:59:42', '2022-08-15 10:59:42', 0, 0, '2022-08-13 10:59:42'),
(201, 1813701033, 2, 1122, 'issue test', 'chairs need  maintanance', '2022-08-13 11:01:08', '2022-08-15 11:01:08', 1, 0, '2022-08-13 11:01:08'),
(202, 1813701033, 2, 1, 'broken chair', 'chairs need maintainance', '2022-08-14 07:45:59', '2022-08-16 19:45:59', 0, 0, '2022-08-14 07:45:59'),
(203, 1813701033, 2, 1122, 'broken chair', 'chairs need maintainance', '2022-08-14 07:54:07', '2022-08-16 19:54:07', 1, 0, '2022-08-14 07:54:07'),
(204, 1813701034, 8, 1, 'Computer problem', 'my pc not working', '2022-08-14 13:11:31', '2022-08-14 13:11:31', 0, 0, '2022-08-14 13:11:31'),
(205, 1813701034, 8, 111111, 'Computer problem', 'my pc not working', '2022-08-14 13:15:10', '2022-08-15 13:15:10', 1, 0, '2022-08-14 13:15:10'),
(206, 1813701034, 8, 111111, 'maintenance', 'need some furniture maintenance', '2022-08-14 13:20:04', '2022-08-15 13:20:04', 1, 0, '2022-08-14 13:20:04'),
(207, 1813701034, 2, 1122, 'maintenance', 'chairs need maintenance', '2022-08-14 13:22:05', '2022-08-15 13:22:05', 1, 0, '2022-08-14 13:22:05'),
(208, 1813701031, 8, 1, 'Computer', 'My pc is not loging in', '2022-08-14 13:30:53', '2022-08-14 13:30:53', 0, 0, '2022-08-14 13:30:53'),
(209, 1813701031, 8, 111111, 'Computer', 'My pc is not loging in', '2022-08-14 13:31:29', '2022-08-15 13:31:29', 1, 0, '2022-08-14 13:31:29'),
(210, 1813701031, 8, 111111, 'Computer', 'My pc is not loging in', '2022-08-14 13:39:11', '2022-08-15 13:39:11', 1, 0, '2022-08-14 13:39:11'),
(211, 1813701031, 8, 111111, 'PC problem', 'my pc not loging in', '2022-08-14 13:48:01', '2022-08-15 13:48:01', 3, 0, '2022-08-14 13:48:01'),
(212, 1813701032, 1, 1, 'xyz problem', 'need fix', '2022-08-14 14:20:09', '2022-08-14 14:20:09', 0, 0, '2022-08-14 14:20:09'),
(213, 1813701036, 8, 1813701028, 'Computer', 'My pc is not loging in', '2022-08-25 05:54:10', '2022-08-25 05:54:10', 1, 0, '2022-08-25 05:54:10'),
(214, 1813701033, 1, 112233, 'Can\'t control', 'Too much content is blocked in the Pc\'s.', '2022-08-26 06:51:23', '2022-08-27 18:51:24', 1, 0, '2022-08-26 06:51:23'),
(215, 1813701033, 2, 43777, 'broken chair', 'my office chair is broken', '2022-08-26 07:19:38', '2022-08-27 19:19:38', 1, 0, '2022-08-26 07:19:38'),
(216, 1813701033, 1, 112233, 'Missing lightbulb', 'I need a light bulb in my office', '2022-09-01 18:52:29', '2022-09-02 18:52:29', 3, 0, '2022-09-02 08:19:55'),
(217, 1813701033, 3, 143211, 'leakage', 'There is a leakage in pipes on college side', '2022-09-02 09:02:07', '2022-09-03 09:02:07', 1, 0, '2022-09-02 09:02:07'),
(218, 1813701033, 2, 1, 'Table', 'a wooden table is broken in my office', '2022-09-04 10:16:46', '2022-09-05 10:16:46', 0, 0, '2022-09-04 10:16:46'),
(219, 1813701033, 2, 1, 'Table', 'a wooden table is broken in my office', '2022-09-04 10:17:42', '2022-09-05 10:17:42', 0, 0, '2022-09-04 10:17:42'),
(220, 1813701033, 2, 1, 'Table', 'a wooden table is broken in my office', '2022-09-04 10:18:00', '2022-09-05 10:18:00', 0, 0, '2022-09-04 10:18:00'),
(221, 1813701033, 2, 1, 'Table', 'a wooden table is broken in my office', '2022-09-04 10:20:24', '2022-09-05 10:20:24', 0, 0, '2022-09-04 10:20:24'),
(222, 1813701033, 2, 1, 'Table', 'a wooden table is broken in my office', '2022-09-04 10:21:12', '2022-09-05 10:21:12', 3, 0, '2022-09-24 00:17:31'),
(223, 1813701033, 2, 1, 'Table', 'a wooden table is broken in my office', '2022-09-04 10:21:44', '2022-09-05 10:21:44', 3, 0, '2022-09-24 00:12:48'),
(224, 1813701033, 2, 654321543, 'Table', 'a wooden table is broken in my office', '2022-09-04 10:22:34', '2022-09-05 10:22:34', 3, 0, '2022-09-24 00:06:17'),
(225, 1813701033, 2, 1122, 'Table', 'a wooden table is broken in my office', '2022-09-04 10:30:22', '2022-09-05 10:30:22', 3, 0, '2022-09-24 00:05:59'),
(226, 1813701035, 2, 654321543, 'broken tabel', 'table broken in my office', '2022-09-04 10:31:07', '2022-09-05 10:31:07', 3, 0, '2022-09-04 23:12:19'),
(227, 1813701035, 1, 1813701039, 'New printer', 'I need new printer for my pc', '2022-09-14 19:14:51', '2022-09-16 19:14:51', 1, 0, '2022-09-14 19:14:51'),
(228, 1813701033, 1, 112233, 'test', 'pc login issue', '2022-09-15 12:54:42', '2022-09-16 12:54:42', 3, 0, '2022-09-24 00:05:34'),
(229, 1813701033, 3, 4343542, 'vent', 'ac vent blocked', '2022-09-15 12:55:15', '2022-09-16 12:55:15', 3, 0, '2022-09-24 00:02:58'),
(230, 1813701031, 1, 112233, 'Table', 'Need to replace the table', '2022-09-15 13:06:10', '2022-09-16 13:06:10', 1, 0, '2022-09-15 13:06:10'),
(231, 1313, 2, 1122, 'Table', 'my office table is broken', '2022-09-21 11:21:22', '2022-09-22 11:21:22', 1, 0, '2022-09-21 11:21:22'),
(232, 1813701031, 1, 112233, 'testing complaint', 'I need a fan in my office', '2022-09-23 11:11:52', '2022-09-24 11:11:52', 1, 0, '2022-09-23 11:11:52'),
(237, 181370093, 2, 1813701022, 'broken table', 'my office table is broken. needs to be replaced  ', '2022-10-08 15:26:56', '2022-10-09 16:12:00', 3, 0, '2022-10-09 16:06:04'),
(238, 181370093, 1, 1813701039, 'outlet', 'my electric outlet is not working', '2022-10-08 15:32:37', '2022-10-10 15:37:00', 3, 0, '2022-10-09 16:00:17'),
(239, 181370093, 7, 1813701027, 'Surveillance', 'The cameras in back ground are not working', '2022-10-08 16:47:05', '2022-10-14 16:48:00', 2, 0, '2022-10-08 16:47:05'),
(240, 181370093, 1, 1, 'new monitor', 'want monitor for my pc', '2022-10-09 15:55:11', '2022-10-10 15:58:00', 0, 0, '2022-10-09 15:55:11'),
(241, 181370093, 7, 1, 'Emergency alarm malfunction', 'one of the emergency alarm at front gate is malfunctioning', '2022-10-11 07:58:37', '2022-10-11 07:58:37', 0, 0, '2022-10-11 07:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_feedback`
--

CREATE TABLE `complaint_feedback` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint_feedback`
--

INSERT INTO `complaint_feedback` (`id`, `complaint_id`, `feedback`) VALUES
(7, 86, 'hahaha'),
(8, 87, 'hey there! updated Remarks'),
(10, 91, 'done'),
(11, 88, 'jsdfsadfaskjdfb dfjasd fjasd fjas dfasd  nn n '),
(12, 90, 'hey there'),
(13, 105, 'hey there!'),
(14, 106, 'hhhhhh'),
(15, 143, 'feedback for complait143!'),
(16, 145, 'comment'),
(17, 149, 'Good'),
(18, 216, 'Thanks');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_status`
--

CREATE TABLE `complaint_status` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint_status`
--

INSERT INTO `complaint_status` (`id`, `complaint_id`, `status`, `remarks`, `date`) VALUES
(1, 72, 0, 'Pending', '2021-08-31 07:15:42'),
(2, 2, 3, 'Rejected', '2021-08-31 07:36:13'),
(3, 3, 3, 'Resolved', '2021-08-31 07:36:23'),
(4, 72, 3, 'Resolved', '2021-08-31 07:37:29'),
(5, 4, 1, 'Assigned to Technician', '2021-09-01 12:26:55'),
(6, 5, 1, 'Assigned to Technician', '2021-09-01 12:27:04'),
(7, 6, 1, 'Assigned to Technician', '2021-09-01 12:27:14'),
(8, 4, 3, 'Resolved', '2021-09-03 14:37:11'),
(9, 5, 3, 'Rejected', '2021-09-01 14:37:20'),
(10, 7, 1, 'Assigned to Technician', '2021-09-01 14:37:38'),
(11, 7, 3, 'Resolved', '2021-09-01 09:00:34'),
(12, 6, 2, 'Material Requested', '2021-09-02 11:21:46'),
(13, 6, 3, 'Resolved', '2021-09-03 05:35:35'),
(14, 73, 0, 'Pending', '2021-09-13 16:49:53'),
(15, 74, 0, 'Your Complaint will be resolved within 3 days!', '2021-09-13 18:00:09'),
(16, 75, 0, 'Your Complaint will be resolved within 3 days!', '2021-09-13 18:00:57'),
(17, 75, 3, 'Resolved', '2021-09-13 18:04:38'),
(18, 76, 0, 'Your Complaint will be resolved within 3 days!', '2021-09-13 18:05:48'),
(19, 76, 3, 'Resolved', '2021-09-13 18:06:18'),
(20, 77, 0, 'Your Complaint will be resolved within 3 days!', '2021-09-13 18:07:04'),
(21, 74, 2, 'Material Requested', '2021-09-13 18:07:32'),
(22, 9, 2, 'Material Requested', '2021-09-13 18:09:28'),
(23, 10, 2, 'Material Requested', '2021-09-13 18:31:01'),
(24, 10, 2, 'Material Requested', '2021-09-13 18:31:01'),
(25, 8, 2, 'Material Requested', '2021-09-13 18:31:59'),
(26, 11, 2, 'Material Requested', '2021-09-13 18:52:50'),
(27, 12, 2, 'Material Requested', '2021-09-13 19:01:35'),
(28, 12, 2, 'Material Requested', '2021-09-13 19:01:35'),
(29, 13, 1, 'Assigned to Technician', '2021-09-13 22:00:50'),
(30, 78, 0, 'Pending', '2021-09-13 22:01:32'),
(31, 79, 0, 'Pending', '2021-09-13 22:01:42'),
(32, 20, 1, 'Assigned to Technician', '2021-09-16 10:11:48'),
(33, 20, 2, 'Material Requested', '2021-09-16 10:12:22'),
(34, 20, 2, 'Material Requested', '2021-09-16 10:12:22'),
(35, 14, 2, 'Material Requested', '2021-09-16 13:19:59'),
(36, 14, 2, 'Material Requested', '2021-09-16 13:19:59'),
(37, 73, 2, 'Material Requested', '2021-09-16 13:24:07'),
(38, 73, 2, 'Material Requested', '2021-09-16 13:24:07'),
(39, 19, 2, 'Material Requested', '2021-09-16 13:53:04'),
(40, 19, 2, 'Material Requested', '2021-09-16 13:53:04'),
(41, 78, 1, 'Assigned to Technician', '2021-09-18 18:17:04'),
(42, 78, 3, 'Resolved', '2021-09-18 18:21:59'),
(43, 80, 0, 'Pending', '2021-09-20 02:24:53'),
(44, 81, 0, 'Pending', '2021-09-20 02:25:21'),
(45, 82, 0, 'Pending', '2021-09-20 02:28:46'),
(46, 82, 2, 'Material Requested', '2021-09-20 02:29:33'),
(47, 82, 2, 'Material Requested', '2021-09-20 02:29:33'),
(48, 15, 1, 'Assigned to Technician', '2021-09-20 02:37:24'),
(49, 15, 2, 'Material Requested', '2021-09-20 02:45:59'),
(50, 16, 1, 'Assigned to Technician', '2021-09-20 02:49:03'),
(51, 16, 2, 'Material Requested', '2021-09-20 02:49:19'),
(52, 17, 2, 'Material Requested', '2021-09-20 11:06:36'),
(53, 77, 2, 'Material Requested', '2021-09-20 11:29:35'),
(54, 77, 2, 'Material Requested', '2021-09-20 11:33:09'),
(55, 77, 2, 'Material Requested', '2021-09-20 11:50:26'),
(56, 83, 0, 'Pending', '2021-09-20 11:51:26'),
(57, 83, 2, 'Material Requested', '2021-09-20 11:51:38'),
(58, 83, 2, 'Material Requested', '2021-09-20 11:51:54'),
(59, 83, 2, 'Material Requested', '2021-09-20 11:52:21'),
(60, 83, 1, 'Assigned to Technician', '2021-09-20 11:52:46'),
(61, 79, 2, 'Material Requested', '2021-09-20 15:47:40'),
(62, 79, 2, 'Material Requested', '2021-09-20 15:48:56'),
(63, 79, 2, 'Material Requested', '2021-09-20 15:49:01'),
(64, 79, 2, 'Material Requested', '2021-09-20 15:51:54'),
(65, 79, 2, 'Material Requested', '2021-09-20 15:51:55'),
(66, 84, 0, 'Pending', '2021-09-23 11:12:36'),
(67, 84, 2, 'Material Requested', '2021-09-23 11:12:58'),
(68, 85, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-01 05:13:12'),
(69, 85, 1, 'Assigned to Technician', '2021-10-01 05:14:56'),
(70, 86, 0, 'Pending', '2021-10-02 05:21:52'),
(71, 87, 0, 'Pending', '2021-10-02 14:56:00'),
(72, 86, 2, 'Material Requested', '2021-10-02 15:34:08'),
(73, 86, 2, 'Material Requested', '2021-10-02 15:44:50'),
(74, 88, 0, 'Pending', '2021-10-03 12:52:11'),
(75, 88, 2, 'Material Requested', '2021-10-03 12:58:00'),
(76, 88, 2, 'Material Requested', '2021-10-03 12:58:31'),
(77, 87, 2, 'Material Requested', '2021-10-03 13:00:37'),
(78, 87, 2, 'Material Requested', '2021-10-03 13:02:49'),
(79, 89, 0, 'Pending', '2021-10-03 13:08:43'),
(80, 90, 0, 'Pending', '2021-10-03 13:08:54'),
(81, 91, 0, 'Pending', '2021-10-03 13:15:38'),
(82, 92, 0, 'Pending', '2021-10-03 14:19:00'),
(83, 93, 0, 'Pending', '2021-10-03 14:19:09'),
(84, 87, 3, 'Resolved', '2021-10-04 05:30:17'),
(85, 94, 0, 'Pending', '2021-10-05 06:51:33'),
(86, 95, 0, 'Pending', '2021-10-05 06:55:15'),
(87, 96, 0, 'Pending', '2021-10-05 07:01:37'),
(88, 97, 0, 'Pending', '2021-10-05 07:01:59'),
(89, 89, 3, 'Rejected', '2021-10-05 07:23:38'),
(90, 98, 0, 'Pending', '2021-10-05 08:08:41'),
(91, 99, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-06 15:38:54'),
(92, 100, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-06 15:39:19'),
(93, 101, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-06 15:39:50'),
(94, 102, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-06 15:40:04'),
(95, 103, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-06 15:40:26'),
(96, 104, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-06 15:40:44'),
(97, 99, 1, 'Assigned to Technician', '2021-10-06 15:43:30'),
(98, 99, 2, 'Material Requested', '2021-10-06 15:50:15'),
(99, 99, 2, 'Material Requested', '2021-10-06 15:50:15'),
(100, 99, 2, 'Material Requested', '2021-10-06 15:50:15'),
(101, 99, 2, 'Material Requested', '2021-10-06 15:52:52'),
(102, 99, 2, 'Material Requested', '2021-10-06 15:53:32'),
(103, 99, 2, 'Material Requested', '2021-10-06 15:56:09'),
(104, 99, 2, 'Material Requested', '2021-10-06 16:03:03'),
(105, 99, 2, 'Material Requested', '2021-10-06 16:08:33'),
(106, 99, 2, 'Material Requested', '2021-10-06 16:11:07'),
(107, 99, 2, 'Material Requested', '2021-10-06 16:12:56'),
(108, 99, 3, 'Resolved', '2021-10-06 16:41:01'),
(109, 18, 2, 'Material Requested', '2021-10-06 18:56:02'),
(110, 18, 2, 'Material Requested', '2021-10-06 18:58:17'),
(111, 105, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-07 11:12:07'),
(112, 105, 1, 'Assigned to Technician', '2021-10-07 11:15:40'),
(113, 105, 2, 'Material Requested', '2021-10-07 11:18:42'),
(114, 105, 3, 'Resolved', '2021-10-07 11:19:40'),
(115, 100, 2, 'Material Requested', '2021-10-07 11:32:04'),
(116, 100, 2, 'Material Requested', '2021-10-07 11:32:04'),
(117, 13, 2, 'Material Requested', '2021-10-07 11:40:08'),
(118, 13, 3, 'Resolved', '2021-10-07 11:43:16'),
(119, 106, 0, 'Pending', '2021-10-07 11:49:36'),
(120, 106, 2, 'Material Requested', '2021-10-07 11:50:44'),
(121, 107, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-07 12:01:09'),
(122, 108, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-07 12:10:21'),
(123, 108, 1, 'Assigned to Technician', '2021-10-07 12:11:06'),
(124, 108, 2, 'Material Requested', '2021-10-07 12:11:42'),
(125, 108, 3, 'Resolved', '2021-10-07 12:13:46'),
(126, 101, 3, 'Resolved', '2021-10-07 16:27:47'),
(127, 107, 2, 'Material Requested', '2021-10-07 17:41:14'),
(128, 107, 2, 'Material Requested', '2021-10-07 17:42:38'),
(129, 107, 1, 'Assigned to Technician', '2021-10-07 17:43:01'),
(130, 107, 3, 'Resolved', '2021-10-07 17:43:19'),
(131, 109, 0, 'Pending', '2021-10-11 06:01:00'),
(132, 110, 0, 'Pending', '2021-10-11 06:01:10'),
(133, 111, 0, 'Pending', '2021-10-11 06:33:39'),
(134, 112, 0, 'Pending', '2021-10-11 06:34:01'),
(135, 113, 0, 'Pending', '2021-10-11 06:44:05'),
(136, 114, 0, 'Pending', '2021-10-11 06:45:35'),
(137, 115, 0, 'Pending', '2021-10-11 06:46:05'),
(138, 116, 0, 'Pending', '2021-10-11 06:53:36'),
(139, 117, 0, 'Pending', '2021-10-11 06:53:56'),
(140, 118, 0, 'Pending', '2021-10-11 06:53:57'),
(141, 119, 0, 'Pending', '2021-10-11 06:53:58'),
(142, 120, 0, 'Pending', '2021-10-11 06:53:58'),
(143, 121, 0, 'Pending', '2021-10-11 06:53:59'),
(144, 122, 0, 'Pending', '2021-10-11 06:54:00'),
(145, 123, 0, 'Pending', '2021-10-11 06:54:00'),
(146, 124, 0, 'Pending', '2021-10-11 06:54:01'),
(147, 125, 0, 'Pending', '2021-10-11 06:54:01'),
(148, 126, 0, 'Pending', '2021-10-11 06:54:01'),
(149, 127, 0, 'Pending', '2021-10-11 06:54:01'),
(150, 128, 0, 'Pending', '2021-10-11 06:54:01'),
(151, 129, 0, 'Pending', '2021-10-11 06:54:02'),
(152, 130, 0, 'Pending', '2021-10-11 06:54:02'),
(153, 131, 0, 'Pending', '2021-10-11 06:54:02'),
(154, 132, 0, 'Pending', '2021-10-11 06:54:02'),
(155, 133, 0, 'Pending', '2021-10-11 06:54:02'),
(156, 134, 0, 'Pending', '2021-10-11 06:54:03'),
(157, 135, 0, 'Pending', '2021-10-11 06:54:03'),
(158, 136, 0, 'Pending', '2021-10-11 06:54:03'),
(159, 137, 0, 'Pending', '2021-10-11 06:54:03'),
(160, 138, 0, 'Pending', '2021-10-11 07:01:09'),
(161, 102, 1, 'Assigned to Technician', '2021-10-11 07:11:50'),
(162, 91, 2, 'Material Requested', '2021-10-11 07:15:04'),
(163, 139, 0, 'Pending', '2021-10-11 07:15:24'),
(164, 139, 1, 'Assigned to Technician', '2021-10-11 07:16:40'),
(165, 140, 0, 'Pending', '2021-10-11 07:59:05'),
(166, 141, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-11 08:14:14'),
(167, 141, 1, 'Assigned to Technician', '2021-10-11 08:14:43'),
(168, 141, 2, 'Material Requested', '2021-10-11 08:15:21'),
(169, 141, 2, 'Material Requested', '2021-10-11 08:15:21'),
(170, 141, 2, 'Material Requested', '2021-10-11 08:15:22'),
(171, 142, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-11 08:17:41'),
(172, 143, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-11 09:25:57'),
(173, 143, 1, 'Assigned to Technician', '2021-10-11 09:28:40'),
(174, 143, 2, 'Material Requested', '2021-10-11 09:30:59'),
(175, 143, 2, 'Material Requested', '2021-10-11 09:30:59'),
(176, 143, 3, 'Resolved', '2021-10-11 09:38:31'),
(177, 144, 0, 'Pending', '2021-10-11 09:40:04'),
(178, 144, 1, 'Assigned to Technician', '2021-10-11 09:41:21'),
(179, 144, 2, 'Material Requested', '2021-10-11 09:41:49'),
(180, 85, 3, 'Resolved', '2021-10-11 09:46:29'),
(181, 145, 0, 'Your Complaint will be resolved within 3 days!', '2021-10-15 07:46:44'),
(182, 145, 1, 'Assigned to Technician', '2021-10-15 07:47:05'),
(183, 140, 3, 'Resolved', '2021-12-10 16:05:22'),
(184, 145, 2, 'Material Requested', '2022-01-24 08:33:50'),
(185, 145, 3, 'Rejected', '2022-01-24 08:41:36'),
(186, 146, 0, 'Pending', '2022-01-24 08:50:27'),
(187, 146, 2, 'Material Requested', '2022-01-24 08:51:05'),
(188, 146, 2, 'Material Requested', '2022-01-24 08:51:05'),
(189, 146, 2, 'Material Requested', '2022-01-24 08:51:23'),
(190, 86, 3, 'Resolved', '2022-01-24 08:53:16'),
(191, 147, 0, 'Pending', '2022-01-25 13:33:50'),
(192, 147, 3, 'Rejected', '2022-01-25 13:47:33'),
(193, 148, 0, 'Pending', '2022-01-25 13:48:22'),
(194, 82, 3, 'Rejected', '2022-01-25 14:49:44'),
(195, 149, 0, 'Pending', '2022-03-17 09:42:03'),
(196, 148, 1, 'Assigned to Technician', '2022-03-19 09:52:36'),
(197, 148, 1, 'Assigned the task to new Technician', '2022-03-19 09:52:50'),
(198, 142, 1, 'Assigned to Technician', '2022-03-19 12:50:15'),
(199, 142, 1, 'Assigned the task to new Technician', '2022-03-19 12:52:41'),
(200, 142, 1, 'Assigned the task to new Technician', '2022-03-19 12:52:48'),
(201, 142, 1, 'Assigned the task to new Technician', '2022-03-19 12:52:56'),
(202, 142, 1, 'Assigned the task to new Technician', '2022-03-19 12:53:03'),
(203, 139, 1, 'Assigned the task to new Technician', '2022-03-19 12:59:48'),
(204, 150, 0, 'Pending', '2022-03-19 13:14:19'),
(205, 150, 1, 'Assigned to Technician', '2022-03-19 13:14:34'),
(206, 150, 3, 'Resolved', '2022-03-21 05:21:11'),
(207, 151, 0, 'Pending', '2022-04-03 06:29:50'),
(208, 152, 0, 'Pending', '2022-04-03 07:05:14'),
(209, 152, 1, 'Assigned to Technician', '2022-04-03 07:10:03'),
(210, 152, 3, 'Resolved', '2022-04-03 07:10:23'),
(211, 151, 1, 'Assigned to Technician', '2022-04-03 07:16:41'),
(212, 151, 3, 'Resolved', '2022-04-03 07:16:50'),
(213, 153, 0, 'Pending', '2022-04-03 07:24:26'),
(214, 153, 1, 'Assigned to Technician', '2022-04-03 07:24:35'),
(215, 153, 3, 'Resolved', '2022-04-03 07:25:07'),
(216, 154, 0, 'Pending', '2022-04-03 07:30:08'),
(217, 154, 3, 'Resolved', '2022-04-03 07:30:13'),
(218, 142, 3, 'Resolved', '2022-04-05 07:59:32'),
(219, 142, 3, 'Resolved', '2022-04-05 07:59:37'),
(220, 155, 0, 'Pending', '2022-04-05 14:10:19'),
(221, 155, 1, 'Assigned to Technician', '2022-04-05 14:10:38'),
(222, 155, 3, 'Rejected', '2022-04-05 14:10:46'),
(223, 148, 1, 'Assigned the task to new Technician', '2022-04-07 16:11:16'),
(224, 148, 1, 'Assigned the task to new Technician', '2022-04-07 16:11:32'),
(225, 156, 0, 'Pending', '2022-04-14 08:57:34'),
(226, 157, 0, 'Pending', '2022-04-14 08:58:16'),
(227, 158, 0, 'Your Complaint will be resolved within 3 days!', '2022-07-11 08:37:43'),
(228, 159, 0, 'Your Complaint will be resolved within 3 days!', '2022-07-11 08:37:48'),
(229, 160, 0, 'Your Complaint will be resolved within 3 days!', '2022-07-11 09:46:13'),
(230, 161, 0, 'Your Complaint will be resolved within 3 days!', '2022-07-11 09:46:27'),
(231, 162, 0, 'Your Complaint will be resolved within 3 days!', '2022-07-16 14:59:58'),
(232, 163, 0, 'Your Complaint will be resolved within 3 days!', '2022-07-16 15:00:40'),
(233, 163, 1, 'Assigned to Technician', '2022-07-16 15:00:40'),
(234, 164, 0, 'Your Complaint will be resolved within 3 days!', '2022-07-16 15:13:33'),
(235, 164, 1, 'Assigned to Technician', '2022-07-16 15:13:33'),
(236, 165, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-02 08:34:33'),
(237, 166, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-02 08:50:52'),
(238, 167, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 09:09:13'),
(239, 168, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 09:18:56'),
(240, 169, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 09:47:10'),
(241, 170, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 09:48:12'),
(242, 171, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 10:06:40'),
(243, 172, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 10:06:52'),
(244, 173, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 10:11:47'),
(245, 174, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 10:12:32'),
(246, 175, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 11:00:45'),
(247, 176, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 11:04:04'),
(248, 177, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-03 11:11:48'),
(249, 178, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-04 07:23:44'),
(250, 179, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-12 13:56:42'),
(251, 180, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-12 13:59:05'),
(252, 181, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-12 14:08:46'),
(253, 182, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 08:08:12'),
(254, 183, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 08:08:55'),
(255, 184, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 08:10:21'),
(256, 185, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 08:14:48'),
(257, 186, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 08:29:36'),
(258, 186, 1, 'Assigned to Technician', '2022-08-13 08:29:36'),
(259, 187, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 08:29:47'),
(260, 187, 1, 'Assigned to Technician', '2022-08-13 08:29:47'),
(261, 188, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:24:04'),
(262, 189, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:25:08'),
(263, 190, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:25:45'),
(264, 191, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:47:19'),
(265, 191, 1, 'Assigned to Technician', '2022-08-13 10:47:19'),
(266, 192, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:49:00'),
(267, 192, 1, 'Assigned to Technician', '2022-08-13 10:49:00'),
(268, 193, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:50:49'),
(269, 193, 1, 'Assigned to Technician', '2022-08-13 10:50:49'),
(270, 194, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:54:15'),
(271, 194, 1, 'Assigned to Technician', '2022-08-13 10:54:15'),
(272, 195, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:55:05'),
(273, 195, 1, 'Assigned to Technician', '2022-08-13 10:55:05'),
(274, 196, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:55:48'),
(275, 196, 1, 'Assigned to Technician', '2022-08-13 10:55:48'),
(276, 197, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:56:21'),
(277, 197, 1, 'Assigned to Technician', '2022-08-13 10:56:21'),
(278, 198, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:57:54'),
(279, 198, 1, 'Assigned to Technician', '2022-08-13 10:57:54'),
(280, 199, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:58:45'),
(281, 200, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 10:59:42'),
(282, 201, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-13 11:01:08'),
(283, 201, 1, 'Assigned to Technician', '2022-08-13 11:01:08'),
(284, 202, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-14 07:45:59'),
(285, 203, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-14 07:54:07'),
(286, 203, 1, 'Assigned to Technician', '2022-08-14 07:54:07'),
(287, 204, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-14 13:11:31'),
(288, 205, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-14 13:15:10'),
(289, 205, 1, 'Assigned to Technician', '2022-08-14 13:15:10'),
(290, 206, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-14 13:20:04'),
(291, 206, 1, 'Assigned to Technician', '2022-08-14 13:20:04'),
(292, 207, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-14 13:22:05'),
(293, 207, 1, 'Assigned to Technician', '2022-08-14 13:22:05'),
(294, 208, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-14 13:30:53'),
(295, 209, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-14 13:31:29'),
(296, 209, 1, 'Assigned to Technician', '2022-08-14 13:31:29'),
(297, 210, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-14 13:39:11'),
(298, 210, 1, 'Assigned to Technician', '2022-08-14 13:39:11'),
(299, 211, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-14 13:48:01'),
(300, 211, 1, 'Assigned to Technician', '2022-08-14 13:48:02'),
(301, 212, 0, 'Pending', '2022-08-14 14:20:09'),
(302, 213, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-25 05:54:10'),
(303, 214, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-26 06:51:24'),
(304, 214, 1, 'Assigned to Technician', '2022-08-26 06:51:25'),
(305, 215, 0, 'Your Complaint will be resolved within 3 days!', '2022-08-26 07:19:38'),
(306, 215, 1, 'Assigned to Technician', '2022-08-26 07:19:38'),
(307, 216, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-01 18:52:29'),
(308, 216, 1, 'Assigned to Technician', '2022-09-01 18:52:29'),
(309, 216, 3, 'Resolved', '2022-09-01 20:19:55'),
(310, 217, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-02 09:02:07'),
(311, 217, 1, 'Assigned to Technician', '2022-09-02 09:02:07'),
(312, 218, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-04 10:16:46'),
(313, 219, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-04 10:17:42'),
(314, 220, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-04 10:18:00'),
(315, 221, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-04 10:20:24'),
(316, 222, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-04 10:21:12'),
(317, 223, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-04 10:21:44'),
(318, 224, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-04 10:22:34'),
(319, 224, 1, 'Assigned to Technician', '2022-09-04 10:22:34'),
(320, 225, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-04 10:30:22'),
(321, 225, 1, 'Assigned to Technician', '2022-09-04 10:30:22'),
(322, 226, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-04 10:31:07'),
(323, 226, 1, 'Assigned to Technician', '2022-09-04 10:31:07'),
(324, 226, 3, 'Resolved', '2022-09-04 11:12:19'),
(325, 227, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-14 19:14:51'),
(326, 227, 1, 'Assigned to Technician', '2022-09-14 19:14:51'),
(327, 228, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-15 12:54:42'),
(328, 228, 1, 'Assigned to Technician', '2022-09-15 12:54:43'),
(329, 229, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-15 12:55:15'),
(330, 229, 1, 'Assigned to Technician', '2022-09-15 12:55:15'),
(331, 230, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-15 13:06:10'),
(332, 230, 1, 'Assigned to Technician', '2022-09-15 13:06:10'),
(333, 231, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-21 11:21:22'),
(334, 231, 1, 'Assigned to Technician', '2022-09-21 11:21:22'),
(335, 232, 0, 'Your Complaint will be resolved within 3 days!', '2022-09-23 11:11:52'),
(336, 232, 1, 'Assigned to Technician', '2022-09-23 11:11:52'),
(337, 229, 3, 'Resolved', '2022-09-23 12:02:58'),
(338, 228, 3, 'Resolved', '2022-09-23 12:05:15'),
(339, 228, 3, 'Resolved', '2022-09-23 12:05:35'),
(340, 225, 3, 'Resolved', '2022-09-23 12:05:59'),
(341, 224, 3, 'Rejected', '2022-09-23 12:06:17'),
(342, 165, 3, 'Rejected', '2022-09-23 12:09:11'),
(343, 166, 3, 'Resolved', '2022-09-23 12:09:42'),
(344, 223, 3, 'Rejected', '2022-09-23 12:11:00'),
(345, 223, 3, 'Rejected', '2022-09-23 12:11:17'),
(346, 223, 3, 'Rejected', '2022-09-23 12:12:48'),
(347, 163, 3, 'Rejected', '2022-09-23 12:13:02'),
(348, 222, 3, 'Resolved', '2022-09-23 12:17:32'),
(349, 162, 3, 'Rejected', '2022-09-23 12:17:53'),
(350, 237, 0, 'Your Complaint will be resolved within 3 days!', '2022-10-08 15:26:56'),
(351, 238, 0, 'Your Complaint will be resolved within 3 days!', '2022-10-08 15:32:38'),
(352, 238, 1, 'Assigned to Technician', '2022-10-08 15:46:34'),
(353, 238, 2, 'Material Requested', '2022-10-08 15:47:43'),
(354, 237, 1, 'Assigned to Technician', '2022-10-08 16:13:02'),
(355, 239, 0, 'Your Complaint will be resolved within 3 days!', '2022-10-08 16:47:05'),
(360, 188, 1, 'Assigned to Technician', '2022-10-08 17:22:42'),
(361, 188, 1, 'Assigned the task to new Technician', '2022-10-08 17:28:46'),
(362, 188, 1, 'Assigned the task to new Technician', '2022-10-08 17:31:38'),
(363, 188, 1, 'Assigned the task to new Technician', '2022-10-08 17:34:07'),
(364, 188, 1, 'Assigned the task to new Technician', '2022-10-08 17:35:02'),
(367, 239, 1, 'Assigned the task to new Technician', '2022-10-08 17:55:36'),
(368, 239, 2, 'Material Requested', '2022-10-08 19:10:36'),
(369, 239, 2, 'Material Requested', '2022-10-08 20:59:40'),
(370, 213, 1, 'Assigned to Technician', '2022-10-08 21:38:55'),
(371, 181, 1, 'Assigned to Technician', '2022-10-08 22:06:57'),
(372, 181, 2, 'Material Requested', '2022-10-08 22:10:15'),
(373, 240, 0, 'Your Complaint will be resolved within 3 days!', '2022-10-09 15:55:11'),
(374, 238, 3, 'Resolved', '2022-10-09 16:00:17'),
(375, 237, 3, 'Rejected', '2022-10-09 16:06:04'),
(376, 241, 0, 'Your Complaint will be resolved within 3 days!', '2022-10-11 07:58:37'),
(377, 144, 3, 'Resolved', '2022-10-12 12:45:14'),
(378, 211, 3, 'Rejected', '2022-10-12 12:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `dept_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dept_name`) VALUES
(1, 'Electricity'),
(2, 'Furniture'),
(3, 'HVAC'),
(4, 'Plumbing'),
(5, 'Mechanical'),
(6, 'Civil'),
(7, 'Surveillance'),
(8, 'IT'),
(9, 'nothing');

-- --------------------------------------------------------

--
-- Table structure for table `event_technician`
--

CREATE TABLE `event_technician` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `technician_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_technician`
--

INSERT INTO `event_technician` (`id`, `complaint_id`, `technician_id`) VALUES
(8, 86, 112233),
(10, 106, 43777),
(12, 91, 112233),
(15, 94, 43777),
(16, 93, 112233),
(18, 146, 112233);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `description`, `quantity`, `created_at`, `deleted`) VALUES
(1, 'spark plug', 'Engine V12 spark plug size (12\'\')', 8, '2022-03-13 11:48:10', 0),
(2, 'Fuel tank', 'Fuel tank weight 5.7kg, size  47liters', 4, '2022-03-13 12:50:02', 0),
(5, 'Mobile oil', '10litre mobile oil can', 4, '2022-04-15 14:11:09', 0),
(28, 'Corporater Fan', 'V14 Fan size 24.5\'\' plastic', 4, '2022-04-02 04:50:19', 0),
(40, 'Fuel Can', '20litre fuel can blue', 5, '2022-03-30 14:00:05', 0),
(42, 'Projector', 'epson 390 projector', 7, '2022-03-31 03:01:29', 0),
(43, 'Air Pip', 'Air venting pipe size 2.5\'\' wide carbon fiber', 3, '2022-03-30 14:10:50', 0),
(47, 'item-8', 'desc-8', 10, '2022-04-04 06:10:42', 0),
(48, 'item-9', 'desc-9', 7, '2022-03-30 14:11:10', 0),
(49, 'item-10', 'desc-10', 11, '2022-03-31 04:07:47', 0),
(50, 'item-11', 'desc-11', 9, '2022-03-30 14:02:49', 0),
(51, 'item-12', 'desc-12', 6, '2022-04-16 03:26:21', 0),
(52, 'item-13', 'desc-13', 6, '2022-04-16 09:04:28', 0),
(53, 'item-14', 'desc-14', 20, '2022-04-16 03:22:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `maintainance_events_schedule`
--

CREATE TABLE `maintainance_events_schedule` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `occurrence_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `last_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintainance_events_schedule`
--

INSERT INTO `maintainance_events_schedule` (`id`, `department_id`, `occurrence_id`, `title`, `description`, `last_update`) VALUES
(1, 1, 1, 'UPS Batteries', 'UPS Batteries Check, vgvgvvgv', '2022-02-01'),
(2, 1, 1, 'updated event title', 'updated evennt description', '2021-10-01'),
(3, 2, 1, 'evev', 'vavasdv', '2021-10-01'),
(4, 8, 1, 'check PCs', 'jnkasndcknaskdjcnkasd', '2021-01-01'),
(5, 2, 4, 'bbb', 'hbhb', '2021-01-01'),
(6, 3, 2, 'sadcasdc', 'casdcasdcas asdfsadf', '2022-01-01'),
(7, 8, 2, 'PCs Check', 'Check all computer and their not working parts', '2022-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `occurrence`
--

CREATE TABLE `occurrence` (
  `id` int(11) NOT NULL,
  `occurrence` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `occurrence`
--

INSERT INTO `occurrence` (`id`, `occurrence`) VALUES
(1, 'Monthly'),
(2, 'Quarterly'),
(3, 'Half-yearly'),
(4, 'Yearly');

-- --------------------------------------------------------

--
-- Table structure for table `purchaser_request`
--

CREATE TABLE `purchaser_request` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchaser_request`
--

INSERT INTO `purchaser_request` (`id`, `asset_id`, `status`) VALUES
(1, 101, 0),
(2, 107, 0),
(3, 107, 0),
(4, 105, 1),
(5, 106, 1),
(6, 106, 1),
(7, 104, 1),
(8, 93, 1),
(9, 107, 0),
(10, 107, 0),
(11, 107, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchaser_request_status`
--

CREATE TABLE `purchaser_request_status` (
  `id` int(11) NOT NULL,
  `purchase_req_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchaser_request_status`
--

INSERT INTO `purchaser_request_status` (`id`, `purchase_req_id`, `asset_id`, `status`, `date`) VALUES
(1, 1, 101, 0, '2022-09-15 11:49:11'),
(2, 2, 107, 0, '2022-10-09 06:44:19'),
(3, 3, 107, 0, '2022-10-09 06:44:20'),
(4, 4, 105, 0, '2022-10-09 06:54:47'),
(5, 5, 106, 0, '2022-10-09 06:54:47'),
(6, 6, 106, 0, '2022-10-09 06:54:47'),
(7, 7, 104, 0, '2022-10-09 07:11:27'),
(8, 7, 104, 1, '2022-10-09 07:12:42'),
(9, 6, 106, 1, '2022-10-09 07:20:12'),
(10, 5, 106, 1, '2022-10-09 07:24:58'),
(11, 8, 93, 0, '2022-10-09 07:33:35'),
(12, 8, 93, 1, '2022-10-09 07:34:30'),
(13, 4, 105, 1, '2022-10-09 08:26:42'),
(14, 9, 107, 0, '2022-10-09 08:47:37'),
(15, 10, 107, 0, '2022-10-09 08:47:37'),
(16, 11, 107, 0, '2022-10-09 08:47:37'),
(17, 11, 107, 1, '2022-10-09 08:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `technician`
--

CREATE TABLE `technician` (
  `technician_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `first_login` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technician`
--

INSERT INTO `technician` (`technician_id`, `department_id`, `user_type`, `name`, `phone_number`, `email`, `password`, `first_login`) VALUES
(1, 9, 9, 'Not assigned', '1', '', 'XWE=', 1),
(12, 7, 9, 'haider', '2147483647', 'haider@gift.edu.pk', 'CDQFZA==', 0),
(908, 6, 9, 'no name', '12', '908@gmail.com', 'XmpXNFBqVDRVbwQ3AW8IPQ==', 0),
(1122, 2, 9, 'Usama', '12345678', '1122@gift.edu.pk', 'CzcAYlRlVzU=', 1),
(1314, 7, 9, 'Salman-Surv-Tech', '03420429905', '18137010314@gift.edu.pk', 'CzcBYQEzAWU=', 1),
(43777, 2, 9, 'yasir', '1234', '134@gmail.com', 'CjMFZQE1AmVXYw==', 0),
(111111, 8, 9, 'Hameed', '123', '111111@gift.edu.pk', 'DjIDYVRmVzYGNFZk', 0),
(112233, 1, 9, 'Ahmad', '12345678', '112233@gift.edu.pk', 'CDQFZ1BhB2UDMwo6', 0),
(143211, 3, 9, 'MS', '03420429905', 'al34@g.com', 'WmZWMVZmBmRTYQU3', 0),
(456456, 7, 9, 'fdgbfdgb', '345634', 'dsfgvsde@gdsaf.vcom', 'WWACZAQxVTEDNVBl', 0),
(4343542, 3, 9, 'ali', '2147483647', 'ab@gc.com', 'XmdWNgE2D2wHMVNkB2I=', 0),
(11223344, 3, 9, 'Zain', '12345678', '11223344@gift.edu.pk', 'CzcHZQQ1UjBSYlBgDG9VZA==', 0),
(11223346, 5, 9, 'imtiaz', '123', 'csad@gift.edu.pk', 'XSNUY1ExUGECcgtsBjJQNFZyVDY=', 0),
(11223347, 7, 9, 'Ali Ahmad', '12345678', 'aliahmed@gift.com', 'DWEMMwdtVVEGYAFhAT4=', 0),
(564324532, 4, 9, 'rfed', '5432', 'sl5@gmail.com', 'WmJUMVZhAWIIOQM0AGIIPlg9', 0),
(654321543, 2, 9, 'Muhammad Salman', '2147483647', 'kbcd@gmail.com', 'DjUAZgYxBmUENQEzBmRQYVA0', 0),
(1813701021, 1, 9, 'Electrician', '12345999', '181370102@gift.edu.pk', 'CzcMZwAyA2AJPQIxUjQJPFk8', 1),
(1813701022, 2, 9, 'Tech-Furniture', '12345999', '181370102@gift.edu.pk', 'DjIHbAMxBmUBNQMwBmABNFM2', 1),
(1813701023, 3, 9, 'Tech-HVAC', '12345999', '181370102@gift.edu.pk', 'ADwBagMxDm0HM1dkVTMIPVk8', 1),
(1813701024, 4, 9, 'Plumber', '12345999', '181370102@gift.edu.pk', 'WWVROlZkA2AANAc0A2UEMQVg', 1),
(1813701025, 5, 9, 'Mechanic', '12345999', '181370102@gift.edu.pk', 'DzMCaVVnVzQIPFZlB2EANQNm', 1),
(1813701026, 6, 9, 'Tech-Civil', '12345999', '181370102@gift.edu.pk', 'AT0BalFjVzQGMgIxUTcCN1Yz', 1),
(1813701027, 7, 9, 'Tech-Surveillan', '12345999', '181370102@gift.edu.pk', 'CDRWPVFjAWICNgY1AGYHMlg9', 1),
(1813701028, 8, 9, 'IT-Technician', '12345999', '181370102@gift.edu.pk', 'W2dQO1dlB2QCNldkB2EEMVI3', 1),
(1813701039, 1, 9, 'Salman-Technician', '12345999', '1813701039@gift.edu.pk', 'XGBROlBiAGMEMFZlBmBXYgdjXWI=', 0);

-- --------------------------------------------------------

--
-- Table structure for table `treasurer_request`
--

CREATE TABLE `treasurer_request` (
  `req_id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treasurer_request`
--

INSERT INTO `treasurer_request` (`req_id`, `complaint_id`, `asset_id`, `status`) VALUES
(1, 145, 100, 2),
(2, 146, 101, 2),
(3, 87, 72, 2),
(4, 87, 71, 2),
(5, 239, 105, 2),
(6, 238, 104, 1),
(7, 146, 102, 2),
(8, 239, 106, 2),
(9, 181, 107, 1),
(10, 181, 107, 1),
(11, 239, 106, 2),
(12, 91, 93, 1),
(13, 181, 107, 1),
(14, 239, 106, 2);

-- --------------------------------------------------------

--
-- Table structure for table `treasurer_request_status`
--

CREATE TABLE `treasurer_request_status` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treasurer_request_status`
--

INSERT INTO `treasurer_request_status` (`id`, `req_id`, `status`, `remarks`, `date`) VALUES
(1, 1, 0, 'Pending', '2022-01-24 08:39:21'),
(2, 1, 2, 'no comment', '2022-01-24 08:40:47'),
(3, 4, 2, 'Cant be done', '2022-09-15 11:49:00'),
(4, 3, 2, 'Cant be done', '2022-09-15 11:49:01'),
(5, 2, 1, 'Approved', '2022-09-15 11:49:11'),
(6, 9, 1, 'Approved', '2022-10-09 06:44:19'),
(7, 10, 1, 'Approved', '2022-10-09 06:44:19'),
(8, 5, 1, 'Approved', '2022-10-09 06:54:47'),
(9, 8, 1, 'Approved', '2022-10-09 06:54:47'),
(10, 11, 1, 'Approved', '2022-10-09 06:54:47'),
(11, 6, 1, 'Approved', '2022-10-09 07:11:27'),
(12, 12, 1, 'Approved', '2022-10-09 07:33:35'),
(13, 9, 1, 'Approved', '2022-10-09 08:47:37'),
(14, 10, 1, 'Approved', '2022-10-09 08:47:37'),
(15, 13, 1, 'Approved', '2022-10-09 08:47:37'),
(16, 5, 2, 'funds cannot be assigned to the product', '2022-10-09 09:04:52'),
(17, 8, 2, 'funds cannot be assigned to the product', '2022-10-09 09:04:52'),
(18, 11, 2, 'funds cannot be assigned to the product', '2022-10-09 09:04:52'),
(19, 14, 2, 'funds cannot be assigned to the product', '2022-10-09 09:04:52'),
(20, 2, 2, 'Not possible to approve funds for this product', '2022-10-09 09:14:27'),
(21, 7, 2, 'Not possible to approve funds for this product', '2022-10-09 09:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `used_inv`
--

CREATE TABLE `used_inv` (
  `id` int(20) NOT NULL,
  `usedin` varchar(255) NOT NULL,
  `usedquantity` int(10) NOT NULL,
  `invID` int(10) NOT NULL,
  `issued_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `complaint_id` int(11) DEFAULT 150
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `used_inv`
--

INSERT INTO `used_inv` (`id`, `usedin`, `usedquantity`, `invID`, `issued_at`, `complaint_id`) VALUES
(1, 'Used in generator', 1, 1, '2022-03-18 05:47:23', 150),
(4, 'replaced for a generator', 1, 2, '2022-03-18 05:47:23', 150),
(5, 'used in F7 ', 1, 42, '2022-03-18 05:47:23', 150),
(6, 'olewsd', 1, 42, '2022-03-18 05:47:23', 150),
(8, 'Oil change in maintanence Monthly', 1, 5, '2022-03-19 09:11:35', 150),
(10, 'used in yearly maintenances', 12, 43, '2022-03-22 12:32:02', 150),
(11, 'in testing', 1, 1, '2022-03-22 14:18:06', 150),
(14, 'Was required in store', 1, 42, '2022-03-22 21:54:14', 142),
(16, 'xyz', 1, 1, '2022-03-23 11:57:21', 141),
(17, 'Used in fyp lab for pressentation purpose', 1, 42, '2022-03-24 20:39:44', 150),
(18, 'As subject 10', 2, 43, '2022-03-24 22:59:42', 10),
(21, 'qe', 1, 1, '2022-03-30 09:30:40', 138),
(22, 'ds', 2, 53, '2022-04-02 07:57:53', 138),
(23, 'serveillance dept requested for this item', 3, 50, '2022-04-16 09:02:41', 157),
(24, 'Oil change in maintanence quaterly', 2, 51, '2022-04-16 10:24:59', 155),
(25, 'olewsd', 3, 52, '2022-04-16 12:04:48', 153);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `ext` int(11) NOT NULL DEFAULT 0,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type`, `name`, `phone_number`, `ext`, `email`, `password`) VALUES
(3, 3, 'Ayan', '12345678', 23, 'adcasd@gift.edu.pk', 'WxVWalwyBiYEawtpBDpQO1NlBGxRdw=='),
(12, 5, 'Muhammad Yasir', '12345678', 2, '181370062@gift.edu.pk', 'C1IGJwZgDj9QIAVzAicAYAQh'),
(88, 3, 'ali', '1233333777', 980, 'aki@gift.edu.pk', 'Cj9TOA=='),
(111, 3, 'sdcas', '121312', 0, '111@gift.edu.pk', 'DzMNbFBgB2MBN1diVzdXalI8'),
(121, 3, 'asdc', '231243', 0, '121@gmail.com', 'CjYAYQc3VzMIPgUwAWFSb1A+'),
(123, 6, 'Eassa Ayub', '12345678', 0, '181370099@gift.edu.pk', 'WwYGIFEgAzBXPAZkDCgIaFB1'),
(222, 3, 'scasdc', '1212312312', 0, 'sdcas@gsda.com', 'CTYCYwY3'),
(231, 3, 'asdcasd', '12312', 0, 'asdc@dcas.com', 'WWYDY1Jg'),
(234, 3, 'sadf', '23234', 0, 'asdf@gift.edu.pk', 'DTEDYgY2AmZSZAs+BmYFOFM9'),
(800, 3, 'testing user', '1234', 0, 'abc@gmail.com', 'CWVRYAdnATUDMVBhA2cBMA=='),
(1211, 3, 'yasir', '12312', 0, '1211@gift.edu.pk', 'XmJWN1JgBGU='),
(1232, 3, 'ali', '1234444', 123, '123@gift.edu.pk', 'XhIAMVU1AzcIOlRlAGRTYg=='),
(1234, 4, 'Eassa Ayub', '12345678', 0, 'cmsstoreman@gmail.com', 'DDAFblxuDm1QZAU2AWcBNARgAzE='),
(1313, 3, 'Test Encryption', '32333', 92, 'te@gift.edu.pk', 'XWENbVNhVTY='),
(9090, 3, 'new user', '12334444', 121, 'abc@gift.edu.pk', 'WRUMPVw8BGUFNFBgUTIFNVk4'),
(23123, 3, 'zxc ', '23124', 0, 'sdcasd@gcas.cop', 'XGNRMVFjVzUJOQ=='),
(112233, 1, 'Hassan Javaid', '12345678', 0, 'sl0429905@gmail.com', 'XhIAN1E/Bj8EaQ=='),
(218988, 3, 'as', '03420429905', 92, 'sl0429905@gift.edu.pk', 'XWIEZlBrAWgIM1Zt'),
(1231231, 3, 'asdcasd', '123123123', 0, '1231@gasd.com', 'W2dUNVFhAmMFNFBgUTc='),
(17137074, 1, 'Hassan Javaid', '12345678', 12333, 'sl0429905@gmail.com', 'CkYCNVM9AThSPw=='),
(171370744, 2, 'Hasaan Butt', '2147483647', 0, 'asdcasdc@gift.edu.pk', 'ADwCZlVnDm0ANFBjUTEJOARn'),
(181370093, 3, 'Salman-Complainant', '3420429905', 92, '181370093@gift.edu.pk', 'XWFWPVdlDm1VYVBjUDcBPQNn'),
(181370103, 1, 'Salman-Admin', '3420429905', 92, '181370103@gift.edu.pk', 'CjYFblJgDm0CNgEyBWMJPFg8'),
(1813701031, 1, 'Salman-Admin', '21322', 0, 'sl0429905@gmail.com', 'XGAEbwEzUzAIPAU2AWcBNAVhXWo='),
(1813701032, 2, 'Salman-IT', '2147483647', 92, '1813701032@gift.edu.pk', 'XGAMZwMxAGNTZ1dkA2VUYVg8VmI='),
(1813701033, 3, 'Salman-Complainant', '1813701033', 92, '1813701033@gift.edu.pk', 'ADwDaFZkDm0FMQs4BmAHMlA0XWg='),
(1813701034, 4, 'Salman-Storeman', '2147483647', 92, 'cmsstoreman@gmail.com', 'CzcBagMxBWZUYFZlUTcIPVA0ADI='),
(1813701035, 5, 'CMS-Treasurer', '2147483647', 92, '181370062@gift.edu.pk', 'XGAAa1JgBGcJPQc0UjQGMwVhBjU='),
(1813701036, 6, 'Salman-Purchaser', '2147483647', 92, '181370099@gift.edu.pk', 'DTECaVFjDm0DN1RnDWtUYQdjVmY='),
(1813701037, 7, 'Salman-K', '11221122', 1, '1813701037@gift.edu.pk', 'DTFROgQ2AmEGMlFiVjBXYlM3Bjc='),
(1813701039, 9, 'Salman-Technician', '1234545', 92, '1813701039@gift.edu.pk', 'CTVXPAAyBWZTZ1RnB2EDNlk9AD8=');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'Admin'),
(2, 'IT Supervisor'),
(3, 'Complainant'),
(4, 'Store Man'),
(5, 'Treasurer'),
(6, 'Purchaser'),
(7, 'Asset Keeper'),
(9, 'Technician');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accidental_report`
--
ALTER TABLE `accidental_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `accidental_report_asset`
--
ALTER TABLE `accidental_report_asset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accidental_report_id` (`accidental_report_id`);

--
-- Indexes for table `added_to_inv`
--
ALTER TABLE `added_to_inv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inv_id` (`inv_id`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`asset_id`),
  ADD KEY `complaint_id` (`complaint_id`);

--
-- Indexes for table `asset_status`
--
ALTER TABLE `asset_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_id` (`asset_id`);

--
-- Indexes for table `automate_status`
--
ALTER TABLE `automate_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `technician_id` (`technician_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `complaint_feedback`
--
ALTER TABLE `complaint_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_id` (`complaint_id`);

--
-- Indexes for table `complaint_status`
--
ALTER TABLE `complaint_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compaint_id` (`complaint_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_technician`
--
ALTER TABLE `event_technician`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_id` (`complaint_id`),
  ADD KEY `technician_id` (`technician_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintainance_events_schedule`
--
ALTER TABLE `maintainance_events_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `occurrence_id` (`occurrence_id`);

--
-- Indexes for table `occurrence`
--
ALTER TABLE `occurrence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaser_request`
--
ALTER TABLE `purchaser_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_id` (`asset_id`);

--
-- Indexes for table `purchaser_request_status`
--
ALTER TABLE `purchaser_request_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_req_id` (`purchase_req_id`),
  ADD KEY `asset_id` (`asset_id`);

--
-- Indexes for table `technician`
--
ALTER TABLE `technician`
  ADD PRIMARY KEY (`technician_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `treasurer_request`
--
ALTER TABLE `treasurer_request`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `asset_id` (`asset_id`),
  ADD KEY `complaint_id` (`complaint_id`);

--
-- Indexes for table `treasurer_request_status`
--
ALTER TABLE `treasurer_request_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_id` (`req_id`);

--
-- Indexes for table `used_inv`
--
ALTER TABLE `used_inv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invID` (`invID`),
  ADD KEY `complaint_id` (`complaint_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accidental_report`
--
ALTER TABLE `accidental_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `accidental_report_asset`
--
ALTER TABLE `accidental_report_asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `added_to_inv`
--
ALTER TABLE `added_to_inv`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `asset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `asset_status`
--
ALTER TABLE `asset_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `complaint_feedback`
--
ALTER TABLE `complaint_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `complaint_status`
--
ALTER TABLE `complaint_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event_technician`
--
ALTER TABLE `event_technician`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `maintainance_events_schedule`
--
ALTER TABLE `maintainance_events_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `occurrence`
--
ALTER TABLE `occurrence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchaser_request`
--
ALTER TABLE `purchaser_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `purchaser_request_status`
--
ALTER TABLE `purchaser_request_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
  MODIFY `technician_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `treasurer_request`
--
ALTER TABLE `treasurer_request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `treasurer_request_status`
--
ALTER TABLE `treasurer_request_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `used_inv`
--
ALTER TABLE `used_inv`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accidental_report`
--
ALTER TABLE `accidental_report`
  ADD CONSTRAINT `accidental_report_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `accidental_report_asset`
--
ALTER TABLE `accidental_report_asset`
  ADD CONSTRAINT `accidental_report_asset_ibfk_1` FOREIGN KEY (`accidental_report_id`) REFERENCES `accidental_report` (`id`);

--
-- Constraints for table `added_to_inv`
--
ALTER TABLE `added_to_inv`
  ADD CONSTRAINT `added_to_inv_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `inventory` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `asset_ibfk_2` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`);

--
-- Constraints for table `asset_status`
--
ALTER TABLE `asset_status`
  ADD CONSTRAINT `asset_status_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`asset_id`);

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `complaint_ibfk_2` FOREIGN KEY (`technician_id`) REFERENCES `technician` (`technician_id`),
  ADD CONSTRAINT `complaint_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `complaint_feedback`
--
ALTER TABLE `complaint_feedback`
  ADD CONSTRAINT `complaint_feedback_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`);

--
-- Constraints for table `complaint_status`
--
ALTER TABLE `complaint_status`
  ADD CONSTRAINT `complaint_status_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`);

--
-- Constraints for table `event_technician`
--
ALTER TABLE `event_technician`
  ADD CONSTRAINT `event_technician_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`),
  ADD CONSTRAINT `event_technician_ibfk_2` FOREIGN KEY (`technician_id`) REFERENCES `technician` (`technician_id`);

--
-- Constraints for table `maintainance_events_schedule`
--
ALTER TABLE `maintainance_events_schedule`
  ADD CONSTRAINT `maintainance_events_schedule_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `maintainance_events_schedule_ibfk_2` FOREIGN KEY (`occurrence_id`) REFERENCES `occurrence` (`id`);

--
-- Constraints for table `purchaser_request`
--
ALTER TABLE `purchaser_request`
  ADD CONSTRAINT `purchaser_request_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`asset_id`);

--
-- Constraints for table `purchaser_request_status`
--
ALTER TABLE `purchaser_request_status`
  ADD CONSTRAINT `purchaser_request_status_ibfk_1` FOREIGN KEY (`purchase_req_id`) REFERENCES `purchaser_request` (`id`),
  ADD CONSTRAINT `purchaser_request_status_ibfk_2` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`asset_id`);

--
-- Constraints for table `technician`
--
ALTER TABLE `technician`
  ADD CONSTRAINT `technician_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `technician_ibfk_2` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`id`);

--
-- Constraints for table `treasurer_request`
--
ALTER TABLE `treasurer_request`
  ADD CONSTRAINT `treasurer_request_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`asset_id`),
  ADD CONSTRAINT `treasurer_request_ibfk_2` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`);

--
-- Constraints for table `treasurer_request_status`
--
ALTER TABLE `treasurer_request_status`
  ADD CONSTRAINT `treasurer_request_status_ibfk_1` FOREIGN KEY (`req_id`) REFERENCES `treasurer_request` (`req_id`);

--
-- Constraints for table `used_inv`
--
ALTER TABLE `used_inv`
  ADD CONSTRAINT `used_inv_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
