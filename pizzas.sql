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
-- Structure de la table `pizzas`
--

CREATE TABLE `pizzas` (
  `id` int(10) NOT NULL,
  `titre` varchar(200) DEFAULT NULL,
  `pv_ttc` double(5,2) DEFAULT NULL,
  `ingredients` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pizzas`
--

INSERT INTO `pizzas` (`id`, `titre`, `pv_ttc`, `ingredients`) VALUES
(1, 'Salleloise', 11.50, 'Tomates, Magrets, Gésiers, Champignons, Persillade, Oeufs, Mozzarella, Emmental, Olives'),
(2, 'Bolognaise', 10.00, 'Tomates, Viande hachée, Oignons, Mozzarella, Emmental'),
(3, 'Carpaccio', 10.50, 'Tomates, Carpaccio, Copeaux de Parmenan, Mozzarella, Roquette'),
(5, 'Italienne', 10.50, 'Tomates, Pesto, Jambon italien, Copeaux de Parmesan, Mozzarella, Emmental, Roquette'),
(6, 'Reine', 9.50, 'Tomates, Jambon cuit, Champignons, Mozzarella, Emmental, Olives'),
(7, 'Pyrénéenne', 13.00, 'Tomates, Charcuterie de montagne, Fromage de pays, Champignons, Mozzarella, Emmental'),
(8, 'Végane', 11.00, 'Tomates, Aubergines, Oignons, Poivrons, Champignons, Artichauds, Huile d\'Olives, Roquette'),
(9, '4 Fromages', 10.50, 'Crème Fraîche, Chèvre, Comté, Mozzarella, Emmental'),
(10, 'Chèvre Miel', 11.00, 'Crème Fraîche, Chèvre, Jambon cuit, Miel, Mozzarella, Emmental'),
(12, 'Carbonara', 11.00, 'Crème Fraîche, Lardons, Oignons, Oeuf, Copeaux de Parmesan, Mozzarella, Emmental'),
(13, 'Tartiflette', 13.50, 'Crème Fraîche, Pommes de terre, Lardons, Oignons, Reblochon, Mozzarella, Emmental'),
(15, 'Indienne', 10.50, 'Crème Fraîche, Poulet, Oignons, Poivrons, Sauce Curry, Mozzarella, Emmental'),
(16, 'Orientale', 11.00, 'Crème Fraîche, Kebab, Oignons, Poivrons, Sauce Kebab, Mozzarella, Emmental'),
(18, 'Foie Gras', 13.50, 'Crème Fraîche, Mozzarella, Emmental, Confit d\'Oignons local, Poires, Champignons, Magrets de canard, Foie Gras et une touche d\'Armagnac'),
(19, 'Corse', 12.00, 'Sauce tomate, Mozza, Emmental, Champignons, Coppa Corse, Fromage de Brebis Corse, Chataîgnes');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `titre` (`titre`),
  ADD KEY `pv_ttc` (`pv_ttc`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
