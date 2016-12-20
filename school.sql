-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 02 2013 г., 06:52
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `school`
--

-- --------------------------------------------------------

--
-- Структура таблицы `data_parents`
--

CREATE TABLE IF NOT EXISTS `data_parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `surname` char(40) NOT NULL,
  `patronymic` char(50) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `birth` date NOT NULL,
  `address` char(100) NOT NULL,
  `phoneCode` int(11) NOT NULL,
  `phoneNumber` int(10) NOT NULL,
  `work` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `data_parents`
--

INSERT INTO `data_parents` (`id`, `name`, `surname`, `patronymic`, `sex`, `birth`, `address`, `phoneCode`, `phoneNumber`, `work`) VALUES
(1, 'Светлана', 'Иванова', 'Михайловна', 0, '1981-03-03', 'Монастырская 12, 4', 342, 4567890, 'Д/c №12 Воспитатель'),
(2, 'Владимир', 'Иванов', 'Федорович', 1, '1979-11-05', 'Монастырская 12, 4', 919, 9875462, 'ООО &quot;ИРБИС&quot; директор'),
(3, 'Надежда', 'Васильева', 'Викторовна', 0, '1975-10-28', 'Мира 8б, 24', 919, 5647521, 'Тур. Агенство &quot;Спутник&quot;'),
(4, 'Михаил', 'Васильев', 'Андреевич', 1, '1979-10-25', 'Коломенская, 5', 922, 3145487, 'Газпром'),
(5, 'Владислав', 'Михоношен', 'Виктоорович', 1, '1983-06-14', 'Краснополянская 14, 4', 902, 1548796, 'Прогноз'),
(6, 'Наталья', 'Михоношена', 'Михайловна', 0, '1982-12-10', 'Краснополянская 14, 4', 342, 5463279, 'МОУ СОШ №1'),
(7, 'Анатолий', 'Сидоров', 'Владимирович', 1, '1976-07-26', 'Сибирская 54, д. 34', 905, 6547824, 'Сбербанк'),
(8, 'Марина', 'Сидорова', 'Владимировна', 0, '1979-01-19', 'Сибирская 54, д. 34', 342, 2654854, 'Домохозяйка'),
(9, 'Андрей', 'Краснов', 'Андреевич', 1, '1977-09-04', 'Стахановская 15. 45', 342, 2345687, 'водитель'),
(10, 'Светлана', 'Петрова', 'Анатольевна', 0, '1982-08-18', 'Старцева 54, кв. 43', 912, 6548732, 'ОАО &quot;Апрель&quot;'),
(11, 'Надежда', 'Рахманова', 'Михайловна', 0, '1976-10-11', 'ул. Нейвинская 1 - 234', 909, 7844635, 'д/с №234 директор'),
(12, 'Андрей', 'Андреев', 'Сергеевич', 1, '1981-08-09', 'Ижевская 34 - 54', 902, 6457845, 'Гипермаркет &quot;ВИВАТ&quot;'),
(13, 'Анастасия', 'Андреева', 'Михайловна', 0, '1982-04-06', 'Ижевская 34 - 54', 342, 2547863, 'Домохозяйка'),
(14, 'Анатолий', 'Антонов', 'Владимирович', 1, '1978-08-16', 'Старцева 23 - 23', 902, 8756413, 'ООО &quot;БРИКС&quot;');

-- --------------------------------------------------------

--
-- Структура таблицы `data_rating`
--

CREATE TABLE IF NOT EXISTS `data_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_student` int(11) NOT NULL,
  `math` int(1) NOT NULL,
  `rus` int(1) NOT NULL,
  `history` int(1) NOT NULL,
  `english` int(1) NOT NULL,
  `physic_cult` int(1) NOT NULL,
  `rating` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `data_rating`
--

INSERT INTO `data_rating` (`id`, `id_student`, `math`, `rus`, `history`, `english`, `physic_cult`, `rating`) VALUES
(1, 1, 5, 5, 5, 5, 5, 5),
(2, 2, 4, 4, 5, 5, 4, 4.4),
(3, 3, 3, 5, 4, 4, 5, 4.2),
(4, 4, 3, 3, 3, 5, 5, 3.8),
(5, 5, 5, 5, 5, 5, 5, 5),
(6, 6, 2, 3, 3, 3, 5, 3.2),
(7, 7, 5, 5, 5, 5, 5, 5),
(8, 8, 0, 0, 0, 0, 0, 0),
(9, 9, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `data_students`
--

CREATE TABLE IF NOT EXISTS `data_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `surname` char(40) NOT NULL,
  `patronymic` char(40) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `birth` date NOT NULL,
  `address` char(100) DEFAULT NULL,
  `phoneCode` int(20) DEFAULT NULL,
  `phoneNumber` int(11) NOT NULL,
  `parentMother` int(11) DEFAULT NULL,
  `parentFather` int(11) DEFAULT NULL,
  `class` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `data_students`
--

INSERT INTO `data_students` (`id`, `name`, `surname`, `patronymic`, `sex`, `birth`, `address`, `phoneCode`, `phoneNumber`, `parentMother`, `parentFather`, `class`) VALUES
(1, 'Дмитрий', 'Иванов', 'Владимирович', 1, '2005-09-13', 'Монастырская 12, 4', 0, 0, 1, 2, '1А'),
(2, 'Анна', 'Васильева', 'Михайловна', 0, '2005-09-19', 'Мира 8б, 24', 0, 0, 3, 4, '1А'),
(3, 'Никита', 'Михоношен', 'Владиславович', 1, '2005-06-07', 'Краснополянская 14, 4', 0, 0, 6, 5, '1А'),
(4, 'Анастасия', 'Сидорова', 'Анатольевна', 0, '2005-07-18', 'Сибирская 54, д. 34', 0, 0, 8, 7, '1Б'),
(5, 'Илья', 'Краснов', 'Андреевич', 1, '2005-12-19', 'Стахановская 15. 45', 342, 2345687, 0, 9, '1Б'),
(6, 'Владимир', 'Петров', 'Андреевич', 1, '2005-07-25', 'Старцева 54, кв. 43', 0, 0, 10, 0, '1Б'),
(7, 'Наталья', 'Рахманова', 'Викторовна', 0, '2004-02-05', 'ул. Нейвинская 1 - 234', 0, 0, 11, 0, '2А'),
(8, 'Станислав', 'Андреев', 'Андреевич', 1, '2004-06-08', 'Ижевская 34 - 54', 342, 2547863, 13, 12, '2А'),
(9, 'Сергей', 'Антонов', 'Анатольевич', 1, '2004-11-18', 'Старцева 23 - 23', 0, 0, 0, 14, '2А');

-- --------------------------------------------------------

--
-- Структура таблицы `data_users`
--

CREATE TABLE IF NOT EXISTS `data_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `email` char(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `data_users`
--

INSERT INTO `data_users` (`id`, `login`, `password`, `email`) VALUES
(1, 'admin', '123456', 'dj.coder@ya.ru');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `data_rating`
--
ALTER TABLE `data_rating`
  ADD CONSTRAINT `data_rating_ibfk_1` FOREIGN KEY (`id`) REFERENCES `data_students` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
