-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2014 at 04:39 AM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
