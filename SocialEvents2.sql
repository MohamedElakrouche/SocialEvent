-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 15 nov. 2024 à 15:26
-- Version du serveur : 8.0.35
-- Version de PHP : 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `SocialEvents`
--

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `event_id` int NOT NULL,
  `event_title` varchar(30) NOT NULL,
  `event_describe` text NOT NULL,
  `event_date_begin` date NOT NULL,
  `event_date_end` date NOT NULL,
  `event_duration` int NOT NULL,
  `event_type` varchar(30) NOT NULL,
  `event_number_place_available` int NOT NULL,
  `event_number_place_total` int NOT NULL,
  `event_number_place_remaining_` int NOT NULL,
  `event_stuff` varchar(100) NOT NULL,
  `event_image` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`event_id`, `event_title`, `event_describe`, `event_date_begin`, `event_date_end`, `event_duration`, `event_type`, `event_number_place_available`, `event_number_place_total`, `event_number_place_remaining_`, `event_stuff`, `event_image`) VALUES
(1, 'Sport', 'sport de fou', '2024-12-01', '2024-11-22', -9, 'Sport', 6, 6, 6, '', 'uploads/67372427c20195.37434029.jpeg'),
(2, 'Randonée', 'bljazbdjksnfjkdsnf', '2024-11-06', '2024-11-23', 17, 'Randonée', 8, 8, 8, 'non', 'uploads/67372470220333.73980002.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `history_reservation`
--

CREATE TABLE `history_reservation` (
  `history_reservation_id` int NOT NULL,
  `reservation_id` int NOT NULL,
  `history_reservation_date` date NOT NULL,
  `history_reservation_status` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_status` varchar(30) NOT NULL,
  `reservation_number_place` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_lastname` varchar(30) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_password` int NOT NULL
  'user_birthdate ' date YES NULL);
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Index pour la table `history_reservation`
--
ALTER TABLE `history_reservation`
  ADD PRIMARY KEY (`history_reservation_id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `history_reservation`
--
ALTER TABLE `history_reservation`
  MODIFY `history_reservation_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
