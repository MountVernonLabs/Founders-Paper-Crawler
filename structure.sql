# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.23)
# Database: mv_dev
# Generation Time: 2019-01-12 04:02:05 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table mv_papers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mv_papers`;

CREATE TABLE `mv_papers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `record` varchar(32) DEFAULT NULL,
  `title` text,
  `to_from` char(4) DEFAULT NULL,
  `project` varchar(64) DEFAULT '',
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `founders_url` text,
  `authors` text,
  `recipients` text,
  `content` longtext,
  `words` int(11) DEFAULT NULL,
  `route` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `record` (`record`),
  KEY `to_from` (`to_from`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table mv_papers_index
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mv_papers_index`;

CREATE TABLE `mv_papers_index` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `letter` varchar(32) DEFAULT NULL,
  `person` varchar(255) DEFAULT NULL,
  `direction` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `letter` (`letter`),
  KEY `person` (`person`),
  KEY `direction` (`direction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
