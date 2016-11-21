-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 21 Novembre 2016 à 14:18
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bac`
--

-- --------------------------------------------------------

--
-- Structure de la table `avatars`
--

CREATE TABLE `avatars` (
  `id_avatar` int(11) NOT NULL PRIMARY KEY,
  `url` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `avatars`
--

INSERT INTO `avatars` (`id_avatar`, `url`) VALUES
(1, '../img/users/marchalthibaut.gif');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom`) VALUES
(1, 'musique'),
(2, 'tutoriel'),
(3, 'chaine'),
(4, 'programmation');

-- --------------------------------------------------------

--
-- Structure de la table `favoris_videos`
--

CREATE TABLE `favoris_videos` (
  `id_video` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `favoris_videos`
--

INSERT INTO `favoris_videos` (`id_video`, `id_user`) VALUES
(13, 1),
(13, 1),
(13, 1),
(13, 1),
(13, 1),
(13, 1),
(13, 1),
(11, 0),
(11, 0);

-- --------------------------------------------------------

--
-- Structure de la table `likes_posts`
--

CREATE TABLE `likes_posts` (
  `id_like` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(10) NOT NULL,
  `users_id_user` int(10) UNSIGNED NOT NULL,
  `videos_id_video` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) UNSIGNED NOT NULL,
  `nom_role` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id_role`, `nom_role`) VALUES
(1, 'admin'),
(2, 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `roles_id_role` int(10) UNSIGNED NOT NULL,
  `avatars_id_avatar` int(11) DEFAULT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `date_ajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `roles_id_role`, `avatars_id_avatar`, `nom`, `prenom`, `pseudo`, `password`, `email`, `date_ajout`) VALUES
(1, 1, 1, 'marchal', 'thibaut', 'thibaut88', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'code.thibaut@gmail.com', '2016-11-20 21:52:45');

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE `videos` (
  `id_video` int(11) NOT NULL,
  `titre` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `url` text NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `posts_id_post` int(11) DEFAULT NULL,
  `vignette` text,
  `date_ajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categories_id_categorie` int(11) NOT NULL,
  `users_id_user` int(11) NOT NULL,
  `favoris_video_id_video` int(11) DEFAULT NULL,
  `en_ligne` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `videos`
--

INSERT INTO `videos` (`id_video`, `titre`, `description`, `url`, `auteur`, `posts_id_post`, `vignette`, `date_ajout`, `categories_id_categorie`, `users_id_user`, `favoris_video_id_video`, `en_ligne`) VALUES
(13, 'ajouter', 'Song: Citizen Erased\r\nAlbum: Origin Of Symmetry\r\nReleased: July 17, 2001', 'https://www.youtube.com/embed/_9lP1mQT7pM', 'Muse', NULL, 'https://i.ytimg.com/vi/j5cmn6eoUOk/hqdefault.jpg?custom=true&w=168&h=94&stc=true&jpg444=true&jpgq=90&sp=68&sigh=dSXmhdF_tykuDxUz1VVrdzxpA74', '2016-11-21 02:07:02', 1, 1, 0, 1),
(11, 'Muse - Stockholm Syndrome [Live From Wembley Stadium]', ' zaazdazdadaz', 'url', 'auteur', NULL, 'https://i.ytimg.com/vi/KwhjlNvF-4Q/hqdefault.jpg?custom=true&w=168&h=94&stc=true&jpg444=true&jpgq=90&sp=68&sigh=gizXkFJb2p-fT4ek-qBiwsqNbIc', '2016-11-21 01:21:58', 1, 1, 0, 0),
(12, 'ajouter', 'Song: Thoughts Of A Dying Atheist\r\nAlbum: Absolution (2004)\r\nArtist: Muse', 'https://www.youtube.com/embed/seNrC4_5Xxs', 'Muse', NULL, 'https://i.ytimg.com/vi/hucz0qsXEUQ/hqdefault.jpg?custom=true&w=168&h=94&stc=true&jpg444=true&jpgq=90&sp=68&sigh=VJOs125jiNqSFKQH2IXWV4G4_wc', '2016-11-21 01:51:46', 1, 1, 0, 1),
(8, 'ajouter', ' zzadza', 'https://www.youtube.com/embed/ZX-NwWMqWHs', 'FIGHT : Surface Pro 4 / iPad Pro', NULL, 'https://i.ytimg.com/vi/ZX-NwWMqWHs/hqdefault.jpg?custom=true&w=168&h=94&stc=true&jpg444=true&jpgq=90&sp=68&sigh=B8mLpbqrJ0AhdAQf6ql7oEf9wJg', '2016-11-21 01:04:55', 3, 1, 0, 0),
(9, 'ajouter', ' zadazdazdaz', 'https://www.youtube.com/embed/pzpGk44UXKQ', 'Muse', NULL, 'https://i.ytimg.com/vi/pzpGk44UXKQ/hqdefault.jpg?custom=true&w=168&h=94&stc=true&jpg444=true&jpgq=90&sp=68&sigh=L1O3mCUzQtq99qPQzW-AlRiwqoE', '2016-11-21 01:17:15', 1, 1, 0, 0),
(7, 'ajouter', ' ', 'https://www.youtube.com/embed/WBtW4cvtD_8', 'microsoft surface', NULL, 'https://i.ytimg.com/vi/KQ6dbt_6MiI/hqdefault.jpg?custom=true&w=168&h=94&stc=true&jpg444=true&jpgq=90&sp=68&sigh=v5wcm7hwY5XkL_Xmcwzc_vWTOW8', '2016-11-21 01:00:53', 3, 1, 0, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `avatars`
--
ALTER TABLE `avatars`
  ADD UNIQUE KEY `id_avatar` (`id_avatar`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `users_id_user` (`users_id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id_avatar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `videos`
--
ALTER TABLE `videos`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
