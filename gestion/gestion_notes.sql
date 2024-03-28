-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 06 Janvier 2024 à 17:14
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_notes`
--

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nom` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `classes`
--

INSERT INTO `classes` (`id`, `nom`) VALUES
(1, 'TG1'),
(2, 'TG2'),
(3, 'TG3'),
(4, 'TG4'),
(5, 'TG5'),
(6, 'TG6'),
(7, 'TG7'),
(8, 'TG8'),
(9, 'TG9');

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `ine` char(20) NOT NULL,
  `classe` int(11) NOT NULL,
  `nom` char(40) NOT NULL,
  `prenom` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `eleves`
--

INSERT INTO `eleves` (`ine`, `classe`, `nom`, `prenom`) VALUES
('081534255GF', 5, 'Ternel', 'Lucas'),
('connard', 2, 'Parsy', 'Joseph'),
('filsdepute', 5, 'Lempereur', 'Nathan');

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE `matieres` (
  `id` int(11) NOT NULL,
  `nom` char(40) NOT NULL,
  `coefficient` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `matieres`
--

INSERT INTO `matieres` (`id`, `nom`, `coefficient`) VALUES
(1, 'NSI', 16),
(2, 'SES', 16),
(3, 'MATHSCompTerm', 2),
(4, 'Maths1ere', 8),
(5, 'EPST', 6),
(6, 'HG1ere', 3),
(7, 'HGTerm', 3),
(8, 'ENS1ere', 3),
(9, 'ENSTerm', 3),
(10, 'LVA1ere', 3),
(11, 'LVATerm', 3),
(12, 'LVA1ere', 3),
(13, 'LVBTerm', 3),
(14, 'LVB1ere', 3),
(15, 'EMC1ere', 1),
(16, 'EMCTerm', 1),
(17, 'FrançaisEcrit', 5),
(18, 'FrançaisOral', 5);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `note` float NOT NULL,
  `matiere` int(11) NOT NULL,
  `professeur` int(11) NOT NULL,
  `eleves` char(20) NOT NULL,
  `coef` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `notes`
--

INSERT INTO `notes` (`id`, `note`, `matiere`, `professeur`, `eleves`, `coef`) VALUES
(12, 16, 5, 5, 'filsdepute', 1),
(13, 15, 1, 1, '081534255GF', 3),
(14, 20, 1, 1, '081534255GF', 1),
(15, 15, 3, 3, '081534255GF', 2),
(18, 20, 1, 1, '081534255GF', 2),
(19, 15, 4, 4, '081534255GF', 2),
(20, 20, 1, 1, '081534255GF', 1);

-- --------------------------------------------------------

--
-- Structure de la table `professeurs`
--

CREATE TABLE `professeurs` (
  `id` int(11) NOT NULL,
  `nom` char(40) NOT NULL,
  `matiere` int(11) NOT NULL,
  `classe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `professeurs`
--

INSERT INTO `professeurs` (`id`, `nom`, `matiere`, `classe`) VALUES
(1, 'Caneri', 1, 5),
(2, 'Segret', 1, 5),
(3, 'Gavory', 1, 5),
(4, 'Librecht', 1, 5),
(5, 'Lemaire', 1, 5),
(6, 'Skarzynski', 6, 5),
(7, 'Hepner', 7, 5),
(8, 'Leclercq / Fertelle', 8, 5),
(9, 'Prevost / Segart', 10, 5),
(10, 'Le Gallo', 10, 5),
(11, 'Queant', 11, 5),
(12, 'Sanchez', 12, 5);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`ine`),
  ADD KEY `classe` (`classe`);

--
-- Index pour la table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matiere` (`matiere`),
  ADD KEY `professeur` (`professeur`),
  ADD KEY `eleves` (`eleves`),
  ADD KEY `coefficient` (`coef`),
  ADD KEY `coefficients` (`coef`);

--
-- Index pour la table `professeurs`
--
ALTER TABLE `professeurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matiere` (`matiere`),
  ADD KEY `classe` (`classe`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `matieres`
--
ALTER TABLE `matieres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `professeurs`
--
ALTER TABLE `professeurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD CONSTRAINT `eleves_ibfk_1` FOREIGN KEY (`classe`) REFERENCES `classes` (`id`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`professeur`) REFERENCES `professeurs` (`id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`eleves`) REFERENCES `eleves` (`ine`),
  ADD CONSTRAINT `notes_ibfk_3` FOREIGN KEY (`matiere`) REFERENCES `matieres` (`id`);

--
-- Contraintes pour la table `professeurs`
--
ALTER TABLE `professeurs`
  ADD CONSTRAINT `professeurs_ibfk_1` FOREIGN KEY (`matiere`) REFERENCES `matieres` (`id`),
  ADD CONSTRAINT `professeurs_ibfk_2` FOREIGN KEY (`classe`) REFERENCES `classes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
