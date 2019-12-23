-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 17 déc. 2019 à 23:14
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(11) NOT NULL AUTO_INCREMENT,
  `note` int(11) NOT NULL,
  `commentaire` varchar(256) NOT NULL,
  `id_circuit` int(11) NOT NULL,
  `id_motard` int(11) NOT NULL,
  PRIMARY KEY (`id_avis`),
  KEY `avis_circuit_FK` (`id_circuit`),
  KEY `avis_motard0_FK` (`id_motard`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `circuit`
--

DROP TABLE IF EXISTS `circuit`;
CREATE TABLE IF NOT EXISTS `circuit` (
  `id_circuit` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(128) NOT NULL,
  `code_postale` int(11) NOT NULL,
  `longueur` int(11) DEFAULT NULL,
  `nom` varchar(128) NOT NULL,
  `image_circuit` varchar(500) NOT NULL,
  `SIRET` bigint(20) NOT NULL,
  PRIMARY KEY (`id_circuit`),
  KEY `circuit_entreprise_FK` (`SIRET`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `effectuer`
--

DROP TABLE IF EXISTS `effectuer`;
CREATE TABLE IF NOT EXISTS `effectuer` (
  `id_session` int(11) NOT NULL,
  `id_motard` int(11) NOT NULL,
  `temps_tour` int(11) NOT NULL,
  PRIMARY KEY (`id_session`,`id_motard`),
  KEY `Effectuer_motard0_FK` (`id_motard`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `SIRET` bigint(20) NOT NULL,
  `denomination` varchar(128) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `code_postale` int(11) NOT NULL,
  `numero_tel` int(11) DEFAULT NULL,
  `date_d_affiliation` date NOT NULL,
  `mdp` varchar(268) NOT NULL,
  `mail_entreprise` varchar(268) NOT NULL,
  `image_gerant` varchar(500) NOT NULL,
  PRIMARY KEY (`SIRET`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `modele_moto`
--

DROP TABLE IF EXISTS `modele_moto`;
CREATE TABLE IF NOT EXISTS `modele_moto` (
  `marque` varchar(64) NOT NULL,
  `modele` varchar(64) NOT NULL,
  `cylindree` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `puissance` int(11) NOT NULL,
  PRIMARY KEY (`marque`,`modele`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `modele_moto`
--

INSERT INTO `modele_moto` (`marque`, `modele`, `cylindree`, `type`, `puissance`) VALUES
('yamaha', 'mt07', 700, 'roadster', 75);

-- --------------------------------------------------------

--
-- Structure de la table `motard`
--

DROP TABLE IF EXISTS `motard`;
CREATE TABLE IF NOT EXISTS `motard` (
  `id_motard` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `Prenom` varchar(64) NOT NULL,
  `adresse` varchar(128) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `mail` varchar(128) NOT NULL,
  `numero_de_tel` int(11) NOT NULL,
  `permis` varchar(3) NOT NULL,
  `mdp` varchar(268) NOT NULL,
  `imageProfile` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id_motard`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `motard`
--

INSERT INTO `motard` (`id_motard`, `nom`, `Prenom`, `adresse`, `code_postal`, `mail`, `numero_de_tel`, `permis`, `mdp`, `imageProfile`) VALUES
(1, 'talbi', 'nael', '67 rue de noisy le sec ', 93260, 'nael@gmail.fr', 664379946, 'A', '07123e1f482356c415f684407a3b8723e10b2cbbc0b8fcd6282c49d37c9c1abc', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `moto`
--

DROP TABLE IF EXISTS `moto`;
CREATE TABLE IF NOT EXISTS `moto` (
  `immatriculation` varchar(10) NOT NULL,
  `annee` int(11) NOT NULL,
  `image_ma_moto` varchar(500) DEFAULT NULL,
  `id_motard` int(11) NOT NULL,
  `marque` varchar(64) DEFAULT NULL,
  `modele` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`immatriculation`),
  KEY `moto_motard_FK` (`id_motard`),
  KEY `moto_modele_moto0_FK` (`marque`,`modele`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `moto`
--

INSERT INTO `moto` (`immatriculation`, `annee`, `image_ma_moto`, `id_motard`, `marque`, `modele`) VALUES
('CY-229-A', 2002, NULL, 1, 'yamaha', 'mt07'),
('CY-229-H', 2002, NULL, 1, 'yamaha', 'mt07'),
('CY-229-P', 2002, NULL, 1, 'yamaha', 'mt07');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `nb_place` int(11) NOT NULL,
  `tarif` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `nb_participant` int(11) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `image` varchar(500) NOT NULL,
  `id_circuit` int(11) NOT NULL,
  PRIMARY KEY (`id_session`),
  KEY `session_circuit_FK` (`id_circuit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_circuit_FK` FOREIGN KEY (`id_circuit`) REFERENCES `circuit` (`id_circuit`),
  ADD CONSTRAINT `avis_motard0_FK` FOREIGN KEY (`id_motard`) REFERENCES `motard` (`id_motard`);

--
-- Contraintes pour la table `circuit`
--
ALTER TABLE `circuit`
  ADD CONSTRAINT `circuit_entreprise_FK` FOREIGN KEY (`SIRET`) REFERENCES `entreprise` (`SIRET`);

--
-- Contraintes pour la table `effectuer`
--
ALTER TABLE `effectuer`
  ADD CONSTRAINT `Effectuer_motard0_FK` FOREIGN KEY (`id_motard`) REFERENCES `motard` (`id_motard`),
  ADD CONSTRAINT `Effectuer_session_FK` FOREIGN KEY (`id_session`) REFERENCES `session` (`id_session`);

--
-- Contraintes pour la table `moto`
--
ALTER TABLE `moto`
  ADD CONSTRAINT `moto_modele_moto0_FK` FOREIGN KEY (`marque`,`modele`) REFERENCES `modele_moto` (`marque`, `modele`),
  ADD CONSTRAINT `moto_motard_FK` FOREIGN KEY (`id_motard`) REFERENCES `motard` (`id_motard`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_circuit_FK` FOREIGN KEY (`id_circuit`) REFERENCES `circuit` (`id_circuit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
