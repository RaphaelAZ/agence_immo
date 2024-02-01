-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 01 fév. 2024 à 15:21
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agence_immo`
--

-- --------------------------------------------------------

--
-- Structure de la table `announce`
--

DROP TABLE IF EXISTS `announce`;
CREATE TABLE IF NOT EXISTS `announce` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `surface` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `announce`
--

INSERT INTO `announce` (`id`, `title`, `price`, `surface`, `type`, `location`, `description`, `image`, `creation`) VALUES
(2, 'Appartement spacieux', 159000, 80, 'Appartement', 'Lille', 'Joli petit appartement avec beaucoup de lumière, coin tranquille bien isolé, avec voisinage très aimable.', '7085f912acf6228797b667fa9f7344f9.jpg', '2024-01-26 10:13:45'),
(3, 'Maison Familiale', 180000, 140, 'Maison', 'Avignon', 'Jolie maison familiale de 1980, refaite à neuf récemment hormis la devanture de la maison.', 'ddf5e0fb2667a2f4cfa139652c8e43ab.jpg', '2024-01-26 10:13:54'),
(4, 'Studio 4 personnes', 96000, 40, 'Maison', 'Lille, Villeneuve d\'Ascq', 'Studio bien situé, proche des transports bien isolé et climatisé', '61047cdacdfb46f40b112aeddb00f5e8.jpg', '2024-01-26 10:14:03'),
(14, 'Jolie Villa', 333333, 230, 'Maison', 'Nice, Bord de mer', 'Jolie Villa accès plage', '07d55099c04242e46d7e405ef105495e.jpg', '2024-02-01 09:21:42');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240103181847', '2024-01-19 09:47:26', 120),
('DoctrineMigrations\\Version20240103182311', '2024-01-19 09:47:26', 14),
('DoctrineMigrations\\Version20240119094646', '2024-01-19 09:47:26', 18),
('DoctrineMigrations\\Version20240119095631', '2024-01-19 09:56:41', 43),
('DoctrineMigrations\\Version20240123152116', '2024-01-23 15:21:29', 91),
('DoctrineMigrations\\Version20240124090152', '2024-01-24 09:02:02', 97),
('DoctrineMigrations\\Version20240125110918', '2024-01-25 11:10:36', 96),
('DoctrineMigrations\\Version20240126074156', '2024-01-26 07:42:38', 72),
('DoctrineMigrations\\Version20240126105846', '2024-01-26 10:59:28', 337),
('DoctrineMigrations\\Version20240201142210', '2024-02-01 14:22:25', 451),
('DoctrineMigrations\\Version20240201142527', '2024-02-01 14:25:33', 30),
('DoctrineMigrations\\Version20240201150054', '2024-02-01 15:01:02', 29);

-- --------------------------------------------------------

--
-- Structure de la table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
CREATE TABLE IF NOT EXISTS `favorite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `announce_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `date_favorite` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_68C58ED96F5DA3DE` (`announce_id`),
  KEY `IDX_68C58ED9A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pending_contact`
--

DROP TABLE IF EXISTS `pending_contact`;
CREATE TABLE IF NOT EXISTS `pending_contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `announce_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `date_contact` date NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pending` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_870D11A96F5DA3DE` (`announce_id`),
  KEY `IDX_870D11A9A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pending_contact`
--

INSERT INTO `pending_contact` (`id`, `announce_id`, `user_id`, `date_contact`, `phone`, `email`, `name`, `pending`) VALUES
(1, 4, 1, '2024-02-01', '0659781248', 'michel@gmail.fr', 'Michel Dupont', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`, `phone`) VALUES
(1, 'Raph', '[\"ROLE_SUPER_ADMIN\"]', '$2y$13$o4ukWk6XphNZbtqg1Gt8uOD.fLmnVbvHBs3C0C/XgcCxPPILi3fH6', 'raph@gmail.com', '0678485815'),
(3, 'Rapha', '[\"ROLE_USER\"]', '$2y$13$WmpDEhKOFL/HtVSfhNSVyuKZqLT7jsjTH4quI3dc/Y663Xrt.4vzu', 'raph@gmail.com', '0678485815');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `FK_68C58ED96F5DA3DE` FOREIGN KEY (`announce_id`) REFERENCES `announce` (`id`),
  ADD CONSTRAINT `FK_68C58ED9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `pending_contact`
--
ALTER TABLE `pending_contact`
  ADD CONSTRAINT `FK_870D11A96F5DA3DE` FOREIGN KEY (`announce_id`) REFERENCES `announce` (`id`),
  ADD CONSTRAINT `FK_870D11A9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
