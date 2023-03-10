-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 10 mars 2023 à 06:44
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `recipt`
--

DROP TABLE IF EXISTS `recipt`;
CREATE TABLE IF NOT EXISTS `recipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `niveau` varchar(20) NOT NULL,
  `budget` varchar(20) NOT NULL,
  `temps` time NOT NULL,
  `ingredients` text NOT NULL,
  `preparation` text NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recipt`
--

INSERT INTO `recipt` (`id`, `title`, `categorie`, `niveau`, `budget`, `temps`, `ingredients`, `preparation`, `photo`) VALUES
(27, 'Maquereaux aux oignon', 'plats', 'facile', 'abordable', '00:00:00', 'Ici les ingrédients pour le maquereau', 'Et ici la préparation pour les maquereaux', '167752595142231304018315327.png'),
(28, 'test recette sans s', 'entrees', 'facile', 'abordable', '00:12:00', 'ingredients pour Test', 'preparation pour Test', '167773989210950963641285013545.jpg'),
(31, 'Test recette', 'entrees', 'facile', 'abordable', '04:44:00', 'Ingredienr', 'xsdsxdsq', '16781235703003605581554927488.webp');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
