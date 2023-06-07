-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 06, 2019 at 10:09 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `democms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `type` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`, `type`, `email`) VALUES
(1, 'admin', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'admin', 'email2@mail.com'),
(2, 'superadmin', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'admin', 'email@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `col1` text NOT NULL,
  `col2` text NOT NULL,
  `col3` text NOT NULL,
  `col4` text NOT NULL,
  `col5` text NOT NULL,
  `col6` text NOT NULL,
  `col7` text NOT NULL,
  `col8` text NOT NULL,
  `col9` text NOT NULL,
  `col10` text NOT NULL,
  `col11` text NOT NULL,
  `col12` text NOT NULL,
  `col13` text NOT NULL,
  `col14` text NOT NULL,
  `col15` text NOT NULL,
  `col16` text NOT NULL,
  `col17` text NOT NULL,
  `col18` text NOT NULL,
  `col19` text NOT NULL,
  `col20` text NOT NULL,
  `datum` date NOT NULL,
  `ip` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dokumenti`
--

DROP TABLE IF EXISTS `dokumenti`;
CREATE TABLE IF NOT EXISTS `dokumenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(450) NOT NULL,
  `file` varchar(450) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facebookconnect`
--

DROP TABLE IF EXISTS `facebookconnect`;
CREATE TABLE IF NOT EXISTS `facebookconnect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebookpage` text NOT NULL,
  `apikey` text NOT NULL,
  `securitykey` text NOT NULL,
  `appid` text NOT NULL,
  `pageid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facebookconnect`
--

INSERT INTO `facebookconnect` (`id`, `facebookpage`, `apikey`, `securitykey`, `appid`, `pageid`) VALUES
(1, 'https://www.facebook.com/Vicittestpage-2033689670010886/', '2033689670010886', '1185764248242690', '1185764248242690', '2033689670010886');

-- --------------------------------------------------------

--
-- Table structure for table `galerija`
--

DROP TABLE IF EXISTS `galerija`;
CREATE TABLE IF NOT EXISTS `galerija` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grupe`
--

DROP TABLE IF EXISTS `grupe`;
CREATE TABLE IF NOT EXISTS `grupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(145) NOT NULL,
  `url` varchar(145) NOT NULL,
  `pozicija` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

DROP TABLE IF EXISTS `homes`;
CREATE TABLE IF NOT EXISTS `homes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(852) NOT NULL,
  `foto` varchar(450) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messagestatus`
--

DROP TABLE IF EXISTS `messagestatus`;
CREATE TABLE IF NOT EXISTS `messagestatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  `message` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mymessages`
--

DROP TABLE IF EXISTS `mymessages`;
CREATE TABLE IF NOT EXISTS `mymessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

DROP TABLE IF EXISTS `novosti`;
CREATE TABLE IF NOT EXISTS `novosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupa` varchar(245) NOT NULL,
  `naslov` varchar(245) NOT NULL,
  `podnaslov` text NOT NULL,
  `tekst` longtext NOT NULL,
  `foto` varchar(245) NOT NULL,
  `datum` date NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `podgrupe`
--

DROP TABLE IF EXISTS `podgrupe`;
CREATE TABLE IF NOT EXISTS `podgrupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupa` int(11) NOT NULL,
  `naziv` varchar(145) NOT NULL,
  `url` varchar(145) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poruke`
--

DROP TABLE IF EXISTS `poruke`;
CREATE TABLE IF NOT EXISTS `poruke` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isRead` int(1) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postavke`
--

DROP TABLE IF EXISTS `postavke`;
CREATE TABLE IF NOT EXISTS `postavke` (
  `id` int(11) NOT NULL,
  `naslov` varchar(450) NOT NULL,
  `opis` varchar(450) NOT NULL,
  `kljucne` varchar(450) NOT NULL,
  `adresa` varchar(145) NOT NULL,
  `grad` varchar(145) NOT NULL,
  `zemlja` varchar(145) NOT NULL,
  `telefon` varchar(145) NOT NULL,
  `telefon2` varchar(145) NOT NULL,
  `email` varchar(145) NOT NULL,
  `domena` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postavke`
--

INSERT INTO `postavke` (`id`, `naslov`, `opis`, `kljucne`, `adresa`, `grad`, `zemlja`, `telefon`, `telefon2`, `email`, `domena`) VALUES
(1, 'Demo CMS', 'Demo CMS', 'Demo CMS, vicit digital, vicit digital agency', '-', 'Austin', 'TX', '-', '-', 'info@vicit.world', 'http://vicitdigital.com/');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dog` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `dateArrival` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `timeArrival` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `dateDeparture` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `timeDeparture` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `userlogs` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `sendmailadmin`;
CREATE TABLE IF NOT EXISTS `sendmailadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` int(11) NOT NULL,
  `sendmail` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(450) NOT NULL,
  `podnaslov` varchar(450) NOT NULL,
  `file` varchar(450) NOT NULL,
  `url` varchar(245) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

DROP TABLE IF EXISTS `slike`;
CREATE TABLE IF NOT EXISTS `slike` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `galerija` int(11) NOT NULL,
  `foto` varchar(145) NOT NULL,
  `naslov` varchar(840) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `socialmedia`
--

DROP TABLE IF EXISTS `socialmedia`;
CREATE TABLE IF NOT EXISTS `socialmedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `piL` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `socialmedia`
--

INSERT INTO `socialmedia` (`id`, `fbC`, `fbL`, `igC`, `igL`, `twC`, `twL`, `scC`, `scL`, `ytC`, `ytL`, `gpC`, `gpL`, `liC`, `liL`, `piC`, `piL`) VALUES
(1, 0, '-', 0, '-', 0, '-', 0, '-', 0, '-', 0, '-', 0, '-', 0, '-');

-- --------------------------------------------------------

--
-- Table structure for table `tblfaq`
--

DROP TABLE IF EXISTS `tblfaq`;
CREATE TABLE IF NOT EXISTS `tblfaq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `approved` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tekst`
--

DROP TABLE IF EXISTS `tekst`;
CREATE TABLE IF NOT EXISTS `tekst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(450) NOT NULL,
  `podnaslov` varchar(450) NOT NULL,
  `opis` longtext NOT NULL,
  `foto` varchar(450) NOT NULL,
  `pozicija` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authoremail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorlastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` int(1) NOT NULL,
  `date` date NOT NULL,
  `picture` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

DROP TABLE IF EXISTS `userlog`;
CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(300) COLLATE utf8_bin NOT NULL,
  `action` varchar(300) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
