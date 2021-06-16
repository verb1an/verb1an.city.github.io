-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 16 2021 г., 06:49
-- Версия сервера: 5.7.29
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cityproblems`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sys_catygories`
--

CREATE TABLE `sys_catygories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sys_catygories`
--

INSERT INTO `sys_catygories` (`id`, `name`) VALUES
(1, 'Дороги'),
(2, 'Здания'),
(3, 'Ремонт'),
(4, 'Освещение'),
(5, 'Вывески'),
(6, 'Водопровод'),
(7, 'Электричество'),
(8, 'Вода'),
(9, 'Мосты'),
(10, 'Пешеходные переходы'),
(11, 'Саранарабой');

-- --------------------------------------------------------

--
-- Структура таблицы `sys_items`
--

CREATE TABLE `sys_items` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cats` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'false',
  `show_name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `version` float DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sys_items`
--

INSERT INTO `sys_items` (`id`, `name`, `text`, `images`, `cats`, `user`, `status`, `show_name`, `date`, `version`) VALUES
(1, 'Проблема 1', 'Описание проблемы 1', NULL, 'Вода;', 1, 'disabled', '0', '2021-06-07', 1),
(9, 'Проблема 2', 'Описание проблемы под номером 2, Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, fugit?', 'images/items_images/u_i8808329.png;images/items_images/u_i80743026.png;images/items_images/u_i37500688.png;images/items_images/u_i50704719.png;images/items_images/u_i9282853.png;images/items_images/u_i72122408.png;images/items_images/u_i32551810.png;', 'Дороги;Ремонт;', 12, 'false', '1', '2021-06-08', 1.01),
(10, 'Проблема 10', 'Краткое описание проблем 10', 'images/items_images/u_i43130641.png;images/items_images/u_i26775905.png;;images/items_images/u_i38344579.png;images/items_images/u_i55883692.png;images/items_images/u_i43360862.png;', 'Вода;', 12, 'false', '0', '2021-06-07', 1),
(11, 'Проблема 11', 'Краткое описание проблем 10', 'images/items_images/u_i43130641.png;images/items_images/u_i26775905.png;images/items_images/u_i55883692.png;images/items_images/u_i43360862.png;images/items_images/u_i43360862.png;', 'Вода;', 12, 'false', '1', '2021-06-07', 1),
(12, 'Проблема 12 Обновлено 6', 'Описание проблемы 11', 'images/items_images/u_i54646098.png;images/items_images/u_i4751159.png;images/items_images/u_i30929079.png;', 'Освещение;', 11, 'true', '1', '2021-06-07', 1.05),
(13, 'Проблема 12', 'Описание проблемы 11', 'images/items_images/u_i54646098.png;images/items_images/u_i4751159.png;images/items_images/u_i30929079.png;', 'Освещение;', 1, 'false', '1', '2021-06-09', 1),
(14, 'Проблема №14', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum labore praesentium esse, dolorum earum consequuntur vel atque omnis similique, vitae at doloribus nesciunt, mollitia laboriosam?\n', 'images/items_images/u_i9209444.png;images/items_images/u_i46248002.png;images/items_images/u_i49677212.png;images/items_images/u_i26506879.png;', 'Мосты;Водопровод;', 10, 'false', '1', '2021-06-09', 1),
(15, 'Проблема пд номер 15', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum labore praesentium esse, dolorum earum consequuntur vel atque omnis similique, vitae at doloribus nesciunt, mollitia laboriosam?\n', 'images/items_images/u_i61152751.png;images/items_images/u_i73076408.png;', 'Дороги;', 10, 'false', '', '2021-06-09', 1),
(16, 'Ghj,ktvf 16', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum labore praesentium esse\n', 'images/items_images/u_i11953602.png;images/items_images/u_i92960184.png;images/items_images/u_i21680690.png;', 'Ремонт;', 10, 'false', '1', '2021-06-09', 1),
(17, 'Проблема 18, опять одно и тоже', 'lorem quuntur vel atque omnis similique, vitae at doloribus nesciunt, mollitia laboriosam?\n', 'images/items_images/u_i68845836.png;images/items_images/u_i97009963.png;images/items_images/u_i59956721.png;images/items_images/u_i3365791.png;', 'Вывески;', 10, 'false', '1', '2021-06-09', 1),
(18, 'Новая заявка 1', 'Lorem ipsum dolor sit amet consectetur\n', 'images/items_images/u_i75847035.png;', 'Электричество;', 11, 'false', '1', '2021-06-09', 1),
(19, 'Новая заявка 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum\n', 'images/items_images/u_i39466159.png;', 'Электричество;', 11, 'false', '1', '2021-06-09', 1),
(20, 'Проблема 20', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero, ea!', 'images/items_images/u_i62487131.png;images/items_images/u_i85374965.png;', 'Дороги;', 11, 'false', '1', '2021-06-09', 1),
(21, 'Заявка 21 Обновлено', 'lorem 1234568 lorem nasbu', 'images/items_images/u_i84474161.png;images/items_images/u_i79667214.png;images/items_images/u_i70580913.png;', 'Вывески;Ремонт;Здания;', 11, 'disabled', '1', '2021-06-09', 1.02),
(22, 'Название 22', 'lorem 10', 'images/items_images/u_i51321735.png;images/items_images/u_i52381533.png;images/items_images/u_i88331666.png;', 'Вода;Водопровод;', 11, 'false', '1', '2021-06-09', 1.02);

-- --------------------------------------------------------

--
-- Структура таблицы `sys_users`
--

CREATE TABLE `sys_users` (
  `id` int(11) NOT NULL,
  `u_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_login` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_pass` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `u_date` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notify` int(11) NOT NULL DEFAULT '0',
  `u_notifyis` json DEFAULT NULL,
  `rights` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sys_users`
--

INSERT INTO `sys_users` (`id`, `u_name`, `u_email`, `u_login`, `u_pass`, `u_phone`, `u_date`, `image`, `about`, `notify`, `u_notifyis`, `rights`) VALUES
(1, 'СуперЮзер', 'superuser@gmail.com', 'admin', 'admin123', '8999999999', '2002-02-19', 'images/users_images/avatar-1_542.jpg', '', 1, NULL, 'super'),
(10, 'Алексей', 'tabyshkinalex@gmail.com', 'login', 'pass123', '2460601000', '2002-02-19', NULL, NULL, 0, NULL, 'default'),
(11, 'Иван', 'stabyshkin@inbox.ru', 'user', '123456', '2460601000', '2001-01-01', 'images/users_images/avatar-11_181.jpg', '', 0, NULL, 'default'),
(12, 'Алексей Андреевич', 'tab123456@mail.ru', 'admina', '123456', '89835468475', '2002-02-19', 'images/users_images/avatar-12_418.jpg', 'Всем привет. Меня зовут Алексей, мне 19 лет\nУчусь в ГАГПК, 3-й курс', 0, NULL, 'default'),
(13, 'Алексей', 'tabyshkin@gmail.com', 'verb', '123456', '89835468576', '2004-01-04', NULL, NULL, 0, NULL, 'default'),
(14, 'Саша', 'sgnerv@gmail.com', 'sgnerv', 'newparol', '89030745596', '2001-07-05', 'images/users_images/avatar-14_323.jpg', 'Приветики=) Я Саша', 0, NULL, 'default');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `sys_catygories`
--
ALTER TABLE `sys_catygories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sys_items`
--
ALTER TABLE `sys_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `sys_catygories`
--
ALTER TABLE `sys_catygories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `sys_items`
--
ALTER TABLE `sys_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
