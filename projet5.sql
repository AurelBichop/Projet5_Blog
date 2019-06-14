-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 14 Juin 2019 à 09:56
-- Version du serveur :  10.1.38-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet5`
--

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

CREATE TABLE `billet` (
  `id` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `chapeau` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `id_billet` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_heure` datetime NOT NULL,
  `validation` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `is_administrateur` tinyint(1) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `courriel` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `billet`
--
ALTER TABLE `billet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_billet` (`id_billet`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courriel` (`courriel`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `billet`
--
ALTER TABLE `billet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `billet`
--
ALTER TABLE `billet`
  ADD CONSTRAINT `billet_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
