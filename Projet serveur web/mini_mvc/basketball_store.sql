-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 03 jan. 2026 à 14:46
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `basketball_store`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(13, 'Chaussures de basket'),
(14, 'Ballons de basket'),
(15, 'Vêtements'),
(16, 'Accessoires');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_best_seller` tinyint(1) NOT NULL DEFAULT 0,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `is_best_seller`, `category_id`) VALUES
(26, 'Nike Air Zoom Freak 4', 150.00, 'Chaussure de basket légère et performante conçue pour les joueurs explosifs et rapides. Amorti réactif et maintien optimal pour les changements de direction rapides.', '6958783e6f3be.jpg', 1, 13),
(27, 'Adidas Harden Vol. 8', 140.00, 'Chaussure signature de James Harden, offrant un excellent équilibre entre confort et performance. Semelle intermédiaire innovante pour un rebond et une réactivité exceptionnels.', '69587804cf097.jpg', 0, 13),
(28, 'Jordan Why Not Zer0.5', 160.00, 'Chaussure de Russell Westbrook qui combine style et technologie. Idéale pour les joueurs qui aiment attaquer le panier et sauter haut.', '695877ca337c1.webp', 1, 13),
(29, 'Under Armour Curry Flow 9', 145.00, 'Chaussure signature de Stephen Curry, légère et stable, conçue pour les tirs à longue distance et les mouvements rapides sur le terrain.', '695877a636afd.webp', 0, 13),
(30, 'Spalding NBA Official Game Ball', 60.00, 'Ballon officiel utilisé dans tous les matchs NBA. Fabriqué en cuir haute qualité pour un toucher parfait et une excellente durabilité.', '6958775886b6c.jpg', 1, 14),
(31, 'Wilson Evolution Indoor/Outdoor', 50.00, 'Ballon polyvalent pour intérieur et extérieur. Surface douce pour un contrôle optimal, parfait pour l’entraînement et les matchs amicaux.', '6958773064442.jpg', 0, 14),
(32, 'Molten BG5000', 55.00, 'Ballon officiel FIBA pour la compétition internationale. Offrant une grande adhérence et une excellente précision dans tous les tirs.', '695877050cb22.jpg', 0, 14),
(33, 'Nike Elite Championship', 65.00, 'Ballon de performance conçu pour les compétitions locales et régionales. Résistant et avec un excellent rebond.', '695876e11d211.jpg', 1, 14),
(34, 'Maillot Los Angeles Lakers LeBron James', 100.00, 'Maillot officiel NBA de LeBron James, respirant et léger, parfait pour jouer ou supporter votre équipe favorite. Design authentique et durable.', '695876b138d15.jpg', 1, 15),
(35, 'Short de basket Under Armour Tech', 35.00, 'Short de basket confortable, respirant et flexible. Idéal pour l’entraînement ou les matchs, avec un tissu qui évacue la transpiration.', '6958768bd7533.jpg', 0, 15),
(36, 'Hoodie Chicago Bulls NBA', 60.00, 'Sweat à capuche officiel Chicago Bulls, chaud et confortable. Matière de qualité supérieure pour supporter vos sessions d’entraînement et vos sorties.', '6958763d43aa5.jpg', 0, 15),
(37, 'Débardeur Jordan Jumpman', 40.00, 'Débardeur léger et respirant signé Michael Jordan. Idéal pour le sport ou un style casual, avec un tissu qui sèche rapidement.', '695875f74690e.jpg', 0, 15),
(38, 'Chaussettes de compression Nike Elite', 15.00, 'Chaussettes de compression conçues pour améliorer la circulation sanguine et le confort durant les matchs. Maintien optimal du pied et de la cheville.', '695875cb292e3.jpg', 0, 16),
(39, 'Bandeaux et poignets Jordan', 20.00, 'Bandeaux et poignets absorbants pour garder vos mains et votre front secs pendant l’effort. Design élégant et confortable.', '6958754ae7cce.jpg', 0, 16),
(40, 'Sac à dos de sport Adidas', 45.00, 'Sac à dos spacieux pour transporter vos chaussures, vêtements et accessoires de sport. Compartiments séparés et tissu résistant à l’eau.', '695874f8cc065.webp', 0, 16),
(41, 'Protège-dents Shock Doctor', 10.00, 'Protège-dents conçu pour protéger vos dents lors des matchs et entraînements. Ajustement confortable et matériau durable.', '695874b4daa12.webp', 0, 16);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'toto', 'toto@test.com', 'test', 0),
(2, 'Drif', 'drif8907@gmail.com', '$2y$10$xQC3i5i8FbpC4L7iVnFhOOsbMOvStvI3Kc5/Gmv0VUnqRQ1xbjFu6', 1),
(3, 'sassi', 'sassi@gmail.com', '$2y$10$Wf027fhKhXu/34QBlsQe8evSVa.U6AN5HHE3cVFwnLNYDTd2nelca', 0),
(4, 'emmy', 'emmy@gmail.com', '$2y$10$6de844YaAdVAX7NJja0x7e6ZI9419ty3OxquCb.nrLkDqvAn6QOWu', 0),
(5, 'tkt', 'yanis.drif@efrei.net', '$2y$10$sRbd5Cyx0yr.cSS3XPvv6ubUPPOZxly8VLdG4d4wt2CPls/EXeL7K', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_category` (`category_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
