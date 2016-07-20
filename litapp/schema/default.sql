#Note: Do not spread commands over multiple lines so as to ensure this schema can be used as an init-file.
CREATE DATABASE IF NOT EXISTS `LitAppDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `LitUpDB`;
CREATE TABLE `Sentences` ( `ID` int(11) NOT NULL, `ID_Parent` int(11) NOT NULL, `HasChildren` boolean DEFAULT '0', `Text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
ALTER TABLE `Sentences` ADD PRIMARY KEY (`ID`), ADD KEY `ID` (`ID`);
ALTER TABLE `Sentences` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
