CREATE TABLE `avatars` (
	`id_avatar` int(11) NOT NULL,
	`url` TEXT NOT NULL,
	PRIMARY KEY (`id_avatar`)
);

CREATE TABLE `categories` (
	`id_categorie` int NOT NULL,
	`nom` varchar(30) NOT NULL,
	PRIMARY KEY (`id_categorie`)
);

CREATE TABLE `favoris_videos` (
	`id_video` int NOT NULL,
	`id_user` int NOT NULL,
	PRIMARY KEY (`id_video`)
);

CREATE TABLE `likes_posts` (
	`id_like` int NOT NULL,
	`id_user` int NOT NULL,
	PRIMARY KEY (`id_like`)
);

CREATE TABLE `posts` (
	`id_post` int NOT NULL,
	`users_id_user` int(11) NOT NULL,
	`videos_id_video` int(11) NOT NULL,
	`description` longtext NOT NULL,
	`date_ajout` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id_post`)
);

CREATE TABLE `roles` (
	`id_role` bigint(11) NOT NULL,
	`nom_role` varchar(20) NOT NULL,
	PRIMARY KEY (`id_role`)
);

CREATE TABLE `users` (
	`id_user` int(11) NOT NULL,
	`roles_id_role` int(11) NOT NULL,
	`avatars_id_avatar` int(11) NOT NULL,
	`nom` varchar(30) NOT NULL,
	`prenom` varchar(30) NOT NULL,
	`pseudo` varchar(30) NOT NULL,
	`password` varchar(80) NOT NULL,
	`email` varchar(80) NOT NULL,
	`date_ajout` DATETIME NOT NULL,
	PRIMARY KEY (`id_user`)
);

CREATE TABLE `videos` (
	`id_video` int(11) NOT NULL,
	`titre` varchar(60) NOT NULL,
	`description` TEXT NOT NULL,
	`url` TEXT NOT NULL,
	`auteur` varchar(30) NOT NULL,
	`posts_id_post` int(11) NOT NULL,
	`vignette` TEXT NOT NULL,
	`date_ajout` DATETIME NOT NULL,
	`categories_id_categorie` int(11) NOT NULL,
	`users_id_user` int(11) NOT NULL,
	`favoris_video_id_video` int(11) NOT NULL,
	`en_ligne` int(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id_video`)
);

ALTER TABLE `favoris_videos` ADD CONSTRAINT `favoris_videos_fk0` FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`);

ALTER TABLE `likes_posts` ADD CONSTRAINT `likes_posts_fk0` FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`);

ALTER TABLE `posts` ADD CONSTRAINT `posts_fk0` FOREIGN KEY (`users_id_user`) REFERENCES `users`(`id_user`);

ALTER TABLE `posts` ADD CONSTRAINT `posts_fk1` FOREIGN KEY (`videos_id_video`) REFERENCES `videos`(`id_video`);

ALTER TABLE `users` ADD CONSTRAINT `users_fk0` FOREIGN KEY (`roles_id_role`) REFERENCES `roles`(`id_role`);

ALTER TABLE `users` ADD CONSTRAINT `users_fk1` FOREIGN KEY (`avatars_id_avatar`) REFERENCES `avatars`(`id_avatar`);

ALTER TABLE `videos` ADD CONSTRAINT `videos_fk0` FOREIGN KEY (`posts_id_post`) REFERENCES `posts`(`id_post`);

ALTER TABLE `videos` ADD CONSTRAINT `videos_fk1` FOREIGN KEY (`categories_id_categorie`) REFERENCES `categories`(`id_categorie`);

ALTER TABLE `videos` ADD CONSTRAINT `videos_fk2` FOREIGN KEY (`users_id_user`) REFERENCES `users`(`id_user`);

ALTER TABLE `videos` ADD CONSTRAINT `videos_fk3` FOREIGN KEY (`favoris_video_id_video`) REFERENCES `favoris_videos`(`id_video`);

