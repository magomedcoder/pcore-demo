CREATE DATABASE IF NOT EXISTS `pcore_demo`;
USE `pcore_demo`;

CREATE TABLE IF NOT EXISTS `posts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `content` mediumtext NOT NULL,
    `created_at` int(11) NOT NULL,
    PRIMARY KEY (`id`) USING BTREE
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`id`, `content`, `created_at`) VALUES (1, 'Привет мир', 1661115723);