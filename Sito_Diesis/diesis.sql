-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2016 alle 11:41
-- Versione del server: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diesis`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `Key` int(200) NOT NULL AUTO_INCREMENT,
  `Username` char(20) NOT NULL,
  `Genere` varchar(50) NOT NULL,
  `DataCreazione` date NOT NULL,
  `Titolo` varchar(50) NOT NULL,
  `Link` varchar(255) NOT NULL,
  PRIMARY KEY (`Key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `files`
--

INSERT INTO `files` (`Key`, `Username`, `Genere`, `DataCreazione`, `Titolo`, `Link`) VALUES
(1, 'whmori', 'Rock', '2016-04-05', 'Smell like teen spirit', 'http://www.whmori.ciao'),
(2, 'whmori', 'Indie rock', '2016-04-20', '505', 'http://www.whmori.ciao'),
(3, 'whmori', 'Rock', '2016-04-03', 'In bloom', 'http://www.whmori.ciao'),
(4, 'larry', 'classic', '2016-04-08', '4th simphony', 'http://www.larry.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Username` char(20) NOT NULL,
  `Password` char(32) NOT NULL,
  `Email` varchar(30) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabella che contiene gli Users del programma Diesis#';

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`Username`, `Password`, `Email`) VALUES
('larry', '698d51a19d8a121ce581499d7b701668', 'larry@gmail,com'),
('whmori', '698d51a19d8a121ce581499d7b701668', 'gabrielemori@outlook.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
