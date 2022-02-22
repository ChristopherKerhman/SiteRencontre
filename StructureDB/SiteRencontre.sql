-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 21 fév. 2022 à 10:34
-- Version du serveur :  8.0.28-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `SiteRencontre`
--

-- --------------------------------------------------------

--
-- Structure de la table `nav`
--

CREATE TABLE `nav` (
  `idNav` int NOT NULL,
  `nomLien` varchar(60) NOT NULL,
  `cheminNav` varchar(255) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `levelAdmi` tinyint NOT NULL,
  `ordre` tinyint NOT NULL,
  `centrale` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `nav`
--

INSERT INTO `nav` (`idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`, `ordre`, `centrale`) VALUES
(1, 'Inscription', 'formulaires/inscription.php', 1, 0, 0, 0),
(2, 'Présentation', 'environnement/corpsDeflaut.php', 1, 0, 2, 0),
(3, 'Admin Liens', 'administration/addLien.php', 1, 3, 1, 0),
(4, 'Connexion', 'formulaires/connexion.php', 1, 0, 2, 0),
(5, 'Index', 'environnement/corpsDeflaut.php', 1, 1, 1, 0),
(6, 'Deco', 'formulaires/deconnexion.php', 1, 1, 10, 0),
(7, 'Deco', 'formulaires/deconnexion.php', 1, 3, 10, 0),
(10, 'Admin Users', 'administration/user.php', 1, 3, 3, 0),
(11, 'Profil', 'formulaires/profil.php', 1, 1, 9, 0),
(14, 'Deco', 'formulaires/deconnexion.php', 1, 2, 10, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `login` varchar(60) NOT NULL,
  `mdp` varchar(80) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(60) NOT NULL,
  `genre` tinyint(1) NOT NULL,
  `photoProfil` varchar(100) NOT NULL DEFAULT '0',
  `token` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `nom`, `prenom`, `login`, `mdp`, `valide`, `role`, `email`, `genre`, `photoProfil`, `token`) VALUES
(14, 'Marais', 'Christophe', 'Utilisateur', '$2y$10$GwjApCKyN9SJTjkgUY0ryOYXfLYrRIAKAGj7iOlD4KaI3Nv7nK/Hm', 1, 1, '', 0, '0', ''),
(15, 'Calmes', 'Christophe', 'Admin', '$2y$10$4msnp68RxcZM0KnlqOiaiucj7bOV7Z0hco1d.akJdBPFOqbpenNk2', 1, 3, '', 0, '0', ''),
(16, 'Vanille', 'Clement', 'Moderateur', '$2y$10$3iJkRzGUWWY2oSosULIBY.dwXuqMRf/lu/AK/X4geCymmvE7A2naa', 1, 2, '', 0, '0', ''),
(43, 'Calmes', 'Christophe', 'User', '$2y$10$radzaQywmZVOCznn8EMMrums2mF7OlPmPCEqZx3pFKhH2tDRgbZz6', 1, 1, 'christophe.calmes2020@laposte.net', 1, '0', '0'),
(44, 'Calmes', 'Christophe', 'Gandalf', '$2y$10$aOzGBdOZ4Ag6xuW82i9tGu/j/5BGreSWwty9Fx2U57YMKdVZcsvuW', 1, 1, 'christophe.calmes2021@laposte.', 1, '0', '0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`idNav`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `nav`
--
ALTER TABLE `nav`
  MODIFY `idNav` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
