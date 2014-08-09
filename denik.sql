-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Sob 09. srp 2014, 20:20
-- Verze MySQL: 5.5.24-log
-- Verze PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `denik`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=3 ;

--
-- Vypisuji data pro tabulku `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', '123'),
(2, 'lubos', 'kovar');

-- --------------------------------------------------------

--
-- Struktura tabulky `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file1` varchar(150) COLLATE utf8_czech_ci NOT NULL,
  `file2` varchar(150) COLLATE utf8_czech_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `duration` int(11) NOT NULL,
  `url` varchar(250) COLLATE utf8_czech_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL,
  `sortable` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=16 ;

--
-- Vypisuji data pro tabulku `banners`
--

INSERT INTO `banners` (`id`, `file1`, `file2`, `start`, `end`, `duration`, `url`, `active`, `date`, `sortable`) VALUES
(5, '2013-06-17_22-02-26.jpg', '2013-06-14-PharmaProjects-banner-2048x150@2x.jpg', '2013-06-14', '2013-12-31', 5, 'www.pharmaprojects.cz', 1, '2013-06-14 12:34:39', 6),
(6, '2013-06-17-bb.jpg', '2013-06-14-Probiofix-Imu-2048x150@2x.jpg', '2013-06-14', '2013-12-31', 5, 'www.probiofiximu.cz', 1, '2013-06-14 12:36:12', 5),
(7, '2013-06-17-a11.jpg', '2013-06-14-Ellen-krem-2048x150@2x.jpg', '2013-06-14', '2013-01-31', 5, 'www.ellen-krem.cz', 1, '2013-06-14 12:37:51', 7),
(9, '2013-06-14_13-57-10.jpg', '2013-06-14_13-57-10@2x.jpg', '2013-06-14', '2014-04-30', 5, 'www.denikpacienta.cz', 1, '2013-06-14 13:57:10', 2),
(10, '2013-06-14_14-00-34.jpg', '2013-06-14_14-00-34@2x.jpg', '2013-06-14', '2014-06-30', 5, 'www.evinoteka.com', 1, '2013-06-14 14:00:34', 0),
(11, '2013-06-17_16-09-56.jpg', '2013-06-17_16-09-56@2x.jpg', '2013-06-01', '2014-08-31', 5, 'www.kapcz.cz', 1, '2013-06-17 16:09:56', 1),
(12, '2013-06-17_16-16-41.jpg', '2013-06-17_16-16-41@2x.jpg', '2013-06-14', '2013-12-31', 5, 'www.ellen-tampony.cz', 1, '2013-06-17 16:16:41', 3),
(15, '2013-06-17_21-15-13.jpg', '2013-06-17_21-15-13@2x.jpg', '2013-06-01', '2013-06-30', 10, 'www.luboszalom.cz', 1, '2013-06-17 21:15:13', 4);

-- --------------------------------------------------------

--
-- Struktura tabulky `bins`
--

CREATE TABLE IF NOT EXISTS `bins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(150) COLLATE utf8_czech_ci NOT NULL,
  `date` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=32 ;

--
-- Vypisuji data pro tabulku `bins`
--

INSERT INTO `bins` (`id`, `file`, `date`, `user`) VALUES
(1, '4-2013-05-14_07-31-19.bin', '2013-05-14 07:31:29', 9),
(2, '4-2013-05-14_07-43-01.bin', '2013-05-14 07:43:11', 9),
(3, '4-2013-05-14_07-44-39.bin', '2013-05-14 07:44:50', 9),
(4, '4-2013-05-14_07-44-58.bin', '2013-05-14 07:45:08', 9),
(5, '4-2013-05-15_10-17-59.bin', '2013-05-15 10:18:03', 9),
(6, '4-2013-05-15_10-19-07.bin', '2013-05-15 10:19:11', 9),
(7, '4-2013-05-15_10-31-47.bin', '2013-05-15 10:31:51', 9),
(8, '4-2013-05-16_14-32-29.bin', '2013-05-16 14:32:42', 4),
(9, '4-2013-05-16_16-46-05.bin', '2013-05-16 16:46:21', 4),
(10, '4-2013-05-20_09-21-44.bin', '2013-05-20 09:21:42', 4),
(11, '4-2013-05-20_15-15-02.bin', '2013-05-20 15:15:00', 4),
(12, '4-2013-05-21_09-05-11.bin', '2013-05-21 09:05:11', 4),
(13, '4-2013-05-21_09-07-50.bin', '2013-05-21 09:07:51', 4),
(14, '8-2013-05-22_12-52-38.bin', '2013-05-22 12:52:42', 8),
(15, '8-2013-05-22_12-56-10.bin', '2013-05-22 12:56:14', 8),
(16, '4-2013-05-22_13-35-56.bin', '2013-05-22 13:35:54', 4),
(17, '8-2013-05-22_15-15-14.bin', '2013-05-22 15:15:19', 8),
(18, '8-2013-05-23_09-40-25.bin', '2013-05-23 09:40:29', 8),
(19, '4-2013-05-23_16-10-56.bin', '2013-05-23 16:11:03', 4),
(20, '8-2013-05-23_20-30-50.bin', '2013-05-23 20:31:03', 8),
(21, '8-2013-05-27_20-14-56.bin', '2013-05-27 20:14:58', 8),
(22, '8-2013-05-27_20-27-58.bin', '2013-05-27 20:28:06', 8),
(23, '8-2013-05-27_20-40-38.bin', '2013-05-27 20:40:49', 8),
(24, '8-2013-06-03_19-11-59.bin', '2013-06-03 19:12:06', 8),
(25, '11-2013-06-05_09-57-00.bin', '2013-06-05 09:57:01', 11),
(26, '8-2013-06-05_20-20-56.bin', '2013-06-05 20:20:59', 8),
(27, '16-2013-06-07_14-39-37.bin', '2013-06-07 14:39:36', 16),
(28, '15-2013-06-07_14-41-00.bin', '2013-06-07 14:40:58', 15),
(29, '8-2013-06-11_09-06-38.bin', '2013-06-11 09:06:39', 8),
(30, '13-2013-06-13_08-49-48.bin', '2013-06-13 08:49:51', 13),
(31, '17-2013-06-13_20-35-49.bin', '2013-06-13 20:33:52', 17);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  `phone` varchar(150) COLLATE utf8_czech_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  `active` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=23 ;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `email`, `phone`, `pass`, `active`, `date`) VALUES
(4, 'kunhart@codecreator.cz', '+420775555356', 'e5b5e945047c4b2a4c5b7e124b816d5c', 1, '2013-05-09 14:39:21'),
(8, 'lubos.kovar@kapcz.cz', '+420777871451', 'ff6aecb4ee649587683c8ce8eefb3d82', 1, '2013-05-22 08:24:51'),
(9, 'denik@berto.cz', '+420602753043', '955db0b81ef1989b4a4dfeae8061a9a6', 1, '2013-05-22 09:14:20'),
(11, 'hanousek@codecreator.cz', '+420775555357', 'af705bb4623db29c2e4bf2a8389ad552', 1, '2013-06-05 09:47:05'),
(12, 'standavdf@seznam.cz', '+420608972649', 'c3ace33058f62beb1e40cf615e89cab2', 1, '2013-06-06 00:47:19'),
(13, 'denisa.jelinkova@kapcz.cz', '+420777300050', '7eb3da08bb6d8a26f00e70dffe849614', 1, '2013-06-06 13:27:53'),
(14, 'Lsvarcl@gmail.com', '+420728210389', 'f224aee02762db48a7ff59f17c9ba65f', 1, '2013-06-06 14:21:19'),
(15, 'stefan.parkansky@kapcz.cz', '+420777727878', 'c8c89a9c4fb71f60f1b1d42e073540f4', 1, '2013-06-07 14:12:14'),
(16, 'kamila.habrova@kapcz.cz', '+420777781250', 'b981cbce34608a8f01bcc8d0442c41b9', 1, '2013-06-07 14:35:46'),
(17, 'Dan.gregorek@gmail.com', '+420724370074', '2c8f9d034b52966252694a2392ab7213', 1, '2013-06-10 19:30:23'),
(19, 'lubos.zalom@gmail.com', '+420608376504', '123', 1, '2013-06-17 21:14:34'),
(22, 'dsfsdfsdgs@seznam.cz', '+420123456789', '9135e2959d126796c28d4bcad868c9e7', 1, '2013-07-11 08:23:46');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
