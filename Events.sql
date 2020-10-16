-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 12 oct. 2020 à 15:01
-- Version du serveur :  10.4.12-MariaDB-1:10.4.12+maria~stretch
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Webot`
--

-- --------------------------------------------------------

--
-- Structure de la table `Events`
--

CREATE TABLE `Events` (
  `event_id` int(11) NOT NULL,
  `event_subject` varchar(100) NOT NULL,
  `event_startDate` varchar(25) NOT NULL,
  `event_startTime` datetime(6) NOT NULL,
  `event_endTime` datetime(6) NOT NULL,
  `event_allDay` tinyint(1) NOT NULL,
  `event_desc` varchar(255) NOT NULL,
  `event_loc` varchar(50) NOT NULL,
  `_user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`event_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Events`
--
ALTER TABLE `Events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
