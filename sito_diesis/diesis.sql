-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mag 16, 2016 alle 17:48
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
  `Pubblico` tinyint(1) NOT NULL,
  PRIMARY KEY (`Key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `files`
--

INSERT INTO `files` (`Key`, `Username`, `Genere`, `DataCreazione`, `Titolo`, `Link`, `Pubblico`) VALUES
(1, 'whmori', 'Rock', '2016-04-05', 'Smell like teen spirit', 'http://www.whmori.ciao', 1),
(2, 'whmori', 'Indie rock', '2016-04-20', '505', 'http://www.whmori.ciao', 1),
(3, 'whmori', 'Rock', '2016-04-03', 'In bloom', 'http://www.whmori.ciao', 0),
(4, 'larry', 'classic', '2016-04-08', '4th simphony', 'http://www.larry.com', 1),
(5, 'larry', 'Indie rock', '2016-05-08', 'The pretender', 'http://www.larry.com', 1),
(6, 'larry', 'Classic', '2016-05-09', '5Th Simphony', 'http://www.larry.com', 0);

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
('larry2', '698d51a19d8a121ce581499d7b701668', 'larry2@gmail.com'),
('larry3', '698d51a19d8a121ce581499d7b701668', 'larry3@gmail.com'),
('whmori', '698d51a19d8a121ce581499d7b701668', 'gabrielemori@outlook.com'),
('whmori2', '698d51a19d8a121ce581499d7b701668', 'whmori2@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
