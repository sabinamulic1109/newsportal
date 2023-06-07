-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2019 at 08:45 AM
-- Server version: 10.2.25-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vicitdig_democms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`, `type`, `email`) VALUES
(1, 'admin', 'f5fd9ed266685c0b3c380529a07309f77cbe2a3e', 'admin', 'support@vicitdigital.com'),
(2, 'superadmin', 'f5fd9ed266685c0b3c380529a07309f77cbe2a3e', 'admin', 'support@vicitdigital.com');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `col1` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col2` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col3` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col4` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col5` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col6` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col7` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col8` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col9` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col10` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col11` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col12` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col13` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col14` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col15` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col16` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col17` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col18` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col19` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `col20` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `datum` date NOT NULL,
  `ip` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumenti`
--

CREATE TABLE `dokumenti` (
  `id` int(11) NOT NULL,
  `naslov` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(450) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facebookconnect`
--

CREATE TABLE `facebookconnect` (
  `id` int(11) NOT NULL,
  `facebookpage` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `apikey` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `securitykey` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `appid` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `pageid` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `facebookconnect`
--

INSERT INTO `facebookconnect` (`id`, `facebookpage`, `apikey`, `securitykey`, `appid`, `pageid`) VALUES
(1, 'https://www.facebook.com/Vicittestpage-2033689670010886/', '2033689670010886', '1185764248242690', '1185764248242690', '2033689670010886');

-- --------------------------------------------------------

--
-- Table structure for table `galerija`
--

CREATE TABLE `galerija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `galerija`
--

INSERT INTO `galerija` (`id`, `naziv`) VALUES
(1, 'Header');

-- --------------------------------------------------------

--
-- Table structure for table `grupe`
--

CREATE TABLE `grupe` (
  `id` int(11) NOT NULL,
  `naziv` varchar(145) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(145) COLLATE utf8_unicode_ci NOT NULL,
  `pozicija` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE `homes` (
  `id` int(11) NOT NULL,
  `naslov` varchar(852) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(450) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messagestatus`
--

CREATE TABLE `messagestatus` (
  `id` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `message` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mymessages`
--

CREATE TABLE `mymessages` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE `novosti` (
  `id` int(11) NOT NULL,
  `grupa` varchar(245) COLLATE utf8_unicode_ci NOT NULL,
  `naslov` varchar(245) COLLATE utf8_unicode_ci NOT NULL,
  `podnaslov` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `tekst` longtext COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(245) COLLATE utf8_unicode_ci NOT NULL,
  `datum` date NOT NULL,
  `author` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visits` int(10) DEFAULT 0,
  `visible` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `podgrupe`
--

CREATE TABLE `podgrupe` (
  `id` int(11) NOT NULL,
  `grupa` int(11) NOT NULL,
  `naziv` varchar(145) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(145) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poruke`
--

CREATE TABLE `poruke` (
  `id` int(11) NOT NULL,
  `isRead` int(1) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postavke`
--

CREATE TABLE `postavke` (
  `id` int(11) NOT NULL,
  `naslov` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `kljucne` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(145) COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(145) COLLATE utf8_unicode_ci NOT NULL,
  `zemlja` varchar(145) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(145) COLLATE utf8_unicode_ci NOT NULL,
  `telefon2` varchar(145) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(145) COLLATE utf8_unicode_ci NOT NULL,
  `domena` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `postavke`
--

INSERT INTO `postavke` (`id`, `naslov`, `opis`, `kljucne`, `adresa`, `grad`, `zemlja`, `telefon`, `telefon2`, `email`, `domena`) VALUES
(1, 'Demo CMS', 'Demo CMS', 'Demo CMS, vicit digital, vicit digital agency', '-', 'Austin', 'TX', '-', '-', 'support@vicitdigital.com', 'https://vicitdigital.net/projects/democms');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `dog` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `dateArrival` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `timeArrival` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `dateDeparture` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `timeDeparture` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `userid` int(1) NOT NULL,
  `settings` int(1) NOT NULL,
  `content` int(1) NOT NULL,
  `slider` int(1) NOT NULL,
  `menu` int(1) NOT NULL,
  `news` int(1) NOT NULL,
  `gallery` int(1) NOT NULL,
  `reservations` int(1) NOT NULL,
  `testimonials` int(1) NOT NULL,
  `messages` int(1) NOT NULL,
  `users` int(1) NOT NULL,
  `userlogs` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `userid`, `settings`, `content`, `slider`, `menu`, `news`, `gallery`, `reservations`, `testimonials`, `messages`, `users`, `userlogs`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sendmailadmin`
--

CREATE TABLE `sendmailadmin` (
  `id` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `sendmail` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sendmailadmin`
--

INSERT INTO `sendmailadmin` (`id`, `admin`, `sendmail`) VALUES
(1, 2, 0),
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `naslov` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `podnaslov` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(245) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `id` int(11) NOT NULL,
  `galerija` int(11) NOT NULL,
  `foto` varchar(145) COLLATE utf8_unicode_ci NOT NULL,
  `naslov` varchar(840) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia`
--

CREATE TABLE `socialmedia` (
  `id` int(11) NOT NULL,
  `fbC` int(11) NOT NULL,
  `fbL` text COLLATE utf8_unicode_ci NOT NULL,
  `igC` int(11) NOT NULL,
  `igL` text COLLATE utf8_unicode_ci NOT NULL,
  `twC` int(11) NOT NULL,
  `twL` text COLLATE utf8_unicode_ci NOT NULL,
  `scC` int(11) NOT NULL,
  `scL` text COLLATE utf8_unicode_ci NOT NULL,
  `ytC` int(11) NOT NULL,
  `ytL` text COLLATE utf8_unicode_ci NOT NULL,
  `gpC` int(11) NOT NULL,
  `gpL` text COLLATE utf8_unicode_ci NOT NULL,
  `liC` int(11) NOT NULL,
  `liL` text COLLATE utf8_unicode_ci NOT NULL,
  `piC` int(11) NOT NULL,
  `piL` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `socialmedia`
--

INSERT INTO `socialmedia` (`id`, `fbC`, `fbL`, `igC`, `igL`, `twC`, `twL`, `scC`, `scL`, `ytC`, `ytL`, `gpC`, `gpL`, `liC`, `liL`, `piC`, `piL`) VALUES
(1, 1, 'Test', 0, '-', 0, '-', 1, 'hhhh', 0, '-', 0, '-', 0, '-', 1, 'Test 2');

-- --------------------------------------------------------

--
-- Table structure for table `tblfaq`
--

CREATE TABLE `tblfaq` (
  `id` int(11) NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblvisitnews`
--

CREATE TABLE `tblvisitnews` (
  `visitid` int(11) NOT NULL,
  `date` date NOT NULL,
  `ipaddress` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `newsid` int(11) NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblvisitpages`
--

CREATE TABLE `tblvisitpages` (
  `visitid` int(11) NOT NULL,
  `date` date NOT NULL,
  `ipaddress` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pageid` int(11) NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblvisits`
--

CREATE TABLE `tblvisits` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `month` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(4) NOT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tekst`
--

CREATE TABLE `tekst` (
  `id` int(11) NOT NULL,
  `naslov` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `podnaslov` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `opis` longtext COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(450) COLLATE utf8_unicode_ci NOT NULL,
  `pozicija` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `visits` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `authoremail` text COLLATE utf8_unicode_ci NOT NULL,
  `authorname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `authorlastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `testimonial` text COLLATE utf8_unicode_ci NOT NULL,
  `approved` int(1) NOT NULL,
  `date` date NOT NULL,
  `picture` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(10) NOT NULL,
  `user` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumenti`
--
ALTER TABLE `dokumenti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebookconnect`
--
ALTER TABLE `facebookconnect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galerija`
--
ALTER TABLE `galerija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupe`
--
ALTER TABLE `grupe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messagestatus`
--
ALTER TABLE `messagestatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mymessages`
--
ALTER TABLE `mymessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `novosti`
--
ALTER TABLE `novosti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `podgrupe`
--
ALTER TABLE `podgrupe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poruke`
--
ALTER TABLE `poruke`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postavke`
--
ALTER TABLE `postavke`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sendmailadmin`
--
ALTER TABLE `sendmailadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialmedia`
--
ALTER TABLE `socialmedia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfaq`
--
ALTER TABLE `tblfaq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblvisitnews`
--
ALTER TABLE `tblvisitnews`
  ADD PRIMARY KEY (`visitid`);

--
-- Indexes for table `tblvisitpages`
--
ALTER TABLE `tblvisitpages`
  ADD PRIMARY KEY (`visitid`);

--
-- Indexes for table `tblvisits`
--
ALTER TABLE `tblvisits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tekst`
--
ALTER TABLE `tekst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumenti`
--
ALTER TABLE `dokumenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facebookconnect`
--
ALTER TABLE `facebookconnect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galerija`
--
ALTER TABLE `galerija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grupe`
--
ALTER TABLE `grupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homes`
--
ALTER TABLE `homes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messagestatus`
--
ALTER TABLE `messagestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mymessages`
--
ALTER TABLE `mymessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `novosti`
--
ALTER TABLE `novosti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `podgrupe`
--
ALTER TABLE `podgrupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poruke`
--
ALTER TABLE `poruke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sendmailadmin`
--
ALTER TABLE `sendmailadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socialmedia`
--
ALTER TABLE `socialmedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblfaq`
--
ALTER TABLE `tblfaq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblvisitnews`
--
ALTER TABLE `tblvisitnews`
  MODIFY `visitid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblvisitpages`
--
ALTER TABLE `tblvisitpages`
  MODIFY `visitid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblvisits`
--
ALTER TABLE `tblvisits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tekst`
--
ALTER TABLE `tekst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
