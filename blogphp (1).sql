-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 avr. 2023 à 20:10
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
-- Base de données : `blogphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentarys`
--

DROP TABLE IF EXISTS `commentarys`;
CREATE TABLE IF NOT EXISTS `commentarys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `refused_at` datetime DEFAULT NULL,
  `status` char(25) NOT NULL DEFAULT 'submission',
  PRIMARY KEY (`id`),
  KEY `commentary_users_id` (`users_id`),
  KEY `commentary_posts_id` (`posts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentarys`
--

INSERT INTO `commentarys` (`id`, `users_id`, `posts_id`, `content`, `created_at`, `refused_at`, `status`) VALUES
(1, 1, 1, 'Je suis le commentaire du Post 1', '2023-03-14 23:00:00', '2023-03-24 00:00:00', 'refused'),
(2, 2, 1, 'Je suis le commentaire du Post 1', '2023-03-15 23:00:00', NULL, 'validate'),
(3, 3, 2, 'Je suis le commentaire du Post 2', '2023-03-13 23:00:00', NULL, 'validate'),
(4, 4, 2, 'Je suis le commentaire du Post 2', '2023-03-12 23:00:00', '2023-03-27 00:00:00', 'refused'),
(5, 5, 3, 'Je suis le commentaire du Post 3', '2023-03-11 23:00:00', NULL, 'validate'),
(6, 6, 3, 'Je suis le commentaire du Post 3', '2023-03-01 23:00:00', '2023-03-27 00:00:00', 'refused'),
(7, 7, 4, 'Je suis le commentaire du Post 4', '2023-02-19 23:00:00', NULL, 'validate'),
(8, 8, 4, 'Je suis le commentaire du Post 4', '2023-02-07 23:00:00', NULL, 'refused'),
(9, 9, 5, 'Je suis le commentaire du Post 5', '2023-03-05 23:00:00', '2023-03-23 17:58:57', 'refused'),
(10, 10, 5, 'Je suis le commentaire du Post 5', '2023-03-08 23:00:00', NULL, 'validate'),
(11, 1, 6, 'Je suis le commentaire du Post 6', '2023-03-08 23:00:00', NULL, 'validate'),
(12, 2, 6, 'Je suis le commentaire du Post 6', '2023-03-05 23:00:00', NULL, 'refused'),
(13, 3, 7, 'Je suis le commentaire du Post 7', '2023-03-12 23:00:00', NULL, 'validate'),
(14, 4, 7, 'Je suis le commentaire du Post 7', '2023-03-12 23:00:00', NULL, 'validate'),
(15, 5, 8, 'Je suis le commentaire du Post 8', '2023-01-12 23:00:00', NULL, 'validate'),
(16, 6, 8, 'Je suis le commentaire du Post 8', '2023-02-15 23:00:00', '2023-03-24 00:00:00', 'refused'),
(17, 7, 9, 'Je suis le commentaire du Post 9', '2023-03-12 23:00:00', NULL, 'refused'),
(18, 8, 9, 'Je suis le commentaire du Post 9', '2023-03-12 23:00:00', NULL, 'refused'),
(19, 9, 10, 'Je suis le commentaire du Post 10', '2023-03-12 23:00:00', NULL, 'refused'),
(20, 10, 10, 'Je suis le commentaire du Post 10', '2023-03-12 23:00:00', '2023-03-24 00:00:00', 'refused'),
(34, 30, 238, 'Je suis un commentaire test', '2023-04-25 22:00:00', NULL, 'validate'),
(41, 11, 238, 'Test de decroissant', '2023-04-26 22:00:00', NULL, 'validate');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FKUsersPost` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `users_id`, `title`, `subtitle`, `author`, `content`, `created_at`) VALUES
(1, 11, 'TITRE 1', 'SOUS TITRE 1', 'Actarus', 'Je suis le contenu du post 1', '2022-10-03 00:00:00'),
(2, 11, 'TITRE 2', 'SOUS TITRE 2', 'Actarus', 'Je suis le contenu du post 2', '2022-03-12 00:00:00'),
(3, 11, 'TITRE 3 ', 'SOUS TITRE 3', 'Actarus', 'Je suis le contenu du post 3', '2022-03-13 00:00:00'),
(4, 11, 'TITRE 4', 'SOUS TITRE 4', 'Actarus', 'Je suis le contenu du post 4', '2022-03-14 00:00:00'),
(5, 11, 'TITRE 5', 'SOUS TITRE 5', 'Actarus', 'Je suis le contenu du post 5', '2022-03-15 00:00:00'),
(6, 11, 'TITRE 6', 'SOUS TITRE 6', 'Actarus', 'Je suis le contenu du post 6', '2022-03-16 00:00:00'),
(7, 11, 'TITRE 7', 'SOUS TITRE 7', 'Actarus', 'Je suis le contenu du post 7', '2022-03-12 00:00:00'),
(8, 11, 'TITRE 8', 'SOUS TITRE 8', 'Actarus', 'Je suis le contenu du post 8', '2022-03-17 00:00:00'),
(9, 11, 'TITRE 9', 'SOUS TITRE 9', 'Actarus', 'Je suis le contenu du post 9', '2022-03-18 00:00:00'),
(10, 11, 'TITRE 10', 'SOUS TITRE 10', 'Actarus', 'Je suis le contenu du post 10', '2022-03-19 00:00:00'),
(238, 11, 'TEST SOUTENANCE', 'VERIFICATION DE LA CREATION', 'Actarus', 'JE SUIS LE RESULTAT DE LA CREATION ', '2023-04-07 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `surname`, `name`, `pseudo`, `birth_date`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Henriette', 'Lemoine', 'Moccasin', '1979-05-02', 'francois.cecile@sfr.fr', '123456', 'user', '1980-05-10 00:00:00'),
(2, 'Anastasie', 'Adam', 'OrangeRed', '1986-01-08', 'hguibert@lejeune.fr', '123456', 'user', '2012-12-08 00:00:00'),
(3, 'Susan', 'Perrin', 'MediumPurple', '1978-01-24', 'fbarbier@meyer.com', '123456', 'user', '1983-08-10 00:00:00'),
(4, 'Agathe', 'Auger', 'White', '1977-11-11', 'langlois.bernard@noos.fr', '123456', 'user', '1985-10-26 00:00:00'),
(5, 'Agathe', 'Faivre', 'DarkViolet', '1989-06-02', 'ojoubert@lagarde.com', '123456', 'user', '1982-02-22 00:00:00'),
(6, 'Joséphine', 'Levy', 'HotPink', '1980-09-09', 'carpentier.theophile@gmail.com', '123456', 'user', '1995-11-20 00:00:00'),
(7, 'Alexandria', 'Techer', 'IndianRed', '1980-07-23', 'ylecoq@simon.com', '123456', 'user', '2005-10-13 00:00:00'),
(8, 'Aurélie', 'Vaillant', 'MediumPurple', '1994-06-15', 'stephanie.denis@gomez.org', '123456', 'user', '1994-08-27 00:00:00'),
(9, 'Paulette', 'Traore', 'DarkKhaki', '1986-09-17', 'julie.marchal@brunet.fr', '123456', 'user', '1992-04-02 00:00:00'),
(10, 'Anne', 'Joseph', 'MediumPurple', '1980-06-12', 'martin13@carpentier.fr', '123456', 'user', '2004-01-21 00:00:00'),
(11, 'Riso', 'Nicolas', 'Actarus', '1981-08-30', 'Admin@admin.com', 'admin', 'admin', '1973-03-01 00:00:00'),
(26, 'userRole', 'role', 'USER', '2023-03-04', 'role-User@gmail.com', '123456', 'user', '2023-03-14 00:00:00'),
(30, 'Riso', 'Nico', 'Nicolabs', '1981-08-30', 'Nico@gmail.com', '123456', 'user', '2023-04-26 00:00:00');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentarys`
--
ALTER TABLE `commentarys`
  ADD CONSTRAINT `commentary_posts_id` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `commentarys_users_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FKUsersPost` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
