-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 05 dec 2016 om 12:14
-- Serverversie: 5.6.13
-- PHP-versie: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `openavond`
--
CREATE DATABASE IF NOT EXISTS `openavond` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `openavond`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `docenten`
--

CREATE TABLE IF NOT EXISTS `docenten` (
  `docentid` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(100) NOT NULL,
  `Beschrijving` text NOT NULL COMMENT 'Vertelt iets over de docnet',
  `Leeftijd` int(11) NOT NULL COMMENT 'Leeftijd van docent',
  `Afbeeldingspad` varchar(255) NOT NULL COMMENT 'Pad voor zoeken van docentafbeelding',
  PRIMARY KEY (`docentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden uitgevoerd voor tabel `docenten`
--

INSERT INTO `docenten` (`docentid`, `Naam`, `Beschrijving`, `Leeftijd`, `Afbeeldingspad`) VALUES
(1, 'Jelle Stinstra', 'Komt altijd op tijd. Goede programmeur. je kan altijd bij hem terechtkomen als je problemen hebt', 44, ''),
(2, 'Hans Hooglander', 'Komt altijd te laat. Doet net alsof hij met de fiets naar school komt, maar eigenlijk komt hij met de trein', 52, ''),
(3, 'Alex de Haan', 'Geen informatie over deze docent. hij wilde hier niet aan meewerken', 60, ''),
(4, 'Nico Muller', 'houd van staren. stalkt je. je komt nooit van hem af, 1 keer naar hem kijken en je vergeet het nooit\n', 70, ''),
(5, 'Amber Corporaal', 'Heeft mij niet goed Nederlands gegeven', 35, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `favovak`
--

CREATE TABLE IF NOT EXISTS `favovak` (
  `docid` int(11) NOT NULL,
  `vakid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `favovak`
--

INSERT INTO `favovak` (`docid`, `vakid`) VALUES
(5, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inloggegevens`
--

CREATE TABLE IF NOT EXISTS `inloggegevens` (
  `inlogID` int(11) NOT NULL AUTO_INCREMENT,
  `docid` int(11) NOT NULL,
  `gebruikersnaam` varchar(64) NOT NULL,
  `wachtwoord` varchar(64) NOT NULL,
  `Zout` varchar(500) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`inlogID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `koppeltabel`
--

CREATE TABLE IF NOT EXISTS `koppeltabel` (
  `docid` int(11) NOT NULL,
  `vakid` int(11) NOT NULL,
  KEY `Docenten-ID` (`docid`),
  KEY `Vakken-ID` (`vakid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `koppeltabel`
--

INSERT INTO `koppeltabel` (`docid`, `vakid`) VALUES
(5, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `opleidingen`
--

CREATE TABLE IF NOT EXISTS `opleidingen` (
  `opleidingenid` int(11) NOT NULL AUTO_INCREMENT,
  `docid` int(11) NOT NULL,
  `Opleidingnaam` varchar(512) NOT NULL,
  PRIMARY KEY (`opleidingenid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vakken`
--

CREATE TABLE IF NOT EXISTS `vakken` (
  `vakid` int(11) NOT NULL AUTO_INCREMENT,
  `vaknaam` varchar(64) NOT NULL COMMENT 'Vaknaam',
  PRIMARY KEY (`vakid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `vakken`
--

INSERT INTO `vakken` (`vakid`, `vaknaam`) VALUES
(1, 'Wiskunde'),
(2, 'Programmeren'),
(3, 'Nederlands'),
(4, 'Rekenen'),
(5, 'Loopbaan'),
(6, 'Technisch programmeren'),
(7, 'Engels'),
(8, 'Webdesign'),
(9, 'Security');

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `koppeltabel`
--
ALTER TABLE `koppeltabel`
  ADD CONSTRAINT `koppeltabel_ibfk_1` FOREIGN KEY (`docid`) REFERENCES `docenten` (`docentid`),
  ADD CONSTRAINT `koppeltabel_ibfk_2` FOREIGN KEY (`vakid`) REFERENCES `vakken` (`vakid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
