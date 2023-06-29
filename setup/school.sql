-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Jun 2023 um 22:41
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `school`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `average`
--

CREATE TABLE `average` (
  `code` int(30) NOT NULL,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `student` int(30) NOT NULL,
  `worktype` int(30) NOT NULL,
  `average` int(30) NOT NULL,
  `coef` decimal(10,2) NOT NULL,
  `averagecoef` decimal(10,2) NOT NULL,
  `totalaverage` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `averagescale`
--

CREATE TABLE `averagescale` (
  `code` int(30) NOT NULL,
  `niveauE` varchar(10) NOT NULL,
  `niveauG` varchar(10) NOT NULL,
  `point` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `averagescale`
--

INSERT INTO `averagescale` (`code`, `niveauE`, `niveauG`, `point`) VALUES
(33, '0', '0', 6),
(34, '5', '5', 1),
(31, '5', '5', 2),
(30, '5', '4', 3),
(29, '4', '4', 4),
(28, '4', '3', 5),
(27, '4', '3', 6),
(26, '3', '2', 7),
(25, '3', '2', 8),
(24, '3', '2', 9),
(23, '2', '1', 10),
(22, '2', '1', 11),
(21, '2', '1', 12),
(20, '1', '1', 13),
(19, '1', '1', 14),
(35, '6', '6', 0),
(37, '11', '11', 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `averagetotal`
--

CREATE TABLE `averagetotal` (
  `code` int(30) NOT NULL,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `student` int(30) NOT NULL,
  `average` int(11) NOT NULL,
  `coef` decimal(5,2) NOT NULL,
  `coursename` varchar(30) NOT NULL,
  `niveau` varchar(30) NOT NULL,
  `niveauG` tinyint(1) NOT NULL,
  `averagecoef` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `classe`
--

CREATE TABLE `classe` (
  `classe` varchar(30) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `classe`
--

INSERT INTO `classe` (`classe`, `id`) VALUES
('10a', 5),
('10b', 6),
('11a', 3),
('11b', 4),
('12a', 1),
('12b', 2),
('1a', 23),
('1b', 24),
('2a', 21),
('2b', 22),
('3a', 19),
('3b', 20),
('4a', 17),
('4b', 18),
('5a', 15),
('5b', 16),
('6a', 13),
('6b', 14),
('7a', 11),
('7b', 12),
('8a', 9),
('8b', 10),
('9a', 7),
('9b', 8);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `classerequired`
--

CREATE TABLE `classerequired` (
  `code` int(30) NOT NULL,
  `classe` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `classerequired`
--

INSERT INTO `classerequired` (`code`, `classe`) VALUES
(1, '13'),
(2, '12'),
(3, '11'),
(4, '10'),
(5, '9'),
(6, '8'),
(7, '7'),
(8, '6'),
(9, '5'),
(10, '4'),
(11, '3'),
(12, '2'),
(13, '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `coefwork`
--

CREATE TABLE `coefwork` (
  `code` int(30) NOT NULL,
  `worktype` int(11) NOT NULL,
  `course` varchar(30) NOT NULL,
  `coef` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `coefwork`
--

INSERT INTO `coefwork` (`code`, `worktype`, `course`, `coef`) VALUES
(12, 0, 'FR02', 100),
(14, 1, 'FR01', 50),
(15, 2, 'FR01', 25),
(16, 4, 'FR01', 25),
(17, 6, 'FR02', 100),
(18, 0, 'FR02', 0),
(20, 1, 'BIO', 100),
(21, 1, 'CHE', 100),
(22, 1, 'SPOR', 100),
(23, 1, 'MUS', 100),
(24, 4, 'FR02', 50);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `course`
--

CREATE TABLE `course` (
  `code` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `coef` float(3,2) NOT NULL,
  `coursegroup` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `course`
--

INSERT INTO `course` (`code`, `name`, `coef`, `coursegroup`) VALUES
('BIO', 'Biologie', 1.00, ''),
('CHE', 'Chemie', 1.00, ''),
('DE01', 'Deutsch schreiben', 0.40, 'DE'),
('DE02', 'Deutsch Mündlich', 0.60, 'DE'),
('EN01', 'Englisch schreiben', 0.40, 'EN'),
('EN02', 'Englisch Mündlich', 0.60, 'EN'),
('FR01', 'FranzÃ¶sisch schreiben', 0.40, 'FR'),
('FR02', 'FranzÃ¶sisch Mündlich', 0.60, 'FR'),
('GEO', 'Geografie', 1.00, ''),
('GES', 'Geschichte', 1.00, ''),
('MATH', 'Mathematik', 1.00, ''),
('SPOR', 'Sport', 1.00, ''),
('test', 'matiÃ¨re test', 1.00, ''),
('WAHL01', 'Musik', 1.00, 'WAHL'),
('WAHL02', 'Technik', 1.00, 'WAHL'),
('WAHL03', 'Bildende Kunst', 1.00, 'WAHL'),
('WAHL04', 'Hauswirtschaft', 1.00, 'WAHL'),
('WIRT', 'Wirtschaft, Arbeit, Technik', 1.00, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `coursegroup`
--

CREATE TABLE `coursegroup` (
  `code` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `coursegroup`
--

INSERT INTO `coursegroup` (`code`, `name`) VALUES
('DE', 'Deutsch'),
('EN', 'Englisch'),
('FR', 'FranzÃ¶sisch'),
('WAHL', 'Wahlunterricht');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entry`
--

CREATE TABLE `entry` (
  `code` int(30) NOT NULL,
  `registration` int(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `niveauG` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `generation`
--

CREATE TABLE `generation` (
  `code` int(30) NOT NULL,
  `year` varchar(30) DEFAULT NULL,
  `semester` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `visibility` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `homework`
--

CREATE TABLE `homework` (
  `year` text NOT NULL,
  `semester` text NOT NULL,
  `classe` text NOT NULL,
  `course` text NOT NULL,
  `date` date NOT NULL,
  `homework` text NOT NULL,
  `code` int(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hour`
--

CREATE TABLE `hour` (
  `code` int(30) NOT NULL,
  `hour` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `hour`
--

INSERT INTO `hour` (`code`, `hour`) VALUES
(1, '1.'),
(2, '2.'),
(3, '3.'),
(4, '4.'),
(5, '5.'),
(6, '6.'),
(7, '7.'),
(8, '8.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `interface`
--

CREATE TABLE `interface` (
  `code` int(30) NOT NULL,
  `titre` text NOT NULL,
  `message1` text NOT NULL,
  `titre2` text NOT NULL,
  `titre3` text NOT NULL,
  `message2` text NOT NULL,
  `message3` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `interface`
--

INSERT INTO `interface` (`code`, `titre`, `message1`, `titre2`, `titre3`, `message2`, `message3`) VALUES
(1, 'Schule aus Deutschland', 'Willkommen', 'Lehrer', 'Schüler', 'Ihre Nachrichten 1', 'Ihre Nachrichten 2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `level`
--

CREATE TABLE `level` (
  `code` int(11) NOT NULL,
  `Elevel` varchar(2) NOT NULL,
  `Glevel` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `level`
--

INSERT INTO `level` (`code`, `Elevel`, `Glevel`) VALUES
(1, 'E', 'G');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `message`
--

CREATE TABLE `message` (
  `code` int(30) NOT NULL,
  `message` text NOT NULL,
  `message2` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `message`
--

INSERT INTO `message` (`code`, `message`, `message2`) VALUES
(1, 'Willkommen in School Management Software<br>\r\n<br>\r\nHerr Michaux<br>\r\n', 'Willkommen in School Management Software<br>\r\n<br>\r\nHerr Michaux<br>');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `planning`
--

CREATE TABLE `planning` (
  `code` int(11) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `year` varchar(30) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `hour` varchar(2) NOT NULL,
  `course` varchar(30) NOT NULL,
  `room` varchar(30) NOT NULL,
  `day` varchar(30) NOT NULL,
  `prof` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `presence`
--

CREATE TABLE `presence` (
  `code` int(11) NOT NULL,
  `date` date NOT NULL,
  `presence` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `course` varchar(30) NOT NULL,
  `year` varchar(100) NOT NULL,
  `semester` int(100) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `student` int(30) NOT NULL,
  `zeugnis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profcourse`
--

CREATE TABLE `profcourse` (
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `prof` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `code` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `profcourse`
--

INSERT INTO `profcourse` (`year`, `semester`, `prof`, `course`, `classe`, `code`) VALUES
('2022/2023', '2. Schulhalbjahr', 'Admin', 'BIO', '10a', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reference`
--

CREATE TABLE `reference` (
  `code` int(11) NOT NULL,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `reference`
--

INSERT INTO `reference` (`code`, `year`, `semester`) VALUES
(1, '2022/2023', '2. Schulhalbjahr');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `registration`
--

CREATE TABLE `registration` (
  `code` int(30) NOT NULL,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `student` int(30) NOT NULL,
  `classerequired` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room`
--

CREATE TABLE `room` (
  `nummer` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `room`
--

INSERT INTO `room` (`nummer`, `course`) VALUES
('1.24', 'English'),
('1.26', 'Deutsch'),
('2.23', 'Informatique'),
('2.25', 'Informatique');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `school`
--

CREATE TABLE `school` (
  `schoolname1` varchar(50) NOT NULL,
  `schoolname2` varchar(30) NOT NULL,
  `schoolzip` varchar(10) NOT NULL,
  `schooladdress` varchar(30) NOT NULL,
  `groupname` varchar(50) NOT NULL,
  `groupname2` varchar(30) NOT NULL,
  `groupaddress` varchar(30) NOT NULL,
  `groupzip` varchar(10) NOT NULL,
  `schoolcity` varchar(30) NOT NULL,
  `Groupcity` varchar(30) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `school`
--

INSERT INTO `school` (`schoolname1`, `schoolname2`, `schoolzip`, `schooladdress`, `groupname`, `groupname2`, `groupaddress`, `groupzip`, `schoolcity`, `Groupcity`, `code`) VALUES
('Schule aus Berlin', 'Integrierte Sekundarschule', '13000   ', 'Straße 6-7     ', 'Schule aus Deutschland', 'Das Sekretariat        ', 'Blumenstraße, 10', '14585', '    Berlin      ', 'Berlin  ', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `security`
--

CREATE TABLE `security` (
  `code` int(11) NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `IP` varchar(30) NOT NULL,
  `computer` varchar(30) NOT NULL,
  `col1` varchar(30) NOT NULL,
  `success` tinyint(1) NOT NULL,
  `page` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `semester`
--

CREATE TABLE `semester` (
  `semester` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `semester`
--

INSERT INTO `semester` (`semester`) VALUES
('1. Schulhalbjahr'),
('2. Schulhalbjahr');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `student`
--

CREATE TABLE `student` (
  `code` int(30) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `adresse` varchar(30) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `test`
--

CREATE TABLE `test` (
  `code` int(30) NOT NULL,
  `date` date NOT NULL,
  `point` float(5,2) NOT NULL,
  `worktype` int(11) NOT NULL,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 0,
  `prof` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `testline`
--

CREATE TABLE `testline` (
  `code` int(30) NOT NULL,
  `student` int(30) NOT NULL,
  `grade` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `niveauG` varchar(30) NOT NULL,
  `niveauE` varchar(30) NOT NULL,
  `test` int(30) NOT NULL,
  `codeline` int(30) NOT NULL,
  `note` float(5,2) NOT NULL,
  `niveau` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `login` varchar(30) NOT NULL,
  `pwd` varchar(500) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `Prof` tinyint(1) NOT NULL,
  `email` varchar(30) NOT NULL,
  `datepwd` date NOT NULL,
  `open` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`login`, `pwd`, `nom`, `prenom`, `Prof`, `email`, `datepwd`, `open`) VALUES
('Admin', '887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5', 'Name', 'Vorname', 2, 'michaux@free.fr', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `usertype`
--

CREATE TABLE `usertype` (
  `code` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `usertype`
--

INSERT INTO `usertype` (`code`, `name`) VALUES
(0, 'Eltern'),
(1, 'Lehrer'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `worktype`
--

CREATE TABLE `worktype` (
  `code` int(30) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `worktype`
--

INSERT INTO `worktype` (`code`, `name`) VALUES
(1, 'Klassenarbeit'),
(2, 'Vokabeltest'),
(4, 'Hausaufgabe'),
(7, 'Mündlich');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `worktypescale`
--

CREATE TABLE `worktypescale` (
  `point` int(11) NOT NULL,
  `percentagefrom` int(11) NOT NULL,
  `percentagebis` int(11) NOT NULL,
  `niveauE` varchar(30) NOT NULL,
  `niveauG` varchar(30) NOT NULL,
  `worktype` int(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `code` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `worktypescale`
--

INSERT INTO `worktypescale` (`point`, `percentagefrom`, `percentagebis`, `niveauE`, `niveauG`, `worktype`, `course`, `code`) VALUES
(14, 97, 99, '1', '1+', 1, 'FR01', 2),
(13, 95, 96, '1-', '1+', 1, 'FR01', 3),
(12, 94, 94, '2+', '1+', 1, 'FR01', 4),
(11, 88, 93, '2', '1', 1, 'FR01', 5),
(10, 83, 87, '2-', '1-', 1, 'FR01', 6),
(9, 82, 82, '3+', '2+', 1, 'FR01', 7),
(8, 77, 81, '3', '2', 1, 'FR01', 8),
(7, 72, 76, '3-', '2-', 1, 'FR01', 9),
(6, 71, 71, '4+', '3+', 1, 'FR01', 10),
(5, 65, 70, '4', '3', 1, 'FR01', 11),
(4, 60, 64, '4-', '4+', 1, 'FR01', 12),
(3, 59, 59, '5+', '4-', 1, 'FR01', 13),
(2, 52, 58, '5', '5+', 1, 'FR01', 14),
(1, 45, 51, '5-', '5', 1, 'FR01', 15),
(0, 0, 44, '6', '6', 1, 'FR01', 16),
(15, 100, 100, '1+', '1+', 1, 'FR01', 31),
(15, 100, 100, '1+', '1+', 1, 'BIO', 32),
(14, 97, 99, '1', '1+', 1, 'BIO', 33),
(13, 95, 96, '1-', '1+', 1, 'BIO', 34),
(12, 94, 94, '2+', '1+', 1, 'BIO', 35),
(11, 88, 93, '2', '1', 1, 'BIO', 36),
(10, 83, 87, '2-', '1-', 1, 'BIO', 37),
(9, 82, 82, '3+', '2+', 1, 'BIO', 38),
(8, 77, 81, '3', '2', 1, 'BIO', 39),
(7, 72, 76, '3-', '2-', 1, 'BIO', 40),
(6, 71, 71, '4+', '3+', 1, 'BIO', 41),
(5, 65, 70, '4', '3', 1, 'BIO', 42),
(4, 60, 64, '4-', '4+', 1, 'BIO', 43),
(3, 59, 59, '5+', '4-', 1, 'BIO', 44),
(2, 52, 58, '5', '5+', 1, 'BIO', 45),
(1, 45, 51, '5-', '5', 1, 'BIO', 46),
(0, 0, 44, '6', '6', 1, 'BIO', 47),
(15, 100, 100, '1+', '1+', 1, 'CHE', 48),
(14, 97, 99, '1', '1+', 1, 'CHE', 49),
(13, 95, 96, '1-', '1+', 1, 'CHE', 50),
(12, 94, 94, '2+', '1+', 1, 'CHE', 51),
(11, 88, 93, '2', '1', 1, 'CHE', 52),
(10, 83, 87, '2-', '1-', 1, 'CHE', 53),
(9, 82, 82, '3+', '2+', 1, 'CHE', 54),
(8, 77, 81, '3', '2', 1, 'CHE', 55),
(7, 72, 76, '3-', '2-', 1, 'CHE', 56),
(6, 71, 71, '4+', '3+', 1, 'CHE', 57),
(5, 65, 70, '4', '3', 1, 'CHE', 58),
(4, 60, 64, '4-', '4+', 1, 'CHE', 59),
(3, 59, 59, '5+', '4-', 1, 'CHE', 60),
(2, 52, 58, '5', '5+', 1, 'CHE', 61),
(1, 45, 51, '5-', '5', 1, 'CHE', 62),
(0, 0, 44, '6', '6', 1, 'CHE', 63),
(15, 100, 100, '1+', '1+', 1, 'DE01', 64),
(14, 97, 99, '1', '1+', 1, 'DE01', 65),
(13, 95, 96, '1-', '1+', 1, 'DE01', 66),
(12, 94, 94, '2+', '1+', 1, 'DE01', 67),
(11, 88, 93, '2', '1', 1, 'DE01', 68),
(10, 83, 87, '2-', '1-', 1, 'DE01', 69),
(9, 82, 82, '3+', '2+', 1, 'DE01', 70),
(8, 77, 81, '3', '2', 1, 'DE01', 71),
(7, 72, 76, '3-', '2-', 1, 'DE01', 72),
(6, 71, 71, '4+', '3+', 1, 'DE01', 73),
(5, 65, 70, '4', '3', 1, 'DE01', 74),
(4, 60, 64, '4-', '4+', 1, 'DE01', 75),
(3, 59, 59, '5+', '4-', 1, 'DE01', 76),
(2, 52, 58, '5', '5+', 1, 'DE01', 77),
(1, 45, 51, '5-', '5', 1, 'DE01', 78),
(0, 0, 44, '6', '6', 1, 'DE01', 79),
(15, 100, 100, '1+', '1+', 1, 'DE02 ', 80),
(14, 97, 99, '1', '1+', 1, 'DE02 ', 81),
(13, 95, 96, '1-', '1+', 1, 'DE02 ', 82),
(12, 94, 94, '2+', '1+', 1, 'DE02 ', 83),
(11, 88, 93, '2', '1', 1, 'DE02 ', 84),
(10, 83, 87, '2-', '1-', 1, 'DE02 ', 85),
(9, 82, 82, '3+', '2+', 1, 'DE02 ', 86),
(8, 77, 81, '3', '2', 1, 'DE02 ', 87),
(7, 72, 76, '3-', '2-', 1, 'DE02 ', 88),
(6, 71, 71, '4+', '3+', 1, 'DE02 ', 89),
(5, 65, 70, '4', '3', 1, 'DE02 ', 90),
(4, 60, 64, '4-', '4+', 1, 'DE02 ', 91),
(3, 59, 59, '5+', '4-', 1, 'DE02 ', 92),
(2, 52, 58, '5', '5+', 1, 'DE02 ', 93),
(1, 45, 51, '5-', '5', 1, 'DE02 ', 94),
(0, 0, 44, '6', '6', 1, 'DE02 ', 95),
(15, 100, 100, '1+', '1+', 1, 'EN01', 96),
(14, 97, 99, '1', '1+', 1, 'EN01', 97),
(13, 95, 96, '1-', '1+', 1, 'EN01', 98),
(12, 94, 94, '2+', '1+', 1, 'EN01', 99),
(11, 88, 93, '2', '1', 1, 'EN01', 100),
(10, 83, 87, '2-', '1-', 1, 'EN01', 101),
(9, 82, 82, '3+', '2+', 1, 'EN01', 102),
(8, 77, 81, '3', '2', 1, 'EN01', 103),
(7, 72, 76, '3-', '2-', 1, 'EN01', 104),
(6, 71, 71, '4+', '3+', 1, 'EN01', 105),
(5, 65, 70, '4', '3', 1, 'EN01', 106),
(4, 60, 64, '4-', '4+', 1, 'EN01', 107),
(3, 59, 59, '5+', '4-', 1, 'EN01', 108),
(2, 52, 58, '5', '5+', 1, 'EN01', 109),
(1, 45, 51, '5-', '5', 1, 'EN01', 110),
(0, 0, 44, '6', '6', 1, 'EN01', 111),
(15, 100, 100, '1+', '1+', 1, 'EN02', 112),
(14, 97, 99, '1', '1+', 1, 'EN02', 113),
(13, 95, 96, '1-', '1+', 1, 'EN02', 114),
(12, 94, 94, '2+', '1+', 1, 'EN02', 115),
(11, 88, 93, '2', '1', 1, 'EN02', 116),
(10, 83, 87, '2-', '1-', 1, 'EN02', 117),
(9, 82, 82, '3+', '2+', 1, 'EN02', 118),
(8, 77, 81, '3', '2', 1, 'EN02', 119),
(7, 72, 76, '3-', '2-', 1, 'EN02', 120),
(6, 71, 71, '4+', '3+', 1, 'EN02', 121),
(5, 65, 70, '4', '3', 1, 'EN02', 122),
(4, 60, 64, '4-', '4+', 1, 'EN02', 123),
(3, 59, 59, '5+', '4-', 1, 'EN02', 124),
(2, 52, 58, '5', '5+', 1, 'EN02', 125),
(1, 45, 51, '5-', '5', 1, 'EN02', 126),
(0, 0, 44, '6', '6', 1, 'EN02', 127),
(15, 100, 100, '1+', '1+', 1, 'FR02', 128),
(14, 97, 99, '1', '1+', 1, 'FR02', 129),
(13, 95, 96, '1-', '1+', 1, 'FR02', 130),
(12, 94, 94, '2+', '1+', 1, 'FR02', 131),
(11, 88, 93, '2', '1', 1, 'FR02', 132),
(10, 83, 87, '2-', '1-', 1, 'FR02', 133),
(9, 82, 82, '3+', '2+', 1, 'FR02', 134),
(8, 77, 81, '3', '2', 1, 'FR02', 135),
(7, 72, 76, '3-', '2-', 1, 'FR02', 136),
(6, 71, 71, '4+', '3+', 1, 'FR02', 137),
(5, 65, 70, '4', '3', 1, 'FR02', 138),
(4, 60, 64, '4-', '4+', 1, 'FR02', 139),
(3, 59, 59, '5+', '4-', 1, 'FR02', 140),
(2, 52, 58, '5', '5+', 1, 'FR02', 141),
(1, 45, 51, '5-', '5', 1, 'FR02', 142),
(0, 0, 44, '6', '6', 1, 'FR02', 143),
(15, 100, 100, '1+', '1+', 1, 'GEO', 144),
(14, 97, 99, '1', '1+', 1, 'GEO', 145),
(13, 95, 96, '1-', '1+', 1, 'GEO', 146),
(12, 94, 94, '2+', '1+', 1, 'GEO', 147),
(11, 88, 93, '2', '1', 1, 'GEO', 148),
(10, 83, 87, '2-', '1-', 1, 'GEO', 149),
(9, 82, 82, '3+', '2+', 1, 'GEO', 150),
(8, 77, 81, '3', '2', 1, 'GEO', 151),
(7, 72, 76, '3-', '2-', 1, 'GEO', 152),
(6, 71, 71, '4+', '3+', 1, 'GEO', 153),
(5, 65, 70, '4', '3', 1, 'GEO', 154),
(4, 60, 64, '4-', '4+', 1, 'GEO', 155),
(3, 59, 59, '5+', '4-', 1, 'GEO', 156),
(2, 52, 58, '5', '5+', 1, 'GEO', 157),
(1, 45, 51, '5-', '5', 1, 'GEO', 158),
(0, 0, 44, '6', '6', 1, 'GEO', 159),
(15, 100, 100, '1+', '1+', 1, 'GES', 160),
(14, 97, 99, '1', '1+', 1, 'GES', 161),
(13, 95, 96, '1-', '1+', 1, 'GES', 162),
(12, 94, 94, '2+', '1+', 1, 'GES', 163),
(11, 88, 93, '2', '1', 1, 'GES', 164),
(10, 83, 87, '2-', '1-', 1, 'GES', 165),
(9, 82, 82, '3+', '2+', 1, 'GES', 166),
(8, 77, 81, '3', '2', 1, 'GES', 167),
(7, 72, 76, '3-', '2-', 1, 'GES', 168),
(6, 71, 71, '4+', '3+', 1, 'GES', 169),
(5, 65, 70, '4', '3', 1, 'GES', 170),
(4, 60, 64, '4-', '4+', 1, 'GES', 171),
(3, 59, 59, '5+', '4-', 1, 'GES', 172),
(2, 52, 58, '5', '5+', 1, 'GES', 173),
(1, 45, 51, '5-', '5', 1, 'GES', 174),
(0, 0, 44, '6', '6', 1, 'GES', 175),
(15, 100, 100, '1+', '1+', 1, 'KUN', 176),
(14, 97, 99, '1', '1+', 1, 'KUN', 177),
(13, 95, 96, '1-', '1+', 1, 'KUN', 178),
(12, 94, 94, '2+', '1+', 1, 'KUN', 179),
(11, 88, 93, '2', '1', 1, 'KUN', 180),
(10, 83, 87, '2-', '1-', 1, 'KUN', 181),
(9, 82, 82, '3+', '2+', 1, 'KUN', 182),
(8, 77, 81, '3', '2', 1, 'KUN', 183),
(7, 72, 76, '3-', '2-', 1, 'KUN', 184),
(6, 71, 71, '4+', '3+', 1, 'KUN', 185),
(5, 65, 70, '4', '3', 1, 'KUN', 186),
(4, 60, 64, '4-', '4+', 1, 'KUN', 187),
(3, 59, 59, '5+', '4-', 1, 'KUN', 188),
(2, 52, 58, '5', '5+', 1, 'KUN', 189),
(1, 45, 51, '5-', '5', 1, 'KUN', 190),
(0, 0, 44, '6', '6', 1, 'KUN', 191),
(15, 100, 100, '1+', '1+', 1, 'MATH', 192),
(14, 97, 99, '1', '1+', 1, 'MATH', 193),
(13, 95, 96, '1-', '1+', 1, 'MATH', 194),
(12, 94, 94, '2+', '1+', 1, 'MATH', 195),
(11, 88, 93, '2', '1', 1, 'MATH', 196),
(10, 83, 87, '2-', '1-', 1, 'MATH', 197),
(9, 82, 82, '3+', '2+', 1, 'MATH', 198),
(8, 77, 81, '3', '2', 1, 'MATH', 199),
(7, 72, 76, '3-', '2-', 1, 'MATH', 200),
(6, 71, 71, '4+', '3+', 1, 'MATH', 201),
(5, 65, 70, '4', '3', 1, 'MATH', 202),
(4, 60, 64, '4-', '4+', 1, 'MATH', 203),
(3, 59, 59, '5+', '4-', 1, 'MATH', 204),
(2, 52, 58, '5', '5+', 1, 'MATH', 205),
(1, 45, 51, '5-', '5', 1, 'MATH', 206),
(0, 0, 44, '6', '6', 1, 'MATH', 207),
(15, 100, 100, '1+', '1+', 1, 'MUS', 208),
(14, 97, 99, '1', '1+', 1, 'MUS', 209),
(13, 95, 96, '1-', '1+', 1, 'MUS', 210),
(12, 94, 94, '2+', '1+', 1, 'MUS', 211),
(11, 88, 93, '2', '1', 1, 'MUS', 212),
(10, 83, 87, '2-', '1-', 1, 'MUS', 213),
(9, 82, 82, '3+', '2+', 1, 'MUS', 214),
(8, 77, 81, '3', '2', 1, 'MUS', 215),
(7, 72, 76, '3-', '2-', 1, 'MUS', 216),
(6, 71, 71, '4+', '3+', 1, 'MUS', 217),
(5, 65, 70, '4', '3', 1, 'MUS', 218),
(4, 60, 64, '4-', '4+', 1, 'MUS', 219),
(3, 59, 59, '5+', '4-', 1, 'MUS', 220),
(2, 52, 58, '5', '5+', 1, 'MUS', 221),
(1, 45, 51, '5-', '5', 1, 'MUS', 222),
(0, 0, 44, '6', '6', 1, 'MUS', 223),
(15, 100, 100, '1+', '1+', 1, 'SPOR', 224),
(14, 97, 99, '1', '1+', 1, 'SPOR', 225),
(13, 95, 96, '1-', '1+', 1, 'SPOR', 226),
(12, 94, 94, '2+', '1+', 1, 'SPOR', 227),
(11, 88, 93, '2', '1', 1, 'SPOR', 228),
(10, 83, 87, '2-', '1-', 1, 'SPOR', 229),
(9, 82, 82, '3+', '2+', 1, 'SPOR', 230),
(8, 77, 81, '3', '2', 1, 'SPOR', 231),
(7, 72, 76, '3-', '2-', 1, 'SPOR', 232),
(6, 71, 71, '4+', '3+', 1, 'SPOR', 233),
(5, 65, 70, '4', '3', 1, 'SPOR', 234),
(4, 60, 64, '4-', '4+', 1, 'SPOR', 235),
(3, 59, 59, '5+', '4-', 1, 'SPOR', 236),
(2, 52, 58, '5', '5+', 1, 'SPOR', 237),
(1, 45, 51, '5-', '5', 1, 'SPOR', 238),
(0, 0, 44, '6', '6', 1, 'SPOR', 239),
(15, 100, 100, '1+', '1+', 1, 'WIRT', 240),
(14, 97, 99, '1', '1+', 1, 'WIRT', 241),
(13, 95, 96, '1-', '1+', 1, 'WIRT', 242),
(12, 94, 94, '2+', '1+', 1, 'WIRT', 243),
(11, 88, 93, '2', '1', 1, 'WIRT', 244),
(10, 83, 87, '2-', '1-', 1, 'WIRT', 245),
(9, 82, 82, '3+', '2+', 1, 'WIRT', 246),
(8, 77, 81, '3', '2', 1, 'WIRT', 247),
(7, 72, 76, '3-', '2-', 1, 'WIRT', 248),
(6, 71, 71, '4+', '3+', 1, 'WIRT', 249),
(5, 65, 70, '4', '3', 1, 'WIRT', 250),
(4, 60, 64, '4-', '4+', 1, 'WIRT', 251),
(3, 59, 59, '5+', '4-', 1, 'WIRT', 252),
(2, 52, 58, '5', '5+', 1, 'WIRT', 253),
(1, 45, 51, '5-', '5', 1, 'WIRT', 254),
(0, 0, 44, '6', '6', 1, 'WIRT', 255),
(15, 100, 100, '1+', '1+', 4, 'BIO', 256),
(14, 97, 99, '1', '1+', 4, 'BIO', 257),
(13, 95, 96, '1-', '1+', 4, 'BIO', 258),
(12, 94, 94, '2+', '1+', 4, 'BIO', 259),
(11, 88, 93, '2', '1', 4, 'BIO', 260),
(10, 83, 87, '2-', '1-', 4, 'BIO', 261),
(9, 82, 82, '3+', '2+', 4, 'BIO', 262),
(8, 77, 81, '3', '2', 4, 'BIO', 263),
(7, 72, 76, '3-', '2-', 4, 'BIO', 264),
(6, 71, 71, '4+', '3+', 4, 'BIO', 265),
(5, 65, 70, '4', '3', 4, 'BIO', 266),
(4, 60, 64, '4-', '4+', 4, 'BIO', 267),
(3, 59, 59, '5+', '4-', 4, 'BIO', 268),
(2, 52, 58, '5', '5+', 4, 'BIO', 269),
(1, 45, 51, '5-', '5', 4, 'BIO', 270),
(0, 0, 44, '6', '6', 4, 'BIO', 271),
(15, 100, 100, '1+', '1+', 4, 'CHE', 272),
(14, 97, 99, '1', '1+', 4, 'CHE', 273),
(13, 95, 96, '1-', '1+', 4, 'CHE', 274),
(12, 94, 94, '2+', '1+', 4, 'CHE', 275),
(11, 88, 93, '2', '1', 4, 'CHE', 276),
(10, 83, 87, '2-', '1-', 4, 'CHE', 277),
(9, 82, 82, '3+', '2+', 4, 'CHE', 278),
(8, 77, 81, '3', '2', 4, 'CHE', 279),
(7, 72, 76, '3-', '2-', 4, 'CHE', 280),
(6, 71, 71, '4+', '3+', 4, 'CHE', 281),
(5, 65, 70, '4', '3', 4, 'CHE', 282),
(4, 60, 64, '4-', '4+', 4, 'CHE', 283),
(3, 59, 59, '5+', '4-', 4, 'CHE', 284),
(2, 52, 58, '5', '5+', 4, 'CHE', 285),
(1, 45, 51, '5-', '5', 4, 'CHE', 286),
(0, 0, 44, '6', '6', 4, 'CHE', 287),
(15, 100, 100, '1+', '1+', 4, 'DE01', 288),
(14, 97, 99, '1', '1+', 4, 'DE01', 289),
(13, 95, 96, '1-', '1+', 4, 'DE01', 290),
(12, 94, 94, '2+', '1+', 4, 'DE01', 291),
(11, 88, 93, '2', '1', 4, 'DE01', 292),
(10, 83, 87, '2-', '1-', 4, 'DE01', 293),
(9, 82, 82, '3+', '2+', 4, 'DE01', 294),
(8, 77, 81, '3', '2', 4, 'DE01', 295),
(7, 72, 76, '3-', '2-', 4, 'DE01', 296),
(6, 71, 71, '4+', '3+', 4, 'DE01', 297),
(5, 65, 70, '4', '3', 4, 'DE01', 298),
(4, 60, 64, '4-', '4+', 4, 'DE01', 299),
(3, 59, 59, '5+', '4-', 4, 'DE01', 300),
(2, 52, 58, '5', '5+', 4, 'DE01', 301),
(1, 45, 51, '5-', '5', 4, 'DE01', 302),
(0, 0, 44, '6', '6', 4, 'DE01', 303),
(15, 100, 100, '1+', '1+', 4, 'DE02 ', 304),
(14, 97, 99, '1', '1+', 4, 'DE02 ', 305),
(13, 95, 96, '1-', '1+', 4, 'DE02 ', 306),
(12, 94, 94, '2+', '1+', 4, 'DE02 ', 307),
(11, 88, 93, '2', '1', 4, 'DE02 ', 308),
(10, 83, 87, '2-', '1-', 4, 'DE02 ', 309),
(9, 82, 82, '3+', '2+', 4, 'DE02 ', 310),
(8, 77, 81, '3', '2', 4, 'DE02 ', 311),
(7, 72, 76, '3-', '2-', 4, 'DE02 ', 312),
(6, 71, 71, '4+', '3+', 4, 'DE02 ', 313),
(5, 65, 70, '4', '3', 4, 'DE02 ', 314),
(4, 60, 64, '4-', '4+', 4, 'DE02 ', 315),
(3, 59, 59, '5+', '4-', 4, 'DE02 ', 316),
(2, 52, 58, '5', '5+', 4, 'DE02 ', 317),
(1, 45, 51, '5-', '5', 4, 'DE02 ', 318),
(0, 0, 44, '6', '6', 4, 'DE02 ', 319),
(15, 100, 100, '1+', '1+', 4, 'EN01', 320),
(14, 97, 99, '1', '1+', 4, 'EN01', 321),
(13, 95, 96, '1-', '1+', 4, 'EN01', 322),
(12, 94, 94, '2+', '1+', 4, 'EN01', 323),
(11, 88, 93, '2', '1', 4, 'EN01', 324),
(10, 83, 87, '2-', '1-', 4, 'EN01', 325),
(9, 82, 82, '3+', '2+', 4, 'EN01', 326),
(8, 77, 81, '3', '2', 4, 'EN01', 327),
(7, 72, 76, '3-', '2-', 4, 'EN01', 328),
(6, 71, 71, '4+', '3+', 4, 'EN01', 329),
(5, 65, 70, '4', '3', 4, 'EN01', 330),
(4, 60, 64, '4-', '4+', 4, 'EN01', 331),
(3, 59, 59, '5+', '4-', 4, 'EN01', 332),
(2, 52, 58, '5', '5+', 4, 'EN01', 333),
(1, 45, 51, '5-', '5', 4, 'EN01', 334),
(0, 0, 44, '6', '6', 4, 'EN01', 335),
(15, 100, 100, '1+', '1+', 4, 'EN02', 336),
(14, 97, 99, '1', '1+', 4, 'EN02', 337),
(13, 95, 96, '1-', '1+', 4, 'EN02', 338),
(12, 94, 94, '2+', '1+', 4, 'EN02', 339),
(11, 88, 93, '2', '1', 4, 'EN02', 340),
(10, 83, 87, '2-', '1-', 4, 'EN02', 341),
(9, 82, 82, '3+', '2+', 4, 'EN02', 342),
(8, 77, 81, '3', '2', 4, 'EN02', 343),
(7, 72, 76, '3-', '2-', 4, 'EN02', 344),
(6, 71, 71, '4+', '3+', 4, 'EN02', 345),
(5, 65, 70, '4', '3', 4, 'EN02', 346),
(4, 60, 64, '4-', '4+', 4, 'EN02', 347),
(3, 59, 59, '5+', '4-', 4, 'EN02', 348),
(2, 52, 58, '5', '5+', 4, 'EN02', 349),
(1, 45, 51, '5-', '5', 4, 'EN02', 350),
(0, 0, 44, '6', '6', 4, 'EN02', 351),
(15, 100, 100, '1+', '1+', 4, 'FR02', 352),
(14, 97, 99, '1', '1+', 4, 'FR02', 353),
(13, 95, 96, '1-', '1+', 4, 'FR02', 354),
(12, 94, 94, '2+', '1+', 4, 'FR02', 355),
(11, 88, 93, '2', '1', 4, 'FR02', 356),
(10, 83, 87, '2-', '1-', 4, 'FR02', 357),
(9, 82, 82, '3+', '2+', 4, 'FR02', 358),
(8, 77, 81, '3', '2', 4, 'FR02', 359),
(7, 72, 76, '3-', '2-', 4, 'FR02', 360),
(6, 71, 71, '4+', '3+', 4, 'FR02', 361),
(5, 65, 70, '4', '3', 4, 'FR02', 362),
(4, 60, 64, '4-', '4+', 4, 'FR02', 363),
(3, 59, 59, '5+', '4-', 4, 'FR02', 364),
(2, 52, 58, '5', '5+', 4, 'FR02', 365),
(1, 45, 51, '5-', '5', 4, 'FR02', 366),
(0, 0, 44, '6', '6', 4, 'FR02', 367),
(15, 100, 100, '1+', '1+', 4, 'GEO', 368),
(14, 97, 99, '1', '1+', 4, 'GEO', 369),
(13, 95, 96, '1-', '1+', 4, 'GEO', 370),
(12, 94, 94, '2+', '1+', 4, 'GEO', 371),
(11, 88, 93, '2', '1', 4, 'GEO', 372),
(10, 83, 87, '2-', '1-', 4, 'GEO', 373),
(9, 82, 82, '3+', '2+', 4, 'GEO', 374),
(8, 77, 81, '3', '2', 4, 'GEO', 375),
(7, 72, 76, '3-', '2-', 4, 'GEO', 376),
(6, 71, 71, '4+', '3+', 4, 'GEO', 377),
(5, 65, 70, '4', '3', 4, 'GEO', 378),
(4, 60, 64, '4-', '4+', 4, 'GEO', 379),
(3, 59, 59, '5+', '4-', 4, 'GEO', 380),
(2, 52, 58, '5', '5+', 4, 'GEO', 381),
(1, 45, 51, '5-', '5', 4, 'GEO', 382),
(0, 0, 44, '6', '6', 4, 'GEO', 383),
(15, 100, 100, '1+', '1+', 4, 'GES', 384),
(14, 97, 99, '1', '1+', 4, 'GES', 385),
(13, 95, 96, '1-', '1+', 4, 'GES', 386),
(12, 94, 94, '2+', '1+', 4, 'GES', 387),
(11, 88, 93, '2', '1', 4, 'GES', 388),
(10, 83, 87, '2-', '1-', 4, 'GES', 389),
(9, 82, 82, '3+', '2+', 4, 'GES', 390),
(8, 77, 81, '3', '2', 4, 'GES', 391),
(7, 72, 76, '3-', '2-', 4, 'GES', 392),
(6, 71, 71, '4+', '3+', 4, 'GES', 393),
(5, 65, 70, '4', '3', 4, 'GES', 394),
(4, 60, 64, '4-', '4+', 4, 'GES', 395),
(3, 59, 59, '5+', '4-', 4, 'GES', 396),
(2, 52, 58, '5', '5+', 4, 'GES', 397),
(1, 45, 51, '5-', '5', 4, 'GES', 398),
(0, 0, 44, '6', '6', 4, 'GES', 399),
(15, 100, 100, '1+', '1+', 4, 'KUN', 400),
(14, 97, 99, '1', '1+', 4, 'KUN', 401),
(13, 95, 96, '1-', '1+', 4, 'KUN', 402),
(12, 94, 94, '2+', '1+', 4, 'KUN', 403),
(11, 88, 93, '2', '1', 4, 'KUN', 404),
(10, 83, 87, '2-', '1-', 4, 'KUN', 405),
(9, 82, 82, '3+', '2+', 4, 'KUN', 406),
(8, 77, 81, '3', '2', 4, 'KUN', 407),
(7, 72, 76, '3-', '2-', 4, 'KUN', 408),
(6, 71, 71, '4+', '3+', 4, 'KUN', 409),
(5, 65, 70, '4', '3', 4, 'KUN', 410),
(4, 60, 64, '4-', '4+', 4, 'KUN', 411),
(3, 59, 59, '5+', '4-', 4, 'KUN', 412),
(2, 52, 58, '5', '5+', 4, 'KUN', 413),
(1, 45, 51, '5-', '5', 4, 'KUN', 414),
(0, 0, 44, '6', '6', 4, 'KUN', 415),
(15, 100, 100, '1+', '1+', 4, 'MATH', 416),
(14, 97, 99, '1', '1+', 4, 'MATH', 417),
(13, 95, 96, '1-', '1+', 4, 'MATH', 418),
(12, 94, 94, '2+', '1+', 4, 'MATH', 419),
(11, 88, 93, '2', '1', 4, 'MATH', 420),
(10, 83, 87, '2-', '1-', 4, 'MATH', 421),
(9, 82, 82, '3+', '2+', 4, 'MATH', 422),
(8, 77, 81, '3', '2', 4, 'MATH', 423),
(7, 72, 76, '3-', '2-', 4, 'MATH', 424),
(6, 71, 71, '4+', '3+', 4, 'MATH', 425),
(5, 65, 70, '4', '3', 4, 'MATH', 426),
(4, 60, 64, '4-', '4+', 4, 'MATH', 427),
(3, 59, 59, '5+', '4-', 4, 'MATH', 428),
(2, 52, 58, '5', '5+', 4, 'MATH', 429),
(1, 45, 51, '5-', '5', 4, 'MATH', 430),
(0, 0, 44, '6', '6', 4, 'MATH', 431),
(15, 100, 100, '1+', '1+', 4, 'MUS', 432),
(14, 97, 99, '1', '1+', 4, 'MUS', 433),
(13, 95, 96, '1-', '1+', 4, 'MUS', 434),
(12, 94, 94, '2+', '1+', 4, 'MUS', 435),
(11, 88, 93, '2', '1', 4, 'MUS', 436),
(10, 83, 87, '2-', '1-', 4, 'MUS', 437),
(9, 82, 82, '3+', '2+', 4, 'MUS', 438),
(8, 77, 81, '3', '2', 4, 'MUS', 439),
(7, 72, 76, '3-', '2-', 4, 'MUS', 440),
(6, 71, 71, '4+', '3+', 4, 'MUS', 441),
(5, 65, 70, '4', '3', 4, 'MUS', 442),
(4, 60, 64, '4-', '4+', 4, 'MUS', 443),
(3, 59, 59, '5+', '4-', 4, 'MUS', 444),
(2, 52, 58, '5', '5+', 4, 'MUS', 445),
(1, 45, 51, '5-', '5', 4, 'MUS', 446),
(0, 0, 44, '6', '6', 4, 'MUS', 447),
(15, 100, 100, '1+', '1+', 4, 'SPOR', 448),
(14, 97, 99, '1', '1+', 4, 'SPOR', 449),
(13, 95, 96, '1-', '1+', 4, 'SPOR', 450),
(12, 94, 94, '2+', '1+', 4, 'SPOR', 451),
(11, 88, 93, '2', '1', 4, 'SPOR', 452),
(10, 83, 87, '2-', '1-', 4, 'SPOR', 453),
(9, 82, 82, '3+', '2+', 4, 'SPOR', 454),
(8, 77, 81, '3', '2', 4, 'SPOR', 455),
(7, 72, 76, '3-', '2-', 4, 'SPOR', 456),
(6, 71, 71, '4+', '3+', 4, 'SPOR', 457),
(5, 65, 70, '4', '3', 4, 'SPOR', 458),
(4, 60, 64, '4-', '4+', 4, 'SPOR', 459),
(3, 59, 59, '5+', '4-', 4, 'SPOR', 460),
(2, 52, 58, '5', '5+', 4, 'SPOR', 461),
(1, 45, 51, '5-', '5', 4, 'SPOR', 462),
(0, 0, 44, '6', '6', 4, 'SPOR', 463),
(15, 100, 100, '1+', '1+', 4, 'WIRT', 464),
(14, 97, 99, '1', '1+', 4, 'WIRT', 465),
(13, 95, 96, '1-', '1+', 4, 'WIRT', 466),
(12, 94, 94, '2+', '1+', 4, 'WIRT', 467),
(11, 88, 93, '2', '1', 4, 'WIRT', 468),
(10, 83, 87, '2-', '1-', 4, 'WIRT', 469),
(9, 82, 82, '3+', '2+', 4, 'WIRT', 470),
(8, 77, 81, '3', '2', 4, 'WIRT', 471),
(7, 72, 76, '3-', '2-', 4, 'WIRT', 472),
(6, 71, 71, '4+', '3+', 4, 'WIRT', 473),
(5, 65, 70, '4', '3', 4, 'WIRT', 474),
(4, 60, 64, '4-', '4+', 4, 'WIRT', 475),
(3, 59, 59, '5+', '4-', 4, 'WIRT', 476),
(2, 52, 58, '5', '5+', 4, 'WIRT', 477),
(1, 45, 51, '5-', '5', 4, 'WIRT', 478),
(0, 0, 44, '6', '6', 4, 'WIRT', 479),
(15, 100, 100, '1+', '1+', 4, 'FR01', 480),
(14, 97, 99, '1', '1+', 4, 'FR01', 481),
(13, 95, 96, '1-', '1+', 4, 'FR01', 482),
(12, 94, 94, '2+', '1+', 4, 'FR01', 483),
(11, 88, 93, '2', '1', 4, 'FR01', 484),
(10, 83, 87, '2-', '1-', 4, 'FR01', 485),
(9, 82, 82, '3+', '2+', 4, 'FR01', 486),
(8, 77, 81, '3', '2', 4, 'FR01', 487),
(7, 72, 76, '3-', '2-', 4, 'FR01', 488),
(6, 71, 71, '4+', '3+', 4, 'FR01', 489),
(5, 65, 70, '4', '3', 4, 'FR01', 490),
(4, 60, 64, '4-', '4+', 4, 'FR01', 491),
(3, 59, 59, '5+', '4-', 4, 'FR01', 492),
(2, 52, 58, '5', '5+', 4, 'FR01', 493),
(1, 45, 51, '5-', '5', 4, 'FR01', 494),
(0, 0, 44, '6', '6', 4, 'FR01', 495);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `years`
--

CREATE TABLE `years` (
  `years` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Daten für Tabelle `years`
--

INSERT INTO `years` (`years`) VALUES
('2022/2023'),
('2023/2024'),
('2024/2025');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `average`
--
ALTER TABLE `average`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `averagescale`
--
ALTER TABLE `averagescale`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `averagetotal`
--
ALTER TABLE `averagetotal`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classe` (`classe`);

--
-- Indizes für die Tabelle `classerequired`
--
ALTER TABLE `classerequired`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indizes für die Tabelle `coefwork`
--
ALTER TABLE `coefwork`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `course`
--
ALTER TABLE `course`
  ADD UNIQUE KEY `code` (`code`);

--
-- Indizes für die Tabelle `coursegroup`
--
ALTER TABLE `coursegroup`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `generation`
--
ALTER TABLE `generation`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `year` (`year`,`semester`,`classe`);

--
-- Indizes für die Tabelle `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `hour`
--
ALTER TABLE `hour`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `interface`
--
ALTER TABLE `interface`
  ADD UNIQUE KEY `code` (`code`);

--
-- Indizes für die Tabelle `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `profcourse`
--
ALTER TABLE `profcourse`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `year` (`year`,`semester`,`classe`,`student`);

--
-- Indizes für die Tabelle `school`
--
ALTER TABLE `school`
  ADD UNIQUE KEY `schoolname` (`schoolname1`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indizes für die Tabelle `security`
--
ALTER TABLE `security`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `semester`
--
ALTER TABLE `semester`
  ADD UNIQUE KEY `semester` (`semester`);

--
-- Indizes für die Tabelle `student`
--
ALTER TABLE `student`
  ADD UNIQUE KEY `CODE` (`code`);

--
-- Indizes für die Tabelle `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `testline`
--
ALTER TABLE `testline`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `login` (`login`);

--
-- Indizes für die Tabelle `usertype`
--
ALTER TABLE `usertype`
  ADD UNIQUE KEY `code` (`code`);

--
-- Indizes für die Tabelle `worktype`
--
ALTER TABLE `worktype`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `worktypescale`
--
ALTER TABLE `worktypescale`
  ADD PRIMARY KEY (`code`);

--
-- Indizes für die Tabelle `years`
--
ALTER TABLE `years`
  ADD UNIQUE KEY `years` (`years`),
  ADD UNIQUE KEY `years_2` (`years`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `average`
--
ALTER TABLE `average`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=745;

--
-- AUTO_INCREMENT für Tabelle `averagescale`
--
ALTER TABLE `averagescale`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT für Tabelle `averagetotal`
--
ALTER TABLE `averagetotal`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=610;

--
-- AUTO_INCREMENT für Tabelle `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `classerequired`
--
ALTER TABLE `classerequired`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `coefwork`
--
ALTER TABLE `coefwork`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `entry`
--
ALTER TABLE `entry`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `generation`
--
ALTER TABLE `generation`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT für Tabelle `homework`
--
ALTER TABLE `homework`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT für Tabelle `hour`
--
ALTER TABLE `hour`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `level`
--
ALTER TABLE `level`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `message`
--
ALTER TABLE `message`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `planning`
--
ALTER TABLE `planning`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT für Tabelle `presence`
--
ALTER TABLE `presence`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `profcourse`
--
ALTER TABLE `profcourse`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `reference`
--
ALTER TABLE `reference`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `registration`
--
ALTER TABLE `registration`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `security`
--
ALTER TABLE `security`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=444;

--
-- AUTO_INCREMENT für Tabelle `student`
--
ALTER TABLE `student`
  MODIFY `code` int(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `test`
--
ALTER TABLE `test`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `testline`
--
ALTER TABLE `testline`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `worktype`
--
ALTER TABLE `worktype`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `worktypescale`
--
ALTER TABLE `worktypescale`
  MODIFY `code` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=496;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
