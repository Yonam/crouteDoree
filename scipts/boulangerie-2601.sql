-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 26, 2018 at 04:01 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boulangerie`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `CODE_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE_CATEGORIE` varchar(25) DEFAULT NULL,
  `PRIX_APPLIQUE` int(11) DEFAULT NULL,
  `SUPPRIME` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`CODE_CATEGORIE`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `CODE_CLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_CATEGORIE` int(11) NOT NULL,
  `NOM_CLIENT` varchar(50) DEFAULT NULL,
  `CONTACT_CLIENT` varchar(15) DEFAULT NULL,
  `SUPPRIME` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`CODE_CLIENT`),
  KEY `FK_ASSOCIATION_10` (`CODE_CATEGORIE`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `CODE_CMDE` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_CLIENT` int(11) NOT NULL,
  `CODE_USER` int(11) NOT NULL,
  `DATE_CMDE` date DEFAULT NULL,
  `DATE_LIVRAISON` date NOT NULL,
  `HEURE_LIVRAISON` varchar(10) NOT NULL,
  `NUMERO_TICKET` int(10) DEFAULT NULL,
  `VALIDE` tinyint(1) NOT NULL DEFAULT '0',
  `SUPPRIME` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`CODE_CMDE`),
  KEY `FK_ASSOCIATION_6` (`CODE_CLIENT`),
  KEY `FK_ENREGISTRE` (`CODE_USER`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `commande_pain`
--

DROP TABLE IF EXISTS `commande_pain`;
CREATE TABLE IF NOT EXISTS `commande_pain` (
  `CODE_CMDE` int(11) NOT NULL,
  `CODE_PAIN` int(11) NOT NULL,
  `QUANTITE` int(11) DEFAULT NULL,
  `PRIX_VENTE` float(4,0) DEFAULT NULL,
  `TOTAL` float(9,0) DEFAULT NULL,
  PRIMARY KEY (`CODE_CMDE`,`CODE_PAIN`),
  KEY `FK_COMMANDE_PAIN2` (`CODE_PAIN`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `CODE_LIVRAISON` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_CMDE` int(11) NOT NULL,
  `DATE_LIVRAISON` date DEFAULT NULL,
  `HEURE_LIVRAISON` time DEFAULT NULL,
  `MONTANT_LIV` float(8,2) DEFAULT NULL,
  `SUPPRIME` tinyint(1) DEFAULT '0',
  `VALIDE` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`CODE_LIVRAISON`),
  KEY `FK_LIVRAISON_COMMANDE` (`CODE_CMDE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logs_actions`
--

DROP TABLE IF EXISTS `logs_actions`;
CREATE TABLE IF NOT EXISTS `logs_actions` (
  `ID_LOG` int(11) NOT NULL AUTO_INCREMENT,
  `CODE_CMDE` int(11) NOT NULL,
  `CODE_LIVRAISON` int(11) NOT NULL,
  `CODE_PAIN` int(11) NOT NULL,
  `ACTIONS` varchar(30) DEFAULT NULL,
  `DATE_HEURE` datetime DEFAULT NULL,
  `USER` varchar(30) DEFAULT NULL,
  `ID_ACTION` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_LOG`),
  KEY `FK_ASSOCIATION_7` (`CODE_CMDE`),
  KEY `FK_ASSOCIATION_8` (`CODE_LIVRAISON`),
  KEY `FK_ASSOCIATION_9` (`CODE_PAIN`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pains`
--

DROP TABLE IF EXISTS `pains`;
CREATE TABLE IF NOT EXISTS `pains` (
  `CODE_PAIN` int(11) NOT NULL AUTO_INCREMENT,
  `REFERENCE` char(10) DEFAULT NULL,
  `LIBELLE` varchar(25) DEFAULT NULL,
  `PRIX_UNIT` float(5,0) DEFAULT NULL,
  `SUPPRIME` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`CODE_PAIN`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `CODE_PRIVILEGE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`CODE_PRIVILEGE`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

DROP TABLE IF EXISTS `reference`;
CREATE TABLE IF NOT EXISTS `reference` (
  `REFERENCE` varchar(5) NOT NULL,
  `QUANTITE` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `CODE_USER` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_USER` varchar(20) NOT NULL,
  `CODE_PRIVILEGE` int(11) NOT NULL,
  `LOGIN` varchar(20) DEFAULT NULL,
  `MDP` varchar(300) DEFAULT NULL,
  `SUPPRIME` tinyint(1) DEFAULT '0',
  `connecte` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CODE_USER`),
  KEY `FK_AVOIR_PRIVILEGES` (`CODE_PRIVILEGE`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`CODE_USER`, `NOM_USER`, `CODE_PRIVILEGE`, `LOGIN`, `MDP`, `SUPPRIME`, `connecte`) VALUES
(1, 'Administrateur', 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, 1),
(2, 'Caissier', 2, 'caisse', 'abecdd24c34f12215f3198c2c7fbb478b296ac92', 0, 0),
(3, 'toto', 1, 'toto', NULL, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
