-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : sam. 11 mars 2023 à 12:57
-- Version du serveur : 10.11.2-MariaDB-1:10.11.2+maria~ubu2204
-- Version de PHP : 8.1.16

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
  `noteID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `creationDATE` datetime NOT NULL,
  `lastUpdateDATE` datetime NOT NULL,
  `content` longtext DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`noteID`, `userID`, `creationDATE`, `lastUpdateDATE`, `content`, `title`) VALUES
(15, 2, '2023-03-11 12:55:56', '2023-03-11 12:55:56', 'Contenu de la note 01', 'test 01'),
(16, 2, '2023-03-11 12:56:56', '2023-03-11 12:56:56', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque condimentum euismod. Duis posuere sapien vitae congue rhoncus. Donec ut hendrerit nunc. In suscipit venenatis mauris sed ultrices. Aenean placerat, metus vitae ullamcorper dapibus, nibh felis vehicula lectus, non tempor neque risus ut sapien. Nam et dui aliquet, fringilla libero nec, mollis libero. Mauris molestie enim a risus tempus, sit amet pellentesque urna cursus. Cras pellentesque metus a luctus consequat. Curabitur ac felis mi. Aenean imperdiet nec lorem et vestibulum. In eget ultrices lacus, ut cursus nibh. Donec quis neque at diam ullamcorper scelerisque eget et augue.\r\n\r\nDuis sem mi, tempor quis urna nec, dignissim congue tellus. Sed congue, justo et iaculis vulputate, mi ligula fermentum nisl, vitae vulputate orci turpis et sem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus id sapien sit amet quam cursus ultricies fermentum a magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut pharetra lacus in ligula eleifend vehicula. Phasellus ut vulputate tellus. Ut fringilla quam in felis fringilla, at porttitor dui efficitur. Etiam a congue dui, nec ullamcorper purus.', 'Lorem ipsum');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`userID`, `firstName`, `lastName`, `email`, `password`) VALUES
(2, 'John', 'Legend', 'j.legend@example.com', '$2y$10$ym1EVvi1pHHbLXtBtBcpeutDmUgiPdWXzbOv3UICjbZDLnMzeK8qe');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`noteID`),
  ADD KEY `notes_FK` (`userID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `noteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_FK` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
