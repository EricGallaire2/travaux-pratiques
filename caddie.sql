-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 07 jan. 2021 à 10:27
-- Version du serveur :  5.7.32-cll-lve
-- Version de PHP : 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ericwebc_twdwwm`
--

-- --------------------------------------------------------

--
-- Structure de la table `caddie`
--

CREATE TABLE `caddie` (
  `id` int(100) NOT NULL,
  `sessionid` varchar(50) DEFAULT NULL,
  `qte` int(10) DEFAULT NULL,
  `idprod` int(100) DEFAULT NULL,
  `idclient` int(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `caddie`
--

INSERT INTO `caddie` (`id`, `sessionid`, `qte`, `idprod`, `idclient`) VALUES
(11, '946bc5d549ac4cb7b38e0a57e39cd98e', 1, 5, NULL),
(10, '946bc5d549ac4cb7b38e0a57e39cd98e', 1, 3, NULL),
(3, '8f6ab68ea36863cba66de9f0c0868398', 1, 5, NULL),
(4, '8f6ab68ea36863cba66de9f0c0868398', 3, 6, NULL),
(9, '119f41c821f60660f13d7feb10c1e55b', 2, 3, NULL),
(6, '8f6ab68ea36863cba66de9f0c0868398', 7, 15, NULL),
(12, '946bc5d549ac4cb7b38e0a57e39cd98e', 1, 8, NULL),
(13, '946bc5d549ac4cb7b38e0a57e39cd98e', 6, 6, NULL),
(140, 'gfdgfdgdf', 5, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `caddie`
--
ALTER TABLE `caddie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessionid` (`sessionid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `caddie`
--
ALTER TABLE `caddie`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
