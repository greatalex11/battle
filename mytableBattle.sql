-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour battle
CREATE DATABASE IF NOT EXISTS `battle` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `battle`;

-- Listage de la structure de table battle. combat
CREATE TABLE IF NOT EXISTS `combat` (
  `index` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idp1` bigint unsigned NOT NULL,
  `idp2` bigint unsigned NOT NULL,
  `idwinner` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`index`),
  KEY `FK_combat_combattant` (`idp1`),
  KEY `FK_combat_combattant_2` (`idp2`),
  KEY `FK_combat_combattant_3` (`idwinner`),
  CONSTRAINT `FK_combat_combattant` FOREIGN KEY (`idp1`) REFERENCES `combattant` (`id`),
  CONSTRAINT `FK_combat_combattant_2` FOREIGN KEY (`idp2`) REFERENCES `combattant` (`id`),
  CONSTRAINT `FK_combat_combattant_3` FOREIGN KEY (`idwinner`) REFERENCES `combattant` (`id`),
  CONSTRAINT `checkID` CHECK ((`idp1` <> `idp2`)),
  CONSTRAINT `checkWinner` CHECK ((`idwinner` in (`idp1`,`idp2`)))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table battle. combattant
CREATE TABLE IF NOT EXISTS `combattant` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL DEFAULT 'joueur',
  `createdDate` date NOT NULL DEFAULT '2001-08-23',
  `Mana` int unsigned NOT NULL,
  `Sante` int unsigned NOT NULL,
  `initalLive` int unsigned NOT NULL,
  `attack` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
