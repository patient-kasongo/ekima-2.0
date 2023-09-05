-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 31 août 2023 à 15:06
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ekima`
--

-- --------------------------------------------------------

--
-- Structure de la table `annee`
--

CREATE TABLE `annee` (
  `idAnnee` int(11) NOT NULL,
  `annee` varchar(255) NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annee`
--

INSERT INTO `annee` (`idAnnee`, `annee`, `debut`, `fin`) VALUES
(3, '2023-2024', '2024-07-02', '2024-07-02'),
(4, '2024-2025', '2024-09-02', '2025-07-02');

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `idClasse` int(11) NOT NULL,
  `tPromotionIdPromotion` int(11) DEFAULT NULL,
  `tOptionIdOption` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`idClasse`, `tPromotionIdPromotion`, `tOptionIdOption`) VALUES
(1, 3, 9),
(2, 4, 8),
(3, 2, 9),
(4, 2, 10);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `matricule` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `postnom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(1) DEFAULT NULL CHECK (`sexe` = 'M' or `sexe` = 'F'),
  `numeroDuResponsable` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`matricule`, `nom`, `postnom`, `prenom`, `sexe`, `numeroDuResponsable`) VALUES
('20KK171', 'KASEKA', 'KABEYA', 'gracia', 'F', '+243995956509'),
('23IM08181847', 'ILUNGA', 'MUKALA', 'steve', 'M', '+243845588652'),
('23KI08181329', 'KASONGO', 'ILUNGA', 'patient', 'M', '+243995956509'),
('23KS08055615', 'KASONGO', 'SAPWILA', 'deborah', 'M', '+243975858562'),
('23YM08074014', 'YAMBELA', 'MI-SONG', 'linda', 'M', '+243995956509');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `tAnneeIdAnnee` int(11) DEFAULT NULL,
  `tEleveMatricule` varchar(255) DEFAULT NULL,
  `tClasseIdClasse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`tAnneeIdAnnee`, `tEleveMatricule`, `tClasseIdClasse`) VALUES
(3, '20KK171', 2),
(3, '23KI08181329', 3),
(3, '23IM08181847', 3),
(3, '23KS08055615', 2),
(3, '23YM08074014', 4);

-- --------------------------------------------------------

--
-- Structure de la table `option`
--

CREATE TABLE `option` (
  `idOption` int(11) NOT NULL,
  `nomOption` varchar(244) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `option`
--

INSERT INTO `option` (`idOption`, `nomOption`) VALUES
(8, 'Electronique generale'),
(9, 'Mécanique automobile'),
(10, 'latin-philo');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `idPromotion` int(11) NOT NULL,
  `nomPromotion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`idPromotion`, `nomPromotion`) VALUES
(1, '1ère'),
(2, '2eme'),
(3, '3eme'),
(4, '4eme'),
(5, '7eme'),
(6, '8eme');

-- --------------------------------------------------------

--
-- Structure de la table `recu`
--

CREATE TABLE `recu` (
  `idRecu` int(11) NOT NULL,
  `sommeEnChiffre` int(11) DEFAULT NULL,
  `sommeEnLettre` varchar(255) DEFAULT NULL,
  `dateDuJour` date DEFAULT NULL,
  `tAnneeIdAnnee` int(11) DEFAULT NULL,
  `tEleveMatricule` varchar(255) DEFAULT NULL,
  `motif` text DEFAULT NULL,
  `mois` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recu`
--

INSERT INTO `recu` (`idRecu`, `sommeEnChiffre`, `sommeEnLettre`, `dateDuJour`, `tAnneeIdAnnee`, `tEleveMatricule`, `motif`, `mois`) VALUES
(1, 50, 'cinquante Dollars', '2023-08-25', 3, '20KK171', 'FRAIS MENSUEL', 'SEPTEMBRE'),
(2, 30, 'trente Dollars', '2023-08-25', 3, '20KK171', 'INSCRIPTION', NULL),
(3, 50, 'cinquante Dollars', '2023-08-25', 3, '23KI08181329', 'FRAIS MENSUEL', 'OCTOBRE'),
(4, 50, 'cinquante Dollars', '2023-08-26', 3, '23YM08074014', 'FRAIS MENSUEL', 'SEPTEMBRE');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$K07Qvs.hC8u8Yf7lZqty3.EyqQfNqnf0NgUjfXGG1CpRC8gsR8YK2', 'ADMINISTRATEUR'),
(2, 'caisse', '$2y$10$hEjeDvV7MPU1.51W0ZxycOUzsFxLwNtYEnQEag0WLEMe2poMH8Fmy', 'CAISSE');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annee`
--
ALTER TABLE `annee`
  ADD PRIMARY KEY (`idAnnee`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`idClasse`),
  ADD KEY `pc` (`tPromotionIdPromotion`),
  ADD KEY `oc` (`tOptionIdOption`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`matricule`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD KEY `tAnneeIdAnnee` (`tAnneeIdAnnee`),
  ADD KEY `tEleveMatricule` (`tEleveMatricule`),
  ADD KEY `tClasseIdClasse` (`tClasseIdClasse`);

--
-- Index pour la table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`idOption`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`idPromotion`);

--
-- Index pour la table `recu`
--
ALTER TABLE `recu`
  ADD PRIMARY KEY (`idRecu`),
  ADD KEY `tAnneeIdAnnee` (`tAnneeIdAnnee`),
  ADD KEY `tEleveMatricule` (`tEleveMatricule`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annee`
--
ALTER TABLE `annee`
  MODIFY `idAnnee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `idClasse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `option`
--
ALTER TABLE `option`
  MODIFY `idOption` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `idPromotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `recu`
--
ALTER TABLE `recu`
  MODIFY `idRecu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `oc` FOREIGN KEY (`tOptionIdOption`) REFERENCES `option` (`idOption`),
  ADD CONSTRAINT `pc` FOREIGN KEY (`tPromotionIdPromotion`) REFERENCES `promotion` (`idPromotion`);

--
-- Contraintes pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD CONSTRAINT `niveau_ibfk_1` FOREIGN KEY (`tAnneeIdAnnee`) REFERENCES `annee` (`idAnnee`),
  ADD CONSTRAINT `niveau_ibfk_2` FOREIGN KEY (`tEleveMatricule`) REFERENCES `eleve` (`matricule`),
  ADD CONSTRAINT `niveau_ibfk_3` FOREIGN KEY (`tClasseIdClasse`) REFERENCES `classe` (`idClasse`);

--
-- Contraintes pour la table `recu`
--
ALTER TABLE `recu`
  ADD CONSTRAINT `recu_ibfk_1` FOREIGN KEY (`tAnneeIdAnnee`) REFERENCES `annee` (`idAnnee`),
  ADD CONSTRAINT `recu_ibfk_2` FOREIGN KEY (`tEleveMatricule`) REFERENCES `eleve` (`matricule`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
