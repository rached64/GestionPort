-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 30 sep. 2020 à 18:05
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionport`
--

-- --------------------------------------------------------

--
-- Structure de la table `bureau`
--

CREATE TABLE `bureau` (
  `idbureau` int(11) NOT NULL,
  `nombureau` varchar(50) NOT NULL,
  `etagebureau` varchar(50) NOT NULL,
  `surfbureau` float NOT NULL,
  `eclabureau` varchar(50) NOT NULL,
  `climbureau` varchar(50) NOT NULL,
  `prise` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bureau`
--

INSERT INTO `bureau` (`idbureau`, `nombureau`, `etagebureau`, `surfbureau`, `eclabureau`, `climbureau`, `prise`) VALUES
(3, 'dev', '2', 13.24, 'non', 'oui', 'p1 -&gt; p6'),
(4, 'bureau1', '3', 14.23, 'non', 'non', 'p6-&gt;p8'),
(7, 'bureau3', '1', 12, 'oui', 'oui', 'p8-&gt;p10'),
(8, 'aa', '2', 19, 'oui', 'non', 'pirse 10 vers prise 15'),
(12, 'abcde', '3', 18, 'non', 'non', 'prise 15 vers prise 20'),
(13, 'abcde', '1', 19, 'oui', 'oui', 'prise 20 vers prise 25'),
(14, 'cozi2', '3', 200, 'non', 'non', 'prise 25 vers prise 30'),
(15, 'abcdefgh', '1', 170, 'oui', 'non', 'prise 30 vers prise 35'),
(18, 'bureau21', '2', 15.15, 'oui', 'oui', 'prise 35 vers prise 40'),
(19, 'Grande salle', '1', 98, 'non', 'non', 'prise 40 vers prise 45'),
(21, 'mega dev', '3', 23, 'oui', 'non', 'prise 45 vers prise 50'),
(23, 'bureau8', '3', 32, 'oui', 'non', 'p8->p32'),
(24, 'bureau9', '3', 45, 'oui', 'oui', 'prise 45 vers prise 50'),
(26, 'deva', '3', 17, 'non', 'non', 'p1 -&gt; p7');

-- --------------------------------------------------------

--
-- Structure de la table `port`
--

CREATE TABLE `port` (
  `idPort` int(11) NOT NULL,
  `Numport` varchar(11) NOT NULL,
  `adresseport` text NOT NULL,
  `statuport` varchar(50) NOT NULL,
  `bureau` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `port`
--

INSERT INTO `port` (`idPort`, `Numport`, `adresseport`, `statuport`, `bureau`) VALUES
(8, '1', '127.127.142.188', 'déactivé', 14),
(10, '2', '172.165.142.190', 'activé', 3),
(11, '3', '179.165.142.158', 'déactivé', 4),
(12, '4', '172.165.142.100', 'activé', 8),
(16, 'p1-&gt;p48', '172.17.16.80128', 'déactivé', 14),
(17, '3', '179.165.142.158', 'activé', 12),
(18, '3', '127.127.142.191', 'activé', 14),
(19, '10', '127.127.142.191', 'déactivé', 24),
(35, '200', '179.165.142.158', 'activé', 26),
(37, '300', '172.165.142.100', 'activé', 26),
(39, '50', '193.165.142.158', 'déactivé', 7),
(40, '500', '193.165.142.199', 'activé', 12),
(43, '33', '172.127.142.191', 'déactivé', 4),
(44, '1', '173.165.142.158', 'activé', 13),
(45, '10', '172.165.142.190', 'activé', 19),
(46, '16', '109.165.142.158', 'activé', 15),
(47, '18', '172.165.142.110', 'activé', 23);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bureau`
--
ALTER TABLE `bureau`
  ADD PRIMARY KEY (`idbureau`);

--
-- Index pour la table `port`
--
ALTER TABLE `port`
  ADD PRIMARY KEY (`idPort`),
  ADD KEY `bureau` (`bureau`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bureau`
--
ALTER TABLE `bureau`
  MODIFY `idbureau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `port`
--
ALTER TABLE `port`
  MODIFY `idPort` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `port`
--
ALTER TABLE `port`
  ADD CONSTRAINT `port_ibfk_1` FOREIGN KEY (`bureau`) REFERENCES `bureau` (`idbureau`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
