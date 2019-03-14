-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Mrz 2019 um 13:40
-- Server-Version: 10.1.34-MariaDB
-- PHP-Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `dbkfz`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fahrzeug`
--

CREATE TABLE `fahrzeug` (
  `fzid` int(11) NOT NULL,
  `kundeid` int(11) NOT NULL,
  `marke` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `typ` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `kennzeichen` varchar(10) COLLATE utf8_german2_ci NOT NULL,
  `fahrgestellnummer` varchar(30) COLLATE utf8_german2_ci NOT NULL,
  `nationalcode` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `motorkennzeichen` varchar(4) COLLATE utf8_german2_ci NOT NULL,
  `getriebekennzeichen` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `farbe` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `treibstoff` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `leistung` int(3) NOT NULL,
  `hubraum` int(5) NOT NULL,
  `erstzulassung` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `fahrzeug`
--

INSERT INTO `fahrzeug` (`fzid`, `kundeid`, `marke`, `typ`, `kennzeichen`, `fahrgestellnummer`, `nationalcode`, `motorkennzeichen`, `getriebekennzeichen`, `farbe`, `treibstoff`, `leistung`, `hubraum`, `erstzulassung`) VALUES
(1, 1, 'VW', 'Passat', 'HA-234JI', 'WVWZZZ1K23453322', 'VWUAAA', 'CCBA', 'CBWW', 'JB4A', 'Diesel', 134, 1664, '2019-02-12'),
(2, 2, 'Seat', 'Leon', 'HA-343UD', 'SEAT1234567689', 'AUTO123', 'CAAB', 'GUBE', 'TURE', 'Diesel', 180, 1990, '2019-02-14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--

CREATE TABLE `kunde` (
  `kundennummer` int(10) NOT NULL,
  `anrede` varchar(10) COLLATE utf8_german2_ci NOT NULL,
  `titel` varchar(10) COLLATE utf8_german2_ci NOT NULL,
  `vorname` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `nachname` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `gebdat` date NOT NULL,
  `strasse` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `plz` int(5) NOT NULL,
  `ort` varchar(30) COLLATE utf8_german2_ci NOT NULL,
  `telefon` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_german2_ci NOT NULL,
  `newsletter` tinyint(1) NOT NULL,
  `kommentar` text COLLATE utf8_german2_ci NOT NULL,
  `kundeseit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `kunde`
--

INSERT INTO `kunde` (`kundennummer`, `anrede`, `titel`, `vorname`, `nachname`, `gebdat`, `strasse`, `plz`, `ort`, `telefon`, `email`, `newsletter`, `kommentar`, `kundeseit`) VALUES
(1, 'Herr', 'Dr.', 'Michael', 'Kronreif', '1992-04-05', 'Rigaus', 5441, 'Abtenau', '0664377730', 'kronreif@kronreif.at', 1, 'Nicht wichtig', '2019-02-12'),
(2, 'Frau', 'Dr.', 'Christina', 'Kronreif', '1992-04-16', 'Rigaus', 5441, 'Abtenau', '0664377730', 'kronreif@kronreif.at', 1, 'Nicht wichtig', '2019-02-12'),
(3, '0', '', '', '', '0000-00-00', '', 0, '', '0043', '', 0, '', '0000-00-00'),
(4, '0', '', '', '', '0000-00-00', '', 0, '', '0043', '', 0, '', '0000-00-00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung`
--

CREATE TABLE `rechnung` (
  `rechnungid` int(11) NOT NULL,
  `rechnungsnummer` int(11) NOT NULL,
  `rechnungsdatum` date NOT NULL,
  `kundenid` int(11) NOT NULL,
  `fahrzeugid` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnungdetails`
--

CREATE TABLE `rechnungdetails` (
  `rechnungdetailid` int(11) NOT NULL,
  `rechnungsnummer` int(11) NOT NULL,
  `teileid` int(11) NOT NULL,
  `anzahl` int(11) NOT NULL,
  `preis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reparatur`
--

CREATE TABLE `reparatur` (
  `repid` int(11) NOT NULL,
  `fzid` int(11) NOT NULL,
  `bemerkung` text COLLATE utf8_german2_ci NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `reparatur`
--

INSERT INTO `reparatur` (`repid`, `fzid`, `bemerkung`, `datum`) VALUES
(1, 1, 'Ich bin ein Testtext', '2019-02-13'),
(2, 2, 'Motorschaden sdfds', '2019-02-14'),
(9, 1, 'Neuer ', '2019-02-14'),
(14, 2, 'Ich bin der Motorschaden2', '2019-02-27'),
(17, 1, 'Das ist ein Test', '2019-02-13'),
(22, 1, 'Nochmals testen', '2019-02-07'),
(23, 1, 'Id iebergabe', '2019-02-07'),
(27, 1, 'sdf', '2019-02-13'),
(28, 1, 'sdf', '2019-02-06'),
(30, 1, 'sdf', '2019-02-06'),
(31, 1, 'sdf', '2019-02-06'),
(32, 1, 'sdf', '2019-02-06'),
(35, 1, 'sdfsdf', '2019-02-21'),
(36, 1, 'sdfsdf', '2019-02-14'),
(37, 1, 'xdfv', '2019-02-07'),
(39, 1, 'Schon wieder', '2019-02-13'),
(40, 1, 'sdf', '2019-02-07'),
(42, 1, 'sdf', '2019-02-07'),
(43, 1, 'sdf', '2019-02-07'),
(44, 1, 'sdf', '2019-02-07'),
(45, 1, 'sdfs', '2019-02-07'),
(46, 1, 'sdfs', '2019-02-07'),
(47, 1, 'sdf', '2019-02-13'),
(49, 1, 'sdfsdf', '2019-02-14'),
(50, 1, 'sdfsd', '2019-02-21'),
(54, 2, 'Neue Auswahl 2', '2019-01-30'),
(55, 2, '324', '2019-02-07'),
(57, 1, 'sdf', '2019-02-13'),
(58, 2, 'sdf', '2019-02-21'),
(60, 2, 'sdf', '2019-02-14'),
(64, 2, 'Motor ist defekt', '2019-02-25'),
(65, 1, 'Hallo ', '2019-03-21'),
(66, 2, 'Motorschaden', '2019-03-28'),
(69, 2, 'Das ist ein wahnsinn', '2019-03-06'),
(72, 2, 'Neuer Test3', '2019-03-05'),
(73, 2, 'Test', '2019-03-22'),
(75, 1, 'Bremse defekt', '2019-03-07'),
(76, 2, 'Jetzt passt', '2019-03-20'),
(77, 1, 'Motorschaden', '2019-03-10'),
(78, 1, 'Motorschaden', '2019-03-14');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reparaturdetails`
--

CREATE TABLE `reparaturdetails` (
  `repdetid` int(11) NOT NULL,
  `repid` int(11) NOT NULL,
  `teileid` int(11) NOT NULL,
  `anzahl` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `reparaturdetails`
--

INSERT INTO `reparaturdetails` (`repdetid`, `repid`, `teileid`, `anzahl`) VALUES
(1, 1, 7, 5),
(2, 1, 11, 10),
(30, 14, 7, 10),
(32, 14, 7, 20),
(33, 14, 7, 20),
(37, 2, 7, 3),
(39, 64, 7, 4),
(40, 64, 16, 5),
(42, 55, 11, 5),
(44, 14, 16, 3),
(45, 35, 7, 6),
(46, 58, 7, 7),
(51, 76, 16, 4),
(52, 76, 18, 2),
(55, 75, 16, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teile`
--

CREATE TABLE `teile` (
  `teileid` int(11) NOT NULL,
  `artnr` int(25) NOT NULL,
  `bezeichnung` text COLLATE utf8_german2_ci NOT NULL,
  `preis` double(25,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Daten für Tabelle `teile`
--

INSERT INTO `teile` (`teileid`, `artnr`, `bezeichnung`, `preis`) VALUES
(7, 2500, 'Arbeiter', 60.50),
(10, 100000, 'Test', 1000.00),
(11, 100001, 'Schraubenzieher', 24.00),
(12, 100003, 'Test3', 3000.00),
(16, 100006, 'Test6', 666666.00),
(17, 100008, 'Test 8', 6666.00),
(18, 100009, 'Artikel9', 7778.00),
(19, 333333, 'Schraubenzieher', 3.00),
(27, 222223, 'Test', 22.00),
(28, 33332, 'Test', 22.22),
(29, 99998, 'Test', 55.55),
(30, 9999987, 'Neuer test', 333.33),
(31, 44444, 'Bez', 44444.22),
(32, 0, 'Durchläuferartikel', 0.00);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `fahrzeug`
--
ALTER TABLE `fahrzeug`
  ADD PRIMARY KEY (`fzid`),
  ADD KEY `kundeid` (`kundeid`);

--
-- Indizes für die Tabelle `kunde`
--
ALTER TABLE `kunde`
  ADD PRIMARY KEY (`kundennummer`);

--
-- Indizes für die Tabelle `rechnung`
--
ALTER TABLE `rechnung`
  ADD PRIMARY KEY (`rechnungid`),
  ADD KEY `rechnungsnummer` (`rechnungsnummer`),
  ADD KEY `kundenid` (`kundenid`),
  ADD KEY `fahrzeugid` (`fahrzeugid`);

--
-- Indizes für die Tabelle `rechnungdetails`
--
ALTER TABLE `rechnungdetails`
  ADD PRIMARY KEY (`rechnungdetailid`),
  ADD KEY `teileid` (`teileid`),
  ADD KEY `rechnungsnummer` (`rechnungsnummer`);

--
-- Indizes für die Tabelle `reparatur`
--
ALTER TABLE `reparatur`
  ADD PRIMARY KEY (`repid`),
  ADD KEY `fzid` (`fzid`);

--
-- Indizes für die Tabelle `reparaturdetails`
--
ALTER TABLE `reparaturdetails`
  ADD PRIMARY KEY (`repdetid`),
  ADD KEY `repid` (`repid`),
  ADD KEY `teileid` (`teileid`);

--
-- Indizes für die Tabelle `teile`
--
ALTER TABLE `teile`
  ADD PRIMARY KEY (`teileid`),
  ADD UNIQUE KEY `artnr` (`artnr`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `fahrzeug`
--
ALTER TABLE `fahrzeug`
  MODIFY `fzid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `kunde`
--
ALTER TABLE `kunde`
  MODIFY `kundennummer` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `rechnungdetails`
--
ALTER TABLE `rechnungdetails`
  MODIFY `rechnungdetailid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `reparatur`
--
ALTER TABLE `reparatur`
  MODIFY `repid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT für Tabelle `reparaturdetails`
--
ALTER TABLE `reparaturdetails`
  MODIFY `repdetid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT für Tabelle `teile`
--
ALTER TABLE `teile`
  MODIFY `teileid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `fahrzeug`
--
ALTER TABLE `fahrzeug`
  ADD CONSTRAINT `fahrzeug_ibfk_1` FOREIGN KEY (`kundeid`) REFERENCES `kunde` (`kundennummer`);

--
-- Constraints der Tabelle `rechnung`
--
ALTER TABLE `rechnung`
  ADD CONSTRAINT `rechnung_ibfk_1` FOREIGN KEY (`kundenid`) REFERENCES `kunde` (`kundennummer`),
  ADD CONSTRAINT `rechnung_ibfk_2` FOREIGN KEY (`fahrzeugid`) REFERENCES `fahrzeug` (`fzid`);

--
-- Constraints der Tabelle `rechnungdetails`
--
ALTER TABLE `rechnungdetails`
  ADD CONSTRAINT `rechnungdetails_ibfk_1` FOREIGN KEY (`rechnungsnummer`) REFERENCES `rechnung` (`rechnungsnummer`),
  ADD CONSTRAINT `rechnungdetails_ibfk_2` FOREIGN KEY (`teileid`) REFERENCES `teile` (`teileid`);

--
-- Constraints der Tabelle `reparatur`
--
ALTER TABLE `reparatur`
  ADD CONSTRAINT `reparatur_ibfk_1` FOREIGN KEY (`fzid`) REFERENCES `fahrzeug` (`fzid`);

--
-- Constraints der Tabelle `reparaturdetails`
--
ALTER TABLE `reparaturdetails`
  ADD CONSTRAINT `reparaturdetails_ibfk_1` FOREIGN KEY (`repid`) REFERENCES `reparatur` (`repid`),
  ADD CONSTRAINT `reparaturdetails_ibfk_2` FOREIGN KEY (`teileid`) REFERENCES `teile` (`teileid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
