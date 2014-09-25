-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2014 at 04:43 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mlm`
--

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE IF NOT EXISTS `commissions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `level` int(10) NOT NULL,
  `percent` decimal(10,0) NOT NULL,
  `mlm_type_id` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mlm_type_id` (`mlm_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=238 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`) VALUES
(1, 'Afghanistan', 'AFG'),
(2, 'Albania', 'ALB'),
(3, 'Algeria', 'DZA'),
(4, 'American Samoa', 'ASM'),
(5, 'Andorra', 'AND'),
(6, 'Angola', 'AGO'),
(7, 'Anguilla', 'AIA'),
(8, 'Antarctica', ''),
(9, 'Antigua and Barbuda', 'ATG'),
(10, 'Argentina', 'ARG'),
(11, 'Armenia', 'ARM'),
(12, 'Aruba', 'ABW'),
(13, 'Australia', 'AUS'),
(14, 'Austria', 'AUT'),
(15, 'Azerbaijan', 'AZE'),
(16, 'Bahamas', 'BHS'),
(17, 'Bahrain', 'BHR'),
(18, 'Bangladesh', 'BGD'),
(19, 'Barbados', 'BRB'),
(20, 'Belarus', 'BLR'),
(21, 'Belgium', 'BEL'),
(22, 'Belize', 'BLZ'),
(23, 'Benin', 'BEN'),
(24, 'Bermuda', 'BMU'),
(25, 'Bhutan', 'BTN'),
(26, 'Bolivia', 'BOL'),
(27, 'Bosnia and Herzegovina', 'BIH'),
(28, 'Botswana', 'BWA'),
(29, 'Brazil', 'BRA'),
(30, 'Brunei Darussalam', 'BRN'),
(31, 'Bulgaria', 'BGR'),
(32, 'Burkina Faso', 'BFA'),
(33, 'Burundi', 'BDI'),
(34, 'Cambodia', 'KHM'),
(35, 'Cameroon', 'CMR'),
(36, 'Canada', 'CAN'),
(37, 'Cape Verde', 'CPV'),
(38, 'Cayman Islands', 'CYM'),
(39, 'Central African Republic', 'CAF'),
(40, 'Chad', 'TCD'),
(41, 'Chile', 'CHL'),
(42, 'China', 'CHN'),
(43, 'Christmas Island', 'CXR'),
(44, 'Cocos (Keeling) Islands', 'CCK'),
(45, 'Colombia', 'COL'),
(46, 'Comoros', 'COM'),
(47, 'Democratic Republic of the Congo (Kinshasa)', 'COD'),
(48, 'Congo, Republic of (Brazzaville)', 'COG'),
(49, 'Cook Islands', 'COK'),
(50, 'Costa Rica', 'CRI'),
(51, 'Ivory Coast', 'CIV'),
(52, 'Croatia', 'HRV'),
(53, 'Cuba', 'CUB'),
(54, 'Cyprus', 'CYP'),
(55, 'Czech Republic', 'CZE'),
(56, 'Denmark', 'DNK'),
(57, 'Djibouti', 'DJI'),
(58, 'Dominica', 'DMA'),
(59, 'Dominican Republic', 'DOM'),
(60, 'East Timor (Timor-Leste)', 'TLS2'),
(61, 'Ecuador', 'ECU'),
(62, 'Egypt', 'EGY'),
(63, 'El Salvador', 'SLV'),
(64, 'Equatorial Guinea', 'GNQ'),
(65, 'Eritrea', 'ERI'),
(66, 'Estonia', 'EST'),
(67, 'Ethiopia', 'ETH'),
(68, 'Falkland Islands', 'FLK'),
(69, 'Faroe Islands', 'FRO'),
(70, 'Fiji', 'FJI'),
(71, 'Finland', 'FIN'),
(72, 'France', 'FRA'),
(73, 'French Guiana', 'GUF'),
(74, 'French Polynesia', 'PYF'),
(75, 'French Southern Territories', 'ATF'),
(76, 'Gabon', 'GAB'),
(77, 'Gambia', 'GMB'),
(78, 'Georgia', 'GEO'),
(79, 'Germany', 'DEU'),
(80, 'Ghana', 'GHA'),
(81, 'Gibraltar', 'GIB'),
(82, 'Great Britain', 'GBR'),
(83, 'Greece', 'GRC'),
(84, 'Greenland', 'GRL'),
(85, 'Grenada', 'GRD'),
(86, 'Guadeloupe', 'GLP'),
(87, 'Guam', 'GUM'),
(88, 'Guatemala', 'GTM'),
(89, 'Guinea', 'GIN'),
(90, 'Guinea-Bissau', 'GNB'),
(91, 'Guyana', 'GUY'),
(92, 'Haiti', 'HTI'),
(93, 'Holy See', 'VA'),
(94, 'Honduras', 'HND'),
(95, 'Hong Kong', 'HKG'),
(96, 'Hungary', 'HUN'),
(97, 'Iceland', 'ISL'),
(98, 'India', 'IND'),
(99, 'Indonesia', 'IDN'),
(100, 'Islamic Republic of Iran', 'IRN'),
(101, 'Iraq', 'IRQ'),
(102, 'Ireland', 'IRL'),
(103, 'Israel', 'ISR'),
(104, 'Italy', 'ITA'),
(105, 'Jamaica', 'JAM'),
(106, 'Japan', 'JPN'),
(107, 'Jordan', 'JOR'),
(108, 'Kazakhstan', 'KAZ'),
(109, 'Kenya', 'KEN'),
(110, 'Kiribati', 'KIR'),
(111, 'Democratic People''s Republic of Korea (North Korea)', 'PRK'),
(112, 'Republic of Korea (South Korea)', 'KOR'),
(113, 'Kosovo', ''),
(114, 'Kuwait', 'KWT'),
(115, 'Kyrgyzstan', 'KGZ'),
(116, 'People''s Democratic Republic of Lao', 'LAO'),
(117, 'Latvia', 'LVA'),
(118, 'Lebanon', 'LBN'),
(119, 'Lesotho', 'LSO'),
(120, 'Liberia', 'LBR'),
(121, 'Libya', 'LBY'),
(122, 'Liechtenstein', 'LIE'),
(123, 'Lithuania', 'LTU'),
(124, 'Luxembourg', 'LUX'),
(125, 'Macau', 'MAC'),
(126, 'Republic of Macedonia', 'MKD'),
(127, 'Madagascar', 'MDG'),
(128, 'Malawi', 'MWI'),
(129, 'Malaysia', 'MYS'),
(130, 'Maldives', 'MDV'),
(131, 'Mali', 'MLI'),
(132, 'Malta', 'MLT'),
(133, 'Marshall Islands', 'MHL'),
(134, 'Martinique', 'MTQ'),
(135, 'Mauritania', 'MRT'),
(136, 'Mauritius', 'MUS'),
(137, 'Mayotte', 'MYT'),
(138, 'Mexico', 'MEX'),
(139, 'Federal States of Micronesia', 'FSM'),
(140, 'Republic of Moldova', 'MDA'),
(141, 'Monaco', 'MCO'),
(142, 'Mongolia', 'MNG'),
(143, 'Montenegro', 'MNE'),
(144, 'Montserrat', 'MSR'),
(145, 'Morocco', 'MAR'),
(146, 'Mozambique', 'MOZ'),
(147, 'Myanmar, Burma', 'MMR'),
(148, 'Namibia', 'NAM'),
(149, 'Nauru', 'NRU'),
(150, 'Nepal', 'NPL'),
(151, 'Netherlands', 'NLD'),
(152, 'Netherlands Antilles', 'ANT'),
(153, 'New Caledonia', 'NCL'),
(154, 'New Zealand', 'NZL'),
(155, 'Nicaragua', 'NIC'),
(156, 'Niger', 'NER'),
(157, 'Nigeria', 'NGA'),
(158, 'Niue', 'NIU'),
(159, 'Northern Mariana Islands', 'MNP'),
(160, 'Norway', 'NOR'),
(161, 'Oman', 'OMN'),
(162, 'Pakistan', 'PAK'),
(163, 'Palau', 'PLW'),
(164, 'Palestinian Territories', 'PSE'),
(165, 'Panama', 'PAN'),
(166, 'Papua New Guinea', 'PNG'),
(167, 'Paraguay', 'PRY'),
(168, 'Peru', 'PER'),
(169, 'Philippines', 'PHL'),
(170, 'Pitcairn Island', 'PCN'),
(171, 'Poland', 'POL'),
(172, 'Portugal', 'PRT'),
(173, 'Puerto Rico', 'PRI'),
(174, 'Qatar', 'QAT'),
(175, 'Reunion Island', 'REU'),
(176, 'Romania', 'ROU'),
(177, 'Russian Federation', 'RUS'),
(178, 'Rwanda', 'RWA'),
(179, 'Saint Kitts and Nevis', 'KNA'),
(180, 'Saint Lucia', 'LCA'),
(181, 'Saint Vincent and the Grenadines', 'VCT'),
(182, 'Samoa', 'WSM'),
(183, 'San Marino', 'SMR'),
(184, 'Sao Tome and Principe', 'STP'),
(185, 'Saudi Arabia', 'SAU'),
(186, 'Senegal', 'SEN'),
(187, 'Serbia', 'SRB'),
(188, 'Seychelles', 'SYC'),
(189, 'Sierra Leone', 'SLE'),
(190, 'Singapore', 'SGP'),
(191, 'Slovakia (Slovak Republic)', 'SVK'),
(192, 'Slovenia', 'SVN'),
(193, 'Solomon Islands', 'SLB'),
(194, 'Somalia', 'SOM'),
(195, 'South Africa', 'ZAF'),
(196, 'South Sudan', 'SSD'),
(197, 'Spain', 'ESP'),
(198, 'Sri Lanka', 'LKA'),
(199, 'Sudan', 'SDN'),
(200, 'Suriname', 'SUR'),
(201, 'Swaziland', 'SWZ'),
(202, 'Sweden', 'SWE'),
(203, 'Switzerland', 'CHE'),
(204, 'Syria, Syrian Arab Republic', 'SYR'),
(205, 'Taiwan (Republic of China)', 'TWN'),
(206, 'Tajikistan', 'TJK'),
(207, 'Tanzania', 'TZA'),
(208, 'Thailand', 'THA'),
(209, 'Tibet', 'TIBET'),
(210, 'Timor-Leste (East Timor)', 'TLS'),
(211, 'Togo', 'TGO'),
(212, 'Tokelau', 'TKL'),
(213, 'Tonga', 'TON'),
(214, 'Trinidad and Tobago', 'TTO'),
(215, 'Tunisia', 'TUN'),
(216, 'Turkey', 'TUR'),
(217, 'Turkmenistan', 'TKM'),
(218, 'Turks and Caicos Islands', 'TCA'),
(219, 'Tuvalu', 'TUV'),
(220, 'Uganda', 'UGA'),
(221, 'Ukraine', 'UKR'),
(222, 'United Arab Emirates', 'ARE'),
(223, 'United Kingdom', 'GBR'),
(224, 'United States', 'USA'),
(225, 'Uruguay', 'URY'),
(226, 'Uzbekistan', 'UZB'),
(227, 'Vanuatu', 'VUT'),
(228, 'Vatican City State (Holy See)', 'VAT'),
(229, 'Venezuela', 'VEN'),
(230, 'Vietnam', 'VNM'),
(231, 'Virgin Islands (British)', 'VGB'),
(232, 'Virgin Islands (U.S.)', 'VIR'),
(233, 'Wallis and Futuna Islands', 'WLF'),
(234, 'Western Sahara', 'ESH'),
(235, 'Yemen', 'YEM'),
(236, 'Zambia', 'ZMB'),
(237, 'Zimbabwe', 'ZWE');

-- --------------------------------------------------------

--
-- Table structure for table `epins`
--

CREATE TABLE IF NOT EXISTS `epins` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `pin` varchar(100) NOT NULL,
  `value` decimal(10,0) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `generation_date` datetime NOT NULL,
  `used_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `owner_id` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pin` (`pin`),
  KEY `owner_id` (`owner_id`),
  KEY `used_date` (`used_date`),
  KEY `purpose` (`purpose`),
  KEY `generation_date` (`generation_date`),
  KEY `status` (`status`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `epins`
--

INSERT INTO `epins` (`id`, `pin`, `value`, `price`, `purpose`, `generation_date`, `used_date`, `status`, `user_id`, `owner_id`) VALUES
(1, 'WMLVC7EF5RGFKM4ZL', 1000, 500, 'membership', '2014-09-24 04:46:13', '0000-00-00 00:00:00', 'available', 0, 1),
(2, '7WTGC9K6JZ64BT4OF', 1000, 500, 'membership', '2014-09-25 04:23:04', '0000-00-00 00:00:00', 'available', 0, 1),
(3, 'CP6KFTDH7IBTG7523', 1000, 500, 'membership', '2014-09-25 04:27:36', '0000-00-00 00:00:00', 'available', 0, 1),
(4, 'GLZ1QRN5VW2HFMV9I', 1000, 500, 'membership', '2014-09-25 04:27:36', '0000-00-00 00:00:00', 'available', 0, 1),
(5, 'Z1ET63FNZH7RTDCEH', 1000, 500, 'membership', '2014-09-25 04:27:36', '0000-00-00 00:00:00', 'available', 0, 1),
(6, 'VMI0LBTNFKOG73OQL', 1000, 500, 'membership', '2014-09-25 04:49:35', '0000-00-00 00:00:00', 'available', 0, 1),
(7, 'YHXVPOD233DVDWOM0', 1000, 500, 'membership', '2014-09-25 04:49:35', '0000-00-00 00:00:00', 'available', 0, 1),
(8, '5S8MI8T8DZ2ZSN9QH', 1000, 500, 'membership', '2014-09-25 04:49:35', '0000-00-00 00:00:00', 'available', 0, 1),
(9, '0TOYH3XHRSZ15LBCT', 1000, 500, 'membership', '2014-09-25 04:49:35', '0000-00-00 00:00:00', 'available', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_types`
--

CREATE TABLE IF NOT EXISTS `mlm_types` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `child` int(5) NOT NULL,
  `depth` int(5) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `purpose` (`purpose`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mlm_types`
--

INSERT INTO `mlm_types` (`id`, `name`, `child`, `depth`, `purpose`, `active`) VALUES
(1, 'Matrix', 4, 10, 'membership', 1),
(2, 'Unilevel', 0, 0, 'membership', 0),
(3, 'Binary', 2, 10, 'membership', 0),
(4, 'Matrix', 4, 5, 'product', 0),
(5, 'Unilevel', 0, 10, 'product', 0),
(6, 'Binary', 2, 0, 'product', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `purpose` varchar(100) NOT NULL,
  `user_id` int(20) NOT NULL,
  `count` int(20) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `purpose` (`purpose`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `user_id` int(20) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `sponsor_id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `country_id` int(5) NOT NULL,
  `registration_date` datetime NOT NULL,
  `membership_mlm_type` int(5) NOT NULL,
  `product_mlm_type` int(5) NOT NULL,
  `role` varchar(10) NOT NULL,
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `sponsor_id` (`sponsor_id`),
  KEY `country_id` (`country_id`),
  KEY `registration_date` (`registration_date`),
  KEY `membership_mlm_type` (`membership_mlm_type`),
  KEY `product_mlm_type` (`product_mlm_type`),
  KEY `suspended` (`suspended`),
  KEY `activated` (`activated`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `sponsor_id`, `username`, `password`, `email`, `first_name`, `last_name`, `address`, `country_id`, `registration_date`, `membership_mlm_type`, `product_mlm_type`, `role`, `suspended`, `activated`) VALUES
(1, 0, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'mikelito92@gmail.com', 'Michael', 'Palacio', 'Piapi, Boulevard, Davao City', 169, '2014-09-08 00:00:00', 1, 4, 'admin', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
