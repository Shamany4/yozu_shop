-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 13 2019 г., 07:34
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `myshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `img`, `category`) VALUES
(1, 'Noika 3200', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 15000, 'nokia-6300.png', 'phone'),
(3, 'Galaxy S9', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 65153, 'galaxy-10.png', 'phone'),
(4, 'Iphone 7S', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 35684, 'iphone-7.png', 'phone'),
(5, 'Honor 20', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 78946, 'honor-20.png', 'phone'),
(6, 'Surface 5', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 18535, 'surface-5.png', 'tablet');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstname`, `email`, `pass`) VALUES
(8, 'Admin', 'admin@mail.ru', '574c730322963f758b948ab7a236603f'),
(10, 'Anton', 'anton-shamov99@mail.ru', '1e9728f8781ace080629c0779883bdaa');

-- --------------------------------------------------------

--
-- Структура таблицы `user_bank`
--

CREATE TABLE `user_bank` (
  `user_id` int(11) NOT NULL,
  `user_money` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_basket`
--

CREATE TABLE `user_basket` (
  `basket_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `count_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_bank`
--
ALTER TABLE `user_bank`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `user_basket`
--
ALTER TABLE `user_basket`
  ADD PRIMARY KEY (`basket_id`),
  ADD KEY `user_id__FK` (`user_id`),
  ADD KEY `item_id__FK` (`item_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `user_basket`
--
ALTER TABLE `user_basket`
  MODIFY `basket_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_bank`
--
ALTER TABLE `user_bank`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_basket`
--
ALTER TABLE `user_basket`
  ADD CONSTRAINT `item_id__FK` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `user_id__FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
