-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 07 jan. 2021 à 10:26
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
-- Structure de la table `newcaddie`
--

CREATE TABLE `newcaddie` (
  `id` int(100) NOT NULL,
  `product_id` int(100) DEFAULT NULL,
  `qte` int(5) DEFAULT NULL,
  `lasession` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `newcaddie`
--

INSERT INTO `newcaddie` (`id`, `product_id`, `qte`, `lasession`) VALUES
(30, 5, 2, '73ebf6a36d2a9823ecf8600cf28ad039'),
(31, 3, 1, '73ebf6a36d2a9823ecf8600cf28ad039'),
(32, 8, 1, '73ebf6a36d2a9823ecf8600cf28ad039'),
(33, 18, 1, '73ebf6a36d2a9823ecf8600cf28ad039'),
(28, 7, 1, '946bc5d549ac4cb7b38e0a57e39cd98e'),
(29, 1, 1, '73ebf6a36d2a9823ecf8600cf28ad039'),
(27, 8, 2, '946bc5d549ac4cb7b38e0a57e39cd98e'),
(34, 10, 1, '73ebf6a36d2a9823ecf8600cf28ad039'),
(35, 13, 1, '73ebf6a36d2a9823ecf8600cf28ad039'),
(36, 15, 1, '73ebf6a36d2a9823ecf8600cf28ad039'),
(43, 7, 1, '359c333152d07b52f0245ab84b0e220c'),
(39, 5, 1, '27267ec058358882b32452957be3ec72'),
(42, 5, 1, '359c333152d07b52f0245ab84b0e220c'),
(44, 8, 1, '359c333152d07b52f0245ab84b0e220c'),
(51, 7, 11, 'acdf9f617318c361916f23b86391da69'),
(50, 5, 2, 'acdf9f617318c361916f23b86391da69'),
(49, 1, 2, 'acdf9f617318c361916f23b86391da69');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `newcaddie`
--
ALTER TABLE `newcaddie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `newcaddie`
--
ALTER TABLE `newcaddie`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
