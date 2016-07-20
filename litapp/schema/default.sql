SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+01:00";

--
-- Datenbank: `LitAppDB`
--

CREATE DATABASE IF NOT EXISTS `LitUpDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Sentences`
--

CREATE TABLE `LitUpDB`.`Sentences` (
  `ID` int(11) NOT NULL,
  `ID_Parent` int(11) NOT NULL,
  `HasChildren` boolean DEFAULT '0',
  `Text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Sentences`
--
ALTER TABLE `LitUpDB`.`Sentences`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT für Tabelle `Sentences`
--
ALTER TABLE `LitUpDB`.`Sentences`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
