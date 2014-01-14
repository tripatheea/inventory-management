SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



--
-- Table structure for table `aiap97af_customers`
--

CREATE TABLE IF NOT EXISTS `aiap97af_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `reg_number` varchar(10) NOT NULL,
  `alternate_id` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` int(3) NOT NULL,
  `grade_level` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `aiap97af_customers`
--

INSERT INTO `aiap97af_customers` (`id`, `code`, `reg_number`, `alternate_id`, `name`, `type`, `grade_level`, `added_by`, `added_on`, `identification`) VALUES
(18, 'CT-070/08/1', '786', '1', 'Aashish Tripathee', 1, 1, 0, '1384710523', '18.111.37.132, Mozilla/5.0 (X11; Linux i686) Apple');

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_customer_type`
--

CREATE TABLE IF NOT EXISTS `aiap97af_customer_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `aiap97af_customer_type`
--

INSERT INTO `aiap97af_customer_type` (`id`, `code`, `name`) VALUES
(1, 'CT-STNDT', 'Student'),
(2, 'CT-TECHR', 'Teacher'),
(3, 'CT-DEPMT', 'Department');

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_grade_levels`
--

CREATE TABLE IF NOT EXISTS `aiap97af_grade_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) COLLATE utf8_bin NOT NULL,
  `identification` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=26 ;

--
-- Dumping data for table `aiap97af_grade_levels`
--

INSERT INTO `aiap97af_grade_levels` (`id`, `name`, `added_by`, `added_on`, `identification`) VALUES
(1, 'Pre-Primary', 0, '', ''),
(2, 'Nursery', 0, '', ''),
(3, 'Kindergarten', 0, '', ''),
(14, 'One', 0, '', ''),
(15, 'Two', 0, '', ''),
(16, 'Three', 0, '', ''),
(17, 'Four', 0, '', ''),
(18, 'Five', 0, '', ''),
(19, 'Six', 0, '', ''),
(20, 'Seven', 0, '', ''),
(21, 'Eight', 0, '', ''),
(22, 'Nine', 0, '', ''),
(23, 'Ten', 0, '', ''),
(24, 'Eleven', 0, '', ''),
(25, 'Twelve', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_inventory`
--

CREATE TABLE IF NOT EXISTS `aiap97af_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `aiap97af_inventory`
--

INSERT INTO `aiap97af_inventory` (`id`, `code`, `name`, `added_by`, `added_on`, `identification`) VALUES
(55, 'IV-070/06/1', 'Rice', 0, '1380703438', '49.244.128.121, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(56, 'IV-070/06/2', 'Lentil', 0, '1380703438', '49.244.128.121, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(57, 'IV-070/06/3', 'Peas', 0, '1380703438', '49.244.128.121, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(58, 'IV-070/06/4', 'Notebook', 0, '1380703438', '49.244.128.121, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(59, 'IV-070/06/5', 'Hero Pen', 0, '1380703439', '49.244.128.121, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(60, 'IV-070/06/6', 'Pencil', 0, '1380703439', '49.244.128.121, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(61, 'IV-070/07/1', 'Ink Blue', 0, '1383290084', '49.244.131.196, Mozilla/5.0 (Windows NT 6.1; WOW64');

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_invoices`
--

CREATE TABLE IF NOT EXISTS `aiap97af_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `customer` int(11) NOT NULL,
  `invoice` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_login_attempts`
--

CREATE TABLE IF NOT EXISTS `aiap97af_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_mileage`
--

CREATE TABLE IF NOT EXISTS `aiap97af_mileage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle` int(11) NOT NULL,
  `fuel_amount` float NOT NULL,
  `odometer_reading` float NOT NULL,
  `date` varchar(10) NOT NULL,
  `do_not_use` int(1) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=285 ;

--
-- Dumping data for table `aiap97af_mileage`
--

INSERT INTO `aiap97af_mileage` (`id`, `vehicle`, `fuel_amount`, `odometer_reading`, `date`, `do_not_use`, `added_by`, `added_on`, `identification`) VALUES
(46, 11, 58, 109734, '1366913700', 0, 0, '1383727180', '49.244.150.4, Mozilla/5.0 (Windows NT 6.1; WOW64) '),
(47, 11, 30, 110043, '1367432100', 0, 0, '1383727242', '49.244.150.4, Mozilla/5.0 (Windows NT 6.1; WOW64) '),
(48, 11, 30, 110043, '1367432100', 0, 0, '1383727316', '49.244.150.4, Mozilla/5.0 (Windows NT 6.1; WOW64) '),
(49, 11, 30, 110043, '1367432100', 0, 0, '1383727320', '49.244.150.4, Mozilla/5.0 (Windows NT 6.1; WOW64) '),
(50, 11, 65, 100306, '1367777700', 0, 0, '1383727915', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(51, 11, 47, 110664, '1368123300', 0, 0, '1383728172', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(52, 11, 60, 111124, '1368728100', 0, 0, '1383728244', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(53, 11, 58, 111481, '1369160100', 0, 0, '1383728305', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(54, 11, 68.94, 111808, '1369592100', 0, 0, '1383728383', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(55, 11, 54, 112133, '1370110500', 0, 0, '1383728457', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(56, 11, 52, 112571, '1370715300', 0, 0, '1383728566', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(57, 11, 47, 112978, '1371147300', 0, 0, '1383728633', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(58, 11, 72, 113247, '1371924900', 0, 0, '1383728709', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(59, 11, 75.78, 113720, '1372702500', 0, 0, '1383728766', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(60, 11, 75.78, 113720, '1372270500', 0, 0, '1383728811', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(61, 11, 75.78, 113720, '1372270500', 0, 0, '1383729693', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(62, 11, 69.86, 114180, '1372702500', 0, 0, '1383729743', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(63, 11, 58.12, 115465, '1373134500', 0, 0, '1383729812', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(64, 11, 70.01, 114994, '1373393700', 0, 0, '1383729869', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(65, 11, 70.01, 114994, '1373393700', 0, 0, '1383730022', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(66, 11, 61, 115389, '1373998500', 0, 0, '1383730112', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(67, 11, 70.28, 115842, '1374430500', 0, 0, '1383730171', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(68, 11, 60, 116226, '1374948900', 0, 0, '1383730268', '49.244.150.4, Mozilla/5.0 (Windows NT 5.1) AppleWe'),
(69, 11, 79.2, 117170, '1375726500', 0, 0, '1383826020', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(70, 11, 79.2, 117170, '1375726500', 0, 0, '1383826026', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(71, 11, 74.43, 117639, '1376244900', 0, 0, '1383826089', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(72, 11, 60, 118127, '1376763300', 0, 0, '1383826158', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(73, 11, 67, 118602, '1377454500', 0, 0, '1383826238', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(74, 11, 62.5, 118973, '1377800100', 0, 0, '1383826296', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(75, 11, 61, 119326, '1378059300', 0, 0, '1383826345', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(76, 11, 58.6, 116980, '1378404900', 0, 0, '1383826406', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(77, 11, 59.13, 120036, '1379009700', 0, 0, '1383826469', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(78, 11, 58, 120406, '1379441700', 0, 0, '1383826514', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(79, 11, 57.98, 120406, '1379787300', 0, 0, '1383826596', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(80, 11, 55, 121416, '1380392100', 0, 0, '1383826714', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(81, 11, 60, 121774, '1380651300', 0, 0, '1383826809', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(82, 11, 37, 122012, '1380996900', 0, 0, '1383826862', '49.244.138.33, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(83, 12, 44, 80182, '1366913700', 0, 0, '1383963672', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(84, 12, 44, 80452, '1367777700', 0, 0, '1383963724', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(85, 12, 47.02, 80639, '1368468900', 0, 0, '1383963773', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(86, 12, 30, 80830, '1368900900', 0, 0, '1383963814', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(87, 12, 58, 80982, '1369160100', 0, 0, '1383963881', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(88, 12, 33.5, 81157, '1369592100', 0, 0, '1383963933', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(89, 12, 49, 81406, '1370283300', 0, 0, '1383963987', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(90, 12, 39.2, 81595, '1370715300', 0, 0, '1383964039', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(91, 12, 47, 81820, '1371147300', 0, 0, '1383964090', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(92, 12, 44.96, 82022, '1372011300', 0, 0, '1383964141', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(93, 12, 39.44, 82215, '1372270500', 0, 0, '1383964191', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(94, 12, 51.3, 82503, '1383502500', 0, 0, '1383964239', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(95, 12, 34.43, 82704, '1373134500', 0, 0, '1383964327', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(96, 12, 48.2, 82943, '1373393700', 0, 0, '1383964386', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(97, 12, 35.6, 83130, '1373998500', 0, 0, '1383964476', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(98, 12, 32.5, 83323, '1374430500', 0, 0, '1383964542', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(99, 12, 60.5, 83641, '1375208100', 0, 0, '1383964658', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(100, 12, 54, 83886, '1375640100', 0, 0, '1383964713', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(101, 12, 57.63, 84185, '1376244900', 0, 0, '1383964760', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(102, 12, 57.63, 84185, '1376244900', 0, 0, '1383965158', '49.244.135.96, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(103, 12, 40, 84438, '1376763300', 0, 0, '1383994053', '49.244.129.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(104, 12, 55, 84698, '1377454500', 0, 0, '1383994101', '49.244.129.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(105, 12, 36.5, 84888, '1377800100', 0, 0, '1383994145', '49.244.129.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(106, 12, 47.5, 85137, '1383588900', 0, 0, '1383994240', '49.244.129.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(107, 12, 31.8, 85302, '1378836900', 0, 0, '1383994292', '49.244.129.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(108, 12, 31.8, 85302, '1378836900', 0, 0, '1383994306', '49.244.129.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(109, 12, 55.3, 85590, '1379441700', 0, 0, '1383994362', '49.244.129.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(110, 12, 35.67, 85777, '1379787300', 0, 0, '1383994417', '49.244.129.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(111, 12, 49, 86042, '1380219300', 0, 0, '1383994462', '49.244.129.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(112, 12, 44.32, 86277, '1380651300', 0, 0, '1383994509', '49.244.129.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(113, 13, 55.5, 141922, '1367172900', 0, 0, '1384047653', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(114, 13, 57, 142195, '1367864100', 0, 0, '1384047705', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(115, 13, 55.86, 142497, '1368468900', 0, 0, '1384047756', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(116, 13, 60, 142810, '1368987300', 0, 0, '1384047822', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(117, 13, 68.94, 143147, '1369592100', 0, 0, '1384047877', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(118, 13, 40.16, 143375, '1370110500', 0, 0, '1384048137', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(119, 13, 56.3, 143695, '1370715300', 0, 0, '1384048860', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(120, 13, 50.1, 143970, '1371147300', 0, 0, '1384048903', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(121, 13, 50.1, 143970, '1371147300', 0, 0, '1384049020', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(122, 13, 47, 144161, '1371924900', 0, 0, '1384049072', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(123, 13, 59.11, 144503, '1372270500', 0, 0, '1384049138', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(124, 13, 59.11, 144503, '1372270500', 0, 0, '1384049150', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(125, 13, 51.67, 145148, '1373134500', 0, 0, '1384049270', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(126, 13, 46.55, 145413, '1373393700', 0, 0, '1384049317', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(127, 13, 60.1, 145764, '1373998500', 0, 0, '1384049396', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(128, 13, 51.82, 146090, '1374430500', 0, 0, '1384049460', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(129, 13, 43, 146351, '1374948900', 0, 0, '1384049504', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(130, 13, 61, 14700, '1375294500', 0, 0, '1384049540', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(131, 13, 59, 147050, '1375726500', 0, 0, '1384049595', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(132, 13, 62.2, 147400, '1376244900', 0, 0, '1384049680', '49.244.128.87, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(133, 13, 40, 447750, '1376763300', 0, 0, '1384138257', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(134, 13, 60, 147967, '1376936100', 0, 0, '1384138303', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(135, 13, 36, 148114, '1377454500', 0, 0, '1384138382', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(136, 13, 49.7, 148446, '1377972900', 0, 0, '1384138429', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(137, 13, 62, 148809, '1378318500', 0, 0, '1384138470', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(138, 13, 65.65, 149186, '1379009700', 0, 0, '1384138524', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(139, 13, 27.4, 149344, '1379182500', 0, 0, '1384138572', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(140, 13, 74, 149807, '1379873700', 0, 0, '1384138624', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(141, 13, 53, 150126, '1380219300', 0, 0, '1384138664', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(142, 13, 58, 150486, '1380651300', 0, 0, '1384138712', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(143, 13, 58, 150486, '1380651300', 0, 0, '1384138726', '49.244.150.42, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(144, 14, 80.2, 102284, '1367777700', 0, 0, '1384227029', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(145, 14, 50, 102737, '1368728100', 0, 0, '1384227069', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(146, 14, 80, 102988, '1369246500', 0, 0, '1384227106', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(147, 14, 80, 103354, '1370283300', 0, 0, '1384227151', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(148, 14, 80.1, 103733, '1371060900', 0, 0, '1384227262', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(149, 14, 80, 104113, '1371406500', 0, 0, '1384227319', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(150, 14, 80.01, 104465, '1373134500', 0, 0, '1384227372', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(151, 14, 80.1, 104805, '1374948900', 0, 0, '1384227423', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(152, 14, 82, 105190, '1375812900', 0, 0, '1384227486', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(153, 14, 82, 105578, '1376849700', 0, 0, '1384227589', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(154, 14, 82.1, 105955, '1378059300', 0, 0, '1384227640', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(155, 14, 81, 106461, '1379528100', 0, 0, '1384227683', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(156, 14, 80, 106852, '1380219300', 0, 0, '1384227789', '49.244.152.34, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(157, 15, 55.5, 28409, '1367172900', 0, 0, '1385263706', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(158, 15, 61, 28637, '1367864100', 0, 0, '1385263753', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(159, 15, 59.04, 28864, '1368468900', 0, 0, '1385263805', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(160, 15, 62, 29116, '1368987300', 0, 0, '1385263894', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(161, 15, 58, 29332, '1369332900', 0, 0, '1385263942', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(162, 15, 58, 29332, '1369332900', 0, 0, '1385263948', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(163, 15, 62.03, 29580, '1372788900', 0, 0, '1385264032', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(164, 15, 56.2, 29803, '1370715300', 0, 0, '1385264090', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(165, 15, 50.14, 29996, '1371147300', 0, 0, '1385264151', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(166, 15, 59, 30204, '1372011300', 0, 0, '1385264220', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(167, 15, 51.84, 30401, '1372270500', 0, 0, '1385264264', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(168, 15, 63.02, 30672, '1372702500', 0, 0, '1385264318', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(169, 15, 52.77, 30884, '1373134500', 0, 0, '1385264376', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(170, 15, 65.52, 31149, '1373393700', 0, 0, '1385264443', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(171, 15, 56, 31378, '1373998500', 0, 0, '1385264504', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(172, 15, 71, 31672, '1374689700', 0, 0, '1385264575', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(173, 15, 68, 31984, '1375208100', 0, 0, '1385264620', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(174, 15, 35, 32583, '1376158500', 0, 0, '1385264689', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(175, 15, 69.5, 32685, '1376244900', 0, 0, '1385264766', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(176, 15, 79, 33005, '1376590500', 0, 0, '1385264810', '49.244.138.251, Mozilla/5.0 (Windows NT 5.1) Apple'),
(177, 15, 35, 33308, '1377368100', 0, 0, '1385517775', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(178, 15, 35, 33369, '1377454500', 0, 0, '1385517823', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(179, 15, 81, 33735, '1377972900', 0, 0, '1385517862', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(180, 15, 71, 34028, '1378232100', 0, 0, '1385518024', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(181, 15, 62.21, 34288, '1378836900', 0, 0, '1385518077', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(182, 15, 36, 34619, '1379182500', 0, 0, '1385518119', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(183, 15, 67, 34724, '1379441700', 0, 0, '1385518162', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(184, 15, 61.79, 34994, '1379787300', 0, 0, '1385518204', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(185, 15, 50, 35303, '1380132900', 0, 0, '1385518245', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(186, 15, 55, 35440, '1380392100', 0, 0, '1385518297', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(187, 15, 54, 34634, '1380651300', 0, 0, '1385518335', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(188, 15, 54, 35878, '1383761700', 0, 0, '1385518382', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(189, 15, 75, 36715, '1385230500', 0, 0, '1385518467', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(190, 16, 10, 62603, '1366827300', 0, 0, '1385518527', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(191, 16, 36, 62603, '1366913700', 0, 0, '1385518593', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(192, 16, 35, 62603, '1367432100', 0, 0, '1385518627', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(193, 16, 33, 62730, '1367777700', 0, 0, '1385518663', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(194, 16, 35, 62917, '1368123300', 0, 0, '1385518709', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(195, 16, 26.85, 63045, '1368468900', 0, 0, '1385518751', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(196, 16, 30, 63222, '1368900900', 0, 0, '1385518822', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(197, 0, 46, 63438, '1369332900', 0, 0, '1385518974', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(198, 16, 53, 63707, '1370110500', 0, 0, '1385519039', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(199, 16, 42.01, 64154, '1371147300', 0, 0, '1385519077', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(200, 16, 37.31, 64211, '1372011300', 0, 0, '1385519131', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(201, 16, 48.95, 64581, '1372702500', 0, 0, '1385519179', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(202, 16, 31.75, 64753, '1373134500', 0, 0, '1385519248', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(203, 16, 46.01, 65030, '1373393700', 0, 0, '1385519317', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(204, 16, 63.1, 65389, '1373998500', 0, 0, '1385519382', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(205, 16, 61.98, 65755, '1374430500', 0, 0, '1385519436', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(206, 16, 31, 65945, '1374689700', 0, 0, '1385519479', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(207, 16, 14.89, 66246, '1375121700', 0, 0, '1385519568', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(208, 16, 56, 66344, '1375208100', 0, 0, '1385519646', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(209, 16, 46.8, 67010, '1375899300', 0, 0, '1385519696', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(210, 16, 65.8, 67369, '1373825700', 0, 0, '1385519740', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(211, 16, 40, 67627, '1376849700', 0, 0, '1385519787', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(212, 16, 46, 67896, '1377454500', 0, 0, '1385519824', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(213, 16, 63, 68250, '1377972900', 0, 0, '1385519861', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(214, 16, 59, 68588, '1378318500', 0, 0, '1385520030', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(215, 16, 57.97, 68925, '1379009700', 0, 0, '1385520093', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(216, 16, 71.7, 69327, '1379528100', 0, 0, '1385524029', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(217, 16, 25.3, 69468, '1379873700', 0, 0, '1385524077', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(218, 16, 67, 69837, '1380392100', 0, 0, '1385524121', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(219, 16, 46, 70094, '1380651300', 0, 0, '1385524162', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(220, 16, 65, 70603, '1385230500', 0, 0, '1385524209', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(221, 12, 44.32, 86277, '1380651300', 0, 0, '1385524275', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(222, 12, 58, 86577, '1383761700', 0, 0, '1385524321', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(223, 13, 31.5, 150645, '1380996900', 0, 0, '1385524455', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(224, 13, 30, 151470, '1383416100', 0, 0, '1385524503', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(225, 13, 38, 151510, '1383761700', 0, 0, '1385524532', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(226, 13, 60, 151878, '1385230500', 0, 0, '1385524576', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(227, 15, 75, 36175, '1385230500', 0, 0, '1385524624', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(228, 11, 65.6, 122939, '1383761700', 0, 0, '1385524686', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(229, 11, 20, 123372, '1385230500', 0, 0, '1385524827', '49.244.152.254, Mozilla/5.0 (Windows NT 5.1) Apple'),
(230, 11, 73, 123909, '1385576100', 0, 0, '1385691277', '49.244.148.137, Mozilla/5.0 (Windows NT 5.1) Apple'),
(231, 15, 74, 36491, '1385576100', 0, 0, '1385691336', '49.244.148.137, Mozilla/5.0 (Windows NT 5.1) Apple'),
(232, 14, 82, 105578, '1376849700', 0, 0, '1385868226', '49.244.145.83, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(233, 14, 82.1, 105955, '1378059300', 0, 0, '1385868303', '49.244.145.83, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(234, 14, 81, 106461, '1379528100', 0, 0, '1385868352', '49.244.145.83, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(235, 14, 80, 106852, '1380219300', 0, 0, '1385868433', '49.244.145.83, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(236, 14, 80, 107189, '1384020900', 0, 0, '1385868517', '49.244.145.83, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(237, 14, 80.01, 107510, '1384625700', 0, 0, '1385868571', '49.244.145.83, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(238, 14, 64.5, 70937, '1385576100', 0, 0, '1385868641', '49.244.145.83, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(239, 12, 38, 87172, '1385748900', 0, 0, '1385868745', '49.244.145.83, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(240, 13, 62.08, 152236, '1385576100', 0, 0, '1385868814', '49.244.145.83, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(241, 11, 20, 124283, '1385921700', 0, 0, '1386410610', '49.244.151.187, Mozilla/5.0 (Windows NT 5.1) Apple'),
(242, 11, 56.1, 124405, '1386008100', 0, 0, '1386410679', '49.244.151.187, Mozilla/5.0 (Windows NT 5.1) Apple'),
(243, 15, 20, 36723, '1385921700', 0, 0, '1386410758', '49.244.151.187, Mozilla/5.0 (Windows NT 5.1) Apple'),
(244, 15, 49, 36808, '1386008100', 0, 0, '1386410796', '49.244.151.187, Mozilla/5.0 (Windows NT 5.1) Apple'),
(245, 15, 62, 37087, '1386267300', 0, 0, '1386410839', '49.244.151.187, Mozilla/5.0 (Windows NT 5.1) Apple'),
(246, 13, 41.3, 152596, '1386008100', 0, 0, '1386410964', '49.244.137.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(247, 12, 20, 87247, '1385921700', 0, 0, '1386411057', '49.244.137.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(248, 12, 34, 87307, '1386008100', 0, 0, '1386411093', '49.244.137.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(249, 12, 37.01, 87504, '1386267300', 0, 0, '1386411145', '49.244.137.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(250, 16, 20, 71216, '1385921700', 0, 0, '1386411200', '49.244.137.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(251, 16, 50, 71317, '1386008100', 0, 0, '1386411243', '49.244.137.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(252, 16, 57, 71600, '1386267300', 0, 0, '1386411285', '49.244.137.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(253, 11, 68.2, 124825, '1386267300', 0, 0, '1386411465', '49.244.137.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(254, 14, 80.02, 107913, '1386267300', 0, 0, '1386411692', '49.244.137.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(255, 14, 80.02, 107913, '1386267300', 0, 0, '1386411701', '49.244.137.246, Mozilla/5.0 (Windows NT 5.1) Apple'),
(256, 11, 74, 125283, '1386699300', 0, 0, '1387087604', '49.244.136.248, Mozilla/5.0 (Windows NT 5.1) Apple'),
(257, 12, 42.71, 87727, '1386699300', 0, 0, '1387088047', '49.244.136.248, Mozilla/5.0 (Windows NT 5.1) Apple'),
(258, 13, 65, 152967, '1386440100', 0, 0, '1387088115', '49.244.136.248, Mozilla/5.0 (Windows NT 5.1) Apple'),
(259, 13, 45, 153250, '1386699300', 0, 0, '1387088156', '49.244.136.248, Mozilla/5.0 (Windows NT 5.1) Apple'),
(260, 15, 70, 37415, '1386699300', 0, 0, '1387088283', '49.244.136.248, Mozilla/5.0 (Windows NT 5.1) Apple'),
(261, 16, 70, 71969, '1386699300', 0, 0, '1387088495', '49.244.136.248, Mozilla/5.0 (Windows NT 5.1) Apple'),
(262, 14, 80.02, 107510, '1386267300', 0, 0, '1387088561', '49.244.136.248, Mozilla/5.0 (Windows NT 5.1) Apple'),
(263, 11, 51, 125614, '1387044900', 0, 0, '1387168897', '49.244.148.197, Mozilla/5.0 (Windows NT 5.1) Apple'),
(264, 15, 50, 37638, '1387044900', 0, 0, '1387168967', '49.244.148.197, Mozilla/5.0 (Windows NT 5.1) Apple'),
(265, 13, 45, 153513, '1387044900', 0, 0, '1387169045', '49.244.148.197, Mozilla/5.0 (Windows NT 5.1) Apple'),
(266, 12, 41, 87935, '1387044900', 0, 0, '1387169102', '49.244.148.197, Mozilla/5.0 (Windows NT 5.1) Apple'),
(267, 16, 59, 72272, '1387044900', 0, 0, '1387169147', '49.244.148.197, Mozilla/5.0 (Windows NT 5.1) Apple'),
(268, 11, 61, 125975, '1387390500', 0, 0, '1387690134', '49.244.168.147, Mozilla/5.0 (Windows NT 5.1) Apple'),
(269, 15, 60, 37858, '1387390500', 0, 0, '1387690233', '49.244.168.147, Mozilla/5.0 (Windows NT 5.1) Apple'),
(270, 12, 64.5, 88165, '1387476900', 0, 0, '1387690328', '49.244.168.147, Mozilla/5.0 (Windows NT 5.1) Apple'),
(271, 16, 50.3, 72537, '1387390500', 0, 0, '1387690399', '49.244.168.147, Mozilla/5.0 (Windows NT 5.1) Apple'),
(272, 11, 77, 126448, '1387822500', 0, 0, '1388398467', '49.244.144.143, Mozilla/5.0 (Windows NT 5.1) Apple'),
(273, 15, 20, 37943, '1387563300', 0, 0, '1388398521', '49.244.144.143, Mozilla/5.0 (Windows NT 5.1) Apple'),
(274, 15, 56, 38222, '1387822500', 0, 0, '1388398559', '49.244.144.143, Mozilla/5.0 (Windows NT 5.1) Apple'),
(275, 13, 62, 154254, '1387822500', 0, 0, '1388398609', '49.244.144.143, Mozilla/5.0 (Windows NT 5.1) Apple'),
(276, 12, 37.24, 88344, '1387822500', 0, 0, '1388398651', '49.244.144.143, Mozilla/5.0 (Windows NT 5.1) Apple'),
(277, 16, 46, 72770, '1387649700', 0, 0, '1388398694', '49.244.144.143, Mozilla/5.0 (Windows NT 5.1) Apple'),
(278, 16, 35, 72951, '1387822500', 0, 0, '1388399013', '49.244.165.91, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(279, 14, 83.6, 108389, '1387304100', 0, 0, '1388399078', '49.244.165.91, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(280, 16, 50, 73224, '1388254500', 0, 0, '1388539769', '49.244.155.47, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(281, 12, 46.7, 88580, '1388427300', 0, 0, '1388539829', '49.244.155.47, Mozilla/5.0 (Windows NT 5.1) AppleW'),
(282, 13, 66, 154635, '1388427300', 0, 0, '1388539988', '49.244.137.114, Mozilla/5.0 (Windows NT 5.1) Apple'),
(283, 15, 70, 38552, '1388427300', 0, 0, '1388540028', '49.244.137.114, Mozilla/5.0 (Windows NT 5.1) Apple'),
(284, 11, 78, 126930, '1388427300', 0, 0, '1388540075', '49.244.137.114, Mozilla/5.0 (Windows NT 5.1) Apple');

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_payment_type`
--

CREATE TABLE IF NOT EXISTS `aiap97af_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_sessions`
--

CREATE TABLE IF NOT EXISTS `aiap97af_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `aiap97af_stock`
--

CREATE TABLE IF NOT EXISTS `aiap97af_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `cp` float NOT NULL,
  `sp` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `initial_quantity` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_suppliers`
--

CREATE TABLE IF NOT EXISTS `aiap97af_suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `phone1` int(11) NOT NULL,
  `phone2` int(11) NOT NULL,
  `phone3` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_taxes`
--

CREATE TABLE IF NOT EXISTS `aiap97af_taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_transactions`
--

CREATE TABLE IF NOT EXISTS `aiap97af_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `inventory` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `discount` varchar(10) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaction_id` (`transaction_id`),
  KEY `customer` (`customer`),
  KEY `inventory` (`inventory`),
  KEY `payment_type` (`payment_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_users`
--

CREATE TABLE IF NOT EXISTS `aiap97af_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_role` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;


-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_user_autologin`
--

CREATE TABLE IF NOT EXISTS `aiap97af_user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_user_profiles`
--

CREATE TABLE IF NOT EXISTS `aiap97af_user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `aiap97af_user_profiles`
--

INSERT INTO `aiap97af_user_profiles` (`id`, `user_id`, `country`, `website`) VALUES
(1, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_user_roles`
--

CREATE TABLE IF NOT EXISTS `aiap97af_user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` varchar(200) COLLATE utf8_bin NOT NULL,
  `methods` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `aiap97af_user_roles`
--

INSERT INTO `aiap97af_user_roles` (`id`, `name`, `description`, `methods`) VALUES
(1, 'Superadmin', 'Only @chubach. Invisible + all super-powers. ;)', '{"king":"yes"}'),
(2, 'Admin', 'Generally a school administrator', '{"vehicle":["all"]}'),
(3, 'Storekeeper', 'Isn''t it obvious?', '{"welcome": "all", "auth":"all","customer":"all","inventory":"all","stock":"all","transaction":"all","vehicle":"all","warehouse":"all"}');

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_vehicles`
--

CREATE TABLE IF NOT EXISTS `aiap97af_vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `vehicle_number` varchar(100) NOT NULL,
  `fuel_capacity` float NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `aiap97af_vehicles`
--

INSERT INTO `aiap97af_vehicles` (`id`, `code`, `name`, `vehicle_number`, `fuel_capacity`, `added_by`, `added_on`, `identification`) VALUES
(11, 'VH-070/07/1', 'Bus A', '1356', 100, 0, '1383288919', '49.244.131.196, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(12, 'VH-070/07/2', 'Bus B', '851', 90, 0, '1383289218', '49.244.131.196, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(13, 'VH-070/07/3', 'Bus C', '383', 100, 0, '1383289246', '49.244.131.196, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(14, 'VH-070/07/4', 'Bus D', '584', 100, 0, '1383289270', '49.244.131.196, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(15, 'VH-070/07/5', 'Bus E', '1910', 100, 0, '1383289303', '49.244.131.196, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(16, 'VH-070/07/6', 'Bus F Mahindra', '2034', 75, 0, '1383289331', '49.244.131.196, Mozilla/5.0 (Windows NT 6.1; WOW64');

-- --------------------------------------------------------

--
-- Table structure for table `aiap97af_warehouse`
--

CREATE TABLE IF NOT EXISTS `aiap97af_warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `location1` varchar(50) NOT NULL,
  `location2` varchar(50) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` varchar(20) NOT NULL,
  `identification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `aiap97af_warehouse`
--

INSERT INTO `aiap97af_warehouse` (`id`, `code`, `name`, `location1`, `location2`, `added_by`, `added_on`, `identification`) VALUES
(8, 'WH-070/06/1', 'store 1', '11', '22', 0, '1380706741', '49.244.157.176, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(9, 'WH-070/07/1', 'Stationery store', 'Old building', 'near jr office', 0, '1383289551', '49.244.131.196, Mozilla/5.0 (Windows NT 6.1; WOW64'),
(10, 'WH-070/07/2', 'Kitchen Store', 'Previous lib building', 'near notice board', 0, '1383289679', '49.244.131.196, Mozilla/5.0 (Windows NT 6.1; WOW64');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
