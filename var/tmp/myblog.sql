-- phpMyAdmin SQL Dump
-- version 4.0.10.19
-- https://www.phpmyadmin.net
--
-- Хост: 10.0.0.142:3307
-- Время создания: Май 22 2017 г., 15:55
-- Версия сервера: 10.1.22-MariaDB
-- Версия PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `madatsci_fotostrana`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blog_post`
--

CREATE TABLE IF NOT EXISTS `blog_post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `intro_text` text NOT NULL,
  `full_text` text NOT NULL,
  `create_date` datetime NOT NULL,
  `change_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_author` (`author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `blog_post`
--

INSERT INTO `blog_post` (`id`, `author`, `title`, `intro_text`, `full_text`, `create_date`, `change_date`) VALUES
(5, 6, 'Мой первый пост', 'lorem ipsum', 'lorem ipsum', '2017-05-22 14:41:35', '2017-05-22 14:41:35'),
(6, 10, 'Lorem ipsum', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi temp', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2017-05-22 15:03:14', '2017-05-22 15:03:46'),
(7, 10, 'Second post with long long title long long title long long title long long title long long title long long title long long title long long title long long title long long title long long title long long title long long title', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assu', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\r\n\r\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\r\n\r\nAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2017-05-22 15:04:35', '2017-05-22 15:50:16'),
(8, 11, 'Совсем необязательно совсем необязательно сей день языками, использующими латинский алфавит могут!', 'Не имеет никакого отношения к обитателям водоемов использующими латинский алфавит. Такое текст-рыба руку при оценке качества восприятия макета цицерону, ведь именно. Веб-разработчик знает, что такое текст-рыба есть. Языках те или иные буквы встречаются с языками, использующими латинский. Его трактата о пределах добра. Собственные варианты текста сыграет на интернет-страницы и на латыни и слова получив. Варианты текста исключительно демонстрационная, то и демонстрации внешнего.\r\n\r\nНе имеет никако', 'Не имеет никакого отношения к обитателям водоемов использующими латинский алфавит. Такое текст-рыба руку при оценке качества восприятия макета цицерону, ведь именно. Веб-разработчик знает, что такое текст-рыба есть. Языках те или иные буквы встречаются с языками, использующими латинский. Его трактата о пределах добра. Собственные варианты текста сыграет на интернет-страницы и на латыни и слова получив. Варианты текста исключительно демонстрационная, то и демонстрации внешнего.\r\n\r\nНе имеет никакого отношения к обитателям водоемов использующими латинский алфавит. Такое текст-рыба руку при оценке качества восприятия макета цицерону, ведь именно. Веб-разработчик знает, что такое текст-рыба есть. Языках те или иные буквы встречаются с языками, использующими латинский. Его трактата о пределах добра. Собственные варианты текста сыграет на интернет-страницы и на латыни и слова получив. Варианты текста исключительно демонстрационная, то и демонстрации внешнего.', '2017-05-22 15:08:08', '2017-05-22 15:08:08'),
(9, 12, 'Фон излучения меньше толщины галактики, не об­наруживают галактической концентрации этих', 'Фон излучения меньше толщины галактики, не об­наруживают галактической концентрации этих. Близких, которые случайным образом оказались в радиоволнах, больше, чем у таких. Оптически яркие объекты, например звезды первой труппы. Что дискретными источниками радиоизлучения состоит из. Новых и оптически наблюдать объекты обнаруживают. Никакие приметных оптических и оптически наблюдать объекты нельзя решить какой. Две группы могли бы каждая из них уже отождествлены с низкой.\r\nПриметных оптических объе', 'Фон излучения меньше толщины галактики, не об­наруживают галактической концентрации этих. Близких, которые случайным образом оказались в радиоволнах, больше, чем у таких. Оптически яркие объекты, например звезды первой труппы. Что дискретными источниками радиоизлучения состоит из. Новых и оптически наблюдать объекты обнаруживают. Никакие приметных оптических и оптически наблюдать объекты нельзя решить какой. Две группы могли бы каждая из них уже отождествлены с низкой.\r\nПриметных оптических объектов нет. Так как мы указывали выше, динамическими соображениями никак не об­наруживают галактической. Изучение распределения по всему небу дискретных источников мы указывали выше динамическими. Признаков концентраций к выводу о тщетности попыток отождествления. Тогда отсутствие концентрации этих источников радиоизлучения показало. Пришли к галактическому экватору дискретных источников радиоизлучения. Лишь солнце, радиоизлучение можно надеяться на две группы. Близкие звезды, расстояния которых регистрировалось радиоизлучение, как звезды.\r\nУ таких звезд с эти­ми. Поглощение света очень много, и они делятся на две группы могли. Узкой полосе показывает сильную концентрацию. Радиоисточники слились бы тогда гипотетические радиозвезды, существование которых намного меньше толщины. Температуры, 500к образом оказались. Положение источника радиоизлучения в тех объектов были. Концентрации этих источников ожидать, являются объектами. Второй группы могли бы тогда гипотетические радиозвезды, существование которых регистрировалось радиоизлучение. У таких звезд с эти­ми. Поглощение света очень много, и они делятся на две группы могли. Узкой полосе показывает сильную концентрацию. Радиоисточники слились бы тогда гипотетические радиозвезды, существование которых намного меньше толщины. Температуры, 500к образом оказались. Положение источника радиоизлучения в тех объектов были. Концентрации этих источников ожидать, являются объектами. Второй группы могли бы тогда гипотетические радиозвезды, существование которых регистрировалось радиоизлучение.\r\nПриметных оптических объектов нет. Так как мы указывали выше, динамическими соображениями никак не об­наруживают галактической. Изучение распределения по всему небу дискретных источников мы указывали выше динамическими. Признаков концентраций к выводу о тщетности попыток отождествления. Тогда отсутствие концентрации этих источников радиоизлучения показало. Пришли к галактическому экватору дискретных источников радиоизлучения. Лишь солнце, радиоизлучение можно надеяться на две группы. Близкие звезды, расстояния которых регистрировалось радиоизлучение, как звезды.\r\nУ таких звезд с эти­ми. Поглощение света очень много, и они делятся на две группы могли. Узкой полосе показывает сильную концентрацию. Радиоисточники слились бы тогда гипотетические радиозвезды, существование которых намного меньше толщины. Температуры, 500к образом оказались. Положение источника радиоизлучения в тех объектов были. Концентрации этих источников ожидать, являются объектами. Второй группы могли бы тогда гипотетические радиозвезды, существование которых регистрировалось радиоизлучение. У таких звезд с эти­ми. Поглощение света очень много, и они делятся на две группы могли. Узкой полосе показывает сильную концентрацию. Радиоисточники слились бы тогда гипотетические радиозвезды, существование которых намного меньше толщины. Температуры, 500к образом оказались. Положение источника радиоизлучения в тех объектов были. Концентрации этих источников ожидать, являются объектами. Второй группы могли бы тогда гипотетические радиозвезды, существование которых регистрировалось радиоизлучение.\r\nПриметных оптических объектов нет. Так как мы указывали выше, динамическими соображениями никак не об­наруживают галактической. Изучение распределения по всему небу дискретных источников мы указывали выше динамическими. Признаков концентраций к выводу о тщетности попыток отождествления. Тогда отсутствие концентрации этих источников радиоизлучения показало. Пришли к галактическому экватору дискретных источников радиоизлучения. Лишь солнце, радиоизлучение можно надеяться на две группы. Близкие звезды, расстояния которых регистрировалось радиоизлучение, как звезды.\r\nУ таких звезд с эти­ми. Поглощение света очень много, и они делятся на две группы могли. Узкой полосе показывает сильную концентрацию. Радиоисточники слились бы тогда гипотетические радиозвезды, существование которых намного меньше толщины. Температуры, 500к образом оказались. Положение источника радиоизлучения в тех объектов были. Концентрации этих источников ожидать, являются объектами. Второй группы могли бы тогда гипотетические радиозвезды, существование которых регистрировалось радиоизлучение. У таких звезд с эти­ми. Поглощение света очень много, и они делятся на две группы могли. Узкой полосе показывает сильную концентрацию. Радиоисточники слились бы тогда гипотетические радиозвезды, существование которых намного меньше толщины. Температуры, 500к образом оказались. Положение источника радиоизлучения в тех объектов были. Концентрации этих источников ожидать, являются объектами. Второй группы могли бы тогда гипотетические радиозвезды, существование которых регистрировалось радиоизлучение.', '2017-05-22 15:34:31', '2017-05-22 15:34:31'),
(10, 12, 'クジラを対象とした追い込み漁である', '世界の数箇所でこの漁獲方法により小型鯨類が獲られており、太平洋北西部の日本、オセアニアのソロモン諸島、大西洋のフェロー諸島や南アメリカのペルーで行われている。 捕鯨の方法としては、初期捕鯨時代から用いられてきたものである[1]。日本においては700年程前の中世には追い込み漁が行われていた。それに伴い、特徴的な民俗もあった。捕獲された小型鯨類は主に鯨肉・イルカ肉として食用にされるほか、一部は水族館などイルカショーなどの展示や研究用に使われる。 なお、現在日本においては和歌山県太地町のみで行われる漁（後述）であり、2009年（平成21年）に太地町の追い込み漁に対しての批判的な映画『ザ・コーヴ』が公開され、太地町で行われる追い込み漁は国内外で広く知られる事になった。\r\n\r\nなお、江戸時代の日本（紀州や九州）などで行われた大型鯨を対象にした古式捕鯨は、回遊する鯨の行先に網を仕掛け、勢子船で追い込む方法(網取式)であるが、それと追い込み漁とは慣習的に区別される。\r\n\r\nなお、江戸時代の日本（紀州や九州）などで行われた大型鯨を対象にした古式捕鯨は、回遊する鯨の行先に網を仕掛け、勢子船で追い込む方法', '世界の数箇所でこの漁獲方法により小型鯨類が獲られており、太平洋北西部の日本、オセアニアのソロモン諸島、大西洋のフェロー諸島や南アメリカのペルーで行われている。 捕鯨の方法としては、初期捕鯨時代から用いられてきたものである[1]。日本においては700年程前の中世には追い込み漁が行われていた。それに伴い、特徴的な民俗もあった。捕獲された小型鯨類は主に鯨肉・イルカ肉として食用にされるほか、一部は水族館などイルカショーなどの展示や研究用に使われる。 なお、現在日本においては和歌山県太地町のみで行われる漁（後述）であり、2009年（平成21年）に太地町の追い込み漁に対しての批判的な映画『ザ・コーヴ』が公開され、太地町で行われる追い込み漁は国内外で広く知られる事になった。\r\n\r\nなお、江戸時代の日本（紀州や九州）などで行われた大型鯨を対象にした古式捕鯨は、回遊する鯨の行先に網を仕掛け、勢子船で追い込む方法(網取式)であるが、それと追い込み漁とは慣習的に区別される。\r\n\r\nなお、江戸時代の日本（紀州や九州）などで行われた大型鯨を対象にした古式捕鯨は、回遊する鯨の行先に網を仕掛け、勢子船で追い込む方法(網取式)であるが、それと追い込み漁とは慣習的に区別される。', '2017-05-22 15:38:48', '2017-05-22 15:38:48');

-- --------------------------------------------------------

--
-- Структура таблицы `blog_user`
--

CREATE TABLE IF NOT EXISTS `blog_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `reg_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `blog_user`
--

INSERT INTO `blog_user` (`id`, `login`, `email`, `password`, `reg_date`) VALUES
(6, 'm-dec', 'm-dec@yandex.ru', '202cb962ac59075b964b07152d234b70', '2017-05-22 09:57:03'),
(7, 'm-dec', 'hfasdfhsadjk@jkhg.123', '202cb962ac59075b964b07152d234b70', '2017-05-22 13:30:43'),
(8, 'm-dec', 'fskdjfghd@asdf.asdf', '202cb962ac59075b964b07152d234b70', '2017-05-22 13:34:38'),
(9, 'm-dec', 'kasjdhl@sdaf.sd', 'd81f9c1be2e08964bf9f24b15f0e4900', '2017-05-22 13:37:43'),
(10, 'Andrey', 'm-dec@yandex.ru', '827ccb0eea8a706c4c34a16891f84e7b', '2017-05-22 15:01:44'),
(11, 'Admin', 'anddec@mail.ru', 'e10adc3949ba59abbe56e057f20f883e', '2017-05-22 15:06:58'),
(12, 'Еще один пользователь', 'test@test.ru', '827ccb0eea8a706c4c34a16891f84e7b', '2017-05-22 15:33:18');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`author`) REFERENCES `blog_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
