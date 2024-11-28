-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 28 nov. 2024 à 10:00
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `socialevent`
--

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_title` varchar(30) NOT NULL,
  `event_location` varchar(30) NOT NULL,
  `event_describe` text NOT NULL,
  `event_date_begin` date NOT NULL,
  `event_date_end` date NOT NULL,
  `event_duration` int NOT NULL,
  `event_type` varchar(30) NOT NULL,
  `event_number_place_available` int NOT NULL,
  `event_number_place_total` int NOT NULL,
  `event_number_place_remaining_` int NOT NULL,
  `event_stuff` varchar(100) NOT NULL,
  `event_image` varchar(100) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`event_id`, `event_title`, `event_location`, `event_describe`, `event_date_begin`, `event_date_end`, `event_duration`, `event_type`, `event_number_place_available`, `event_number_place_total`, `event_number_place_remaining_`, `event_stuff`, `event_image`, `user_id`) VALUES
(1, 'randonnée', '', 'gfhfgh', '2024-11-01', '2024-11-15', 14, 'type_event', 4, 4, 4, 'EZR', 'uploads/673641d3974f48.56695360.png', 0),
(2, 'Randonnée', '', 'J\'organise un évènement extraordinaire ! Une randonnée aux Alpes ! Venez nombreux Soutien et adrénaline à la clef ! ', '2024-11-09', '2024-11-23', 14, 'type_event', 4, 4, 4, 'Une gourde d\'eau et des chaussures', 'uploads/673645ce953bb8.87884960.jfif', 0),
(3, 'Anniversaire', '', 'Ma fille Gwanaelle organise son anniversaire ! Tous ses camarades de classe sont invités à nous rejoindre pour une journée de folie ( clown, jeux, et gâteaux à gogo !! ) ', '2024-11-28', '2024-11-28', 0, 'type_event', 20, 20, 20, 'de la bonne humeur !', 'uploads/6736486c44ad60.41349034.jfif', 0),
(4, 'Lecture', '', 'j\'organise une lecture dont le th-ème sera l\'informatique. ', '2024-11-28', '2024-11-28', 0, 'type_event', 6, 6, 6, 'Votre matériel informatique', 'uploads/67364e062b8454.55668867.png', 0),
(5, 'Anniversaire', '', 'Je vous convie à mon anniverssaire', '2024-11-27', '2024-11-27', 0, 'Anniversaire', 6, 6, 6, 'sdsdesd', 'uploads/673654810039b7.24028768.jfif', 0),
(6, 'Anniversaire', 'Clichy', 'un anniversaire comme les autres', '2024-11-19', '2024-11-19', 0, 'Anniversaire', 7, 7, 7, '', 'uploads/6746a486e9e177.15538610.jpeg', 0),
(7, 'Randonée', 'Clichy', 'sdfdsfsdfsdf', '2024-11-14', '2024-11-30', 16, 'Randonée', 4, 4, 4, '', 'uploads/6747f6b8b795e1.47555494.jfif', 0),
(8, 'Sport', 'PARIS', 'df gdfgdfgdfg', '2024-10-29', '2024-11-30', 32, 'Sport', 4, 4, 4, '', 'uploads/6747f6dd5b18e9.27236768.jfif', 0),
(9, 'Anniversaire', 'Clichy', 'test id', '2024-11-28', '2024-11-29', 1, 'Anniversaire', 4, 4, 4, '', 'uploads/67483acaaafb08.23791390.jpeg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `history_reservation`
--

DROP TABLE IF EXISTS `history_reservation`;
CREATE TABLE IF NOT EXISTS `history_reservation` (
  `history_reservation_id` int NOT NULL AUTO_INCREMENT,
  `reservation_id` int NOT NULL,
  `history_reservation_date` date NOT NULL,
  `history_reservation_status` varchar(30) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`history_reservation_id`),
  KEY `user_id` (`user_id`),
  KEY `reservation_id` (`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `file_name` varchar(50) NOT NULL,
  `file_path` int NOT NULL,
  `upload_date` date NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `reservation_id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_status` varchar(30) NOT NULL,
  `reservation_number_place` int NOT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `event_id`, `user_id`, `reservation_date`, `reservation_status`, `reservation_number_place`) VALUES
(1, 3, 5, '2024-11-27', 'Confirmée', 0),
(2, 3, 5, '2024-11-27', 'Confirmée', 0),
(3, 3, 5, '2024-11-27', 'Confirmée', 0),
(4, 3, 5, '2024-11-27', 'Confirmée', 0),
(5, 3, 5, '2024-11-27', 'Confirmée', 0),
(6, 3, 5, '2024-11-27', 'Confirmée', 0),
(7, 3, 5, '2024-11-27', 'Confirmée', 0),
(8, 6, 5, '2024-11-28', 'Confirmée', 0),
(9, 6, 5, '2024-11-28', 'Confirmée', 0),
(10, 6, 5, '2024-11-28', 'Confirmée', 0),
(11, 2, 5, '2024-11-28', 'Confirmée', 0),
(12, 6, 5, '2024-11-28', 'Confirmée', 0),
(13, 2, 5, '2024-11-28', 'Confirmée', 0),
(14, 1, 5, '2024-11-28', 'Confirmée', 0),
(15, 6, 5, '2024-11-28', 'Confirmée', 0),
(16, 6, 5, '2024-11-28', 'Confirmée', 0),
(17, 1, 5, '2024-11-28', 'Confirmée', 0),
(18, 9, 5, '2024-11-28', 'Confirmée', 0),
(19, 9, 5, '2024-11-28', 'Confirmée', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_lastname` varchar(30) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_birthdate` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_lastname`, `user_mail`, `user_password`, `user_birthdate`) VALUES
(5, 'El akrouche', 'mohamed', 'elakrouche@gmail.com', '$2y$10$Zb5/8CSeL.iUJDT5buv2seRIAWHCs0WkWzG31r5enpAQEBBKxj4GO', '2024-10-30');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `history_reservation`
--
ALTER TABLE `history_reservation`
  ADD CONSTRAINT `history_reservation_ibfk_1` FOREIGN KEY (`history_reservation_id`) REFERENCES `reservation` (`reservation_id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
