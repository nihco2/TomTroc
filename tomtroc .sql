-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 11 mars 2026 à 18:44
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `author` varchar(120) NOT NULL,
  `title` varchar(120) NOT NULL,
  `username` varchar(120) NOT NULL,
  `img` varchar(120) NOT NULL,
  `created_at` date NOT NULL,
  `description` text NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `author`, `title`, `username`, `img`, `created_at`, `description`, `is_available`, `user_id`) VALUES
(1, 'Alabaster', 'Esther', 'CamilleClubLit', 'book1', '2026-01-26', '', 0, 2),
(2, 'Nathan Williams', 'The Kinfolk Table', 'Nathalire', 'book2', '2026-01-19', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. \r\n\r\nLes photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. \r\n\r\nChaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \r\n\r\n\'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 1, 2),
(3, 'Beth Kempton', 'dqsccq', 'Alexlecture', 'book3', '2026-01-02', '', 0, 5),
(4, 'Rupi Kaur', 'Milk & honey', 'Hugo1990_12', 'book4', '2026-01-23', '', 0, 5),
(5, 'Justin Rossow', '', 'Juju1432', 'book5', '2026-01-14', '', 1, 2),
(6, 'Elder Cooper Low', 'Milwaukee Mission', 'Christiane75014', 'book6', '2026-01-28', '', 0, 5),
(7, 'Julia Schonlau', 'Minimalist Graphics', 'Hamzalecture', 'book7', '2026-01-21', '', 0, 3),
(8, 'Meik Wiking', 'Hygge', 'Hugo1990_12', 'book8', '2026-01-21', '', 0, 3),
(9, 'Matt Ridley', 'Innovation', 'Lou&Ben50', 'book9', '2026-01-21', '', 0, 2),
(10, 'Alabaster', 'Psalms', 'Lolobzh', 'book10', '2026-01-22', '', 0, 4),
(11, 'Daniel Kahneman', 'Thinking, Fast & Slow', 'Sas634', 'book11', '2026-01-27', '', 0, 4),
(12, 'Rupi Kaur', 'A Book Full Of Hope', 'ML95', 'book12', '2026-01-07', '', 0, 5),
(13, 'Mark Manson', 'The Subtle Art Of...', 'Verogo33', 'book13', '2026-01-16', '', 0, 6),
(14, 'C.S Lewis', 'Narnia', 'AnnikaBrahms', 'book14', '2026-01-22', '', 0, 6),
(15, 'Paul Jarvis', 'Company Of One', 'Victoirefabr912', 'book15', '2026-01-16', '', 0, 6),
(16, 'J.R.R Tolkien', 'The Two Towers', 'Lotrfanclub67', 'book16', '2026-01-03', '', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `creation_date`, `user_id`, `receiver_id`) VALUES
(19, '2026-02-06 00:00:00', 99, 4),
(21, '2026-02-07 00:00:00', 5, 3),
(22, '2026-02-11 18:47:27', 4, 5),
(23, '2026-02-12 12:31:49', 4, 3),
(25, '2026-03-05 13:13:35', 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT current_timestamp(),
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `content`, `sent_at`, `conversation_id`, `sender_id`, `is_read`) VALUES
(28, 'test mes', '2026-02-06 21:38:32', 19, 2, 0),
(29, 'coucou', '2026-02-06 21:38:39', 19, 2, 0),
(30, 'dscvdsv', '2026-02-06 21:45:39', 19, 4, 1),
(31, 'Salut Emilien, je suis test messagerie 3', '2026-02-06 21:47:58', 20, 5, 0),
(32, 'hello messagerie 3', '2026-02-06 21:48:28', 20, 2, 1),
(33, 'hello', '2026-02-07 18:48:04', 21, 5, 0),
(34, 'morhzebqvmoberù', '2026-02-07 21:46:24', 21, 5, 0),
(35, 'coucou', '2026-02-11 18:33:14', 20, 2, 1),
(36, 'hello', '2026-02-11 18:33:26', 20, 2, 1),
(37, 'test', '2026-02-11 18:34:05', 19, 4, 1),
(38, 'coucou', '2026-02-11 18:35:18', 18, 3, 0),
(39, 'coucou', '2026-02-11 18:35:29', 18, 3, 0),
(40, 'coucou', '2026-02-11 18:35:47', 18, 3, 0),
(41, 'hello', '2026-02-11 18:38:52', 19, 2, 1),
(42, 'hello test messagerie 3', '2026-02-11 18:47:42', 22, 4, 1),
(43, 'Hello', '2026-02-12 12:31:55', 23, 4, 1),
(44, 'hello', '2026-02-17 12:40:10', 24, 3, 1),
(45, 'toto', '2026-02-17 12:42:45', 24, 2, 1),
(46, 'Hello Emilien', '2026-03-05 13:13:42', 25, 5, 1),
(47, 'coucou !!!', '2026-03-05 13:14:02', 25, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(2, 'Emilien', 'blog@blog.de', '$2y$10$wA.ofh3HSnQLOid7YaPPceyGNgAOdy5p2HzSunWouScAW3Rpb18gu', '2026-01-01'),
(3, 'Test messagerie', 'test@test.fr', '$2y$10$3Q2vp/KX6/6Nef8x3TsjveCAOp2N0UmSqp498PdjhER4i5nTXcP6K', '2026-02-03'),
(4, 'Test messagerie 2', 'test@messagerie.fr', '$2y$10$VAXWQqLpDA5NRtKy7o/C1ONxAAZlrgtWes8f33sBiJv59Crur8k4i', '2026-02-04'),
(5, 'test messagerie 4', 'test@messagerie.de', '$2y$10$1ryVxXW/ie.wg60tuyxrq.bf7A7bm3r19IBxy4KwDLuKeFMGbS7mi', '2026-02-06'),
(6, 'toto', 'toto@toto.fr', '$2y$10$CsX2fyCg8vRbZzDm5Zu0.OnFT2Vyx6b9rqxEMHP0uzrkynrr6r3He', '2026-02-10');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
