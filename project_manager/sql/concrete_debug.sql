-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Mrz 2014 um 17:27
-- Server Version: 5.5.32
-- PHP-Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `concrete_debug`
--
CREATE DATABASE IF NOT EXISTS `concrete_debug` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `concrete_debug`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `btprojectmanagerpgattributes`
--

CREATE TABLE IF NOT EXISTS `btprojectmanagerpgattributes` (
  `bID` int(10) unsigned NOT NULL,
  `cText` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `btprojectmanagerpgattributes`
--

INSERT INTO `btprojectmanagerpgattributes` (`bID`, `cText`) VALUES
(1, 'BILD'),
(2, 'TEXT'),
(3, 'HTML'),
(4, 'JS/CSS'),
(5, 'FLOW');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `btprojectmanagerpgstatus`
--

CREATE TABLE IF NOT EXISTS `btprojectmanagerpgstatus` (
  `bID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pID` int(11) DEFAULT NULL,
  `aID` int(11) DEFAULT NULL,
  `cDate` date DEFAULT NULL,
  `uID` int(11) DEFAULT NULL,
  `sID` int(11) NOT NULL,
  PRIMARY KEY (`bID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `btprojectmanagerpgstatus`
--

INSERT INTO `btprojectmanagerpgstatus` (`bID`, `pID`, `aID`, `cDate`, `uID`, `sID`) VALUES
(1, 134, 1, '2014-03-03', 1, 1),
(2, 134, 2, '2014-03-03', 1, 2),
(3, 134, 3, '2014-03-03', 1, 3),
(4, 129, 2, '2014-03-03', 1, 1),
(5, 130, 5, '2014-03-03', 1, 2),
(6, 128, 2, '2014-03-03', 1, 1),
(7, 128, 3, '2014-03-03', 1, 3),
(8, 1, 1, '2014-03-03', 1, 3),
(9, 1, 5, '2014-03-03', 1, 3),
(10, 1, 2, '2014-03-03', 1, 3),
(11, 1, 3, '2014-03-03', 1, 3),
(12, 1, 4, '2014-03-03', 1, 3),
(13, 132, 5, '2014-03-03', 1, 3),
(14, 132, 1, '2014-03-03', 1, 2),
(15, 132, 2, '2014-03-03', 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
