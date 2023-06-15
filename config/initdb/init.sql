-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database:3306
-- Généré le : mar. 13 juin 2023 à 20:37
-- Version du serveur : 11.0.2-MariaDB-1:11.0.2+maria~ubu2204
-- Version de PHP : 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `simplenote`
--

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `userI_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id`, `title`, `content`, `created_at`, `updated_at`, `userI_id`) VALUES
(15, 'test 01', 'Contenu de la note 01', '2023-03-11 12:55:56', '2023-03-11 12:55:56', 2),
(16, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque condimentum euismod. Duis posuere sapien vitae congue rhoncus. Donec ut hendrerit nunc. In suscipit venenatis mauris sed ultrices. Aenean placerat, metus vitae ullamcorper dapibus, nibh felis vehicula lectus, non tempor neque risus ut sapien. Nam et dui aliquet, fringilla libero nec, mollis libero. Mauris molestie enim a risus tempus, sit amet pellentesque urna cursus. Cras pellentesque metus a luctus consequat. Curabitur ac felis mi. Aenean imperdiet nec lorem et vestibulum. In eget ultrices lacus, ut cursus nibh. Donec quis neque at diam ullamcorper scelerisque eget et augue.\r\n\r\nDuis sem mi, tempor quis urna nec, dignissim congue tellus. Sed congue, justo et iaculis vulputate, mi ligula fermentum nisl, vitae vulputate orci turpis et sem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus id sapien sit amet quam cursus ultricies fermentum a magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut pharetra lacus in ligula eleifend vehicula. Phasellus ut vulputate tellus. Ut fringilla quam in felis fringilla, at porttitor dui efficitur. Etiam a congue dui, nec ullamcorper purus.', '2023-03-11 12:56:56', '2023-03-11 12:56:56', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(2, 'John', 'Legend', 'j.legend@example.com', '$2y$10$ym1EVvi1pHHbLXtBtBcpeutDmUgiPdWXzbOv3UICjbZDLnMzeK8qe');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_FK` (`userI_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_FK` FOREIGN KEY (`userI_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
