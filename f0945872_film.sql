-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.1.34
-- Время создания: Июл 27 2024 г., 13:01
-- Версия сервера: 5.7.37-40
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `f0945872_film`
--

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE `event` (
  `event_code` int(11) NOT NULL,
  `genre_code` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `duration` time(6) NOT NULL,
  `year_of_manufacture` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `event`
--

INSERT INTO `event` (`event_code`, `genre_code`, `event_name`, `duration`, `year_of_manufacture`) VALUES
(1, 2, 'Лед', '01:53:00.000000', '2018'),
(2, 3, 'Время', '01:49:00.000000', '2011'),
(3, 1, '1+1', '01:52:00.000000', '2011'),
(27, 3, 'Человек паук', '01:21:00.000000', '2002'),
(28, 7, 'Синяя бездна', '02:12:00.000000', '2018'),
(29, 1, 'Зависнуть в Палм-Спрингс', '02:21:00.000000', '2020'),
(30, 1, 'Элвин и бурундуки', '01:47:00.000000', '2007'),
(31, 5, 'Нерв', '02:34:00.000000', '2016');

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `genre_code` int(11) NOT NULL,
  `genre_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`genre_code`, `genre_name`) VALUES
(1, 'Комедия'),
(2, 'Мелодрама'),
(3, 'Фантастика'),
(4, 'Детектив'),
(5, 'Боевик'),
(7, 'Ужасы'),
(8, 'Драма');

-- --------------------------------------------------------

--
-- Структура таблицы `hall`
--

CREATE TABLE `hall` (
  `hall_code` int(11) NOT NULL,
  `location_code` int(11) NOT NULL,
  `hall_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `hall`
--

INSERT INTO `hall` (`hall_code`, `location_code`, `hall_number`) VALUES
(1, 1, 1),
(2, 3, 3),
(3, 2, 1),
(4, 4, 2),
(5, 5, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `location`
--

CREATE TABLE `location` (
  `location_code` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `location`
--

INSERT INTO `location` (`location_code`, `address`) VALUES
(1, 'Москва'),
(2, 'Екатеринбург'),
(3, 'Санкт-Петербург'),
(4, 'Казань'),
(5, 'Челябинск');

-- --------------------------------------------------------

--
-- Структура таблицы `place`
--

CREATE TABLE `place` (
  `place_code` int(11) NOT NULL,
  `row_code` int(11) NOT NULL,
  `place_number` int(11) NOT NULL,
  `ratio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `place`
--

INSERT INTO `place` (`place_code`, `row_code`, `place_number`, `ratio`) VALUES
(1, 1, 5, 1),
(2, 2, 11, 1.5),
(3, 3, 7, 1),
(5, 1, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `row`
--

CREATE TABLE `row` (
  `row_code` int(11) NOT NULL,
  `hall_code` int(11) NOT NULL,
  `row_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `row`
--

INSERT INTO `row` (`row_code`, `hall_code`, `row_number`) VALUES
(1, 1, 5),
(2, 3, 6),
(3, 2, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE `session` (
  `session_code` int(11) NOT NULL,
  `event_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  `basic_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `session`
--

INSERT INTO `session` (`session_code`, `event_code`, `date`, `time`, `basic_cost`) VALUES
(1, 2, '2024-04-01', '12:30:00', 250),
(2, 3, '2024-04-01', '18:30:00', 350),
(3, 1, '2024-04-03', '10:00:00', 200),
(4, 27, '2024-04-05', '17:30:00', 450),
(6, 28, '2024-04-01', '22:00:00', 500),
(9, 29, '2024-04-03', '13:10:00', 200),
(10, 30, '2024-04-05', '10:50:00', 450),
(12, 31, '2024-04-03', '16:50:00', 450);

-- --------------------------------------------------------

--
-- Структура таблицы `ticket`
--

CREATE TABLE `ticket` (
  `ticket_code` int(11) NOT NULL,
  `session_code` int(11) NOT NULL,
  `place_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ticket`
--

INSERT INTO `ticket` (`ticket_code`, `session_code`, `place_code`) VALUES
(1, 2, 2),
(2, 2, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_code`),
  ADD KEY `genre_code` (`genre_code`);

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_code`);

--
-- Индексы таблицы `hall`
--
ALTER TABLE `hall`
  ADD PRIMARY KEY (`hall_code`),
  ADD KEY `location_code` (`location_code`);

--
-- Индексы таблицы `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_code`);

--
-- Индексы таблицы `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`place_code`),
  ADD KEY `row_code` (`row_code`);

--
-- Индексы таблицы `row`
--
ALTER TABLE `row`
  ADD PRIMARY KEY (`row_code`),
  ADD KEY `hall_code` (`hall_code`);

--
-- Индексы таблицы `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_code`),
  ADD KEY `event_code` (`event_code`);

--
-- Индексы таблицы `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_code`),
  ADD KEY `session_code` (`session_code`),
  ADD KEY `place_code` (`place_code`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `event_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `hall`
--
ALTER TABLE `hall`
  MODIFY `hall_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `location`
--
ALTER TABLE `location`
  MODIFY `location_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `place`
--
ALTER TABLE `place`
  MODIFY `place_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `row`
--
ALTER TABLE `row`
  MODIFY `row_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `session`
--
ALTER TABLE `session`
  MODIFY `session_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`genre_code`) REFERENCES `genre` (`genre_code`);

--
-- Ограничения внешнего ключа таблицы `hall`
--
ALTER TABLE `hall`
  ADD CONSTRAINT `hall_ibfk_1` FOREIGN KEY (`location_code`) REFERENCES `location` (`location_code`);

--
-- Ограничения внешнего ключа таблицы `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `place_ibfk_1` FOREIGN KEY (`row_code`) REFERENCES `row` (`row_code`);

--
-- Ограничения внешнего ключа таблицы `row`
--
ALTER TABLE `row`
  ADD CONSTRAINT `row_ibfk_1` FOREIGN KEY (`hall_code`) REFERENCES `hall` (`hall_code`);

--
-- Ограничения внешнего ключа таблицы `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`event_code`) REFERENCES `event` (`event_code`);

--
-- Ограничения внешнего ключа таблицы `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`session_code`) REFERENCES `session` (`session_code`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`place_code`) REFERENCES `place` (`place_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
