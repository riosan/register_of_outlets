-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.22-0ubuntu18.04.1 - (Ubuntu)
-- Операционная система:         Linux
-- HeidiSQL Версия:              9.5.0.5265
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных exchange
CREATE DATABASE IF NOT EXISTS `exchange` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `exchange`;

-- Дамп структуры для таблица exchange.mail
CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) DEFAULT '0',
  UNIQUE KEY `address` (`login`),
  KEY `num` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы exchange.mail: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `mail` DISABLE KEYS */;
INSERT INTO `mail` (`id`, `ip`, `login`, `date`, `enable`) VALUES
	(1, '192.168.20.33', 'sron757@ukr.net', '2018-04-19 14:18:52', 0);
/*!40000 ALTER TABLE `mail` ENABLE KEYS */;

-- Дамп структуры для таблица exchange.point
CREATE TABLE IF NOT EXISTS `point` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short_name` varchar(5) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `ip` varchar(40) DEFAULT NULL,
  `ip_local` varchar(40) DEFAULT NULL,
  `head` tinyint(4) DEFAULT '0',
  `enable` tinyint(4) DEFAULT '1',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `short_name` (`short_name`),
  KEY `num` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы exchange.point: ~21 rows (приблизительно)
/*!40000 ALTER TABLE `point` DISABLE KEYS */;
INSERT INTO `point` (`id`, `short_name`, `login`, `ip`, `ip_local`, `head`, `enable`, `date`) VALUES
	(1, 'ЦЕ', 'Центральный_офис', NULL, '192.168.20.0', 1, 1, '2018-06-14 08:46:07'),
	(2, 'ТМ', '1000_мелочей', '46.161.17.100', '192.168.3.1', 0, 1, '2018-06-14 08:46:07'),
	(3, 'СМ', '17-й', '46.161.38.171', '192.168.3.1', 0, 1, '2018-06-14 08:46:07'),
	(4, 'СР', '17-й_Игрушки', '5.105.39.12', '192.168.5.1', 0, 1, '2018-06-14 08:46:07'),
	(5, 'ТЦ', '23-й', '46.152.3.197', '192.168.6.1', 0, 1, '2018-06-14 08:46:07'),
	(6, 'БЕ', 'Бердянск', '185.238.128.87', '192.168.7.1', 0, 1, '2018-06-14 08:46:07'),
	(7, 'БР', 'Брусничка', '91.142.157.205', '192.168.8.1', 0, 1, '2018-06-14 08:46:07'),
	(8, 'ЗН', 'Запорожье-Новокузнецкая', '94.143.210.102', '192.168.9.1', 0, 1, '2018-06-14 08:46:07'),
	(9, 'ЗЧ', 'Запорожье-Чаривная', '94.143.160.58', '192.168.10.1', 0, 1, '2018-06-14 08:46:07'),
	(10, 'МЕ', 'Меотида', '91.229.44.143', '192.168.11.1', 0, 1, '2018-06-14 08:46:07'),
	(11, 'НМ', 'Натали-Маркет', '46.152.29.98', '192.168.12.1', 0, 1, '2018-06-14 08:46:07'),
	(12, 'БЖ', 'Обжора', '46.122.11.100', '192.168.13.1', 0, 1, '2018-06-14 08:46:07'),
	(13, 'ПА', 'Павильоны', '31.212.215.96', '192.168.14.1', 0, 1, '2018-06-14 08:46:07'),
	(14, 'ПФ', 'Пифагор', '193.121.158.106', '192.168.15.1', 0, 1, '2018-06-14 08:46:07'),
	(15, 'ПО', 'Победа', '193.131.159.70', '192.168.16.1', 0, 1, '2018-06-14 08:46:07'),
	(16, 'ПС', 'ПортСити', '178.146.73.53', '192.168.17.1', 0, 1, '2018-06-14 08:46:07'),
	(17, 'ПР', 'Прибой', '46.142.35.2', '192.168.18.1', 0, 1, '2018-06-14 08:46:07'),
	(18, 'ЦУ', 'ЦУМ', '89.115.230.246', '192.168.19.1', 0, 1, '2018-06-14 08:46:07'),
	(20, 'ШН', 'Школярик', '46.152.55.73', '192.168.21.1', 0, 1, '2018-06-14 08:46:07'),
	(21, 'ЧН', 'Чудомаркет', '91.182.158.164', '192.168.22.1', 0, 1, '2018-06-14 08:46:07'),
	(22, 'ЗШ', 'Запорожье-Школьная', '188.163.175.18', '192.168.23.1', 0, 1, '2018-06-14 08:46:07');
/*!40000 ALTER TABLE `point` ENABLE KEYS */;

-- Дамп структуры для таблица exchange.root
CREATE TABLE IF NOT EXISTS `root` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы exchange.root: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `root` DISABLE KEYS */;
INSERT INTO `root` (`id`, `login`, `pass`, `date`, `enable`) VALUES
	(1, 'ayaylov', '00f9f942d5266fd4dafa708517600034', '2018-03-16 10:12:01', 1);
/*!40000 ALTER TABLE `root` ENABLE KEYS */;

-- Дамп структуры для таблица exchange.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(4) DEFAULT '0',
  UNIQUE KEY `ip` (`ip`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70184 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы exchange.users: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip`, `login`, `date`, `enable`) VALUES
	(70178, '192.168.20.33', 'ay', '2018-04-06 15:21:10', 1),
	(70179, '192.168.20.23', 'at', '2018-04-19 14:13:19', 1),
	(70183, '192.168.20.78', 'ak', '2018-06-14 11:44:14', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
