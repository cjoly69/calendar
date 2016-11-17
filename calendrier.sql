-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 17 Novembre 2016 à 12:00
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `calendrier`
--

-- --------------------------------------------------------

--
-- Structure de la table `saisie`
--

CREATE TABLE `saisie` (
  `idcrea` int(255) NOT NULL,
  `titre` varchar(500) NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `saisie`
--

INSERT INTO `saisie` (`idcrea`, `titre`, `debut`, `fin`, `mail`) VALUES
(1, 'Salon du numérique', '2016-11-03', '2016-11-06', 'toto@gmail.com'),
(2, 'RJDay', '2016-11-18', '2016-11-18', 'cijoly@gmail.com'),
(3, 'Accueil Simplon', '2016-07-04', '2016-07-15', 'toto@gmail.com');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `saisie`
--
ALTER TABLE `saisie`
  ADD PRIMARY KEY (`idcrea`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `saisie`
--
ALTER TABLE `saisie`
  MODIFY `idcrea` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
