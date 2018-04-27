-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.21-0ubuntu0.17.10.1 - (Ubuntu)
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

-- Дамп структуры для таблица exchange.access_additional_function
CREATE TABLE IF NOT EXISTS `access_additional_function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(4) DEFAULT '0',
  UNIQUE KEY `ip` (`ip`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70181 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы exchange.access_additional_function: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `access_additional_function` DISABLE KEYS */;
INSERT INTO `access_additional_function` (`id`, `ip`, `login`, `date`, `enable`) VALUES
	(70178, '192.168.20.24', 'test1', '2018-04-06 15:21:10', 1),
	(70179, '192.168.20.33', 'test2', '2018-04-19 14:13:19', 1),
	(70180, '192.168.20.22', 'test3', '2018-04-23 15:43:04', 1);
/*!40000 ALTER TABLE `access_additional_function` ENABLE KEYS */;

-- Дамп структуры для таблица exchange.authorization
CREATE TABLE IF NOT EXISTS `authorization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы exchange.authorization: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `authorization` DISABLE KEYS */;
INSERT INTO `authorization` (`id`, `login`, `pass`, `date`, `enable`) VALUES
	(1, 'b27ec3eb1777d37abbfa56f0077d3bd85', '00f9f942d5266fd4dafa70d85176000a5', '2018-03-16 10:12:01', 1);
/*!40000 ALTER TABLE `authorization` ENABLE KEYS */;

-- Дамп структуры для таблица exchange.mail
CREATE TABLE IF NOT EXISTS `mail` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `enable` tinyint(1) DEFAULT '0',
  UNIQUE KEY `address` (`address`),
  KEY `num` (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы exchange.mail: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `mail` DISABLE KEYS */;
INSERT INTO `mail` (`num`, `ip`, `address`, `date`, `enable`) VALUES
	(1, '192.168.20.39', 'test@ukr.net', '2018-04-19 14:18:52', 0),
	(9, '192.168.20.60', 'yaylov@gmail.com', '2018-04-20 13:17:18', 0);
/*!40000 ALTER TABLE `mail` ENABLE KEYS */;

-- Дамп структуры для таблица exchange.point
CREATE TABLE IF NOT EXISTS `point` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `short_name` varchar(5) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `ip` varchar(40) DEFAULT NULL,
  `ip_local` varchar(40) DEFAULT NULL,
  `head` tinyint(4) DEFAULT '0',
  UNIQUE KEY `short_name` (`short_name`),
  KEY `num` (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы exchange.point: ~21 rows (приблизительно)
/*!40000 ALTER TABLE `point` DISABLE KEYS */;
INSERT INTO `point` (`num`, `short_name`, `name`, `ip`, `ip_local`, `head`) VALUES
	(1, 'ЦЕ', 'Центральный_офис', NULL, '192.168.51.0', 1),
	(2, 'ТМ', '1000_мелочей', '46.162.17.11', '192.168.52.11', 0),
	(3, 'СМ', '17-й', '46.162.38.33', '192.168.53.11', 0),
	(4, 'СР', '17-й_Рынок', '5.105.39.22', '192.168.54.11', 0),
	(5, 'ТЦ', '23-й', '46.162.3.22', '192.168.55.11', 0),
	(6, 'БЕ', 'Бердянск', '185.248.128.11', '192.168.56.11', 0),
	(7, 'БР', 'Брусничка', '91.192.157.32', '192.168.57.11', 0),
	(8, 'ЗН', 'Запорожье-Новокузнецкая', '94.153.210.22', '192.168.58.11', 0),
	(9, 'ЗЧ', 'Запорожье-Чаривная', '94.153.160.33', '192.168.59.11', 0),
	(10, 'МЕ', 'Меотида', '91.250.44.21', '192.168.60.11', 0),
	(11, 'НМ', 'Маркет', '46.162.29.22', '192.168.61.11', 0),
	(12, 'БЖ', 'Обжора', '46.162.11.54', '192.168.62.11', 0),
	(13, 'ПА', 'Павильоны', '31.202.215.33', '192.168.63.11', 0),
	(14, 'ПФ', 'Пифагор', '193.111.158.33', '192.168.64.11', 0),
	(15, 'ПО', 'Победа', '193.111.159.222', '192.168.65.11', 0),
	(16, 'ПС', 'ПортСити', '178.136.73.22', '192.168.66.11', 0),
	(17, 'ПР', 'Прибой', '46.162.35.3', '192.168.67.11', 0),
	(18, 'ЦУ', 'ЦУМ', '89.105.230.22', '192.168.68.11', 0),
	(19, 'ЧМ', 'Чудомаркет', '91.192.158.32', '192.168.69.11', 0),
	(20, 'ШН', 'Школярик', '46.162.55.56', '192.168.70.11', 0),
	(21, 'ЧН', 'Чудомаркет_Новый', '91.192.158.32', '192.168.71.11', 0);
/*!40000 ALTER TABLE `point` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
