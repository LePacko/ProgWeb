-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 19 jan. 2020 à 21:11
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `note`, `commentaire`, `id_circuit`, `id_motard`) VALUES
(16, 1, 'avis carole', 3, 1),
(17, 3, 'Circuit Turismo pas mal  !', 4, 1),
(18, 5, 'Circuit yoda dingue !', 2, 1),
(19, 5, 'fou comme son nom ! ', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `circuit`
--

DROP TABLE IF EXISTS `circuit`;
CREATE TABLE IF NOT EXISTS `circuit` (
  `id_circuit` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(128) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `longueur` int(11) DEFAULT NULL,
  `nom` varchar(128) NOT NULL,
  `image_circuit` varchar(500) DEFAULT NULL,
  `SIRET` bigint(20) NOT NULL,
  PRIMARY KEY (`id_circuit`),
  KEY `circuit_entreprise_FK` (`SIRET`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `circuit`
--

INSERT INTO `circuit` (`id_circuit`, `adresse`, `code_postal`, `longueur`, `nom`, `image_circuit`, `SIRET`) VALUES
(1, '10 rue du puit', 93170, 1500, 'Circuit Fou', NULL, 11111111111111),
(2, '10 rue des mirabelle', 92560, 1000, 'Circuit Yota', NULL, 11111111111111),
(3, 'RD40, 93290 Tremblay-en-France', 93290, 2055, 'Circuit Carole', NULL, 11111111111111),
(4, '30 rue des tournelles', 92560, 1000, 'Turismo 1', NULL, 11111111111111);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `SIRET` bigint(20) NOT NULL,
  `denomination` varchar(128) NOT NULL,
  `adresse` varchar(128) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `numero_tel` int(11) DEFAULT NULL,
  `date_d_affiliation` date NOT NULL,
  `mdp` varchar(268) NOT NULL,
  `mail_entreprise` varchar(268) NOT NULL,
  `image_gerant` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`SIRET`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`SIRET`, `denomination`, `adresse`, `code_postal`, `numero_tel`, `date_d_affiliation`, `mdp`, `mail_entreprise`, `image_gerant`) VALUES
(11111000000465, 'Grand Turismo', '67 rue de noisy le sec', 93260, 664379946, '2020-01-19', '07123e1f482356c415f684407a3b8723e10b2cbbc0b8fcd6282c49d37c9c1abc', 'gerantCircuit2@gmail.com', NULL),
(11111111111111, 'ZEBRA', '70 rue de noisy le sec', 93260, 664379946, '2020-01-03', '07123e1f482356c415f684407a3b8723e10b2cbbc0b8fcd6282c49d37c9c1abc', 'gerantCircuit@gmail.com', NULL),
(11111111114444, 'SpeddFuze', '67 rue de noisy le sec', 93260, 664379946, '2020-01-04', '07123e1f482356c415f684407a3b8723e10b2cbbc0b8fcd6282c49d37c9c1abc', 'gerantCircuit3@gmail.fr', NULL),
(12222222225555, 'RalySpeed', '67 rue de noisy le sec', 95260, 664379946, '2020-01-19', '07123e1f482356c415f684407a3b8723e10b2cbbc0b8fcd6282c49d37c9c1abc', 'gerantCircuit4@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `modele_moto`
--

DROP TABLE IF EXISTS `modele_moto`;
CREATE TABLE IF NOT EXISTS `modele_moto` (
  `marque` varchar(64) NOT NULL,
  `modele` varchar(64) NOT NULL,
  `cylindree` int(11) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `puissance` int(11) DEFAULT NULL,
  PRIMARY KEY (`marque`,`modele`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `modele_moto`
--

INSERT INTO `modele_moto` (`marque`, `modele`, `cylindree`, `type`, `puissance`) VALUES
('ducati', 'diavel', NULL, NULL, NULL),
('ducati', 'monster', 696, 'roadster', 70),
('ducati', 'multistrada1260', NULL, NULL, NULL),
('honda', 'africa twin', NULL, NULL, NULL),
('honda', 'cb500', 500, 'sportive', 45),
('honda', 'cbr600', 600, 'sportive', 106),
('honda', 'hornet', NULL, NULL, NULL),
('suzuki', 'gsx-s1000', NULL, NULL, NULL),
('suzuki', 'gsx-s650', NULL, NULL, NULL),
('suzuki', 'gsxr1000', 1000, 'sportive', 185),
('suzuki', 'katana', NULL, NULL, NULL),
('suzuki', 'v-storm650', NULL, NULL, NULL),
('triumph', 'tiger', 700, 'trail', 80),
('yamaha', 'mt07', 700, 'roadster', 75),
('yamaha', 'mt09', 900, 'roadster', 900),
('yamaha', 'r1', 1000, 'sportive', 200),
('yamaha', 'r6', NULL, NULL, NULL),
('yamaha', 'xj6', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `motard`
--

DROP TABLE IF EXISTS `motard`;
CREATE TABLE IF NOT EXISTS `motard` (
  `id_motard` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `adresse` varchar(128) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `mail` varchar(128) NOT NULL,
  `numero_tel` int(11) NOT NULL,
  `permis` varchar(3) NOT NULL,
  `mdp` varchar(268) NOT NULL,
  `imageProfile` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id_motard`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `motard`
--

INSERT INTO `motard` (`id_motard`, `nom`, `prenom`, `adresse`, `code_postal`, `mail`, `numero_tel`, `permis`, `mdp`, `imageProfile`) VALUES
(1, 'TALBI', 'Nael', '67 rue de noisy le sec ', 93260, 'motard@gmail.com', 664379946, 'A', '07123e1f482356c415f684407a3b8723e10b2cbbc0b8fcd6282c49d37c9c1abc', NULL),
(2, 'Hanouna', 'Cyril', '69 rue de noisy le sec', 93260, 'motard2@gmail.com', 663804225, 'A', '07123e1f482356c415f684407a3b8723e10b2cbbc0b8fcd6282c49d37c9c1abc', NULL),
(3, 'Macron', 'Emmanuel', '69 rue de noisy le sec', 93260, 'motard3@gmail.com', 663804225, 'A', '07123e1f482356c415f684407a3b8723e10b2cbbc0b8fcd6282c49d37c9c1abc', NULL);

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
('CY-229-H', 2002, NULL, 1, 'yamaha', 'r1');

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

DROP TABLE IF EXISTS `reserver`;
CREATE TABLE IF NOT EXISTS `reserver` (
  `id_session` int(11) NOT NULL,
  `id_motard` int(11) NOT NULL,
  `temps_tour` int(11) DEFAULT 0,
  PRIMARY KEY (`id_session`,`id_motard`),
  KEY `Effectuer_motard0_FK` (`id_motard`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reserver`
--

INSERT INTO `reserver` (`id_session`, `id_motard`, `temps_tour`) VALUES
(8, 1, 0);

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
  `nb_participant` int(11) DEFAULT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `id_circuit` int(11) NOT NULL,
  PRIMARY KEY (`id_session`),
  KEY `session_circuit_FK` (`id_circuit`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id_session`, `date`, `nb_place`, `tarif`, `nb_participant`, `heure_debut`, `heure_fin`, `image`, `id_circuit`) VALUES
(1, '2020-02-06', 2, 10, 2, '13:56:00', '16:57:00', NULL, 1),
(3, '2020-02-20', 103, 10, 8, '14:36:00', '16:36:00', NULL, 3),
(4, '2020-04-15', 5, 199, 5, '16:42:00', '20:42:00', NULL, 3),
(5, '2020-02-06', 50, 10, 1, '15:30:00', '17:30:00', NULL, 2),
(6, '2020-01-30', 30, 20, NULL, '15:30:00', '19:30:00', NULL, 2),
(7, '2020-04-02', 12, 50, 10, '14:00:00', '16:00:00', NULL, 4),
(8, '2020-01-01', 10, 15, 10, '08:00:00', '12:00:00', NULL, 3);

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
-- Contraintes pour la table `moto`
--
ALTER TABLE `moto`
  ADD CONSTRAINT `moto_modele_moto0_FK` FOREIGN KEY (`marque`,`modele`) REFERENCES `modele_moto` (`marque`, `modele`),
  ADD CONSTRAINT `moto_motard_FK` FOREIGN KEY (`id_motard`) REFERENCES `motard` (`id_motard`);

--
-- Contraintes pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD CONSTRAINT `Effectuer_motard0_FK` FOREIGN KEY (`id_motard`) REFERENCES `motard` (`id_motard`),
  ADD CONSTRAINT `Effectuer_session_FK` FOREIGN KEY (`id_session`) REFERENCES `session` (`id_session`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_circuit_FK` FOREIGN KEY (`id_circuit`) REFERENCES `circuit` (`id_circuit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
