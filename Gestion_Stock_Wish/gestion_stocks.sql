-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 07 Janvier 2024 à 16:24
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_stocks`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `code` char(40) NOT NULL,
  `nom` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`code`, `nom`) VALUES
('CANERI', 'CANERI'),
('F123', 'F1 23'),
('FICHIERPDF', 'FICHIER PDF'),
('FICHIERPY', 'FICHIER Python'),
('Iphone13', 'Iphone 13'),
('PereNoel2023', 'Pere Noel en Fibre'),
('PHOTOEUROPAPARK', 'PHOTO EUROPA PARK'),
('PS5', 'PS5'),
('PS5MANETTE', 'Manette PS5'),
('RTX4080', 'Carte Graphique RTX 4080'),
('SapinNoel2023', 'Sapin de noel'),
('SESBACTERM', 'Livre pour la bac de spe SES'),
('STHIL230', 'Sthill 230'),
('TDF2023', 'Tour de France 2023'),
('WWE2k23', 'WWE 2K23');

-- --------------------------------------------------------

--
-- Structure de la table `rangements`
--

CREATE TABLE `rangements` (
  `id` int(11) NOT NULL,
  `nom` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rangements`
--

INSERT INTO `rangements` (`id`, `nom`) VALUES
(1, 'Sapin'),
(2, 'Articles de Noel'),
(3, 'Jeu de Catch'),
(4, 'Jeu de Formule 1'),
(5, 'Livre Scolaire'),
(6, 'Manga'),
(7, 'Tour de France'),
(8, 'Livre Scolaires'),
(9, 'Iphone'),
(10, 'Tronconneuse'),
(11, 'Playstation'),
(12, 'Figurine de Catch WWE'),
(13, 'Journaux'),
(14, 'Console PS5'),
(15, 'Cartes PSN'),
(16, 'Carte Graphique'),
(17, 'PROF DE NSI'),
(18, 'FICHIERS'),
(19, 'PHOTOS');

-- --------------------------------------------------------

--
-- Structure de la table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `article` char(40) NOT NULL,
  `rangement` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `stocks`
--

INSERT INTO `stocks` (`id`, `article`, `rangement`, `quantite`) VALUES
(1, 'CANERI', 17, 1),
(2, 'F123', 4, 1000),
(3, 'PS5', 14, 10),
(4, 'SESBACTERM', 8, 28),
(5, 'Iphone13', 9, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `rangements`
--
ALTER TABLE `rangements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article` (`article`),
  ADD KEY `rangement` (`rangement`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `rangements`
--
ALTER TABLE `rangements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`article`) REFERENCES `articles` (`code`),
  ADD CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`rangement`) REFERENCES `rangements` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
