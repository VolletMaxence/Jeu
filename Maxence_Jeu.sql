-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Dim 21 fév. 2021 à 00:25
-- Version du serveur :  10.1.47-MariaDB-0+deb9u1
-- Version de PHP : 7.0.33-0+deb9u10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Maxence_Jeu`
--

-- --------------------------------------------------------

--
-- Structure de la table `adversaire`
--

CREATE TABLE `adversaire` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Vie` int(11) NOT NULL,
  `Attaque` int(11) NOT NULL,
  `Defense` int(11) NOT NULL,
  `Soin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adversaire`
--

INSERT INTO `adversaire` (`ID`, `Nom`, `Vie`, `Attaque`, `Defense`, `Soin`) VALUES
(1, 'Krhaal', 100, 25, 10, 5),
(2, 'Storm Terror', 100, 35, 4, 1),
(3, 'Cafetière', 100, 15, 16, 9),
(4, 'BoB', 100, 13, 14, 13),
(5, 'Klee', 100, 25, 10, 5);

-- --------------------------------------------------------

--
-- Structure de la table `adversaire_copie`
--

CREATE TABLE `adversaire_copie` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Vie` int(11) NOT NULL,
  `Attaque` int(11) NOT NULL,
  `Defense` int(11) NOT NULL,
  `Soin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `adversaire_copie`
--

INSERT INTO `adversaire_copie` (`ID`, `Nom`, `Vie`, `Attaque`, `Defense`, `Soin`) VALUES
(326, 'Krhaal', 10, 20, 10, 10),
(334, 'BoB', 10, 13, 14, 13),
(356, 'Storm Terror', 10, 35, 4, 1),
(359, 'Krhaal', 10, 25, 10, 5);

-- --------------------------------------------------------

--
-- Structure de la table `perso`
--

CREATE TABLE `perso` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Vie` int(11) NOT NULL,
  `Attaque` int(11) NOT NULL,
  `Defense` int(11) NOT NULL,
  `Soin` int(11) NOT NULL,
  `Score` int(11) NOT NULL,
  `IDCompte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `perso`
--

INSERT INTO `perso` (`ID`, `Nom`, `Vie`, `Attaque`, `Defense`, `Soin`, `Score`, `IDCompte`) VALUES
(1, 'Gros Chien', 100, 50, 10, 30, 0, 1),
(2, 'JP', 100, 10, 20, 9, 0, 2),
(6, 'PuceauGangGang', 100, 20, 10, 10, 0, 9),
(26, 'OwO', 100, 16, 20, 4, 0, 75),
(27, 'booba', 100, 38, 1, 1, 0, 76),
(28, 'Root', 100, 30, 5, 5, 0, 77);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `Pseudo` varchar(100) NOT NULL,
  `Mot_de_Passe` varchar(100) NOT NULL,
  `ID` int(11) NOT NULL,
  `IDPerso` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Pseudo`, `Mot_de_Passe`, `ID`, `IDPerso`) VALUES
('XenceV', 'root', 1, 1),
('PM', 'PV', 2, 2),
('UwU', '456', 75, 26),
('523', '65', 76, 27),
('root', 'root', 77, 28),
('41', '41', 78, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adversaire`
--
ALTER TABLE `adversaire`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `adversaire_copie`
--
ALTER TABLE `adversaire_copie`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `perso`
--
ALTER TABLE `perso`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adversaire`
--
ALTER TABLE `adversaire`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `adversaire_copie`
--
ALTER TABLE `adversaire_copie`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT pour la table `perso`
--
ALTER TABLE `perso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
