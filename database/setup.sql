-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 25 juin 2020 à 16:15
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `polly`
--

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(3, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departments`
--

INSERT INTO `departments` (`id`, `code`, `name`, `country_id`) VALUES
(1, 75, 'Paris', 3);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200618082830', '2020-06-18 10:28:46', 67),
('DoctrineMigrations\\Version20200618083021', '2020-06-18 10:30:25', 58),
('DoctrineMigrations\\Version20200618083237', '2020-06-18 10:32:42', 60),
('DoctrineMigrations\\Version20200618083438', '2020-06-18 10:34:42', 253),
('DoctrineMigrations\\Version20200618083642', '2020-06-18 10:36:46', 268),
('DoctrineMigrations\\Version20200618084054', '2020-06-18 10:41:01', 61),
('DoctrineMigrations\\Version20200618084328', '2020-06-18 10:43:38', 236),
('DoctrineMigrations\\Version20200618084606', '2020-06-18 10:46:10', 253),
('DoctrineMigrations\\Version20200618122045', '2020-06-18 14:20:48', 246),
('DoctrineMigrations\\Version20200618130555', '2020-06-18 15:05:59', 29),
('DoctrineMigrations\\Version20200618185258', '2020-06-18 20:53:04', 77),
('DoctrineMigrations\\Version20200618185412', '2020-06-18 20:54:16', 57),
('DoctrineMigrations\\Version20200618185505', '2020-06-18 20:55:10', 62),
('DoctrineMigrations\\Version20200618190201', '2020-06-18 21:02:03', 57),
('DoctrineMigrations\\Version20200618190646', '2020-06-18 21:06:49', 414),
('DoctrineMigrations\\Version20200618194102', '2020-06-18 21:41:05', 243),
('DoctrineMigrations\\Version20200618194615', '2020-06-18 21:46:18', 440),
('DoctrineMigrations\\Version20200618195035', '2020-06-18 21:50:46', 734),
('DoctrineMigrations\\Version20200618195208', '2020-06-18 21:52:11', 279),
('DoctrineMigrations\\Version20200619073228', '2020-06-19 09:32:32', 76),
('DoctrineMigrations\\Version20200619073410', '2020-06-19 09:34:13', 66),
('DoctrineMigrations\\Version20200619073446', '2020-06-19 09:34:50', 62),
('DoctrineMigrations\\Version20200619074516', '2020-06-19 09:45:19', 644),
('DoctrineMigrations\\Version20200619074744', '2020-06-19 09:47:47', 279),
('DoctrineMigrations\\Version20200619075032', '2020-06-19 09:50:35', 646),
('DoctrineMigrations\\Version20200622071947', '2020-06-22 09:19:52', 1627),
('DoctrineMigrations\\Version20200622072939', '2020-06-22 09:29:42', 37),
('DoctrineMigrations\\Version20200623150735', '2020-06-23 17:07:47', 39);

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `polls_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id`, `name`, `polls_id`) VALUES
(10, 'rgrg', 18),
(12, 'zdzdz', 24),
(13, 'zdzd', 24),
(19, 'efef', 25),
(20, 'ddgdg', 25),
(22, 'efef', 26),
(24, 'efef', 27),
(25, 'fefe', 28),
(26, 'egg', 29),
(27, 'egge', 29),
(28, 'yes', 30),
(29, 'No', 30),
(30, 'tgtgt', 32),
(31, 'tgtg', 32),
(32, 'thtth', 33),
(33, 'ht', 33),
(34, 'fdfdfdf', 34),
(35, 'dvdv', 35),
(36, 'dvdv', 35),
(37, 'jhjh', 36),
(38, 'jhhjj', 36),
(39, 'fefe', 37),
(40, 'effef', 38),
(41, 'fefef', 38),
(42, 'dvd', 39),
(43, 'fefe', 40),
(44, 'fefe', 41),
(45, 'csc', 42),
(46, 'yes', 43),
(47, 'No', 43);

-- --------------------------------------------------------

--
-- Structure de la table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hide` tinyint(1) NOT NULL,
  `author_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `polls`
--

INSERT INTO `polls` (`id`, `title`, `hide`, `author_id`, `country_id`, `date_creation`) VALUES
(18, 'ggrg', 0, 12, 3, '2020-06-24 19:20:16'),
(19, 'ssd', 0, 12, 3, '2020-06-24 19:46:25'),
(20, 'edd', 0, 12, 3, '2020-06-24 19:48:07'),
(21, 'hhuh', 0, 12, 3, '2020-06-24 22:27:21'),
(22, 'h', 0, 12, 3, '2020-06-24 23:02:03'),
(23, 'kn', 0, 12, 3, '2020-06-24 23:11:35'),
(24, 'ege', 0, 12, 3, '2020-06-25 09:17:54'),
(25, 'vdvdvdv', 0, 12, 3, '2020-06-25 09:33:10'),
(26, 'fefef', 0, 12, 3, '2020-06-25 09:59:59'),
(27, 'fefe', 0, 12, 3, '2020-06-25 10:13:15'),
(28, 'efefe', 0, 12, 3, '2020-06-25 10:16:32'),
(29, 'g', 0, 12, 3, '2020-06-25 10:18:00'),
(30, 'testing', 0, 12, 3, '2020-06-25 10:41:11'),
(31, 'hello world', 1, 12, 3, '2020-06-25 11:30:45'),
(32, 'hello world', 1, 12, 3, '2020-06-25 11:31:24'),
(33, 'jtjtj', 0, 12, 3, '2020-06-25 14:00:51'),
(34, 'ddfd', 0, 12, 3, '2020-06-25 14:53:01'),
(35, 'dvdvv', 0, 12, 3, '2020-06-25 15:17:16'),
(36, 'hjj', 0, 12, 3, '2020-06-25 15:17:48'),
(37, 'fefefe', 0, 12, 3, '2020-06-25 15:18:46'),
(38, 'jfiejf', 0, 12, 3, '2020-06-25 15:19:47'),
(39, 'ddvd', 0, 12, 3, '2020-06-25 15:22:44'),
(40, 'ffefe', 0, 12, 3, '2020-06-25 15:23:50'),
(41, 'efe', 0, 12, 3, '2020-06-25 15:33:25'),
(42, 'ec', 0, 14, 3, '2020-06-25 15:33:51'),
(43, 'hello', 0, 15, 3, '2020-06-25 15:54:27');

-- --------------------------------------------------------

--
-- Structure de la table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`) VALUES
(12, 'thomas-chastaingt@outlook.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$UkQuVzkwSHlHRW05SEprWg$Sszo3vI57bmn5S/ydfCZQOfFnDwOMSDRJ7R9Gy2lRHw', 1),
(14, 'thomas.chastaingt@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$S1diSGNKZ2M2SVAvZ2ttMw$LQUwk8I6uqenqiyzYuat5oBlg/jm1iq7hritHLtDmfQ', 0),
(15, 'tchastaingt@cci-paris-idf.fr', '[\"ROLE_VERIFIED\"]', '$argon2id$v=19$m=65536,t=4,p=1$M0l1SmloOWNMQnFRM1h2dA$iv3i9+EB+7z1nuZJAeVB5hhnKdmhvVNmvkHEroYJwN4', 1),
(16, 'zfzf@nf.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$dXhRRkgvUXZXYlRNOHMvUw$nfl2frfhLZ8ijiHyAKrccNGONkQGyRo7gZl7f5in64E', 0),
(17, 'effezfzf@nf.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$alZCTDc4M2ltMERwZXVCcA$uvP4FSDt8EOfXUNGVnmSPSvoi57n9x+z8CLwyTe/ZsA', 0),
(18, 'ggrgrgrgrg@grg.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$NGQ2RmtVRTd6TDZnT2ouNg$/uJmqyiCWGtzRHwG8IvVDesNIaKjReZpiqYpyoBnPmI', 0),
(19, 'ddvdv@ffs.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$SG9pa083dldXLzFMdHBESw$GegLTJj9AClAEjlGXI8DWsAX4RyrrJIGU1PShztCpOE', 0),
(20, 'dzdzd@zddz.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$MjRBZW1HRmpSbWl3YVcyTw$NCriZ1eSTsPPmE48Akr9jYzQtQkqf8vRCyhyC/1xSRs', 0),
(21, 'fefeefe@eff.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$YWo3d2pUTWtid1FqYXJHZA$7JpqShCwRq+onzpZ/hckMvC49Lv0OuiBMyLLa8lS0BQ', 0),
(22, 'sdddsds@dssdd.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$dk5uSDFEMFRxM1pUV3F0Uw$WpF6X9VBXyOtMzeEEkxpKCMkzss5U7cWcW2EmcHsZ0A', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_16AEB8D4F92F3E70` (`country_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D035FA8777F234C8` (`polls_id`);

--
-- Index pour la table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1D3CC6EEF675F31B` (`author_id`),
  ADD KEY `IDX_1D3CC6EEF92F3E70` (`country_id`);

--
-- Index pour la table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AC854B393C947C0F` (`poll_id`),
  ADD KEY `IDX_AC854B39A7C41D6F` (`option_id`),
  ADD KEY `IDX_AC854B39AE80F5DF` (`department_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `FK_16AEB8D4D8A48BBD` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Contraintes pour la table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `FK_D035FA8777F234C8` FOREIGN KEY (`polls_id`) REFERENCES `polls` (`id`);

--
-- Contraintes pour la table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `FK_1D3CC6EE69CCBE9A` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_1D3CC6EED8A48BBD` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Contraintes pour la table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD CONSTRAINT `FK_AC854B3919F5E396` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`),
  ADD CONSTRAINT `FK_AC854B3946AF233F` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`),
  ADD CONSTRAINT `FK_AC854B3964E7214B` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
