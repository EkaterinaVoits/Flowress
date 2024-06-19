-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 09 2024 г., 14:59
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `_flowress`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Consultation`
--

CREATE TABLE `Consultation` (
  `ID` int UNSIGNED NOT NULL,
  `user_name` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `user_telephone` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `ID_status` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Consultation`
--

INSERT INTO `Consultation` (`ID`, `user_name`, `user_telephone`, `ID_status`) VALUES
(30, 'Светлана', '+375 (29) 543-23-33', 1),
(31, 'Екатерина', '+375 (29) 653-23-35', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Course`
--

CREATE TABLE `Course` (
  `ID` int UNSIGNED NOT NULL,
  `ID_user` int UNSIGNED NOT NULL DEFAULT '1',
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `fullDescription` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `price` float NOT NULL,
  `photo` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default_course_image.jpg',
  `isActive` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Course`
--

INSERT INTO `Course` (`ID`, `ID_user`, `title`, `description`, `fullDescription`, `price`, `photo`, `isActive`) VALUES
(1, 5, 'Базовый курс «Визажист с 0»', 'Для тех, кто хочет стать профессиональным востребованным визажистом', 'Базовый курс «ВИЗАЖИСТ C 0» – это первый шаг на пути к цели, начальный этап в профессиональной карьере каждого визажиста. На данном курсе проходит обучение всех желающих освоить новую для себя профессию – Визажист. В школе визажистов Your Beauty студенты осваивают с нуля все фундаментальные темы и техники в макияже, узнают профессиональные секреты и получают практический опыт. Базовые курсы визажа наша команда преподавателей разработала с учетом классических техник, лежащих в основе любого макияжа, ориентируясь на последние мировые тенденции и новинки в сфере красоты. Для максимального эффекта от обучения и усвоения программы, практике отведено более 80%, а теория включает основные знания и тезисы, без лишней воды. В теории и на практике Вы изучите: скульптуру лица, дневной макияж, вечерний и смоки айз, бронзовый макияж, макияж на кремовых текстурах, свадебные образы, оформление бровей, стрелки, макияж с акцентом на губах и многое другое. С программой курса вы можете ознакомиться ниже.', 1700, 'base_course.jpg', 1),
(2, 5, 'Курс «Экспресс-визажист»', 'Курс для начинающих визажистов, которые хотят освоить базовые техники макияжа за короткий срок', 'Курс «Экспресс-визажист» предназначен для тех, кто хочет освоить профессию визажиста в короткие сроки. Занятия проходят в интенсивном формате, что позволяет получить необходимые знания и навыки всего за несколько недель. Курс включает в себя теоретические занятия, на которых студенты изучат основы макияжа, цветовые схемы и типы кожи, а также практические занятия, где они смогут отработать полученные знания на моделях. По окончании курса студенты получат сертификат, подтверждающий их квалификацию.', 1200, 'express_visazist_ccourse.jpg', 1),
(3, 5, 'Курс «Сам себе визажист»', 'Курс для тех, кто хочет научиться делать профессиональный макияж самостоятельно', 'Курс «Сам себе визажист» предназначен для тех, кто хочет научиться делать профессиональный макияж для себя и близких. Курс включает в себя теоретические занятия, на которых студенты изучат основы макияжа, цветовые схемы и типы кожи, а также практические занятия, где они смогут отработать полученные знания. Помимо этого, студенты получат индивидуальные консультации с преподавателем, который поможет им подобрать оптимальные средства и техники макияжа в зависимости от индивидуальных особенностей. ', 700, 'mekeup_by_yourself.jpg', 1),
(4, 5, 'Курс повышения квалификации', 'Курс для действующих визажистов, которые хотят повысить свой уровень мастерства и освоить новые техники макияжа', 'Курс повышения квалификации предназначен для действующих визажистов, которые хотят повысить свой уровень мастерства и освоить новые техники макияжа. Занятия проходят в интенсивном формате, что позволяет получить необходимые знания и навыки всего за несколько недель. Курс включает в себя как теоретические занятия, где студенты изучат новые тенденции в макияже, а также практические занятия, где они смогут отработать полученные знания на моделях. По окончании курса студенты получат сертификат, подтверждающий их квалификацию.', 2200, 'higher_qualigication_course.jpg', 1),
(5, 5, 'Курс «Вечерний макияж»', 'Курс для тех, кто хочет научиться создавать вечерние макияжи для особых случаев', 'Курс «Вечерний макияж» предназначен для тех, кто хочет научиться создавать вечерние макияжи для особых случаев. Занятия проходят в небольших группах, что позволяет преподавателю уделить внимание каждому студенту. Курс включает в себя как теоретические занятия, на которых студенты изучат особенности вечернего макияжа, цветовые схемы и техники создания различных образов, а также практические занятия, где они смогут отработать полученные знания на моделях. Помимо этого, студенты получат индивидуальные консультации с преподавателем, который поможет им подобрать оптимальные средства и техники макияжа в зависимости от индивидуальных особенностей.\n', 1300, 'night_course.jpg', 1),
(6, 5, 'Курс «Тренды макияжа 2024»', 'Курс для визажистов, которые хотят быть в курсе последних тенденций в макияже', 'Курс «Тренды макияжа 2024» предназначен для визажистов, которые хотят быть в курсе последних тенденций в макияже. Занятия проходят в формате мастер-классов, что позволяет студентам не только наблюдать за работой профессиональных визажистов, но и отрабатывать полученные знания на практике. Курс включает в себя как демонстрации новых техник макияжа, так и практические отработки на моделях. По окончании курса студенты получат сертификат, подтверждающий их квалификацию.', 1200, 'trend_2024.jpg', 1),
(7, 12, 'Курс «Основы визажа»', 'Базовый курс для начинающих визажистов, который охватывает все основы профессии', 'Курс «Основы визажа» предназначен для тех, кто хочет освоить профессию визажиста с нуля. Занятия проходят в небольших группах, что позволяет преподавателю уделить внимание каждому студенту. Курс включает в себя как теоретические занятия, на которых студенты изучат основы макияжа, цветовые схемы и типы кожи, а также практические занятия, где они смогут отработать полученные знания на моделях. Помимо этого, студенты получат индивидуальные консультации с преподавателем, который поможет им подобрать оптимальные средства и техники макияжа в зависимости от индивидуальных особенностей. По окончании курса студенты получат сертификат, подтверждающий их квалификацию.', 300, 'default_course_image.jpg', 1),
(90, 4, 'Пользовательский курс 90', 'Пожелания к курсу не добавлены', 'Cоставитель кусра: Анна (+375 (29) 666-43-43, anna@gmail.com, ID: 4), Уроки:  -Макияж \"кошачий глаз\" -Вечерний макияж -Голливудский макияж -Смоки-айз', 456, 'default_course_image.jpg', 1),
(91, 4, 'Пользовательский курс 91', 'Пожелания к курсу не добавлены', 'Cоставитель кусра: Анна (+375 (29) 666-43-43, anna@gmail.com, ID: 4), Уроки:  -Нюдовый макияж -Лифтинг макияж -Вечерний макияж -Голливудский макияж', 456, 'default_course_image.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Courses_schedule`
--

CREATE TABLE `Courses_schedule` (
  `ID` int UNSIGNED NOT NULL,
  `ID_dateTimeClass` int UNSIGNED NOT NULL,
  `ID_organizedCourse` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Courses_schedule`
--

INSERT INTO `Courses_schedule` (`ID`, `ID_dateTimeClass`, `ID_organizedCourse`) VALUES
(84, 31, 116),
(85, 37, 116),
(94, 3, 117),
(95, 21, 117),
(96, 1, 115),
(97, 13, 115),
(98, 25, 115),
(101, 10, 119),
(102, 22, 119),
(104, 2, 121),
(105, 26, 121);

-- --------------------------------------------------------

--
-- Структура таблицы `Course_lessons`
--

CREATE TABLE `Course_lessons` (
  `ID` int UNSIGNED NOT NULL,
  `ID_course` int UNSIGNED NOT NULL,
  `ID_lesson` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Course_lessons`
--

INSERT INTO `Course_lessons` (`ID`, `ID_course`, `ID_lesson`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(65, 2, 3),
(66, 2, 5),
(67, 2, 7),
(68, 2, 8),
(69, 2, 10),
(70, 2, 11),
(71, 3, 3),
(72, 3, 8),
(75, 4, 4),
(76, 4, 6),
(77, 4, 5),
(78, 4, 11),
(79, 4, 7),
(80, 5, 6),
(81, 5, 10),
(82, 5, 11),
(83, 5, 4),
(86, 6, 3),
(87, 6, 6),
(88, 6, 13),
(125, 7, 1),
(126, 7, 2),
(127, 7, 20),
(128, 7, 3),
(129, 90, 6),
(130, 90, 8),
(131, 90, 9),
(132, 90, 10),
(133, 91, 3),
(134, 91, 7),
(135, 91, 8),
(136, 91, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `Course_rating`
--

CREATE TABLE `Course_rating` (
  `ID` int UNSIGNED NOT NULL,
  `ID_user` int UNSIGNED NOT NULL,
  `ID_course` int UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Course_rating`
--

INSERT INTO `Course_rating` (`ID`, `ID_user`, `ID_course`, `rating`) VALUES
(3, 1, 3, 5),
(4, 2, 1, 4),
(5, 3, 1, 5),
(25, 3, 2, 5),
(26, 3, 5, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `Course_registration`
--

CREATE TABLE `Course_registration` (
  `ID` int UNSIGNED NOT NULL,
  `ID_user` int UNSIGNED NOT NULL,
  `ID_organizedCourse` int UNSIGNED NOT NULL,
  `ID_status` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Course_registration`
--

INSERT INTO `Course_registration` (`ID`, `ID_user`, `ID_organizedCourse`, `ID_status`) VALUES
(106, 4, 115, 6),
(107, 3, 115, 6),
(110, 4, 117, 4),
(111, 10, 117, 4),
(112, 4, 119, 6),
(114, 3, 116, 4),
(115, 3, 117, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Course_review`
--

CREATE TABLE `Course_review` (
  `ID` int UNSIGNED NOT NULL,
  `ID_user` int UNSIGNED NOT NULL,
  `ID_course` int UNSIGNED NOT NULL,
  `reviewText` text COLLATE utf8mb4_general_ci NOT NULL,
  `reviewDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Course_review`
--

INSERT INTO `Course_review` (`ID`, `ID_user`, `ID_course`, `reviewText`, `reviewDateTime`) VALUES
(1, 1, 1, 'Я узнала для себя много нового и теперь уверена, что хочу стать визажистом! Спасибо преподавателям за чуткий подход и школе за прекрасно разработанную программу! Всем рекомендую пройти курс!', '2024-03-29 21:50:17'),
(2, 3, 1, 'Курсы порадовали обилием важных тем, которые я хотела освоить - здесь мы прошли и свадебный, и возрастной макияж. Спасибо нашим педагогам - они настоящие профессионалы в своём деле!', '2024-04-01 11:47:37'),
(3, 2, 1, 'Благодарю за прекрасный курс!', '2024-04-01 15:58:09');

-- --------------------------------------------------------

--
-- Структура таблицы `DateTime_class`
--

CREATE TABLE `DateTime_class` (
  `ID` int UNSIGNED NOT NULL,
  `day` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `time` time NOT NULL,
  `ID_groupType` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `DateTime_class`
--

INSERT INTO `DateTime_class` (`ID`, `day`, `time`, `ID_groupType`) VALUES
(1, 'Понедельник', '09:00:00', 3),
(2, 'Понедельник', '10:00:00', 3),
(3, 'Понедельник', '13:00:00', 4),
(4, 'Понедельник', '14:00:00', 4),
(5, 'Понедельник', '17:00:00', 5),
(6, 'Понедельник', '18:00:00', 5),
(7, 'Вторник', '09:00:00', 3),
(8, 'Вторник', '10:00:00', 3),
(9, 'Вторник', '13:00:00', 4),
(10, 'Вторник', '14:00:00', 4),
(11, 'Вторник', '17:00:00', 5),
(12, 'Вторник', '18:00:00', 5),
(13, 'Среда', '09:00:00', 3),
(14, 'Среда', '10:00:00', 3),
(15, 'Среда', '13:00:00', 4),
(16, 'Среда', '14:00:00', 4),
(17, 'Среда', '17:00:00', 5),
(18, 'Среда', '18:00:00', 5),
(19, 'Четверг', '09:00:00', 3),
(20, 'Четверг', '10:00:00', 3),
(21, 'Четверг', '13:00:00', 4),
(22, 'Четверг', '14:00:00', 4),
(23, 'Четверг', '17:00:00', 5),
(24, 'Четверг', '18:00:00', 5),
(25, 'Пятница', '09:00:00', 3),
(26, 'Пятница', '10:00:00', 3),
(27, 'Пятница', '13:00:00', 4),
(28, 'Пятница', '14:00:00', 4),
(29, 'Пятница', '17:00:00', 5),
(30, 'Пятница', '18:00:00', 5),
(31, 'Суббота', '09:00:00', 2),
(32, 'Суббота', '10:00:00', 2),
(33, 'Суббота', '13:00:00', 2),
(34, 'Суббота', '14:00:00', 2),
(35, 'Суббота', '17:00:00', 2),
(36, 'Суббота', '18:00:00', 2),
(37, 'Воскресенье', '09:00:00', 2),
(38, 'Воскресенье', '10:00:00', 2),
(39, 'Воскресенье', '13:00:00', 2),
(40, 'Воскресенье', '14:00:00', 2),
(41, 'Воскресенье', '17:00:00', 2),
(42, 'Воскресенье', '18:00:00', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Discount`
--

CREATE TABLE `Discount` (
  `ID` int UNSIGNED NOT NULL,
  `countLessons` int UNSIGNED NOT NULL,
  `discountPercent` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Discount`
--

INSERT INTO `Discount` (`ID`, `countLessons`, `discountPercent`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 4),
(4, 4, 5),
(9, 5, 7),
(10, 10, 10),
(13, 12, 12),
(14, 15, 15),
(15, 20, 20),
(16, 25, 25),
(17, 50, 50),
(18, 50, 50);

-- --------------------------------------------------------

--
-- Структура таблицы `Group_type`
--

CREATE TABLE `Group_type` (
  `ID` int UNSIGNED NOT NULL,
  `groupType` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `priceCoefficient` double NOT NULL,
  `groupSize` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Group_type`
--

INSERT INTO `Group_type` (`ID`, `groupType`, `priceCoefficient`, `groupSize`) VALUES
(1, 'Индивидуальное обучение', 1.6, 1),
(2, 'Выходного дня', 1.3, 7),
(3, 'Утренняя', 1.1, 7),
(4, 'Дневная', 1.2, 7),
(5, 'Вечерняя', 1.15, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `Lesson`
--

CREATE TABLE `Lesson` (
  `ID` int UNSIGNED NOT NULL,
  `title` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lessonMaterial` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `homeworkTask` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Lesson`
--

INSERT INTO `Lesson` (`ID`, `title`, `description`, `photo`, `lessonMaterial`, `homeworkTask`, `isActive`) VALUES
(1, 'Цвет и форма', 'Основы цвета в макияже: цветовой круг, законы цвета и применение их в профессии.Директивный способ определения цветоколорита внешности.Анатомия в макияже: строение, типы и состояния кожи.Кости лица, лицевые мышцы.Пропорции лица: формы лица и способы их коррекции; доминирующая область лица.Линейный ритм в макияже.Классификации форм и видов глаз; терминология.Построение формы глаз в макияже', 'color_and_form.jpg', 'guide-color-and-form.pdf', 'hw-color-and-form.pdf', 0),
(2, 'Формы глаз', 'Работа с разными формами и типами глаз:  с нависшим веком,  с щелевидными и круглыми глазами,  с плоским и очень рельефным веком,  с выпуклыми глазами и глубоко посаженными глазами,  с маленьким подвижным веком,  с асимметричными глазами по разным признакам,  с падающими глазами,  с близко посаженными и широко расставленными глазами.Различные техники в постановке ресниц.', 'hw-eyes-form.jpg', 'guide-eyes-form.pdf', 'hw-eyes-form.pdf', 1),
(3, 'Нюдовый макияж', 'Философия и актуальность нюдового макияжа. \nСвето-теневой рисунок лица. \nОсновные принципы подготовки и тонирования кожи. \nОсновы скульптурирования лица.\nОсобенности работы с проблемной кожей. \nЦветовая гамма и классические правила натурального макияжа. \nДемонстрация и отработка', 'nude_makeup.jpg', 'guide-nude-makeup.pdf', 'hw-nude-makeup.pdf', 1),
(4, 'Коммерческий макияж', 'Алгоритм построения классической вертикальной схемы в макияже глаз: точки интенсивности и направления растушёвки.\nУсложненные и классические коррекционные схемы постановки ресниц.\nЦветовая гамма и интенсивность\nкоммерческого макияжа.\nДемонстрация и отработка', 'commercial_makeup.jpg', 'guide-commercial-makeup.pdf', 'hw-commercial-makeup.pdf', 1),
(5, 'Свадебный макияж', 'Технические особенности работы с невестой.\nПсихологические аспекты работы с невестой.\nФилософия, цветовая гама и интенсивность свадебного макияжа.\nДемонстрация и отработка', 'wedding_makeup.jpg', 'guide-wedding-makeup.pdf', 'hw-wedding-makeup.pdf', 1),
(6, 'Макияж \"кошачий глаз\"', 'Последовательность, инструменты и принципы построения растушеванной стрелки.\r\nПреимущества и недостатки использования различных продуктов для ее построения.\r\nОсновные ошибки в макияже с растушеванной стрелкой.\r\nДемонстрация и отработка', 'cat_eyes_makeup.jpg', 'guide-cat-eyes-makeup.pdf', 'hw-cat-eyes-makeup.pdf', 1),
(7, 'Лифтинг макияж', 'Перечень возрастных изменений и способы работы с ними.\nПсихологические аспекты работы с дамами элегантного возраста.\nТекстуры, стойкость, температура и насыщенность в лифтинг- макияже.\nРабота с возрастной кожей и возрастным веком.\nДемонстрация и отработка', 'lifting_makeup.jpg', 'guide-lifting-makeup.pdf', 'hw-lifting-makeup.pdf', 1),
(8, 'Вечерний макияж', 'Цветовая гамма и интенсивность вечернего макияжа.\r\nМакияж как заключительный аксессуар образа (как правильно его сочетать с одеждой, обувью, аксессуарами, прической).\r\nОсобенности работы со стойкими текстурами. \r\nРабота с пигментами, спарклами, слюдой.\r\nДемонстрация и отработка', 'night_makeup.jpg', 'guide-night-makeup.pdf', 'hw-night-makeup.pdf', 1),
(9, 'Голливудский макияж', 'Правила построения классической стрелки.\nПравила \"чистого макияжа\".\nПостроение формы губ под их тип и коррекция. \nТехника увеличения губ.\nСоздание сочных и ярких губ.\nДемонстрация и отработка', 'hollywood_makeup.jpg', 'guide-hollywood-makeup.pdf', 'hw-hollywood-makeup.pdf', 1),
(10, 'Смоки-айз', 'Работа с плотными матовыми текстурами.\nКлассический дымчатый смоки. Секрет идеальной бархатной кожи. Секреты яркости и стойкости этого сложного образа. Демонстрация и отработка', 'smocky_eyes_makeup.jpg', 'guide-smocky-eyes-makeup.pdf', 'hw-smocky-eyes-makeup.pdf', 1),
(11, 'Цветной макияж', 'Основные правила работы с цветом. \nПравила \"чистого макияжа\". \nСпособы сочетания цветов.\nДемонстрация и отработка', 'color_makeup.jpg', 'guide-color-makeup.pdf', 'hw-color-makeup.pdf', 1),
(12, 'Деловой макияж', 'Основы делового макияжа. Ровный тон и подбор оттенка помады по типу кожи. Секрет престижного дорогого макияжа. Демонстрация и отработка', 'business_makeup.jpg', 'guide-business-makeup.pdf', 'hw-business-makeup.pdf', 1),
(13, 'Неоновый макияж', 'Подбор неоновых средств. Стойкий макияж. Демонстрация и отработка', 'neon_makeup.jpg', 'guide-neon-makeup.pdf', 'hw-neon-makeup.pdf', 0),
(18, 'Нестандартные стрелки', 'Сложные стрелки различных форм. Использование различных типов подводок. Стрелки с помощью теней. Украшение стрелок с помощью дополнительных декоративных элементов. Демонстрация и отработка', 'unusual_eyes.jpg', 'guide-unusual-eyes.pdf', 'hw-unusual-eyes.pdf', 1),
(20, 'Подбор персональной косметички', 'Подбор тональной основы. Подбор кремовых и сухих текстур под индивидуальный запрос', 'eb25b2d5af1d66f4f0f37ba3f7533b32.jpg', 'guide-personal-cosmetics.pdf', 'eb25b2d5af1d66f4f0f37ba3f7533b32.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Lesson_progress`
--

CREATE TABLE `Lesson_progress` (
  `ID` int UNSIGNED NOT NULL,
  `ID_courseLesson` int UNSIGNED NOT NULL,
  `ID_organizedCourse` int UNSIGNED NOT NULL,
  `isChecked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Lesson_progress`
--

INSERT INTO `Lesson_progress` (`ID`, `ID_courseLesson`, `ID_organizedCourse`, `isChecked`) VALUES
(138, 1, 115, 1),
(139, 2, 115, 1),
(140, 3, 115, 1),
(141, 4, 115, 1),
(142, 5, 115, 1),
(143, 6, 115, 1),
(144, 7, 115, 1),
(145, 9, 115, 1),
(146, 10, 115, 1),
(147, 11, 115, 1),
(148, 75, 116, 0),
(149, 76, 116, 0),
(150, 77, 116, 0),
(151, 78, 116, 0),
(152, 79, 116, 0),
(153, 86, 117, 0),
(154, 87, 117, 0),
(155, 88, 117, 0),
(166, 129, 119, 1),
(167, 130, 119, 1),
(168, 131, 119, 1),
(169, 132, 119, 1),
(174, 80, 121, 1),
(175, 81, 121, 0),
(176, 82, 121, 0),
(177, 83, 121, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Liked_course`
--

CREATE TABLE `Liked_course` (
  `ID` int UNSIGNED NOT NULL,
  `ID_user` int UNSIGNED NOT NULL,
  `ID_course` int UNSIGNED NOT NULL,
  `isLike` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Master`
--

CREATE TABLE `Master` (
  `ID` int UNSIGNED NOT NULL,
  `ID_user` int UNSIGNED NOT NULL,
  `info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Master`
--

INSERT INTO `Master` (`ID`, `ID_user`, `info`) VALUES
(3, 5, 'Мастер-визажист с более чем десятилетним опытом. Мои уроки известны своей информативностью и точным руководством. Терпеливо объясню даже самые сложные техники и помогу освоить искусство макияжа шаг за шагом!!!!!.'),
(11, 8, 'Опыт работы 8 лет в области визажа. Обожаю свою работу и научу её любить вас! '),
(28, 12, 'Я-талантливый и опытный визажист, который обладает не только профессиональными навыками, но и педагогическим талантом. Мой педагогический стиль сочетает профессионализм с индивидуальным подходом к каждому студенту, что делает процесс обучения увлекательным и результативным.'),
(29, 11, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `Master_request`
--

CREATE TABLE `Master_request` (
  `ID` int UNSIGNED NOT NULL,
  `ID_user` int UNSIGNED NOT NULL,
  `telephone` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `portfolio` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Master_request`
--

INSERT INTO `Master_request` (`ID`, `ID_user`, `telephone`, `portfolio`) VALUES
(25, 4, '+375 (29) 666-43-43', 'portfolio+375 (29) 666-43-43screenshot008.png');

-- --------------------------------------------------------

--
-- Структура таблицы `Menu`
--

CREATE TABLE `Menu` (
  `ID` int UNSIGNED NOT NULL,
  `title` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `path` varchar(64) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Menu`
--

INSERT INTO `Menu` (`ID`, `title`, `path`) VALUES
(1, 'Преподаватели', '\\masters.php'),
(2, 'Каталог курсов', '\\catalog.php'),
(3, 'Расписание', '\\course_schedule.php'),
(4, 'Контакты', '\\contacts.php');

-- --------------------------------------------------------

--
-- Структура таблицы `Organized_course`
--

CREATE TABLE `Organized_course` (
  `ID` int UNSIGNED NOT NULL,
  `ID_course` int UNSIGNED NOT NULL,
  `ID_master` int UNSIGNED DEFAULT NULL,
  `ID_groupType` int UNSIGNED NOT NULL,
  `startDate` date DEFAULT NULL,
  `isEnded` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Organized_course`
--

INSERT INTO `Organized_course` (`ID`, `ID_course`, `ID_master`, `ID_groupType`, `startDate`, `isEnded`) VALUES
(115, 1, 3, 3, '2024-05-09', 1),
(116, 4, 3, 2, '2024-06-30', 0),
(117, 6, 28, 4, '2024-06-12', 0),
(119, 90, 3, 1, '2024-04-20', 1),
(121, 5, 3, 3, '2024-06-21', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Status`
--

CREATE TABLE `Status` (
  `ID` int UNSIGNED NOT NULL,
  `status` varchar(64) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Status`
--

INSERT INTO `Status` (`ID`, `status`) VALUES
(1, 'заявка отправлена'),
(2, 'заявка подтверждена'),
(3, 'заявка отклонена'),
(4, 'оплачено'),
(5, 'курс активен'),
(6, 'курс пройден'),
(7, 'обучение прервано');

-- --------------------------------------------------------

--
-- Структура таблицы `Status_consultation`
--

CREATE TABLE `Status_consultation` (
  `ID` int UNSIGNED NOT NULL,
  `status` varchar(64) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Status_consultation`
--

INSERT INTO `Status_consultation` (`ID`, `status`) VALUES
(1, 'заявка на консультацию подана'),
(2, 'повторная консультация'),
(3, 'консультация совершена');

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `ID` int UNSIGNED NOT NULL,
  `name` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'default_profile_photo.jpg',
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `salt` int NOT NULL,
  `userType` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`ID`, `name`, `telephone`, `email`, `photo`, `password`, `salt`, `userType`) VALUES
(1, 'Ekaterina', '+375 (29) 653-23-35', 'e_voits@gmail.com', 'kate.jpg', '6d23acc2e23f8a648d35e05309e01662', 219, 'admin'),
(2, 'Ирина', '+375 (29) 666-66-66', 'Irina@gmail.com', '17173348061b2589e306524908532cbd1950bd021d.jpg', 'f5dca828945336c686b669dbf55e93a7', 735, 'user'),
(3, 'Ева', '+375 (29) 543-34-22', 'eva@gmail.com', '556e966cf2fc58bea5c1b72026d3972a.jpg', '6d1082eada22aed1fe5132457b59420a', 993, 'user'),
(4, 'Анна', '+375 (29) 666-43-43', 'anna@gmail.com', '171734057044e4254405cf66b6ff1fda1bedacdc8b.jpg', '618a901d08791b3fc0dfe8489bdd9b1b', 925, 'user'),
(5, 'Арина', '+375 (29) 544-32-23', 'arina@gmail.com', '171733497115f5bcbbf70fb6838090a1c0feb3bc3d.jpg', '32ec44f141de0456c827311722815ac6', 833, 'master'),
(8, 'Анастасия', '+375 (29) 433-23-43', 'nasty@gmail.com', 'e3a7809b2a6e84de723bb43aeee52447.jpg', '10c4133a9742c3fa9244d3d4ec18d3e2', 542, 'master'),
(10, 'Светлана', '+375 (29) 543-23-33', 'Sveta@gmail.com', '1717334671b6010a77c4c540b0243668c1e2cb4157.jpg', '4e5fb8390191daeb01acd0fc9d4e11d2', 676, 'user'),
(11, 'Екатерина', '+375 (29) 653-23-35', 'kate06042003@gmail.com', '1717098185AirBrush_20190817231806.jpg', 'c958d9fd6fafd22e37f92f5aa22b3dc4', 586, 'user'),
(12, 'Илона', '+375 (44) 398-27-23', 'Ilona@gmail.com', '8165dd173ebb7e68b9e95043f36acd86.jpg', 'e9ec3191315db7de14aa37b1b53888f2', 641, 'master');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Consultation`
--
ALTER TABLE `Consultation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `consultation_ibfk_1` (`ID_status`);

--
-- Индексы таблицы `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Индексы таблицы `Courses_schedule`
--
ALTER TABLE `Courses_schedule`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_dateTimeClass` (`ID_dateTimeClass`),
  ADD KEY `ID_organizedCourse` (`ID_organizedCourse`);

--
-- Индексы таблицы `Course_lessons`
--
ALTER TABLE `Course_lessons`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_course` (`ID_course`),
  ADD KEY `ID_lesson` (`ID_lesson`);

--
-- Индексы таблицы `Course_rating`
--
ALTER TABLE `Course_rating`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_course` (`ID_course`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Индексы таблицы `Course_registration`
--
ALTER TABLE `Course_registration`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_organizedCourse` (`ID_organizedCourse`),
  ADD KEY `ID_status` (`ID_status`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Индексы таблицы `Course_review`
--
ALTER TABLE `Course_review`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_course` (`ID_course`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Индексы таблицы `DateTime_class`
--
ALTER TABLE `DateTime_class`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_groupType` (`ID_groupType`);

--
-- Индексы таблицы `Discount`
--
ALTER TABLE `Discount`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `Group_type`
--
ALTER TABLE `Group_type`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `Lesson`
--
ALTER TABLE `Lesson`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `Lesson_progress`
--
ALTER TABLE `Lesson_progress`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_organizedCourse` (`ID_organizedCourse`),
  ADD KEY `lesson_progress_ibfk_1` (`ID_courseLesson`);

--
-- Индексы таблицы `Liked_course`
--
ALTER TABLE `Liked_course`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_course` (`ID_course`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Индексы таблицы `Master`
--
ALTER TABLE `Master`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Индексы таблицы `Master_request`
--
ALTER TABLE `Master_request`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Индексы таблицы `Menu`
--
ALTER TABLE `Menu`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `Organized_course`
--
ALTER TABLE `Organized_course`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_course` (`ID_course`),
  ADD KEY `ID_groupType` (`ID_groupType`),
  ADD KEY `ID_master` (`ID_master`);

--
-- Индексы таблицы `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `Status_consultation`
--
ALTER TABLE `Status_consultation`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Consultation`
--
ALTER TABLE `Consultation`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `Course`
--
ALTER TABLE `Course`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT для таблицы `Courses_schedule`
--
ALTER TABLE `Courses_schedule`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT для таблицы `Course_lessons`
--
ALTER TABLE `Course_lessons`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT для таблицы `Course_rating`
--
ALTER TABLE `Course_rating`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `Course_registration`
--
ALTER TABLE `Course_registration`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT для таблицы `Course_review`
--
ALTER TABLE `Course_review`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `DateTime_class`
--
ALTER TABLE `DateTime_class`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `Discount`
--
ALTER TABLE `Discount`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `Group_type`
--
ALTER TABLE `Group_type`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `Lesson`
--
ALTER TABLE `Lesson`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `Lesson_progress`
--
ALTER TABLE `Lesson_progress`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT для таблицы `Liked_course`
--
ALTER TABLE `Liked_course`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Master`
--
ALTER TABLE `Master`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `Master_request`
--
ALTER TABLE `Master_request`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `Menu`
--
ALTER TABLE `Menu`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Organized_course`
--
ALTER TABLE `Organized_course`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT для таблицы `Status`
--
ALTER TABLE `Status`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `Status_consultation`
--
ALTER TABLE `Status_consultation`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `User`
--
ALTER TABLE `User`
  MODIFY `ID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Consultation`
--
ALTER TABLE `Consultation`
  ADD CONSTRAINT `consultation_ibfk_1` FOREIGN KEY (`ID_status`) REFERENCES `Status_consultation` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `User` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Courses_schedule`
--
ALTER TABLE `Courses_schedule`
  ADD CONSTRAINT `courses_schedule_ibfk_1` FOREIGN KEY (`ID_dateTimeClass`) REFERENCES `DateTime_class` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `courses_schedule_ibfk_2` FOREIGN KEY (`ID_organizedCourse`) REFERENCES `Organized_course` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Course_lessons`
--
ALTER TABLE `Course_lessons`
  ADD CONSTRAINT `course_lessons_ibfk_1` FOREIGN KEY (`ID_course`) REFERENCES `Course` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `course_lessons_ibfk_2` FOREIGN KEY (`ID_lesson`) REFERENCES `Lesson` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Course_rating`
--
ALTER TABLE `Course_rating`
  ADD CONSTRAINT `course_rating_ibfk_1` FOREIGN KEY (`ID_course`) REFERENCES `Course` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `course_rating_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `User` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Course_registration`
--
ALTER TABLE `Course_registration`
  ADD CONSTRAINT `course_registration_ibfk_1` FOREIGN KEY (`ID_organizedCourse`) REFERENCES `Organized_course` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `course_registration_ibfk_2` FOREIGN KEY (`ID_status`) REFERENCES `Status` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `course_registration_ibfk_3` FOREIGN KEY (`ID_user`) REFERENCES `User` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Course_review`
--
ALTER TABLE `Course_review`
  ADD CONSTRAINT `course_review_ibfk_1` FOREIGN KEY (`ID_course`) REFERENCES `Course` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `course_review_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `User` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `DateTime_class`
--
ALTER TABLE `DateTime_class`
  ADD CONSTRAINT `datetime_class_ibfk_1` FOREIGN KEY (`ID_groupType`) REFERENCES `Group_type` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Lesson_progress`
--
ALTER TABLE `Lesson_progress`
  ADD CONSTRAINT `lesson_progress_ibfk_1` FOREIGN KEY (`ID_courseLesson`) REFERENCES `Course_lessons` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lesson_progress_ibfk_2` FOREIGN KEY (`ID_organizedCourse`) REFERENCES `Organized_course` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Liked_course`
--
ALTER TABLE `Liked_course`
  ADD CONSTRAINT `liked_course_ibfk_1` FOREIGN KEY (`ID_course`) REFERENCES `Course` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `liked_course_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `User` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Master`
--
ALTER TABLE `Master`
  ADD CONSTRAINT `master_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `User` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Master_request`
--
ALTER TABLE `Master_request`
  ADD CONSTRAINT `master_request_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `User` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Organized_course`
--
ALTER TABLE `Organized_course`
  ADD CONSTRAINT `organized_course_ibfk_1` FOREIGN KEY (`ID_course`) REFERENCES `Course` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `organized_course_ibfk_2` FOREIGN KEY (`ID_groupType`) REFERENCES `Group_type` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `organized_course_ibfk_3` FOREIGN KEY (`ID_master`) REFERENCES `Master` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
