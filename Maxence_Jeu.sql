-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 02 mars 2021 à 23:00
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `maxence_jeu`
--

-- --------------------------------------------------------

--
-- Structure de la table `adversaire`
--

DROP TABLE IF EXISTS `adversaire`;
CREATE TABLE IF NOT EXISTS `adversaire` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(100) NOT NULL,
  `Vie` int NOT NULL,
  `Attaque` int NOT NULL,
  `Defense` int NOT NULL,
  `Soin` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `adversaire`
--

INSERT INTO `adversaire` (`ID`, `Nom`, `Vie`, `Attaque`, `Defense`, `Soin`) VALUES
(1, 'Krhaal', 0, 15, 10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `perso`
--

DROP TABLE IF EXISTS `perso`;
CREATE TABLE IF NOT EXISTS `perso` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(100) NOT NULL,
  `Vie` int NOT NULL,
  `Attaque` int NOT NULL,
  `Defense` int NOT NULL,
  `Soin` int NOT NULL,
  `Score` int NOT NULL,
  `IDCompte` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `perso`
--

INSERT INTO `perso` (`ID`, `Nom`, `Vie`, `Attaque`, `Defense`, `Soin`, `Score`, `IDCompte`) VALUES
(1, 'Gros Chien', 70, 50, 10, 30, 0, 1),
(2, 'JP', 100, 10, 20, 9, 0, 2),
(4, 'test', 100, 1, 2, 3, 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `Pseudo` varchar(100) NOT NULL,
  `Mot_de_Passe` varchar(100) NOT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  `IDPerso` int NOT NULL,
  `Score` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Pseudo`, `Mot_de_Passe`, `ID`, `IDPerso`, `Score`) VALUES
('XenceV', 'root', 1, 1, 0),
('PM', 'PV', 2, 2, 0),
('test', 'test', 3, 4, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
