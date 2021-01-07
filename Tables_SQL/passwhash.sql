-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 07 jan. 2021 à 10:24
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
-- Structure de la table `passwhash`
--

CREATE TABLE `passwhash` (
  `auto` int(10) NOT NULL,
  `identif` varchar(200) NOT NULL,
  `mdp` varchar(300) NOT NULL,
  `normal` varchar(100) DEFAULT NULL,
  `cryptage` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `passwhash`
--

INSERT INTO `passwhash` (`auto`, `identif`, `mdp`, `normal`, `cryptage`) VALUES
(82, 'fff', '$2y$10$yBYE5kpelZdfKWdQlEh8.udFiePPJn3DQ89ERcpJYHKS.FDpsWwJ6', 'ddd', NULL),
(81, 'ffff', '$2y$10$FMaSk3gzsWrY5/tF6zPoMeoodF0qTr9SDghOrvpoBBmFcWK9gCZCa', 'ddd', NULL),
(80, 'login', '$2y$10$GqWGo3/M/fkK/5qibIggNucN1Ra63fe3jsk.AiuubAWBBq/xreUlm', 'motdepasse', NULL),
(69, 'admin', '$2y$10$HZGilGuF4kYrk3Cyss6DS.qoda8E8HJNY7aWgf27E3r65a/su6R9W', 'jesuisla', NULL),
(70, 'tpdwwm', '$2y$10$fs472BoiVIa1GeUpID.xgOyi0730RhW0kpIahQZn3FXM9P4PUrp7C', '0000', NULL),
(72, 'greta', '$2y$10$uoCSCoS3ChzENt4pA5TLH.mBf0qs0ZcBXCD.CCmeOn34ldYR6HolG', 'greta', NULL),
(73, 'ez', '$2y$10$6ztOr3t4jJPeSHz8VI3fceirD2yaBquSr4/6DFYonmTLny6em2fpu', 'ez', NULL),
(79, 'coucou', '$2y$10$763M9Ruazq5bvwtJumj5mOZd2YHn1hgPKo5KFnD4DG2zRcdzCcPiu', 'lesamis', NULL),
(75, '123', '$2y$10$IPNQJw.ffa6sORClJ2Qv2uc2Pf.6D1TxO7EOYyyye3w9r6tXWdfLC', '456', NULL),
(77, '111', '$2y$10$uHJVneCvV0xoaVdWiiS6YOBVLCdmcH9hAuCXOnAlHEJ5lojomWO5a', '111', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `passwhash`
--
ALTER TABLE `passwhash`
  ADD PRIMARY KEY (`auto`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `passwhash`
--
ALTER TABLE `passwhash`
  MODIFY `auto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
