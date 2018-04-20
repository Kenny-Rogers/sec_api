-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2018 at 04:25 AM
-- Server version: 10.2.14-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `police_sec`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `image` varchar(500) NOT NULL,
  `author` int(11) NOT NULL,
  `date_published` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `message`, `image`, `author`, `date_published`) VALUES
(1, 'wanted', 'this man is wanted', 'img_4528.png', 1, '2018-02-28'),
(2, 'dfdf', 'fgfg', 'img_7960.png', 1, '2018-02-28'),
(3, 'dgfgf', 'hgbb', 'img_7853.png', 1, '2018-02-28'),
(4, 'Ghenans', 'jdfhidfipd', 'img_7104.png', 1, '2018-03-02'),
(5, 'safety tip', 'fggfd', 'img_5749.png', 1, '2018-03-08'),
(6, 'Edinam\'s hair', 'it is soo nice', 'img_1683.png', 1, '2018-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `id` int(11) NOT NULL,
  `nature_of_issue` varchar(500) NOT NULL,
  `complainant_id` varchar(500) NOT NULL,
  `type_issue` varchar(500) NOT NULL,
  `date_time_of_report` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`id`, `nature_of_issue`, `complainant_id`, `type_issue`, `date_time_of_report`) VALUES
(1, 'home fight', '2', '1', '2018-02-09 10:20:20'),
(2, 'school fight', '1', '1', '2018-02-09 10:20:20'),
(3, 'fhj', '14', 'Armed Robbery', '2018-04-20 04:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `complainant`
--

CREATE TABLE `complainant` (
  `id` int(11) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `other_names` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `telephone` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complainant`
--

INSERT INTO `complainant` (`id`, `first_name`, `last_name`, `other_names`, `email`, `telephone`, `address`, `password`) VALUES
(1, 'kennedy', 'lodonu', 'yaw', 'ylodonu@gmail.com', '0554598026', 'p.o.box 505 ', ''),
(2, 'kennedy', 'lodonu', 'yaw', 'ylodonu@gmail.com', '0554598026', 'p.o.box 505 ', ''),
(6, 'kennedy', 'lodonu', 'yaw', 'ylodonu@gmail.com', '0554598026', 'p.o.box 505 ', ''),
(7, 'ken', 'lodonu', 'yaw', 'ylodonu@gmail.com', '0554598026', 'p.o.box 505 ', ''),
(8, 'kwasi', 'lodonu', 'yaw', 'ylodonu@gmail.com', '0554598026', 'p.o.box 505 ', ''),
(14, 'kofi', 'mensah', '', 'kmens@gmail.com', '500003941', 'ks ', 'kofi'),
(15, 'gshs', 'sgh', 'gst', 'hi@gmail.com', '500003941', 'sgsg ', 'ghk'),
(16, 'gshs', 'sgh', 'gst', 'hi@gmail.com', '500003941', 'sgsg ', 'ghk'),
(17, 'dhdh', 'hfk', 'hdj', 'gh@gmail.com', '500003941', 'sjj ', 'ghj');

-- --------------------------------------------------------

--
-- Table structure for table `complain_action`
--

CREATE TABLE `complain_action` (
  `id` int(11) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `type_of_action` int(11) NOT NULL,
  `date_time_of_action` datetime NOT NULL,
  `details_of_action` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deployment_plan`
--

CREATE TABLE `deployment_plan` (
  `id` int(11) NOT NULL,
  `secretariat_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `schedule_for_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deployment_plan`
--

INSERT INTO `deployment_plan` (`id`, `secretariat_id`, `date_created`, `schedule_for_date`) VALUES
(1, 3, '2017-10-10', '2018-01-11'),
(2, 3, '2017-10-10', '2018-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL,
  `dep_plan_id` int(11) NOT NULL,
  `pat_team_id` int(11) NOT NULL,
  `jurisdiction` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `dep_plan_id`, `pat_team_id`, `jurisdiction`) VALUES
(1, 1, 1, 'lapaz '),
(2, 1, 2, 'legon '),
(3, 2, 2, 'nima ');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `geo_lat` varchar(500) NOT NULL,
  `geo_long` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_updated` datetime NOT NULL,
  `type_of_user` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `geo_lat`, `geo_long`, `user_id`, `last_updated`, `type_of_user`) VALUES
(59, '45', '456', 4, '2018-04-12 10:56:23', 'patrol_team '),
(61, '5.654425048128516', '-0.1837111354980639', 4, '2018-02-13 09:09:08', 'patrol_team '),
(81, '5.6563825', '-0.1811177', 4, '2018-03-20 22:34:19', 'patrol_team '),
(82, '5.6563825', '-0.1811177', 4, '2018-03-20 22:34:22', 'patrol_team '),
(83, '5.6563825', '-0.1811177', 4, '2018-03-20 22:34:24', 'patrol_team '),
(84, '5.6563825', '-0.1811177', 4, '2018-03-20 22:34:27', 'patrol_team '),
(85, '5.6563825', '-0.1811177', 4, '2018-03-20 22:34:29', 'patrol_team '),
(110, '5.5779457', '5.5779457', 3, '2018-04-20 04:20:30', 'complainant ');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `complain_action_id` varchar(500) NOT NULL,
  `receiver_type` varchar(500) NOT NULL,
  `reveiver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patrol_team`
--

CREATE TABLE `patrol_team` (
  `id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `leader_id` int(11) NOT NULL,
  `team_name` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `expiration` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patrol_team`
--

INSERT INTO `patrol_team` (`id`, `date_created`, `leader_id`, `team_name`, `password`, `status`, `expiration`) VALUES
(1, '2017-10-10', 16, 'Alpha_tango_1', '236', 'offline', 'false'),
(2, '2017-10-10', 8, 'alpha_tango_7', 'xccxc', 'online', 'false'),
(3, '2017-10-10', 4, 'tango_6', 'jokidf', 'offline', 'false'),
(4, '2017-10-10', 15, 'bates', 'asasa', 'online', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `patrol_team_member`
--

CREATE TABLE `patrol_team_member` (
  `id` int(11) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `patrol_team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patrol_team_member`
--

INSERT INTO `patrol_team_member` (`id`, `personnel_id`, `patrol_team_id`) VALUES
(1, 4, 1),
(2, 18, 4);

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `other_names` varchar(500) NOT NULL,
  `rank` varchar(500) NOT NULL,
  `staff_no` varchar(500) NOT NULL,
  `sec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `first_name`, `last_name`, `other_names`, `rank`, `staff_no`, `sec_id`) VALUES
(3, 'kofi', 'sdsd', 'mkmk', 'asp', 'dfdf ', 3),
(4, 'kofi', 'lorf', 'lodo', 'asp', '455 ', 3),
(5, 'kofi', 'lorf', 'lodo', 'asp', '4565 ', 3),
(6, 'kodi', 'sdsd', 'sdd', 'asp', '456 ', 3),
(7, 'kodi', 'sdsd', 'sdd', 'asp', '456 ', 3),
(8, 'kodi', 'sdsd', 'sdd', 'asp', '456 ', 3),
(9, 'kodi', 'sdsd', 'sdd', 'dsp', '7896', 3),
(10, 'ama', 'wdcd', 'sffdf', 'asp', '456 ', 3),
(11, 'kennedy', 'Lodonu', 'Yaw', 'dsp', '963 ', 3),
(12, 'Adjowa', 'mansah', 'sdd', 'dsp', '7823 ', 3),
(13, 'kofi', 'sds', 'dsd', 'dsp', '7823 ', 3),
(14, 'Justice', 'Appati', 'Kwame', 'dcop', '48995 ', 3),
(15, 'Kofi', 'Mensah', 'yaw', 'dsp', '7896 ', 3),
(16, 'Yaa', 'Yaa', 'Yaa', 'dcop', '456 ', 3),
(17, 'Adjowa', 'mansah', 'sdd', 'asp', '6523', 4),
(18, 'Lodo', 'Lodonu', 'yass', 'asp', '456', 4);

-- --------------------------------------------------------

--
-- Table structure for table `secretariat`
--

CREATE TABLE `secretariat` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rep_id` int(11) NOT NULL,
  `lat` varchar(500) NOT NULL,
  `lng` varchar(500) NOT NULL,
  `date_published` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secretariat`
--

INSERT INTO `secretariat` (`id`, `type`, `region`, `name`, `rep_id`, `lat`, `lng`, `date_published`) VALUES
(3, 'dist_cm', 'gr ', 'Nima police station', 2, '5.981773805602031', '-2.17664294912106016', '2018-04-05'),
(4, 'div_cm', 'gr ', 'Lapaz Police Station', 5, '5.781773805602031', '-1.17664294912106016', '2018-04-05'),
(5, 'reg_hqr', 'gr ', 'Legon police station', 4, '4.581773805602031', '-0.47664294912106016', '2018-04-05'),
(6, 'dist_cm', 'er', 'Agogo', 6, '5.981773805602031', '0.17664294912106016', '2018-04-05'),
(7, 'reg_hqr', 'gr', 'sdd', 1, '5.581773805602031', '-0.17664294912106016', '2018-04-05'),
(8, 'dist_cm', 'gr', 'Madina', 3, '5.650629802041961', '-0.1794328592968668', '2018-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `system_user`
--

CREATE TABLE `system_user` (
  `id` int(11) NOT NULL,
  `personnel_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_user`
--

INSERT INTO `system_user` (`id`, `personnel_id`, `status`, `role`, `user_name`, `password`) VALUES
(1, 9, 'offline', 'secretariat representative', 'jkd', 'sddd '),
(2, 10, 'offline', 'dispatcher', 'jfj', 'dffg '),
(3, 11, 'offline', 'secretariat representative', 'kodi', 'kodi2dd '),
(4, 12, 'offline', 'secretariat representative', 'kpp', 'dfvfg '),
(5, 13, 'offline', 'secretariat representative', 'sdsdd', 'dfdfdif '),
(6, 14, 'offline', 'secretariat representative', 'kwame', 'kwame '),
(7, 7, 'offline', 'secretariat representative', 'sdsds', 'fgfgfg '),
(9, 17, 'offline', 'secretariat representative', 'sdsd', '5661223 ');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_action`
--

CREATE TABLE `type_of_action` (
  `id` int(11) NOT NULL,
  `action` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complainant`
--
ALTER TABLE `complainant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complain_action`
--
ALTER TABLE `complain_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deployment_plan`
--
ALTER TABLE `deployment_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patrol_team`
--
ALTER TABLE `patrol_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patrol_team_member`
--
ALTER TABLE `patrol_team_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secretariat`
--
ALTER TABLE `secretariat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_user`
--
ALTER TABLE `system_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_action`
--
ALTER TABLE `type_of_action`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complainant`
--
ALTER TABLE `complainant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `deployment_plan`
--
ALTER TABLE `deployment_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `patrol_team`
--
ALTER TABLE `patrol_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patrol_team_member`
--
ALTER TABLE `patrol_team_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `secretariat`
--
ALTER TABLE `secretariat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_user`
--
ALTER TABLE `system_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
