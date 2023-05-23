CREATE DATABASE restaurant_db;

USE restaurant_db;

CREATE TABLE `cat` (
    `id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(60) NOT NULL
);

-- CREATE TABLE `formula` (
--     `id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
--     `prix` INT(11) NOT NULL,
--     `description` VARCHAR(255) NOT NULL
--     `id_menu` INT(11) NOT NULL,
--     FOREIGN KEY (id_menu) REFERENCES ()
-- )

CREATE TABLE `galerie`(
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `titre` VARCHAR(50) NOT NULL,
    `image` VARCHAR(100) NOT NULL
);

CREATE TABLE `horaire_ouverture` (
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `horaire` VARCHAR(100) NOT NULL,
    -- `ouverture_h` BOOL NULL
    `midi` BOOL NOT NULL
);

CREATE TABLE `jours_open` (
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `jour` VARCHAR(60) NOT NULL,
    `horaire_opne_days` VARCHAR(250) NOT NULL
);

CREATE TABLE `membre` (
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `email` VARCHAR(150) NOT NULL,
    `mdp` VARCHAR(255) NOT NULL,
    `role` VARCHAR(10) NOT NULL,
    `nom` VARCHAR(100)
);

CREATE TABLE `menu_formule`(
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(250) NOT NULL,
    `content` VARCHAR(250) NOT NULL,
    `price` FLOAT NOT NULL
);

CREATE TABLE `plat`(
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `titre` VARCHAR(60) NOT NULL,
    `description` VARCHAR(250) NOT NULL,
    `prix` FLOAT NOT NULL,
    `id_categorie` INT(11) NOT NULL,
    CONSTRAINT `fk_plat_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `cat`(`id`)
);


CREATE TABLE `table_` (
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nb_couverts` INT(11) NOT NULL,
    `date` DATE NOT NULL,
    `mention_des_allergie` VARCHAR(250) NULL,
    `id_horaire` INT(11) NOT NULL,
    CONSTRAINT `fk_table_horaire` FOREIGN KEY (`id_horaire`) REFERENCES `horaire_ouverture`(`id`)
);

CREATE TABLE `reservation` (
    `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `id_membre` INT(11),
    `id_table` INT(11) NOT NULL,
    `role` VARCHAR(50) NOT NULL,
    CONSTRAINT `fk_reservation_membre` FOREIGN KEY (`id_membre`) REFERENCES `membre`(`id`),
    CONSTRAINT `fk_reservation_table` FOREIGN KEY (`id_table`) REFERENCES `table_`(`id`)
);