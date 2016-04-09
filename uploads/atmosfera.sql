-- phpMyAdmin SQL Dump
-- version home.pl
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 01 Kwi 2016, 15:04
-- Wersja serwera: 5.5.44-37.3-log
-- Wersja PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `14718417_test33`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktualnosci_folder`
--

CREATE TABLE IF NOT EXISTS `aktualnosci_folder` (
  `id_folder` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_rodzic` int(5) unsigned DEFAULT NULL,
  `sort` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_folder`),
  KEY `aktualnosci_folder_id_rodzic_FK` (`id_rodzic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `aktualnosci_folder`
--

INSERT INTO `aktualnosci_folder` (`id_folder`, `id_rodzic`, `sort`) VALUES
(1, NULL, 1),
(2, NULL, 2),
(3, NULL, 3),
(4, NULL, 4),
(5, NULL, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktualnosci_folder_nazwa`
--

CREATE TABLE IF NOT EXISTS `aktualnosci_folder_nazwa` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_folder` int(5) unsigned DEFAULT NULL,
  `id_lang` int(1) unsigned DEFAULT NULL,
  `nazwa_folder` varchar(255) DEFAULT NULL,
  `widok_lang` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `aktualnosci_folder_nazwa_id_folder_FK` (`id_folder`),
  KEY `aktualnosci_folder_nazwa_id_lang_FK` (`id_lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `aktualnosci_folder_nazwa`
--

INSERT INTO `aktualnosci_folder_nazwa` (`id`, `id_folder`, `id_lang`, `nazwa_folder`, `widok_lang`) VALUES
(1, 1, 1, 'Aktualności', 'checked'),
(2, 2, 1, 'Zastępstwa', 'checked'),
(3, 3, 1, 'Przyjaciele atmosfery', 'checked'),
(4, 4, 1, 'Instruktorzy', 'checked'),
(5, 5, 1, 'Treningi', 'checked');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktualnosci_nazwa`
--

CREATE TABLE IF NOT EXISTS `aktualnosci_nazwa` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_trzon` int(5) unsigned DEFAULT NULL,
  `id_lang` int(1) unsigned DEFAULT NULL,
  `naglowek` varchar(255) DEFAULT NULL,
  `id_zdjecie_1` int(5) unsigned DEFAULT NULL,
  `rozmiar_1` tinyint(1) unsigned DEFAULT NULL,
  `tresc` text,
  `nazwa_wiecej` varchar(255) DEFAULT NULL,
  `http` varchar(255) DEFAULT NULL,
  `http_target` varchar(10) NOT NULL DEFAULT '_self',
  `tytul_strony` varchar(255) DEFAULT NULL,
  `opis_szukanie` text,
  `slowa_kluczowe` varchar(255) DEFAULT NULL,
  `link_htaccess` varchar(255) DEFAULT NULL,
  `widok_lang` varchar(8) NOT NULL DEFAULT '',
  `seo_text` text,
  `dzien_tygodnia` tinyint(1) unsigned DEFAULT NULL,
  `czas_trwania` tinyint(5) unsigned DEFAULT NULL,
  `godzina_rozpoczecia` time DEFAULT NULL,
  `id_type` int(5) unsigned DEFAULT NULL,
  `id_room` int(5) unsigned DEFAULT NULL,
  `id_instructor` int(5) unsigned DEFAULT NULL,
  `id_region` int(5) unsigned DEFAULT NULL,
  `id_poziom_zaawansowania` int(5) unsigned DEFAULT NULL,
  `zawod_nazwa` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aktualnosci_nazwa_id_lang_FK` (`id_lang`),
  KEY `aktualnosci_nazwa_id_trzon_FK` (`id_trzon`),
  KEY `aktualnosci_id_type_FK` (`id_type`),
  KEY `aktualnosci_id_room_FK` (`id_room`),
  KEY `aktualnosci_id_instructor_FK` (`id_instructor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=122 ;

--
-- Zrzut danych tabeli `aktualnosci_nazwa`
--

INSERT INTO `aktualnosci_nazwa` (`id`, `id_trzon`, `id_lang`, `naglowek`, `id_zdjecie_1`, `rozmiar_1`, `tresc`, `nazwa_wiecej`, `http`, `http_target`, `tytul_strony`, `opis_szukanie`, `slowa_kluczowe`, `link_htaccess`, `widok_lang`, `seo_text`, `dzien_tygodnia`, `czas_trwania`, `godzina_rozpoczecia`, `id_type`, `id_room`, `id_instructor`, `id_region`, `id_poziom_zaawansowania`, `zawod_nazwa`) VALUES
(1, 1, 1, 'TRX Core - płaski brzuch do lata', 4, 2, '<p style="text-align: justify;">TRX Core to najefektywniejsze 30 minut w ciągu Twojego&nbsp;dnia, jakie tylko możesz sobie wyobrazić! Dołącz do naszych TRX-owych grup już dziś i bądź gotowy na lato!</p>', '', '', '_self', '', '', '', 'aktualnosci/trx-core-plaski-brzuch-do-lata', 'checked', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(2, 2, 1, 'Zaproś znajomego i odbierz nagrodę!', 5, 2, '<p style="text-align: justify;">Chciałbyś, żeby Tw&oacute;j znajomy przekonał się na własnej sk&oacute;rze, jaka panuje u nas atmosfera? Już dziś odbierz w recepcji voucher na trzy bezpłatne treningi dla kogoś z Twoich bliskich!</p>', '', '', '_self', NULL, NULL, NULL, 'aktualnosci/zapros-znajomego-i-odbierz-nagrode', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(4, 4, 1, 'Zastępstwa w najbliższym czasie', 6, 3, '', '', '', '_self', NULL, NULL, NULL, 'zastepstwa/zastepstwa-w-najblizszym-czasie', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(7, 7, 1, 'make up my love', 151, 1, '<p style="text-align: justify;">Pomysł stworzenia make up my love zrodził się z potrzeby podzielenia się moją wiedzą o makijażu z wszystkimi, kt&oacute;rzy chcą nauczyć się tej sztuki na własne potrzeby.</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/make-up-my-love', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(8, 8, 1, 'Zakład Optyczny Przemysław Pluta', 163, 2, '<p style="text-align: justify;">Drodzy Klubowicze! Kupując okulary w naszym salonie, po okazaniu karty atmosfery,&nbsp;otrzymacie 10% rabatu na soczewki z powłoką antyrefleksyjną.</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/zaklad-optyczny-przemyslaw-pluta', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(22, 22, 1, 'Paweł', 63, 4, '<p>Zajęcia ATMcross, 1000 kcal kettlebell oraz TRX z Pawłem to gwarancja porządnego zmęczenia i trwałych efekt&oacute;w!</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/pawel', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(23, 23, 1, 'Smukła Sylwetka', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/smukla-sylwetka', 'checked', NULL, 1, 50, '09:00:00', 6, 1, 40, NULL, 0, NULL),
(26, 26, 1, '2skin', 156, 2, '<p style="text-align: justify;">Teraz możesz wyglądać stylowo i modnie, nie tylko na ulicy, ale i na siłowni, bieżni, czy zajęciach fitness! Zagwarantuje Ci to odzież marki 2skin, kt&oacute;rą znajdziesz&nbsp;w klubie&nbsp;atmosfera.</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/2skin', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(27, 27, 1, '1000 kcal kettlebell', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/1000-kcal-kettlebell', 'checked', NULL, 1, 50, '08:00:00', 2, 1, 42, NULL, 0, NULL),
(28, 28, 1, 'Magda', 68, 4, '<p>Magdę spotkasz na spalającym tkankę tłuszczową oraz poprawiającym kondycję treningu&nbsp;Indoor Cycling P2 oraz Mix Class, a także na Zajęciach dla Senior&oacute;w.</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/magda', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(29, 29, 1, 'Gosia', 53, 4, '<p>Gosia zadba o Twoją&nbsp;formę podczas zajęć Indoor Cycling P1, P2 oraz Mix Class, a także 1000 kcal kettlebell.</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/gosia', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(30, 30, 1, 'Kamila', 57, 4, '<p>Choć obecnie&nbsp;Kamili - młodej mamy :) - nie spotkasz ani na zajęciach, ani na siłowni, to efekty jej pracy możesz odczuć na własnej sk&oacute;rze podczas każdego treningu w atmosferze. Jako nasz Manager Fitness troszczy się o to, abyś codziennie był otaczany opieką instruktorską na najwyższym poziomie.</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/kamila', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(31, 31, 1, 'Julia', 55, 4, '<p>Julia pomoże Ci&nbsp;wzmocnić i wymodelować sylwetkę na siłowni oraz zajęciach ABS/Płaski Brzuch, a dodatkowo zaszczepi sportowego ducha w Twoich pociechach podczas sobotnich Zajęć&nbsp;dla dzieci!</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/julia', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(32, 32, 1, 'Kasia Wiaderny', 56, 4, '<p>Z Kasią zadbasz o wzmocnienie i rozciągnięcie swojego ciała,&nbsp;biorąc udział w zajęciach Smukła Sylwetka, Stretching oraz Zdrowy kręgosłup. Spotkasz ją r&oacute;wnież na Zajęciach dla Senior&oacute;w.</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/kasia-wiaderny', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(33, 33, 1, 'Kuba', 59, 4, '<p>Kuba&nbsp;sprawi, że dasz&nbsp;z siebie wszystko podczas zajęć Indoor Cycling P2, KRANKcycling oraz TRX.</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/kuba', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(34, 34, 1, 'Dawid', 51, 4, '<p>Z Dawidem spalisz zbędne kalorie i poprawisz swoją kondycję na zajęciach Indoor Cycling P1, wymodelujesz swoje ciało na Smukłej Sylwetce, a także rozciągniesz wszystkie mięśnie podczas&nbsp;Stretchingu.</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/dawid', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(35, 35, 1, 'Paula', 65, 4, '', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/paula', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(36, 36, 1, 'Emilia', 60, 4, '<p>Emilka rozbudzi Cię w każdy sobotni poranek na energetycznych zajęciach Zumby!</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/emilia', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(37, 37, 1, 'Ewa', 61, 4, '<p>W każde piątkowe popołudnie Ewa wprawi Cię w taneczno-weekendowy nastr&oacute;j podczas zajęć Salsation.</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/ewa', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(38, 38, 1, 'Agnieszka', 50, 4, '<p>Agnieszka podczas swoich zajęć Zumby&nbsp;udowodni Ci, jak przyjemne potrafi&nbsp;być porządne zmęczenie!</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/agnieszka', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(39, 39, 1, 'Ada', 49, 4, '<p>Środowa Zumba z Adą to 50-minutowe taneczne szaleństwo, dzięki kt&oacute;remu zgubisz zbędne kalorie!</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/ada', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(40, 40, 1, 'Ania', 52, 4, '<p>Ania wyciśnie z Ciebie si&oacute;dme poty na zajęciach ABS/Płaski Brzuch, Gymbar/Płaski Brzuch, Smukła Sylwetka, TRX, Deep Work, Insanity oraz 1000kcal Kettlebell!</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/ania', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(41, 41, 1, 'Szczepan', 62, 4, '<p>Dynamiczny&nbsp;Aerobox ze Szczepanem pozwoli Ci rozładować negatywne emocje, spalić zbędne kalorie oraz&nbsp;poprawić&nbsp;wytrzymałość, zwinność i wygląd Twojej sylwetki.</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/szczepan', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(42, 42, 1, 'Szymon', 64, 4, '<p>Z Szymonem nauczysz się przekraczać swoje granice podczas każdego Treningu obwodowego,&nbsp;ATMcross, TRX Core oraz 1000 kcal kettlebell.</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/szymon', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(43, 43, 1, 'Kasia Wachowska', 68, 4, '<p>Z Kasią wyciszysz sw&oacute;j umysł i wzmocnisz ciało w każdy wtorkowy i czwartkowy wiecz&oacute;r&nbsp;na zajęciach Yogi.&nbsp;</p>', '', '', '_self', NULL, NULL, NULL, 'instruktorzy/kasia-wachowska', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, ''),
(44, 44, 1, 'Zajęcia dla Seniorów', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/zajecia-dla-seniorow', 'checked', NULL, 1, 50, '11:00:00', 2, 1, 32, NULL, 0, NULL),
(45, 45, 1, 'Płaski Brzuch/ABS', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/plaski-brzuch/abs', 'checked', NULL, 1, 50, '16:00:00', 6, 1, 40, NULL, 0, NULL),
(46, 46, 1, 'Gymbar/Płaski Brzuch', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/gymbar/plaski-brzuch', 'checked', NULL, 1, 50, '17:00:00', 6, 1, 40, NULL, 0, NULL),
(47, 47, 1, 'Deep Work', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/deep-work', 'checked', NULL, 1, 50, '18:00:00', 3, 1, 40, NULL, 0, NULL),
(48, 48, 1, 'Indoor Cycling P2', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-p2', 'checked', NULL, 1, 50, '18:30:00', 3, 2, 29, NULL, 0, NULL),
(49, 49, 1, 'TRX', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/trx', 'checked', NULL, 1, 50, '19:00:00', 6, 1, 33, NULL, 0, NULL),
(50, 50, 1, 'Indoor Cycling P1', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-p1', 'checked', NULL, 1, 50, '19:30:00', 3, 2, 29, NULL, 0, NULL),
(51, 51, 1, 'Zumba', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/zumba', 'checked', NULL, 1, 50, '20:00:00', 3, 1, 38, NULL, 0, NULL),
(52, 52, 1, 'KRANKcycling', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/krankcycling', 'checked', NULL, 1, 50, '20:30:00', 2, 2, 33, NULL, 0, NULL),
(53, 53, 1, '1000 kcal kettlebell', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/1000-kcal-kettlebell-1', 'checked', NULL, 1, 50, '21:00:00', 2, 1, 22, NULL, 0, NULL),
(54, 54, 1, '1000 kcal kettlebell', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/1000-kcal-kettlebell-2', 'checked', NULL, 2, 50, '08:00:00', 2, 1, 29, NULL, 0, NULL),
(55, 55, 1, 'ATMcross', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/atmcross', 'checked', NULL, 2, 50, '16:00:00', 6, 1, 42, NULL, 0, NULL),
(56, 56, 1, 'Insanity', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/insanity', 'checked', NULL, 2, 50, '17:00:00', 3, 1, 40, NULL, 0, NULL),
(57, 57, 1, 'ATMcross', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/atmcross-1', 'checked', NULL, 2, 50, '18:00:00', 6, 1, 22, NULL, 0, NULL),
(58, 58, 1, 'Indoor Cycling Mix Class', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-mix-class', 'checked', NULL, 2, 50, '18:30:00', 3, 2, 28, NULL, 0, NULL),
(59, 59, 1, 'Płaski Brzuch/ABS', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/plaski-brzuch/abs-1', 'checked', NULL, 2, 50, '19:00:00', 6, 1, 40, NULL, 0, NULL),
(60, 60, 1, 'Indoor Cycling P2', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-p2-1', 'checked', NULL, 2, 50, '19:30:00', 3, 2, 28, NULL, 0, NULL),
(61, 61, 1, 'Indoor Cycling P1', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-p1-1', 'checked', NULL, 2, 50, '20:30:00', 3, 2, 34, NULL, 0, NULL),
(63, 63, 1, 'Joga', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/joga', 'checked', NULL, 2, 90, '20:30:00', 1, 1, 43, NULL, 0, NULL),
(64, 64, 1, 'TRX CORE', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/trx-core', 'checked', NULL, 2, 30, '22:10:00', 6, 1, 42, NULL, 0, NULL),
(65, 65, 1, 'TRX CORE', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/trx-core-2', 'checked', NULL, 3, 30, '08:20:00', 6, 1, 40, NULL, 0, NULL),
(66, 66, 1, 'Gymbar/Płaski Brzuch', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/gymbar/plaski-brzuch-1', 'checked', NULL, 3, 50, '09:00:00', 6, 1, 40, NULL, 0, NULL),
(67, 67, 1, 'Zajęcia dla Seniorów', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/zajecia-dla-seniorow-1', 'checked', NULL, 3, 50, '11:00:00', 2, 1, 28, NULL, 0, NULL),
(68, 68, 1, 'Zdrowy Kręgosłup', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/zdrowy-kregoslup', 'checked', NULL, 3, 50, '16:00:00', 1, 1, 32, NULL, 0, NULL),
(69, 69, 1, 'Smukła Sylwetka', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/smukla-sylwetka-1', 'checked', NULL, 3, 50, '17:00:00', 6, 1, 32, NULL, 0, NULL),
(70, 70, 1, 'Stretching', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/stretching', 'checked', NULL, 3, 50, '18:00:00', 1, 1, 32, NULL, 0, NULL),
(71, 71, 1, 'Indoor Cycling P2', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-p2-2', 'checked', NULL, 3, 50, '18:30:00', 3, 2, 33, NULL, 0, NULL),
(72, 72, 1, 'Zumba', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/zumba-1', 'checked', NULL, 3, 50, '19:00:00', 3, 1, 39, NULL, 0, NULL),
(73, 73, 1, 'KRANKKcycling', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/krankkcycling', 'checked', NULL, 3, 50, '19:30:00', 2, 2, 33, NULL, 0, NULL),
(74, 74, 1, 'TRX', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/trx-1', 'checked', NULL, 3, 50, '20:00:00', 6, 1, 40, NULL, 0, NULL),
(75, 75, 1, '1000 kcal kettlebell', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/1000-kcal-kettlebell-3', 'checked', NULL, 3, 50, '21:00:00', 2, 1, 40, NULL, 0, NULL),
(76, 76, 1, 'TRX', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/trx-2', 'checked', NULL, 4, 50, '07:00:00', 6, 1, 22, NULL, 0, NULL),
(77, 77, 1, 'ATMcross', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/atmcross-2', 'checked', NULL, 4, 50, '09:00:00', 6, 1, 42, NULL, 0, NULL),
(78, 78, 1, 'Trening obwodowy', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/trening-obwodowy-1', 'checked', NULL, 4, 50, '16:00:00', 6, 1, 42, NULL, 0, NULL),
(79, 79, 1, 'Zumba', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/zumba-2', 'checked', NULL, 4, 50, '17:00:00', 3, 1, 38, NULL, 0, NULL),
(80, 80, 1, 'TRX', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/trx-3', 'checked', NULL, 4, 50, '18:00:00', 6, 1, 33, NULL, 0, NULL),
(81, 81, 1, 'Indoor Cycling P1', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-p1-2', 'checked', NULL, 4, 50, '18:30:00', 3, 2, 34, NULL, 0, NULL),
(82, 82, 1, 'Aerobox', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/aerobox', 'checked', NULL, 4, 50, '19:00:00', 3, 1, 41, NULL, 0, NULL),
(83, 83, 1, 'Indoor Cycling P2', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-p2-3', 'checked', NULL, 4, 50, '19:30:00', 3, 2, 33, NULL, 0, NULL),
(84, 84, 1, 'KRANKcycling', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/krankcycling-1', 'checked', NULL, 4, 50, '20:30:00', 2, 2, 33, NULL, 0, NULL),
(85, 85, 1, 'Joga', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/joga-1', 'checked', NULL, 4, 90, '20:30:00', 1, 1, 43, NULL, 0, NULL),
(86, 86, 1, 'TRX CORE', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/trx-core-1', 'checked', NULL, 4, 30, '22:10:00', 6, 1, 42, NULL, 0, NULL),
(87, 87, 1, 'TRX', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/trx-4', 'checked', NULL, 5, 50, '08:00:00', 6, 1, 22, NULL, 0, NULL),
(88, 88, 1, 'Indoor Cycling Mix Class', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-mix-class-1', 'checked', NULL, 5, 50, '09:00:00', 2, 2, 29, NULL, 0, NULL),
(89, 89, 1, 'Zajęcia dla Seniorów', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/zajecia-dla-seniorow-2', 'checked', NULL, 5, 50, '11:00:00', 2, 1, 32, NULL, 0, NULL),
(90, 90, 1, 'ATMcross', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/atmcross-3', 'checked', NULL, 5, 50, '16:00:00', 6, 1, 42, NULL, 0, NULL),
(91, 91, 1, 'ATMcross', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/atmcross-4', 'checked', NULL, 5, 50, '17:00:00', 6, 1, 42, NULL, 0, NULL),
(92, 92, 1, 'Salsation', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/salsation', 'checked', NULL, 5, 50, '18:00:00', 3, 1, 37, NULL, 0, NULL),
(93, 93, 1, 'Stretching', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/stretching-1', 'checked', NULL, 5, 50, '19:00:00', 1, 1, 34, NULL, 0, NULL),
(94, 94, 1, 'Indoor Cycling Mix Class', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-mix-class-2', 'checked', NULL, 5, 50, '19:30:00', 3, 2, 28, NULL, 0, NULL),
(95, 95, 1, 'Smukła Sylwetka', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/smukla-sylwetka-2', 'checked', NULL, 5, 50, '20:00:00', 6, 1, 34, NULL, 0, NULL),
(96, 96, 1, '1000 kcal kettlebell', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/1000-kcal-kettlebell-4', 'checked', NULL, 5, 50, '21:00:00', 2, 1, 22, NULL, 0, NULL),
(97, 97, 1, 'Zumba', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/zumba-3', 'checked', NULL, 6, 50, '09:05:00', 3, 1, 36, NULL, 0, NULL),
(98, 98, 1, 'ABS/Płaski Brzuch', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/abs/plaski-brzuch', 'checked', NULL, 6, 50, '10:00:00', 6, 1, 31, NULL, 0, NULL),
(99, 99, 1, 'Zajęcia dla dzieci 3-5 lat', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/zajecia-dla-dzieci-3-5-lat', 'checked', NULL, 6, 90, '11:00:00', 8, 1, 31, NULL, 0, NULL),
(100, 100, 1, 'Zajęcia dla dzieci 6-8 lat', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/zajecia-dla-dzieci-6-8-lat', 'checked', NULL, 6, 90, '12:45:00', 8, 1, 31, NULL, 0, NULL),
(101, 101, 1, '1000 kcal kettlebell', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/1000-kcal-kettlebell-5', 'checked', NULL, 7, 50, '09:05:00', 2, 1, 29, NULL, 0, NULL),
(102, 102, 1, 'Indoor Cycling P1', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-p1-3', 'checked', NULL, 7, 50, '10:00:00', 3, 2, 29, NULL, 0, NULL),
(103, 103, 1, 'Indoor Cycling P2', 0, 0, '', NULL, '', '_self', NULL, NULL, NULL, 'treningi/indoor-cycling-p2-4', 'checked', NULL, 7, 50, '11:00:00', 3, 2, 29, NULL, 0, NULL),
(106, 106, 1, 'Gabinet Masażu SOGNO', 160, 1, '<p style="text-align: justify;">Na ł&oacute;dzkim rynku usług masażu, odnowy biologicznej i kosmetyki jesteśmy od roku 2010, kiedy to rozpoczęliśmy działalność opierającą się na zabiegach masażu leczniczego i relaksacyjnego.</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/gabinet-masazu-sogno', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(107, 107, 1, 'Megafit', 165, 1, '<p style="text-align: justify;">Klubowicze atmosfery mogą skorzystać z rabatu w wysokości 10% na usługi MEGAFIT.</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/megafit', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(108, 108, 1, 'Szkoła Open Mind', 153, 1, '<p style="text-align: justify;">Działając na terenie Łodzi, dajemy Wam możliwość kształcenia się, zdobywania wiedzy i doświadczenia w najlepszej szkole instruktor&oacute;w oraz trener&oacute;w - Szkole Open Mind.</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/szkola-open-mind', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(109, 109, 1, 'ekspertfitness.com', 150, 3, '<p style="text-align: justify;">Firma ekspertfitness.com jest doskonale znana w branży fitness od 20 lat.&nbsp;</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/ekspertfitnesscom', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(110, 110, 1, 'Indoor Cycling Group', 152, 2, '<p style="text-align: justify;">Indoor Cycling to niezwykle popularna na całym świecie forma ruchu polegająca nie tylko na energicznej jeździe na rowerze stacjonarnym Tomahawk w rytm muzyki i poleceń instruktora, ale także na czymś znacznie więcej...</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/indoor-cycling-group', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(111, 111, 1, 'tiguar', 159, 3, '<p style="text-align: justify;">tiguar to polska, niestereotypowa marka stworzona, by w swoich produktach połączyć inżynieryjny koncept i spryt wraz z&nbsp;funkcjonalnością i przyciągającym designem.&nbsp;</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/tiguar', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(113, 113, 1, 'Senoritas', 132, 2, '<p style="text-align: justify;">SE&Ntilde;ORITAS Restaurant&amp;Lounge to kameralna restauracja o unikalnym wnętrzu i atmosferze specjalizująca się w kuchni meksykańskiej, amerykańskiej i me<span class="text_exposed_show">ksykańsko-amerykańskiej.</span></p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/senoritas', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(114, 114, 1, 'GT Insurance', 138, 1, '<p style="text-align: justify;">Zapraszamy do wsp&oacute;łpracy firmy oraz osoby prywatne. W naszej ofercie znajdą Państwo samochody z polskich sieci dealerskich. Zajmujemy się przede wszystkim autami z polskich salon&oacute;w sprzedaży z udokumentowaną<span class="text_exposed_show"> historią.</span></p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/gt-insurance', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(115, 115, 1, 'Body Shop', 141, 1, '<p>Zapraszamy do sklepu internetowego oraz do naszych sklep&oacute;w stacjonarnych!</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/body-shop', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(116, 116, 1, 'Alle Paznokcie', 142, 1, '<p style="text-align: justify;">Gł&oacute;wnym celem naszej działalności jest zagwarantowanie kompleksowej usługi poprzez bogatą ofertę wysokiej jakości produkt&oacute;w skierowanych do os&oacute;b z branży kosmetycznej i fryzjerskiej.</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/alle-paznokcie', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(117, 117, 1, 'Centrum Urody Myśkiewicz', 145, 1, '<p style="text-align: justify;">W ofercie Centrum Urody każdy znajdzie coś dla siebie. Od solarium, opalania natryskowego, pielęgnacji dłoni i st&oacute;p, po zabiegi na twarz i ciało. Odmłodzimy, upiększymy i odchudzimy! Zabierzemy Cię w świat relaksu i damy chwilę zapomnienia....</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/centrum-urody-myskiewicz', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(118, 118, 1, 'supersports.pl', 146, 1, '<p style="text-align: justify;">Zapraszamy do odwiedzenia sklepu internetowego&nbsp;www.supersports.pl, w kt&oacute;rym znajdziecie wszystko, czego potrzebujecie na trening &ndash; zar&oacute;wno ten na siłowni, jak i Indoor Cycling&rsquo;owy.</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/supersportspl', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(119, 119, 1, 'Fryzjernia Nunez', 143, 1, '<p><span class="text_exposed_show">Jako naszym Klubowiczom przysługuje Wam rabat 15% na usługi Fryzjerni! Wystarczy okazać ulotkę, kt&oacute;rą znajdziecie w atmosferze.</span></p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/fryzjernia-nunez', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(120, 120, 1, 'Power Water''s', 144, 2, '<p>Czerp energię ze źr&oacute;dła natury!</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/power-waters', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(121, 121, 1, 'Fiore', 164, 1, '<p style="text-align: justify;">Ponad 1000 modeli w naszej ofercie powoduje, że jesteśmy w stanie odpowiedzieć na zr&oacute;żnicowane zapotrzebowanie nawet najbardziej wymagających klientek.&nbsp;W naszej pracy stawiamy przede wszystkim na jakość wykonania i najlepsze materiały.</p>', '', '', '_self', NULL, NULL, NULL, 'przyjaciele-atmosfery/fiore', 'checked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktualnosci_tresc`
--

CREATE TABLE IF NOT EXISTS `aktualnosci_tresc` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_rodzic_blok` int(5) unsigned DEFAULT NULL,
  `id_art_nazwa` int(5) unsigned DEFAULT NULL,
  `id_lang` int(1) unsigned DEFAULT NULL,
  `sort` int(5) unsigned DEFAULT NULL,
  `naglowek_bloku` varchar(255) DEFAULT NULL,
  `naglowek_bloku_typ` varchar(10) DEFAULT NULL,
  `id_zdjecie_1` int(5) unsigned DEFAULT NULL,
  `rozmiar_1` tinyint(1) unsigned DEFAULT NULL,
  `podpis_1` varchar(255) DEFAULT NULL,
  `adres_1` varchar(255) DEFAULT NULL,
  `powieksz_1` varchar(8) NOT NULL DEFAULT '',
  `target_1` varchar(8) NOT NULL DEFAULT '',
  `alt_1` varchar(255) DEFAULT NULL,
  `title_1` varchar(255) DEFAULT NULL,
  `id_zdjecie_2` int(5) unsigned DEFAULT NULL,
  `rozmiar_2` tinyint(1) unsigned DEFAULT NULL,
  `podpis_2` varchar(255) DEFAULT NULL,
  `adres_2` varchar(255) DEFAULT NULL,
  `powieksz_2` varchar(8) NOT NULL DEFAULT '',
  `target_2` varchar(8) NOT NULL DEFAULT '',
  `alt_2` varchar(255) DEFAULT NULL,
  `title_2` varchar(255) DEFAULT NULL,
  `id_zdjecie_3` int(5) unsigned DEFAULT NULL,
  `rozmiar_3` tinyint(1) unsigned DEFAULT NULL,
  `podpis_3` varchar(255) DEFAULT NULL,
  `adres_3` varchar(255) DEFAULT NULL,
  `powieksz_3` varchar(8) NOT NULL DEFAULT '',
  `target_3` varchar(8) NOT NULL DEFAULT '',
  `alt_3` varchar(255) DEFAULT NULL,
  `title_3` varchar(255) DEFAULT NULL,
  `tresc` text,
  `oblewanie_zdjecie` varchar(8) NOT NULL DEFAULT '',
  `id_plik_1` int(5) unsigned DEFAULT NULL,
  `nazwa_plik_1` varchar(255) DEFAULT NULL,
  `id_plik_2` int(5) unsigned DEFAULT NULL,
  `nazwa_plik_2` varchar(255) DEFAULT NULL,
  `typ_plik` tinyint(1) unsigned DEFAULT NULL,
  `widocznosc` varchar(8) NOT NULL DEFAULT '',
  `typ` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `typ_zaawansowany` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aktualnosci_tresc_id_lang_FK` (`id_lang`),
  KEY `aktualnosci_tresc_id_art_nazwa_FK` (`id_art_nazwa`),
  KEY `aktualnosci_tresc_id_rodzic_blok_FK` (`id_rodzic_blok`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Zrzut danych tabeli `aktualnosci_tresc`
--

INSERT INTO `aktualnosci_tresc` (`id`, `id_rodzic_blok`, `id_art_nazwa`, `id_lang`, `sort`, `naglowek_bloku`, `naglowek_bloku_typ`, `id_zdjecie_1`, `rozmiar_1`, `podpis_1`, `adres_1`, `powieksz_1`, `target_1`, `alt_1`, `title_1`, `id_zdjecie_2`, `rozmiar_2`, `podpis_2`, `adres_2`, `powieksz_2`, `target_2`, `alt_2`, `title_2`, `id_zdjecie_3`, `rozmiar_3`, `podpis_3`, `adres_3`, `powieksz_3`, `target_3`, `alt_3`, `title_3`, `tresc`, `oblewanie_zdjecie`, `id_plik_1`, `nazwa_plik_1`, `id_plik_2`, `nazwa_plik_2`, `typ_plik`, `widocznosc`, `typ`, `typ_zaawansowany`) VALUES
(1, NULL, 4, 1, 2, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: center;"><span style="font-size: 20px;"><strong>Kochani!</strong></span></p>\r\n<p style="text-align: center;"><span style="font-size: 20px;">Prosimy o zapoznanie się z zastępstwami w najbliższym czasie:</span></p>\r\n<p style="text-align: center;"><br /><span style="font-size: 20px;"><strong>Piątek 1.04.</strong></span></p>\r\n<p style="text-align: center;"><span style="font-size: 20px;">16:00&nbsp;<span style="color: #99cc00;"><strong>ATM Cross&nbsp;</strong><span style="color: #000000;">-</span></span><span style="color: #000000;">&nbsp;</span>Paweł</span></p>\r\n<p style="text-align: center;"><span style="font-size: 20px;">17:00 <span style="color: #99cc00;"><strong>ATM Cross</strong></span> - Paweł</span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><strong><span style="font-size: 20px;">Poniedziałek 4.04.</span></strong></p>\r\n<p style="text-align: center;"><span style="font-size: 20px;">8:00 <span style="color: #99cc00;"><strong>1000 kcal kettlebell</strong></span> - Ania</span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><strong><span style="font-size: 20px;">Środa 6.04.</span></strong></p>\r\n<p style="text-align: center;"><span style="font-size: 20px;">18:30 <span style="color: #99cc00;"><strong>Indoor Cycling P2</strong></span> - Gosia</span></p>\r\n<p style="text-align: center;"><span style="font-size: 20px;">19:30 <span style="color: #99cc00;"><strong>Indoor Cycling P1</strong></span> - Gosia</span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><strong><span style="font-size: 20px;">Czwartek 7.04.</span></strong></p>\r\n<p style="text-align: center;"><span style="font-size: 20px;">18:00 <span style="color: #99cc00;"><strong>TRX</strong></span> - Ania</span></p>\r\n<p style="text-align: center;"><span style="font-size: 20px;">19:30 <span style="color: #99cc00;"><strong>Indoor Cycling P2</strong></span> - Paula</span></p>\r\n<p style="text-align: center;"><span style="font-size: 20px;">20:30 <span style="color: #99cc00;"><strong>IC Mix Class</strong></span> - Paula</span></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><span style="font-size: 20px;">Serdecznie zapraszamy! :)</span></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(3, NULL, 1, 1, 6, NULL, NULL, 4, 1, '', '/atmosfera/aktualnosci/trx-core-plaski-brzuch-do-lata', 'checked', '_self', '', '', 5, 1, '', '/atmosfera/aktualnosci/zapros-znajomego-i-odbierz-nagrode', 'checked', '_self', '', '', 6, 1, '', '/atmosfera/zastepstwa/zastepstwa-w-najblizszym-czasie', 'checked', '_self', '', '', NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(9, NULL, 8, 1, 9, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Nasza praca jest naszą pasją. Działamy na rynku od 1996 roku, stale powiększając grono zadowolonych klient&oacute;w. Jesteśmy firmą rodzinną i naszą wsp&oacute;łpracę opieramy przede wszystkim na zaufaniu i precyzji.</p>\r\n<p style="text-align: justify;"><br />Oferujemy szeroki wachlarz usług optycznych. Nasza profesjonalna kadra pomoże Państwu:<br />-zrealizować receptę na wykonanie okular&oacute;w korekcyjnych,<br />-w doborze okular&oacute;w przeciwsłonecznych,<br />-w wyborze odpowiedniego rodzaju soczewek okularowych spośr&oacute;d: soczewek progresywnych, dwuogniskowych, fotochromowych oraz polaryzacyjnych,<br />-w wyborze materiału wykonania opraw okularowych spośr&oacute;d: opraw z płyty, metalowych &ndash; r&oacute;wnież bez niklu oraz tytanowych.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">Dodatkowe usługi, kt&oacute;re świadczymy, to:</p>\r\n<p style="text-align: justify;">-komputerowe badanie wzroku,<br />-badanie ostrości widzenia,<br />-naprawa opraw okularowych,<br />-grawerowanie soczewek okularowych.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">Serdecznie zapraszamy!</p>\r\n<p style="text-align: justify;">ul. Armii Krajowej 32<br />tel: 42 686 01 99</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(13, NULL, 23, 1, 13, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(14, NULL, 1, 1, 7, NULL, NULL, 148, 4, NULL, NULL, 'checked', '', NULL, NULL, 0, 0, NULL, NULL, 'checked', '', NULL, NULL, 0, 0, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(19, NULL, 2, 1, 19, NULL, NULL, 101, 3, NULL, NULL, 'checked', '', NULL, NULL, 0, 0, NULL, NULL, 'checked', '', NULL, NULL, 0, 0, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(20, NULL, 2, 1, 18, NULL, NULL, 4, 1, '', '/atmosfera/aktualnosci/trx-core-plaski-brzuch-do-lata', 'checked', '_self', '', '', 5, 1, '', '/atmosfera/aktualnosci/zapros-znajomego-i-odbierz-nagrode', 'checked', '_self', '', '', 6, 1, '', '/atmosfera/zastepstwa/zastepstwa-w-najblizszym-czasie', 'checked', '_self', '', '', NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(21, NULL, 4, 1, 1, NULL, NULL, 4, 1, '', '/atmosfera/aktualnosci/trx-core-plaski-brzuch-do-lata', 'checked', '_self', '', '', 5, 1, '', '/atmosfera/aktualnosci/zapros-znajomego-i-odbierz-nagrode', 'checked', '_self', '', '', 6, 1, '', '/atmosfera/zastepstwa/zastepstwa-w-najblizszym-czasie', 'checked', '_self', '', '', NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(24, NULL, 29, 1, 24, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Gosia zadba o Twoją formę podczas zajęć Indoor Cycling P1, P2 oraz Mix Class, a także 1000 kcal kettlebell.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(25, NULL, 28, 1, 25, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Magdę spotkasz na spalającym tkankę tłuszczową oraz poprawiającym kondycję treningu&nbsp;Indoor Cycling P2 oraz Mix Class, a także na Zajęciach dla Senior&oacute;w.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(26, NULL, 22, 1, 26, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Zajęcia ATMcross, 1000&nbsp;kcal kettlebell oraz TRX z Pawłem to gwarancja porządnego zmęczenia i trwałych efekt&oacute;w!</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(27, NULL, 31, 1, 27, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Julia pomoże Ci&nbsp;wzmocnić i wymodelować sylwetkę na siłowni oraz zajęciach ABS/Płaski Brzuch, a&nbsp;dodatkowo zaszczepi sportowego ducha w Twoich pociechach podczas sobotnich Zajęć&nbsp;dla dzieci!</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(28, NULL, 32, 1, 28, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Z Kasią zadbasz o wzmocnienie i rozciągnięcie swojego ciała,&nbsp;biorąc udział w zajęciach Smukła Sylwetka, Stretching oraz Zdrowy kręgosłup. Spotkasz ją r&oacute;wnież na Zajęciach dla Senior&oacute;w.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(29, NULL, 33, 1, 29, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Kuba&nbsp;sprawi, że dasz&nbsp;z siebie wszystko podczas zajęć Indoor Cycling P2, KRANKcycling oraz TRX.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(30, NULL, 34, 1, 30, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Z Dawidem spalisz zbędne kalorie i poprawisz kondycję na zajęciach Indoor Cycling P1, wymodelujesz swoje ciało na Smukłej Sylwetce, a także rozciągniesz wszystkie mięśnie podczas Stretchingu.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(31, NULL, 36, 1, 31, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Emilka rozbudzi Cię w każdy sobotni poranek na energetycznych zajęciach Zumby!</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(32, NULL, 37, 1, 32, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>W każde piątkowe popołudnie Ewa wprawi Cię w taneczno-weekendowy nastr&oacute;j podczas zajęć Salsation.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(33, NULL, 38, 1, 33, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Agnieszka podczas swoich zajęć Zumby&nbsp;udowodni Ci, jak przyjemne potrafi&nbsp;być porządne zmęczenie!</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(34, NULL, 42, 1, 34, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Z Szymonem nauczysz się przekraczać swoje granice podczas każdego Treningu obwodowego,&nbsp;ATMcross, TRX Core oraz 1000 kcal kettlebell.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(35, NULL, 40, 1, 35, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Ania wyciśnie z Ciebie si&oacute;dme poty na zajęciach ABS/Płaski Brzuch, Gymbar/Płaski Brzuch, Smukła Sylwetka, TRX, Deep Work, Insanity oraz 1000kcal Kettlebell!</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(36, NULL, 39, 1, 36, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Środowa Zumba z Adą to 50-minutowe taneczne szaleństwo, dzięki kt&oacute;remu zgubisz zbędne kalorie!</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(37, NULL, 41, 1, 37, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Dynamiczny&nbsp;Aerobox ze Szczepanem pozwoli Ci rozładować negatywne emocje, spalić zbędne kalorie oraz&nbsp;poprawić&nbsp;wytrzymałość, zwinność i wygląd Twojej sylwetki.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(38, NULL, 43, 1, 38, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Z Kasią wyciszysz sw&oacute;j umysł i wzmocnisz ciało w każdy wtorkowy i czwartkowy wiecz&oacute;r&nbsp;na zajęciach Yogi.&nbsp;</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(39, NULL, 30, 1, 39, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p>Choć obecnie&nbsp;Kamili - młodej mamy :) - nie spotkasz ani na zajęciach, ani na siłowni, to efekty jej pracy możesz odczuć na własnej sk&oacute;rze podczas każdego treningu w atmosferze. Jako nasz Manager Fitness troszczy się o to, abyś codziennie był otaczany opieką instruktorską na najwyższym poziomie.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(40, NULL, 26, 1, 40, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Teraz możesz wyglądać stylowo i modnie, nie tylko na ulicy, ale i na siłowni, bieżni, czy zajęciach fitness! Zagwarantuje Ci to odzież marki 2skin, kt&oacute;rą znajdziesz&nbsp;w klubie&nbsp;atmosfera.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">2skin już od wielu lat oferuje wygodne i modne ubrania do fitnessu, zumby i tańca. Kolekcja skierowana jest do kobiet, kt&oacute;re potrafią&nbsp;czerpać radość z życia przyjemność , optymistek, dla kt&oacute;rych nie ma rzeczy niemożliwych, a trening jest nieodłącznym elementem ich codziennego życia. Oryginalne wzory i r&oacute;żnorodność kolor&oacute;w sprawiają, że ubrania nie są nudne, a przy tym zapewnią komfort w czasie każdego treningu.<br />Pamiętaj, że jeśli nie znajdziesz swojego rozmiaru na wieszaku,&nbsp;możesz zam&oacute;wić go dla siebie w recepcji klubu!</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(41, NULL, 106, 1, 41, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Na ł&oacute;dzkim rynku usług masażu, odnowy biologicznej i kosmetyki jesteśmy od roku 2010, kiedy to rozpoczęliśmy działalność opierającą się tylko na zabiegach masażu leczniczego i relaksacyjnego.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">Od tamtej pory dostępna w naszym gabinecie oferta ulegała wielokrotnym zmianom, tak aby dziś dzień, każdy m&oacute;gł znaleźć coś dla siebie. Zakres naszych usług został wzbogacony o zabiegi pielęgnacyjne twarzy i ciała, do korzystania z kt&oacute;rych zapraszamy wszystkich z Was. Z tego też miejsca możemy r&oacute;wnież obiecać, iż nie poprzestaniemy na dostosowywaniu naszej oferty do Waszych potrzeb i skorzystamy z każdej Waszej cennej sugestii.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">Zapraszamy!</p>\r\n<p style="text-align: justify;">al. Wyszyńskiego 7a</p>\r\n<p style="text-align: justify;">klub atmosfera fitness&amp;wellness</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(42, NULL, 107, 1, 42, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Pasja łączy ludzi. Przyjazna atmosfera sprzyja tw&oacute;rczej pracy nad ciałem i umysłem. <br />Praca z ludźmi przynosi największą satysfakcję - uczy zrozumienia i rozwija mentalnie. Chcemy motywować, pomagać i uświadamiać, jak żyć mądrzej - czyli zdrowiej.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">Od 2009 roku MEGAFIT prowadzi i organizuje warsztaty z ergonomii pracy, szkolenia terapeutyczne z zakresu funkcjonalnego podejścia do treningu.<br />Założycielka MEGAFIT, Katarzyna Wiaderny (absolwentka Politechniki Ł&oacute;dzkiej o specjalności &bdquo;Bioinżynieria Medyczna&rdquo;), stworzyła program treningowy przeznaczony specjalnie dla senior&oacute;w. Jako pierwsza w centrum Polski zdobyła fundusze unijne właśnie na ten projekt, kt&oacute;ry do tej pory fantastycznie się rozwija. Zajęcia dla senior&oacute;w cieszą się ogromnym zainteresowaniem, a co najważniejsze przynoszą oczekiwaną poprawę jakości życia wśr&oacute;d os&oacute;b dojrzałych. Tw&oacute;rczynię tego programu możecie spotkać na treningach w atmosferze w każdy poniedziałek, środę i piątek.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">MEGAFIT świadczy usługi zar&oacute;wno na terenie Łodzi, jak i w Koluszkach. <br />Kadra MEGAFIT to specjaliści z najwyższej p&oacute;łki, w pełni wykwalifikowani&hellip; po prostu do zadań specjalnych! Prowadzą treningi indywidualne (r&oacute;wnież z dojazdem do klienta), zajęcia fitness (w Koluszkach) oraz służą pomocą w powrocie do formy po ciąży i utrzymaniu jej w tym wyjątkowym okresie. Ponadto usprawniają przy schorzeniach związanych z kręgosłupem oraz wszelkich problemach kostno-stawowych i mięśniowych. Używają nowoczesnych technik m.in. metody Pilates i jogi wg Iyengara.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(43, NULL, 108, 1, 43, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Działając na terenie Łodzi, dajemy Wam możliwość kształcenia się, zdobywania wiedzy i doświadczenia w najlepszej szkole instruktor&oacute;w oraz trener&oacute;w - Szkole Open Mind. Nasze&nbsp;ł&oacute;dzkie szkolenia odbywają się w miejscu&nbsp;nowoczesnym i profesjonalnym - klubie atmosfera fitness&amp;wellness.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><a href="http://www.fitness-om.pl/" target="_blank">www.fitness-om.pl</a></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(44, NULL, 109, 1, 44, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Firma ekspertfitness.com to nie tylko lider w kompleksowym wyposażaniu sal fitness oraz polski dystrybutor najlepszych, światowych marek sprzętu fitness; to także producent własnej marki tiguar, organizator i wsp&oacute;łorganizator największych branżowych event&oacute;w, a także firma prowadząca szkolenia i certyfikacje instruktor&oacute;w oraz consulting dla klub&oacute;w fitness.&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">W naszym klubie korzystamy z doświadczenia firmy ekspertfitness.com&nbsp;oraz z kilku dystrybuowanych przez nią marek, a nasi instruktorzy ukończyli organizowane przez nią szkolenia, ponieważ gwarantują one przyznanie certyfikat&oacute;w honorowanych na całym świecie.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><a href="http://ekspertfitness.com/" target="_blank">ekspertfitness.com</a></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(45, NULL, 110, 1, 45, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Indoor Cycling to niezwykle popularna na całym świecie forma ruchu polegająca nie tylko na energicznej jeździe na rowerze stacjonarnym Tomahawk w rytm muzyki i poleceń instruktora, ale także na czymś znacznie więcej; na zdrowym trybie życia, tworzeniu społeczności Indoor Cycling oraz uczestniczeniu w jej dorocznych maratonach: Evolution Ride i Carnival Cycling. Rowery marki Tomahawk to obecnie najbardziej rozwinięte technologicznie rowery stacjonarne na świecie.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><a href="http://www.ekspertfitness.com/marki/icg/idea" target="_blank">www.ekspertfitness.com/marki/icg/idea</a></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(46, NULL, 111, 1, 46, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">tiguar to polska, niestereotypowa marka stworzona, by w swoich produktach połączyć inżynieryjny koncept i spryt wraz z&nbsp;funkcjonalnością i przyciągającym designem.&nbsp;Produkty tiguar są idealną opcją dla tych, kt&oacute;rzy pragną wyposażyć sw&oacute;j klub w&nbsp;sprzęt idący z duchem czasu i spełniający rosnące oczekiwania ćwiczących; to opcja dla klient&oacute;w, kt&oacute;rzy jednocześnie oczekują bardzo wysokiej funkcjonalności i racjonalnej ceny. Doceniona w wielu klubach na całym świecie, marka tiguar może poszczycić się wieloma autorskim rozwiązaniami oraz znaczną częścią produkcji odbywającą się w Polsce.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><a href="http://www.tiguarfitness.com/pl/" target="_blank">www.tiguarfitness.com/pl</a></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(47, NULL, 7, 1, 8, NULL, NULL, 157, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Pomysł stworzenia make up my love zrodził się z potrzeby podzielenia się moją wiedzą o makijażu z wszystkimi, kt&oacute;rzy chcą nauczyć się tej sztuki na własne potrzeby.</p>\r\n<p style="text-align: justify;"><br />Projekt opiera się na warsztatach oraz indywidualnych treningach, podczas kt&oacute;rych każda z uczestniczek ma szansę poznać tajniki profesjonalnego makijażu, wykonując go samodzielnie pod moim bacznym okiem. Pozwala to na dokładne przyjrzenie się sobie i odnalezienie własnego stylu i wizerunku. Z&nbsp;wielką przyjemnością pomagam r&oacute;wnież kobietom zmienić się w gwiazdę wieczoru, wykonując makijaże okazjonalne.&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">Anna Szlendak</p>\r\n<p style="text-align: justify;"><a href="mailto:creme.makeup@gmail.com">creme.makeup@gmail.com</a></p>\r\n<p style="text-align: justify;">604 758 977</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(48, NULL, 113, 1, 48, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">SE&Ntilde;ORITAS Restaurant&amp;Lounge to kameralna restauracja o unikalnym wnętrzu i atmosferze specjalizująca się w kuchni meksykańskiej, amerykańskiej i meksykańsko-amerykańskiej.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">Jeff, nasz szef kuchni prosto zza oceanu, proponuje nowe<span class="text_exposed_show"> spojrzenie na bogactwo kulinarne obydwu kuchni, ich wzajemne przeplatanie i wzbogacanie się. Pyszne tacos, enchiladas, quesadillas, a także steki i nachos, to tylko niekt&oacute;re z naszych propozycji. Dodatkowo w każdą środę zapraszamy Was fantastyczne burgery! Dopełnieniem tych smak&oacute;w są klasyczne, dobrze zbalansowane koktajle, margarity oraz infuzowane tequile, kt&oacute;rych nie znajdziesz nigdzie indziej!</span></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<div class="text_exposed_show">\r\n<p style="text-align: justify;">Ł&oacute;dź, ul. Moniuszki 1a<br />Rezerwacje przyjmujemy pod numerem telefonu: 501 671 700<br />oraz mailowo: <a href="mailto:rezerwacje@senoritas.pl">rezerwacje@senoritas.pl</a></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><a href="https://www.facebook.com/senoritasrestaurant/" target="_blank">Senoritas na Facebook''u</a></p>\r\n</div>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(49, NULL, 113, 1, 49, NULL, NULL, 134, 2, NULL, NULL, 'checked', '', NULL, NULL, 133, 2, NULL, NULL, 'checked', '', NULL, NULL, 137, 3, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(50, NULL, 114, 1, 50, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Zapraszamy do wsp&oacute;łpracy firmy oraz osoby prywatne. W naszej ofercie znajdą Państwo samochody z polskich sieci dealerskich. Zajmujemy się przede wszystkim autami z polskich salon&oacute;w sprzedaży z udokumentowaną<span class="text_exposed_show"> historią. Wszystkie formalności realizujemy na miejscu (kredyt, leasing). Prowadzimy agencję ubezpieczeniową, dlatego oferujemy r&oacute;wnież pełny zakres ubezpieczeń. Na modele samochod&oacute;w do 5 lat oraz przebieg do 100 000km jesteśmy w stanie udzielić Państwu gwarancji.</span></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><a href="http://gti.net.pl/index.html">GT Insurance</a></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<div class="text_exposed_show">\r\n<p>Dział sprzedaży samochod&oacute;w:<br />Michał Karasiewicz <br />Specjalista ds.sprzedaży samochod&oacute;w<br />537 377 537</p>\r\n<p>Michał Szubka<br />Specjalista ds.sprzedaży samochod&oacute;w<br />535 121 315</p>\r\n<p><br />Dział ubezpieczeń: <br />Michał Karasiewicz<br />Specjalista ds.sprzedaży ubezpieczeń<br />537 377 537</p>\r\n<p>&nbsp;</p>\r\n<p>Email: biuro@gti.net.pl</p>\r\n</div>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(51, NULL, 115, 1, 51, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p><a href="http://www.bcaa.pl/" target="_blank">Body Shop</a></p>\r\n<p>&nbsp;</p>\r\n<p>ul.&nbsp;Pr&oacute;chnika 16</p>\r\n<p>Pn-Pt: 10:00 - 18:00</p>\r\n<p>Sob: 10:00 - 15:00</p>\r\n<p>&nbsp;</p>\r\n<p>ul. Rumuńska 1</p>\r\n<p>Pn-Pt: 9:00 - 19:00</p>\r\n<p>Sob: 10:00 - 18:00</p>\r\n<p>Nd: 9:00 - 16:00</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(52, NULL, 115, 1, 52, NULL, NULL, 140, 2, NULL, NULL, 'checked', '', NULL, NULL, 0, 0, NULL, NULL, 'checked', '', NULL, NULL, 0, 0, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(54, NULL, 116, 1, 54, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Hurtownia Alle Paznokcie rozpoczęła swoją działalność w 2005 roku. W czerwcu 2011 r. dołączyła do programu Rzetelna Firma wspieranego przez KRD. Gł&oacute;wnym celem naszej działalności jest zagwarantowanie kompleksowej usługi poprzez bogatą ofertę wysokiej jakości produkt&oacute;w skierowanych do os&oacute;b z branży kosmetycznej i fryzjerskiej. Wyr&oacute;żniamy się wysokimi standardami obsługi klienta, kt&oacute;rzy mogą liczyć nie tylko na rozbudowaną ofertę, lecz r&oacute;wnież na profesjonalne doradztwo.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><br />Chcąc ułatwić klientom wyb&oacute;r produkt&oacute;w, dokładamy wszelkich starań, aby nasza strona internetowa była przejrzysta. Dzięki kategoriom produkt&oacute;w zainteresowani w kr&oacute;tkim czasie odnajdą preferowaną ofertę. Od kilku lat z doskonałym rezultatem pracujemy z gronem specjalist&oacute;w należących do branży kosmetycznej i fryzjerskiej, kt&oacute;rzy cenią sobie poziom naszych usług.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">Serdecznie zapraszamy do wsp&oacute;łpracy!</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><a href="http://www.allepaznokcie-piaski.pl" target="_blank">Sklep internetowy</a></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">C.H.PIASKI<br />Ul. Wyszyńskiego&nbsp;7A<br />94-042 Ł&oacute;dź<br />503-339-599</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(55, NULL, 117, 1, 55, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Centrum Urody Myśkiewicz mieści się w centrum miasta przy ul. Piotrkowskiej 22. Istnieje od ponad 25 lat, łączy tradycje i doświadczenie z nowoczesną technologią. Jesteśmy firmą rodzinną, dzięki <span class="text_exposed_show">czemu nasze ciepłe relacje przechodzą na klient&oacute;w, kt&oacute;rzy często m&oacute;wią, że czują się tu jak u siebie. Staramy się wychodzić na przeciw wymaganiom klient&oacute;w i cieszymy się, gdy wychodzą od nas jak nowo narodzeni - takie jest nasze Day Spa!</span></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><span class="text_exposed_show">W ofercie Centrum Urody każdy znajdzie coś dla siebie. Od solarium, opalania natryskowego, pielęgnacji dłoni i st&oacute;p, po zabiegi na twarz i ciało. Posiadamy nowoczesne maszyny do mezoterapii bezigłowej, mikrodermabrazji, crioliftu, peelingu kawitacyjnego oraz kapsułę SPA z sauną parową, infraredem, koloroterapią, muzykoterapią i aromaterapią. Odmłodzimy, upiększymy i odchudzimy! Zabierzemy Cię w świat relaksu i damy chwilę zapomnienia.... </span></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><span class="text_exposed_show">Zapraszamy do Centrum Urody na Piotrkowską 22!</span></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><a href="http://www.centrum-urody.com.pl/" target="_blank">Centrum Urody Myśkiewicz</a></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(56, NULL, 118, 1, 56, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Firma supersport.pl jest z nami od samego początku i nie jedną jej koszulkę czy spodnie mieliśmy okazję przetestować na własnej sk&oacute;rze &ndash; dosłownie!&nbsp;Odzież takich marek jak Everlast, Tapout czy Lonsdale, kt&oacute;rych importerem jest supersports.pl, to produkty najwyższej jakości! Zapraszamy do odwiedzenia sklepu internetowego&nbsp;<a href="http://www.supersports.pl/" target="_blank" rel="nofollow" data-lynx-uri="http://l.facebook.com/?u=http%3A%2F%2Fwww.supersports.pl%2F&amp;e=ATNZeaB032QC0BhHaamJCvkdkAyke8dWd87NMN5JFB3coGPl572njz0HuHIYaS7P">www.supersports.pl</a>, w kt&oacute;rym znajdziecie wszystko, czego potrzebujecie na trening &ndash; zar&oacute;wno ten na siłowni, jak i Indoor Cycling&rsquo;owy.</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(57, NULL, 119, 1, 57, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">Fryzjernia Nunez to sąsiadka atmosfery oferująca szeroki zakres usług fryzjersko-kosmetycznych. Polecamy strzyżenie damskie i męskie, modelowanie, fryzury okazyjne, upięc<span class="text_exposed_show">ia ślubne, headline, baleyage, zabiegi pielęgnacyjne, keratynowe prostowanie, koloryzacje, przedłużanie i zagęszczanie włos&oacute;w oraz sprzedaż profesjonalnych kosmetyk&oacute;w firm takich jak Matrix czy Goldwell! Jako naszym Klubowiczom, przysługuje Wam rabat 15% na usługi Fryzjerni! Wystarczy okazać ulotkę, kt&oacute;rą znajdziecie w atmosferze.</span></p>\r\n<p style="text-align: justify;"><span class="text_exposed_show"><br />Zapraszamy na Wyszyńskiego 8, bl. 1!</span></p>\r\n<p style="text-align: justify;"><span class="text_exposed_show">512-074-630</span></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(58, NULL, 120, 1, 58, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p><a href="http://www.powerwaters.com/" target="_blank">Power Water''s</a></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(59, NULL, 121, 1, 59, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, NULL, NULL, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">FIORE to polska marka pończosznicza założona w 1998 roku w Łodzi, mieście o wieloletnich wł&oacute;kienniczych tradycjach. Tutaj znajduje się nasza siedziba, fabryka oraz powstają projekty, co pozwala nam na najwyższy poziom kontroli jakości.&nbsp;Ponad 1000 modeli w naszej ofercie powoduje, że jesteśmy w stanie odpowiedzieć na zr&oacute;żnicowane zapotrzebowanie nawet najbardziej wymagających klientek.&nbsp;W naszej pracy stawiamy przede wszystkim na jakość wykonania i najlepsze materiały. Używamy włoskich przędz, dostarczanych przez renomowanych producent&oacute;w, kt&oacute;re na świecie uchodzą za bezkonkurencyjne. Jesteśmy dumni, że możemy uczestniczyć w procesie wyznaczania nowych trend&oacute;w. Nieustannie inspirują nas świadome siebie, nowoczesne kobiety, kt&oacute;re dopasowują je do własnego stylu i osobowości.&nbsp;Ciągle się rozwijamy. Uważnie słuchamy naszych klientek, żeby każdego dnia być o krok dalej, by wychodzić naprzeciw ich oczekiwaniom.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">Odwiedźcie nas tutaj:&nbsp;<a href="http://www.fiore.pl/pl/" target="_blank">Fiore</a></p>\r\n<p style="text-align: justify;">&nbsp;</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktualnosci_trzon`
--

CREATE TABLE IF NOT EXISTS `aktualnosci_trzon` (
  `id_trzon` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_folder` int(5) unsigned DEFAULT NULL,
  `sort` int(5) unsigned DEFAULT NULL,
  `data_publikacja` date DEFAULT NULL,
  `data_modyfikacji` date DEFAULT NULL,
  `priorytet` int(1) DEFAULT NULL,
  `arch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `naglowek_h1` varchar(8) NOT NULL DEFAULT '',
  `http_auto` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_trzon`),
  KEY `aktualnosci_trzon_id_folder_FK` (`id_folder`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=122 ;

--
-- Zrzut danych tabeli `aktualnosci_trzon`
--

INSERT INTO `aktualnosci_trzon` (`id_trzon`, `id_folder`, `sort`, `data_publikacja`, `data_modyfikacji`, `priorytet`, `arch`, `naglowek_h1`, `http_auto`) VALUES
(1, 1, 3, '2015-11-17', '2016-03-31', -1, 0, 'checked', 'checked'),
(2, 1, 4, '2015-11-17', '2016-02-05', -1, 0, 'checked', 'checked'),
(4, 2, 5, '2015-11-24', '2016-03-31', -1, 0, 'checked', 'checked'),
(7, 3, 16, '2015-11-18', '2016-03-31', -1, 0, 'checked', 'checked'),
(8, 3, 114, '2015-11-18', '2016-03-31', -1, 0, 'checked', 'checked'),
(22, 4, 9, '2015-11-24', '2016-02-18', NULL, 0, 'checked', 'checked'),
(23, 5, 20, '2015-11-24', '2016-01-25', NULL, 0, 'checked', 'checked'),
(26, 3, 115, '2015-12-14', '2016-03-31', -1, 0, 'checked', 'checked'),
(27, 5, 19, '2015-12-14', '2016-01-25', NULL, 0, 'checked', 'checked'),
(28, 4, 42, '2015-12-14', '2016-02-18', NULL, 0, 'checked', 'checked'),
(29, 4, 29, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(30, 4, 10, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(31, 4, 30, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(32, 4, 31, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(33, 4, 32, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(34, 4, 33, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(35, 4, 34, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(36, 4, 35, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(37, 4, 36, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(38, 4, 37, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(39, 4, 38, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(40, 4, 39, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(41, 4, 40, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(42, 4, 41, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(43, 4, 43, '2016-01-25', '2016-02-18', NULL, 0, 'checked', 'checked'),
(44, 5, 45, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(45, 5, 46, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(46, 5, 47, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(47, 5, 48, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(48, 5, 49, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(49, 5, 50, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(50, 5, 51, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(51, 5, 52, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(52, 5, 53, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(53, 5, 54, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(54, 5, 55, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(55, 5, 56, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(56, 5, 57, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(57, 5, 58, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(58, 5, 59, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(59, 5, 60, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(60, 5, 61, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(61, 5, 62, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(63, 5, 63, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(64, 5, 64, '2016-01-25', '2016-01-25', 1, 0, 'checked', 'checked'),
(65, 5, 65, '2016-01-25', '2016-03-10', 1, 0, 'checked', 'checked'),
(66, 5, 66, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(67, 5, 67, '2016-01-25', '2016-01-25', 1, 0, 'checked', 'checked'),
(68, 5, 68, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(69, 5, 69, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(70, 5, 70, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(71, 5, 71, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(72, 5, 72, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(73, 5, 73, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(74, 5, 74, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(75, 5, 75, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(76, 5, 76, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(77, 5, 77, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(78, 5, 78, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(79, 5, 79, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(80, 5, 80, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(81, 5, 81, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(82, 5, 82, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(83, 5, 83, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(84, 5, 84, '2016-01-25', '2016-01-25', 1, 0, 'checked', 'checked'),
(85, 5, 85, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(86, 5, 86, '2016-01-25', '2016-01-25', 1, 0, 'checked', 'checked'),
(87, 5, 87, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(88, 5, 88, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(89, 5, 89, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(90, 5, 90, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(91, 5, 91, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(92, 5, 92, '2016-01-25', '2016-01-25', 1, 0, 'checked', 'checked'),
(93, 5, 93, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(94, 5, 94, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(95, 5, 95, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(96, 5, 96, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(97, 5, 97, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(98, 5, 98, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(99, 5, 99, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(100, 5, 100, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(101, 5, 101, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(102, 5, 102, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(103, 5, 103, '2016-01-25', '2016-01-25', NULL, 0, 'checked', 'checked'),
(106, 3, 116, '2016-02-27', '2016-03-31', -1, 0, 'checked', 'checked'),
(107, 3, 117, '2016-02-27', '2016-03-31', -1, 0, 'checked', 'checked'),
(108, 3, 118, '2016-02-27', '2016-03-31', -1, 0, 'checked', 'checked'),
(109, 3, 113, '2016-02-27', '2016-03-31', -1, 0, 'checked', 'checked'),
(110, 3, 15, '2016-02-27', '2016-03-31', -1, 0, 'checked', 'checked'),
(111, 3, 120, '2016-02-27', '2016-03-31', -1, 0, 'checked', 'checked'),
(113, 3, 14, '2016-03-21', '2016-03-24', -1, 0, 'checked', 'checked'),
(114, 3, 11, '2016-03-24', '2016-03-24', -1, 0, 'checked', 'checked'),
(115, 3, 10, '2016-03-24', '2016-03-24', -1, 0, 'checked', 'checked'),
(116, 3, 9, '2016-03-24', '2016-03-24', -1, 0, 'checked', 'checked'),
(117, 3, 8, '2016-03-24', '2016-03-24', -1, 0, 'checked', 'checked'),
(118, 3, 7, '2016-03-24', '2016-03-24', -1, 0, 'checked', 'checked'),
(119, 3, 6, '2016-03-24', '2016-03-28', -1, 0, 'checked', 'checked'),
(120, 3, 121, '2016-03-31', '2016-03-31', -1, 0, 'checked', 'checked'),
(121, 3, 12, '2016-03-31', '2016-03-31', -1, 0, 'checked', 'checked');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artykuly_nazwa`
--

CREATE TABLE IF NOT EXISTS `artykuly_nazwa` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_trzon` int(5) unsigned DEFAULT NULL,
  `id_lang` int(1) unsigned DEFAULT NULL,
  `naglowek` varchar(255) DEFAULT NULL,
  `tytul_strony` varchar(255) DEFAULT NULL,
  `opis_szukanie` text,
  `slowa_kluczowe` varchar(255) DEFAULT NULL,
  `link_htaccess` varchar(255) DEFAULT NULL,
  `http` varchar(255) DEFAULT NULL,
  `http_target` varchar(10) NOT NULL DEFAULT '_self',
  `widok_lang` varchar(8) NOT NULL DEFAULT '',
  `seo_text` text,
  PRIMARY KEY (`id`),
  KEY `artykuly_nazwa_id_lang_FK` (`id_lang`),
  KEY `artykuly_nazwa_id_trzon_FK` (`id_trzon`),
  KEY `link_htaccess` (`link_htaccess`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Zrzut danych tabeli `artykuly_nazwa`
--

INSERT INTO `artykuly_nazwa` (`id`, `id_trzon`, `id_lang`, `naglowek`, `tytul_strony`, `opis_szukanie`, `slowa_kluczowe`, `link_htaccess`, `http`, `http_target`, `widok_lang`, `seo_text`) VALUES
(1, 1, 1, 'Menu', NULL, NULL, NULL, '', NULL, '_self', 'checked', NULL),
(2, 2, 1, 'home', '', '', '', 'home', '', '_self', 'checked', 'atmosfera fitness & wellness to dwie siłownie: strefa siły oraz strefa cardio, wyposażone w najnowszy sprzęt firmy Technogym, a także dwie sale do zajęć grupowych: fitnessowa oraz rowerowa. Oferujemy szeroki wybór zajęć: taneczne, muscle, cardio, jak i treningów mentalnych. Jako jedyni proponujemy KRANKING®, BOSU, Indoor Cycling na najnowszych rowerach Tomahawk, a także szeroką gamę masaży oraz kojący odpoczynek w strefie relaksu. Naszą ofertę sprowadzamy do trzech kluczowych wartości PIĘKNA, SIŁY I HARMONII.'),
(8, 8, 1, 'cennik', NULL, NULL, NULL, 'cennik', '', '_self', 'checked', NULL),
(12, 12, 1, 'UKRYTE', NULL, NULL, NULL, 'ukryte', NULL, '_self', 'checked', NULL),
(13, 13, 1, 'Aktualności', NULL, NULL, NULL, 'aktualnosci', '', '_self', 'checked', NULL),
(14, 14, 1, 'o klubie atmosfera', NULL, NULL, NULL, 'o-klubie-atmosfera', '', '_self', 'checked', NULL),
(17, 17, 1, 'ADRES STOPKA', NULL, NULL, NULL, 'adres-stopka', '', '_self', 'checked', NULL),
(18, 18, 1, 'KONTAKT STOPKA', '', '', '', 'kontakt-stopka', '', '_self', 'checked', 'asdf'),
(19, 19, 1, 'galeria', NULL, NULL, NULL, 'galeria', '', '_self', 'checked', NULL),
(20, 20, 1, 'przyjaciele atmosfery', NULL, NULL, NULL, 'przyjaciele-atmosfery', '', '_self', 'checked', NULL),
(22, 22, 1, 'Treningi', NULL, NULL, NULL, 'treningi', '', '_self', 'checked', NULL),
(26, 26, 1, 'kontakt', NULL, NULL, NULL, 'kontakt', '', '_self', 'checked', NULL),
(29, 29, 1, 'poznaj nas!', NULL, NULL, NULL, 'poznaj-nas', NULL, '_self', 'checked', NULL),
(31, 31, 1, 'manager klubu', NULL, NULL, NULL, 'poznaj-nas/manager-klubu', '', '_self', 'checked', NULL),
(32, 32, 1, 'instruktorzy', NULL, NULL, NULL, 'poznaj-nas/instruktorzy', '', '_self', 'checked', NULL),
(33, 33, 1, 'recepcja', NULL, NULL, NULL, 'poznaj-nas/recepcja', '', '_self', 'checked', NULL),
(34, 34, 1, 'zajęcia', NULL, NULL, NULL, 'zajecia', NULL, '_self', 'checked', NULL),
(35, 35, 1, 'grafik zajęć', NULL, NULL, NULL, 'grafik', '', '_self', 'checked', NULL),
(36, 36, 1, 'opis zajęć grupowych', NULL, NULL, NULL, 'zajecia/opis-zajec-grupowych', '', '_self', 'checked', NULL),
(40, 40, 1, 'wellness', NULL, NULL, NULL, 'wellness', NULL, '_self', 'checked', NULL),
(41, 41, 1, 'gabinet masażu', NULL, NULL, NULL, 'wellness/gabinet-masazu', '', '_self', 'checked', NULL),
(42, 42, 1, 'sauna i strefa relaksu', NULL, NULL, NULL, 'wellness/sauna-i-strefa-relaksu', '', '_self', 'checked', NULL),
(44, 44, 1, 'siłownia', NULL, NULL, NULL, 'silownia', NULL, '_self', 'checked', NULL),
(45, 45, 1, 'strefa siły', NULL, NULL, NULL, 'silownia/strefa-sily', '', '_self', 'checked', NULL),
(46, 46, 1, 'strefa cardio', NULL, NULL, NULL, 'silownia/strefa-cardio', '', '_self', 'checked', NULL),
(47, 47, 1, 'trening personalny', NULL, NULL, NULL, 'silownia/trening-personalny', '', '_self', 'checked', NULL),
(49, 49, 1, 'analiza składu ciała', NULL, NULL, NULL, 'silownia/analiza-skladu-ciala', '', '_self', 'checked', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artykuly_tresc`
--

CREATE TABLE IF NOT EXISTS `artykuly_tresc` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_rodzic_blok` int(5) unsigned DEFAULT NULL,
  `id_art_nazwa` int(5) unsigned DEFAULT NULL,
  `id_lang` int(1) unsigned DEFAULT NULL,
  `sort` int(5) unsigned DEFAULT NULL,
  `naglowek_bloku` varchar(255) DEFAULT NULL,
  `naglowek_bloku_typ` varchar(10) DEFAULT NULL,
  `id_zdjecie_1` int(5) unsigned DEFAULT NULL,
  `rozmiar_1` tinyint(1) unsigned DEFAULT NULL,
  `podpis_1` varchar(255) DEFAULT NULL,
  `adres_1` varchar(255) DEFAULT NULL,
  `powieksz_1` varchar(8) NOT NULL DEFAULT '',
  `target_1` varchar(8) NOT NULL DEFAULT '',
  `alt_1` varchar(255) DEFAULT NULL,
  `title_1` varchar(255) DEFAULT NULL,
  `id_zdjecie_2` int(5) unsigned DEFAULT NULL,
  `rozmiar_2` tinyint(1) unsigned DEFAULT NULL,
  `podpis_2` varchar(255) DEFAULT NULL,
  `adres_2` varchar(255) DEFAULT NULL,
  `powieksz_2` varchar(8) NOT NULL DEFAULT '',
  `target_2` varchar(8) NOT NULL DEFAULT '',
  `alt_2` varchar(255) DEFAULT NULL,
  `title_2` varchar(255) DEFAULT NULL,
  `id_zdjecie_3` int(5) unsigned DEFAULT NULL,
  `rozmiar_3` tinyint(1) unsigned DEFAULT NULL,
  `podpis_3` varchar(255) DEFAULT NULL,
  `adres_3` varchar(255) DEFAULT NULL,
  `powieksz_3` varchar(8) NOT NULL DEFAULT '',
  `target_3` varchar(8) NOT NULL DEFAULT '',
  `alt_3` varchar(255) DEFAULT NULL,
  `title_3` varchar(255) DEFAULT NULL,
  `tresc` text,
  `oblewanie_zdjecie` varchar(8) NOT NULL DEFAULT '',
  `id_plik_1` int(5) unsigned DEFAULT NULL,
  `nazwa_plik_1` varchar(255) DEFAULT NULL,
  `id_plik_2` int(5) unsigned DEFAULT NULL,
  `nazwa_plik_2` varchar(255) DEFAULT NULL,
  `typ_plik` tinyint(1) unsigned DEFAULT NULL,
  `widocznosc` varchar(8) NOT NULL DEFAULT '',
  `typ` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `typ_zaawansowany` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `artykuly_tresc_id_lang_FK` (`id_lang`),
  KEY `artykuly_tresc_id_art_nazwa_FK` (`id_art_nazwa`),
  KEY `artykuly_tresc_id_rodzic_blok_FK` (`id_rodzic_blok`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- Zrzut danych tabeli `artykuly_tresc`
--

INSERT INTO `artykuly_tresc` (`id`, `id_rodzic_blok`, `id_art_nazwa`, `id_lang`, `sort`, `naglowek_bloku`, `naglowek_bloku_typ`, `id_zdjecie_1`, `rozmiar_1`, `podpis_1`, `adres_1`, `powieksz_1`, `target_1`, `alt_1`, `title_1`, `id_zdjecie_2`, `rozmiar_2`, `podpis_2`, `adres_2`, `powieksz_2`, `target_2`, `alt_2`, `title_2`, `id_zdjecie_3`, `rozmiar_3`, `podpis_3`, `adres_3`, `powieksz_3`, `target_3`, `alt_3`, `title_3`, `tresc`, `oblewanie_zdjecie`, `id_plik_1`, `nazwa_plik_1`, `id_plik_2`, `nazwa_plik_2`, `typ_plik`, `widocznosc`, `typ`, `typ_zaawansowany`) VALUES
(1, NULL, 14, 1, 1, NULL, NULL, 8, 2, '', 'przyjaciele-atmosfery', 'checked', '_self', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><span style="font-size: 18px;">Witaj w klubie jedynym w swoim rodzaju. </span></p>\r\n<p style="text-align: justify;"><span style="font-size: 18px;">Witaj w miejscu, w kt&oacute;rym spełnisz swoje marzenia.</span></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><span style="font-size: 18px;">Skąd mamy tę pewność? Bo tworzą je ludzie, kt&oacute;rzy spełniają swoje. Nie pytaj więc "czy da się?", tylko zaufaj nam. Naszą misją jest pokazać Ci, jak to zrobić. </span></p>\r\n<p style="text-align: justify;"><span style="font-size: 18px;">Potrzebujemy jednak Twojej pomocy. Musisz sam postawić sw&oacute;j&nbsp;pierwszy krok i opowiedzieć nam o swoich marzeniach! Naszym wsp&oacute;lnym celem będzie to, aby stały się one rzeczywistością.</span></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><span style="font-size: 18px;"><span style="color: #99cc00;"><span style="color: #000000;">Lepsze życie zaczyna się</span></span><strong><span style="color: #99cc00;"> w atmosferze</span></strong>. Rozpocznij je już dziś!</span></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(2, NULL, 17, 1, 2, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><strong>atmosfera fitness &amp; wellness</strong><br />C.H. Piaski (wejście z boku, obok marketu Mila)<br />al. Wyszyńskiego 7A<br />94-042 Ł&oacute;dź</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(3, NULL, 18, 1, 3, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><strong>Klub czynny</strong>: pn-pt: 6:00-23:00,<br />sob: 8:30-17:30, nd: 9:00-17:00<br /><strong>Kontakt</strong>: tel. (42) 233 66 33, mob. 798 755 560<br />e-mail:&nbsp;<a href="mailto:klub@atmosfera-fitness.pl">klub@atmosfera-fitness.pl</a></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(6, NULL, 19, 1, 7, NULL, NULL, 77, 1, NULL, NULL, 'checked', '', NULL, NULL, 74, 1, NULL, NULL, 'checked', '', NULL, NULL, 95, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(7, NULL, 19, 1, 8, NULL, NULL, 94, 1, NULL, NULL, 'checked', '', NULL, NULL, 93, 1, NULL, NULL, 'checked', '', NULL, NULL, 78, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(11, NULL, 13, 1, 11, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(29, NULL, 26, 1, 29, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><strong>atmosfera fitness &amp; wellness</strong><br />C.H. Piaski (wejście z boku, obok marketu Mila)<br />al. Wyszyńskiego 7A<br />94-042 Ł&oacute;dź<br /><br /><strong>Klub czynny:</strong><br />pn-pt: 6:00-23:00, sob: 8:30-17:30, nd: 9:00-17:00</p>\r\n<p><strong><br />Kontakt:</strong> <br />tel. (42) 233 66 33, mob. 798 755 560 <br />e-mail:&nbsp;<a href="mailto:klub@atmosfera-fitness.pl">klub@atmosfera-fitness.pl</a></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(30, NULL, 26, 1, 30, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2470.17612420803!2d19.41063171599211!3d51.74810290089592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471a35151f5343c9%3A0x684c32b5191ff9f2!2zV3lzennFhHNraWVnbyA3QSwgOTQtMDQyIMWBw7Nkxbo!5e0!3m2!1spl!2spl!4v1448980214899" width="550" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>', '', NULL, NULL, NULL, NULL, 1, 'checked', 6, 0),
(46, NULL, 31, 1, 46, NULL, NULL, 53, 1, 'Małgorzata Oryńska', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;"><strong><span style="color: #99cc00;">Małgorzata Oryńska</span></strong><br /><br /><strong>Manager Klubu</strong><br />e-mail: m.orynska@atmosfera-fitness.pl<br /><br />Jestem absolwentką Stosunk&oacute;w Międzynarodowych ze specjalizacją Marketing Międzynarodowy na Uniwersytecie Ł&oacute;dzkim. Swoją przygodę z branżą fitness rozpoczęłam jeszcze na studiach, kiedy to pracowałam w recepcji jednego z ł&oacute;dzkich fitness klub&oacute;w. Od początku czułam, że to idealne miejsce dla mnie. Swoją wiedzę i kompetencje w zakresie obsługi klienta oraz branży fitness stale poszerzam biorąc udział w r&oacute;żnego rodzaju szkoleniach i konferencjach. To co sprawia, że jestem szczęśliwa to moja rodzina i przyjaciele. Wrodzony optymizm sprawia, że każdego dnia znajduję masę powod&oacute;w do radości i uśmiech wiecznie widnieje na mojej twarzy. Kocham sport i od lat towarzyszy mi on niemal każdego dnia. Jestem r&oacute;wnież licencjonowanym instruktorem Indoor Cycling i spełniam się także jako instruktor tych zajęć. W wolnych chwilach uwielbiam jeździć na rowerze, spacerować, czytać książki i gotować.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong>Dla mnie w pracy najważniejsza jest:</strong><br />atmosfera, kt&oacute;ra sprawia, że przychodzę do pracy z uśmiechem na twarzy oraz kontakt z ludźmi, dzięki kt&oacute;rym każdego dnia uczę się czegoś nowego.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />poczucie spełnienia. Uważam, że to najlepsza branża na świecie, ponieważ pomagamy ludziom - dbamy o ich zdrowie fizyczne i psychiczne, a często nawet&nbsp; spełniamy ich marzenia... :)</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(49, NULL, 32, 1, 49, NULL, NULL, 57, 1, 'Kamila Górecka', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;"><span style="font-size: 16px;"><strong><span style="color: #99cc00;">Kamila G&oacute;recka</span></strong></span><br /><br /><span style="font-size: 15px;"><strong>Manager Fitness</strong></span><br /><br />e-mail: k.adamowicz@atmosfera-fitness.pl<br /><br /><strong>Instruktor Fitness / Instruktor Tańca / Instruktor Kulturystyki / Trener Personalny</strong><br /><br />Jestem sobie taka mała nieśmiała na tym świecie, mn&oacute;stwo rzeczy się wok&oacute;ł mnie dzieje, co uwielbiam. Moje pasje i przyjaciele są dla mnie podporą, a praca pozwala mi się realizować. Uwielbiam wyzwania, ale także doceniam spok&oacute;j i ciszę. Niestety jestem pracoholikiem, chyba nieuleczalnym. Kocham podr&oacute;że, przede wszystkim wędr&oacute;wki g&oacute;rskie, kt&oacute;re mnie relaksują i uspokajają, snowboard, na kt&oacute;rym mogę się wyszaleć, żagle, bule, las, film, spok&oacute;j umiarkowany; taniec, fitness i aerobik to moje pasje.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-Warsztaty OM - Trening Obwodowy, Ł&oacute;dź 2016</span><br /><span style="font-size: 12px;">-Szkolenie PERFECT PT Katarzyna Figuła - styczeń 2016 Ł&oacute;dź</span><br /><span style="font-size: 12px;">-PortDeBras Basic - International Fitness Education - Wrocław 2015</span><br /><span style="font-size: 12px;">-Ćwiczenia dla mam z małymi dziećmi - Aktywna Mama - Klub Aktywnej Mamy Katarzyna Sempolska - Warszawa 2015</span><br /><span style="font-size: 12px;">-Aktywność fizyczna kobiet w ciąży - Aktywne 9 miesięcy - Katarzyna Sempolska Warszawa 2015</span><br /><span style="font-size: 12px;">-Warsztaty OM Stretch: w parach w treningu personalnym, w parach dla przyjemności, stretching Meridian&oacute;w, -stretching powięziowy, Krak&oacute;w 2015</span><br /><span style="font-size: 12px;">-bodyART day, Warszawa 2015</span><br /><span style="font-size: 12px;">-Trener Therapy Fitness - Open Mind Health &amp; Fitness Idea, Warszawa 2014</span><br /><span style="font-size: 12px;">-Team ICG Basic - Tomahawk, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Pierwsza pomoc - Podstawowe zabiegi resuscytacyjne w stanach zagrożenia życia z użyciem -automatycznego defibrylatora zewnętrznego AED, D&amp;J Medica, Ł&oacute;dź maj 2014</span><br /><span style="font-size: 12px;">-bodyART Pure, Wrocław 2014</span><br /><span style="font-size: 12px;">-Szkolenie z technik fitnessowych Kettlebell - Kettlebell Power, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Szkolenie z technik Kettlebell metodą Hardstyle - Kettlebell Power, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Dieta i Suplementacja cz.1, Open Mind Health&amp;Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Systemy podwieszane, Open Mind Health&amp;Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-BodyArt Stretch, Julią Przybylka, Krak&oacute;w 2012</span><br /><span style="font-size: 12px;">-Szkolenie OM Ovo Ball, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-BodyArt Dynamic z Rita Lencses, Wrocław 2012</span><br /><span style="font-size: 12px;">-Magister Pedagogiki w zakresie profilaktyki i animacji społeczno-kulturalnej &mdash; Uniwersytet Ł&oacute;dzki 2006</span><br /><span style="font-size: 12px;">-Licencjat z Pedagogiki kultury fizyczno-zdrowotnej &mdash; Uniwersytet Ł&oacute;dzki 2011</span><br /><span style="font-size: 12px;">-GRAVITY&reg; Master Trainer &mdash; Foundation</span><br /><span style="font-size: 12px;">-Instruktor bodyArt &mdash; bodArt Polska 2011 Krak&oacute;w</span><br /><span style="font-size: 12px;">-Szkolenie bodyART Flow Alexa L&eacute; School, Krak&oacute;w 2011</span><br /><span style="font-size: 12px;">-Instruktor wibrotreningu &mdash; Instytut wibrotreningu Fit Med., Bielsko Biała 2009</span><br /><span style="font-size: 12px;">-Szkolenie Pilates Matwork 2, Open Mind Health &amp; fitness Idea, Warszawa 2008</span><br /><span style="font-size: 12px;">-Instruktor Sportu ze specjalnością kulturystyka (legitymacja państwowa), Państwowy Związek Kulturystyki i -Tr&oacute;jboju Siłowego, Warszawa 2008</span><br /><span style="font-size: 12px;">-Szkolenie Yoga Stretch, Open Mind Health &amp; Fitness Idea, Gdynia 2008</span><br /><span style="font-size: 12px;">-Szkolenie Pilates Matwork Fundamentals, Open Mind Health &amp; Fitness Idea, Warszawa 2007</span><br /><span style="font-size: 12px;">-Szkolenie z Pierwszej pomocy przedmedycznej, Warszawa 2007</span><br /><span style="font-size: 12px;">-Instruktor 3 Dance, 3 step, Warszawa 2007</span><br /><span style="font-size: 12px;">-Szkolenie Dance Workshop, Open Mind Health &amp; Fitness Idea, Dźwirzyno 2007</span><br /><span style="font-size: 12px;">-Szkolenie Yoga Shape Static &amp; Action, Open Mind Health &amp; Fitness Idea, Dźwirzyno 2007</span><br /><span style="font-size: 12px;">-Szkolenie Yoga Balance Basic, Open Mind Health &amp; Fitness Idea, Dźwirzyno 2007</span><br /><span style="font-size: 12px;">-Szkolenie Power Gym, Open Mind Health &amp; Fitness Idea, Szczecin 2007</span><br /><span style="font-size: 12px;">-Szkolenie Aero-box, Open Mind Health &amp; Fitness Idea, Szczecin 2006</span><br /><span style="font-size: 12px;">-Instruktor Advanced Aerobik, Open Mind Health &amp; Fitness Idea, Szczecin 2006</span><br /><span style="font-size: 12px;">-Instructor Basic Aerobik (legitymacja państwowa), Open Mind Health &amp; Fitness Idea, Szczecin 2006</span><br /><span style="font-size: 12px;">-Szkolenie Stretching, Open Mind Health &amp; Fitness Idea, Dźwirzyno 2006</span><br /><span style="font-size: 12px;">-Szkolenie Body Ball, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2006</span><br /><span style="font-size: 12px;">-Certificate Bosu Integrated Balance Training, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2006</span><br /><span style="font-size: 12px;">-Szkolenie Nike Rockstar Workout Hip Hop, Nike, Ł&oacute;dź 2006</span><br /><span style="font-size: 12px;">-Szkolenie Nike Rockstar Workout Sol, Nike, Ł&oacute;dź 2005</span><br /><span style="font-size: 12px;">-Instruktor I choreograf tańca jazzowego (legitymacja państwowa),</span><br /><span style="font-size: 12px;">-Nowohuckie Centrum Kultury, Krak&oacute;w 2005</span><br /><span style="font-size: 12px;">-Szkolenie Afro Dance, Open Mind Health &amp; Fitness Idea, Warszawa 2004</span><br /><span style="font-size: 12px;">-Wychowawca plac&oacute;wek wypoczynku dla dzieci I młodzieży, Centrum Doskonalenia Nauczycieli, Ł&oacute;dź 2004</span></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Dla mnie w pracy najważniejsze są:</strong><br />uśmiech i radość klient&oacute;w widzących efekty naszej wsp&oacute;lnej pracy i ta niesamowita relacja, kt&oacute;ra się między nami tworzy.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />możliwość realizowania się i jest dla mnie cudownym wyzwaniem.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(50, NULL, 32, 1, 50, NULL, NULL, 55, 1, 'Julia Matyasz', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="color: #99cc00; font-size: 16px;"><strong>Julia Matyasz</strong></span></p>\r\n<p><br /><strong>Instruktor Fitness / Instruktor Siłowni / Trener Personalny</strong></p>\r\n<p style="text-align: justify;"><br />Jestem magistrem Animacji Społeczno-Kulturalnej Uniwersytetu Zielonog&oacute;rskiego oraz absolwentką Nauczycielskiego Kolegium Język&oacute;w Obcych przy Uniwersytecie im. A. Mickiewicza w Poznaniu. Posiadam także dyplom Instruktora Fitness Uniwersytetu Stirling w Szkocji. Mam za sobą 7 lat nauki tańca i występ&oacute;w scenicznych, w tym gł&oacute;wnie hip hop i street dance. Uczestniczyłam w Mistrzostwach Świata w Bremen oraz Mistrzostwach Polski Tańca Nowoczesnego. Poznałam techniki tańca towarzyskiego, belly dance, afro, wsp&oacute;łczesnego, klasycznego oraz jazz na kursach i warsztatach w Polsce i Szkocji. Uwielbiam aktywność bo daje mi ogromną dawkę wolności! Na co dzień i od święta upajam się muzyką Eryki Badu.<br /> <br /> <strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-Warsztat Metodyczny Reebok Fitness University - Reggaeton, Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-Dietetyka i suplementacja Poziom 3 - mauricz.com Listopad 2014, Warszawa</span><br /><span style="font-size: 12px;">-Pierwsza pomoc - Podstawowe zabiegi resuscytacyjne w stanach zagrożenia życia z użyciem automatycznego defibrylatora zewnętrznego AED, D&amp;J Medica, Ł&oacute;dź maj 2014</span><br /><span style="font-size: 12px;">-Basic Personal Trainer, Kuźnia Trener&oacute;w, Ł&oacute;dź</span><br /><span style="font-size: 12px;">-Warsztaty Shape OM Event Day, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-IFAA Hip-Hop Instruktor, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-OM Event Day, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-Szkolenie Aerobik Instruktor Open Mind Health &amp; Fitness Idea</span><br /><span style="font-size: 12px;">-Gravity Foundation Course</span><br /><span style="font-size: 12px;">-Instructing Exercise &amp; Fitness &mdash; University of Stirling, Szkocja</span><br /><span style="font-size: 12px;">-Dance Workshop, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2011</span><br /><span style="font-size: 12px;">-Warsztaty Dance i Wzmacnianie Open Mind Health &amp; Fitness Idea</span><br /><span style="font-size: 12px;">-Kranking by Johny G</span><br /><span style="font-size: 12px;">-Team ICG Basic &mdash; Tomahawk</span><br /><span style="font-size: 12px;">-Pool Attendant &mdash; Safety Training Awards, Szkocja</span><br /><span style="font-size: 12px;">-Pre &amp; Post Natal Exercise &mdash; Premier Training Solutions, Szkocja</span><br /><span style="font-size: 12px;">-First Aid &mdash; Pierwsza Pomoc &mdash; Wallace Cameron, Szkocja</span><br /><span style="font-size: 12px;">-Project Y 2008, Scottish Youth Dance Company, Szkocja</span><br /><span style="font-size: 12px;">-Międzynarodowe Warsztaty Tańca Wsp&oacute;łczesnego w Poznaniu &mdash; Afro Brasil</span><br /> <br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />kontynuowanie pasji życiowej i zawodowej.</p>\r\n<p style="text-align: justify;"><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />to, czego od dawna szukałam, czyli możliwości przebywania w cudownym miejscu z niesamowitymi ludźmi.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(51, NULL, 32, 1, 54, NULL, NULL, 53, 1, 'Gosia Oryńska', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="color: #99cc00; font-size: 16px;"><strong>Gosia Oryńska</strong></span></p>\r\n<p><br /><strong>Instruktor Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Sport jest w moim życiu od zawsze. Od dziecka bardzo aktywnie spędzałam wolny czas. Moją najmocniejszą stroną zawsze były biegi na kr&oacute;tkie dystanse. Rower z kolei jest moją największą pasją - w sezonie najchętniej wcale bym z niego nie schodziła. Swoje zamiłowanie do sportu pogłębiam także na siłowni, zajęciach fitness i Indoor Cycling. Jazda na rowerze, czy to w plenerze czy w klubie, powoduje, że uśmiech nie schodzi z mojej twarzy. Taki sam efekt chcę wywoływać u wszystkich uczestnik&oacute;w swoich zajęć. Wierzę, że bezpieczny trening połączony z doskonałą zabawą dostarcza każdemu masę pozytywnej energii.<br /> <br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-OM Kettlebells, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-Team ICG Licencja A - Tomahawk, Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-TRX&reg; GSTC, ekspertfitness.com, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Pierwsza pomoc - Podstawowe zabiegi resuscytacyjne w stanach zagrożenia życia z użyciem automatycznego defibrylatora zewnętrznego AED, D&amp;J Medica, Ł&oacute;dź maj 2014</span><br /><span style="font-size: 12px;">-Dieta i Suplementacja cz.1, Open Mind Health&amp;Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Team ICG Licencja B &mdash; Tomahawk, Warszawa 2012</span><br /><span style="font-size: 12px;">-Team ICG Basic &mdash; Tomahawk, Toruń 2012</span><br /> <br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />zadowolenie i uśmiech uczestnik&oacute;w moich zajęć.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />szansę na rozwijanie swojej pasji i zarażanie nią innych.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(52, NULL, 32, 1, 52, NULL, NULL, 59, 1, 'Kuba Drobik', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Kuba Drobik</strong></span></p>\r\n<p><br /><strong>Instruktor Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Sport to moja pasja od najmłodszych lat. Jako dziecko trenowałem pływanie i piłkę nożną. P&oacute;źniej zajmowałem się kolarstwem ekstremalnym, r&oacute;wnież jako manager teamu, dzięki czemu zdobyłem niezbędne doświadczenie i poznałem ten sport od podszewki. Z wykształcenia absolwent Zarządzania i Marketingu, a zawodowo instruktor Indoor Cycling oraz KRANKING, pragnę swoją pasją zarazić innych. Zawsze staram się przekazać mn&oacute;stwo pozytywnej energii, zmotywować do wysiłku oraz zadbać o uśmiech i udaną zabawę.<br /> <br /> <br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-TRX FTC, 2016</span><br /><span style="font-size: 12px;">-Szkolenie Kamagon - Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-OM Kettlebells, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-Team ICG Licencja A - Tomahawk, Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-TRX&reg; GSTC, ekspertfitness.com, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Pierwsza pomoc - Podstawowe zabiegi resuscytacyjne w stanach zagrożenia życia z użyciem automatycznego defibrylatora zewnętrznego AED, D&amp;J Medica, Ł&oacute;dź maj 2014</span><br /><span style="font-size: 12px;">-Team ICG Licencja B &mdash; Tomahawk, Poznań 2013</span><br /><span style="font-size: 12px;">-Myride+ &mdash; Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Team ICG Basic &mdash; Tomahawk, Ł&oacute;dź 2011</span><br /><span style="font-size: 12px;">-KRANKING Fundamentals, Warszawa 2010</span></p>\r\n<p style="text-align: justify;"><br /><strong>Dla mnie w pracy najważniejsza jest:</strong><br />satysfakcja z wykonywanych zadań oraz dobre samopoczucie uczestnik&oacute;w zajęć.</p>\r\n<p style="text-align: justify;"><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />możliwość nawiązania nowych znajomości oraz zdobycia doświadczenia.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(53, NULL, 32, 1, 51, NULL, NULL, 56, 1, 'Katarzyna Wiaderny', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="color: #99cc00;"><strong><span style="font-size: 16px;">Katarzyna Wiaderny</span></strong></span></p>\r\n<p><br /><strong>Instruktor Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Jestem absolwentką Politechniki Ł&oacute;dzkiej o specjalności &bdquo;Bioinżynieria Medyczna", Instruktorem Rekreacji Ruchowej oraz Dyplomowanym Instruktorem Fitness i Trenerem Personalnym. Jako uczennica w &bdquo;Szkole Jogi&rdquo; Agaty Biernat, poszerzam swoją wiedzę i pogłębiam praktykę na temat świadomych technik pracy z ciałem. Joga nieustannie zachwyca mnie, dzięki niej wzbogaciłam sw&oacute;j warsztat. Doświadczenie z zakresu trening&oacute;w funkcjonalnych i prozdrowotnych, pozwala mi lepiej zrozumieć ograniczenia umysłu i ciała ludzkiego. Z ogromną uwagą towarzyszę tym, kt&oacute;rzy stawiają swoje pierwsze kroki w świecie aktywności fizycznej i odkrywają, że wszystko jest możliwe dzięki systematycznym treningom. Na moich zajęciach dowiesz się jak bezpiecznie pracować z ciałem, poprawisz elastyczność, siłę mięśni i nabierzesz energii. Uważam, że dla każdego istnieje idealna forma ruchu, trzeba tylko poszukać. Praca z ludźmi to moja ogromna pasja i cenna szkoła życia.<br /> <br /><strong>Odbyte kursy i szkolenia instruktorskie</strong><br /><span style="font-size: 12px;">-I stopień Naturalnego Uzdrawiania Metodą REIKI Usui Shiki Ryoho, Mistrz REIKI Betika Pacześniewska-Łacny</span><br /><span style="font-size: 12px;">-Pierwsza pomoc - Podstawowe zabiegi resuscytacyjne w stanach zagrożenia życia z użyciem automatycznego defibrylatora zewnętrznego AED, D&amp;J Medica, Ł&oacute;dź maj 2014</span><br /><span style="font-size: 12px;">-Dyplom OM Stretching &amp; Relaks, Open Mind Health&amp;Fitness Idea</span><br /><span style="font-size: 12px;">-Gravity Foundation Course</span><br /><span style="font-size: 12px;">-Instruktor Pilaters - BB Pilates School</span><br /><span style="font-size: 12px;">-Instruktor Pilates Senior - BB Pilates School</span><br /><span style="font-size: 12px;">-Szkolenie Pilates "Praca na matach I i II stopień" - BB Pilates School</span><br /><span style="font-size: 12px;">-Nauczyciel Jogi wg. metody B.K.S Iyengara - OM JOGA CLASSIC SCHOOL</span><br /><span style="font-size: 12px;">-Instruktor Rekreacji Ruchowej o specjalności fitness &mdash; uprawnienie państwowe Ministerstwa Sportu</span><br /><span style="font-size: 12px;">-Instruktor Aerobiku nr zaświadczenia: EKF-VI 4320-2-p.n./2002</span><br /><span style="font-size: 12px;">-Open Mind Aerobik Instruktor Instructor</span><br /><span style="font-size: 12px;">-Trener personalny, Open Mind Health&amp;Fitness Idea</span><br /><span style="font-size: 12px;">-Instructor Reebok &bdquo;Jukari fit to flex&rdquo; I</span><br /><span style="font-size: 12px;">-Szkolenie Advanced Body, Open Mind Health&amp;Fitness Idea</span><br /><span style="font-size: 12px;">-Szkolenie Advanced Step, Open Mind Health&amp;Fitness Idea</span><br /><span style="font-size: 12px;">-Szkolenie Stretching, Open Mind Health&amp;Fitness Idea</span><br /><span style="font-size: 12px;">-Szkolenie Body ball, Open Mind Health&amp;Fitness Idea</span><br /><span style="font-size: 12px;">-Szkolenie Reha - fit, Open Mind Health&amp;Fitness Idea</span><br /><span style="font-size: 12px;">-Szkolenie Osteo - fit, Open Mind Health&amp;Fitness Idea</span><br /><span style="font-size: 12px;">-Szkolenie Meno - fit, Open Mind Health&amp;Fitness Idea</span><br /><span style="font-size: 12px;">-Szkolenie Senior, Open Mind Health&amp;Fitness Idea</span><br /><span style="font-size: 12px;">-Szkolenie Pilates, IFAA Polska</span><br /><span style="font-size: 12px;">-Szkolenie &bdquo;Jukari fit to flex&rdquo;, Reebok</span><br /><span style="font-size: 12px;">-Szkolenie &bdquo;Jukari fit to fly&rdquo;, Reebok</span><br /><span style="font-size: 12px;">-Szkolenie &bdquo;Aktywna Mama&rdquo; KAM &mdash; ćwiczenia dla kobiet z małymi dziećmi</span><br /><span style="font-size: 12px;">-Szkolenie Olimp &mdash; &bdquo;Wsp&oacute;łczesne podejście do suplementacji w żywieniu sportowc&oacute;w&rdquo;</span><br /><span style="font-size: 12px;">-Warsztaty i konwencje: Open Mind Health&amp;Fitness Idea, IFAA, Nike Dancehall, Adidas</span><br /><span style="font-size: 12px;">-Trener BlackRoll - Kurs BLACKROLL Polska 2015</span><br /> <br /><strong>Dla mnie w pracy najważniejsza jest:</strong><br />wymiana energii :)</p>\r\n<p style="text-align: justify;"><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />satysfakcję i możliwość realizacji swojej pasji.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(54, NULL, 32, 1, 56, NULL, NULL, 65, 1, 'Paulina Szternel', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Paulina Szternel</strong></span></p>\r\n<p><br /><strong>Instruktor Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Jestem absolwentką Uniwersytetu Ł&oacute;dzkiego. Finanse i Rachunkowośc oraz Zarządzanie to dziedziny, kt&oacute;re pochłonęły kilka lat mojego życia. Umysł ścisły jednak nie wyklucza mojego zamiłowania do sportu i aktywnego trybu życia. Przygodę z fitnessem zaczęłam za granicą, to tam zrodziła się pasja, zamiłowanie i spos&oacute;b na życie. Do moich ulubionych form zajęc należą Indoor Cycling oraz Step. Dlaczego? Dlatego, że każdą z tych lekcji można stworzyc tak, aby była niepowtarzalna. A oznacza to, że przez 365 dni w roku nuda nie ma wstępu na nasze zajęcia :). Jestem osobą pogodną i pełną energii o czym - mam nadzieję - sami się przekonacie!<br /> <br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-Team ICG Licencja A - Tomahawk, Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-TRX&reg; GSTC, ekspertfitness.com, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Team ICGLicencja B - Tomahawk</span><br /><span style="font-size: 12px;">-Team ICG Basic - Tomahawk</span><br /><span style="font-size: 12px;">-APF Basic Step Inka Szymański Fitness School</span><br /><span style="font-size: 12px;">-APF Basic Floor Inka Szymański Fitness School</span><br /><span style="font-size: 12px;">-APF Basic Shape&amp;Stability Inka Szymański Fitness School</span><br /><span style="font-size: 12px;">-Elite Transittion Combinationa EPFS</span><br /><span style="font-size: 12px;">-Elite Dance Combination EPFS</span><br /><span style="font-size: 12px;">-Active Walk Original Walking System</span><br /><span style="font-size: 12px;">-Fit Xhibition EPFS</span><br /><span style="font-size: 12px;">-Aerobox IFAA</span><br /> <br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />Wy kochani jesteście dla mnie najważniejsi :)</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, '', 3, 0),
(55, NULL, 32, 1, 57, NULL, NULL, 60, 1, 'Emilia Guć', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="color: #99cc00; font-size: 16px;"><strong>Emilia Guć</strong></span></p>\r\n<p><br /><strong>Instruktor ZUMBA Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Jestem absolwentką&nbsp;Uniwersytetu Medycznego w Łodzi na kierunku Pielęgniarstwo i bardzo lubię pracę z ludźmi. Uwielbiam chwile, gdy potrafię sprawić, że ktoś poczuje się lepiej, a widząc uśmiechnięte i szczęśliwe twarze uczestnik&oacute;w moich zajęć czuje się spełniona i naładowana pozytywną energią. Taniec jest moją pasją, aktywność fizyczna towarzyszy mi od zawsze, a ZUMBA jest jej najciekawszą i najprzyjemniejszą formą. Zainspirowało mnie to do zrobienia międzynarodowych uprawnień instruktorskich. Poza tym uwielbiam jeździć na rowerze oraz spotykać się z moją rodzina i przyjaci&oacute;łmi, kt&oacute;rzy są dla mnie podporą i wsparciem.&nbsp;Zajęcia ZUMBY polecam każdemu, kto chce choć na chwilę oderwać się od szarej rzeczywistości, wpaść w wir tańca i doskonale się bawić, a przy tym spalać zbędne kalorie. Przyjdź, a przekonasz się, ile zumbowych endorfin wydzieli się w Tobie!</p>\r\n<p><br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-ZUMBA Fitness B1</span><br /> <br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />zadowolenie i satysfakcja uczestnik&oacute;w moich zajęć.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />możliwość rozwoju i podnoszenia jakości swoich zajęć oraz radość z powodu bycia w miejscu, w kt&oacute;rym panuje miła atmosfera - zar&oacute;wno wśr&oacute;d pracownik&oacute;w, jak i klient&oacute;w.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(56, NULL, 32, 1, 55, NULL, NULL, 51, 1, 'Dawid Sowiński', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Dawid Sowiński</strong></span></p>\r\n<p><br /><strong>Instruktor Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Jestem magistrem pedagogiki kultury fizycznej i zdrowotnej. Gł&oacute;wnie interesuję się filmem, podr&oacute;żowaniem oraz rekreacją ruchową. Z aktywnością fizyczną jestem związany od czas&oacute;w szkoły podstawowej. Przez 8 lat uczyłem się, a potem doskonaliłem w pływaniu i zdobyłem kartę pływacką. W szkole średniej zainteresowałem sie tańcem i przez 4 lata uczęszczałem na zajęcia do łodzkich szk&oacute;ł tańca: Lila House, FnF Dance Studio. Przede wszystkim tańczyłem hip-hop, ale uczęszczałem r&oacute;wnież na zajęcia z jazzu, baletu, funky, videoclip dance, new age. Zajęcia taneczne umożliwiły mi poprawę koordynacji oraz pamięci ruchowej. W czasie studi&oacute;w zainteresowałem się fitnessem i zapisałem się do fitness klubu. Po miesiącach intensywnych trening&oacute;w i zapoznaniu z r&oacute;żnymi formami zajęć, postanowiłem rozpocząć szkolenia instruktorskie. Na moich zajęciach nie tylko dbam o prawidłowe wykonanie wszystkich ćwiczeń i krok&oacute;w, ale także o bezpieczeństwo uczestnik&oacute;w i dobrą zabawę.</p>\r\n<p style="text-align: justify;"><br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-Dyplom OM Stretching &amp; Relaks, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-OM Kettlebells, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-Dyplom OM 3/4 dance &amp; 3/4 Step, Open Mind Health&amp;Fitness Idea, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Warsztaty sprzętowe Basic, Open Mind Health&amp;Fitness Idea, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Functional Advanced Body - Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-OM Body Ball, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Magisterium z zakresu pedagogiki kultury fizycznej i zdrowotnej, Uniwersytet Ł&oacute;dzki 2013</span><br /><span style="font-size: 12px;">-OM Aero Dance Metodyka, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Konwencja Ł&oacute;dź OPEN MIND MEETING, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-OM OvoBall, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-OM Tubing, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-OM 3/4 Step 3/4 Dance, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-OM Aero Dance Style - JAZZ, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-OM Aero Dance Style - LATINO, Łodź 2013</span><br /><span style="font-size: 12px;">-Team ICG Basic - Tomahawk, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-OM Event Day, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-Step Instruktor, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-OM Aerobik Instruktor, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-OM Body Instruktor, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-OM Stretching &amp; Relaks, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-OM Event Day Shape &amp; Mental, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-Licencjat z zakresu pedagogiki kultury fizycznej i zdrowotnej, Uniwersytet Ł&oacute;dzki 2011</span><br /><span style="font-size: 12px;">-Wychowawca plac&oacute;wek wypoczynku dzieci i młodzieży, Ośrodek Doskonalenia Nauczycieli EDUKATOR, Ł&oacute;dź 2009</span><br /> <br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />zadowolenie klient&oacute;w oraz realizowanie się podczas prowadzenia zajęć.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />możliwość samorozwoju zawodowego, pogłębianie własnych pasji oraz poznanie wielu ciekawych i pozytywnych ludzi.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(57, NULL, 32, 1, 59, NULL, NULL, 50, 1, 'Agnieszka Wasylkowska', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Agnieszka Wasylkowska</strong></span></p>\r\n<p><br /><strong>Instruktor ZUMBA Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Moje zainteresowanie fitnessem rozpoczęło się w 1999 roku. Wtedy właśnie zaczęłam uczestniczyć w zajęciach tanecznych i og&oacute;lnorozwojowych. Od tego czasu sport, a w szczeg&oacute;lności zajęcia fitness, są nieodłącznym elementem mojej codziennej aktywności. Fitness był, jest i będzie moją wielką pasją - dlatego właśnie zostałam instruktorem. Od kiedy Zumba pojawiła się w Polsce, wiedziałam, że jest to coś dla mnie! Zumba to niesamowite zajęcia, podczas kt&oacute;rych spełaniam się w każdym calu. Nie tylko mogę przekazać swoją pozytywną energię, ale przede wszystkim zagwarantowac świetną zabawę, podczas kt&oacute;rej spala się mn&oacute;stwo kalorii. Zumba jest bardzo energiczna i żywiołowa. Ma w sobie niesamowitą moc. Podczas zajęć zapominamy o wszelkich problemach i dajemy się ponieść sile muzyki. Dołączcie do mnie, a zakochacie się w Zumbie - tak jak ja!<br /> <br /><strong>Odbyte kursy i szkolenia instruktorsie:</strong> <br /><span style="font-size: 12px;">-Szkolenie Basic Aerobic</span><br /><span style="font-size: 12px;">-ZUMBA Fitness B1</span><br /> <br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />zadowolenie i uśmiech uczestnik&oacute;w zajęć.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness&amp;wellness daje mi:</strong><br />możliwość realizacji moich zainteresowań oraz okazję do&nbsp;poznawania nowych ludzi.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(58, NULL, 32, 1, 61, NULL, NULL, 52, 1, 'Anna Szlendak', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Anna Szlendak</strong></span></p>\r\n<p><br /><strong>Instruktor Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Jako zodiakalny bliźniak lubię, kiedy wok&oacute;ł mnie dzieje się wciąż coś nowego. Całe życie pr&oacute;buję swoich sił w najr&oacute;żniejszych dziedzinach. Stawianie pierwszych krok&oacute;w, robienie postęp&oacute;w i wreszcie odnoszenie małych sukces&oacute;w jest niezastąpionym doznaniem. Moją pasją są Włochy i wszystko co znimi związane. Kilka lat temu nauczyłam sie języka włoskiego co tylko potwierdza regułę, że na nic nigdy nie jest za p&oacute;źno :). Na co dzień jestem wizażystką i charakteryzatorką filmową. Prowadzę warsztaty ze sztuki makijażu, pomagam kobietom odnaleźć w sobie wewnętrzne piekno. A że kobiece piękno to nie tylko perfekcyjny make up, zawsze dbałam o formę, ćwicząc regularnie przez ostatnie 8 lat. Niedawno zaczęłam swoją przygodę z fitnessem od strony zawodowej. Daje mi to przede wszystkim dużo przyjemności, ale r&oacute;wnież kolejne ciekawe doświadczenia. Lubię otaczac sie pięknem a fitness jest doskonałą drogą dążenia do niego. Nic nie daje mi wiekszej satysfakcji niż moja rodzina. Jestem dumna Panią domu i szczęśliwą mamą dw&oacute;jki cudnych dzieci i to właśnie daje mi siłę do działania.</p>\r\n<p style="text-align: justify;"><br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong></p>\r\n<p style="text-align: justify;"><span style="font-size: 12px;">-OM Trening Obwodowy - warsztaty, 2016</span><br /><span style="font-size: 12px;">-TRX FTC, 2016</span><br /><span style="font-size: 12px;">-OM Ball Tour, 2016</span><br /><span style="font-size: 12px;">-Metodyka prowadzenia zajęć kettlebell - Kettelbell Power - Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-Szkolenie Kamagon - Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-TRX Bootcamp - Sopot 2015</span><br /><span style="font-size: 12px;">-Deepwork - Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-OM Kettlebells, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-Warszat Reebok University- Reebok Functional Training - Warsztat metodyczny</span><br /><span style="font-size: 12px;">-OM powergym Open Mind Health &amp; Fitness Idea Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-TRX&reg; GSTC, ekspertfitness.com, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-OM&reg; FUNCTIONAL ADVANCED BODY, Krak&oacute;w 2014</span><br /><span style="font-size: 12px;">-Pierwsza pomoc - Podstawowe zabiegi resuscytacyjne w stanach zagrożenia życia z użyciem automatycznego defibrylatora zewnętrznego AED, D&amp;J Medica, Ł&oacute;dź maj 2014</span><br /><span style="font-size: 12px;">-OM Equipment Day, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-OM Body Ball, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Aerobik Instruktor - Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Body Instruktor - Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Step Instruktor - Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Szkolenie podstawowe - Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2013</span><br /> <br /><strong>Dla mnie w pracy najważniejsza jest:</strong> <br />możliwość uczestniczenia w przemianie, jaka nierzadko dokonuje się w uczestnikach zajęć oraz realizacja mojej niepohamowanej chęci zarażania innych zdrowym stylem życia :)</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />możliwość rozwoju zawodowego wśr&oacute;d profesjonalist&oacute;w, a co najważniejsze - w przyjaznej atmosferze.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(59, NULL, 32, 1, 60, NULL, NULL, 49, 1, 'Adrianna Marjańska', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="color: #99cc00; font-size: 16px;"><strong>Adrianna Marjańska</strong></span><br /> <br /><strong>Instruktor ZUMBA Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Jestem instruktorką Zumba Fitness oraz studentką MSK - Miedzynarodowych Studi&oacute;w Kulturowych na Uniwerytecie Ł&oacute;dzkim. Taniec jest obecny w moim życiu praktycznie od urodzenia. Początkiem przygody z tańcem był balet, p&oacute;źniej zajęcia tańca wsp&oacute;łczesnego. Przez 9 lat reprezentowałam w wielu konkursach i zawodach tanecznych szkoły, do kt&oacute;rych uczęszczałam, w zasadzie we wszystkich stylach tanecznych. Zajęcia Zumby poznałam w 2009 roku, ale dopiero w październiku 2013 roku zdecydowałam się przejść szkolenie, by zostać licencjonowanym instruktorem Zumba Fitness. Od 2009 roku brałam udział w wielu ważnych Zumbowych wydarzeniach m. in. charytatywnych maratonach, zumbowym teledysku do piosenki Pharrella Williamsa - "Happy" (Ł&oacute;dź is because of Zumba) z inicjatywy Olgi Lipskiej, czy pr&oacute;bie pobicia rekordu Polski w liczbie os&oacute;b tańczących Zumbę w Ostrowie Wielkopolskim. Zawsze dokładam wszelkich starań, by każdy wychodził zmęczony, uśmiechnięty i jednocześnie naładowany super pozytywną energią.</p>\r\n<p><br /> <strong>Odbyte kursy i szkolenia:</strong><br /><span style="font-size: 12px;">-Zumba Fitness B1</span><br /> <br /><strong>Dla mnie w pracy najważniejszy jest:</strong><br />uśmiech na twarzach kursant&oacute;w.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness&amp;wellness daje mi:</strong><br />możliwość dalszego rozwoju, motywacje do wymyślania coraz fajniejszej choreografii oraz możliwość poznania ludzi z pozytywnym nastawieniem do życia.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(60, NULL, 32, 1, 58, NULL, NULL, 61, 1, 'Ewa Napióra', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Ewa Napi&oacute;ra</strong></span></p>\r\n<p><br /><strong>Instruktor ZUMBA Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Jestem magistrem wychowania fizycznego Uniwersytetu Ł&oacute;dzkiego. Pracuję jako nauczyciel w-f. Sport to m&oacute;j spos&oacute;b na codzienność. Jestem instruktorem fitness, zumby fitness, pływania, siatk&oacute;wki, tenisa stołowego oraz narciarstwa. Wierzę, że wysiłek fizyczny uczy wytrwałości w dążeniu do celu i pomaga w pokonywaniu własnych słabości. Uczestnictwo w zajęciach doskonale wpływa na kondycję fizyczną, jak i psychiczną. Staram się dzielić pozytywną energią, zarażać pasją do sportu i uśmiechem.<br /> <br /> <br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong> <br /><span style="font-size: 12px;">-Open Mind Body Instructor</span><br /><span style="font-size: 12px;">-ZUMBA kids i ZUMBA kids jr.</span><br /><span style="font-size: 12px;">-Kurs instruktora rekreacji ruchowej - fitness</span><br /><span style="font-size: 12px;">-ZUMBA Fitness B1</span><br /><span style="font-size: 12px;">-Team ICG Basic - Tomahawk, Ł&oacute;dź 2011</span><br /> <br /><strong>Dla mnie w pracy najważniejszy jest:</strong><br />kontakt z ludźmi, satysfakcja z wykonywanej pracy, możliwość ciągłego rozwoju, miła atmosfera.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness&amp;wellness daje mi:</strong><br />wspaniałą atmosferę, zadowolenie klient&oacute;w oraz świadomość, że mogę ich oderwać od codzienności i sprawić, że na ich twarzach pojawia się uśmiech. Jest to ogromna motywacja do dalszej pracy zar&oacute;wno pracownik&oacute;w, jak i klient&oacute;w.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(61, NULL, 32, 1, 62, NULL, NULL, 62, 1, 'Szczepan Piąstka', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Szczepan Piąstka</strong></span></p>\r\n<p><br /><strong>Instruktor Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Moja przygoda ze sportem zaczęła się w podstaw&oacute;wce, gdy m&oacute;j Tata usilnie pr&oacute;bując wygonić mnie sprzed telewizora i zza komiks&oacute;w, zapisał mnie na basen. Woda była zimna, więc trzeba było pływać. I tak zostałem ratownikiem, a p&oacute;źniej płetwonurkiem. Gdy nie pływałem - jeździłem na rowerze, grałem w badmintona i zdobywałem narciarskie szlify. Gdy pływanie zamiast męczyć, zaczęło mnie nudzić, w ramach eksperymentu wybrałem się na zajęcia fitness.<br />Wysiłek fizyczny uzależnia. Bez towarzyszących mu zastrzyk&oacute;w endorfin świat szybko staje się szary, jak bloki z Wielkiej Płyty. Człowiek nigdy nie czuje się tak żywym, jak wtedy, gdy każdy jego mięsień błaga o litość. A b&oacute;l to w końcu tylko oznaka słabości uciekającej z ciała.&nbsp;A z wykształcenia jestem inżynierem. Więc możecie mi zaufać.</p>\r\n<p><br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-Instruktor Aerobox - IFAA, Warszawa 2015</span><br /><span style="font-size: 12px;">-Piłka lekarska i kettlebell w treningu funkcjonalnym - IFAA, Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-Aerobik Licencja B - IFAA, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Wzmacnianie I - IFAA, Warszawa 2014</span><br /><span style="font-size: 12px;">-Anatomia I - IFAA, Warszawa 2013</span><br /><span style="font-size: 12px;">-Aerobik Licencja C - IFAA, Ł&oacute;dź 2013</span><br /> <br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />robienie tego, co lubię - z ludźmi takimi, jak ja.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness&amp;wellness daje mi:</strong><br />możliwość przesuwania granicy moich możliwości jeszcze dalej, okazję do realizacji pomysł&oacute;w, kt&oacute;re nagromadziłem w głowie przez lata ćwiczeń i szansę wciągnięcia innych w to, co sprawia, że życie naprawdę smakuje lepiej.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0);
INSERT INTO `artykuly_tresc` (`id`, `id_rodzic_blok`, `id_art_nazwa`, `id_lang`, `sort`, `naglowek_bloku`, `naglowek_bloku_typ`, `id_zdjecie_1`, `rozmiar_1`, `podpis_1`, `adres_1`, `powieksz_1`, `target_1`, `alt_1`, `title_1`, `id_zdjecie_2`, `rozmiar_2`, `podpis_2`, `adres_2`, `powieksz_2`, `target_2`, `alt_2`, `title_2`, `id_zdjecie_3`, `rozmiar_3`, `podpis_3`, `adres_3`, `powieksz_3`, `target_3`, `alt_3`, `title_3`, `tresc`, `oblewanie_zdjecie`, `id_plik_1`, `nazwa_plik_1`, `id_plik_2`, `nazwa_plik_2`, `typ_plik`, `widocznosc`, `typ`, `typ_zaawansowany`) VALUES
(62, NULL, 32, 1, 63, NULL, NULL, 64, 1, 'Szymon Domagała', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Szymon Domagała</strong></span></p>\r\n<p><br /><span style="font-size: 15px; color: #000000;"><strong>Instruktor Fitness</strong></span></p>\r\n<p style="text-align: justify;"><br />Ze sportem związany byłem od wczesnych lat młodości. Jako dziecko nie potrafiłem usiedzieć w miejscu, dlatego większość dnia spędzałem na dworze uprawiając przer&oacute;żne sporty drużynowe. Jako, że z wiekiem większość znajomych, co raz mniej chciało się ruszać, szukałem jakiejś formy aktywności ruchowej, kt&oacute;ra będzie w miarę indywidualna i tak trafiłem na siłownię. Treningi siłowe spodobały mi się tak bardzo, że stały się moja pasją, kt&oacute;rą cały czas rozwijam.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-Pierwsza pomoc - Podstawowe zabiegi resuscytacyjne w stanach zagrożenia życia z użyciem automatycznego defibrylatora zewnętrznego AED, D&amp;J Medica, Ł&oacute;dź maj 2014</span><br /><span style="font-size: 12px;">-Szkolenie z technik fitnessowych Kettlebell - Kettlebell Power, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Szkolenie z technik Kettlebell metodą Hardstyle - Kettlebell Power, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-Systemy podwieszane, Open Mind Health&amp;Fitness Idea, Ł&oacute;dź 2013</span><br /><span style="font-size: 12px;">-GRAVITY&reg; Foundation Course</span><br /><span style="font-size: 12px;">-Certificate Bosu Integrated Balance Training, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2012</span><br /><span style="font-size: 12px;">-Instruktor sportu ze specjalizacją kulturystyka (legitymacja państwowa), Polska Akademia Sportu, Warszawa 2010</span><br /><span style="font-size: 12px;">-Uczestnik seminarium &bdquo;Żywienie i suplementacja w sporcie&rdquo; dr Dariusz Szukała, Warszawa 2010</span><br /> <br /><strong>Dla mnie w pracy najważniejsza jest:</strong><br />atmosfera i możliwość samorealizacji.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />możliwość samorealizacji oraz przekazywania swojej wiedzy innym, by ich efekty treningowe były lepsze.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(63, NULL, 32, 1, 64, NULL, NULL, 63, 1, 'Paweł Bernat', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Paweł Bernat</strong></span></p>\r\n<p><br /><strong>Instruktor Siłowni / Instruktor Fitness / Trener Personalny</strong></p>\r\n<p style="text-align: justify;"><br />Jestem magistrem pedagogiki kultury fizycznej i zdrowotnej. Sport towarzyszy mi od zawsze. Trenowałem koszyk&oacute;wkę, sztuki walki, aż w końcu wciągnąłem się w wir trening&oacute;w siłowych oraz crossfit. Regularne treningi zaowocowały chęcią dokształcenia się w tej dziedzinie sportu i tak oto zostałem instruktorem.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><br /> <br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-OM Kettlebells, Open Mind Health &amp; Fitness Idea, Ł&oacute;dź 2015</span><br /><span style="font-size: 12px;">-TRX&reg; GSTC, ekspertfitness.com, Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Pierwsza pomoc - Podstawowe zabiegi resuscytacyjne w stanach zagrożenia życia z użyciem automatycznego defibrylatora zewnętrznego AED, D&amp;J Medica, Ł&oacute;dź maj 2014</span><br /><span style="font-size: 12px;">-Instruktor sportu ze specjalizacją kulturystyka ( Legitymacja Polskiej Akademii Sportu), Ł&oacute;dź 2014</span><br /> <br /><strong>Dla mnie w pracy najważniejsza jest:</strong><br />przyjazna atmosfera oraz zadowolenie klienta.</p>\r\n<p style="text-align: justify;"><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />możliwość samorealizacji oraz dzielenie się zdobytą wiedzą z innymi.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(64, NULL, 32, 1, 65, NULL, NULL, 68, 1, '', '', '', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Magda Kaźmierczak</strong></span></p>\r\n<p><br /><strong>Instruktor Fitness</strong></p>\r\n<p style="text-align: justify;"><br />Magister Pedagogiki Kultury Fizycznej i Zdrowotnej na Uniwersytecie Ł&oacute;dzkim, dyplomowany technik masażysta, instruktor rekreacji ruchowej ze specjalnością: aerobik, instruktor Indoor Cycling, trener personalny, wykładowca na AHE: gimnastyka korekcyjna w edukacji szkolnej i przedszkolnej. Zar&oacute;wno do pracy z klientami w klubach, jak i pacjent&oacute;w przychodzących na masaż, podchodzę profesjonalnie,&nbsp;uwzględniając ich indywidualne potrzeby oraz możliwości, zwracając uwagę na to, aby trening lub masaż był odpowiednio dobrany do osoby zainteresowanej, adekwatny do jej aktualnego stanu. Interesuję się zagadnieniami zdrowotnymi i profilaktycznymi tak by zajęcia, trening lub masaż przynosiły im jak najwięcej korzyści. Jestem osobą komunikatywną, wesołą, solidną, sumienną, pilną, dużo od siebie wymagam i zawsze staram się robić wszytsko na 150% ;) Na swoich zajęciach zwracam uwagę na to by klienci ćwiczyli najlepiej jak tylko potrafią, oczywiście na miarę swoich możliwości, tak by po zajęciach mieli poczucie, że dali z siebie wszystko i świadomośc tego ile trening im daje i jak dzięku niemu mogą się rozwinąć. W wolnym czasie biegam, tańczę, jeżdżę na rowerze i relaksuję się najlepiej z przyjaci&oacute;łmi, rodziną i moimi zwierzakami ;)</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-Szkolenie Open&amp;Mind-Instruktor Rekreacji Ruchowej ze specjalnością: Aerobik (Basic Aerobic, Baciś Step, Basic Body)</span><br /><span style="font-size: 12px;">-Szkolenie Open&amp;Mind Body Ball</span><br /><span style="font-size: 12px;">-Szkolenie Open&amp;Mind Stretching&amp;Relaks</span><br /><span style="font-size: 12px;">-Szkolenie Indoor Cycling-Tomahawk Basic</span><br /><span style="font-size: 12px;">-Szkolenie Open&amp;Mind Bosu</span><br /><span style="font-size: 12px;">-Szkolenie Power Dumbell IFAA</span><br /><span style="font-size: 12px;">-Szkolenie Open&amp;Mind Fitness Fight Kick</span><br /><span style="font-size: 12px;">-Warsztaty Open&amp;Mind Dance Jazz, Open&amp;Mind Dance Latino</span><br /><span style="font-size: 12px;">-Szkolenie BECO Aqua Aerobic dla senior&oacute;w, os&oacute;b z otyłością oraz dysfunkcjami kręgosłupa</span><br /><span style="font-size: 12px;">-Warsztaty Open&amp;Mind Dance House, Open Mind Dance Hip-hop</span><br /><span style="font-size: 12px;">-Basic Personal Trainer Kuźnia Trener&oacute;w</span><br /><span style="font-size: 12px;">-Steo licencja B IFAA</span><br /><span style="font-size: 12px;">-Dieta i suplementacja cz.1 Open Mind</span><br /><span style="font-size: 12px;">-Dieta i suplementacja cz.2 Open Mind</span><br /><span style="font-size: 12px;">-TRX STC Professional Education w treningu personalnym</span><br /><span style="font-size: 12px;">-Trener personalny. Specjalność: kulturystyka i żywienie, WST</span><br /><span style="font-size: 12px;">-Warsztaty Stretching Reebok University</span><br /><span style="font-size: 12px;">-Dyplom Om Stretching &amp; Relaks</span><br /><span style="font-size: 12px;">-Warsztaty Trening Funkcjonalny Reebok University</span><br /><span style="font-size: 12px;">-Indoor Cycling ICG Licencja B</span><br /><span style="font-size: 12px;">-OM Functional Advanced Body</span><br /><span style="font-size: 12px;">-Udział w konwencjach fitness IFAA, Reebok</span><br /><span style="font-size: 12px;">-Szkolenie masaż tkanek głębokich WSEiT</span><br /><span style="font-size: 12px;">-Kurs terapii punkt&oacute;w spustowych WSEiT</span><br /><span style="font-size: 12px;">-Warsztaty Rozluźnianie mięśniowo-powięziowe, techniki globalne i lokalne</span></p>\r\n<p><br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />robienie tego, co kocham. Praca jest moja pasją, daje mi wiele możliwości rozwoju i szansę na poznanie wspaniałych os&oacute;b, praca daje mi możliwość przebywania z inspirującymi ludźmi, a także wielką satysfakcję, kiedy widzę zadowolenie klient&oacute;w i efekty mojej pracy ;)</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />możliwość rozwoju w ciekawym miejscu, w towarzystwie świetnej kadry instruktorskiej oraz okazję do poznania ludzi z pasją.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(65, NULL, 32, 1, 66, NULL, NULL, 68, 1, '', '', '', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Klaudia Florczak</strong></span></p>\r\n<p><br /><strong>Instruktor Siłowni / Trener Personalny</strong></p>\r\n<p style="text-align: justify;"><br />Jestem trenerem personalnym, fizjoterapeutką i masażystką. Ze sportem na dobre związałam się kilka lat temu, brałam udział w og&oacute;lnopolskich zawodach crossfitowych. W zawodach tego typu jestem r&oacute;wnież sędzią, dlatego szczeg&oacute;lną uwagę przywiązuję do standard&oacute;w i poprawnej techniki wykonywania ćwiczeń. Brałam r&oacute;wnież udział w akademickich mistrzostwach w tr&oacute;jboju siłowym. W swojej pracy nie zapominam jak ważna jest praca nad elastycznością i mobilnością ludzkiego ciała. Na prowadzonych przeze mnie treningach udowadniam, że sport jest dla każdego, bez względu na wiek i płeć a osiągnięcie zamierzonych cel&oacute;w zależy tylko od naszego zaangażowania i ilości pracy jaką włożymy, by ten cel osiagnać. Doświadczenia jakie wyniosłam z trening&oacute;w CrossFit daje mi szeroki wachlarz możliwości w pracy z klientami, tak by ci nigdy się nie nudzili.</p>\r\n<p><br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-Kurs Trenera Personalnego organizowane przez Centrum Ruchu Olimpijka</span><br /><span style="font-size: 12px;">-Og&oacute;lnopolskie Szkolenie Mobility</span><br /><span style="font-size: 12px;">-Strenght &amp; Conditioning Trainer Level 1</span><br /><span style="font-size: 12px;">-Kurs szkoleniowy dla trener&oacute;w - wychowawc&oacute;w przeprowadzony przez Fundację Realu Madryt</span><br /><span style="font-size: 12px;">-Kurs na trenera ze specjalnością piłka nożna</span><br /><span style="font-size: 12px;">-Szkolenie Hard Style Kettlebells</span><br /><span style="font-size: 12px;">-Warsztaty teoretyczno &ndash; praktyczne na temat: &bdquo;Terapia przepony w praktyce fizjoterapeuty i osteopaty.&rdquo;</span><br /><span style="font-size: 12px;">-Kurs podstawowy Masaż Shiatsu</span><br /><span style="font-size: 12px;">-Kurs Masaż klasyczny z elementami odnowy psychosomatycznej</span><br /><span style="font-size: 12px;">-Szkolenie teoretyczno &ndash; praktyczne na temat: &bdquo;Terapia pacjent&oacute;w z obrzękiem limfatycznym.&rdquo;</span><br /><span style="font-size: 12px;">-Kurs podstawowy z rozszerzonym z Kinesiotapingu</span></p>\r\n<p><br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />zaangażowanie i otwarty umysł, kt&oacute;ry pozwala osiągnąć wyznaczony cel.</p>\r\n<p><br /><strong>Praca a klubie atmosfera fitness &amp; wellness daje mi:</strong><br />możliwość nawiązywania ciekawych kontakt&oacute;w i zarażenia ludzi pasją treningu i zdrowego trybu życia.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(66, NULL, 32, 1, 67, NULL, NULL, 68, 1, NULL, NULL, '', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Bartosz Jezierski</strong></span></p>\r\n<p><br /><strong>Instruktor Siłowni / Trener Personalny</strong></p>\r\n<p style="text-align: justify;"><br />Odkąd pamiętam sport był moim sposobem na życie. Już jako nastolatek trenowałem wyczynowo koszyk&oacute;wkę i wiedziałem, że przygoda ze sportem będzie trwała przez długie lata. Dzisiaj jest to moja pasja, kt&oacute;rą łączę z życiem prywatnym i zawodowym. Jestem absolwentem Akademii Wychowania Fizycznego w Warszawie na kier. wychowanie fizyczne. Wiedzę, kt&oacute;rą zdobyłem na studiach wykorzystuje w pracy trenera koszyk&oacute;wki w Szkole Mistrzostwa Sportowego Marcina Gortata w Łodzi. Ponadto jestem zawodnikiem drużyny koszykarskiej AZS UŁ Szkoła Gortata Ł&oacute;dź kt&oacute;ra występuje w II lidze oraz rozgrywkach międzyuczelnianych. Interesuję się r&oacute;wnież treningiem funkcjonalnym i jego zastosowaniem w sporcie wyczynowym czy amatorskim . Sw&oacute;j wolny czas lubię spędzać w zimie na stoku a latem w kajaku lub na ł&oacute;dce.</p>\r\n<p><br /><strong>Odbyte kursy i szkolenia instruktorskie:</strong><br /><span style="font-size: 12px;">-Szkolenie w Elite Performance Institute Polska - NCSS (National Certificate in Strength &amp; Conditioning) 1 stopień - przygotowanie motoryczne - Ł&oacute;dź 2015 Strength &amp; Conditioning</span><br /><span style="font-size: 12px;">-Szkolenie Education Centre - Certified Performance Specialist level 1 - przygotowanie motoryczne - Bydgoszcz 2015</span><br /><span style="font-size: 12px;">-Budowanie masy mięśniowej na diecie wegańskiej - Warszawa 2014</span><br /><span style="font-size: 12px;">-Zjazd naukowo-szkoleniowy "Żywienie oraz suplementacja w wybranych dyscyplinach siłowych i szybkościowo-siłowych" Polskie Stowarzyszenie Dietetyk&oacute;w - Ł&oacute;dź 2014</span><br /><span style="font-size: 12px;">-Uprawnienia instruktora sportu koszyk&oacute;wka, AWF Warszawa 2014</span><br /><span style="font-size: 12px;">-Uprawnienia instruktora sportu kulturystyka, Państwowa Akademia Sportu - Warszawa 2013</span><br /> <br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />pomaganie w dążeniu do celu i oczywiście pozytywna, ATMOSFERYCZNA energia!</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />szansę na poznanie ciekawych ludzi,&nbsp;kt&oacute;rzy inspirują mnie do działania.</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(71, NULL, 33, 1, 74, NULL, NULL, 68, 1, NULL, NULL, '', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Katarzyna Maciejewska</strong></span></p>\r\n<p><br /><strong>Doradca klienta</strong></p>\r\n<p style="text-align: justify;"><br />Studiuję kierunek Inwestycje i Nieruchomości na Uniwersytecie Ł&oacute;dzkim. A poza nauką i pracą wszystkie wolne chwile staram się spędzać aktywnie...rolki, siatk&oacute;wka, rower czy też najzwyklejszy spacer jest dla mnie najlepsza formą na zabicie nudy :) Chcę przeżyć życie najlepiej jak się da i tak aby nie żałować żadnej z chwil! :) Zawsze wierzę, że moje dobre uczynki wr&oacute;cą do mnie w przyszłości ze zdwojoną siłą.</p>\r\n<p><br /><strong>Dla mnie w pracy najważniejsze jest:</strong><br />Kiedy to co robię jest dla mnie przyjemnością a nie obowiązkiem a ludzie otaczający mnie potrafią sprawić, że da się zapomnieć o wszystkich problemach dnia codziennego :)</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />Możliwość dzielenia się swoim uśmiechem ze wszystkim wok&oacute;ł.</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(72, NULL, 33, 1, 73, NULL, NULL, 68, 1, '', '', '', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Patrycja Lesiak</strong></span></p>\r\n<p><br /><strong>Doradca klienta</strong></p>\r\n<p style="text-align: justify;"><br />Jestem studentką Politechniki Ł&oacute;dzkiej na Wydziale Biotechnologii i Nauk o Żywności. Ze sportem mam do czynienia od najmłodszych lat. Zawsze lubiłam gry zespołowe, a najbardziej bliska memu sercu była siatk&oacute;wka i tak zostało do dziś. Od niedawna moją pasją są g&oacute;ry. Będąc na szlaku, czuję się wolna i szczęśliwa. Uwielbiam pokonywać bariery, kt&oacute;re na początku wydają się nie do przejścia. Czuję wtedy największą satysfakcję z osiągniętego celu. W życiu najważniejsza jest dla mnie rodzina, na kt&oacute;rą wiem, że zawsze mogę liczyć.</p>\r\n<p><br /><strong>Dla mnie w pracy najważniejsza jest:</strong><br />możliwość rozwoju oraz atmosfera, kt&oacute;rą tworzą ludzie, z kt&oacute;rymi pracuję i od kt&oacute;rych mogę się nauczyć czegoś nowego i wartościowego.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />dużo radości, satysfakcję i chęć działania.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(73, NULL, 33, 1, 72, NULL, NULL, 66, 1, 'Weronika Chodorek', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Weronika Chodorek</strong></span></p>\r\n<p><br /><strong>Doradca klienta</strong></p>\r\n<p style="text-align: justify;"><br />Jestem studentką dziennikarstwa i komunikacji społecznej na Uniwersytecie Ł&oacute;dzkim. Sport w moim życiu zagościł pod znakiem lekkiej atletyki - w przeszłości trenowałam biegi sprinterskie i choć nie mogę pochwalić się świetną &bdquo;życi&oacute;wką&rdquo;, to dużo bym dała, by nigdy nie rozstawać się z kolcami. Mam mn&oacute;stwo marzeń, kt&oacute;rych już samo posiadanie jest wielkim powodem do radości-biały domek z niebieskimi okiennicami na greckiej wyspie, wizyta we wszystkich 50 stanach USA, zostać reżyserem, aktorką, uczynić ten świat piękniejszym&hellip; To ostatnie staram się wcielać w życie poprzez zwykłą życzliwość i trochę uśmiechu ;)</p>\r\n<p><br /><strong>Dla mnie w pracy najważniejsza jest:</strong><br />druga osoba, kt&oacute;rej mogę dać coś z siebie ;)</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />radość i dumę z faktu przynależności do grona pozytywnych ludzi, od kt&oacute;rych mogę się wiele nauczyć.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(74, NULL, 33, 1, 71, NULL, NULL, 58, 1, 'Maria Budkowska', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px; color: #99cc00;"><strong>Maria Budkowska</strong></span></p>\r\n<p><br /><strong>Manager Recepcji</strong></p>\r\n<p><br />e-mail: <a href="mailto:m.budkowska@atmosfer-fitness.pl">m.budkowska@atmosfera-fitness.pl</a></p>\r\n<p style="text-align: justify;"><br />Jestem absolwentką Uniwersytetu Ł&oacute;dzkiego na Wydziale Nauk Geograficznych. Moją życiową pasją są podr&oacute;że, uwielbiam odkrywać i poznawać nowe miejsca. G&oacute;ry są dla mnie wyzwaniem, a także miejscem w kt&oacute;rym czuję się wolna i bezpieczna. Przyjaciele i rodzina są dla mnie oparciem, motywują mnie do dalszego działania i rozwoju swoich zainteresowań. Moje życiowe motto &bdquo;dzień bez słodyczy jest dniem straconym&Prime; ;)</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong>Dla mnie w pracy najważniejsza jest:</strong><br />atmosfera, kt&oacute;rą tworzą ludzie, z kt&oacute;rymi pracuję.</p>\r\n<p><br /><strong>Praca w klubie atmosfera fitness &amp; wellness daje mi:</strong><br />radość i satysfakcję z kontaktu z innymi.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(76, NULL, 19, 1, 12, NULL, NULL, 79, 1, NULL, NULL, 'checked', '', NULL, NULL, 96, 1, NULL, NULL, 'checked', '', NULL, NULL, 97, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(79, NULL, 19, 1, 9, NULL, NULL, 91, 1, NULL, NULL, 'checked', '', NULL, NULL, 88, 1, NULL, NULL, 'checked', '', NULL, NULL, 82, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(80, NULL, 36, 1, 80, NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="color: #99cc00;"><strong>Smukła Sylwetka</strong></span></p>\r\n<p style="text-align: justify;">Dynamiczne zajęcia z wykorzystaniem r&oacute;żnorodnego sprzętu (Ovoball, Body Ball, ciężarki, obciążenia na nogi, tubbingi, kr&oacute;tkie gumy), modelujące i wzmacniające mięśnie całego ciała. Coś dla chcących pięknie wyglądać! Te zajęcia są wizyt&oacute;wką naszego klubu.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">ABS / Płaski Brzuch</span></strong></p>\r\n<p style="text-align: justify;">Na tych zajęciach wspaniale wzmocnisz mięśnie brzucha, ud, pośladk&oacute;w oraz plec&oacute;w, przez co Twoja sylwetka zdecydowanie się zmieni. Trening prowadzony jest przy dynamicznej muzyce, a sekwencje krok&oacute;w są proste, tak aby każdy uczestnik był wstanie wykonać wszystkie ćwiczenia.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><span style="color: #99cc00;"><strong>GymBar/Płaski brzuch</strong></span></p>\r\n<p style="text-align: justify;">Na tych zajęciach nauczysz się podstawowych ćwiczeń z wykorzystaniem GymBar. Jest to trening dla każdego, angażujący wszystkie partie mięśniowe, a w szczeg&oacute;lności brzuch. Rozgrzewka jest nieskomplikowana, a ćwiczenia proste, ale bardzo efektywne. Rezultaty przyjdą szybciej, niż się tego spodziewasz! Już po kilku treningach zauważysz, że Twoja sylwetka znacznie się wysmukliła. Podczas zajęć używa się małych i średnich obciążeń, za to liczba powt&oacute;rzeń jest ogromna. Na każdą grupę mięśniową poświęca się od 4 do 8 minut, co gwarantuje typową pracę wytrzymałościową, a więc spalenie tkanki tłuszczowej i wzmocnienie mięśni, bez zbytnich ich przyrost&oacute;w.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><span style="color: #99cc00;"><strong>Zumba</strong></span></p>\r\n<p style="text-align: justify;">To zainspirowana latynoskimi rytmami fuzja tańca i aerobiku. Jest innowacyjnym systemem fitness, kształtującym sylwetkę, poprawiającym kondycję oraz wyzwalającym potężne dawki pozytywnej energii. Proste kroki taneczne, świetne kombinacje ruch&oacute;w i motywująca muzyka stwarzają niepowtarzalną atmosferę. Na zajęciach usłyszysz rytmy takie jak merenge, salsa, cumbia, reggeton i inne. Kombinacja krok&oacute;w to unikalna formuła Zumby. ZUMBA jest przeznaczona dla wszystkich, niezależnie od wieku, płci, zdolności ruchowych lub doświadczenia w tańcu lub fitnessie. Zajęcia te są dynamiczne i efektywne &ndash; prowadzone metodą interwałową gwarantują poprawę wyglądu sylwetki i wydolności.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Indoor Cycling P1</span></strong></p>\r\n<p style="text-align: justify;">Doskonałe zajęcia dla os&oacute;b początkujących i średnio zaawansowanych, na kt&oacute;rych dowiesz się, jak prawidłowo ustawić rower, zapoznasz się z techniką i obowiązującymi pozycjami jazdy. Ta 50 minutowa lekcja pozwoli Ci na rozwijanie sprawności, wytrzymałości i spalanie tkanki tłuszczowej. Poprzez indywidualną regulację oporu, sam decydujesz o stopniu intensywności swojego treningu. Jazda na specjalnym rowerze Tomahawk nie obciąża staw&oacute;w, a więc jest bezpieczna r&oacute;wnież dla os&oacute;b otyłych.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Indoor Cycling P2</span></strong></p>\r\n<p style="text-align: justify;">Intensywny trening na rowerach stacjonarnych wykorzystujący wszystkie wcześniej poznane techniki jazdy, w r&oacute;żnych konfiguracjach. Są to zajęcia dla os&oacute;b, kt&oacute;re poznały już podstawowe techniki stosowane w tego rodzaju treningach. Szybkie zmiany pozycji i duża intensywność sprawia, że jest to świetny trening wytrzymałościowy! Tutaj naprawdę można się zmęczyć. To także wspaniała forma ćwiczeń dla os&oacute;b uprawiających kolarstwo.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Indoor Cycling Mix Class</span></strong></p>\r\n<p style="text-align: justify;">Wybierz Mix Class''y, jeśli nie jesteś jeszcze pewien swoich rowerowych możliwości! W trakcie zajęć będziesz m&oacute;gł wybrać, czy chcesz dołączyć do grupy zaawansowanej, czy jechać razem z średniozaawansowanymi i początkującymi.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">KRANKcycling</span></strong></p>\r\n<p style="text-align: justify;">Jest to połączenie treningu na rowerach stacjonarnych i Krankach, czyli rowerkach wzmacniających g&oacute;rne partie ciała. Zajęcia te pozwolą Ci na zwiększenie sprawności i wytrzymałości często zaniedbywanych g&oacute;rnych grup mięśniowych. Jest to nie tylko trening cardio, ale r&oacute;wnież doskonałe uzupełnienie treningu siłowego, a także zajęć Indoor Cycling. Zupełnie nowy wymiar zajęć fitness, kt&oacute;ry gwarantuje niesamowite efekty treningowe, wspaniałą zabawę oraz poprawę koordynacji mięśniowej!</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Insanity</span></strong></p>\r\n<p style="text-align: justify;">To zajęcia kardio dla wszystkich tych, kt&oacute;rzy każdy trening traktują jak wyzwanie. Zmienna intensywność ćwiczeń gwarantuje skuteczną poprawę kondycji oraz og&oacute;lnej sprawności fizycznej. Z Insanity spalisz tkankę tłuszczową, wysmuklisz i wyrzeźbisz swoje ciało. Po serii ćwiczeń czeka Cię kr&oacute;tka przerwa, po kt&oacute;rej nastąpi kolejna porcja intensywnego wysiłku. Porządne zmęczenie gwarantowane, tak samo jak widoczne efekty już po pierwszym treningu.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Trening obwodowy</span></strong></p>\r\n<p style="text-align: justify;">Na tych zajęciach spalisz mn&oacute;stwo kalorii oraz poprawisz swoją szybkość, siłę i wytrzymałość! Wszystko dzięki &bdquo;stacjom&rdquo;, na kt&oacute;rych będziesz musiał zmierzyć się z r&oacute;żnorodnymi ćwiczeniami.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><span style="color: #99cc00;"><strong>Stretching</strong></span></p>\r\n<p style="text-align: justify;">To lekcja poświęcona rozciąganiu wszystkich mięśni. Dzięki tym zajęciom zwiększysz ruchomość swoich staw&oacute;w, a Twoje ciało stanie się elastyczne i przygotowane do efektywnego treningu. Stretching wspaniale eliminuje przykurcze mięśniowe, kt&oacute;re mogą być wynikiem siedzącego trybu życia i powodować b&oacute;le kręgosłupa. Te zajęcia polecamy każdemu!</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Yoga</span></strong></p>\r\n<p style="text-align: justify;">Dalekowschodni system ćwiczeń w nowoczesnej formie. Ćwiczący uwalnia się od napięć, zaczyna odczuwać odprężenie i przypływ energii. Jest to bardzo bezpieczna forma zajęć. Pozycje jogi zwane "asanami" wzmacniają ciało, zwiększają siłę, gibkość i elastyczność, wyciszają, a także pozwalają pracować nad oddechem. Yoga to doskonały trening dla każdego.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">TRX</span></strong></p>\r\n<p style="text-align: justify;">To rewelacyjny trening funkcjonalny w zupełnie nowej odsłonie. Jeśli szukasz zastępstwa dla odważnik&oacute;w, kettli i sztang, spr&oacute;buj poćwiczyć z ciężarem własnego ciała! Taśmy TRX służą do treningu w podwieszeniu, podczas kt&oacute;rego uruchomisz mięśnie globalne i lokalne, odpowiedzialne za stabilizację sylwetki. Możliwość bardzo szybkiej zmiany obciążenia pozwala na swobodne dostosowywanie poziomu trudności treningu do swoich potrzeb. Dzięki TRX skutecznie wzmocnisz mięśnie, poprawisz kondycję i uelastycznisz ciało.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><strong><span style="color: #99cc00;">TRX Core</span></strong></p>\r\n<p style="text-align: justify;">Trening na taśmach TRX pozwala w niezwykle szybki i efektywny spos&oacute;b osiągnąć&nbsp;wymarzoną sylwetkę z idealnie płaskim, wymodelowanym brzuchem. Silne mięśnie brzucha i plec&oacute;w, nad kt&oacute;rymi pracujemy podczas zajęć, to nie tylko pięknie wymodelowana talia, ale r&oacute;wnież wielka ulga dla kręgosłupa. Wpływa to korzystnie na prawidłową postawę całego ciała oraz pomaga cieszyć się codziennymi aktywnościami. TRX CORE&nbsp;ułatwia r&oacute;wnież właściwe wykonywanie ćwiczeń na innych zajęciach wzmacniających i siłowych, zwiększając ich efektywność. Poświęć 30 minut na trening, a na efekty nie będziesz musiał&nbsp;długo czekać!</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Deep Work</span></strong></p>\r\n<p style="text-align: justify;">To nowy, wyjątkowy wymiar treningu funkcjonalnego. Atletyczny, prosty, wyr&oacute;żniający się na tle innych znanych program&oacute;w. Energetyczny trening oparty na pięciu żywiołach symbolizujących r&oacute;żne źr&oacute;dła energii. Trening zaprojektowano tak, aby zawsze łączył w sobie napięcie i rozluźnienie mięśni oraz ćwiczenia oddechowe.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">ATMcross</span></strong></p>\r\n<p style="text-align: justify;">Znudzeni tradycyjnymi treningami na salach fitness czy siłowni? Proponujemy Wam nową odsłonę treningu, kt&oacute;ra robi furorę w Stanach Zjednoczonych i na całym świecie! Wysoka intensywność ćwiczeń i wykorzystanie ruch&oacute;w funkcjonalnych sprawia, że na tych zajęciach poprawisz swoją sprawność, spalisz zbędne kalorie i poprawisz wygląd całej sylwetki! Trening crossfit''owy polecamy zar&oacute;wno średniozaawansowanym i zaawansowanym Panom, jak i Paniom.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Aerobox</span></strong></p>\r\n<p style="text-align: justify;">Zajęcia sportowe, kt&oacute;re łączą w sobie klasyczne elementy fitness z tajnikami boksu, kickboxingu i krav magi. Nie jest to jednak sport kontaktowy i nie uczy metod ataku,czy obrony przed napastnikami. Modeluje sylwetkę, pomaga w spalaniu tkanki tłuszczowej, wysmukla i ujędrnia ciało! Zajęcia te są odreagowaniem stresu i rozładowaniem negatywnych emocji oraz zastrzykiem pozytywnej energii dla całego organizmu. Rozwijają kondycję i wytrzymałość siłową, zwiększają dynamikę, szybkość i r&oacute;wnowagę! Trening opiera się na połączeniu siły, elastyczności i gibkości. Odpowiednio dobrane ćwiczenia zapewniają efektywność i są bezpieczne dla zdrowia.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><span style="color: #99cc00;"><strong>1000 kcal kettelbell</strong></span></p>\r\n<p style="text-align: justify;">To zajęcia, w trakcie kt&oacute;rych wykorzystujemy odważniki kettlebell o r&oacute;żnej wadze. To świetny trening redukujący tkankę tłuszczową, ale przede wszystkim umożliwiający harmonijne kształtowanie sylwetki, poprawiający siłę i wytrzymałość oraz panowanie nad własnym ciałem. Z odważnikiem kettlebell wykonujemy dwa rodzaje ćwiczeń - zamachowe, kt&oacute;re rewelacyjnie stymulują nasze serce i pomagają spalić zbędne kalorie, oraz ćwiczenia wzmacniające, kt&oacute;re pięknie rzeźbią nasze ciało. Zajęcia polecamy osobom średnio zaawansowanym i zaawansowanym.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Zdrowy kręgosłup</span></strong></p>\r\n<p style="text-align: justify;">Trening polecany każdemu &ndash; ma zar&oacute;wno charakter profilaktyczny, jak i terapeutyczny. Ćwiczenia obejmują wszystkie obszary ciała mające wpływ na utrzymanie prawidłowej postawy oraz odpowiednich napięć mięśni stabilizujących sylwetkę. Zajęcia ukierunkowane są na zwiększenie świadomości ciała. W trakcie treningu wykorzystywane są r&oacute;żne metody pracy z ciałem m.in. Pilates, Stretch.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Salsation</span></strong></p>\r\n<p style="text-align: justify;">Jest to mieszanka r&oacute;żnych rytm&oacute;w, kultur, tańc&oacute;w i zasad fitness''u. Program kładzie silny nacisk na zabawę połączoną z rozwijaniem własnej świadomości ciała i muzykalności - dlatego w nazwie użyte zostało słowo "sensation", oznaczające odczucia i wrażenia. Salsation opiera się na radości, kt&oacute;rą niesie taniec i ruch oraz kładzie nacisk na muzyczną interpretację poszczeg&oacute;lnych choreografii połączonych z niesamowitą zabawą. Zawiera elementy treningu funkcjonalnego, dzięki czemu można tańczyć i ćwiczyć jednocześnie. Salsation to&nbsp;zajęcia dla każdego, kto dzięki dobrej zabawie chce stale zwiększać swoją mobilność i wytrzymałość!</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Senior</span></strong></p>\r\n<p style="text-align: justify;">Zajęcia prozdrowotne, nastawione na wzmacnianie całego ciała, stworzone z myślą o osobach starszych. Poprawiają gęstość kości, kt&oacute;ra maleje z wiekiem, przez co te stają się podatne na złamania i urazy. Zajęcia gwarantują sprawność fizyczną oraz świetne samopoczucie każdego dnia. Są dostosowane do możliwości uczestnik&oacute;w. Trening prowadzi doświadczona i wykwalifikowana instruktorka.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p><strong><span style="color: #99cc00;">Zajęcia dla dzieci</span></strong></p>\r\n<p style="text-align: justify;">To zajęcia prowadzone przez wykwalifikowaną instruktorkę, dedykowane wszystkim dzieciom między 3 a 8 rokiem życia. Na najmłodszych czekają gry i zabawy ruchowe, zajęcia plastyczne, taneczne i og&oacute;lnorozwojowe. W trakcie ich trwania dzieci nie tylko wspaniale się bawią, lecz r&oacute;wnież poprawiają kondycję i wydolność. To doskonała zabawa, kt&oacute;rej najlepszym dowodem są szczere uśmiechy uczestnik&oacute;w!</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 1, 0),
(83, NULL, 41, 1, 82, 'Zrelaksuj się w gabinecie masażu Sogno!', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 0, 0),
(84, NULL, 41, 1, 85, NULL, NULL, 103, 1, '', '', 'checked', '_blank', '', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="color: #99cc00;"><strong><span style="font-size: 16px;">Marzena</span></strong></span></p>\r\n<p style="text-align: justify;"><span style="font-size: 14px;"><strong>Zajmuje się klasycznymi technikami masażu, od relaksacyjnego, przez kosmetyczne, po masaże terapeutyczne; r&oacute;wnież odnową biologiczną, jak i zajęciami ruchowymi w zakresie kompensacji dysfunkcji narządu ruchu.</strong></span></p>\r\n<p style="text-align: justify;"><span style="font-size: 14px;"><br />Technikę masażu szkoliła w przychodni rehabilitacyjnej (masaże terapeutyczne) i w gabinetach kosmetycznych (masaże relaksacyjne, kosmetyczne i inne zabiegi). Prowadzi r&oacute;wnież zajęcia ruchowe z osobami upośledzonymi. Kilka lat doświadczenia umożliwiło jej zaoferowanie szeregu profesjonalnych masaży i zabieg&oacute;w.</span></p>\r\n<p style="text-align: justify;">&nbsp;</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(85, NULL, 41, 1, 86, NULL, NULL, 102, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="color: #99cc00;"><strong><span style="font-size: 16px;">Wiktor</span></strong></span></p>\r\n<p style="text-align: justify;"><strong><span style="font-size: 14px;">Swoją przygodę z masażem&nbsp;&nbsp;rozpoczął w 2006 roku. Po ukończeniu nauki&nbsp;pracował m.in. w przychodni rehabilitacyjnej oraz wsp&oacute;łpracował z kilkoma z ł&oacute;dzkich SPA. </span></strong></p>\r\n<p style="text-align: justify;"><br /><span style="font-size: 14px;">W czasie tej praktyki ukończył kursy: masażu tybetańskiego potwierdzone certyfikatem IATTM, masażu chińskiego, masażu gorącymi kamieniami oraz masaży dla cel&oacute;w SPA i odnowy biologicznej. Obecnie zajmuje się masażem leczniczym oraz masażem i zabiegami w odnowie biologicznej, a także SPA.</span></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(86, NULL, 41, 1, 83, NULL, NULL, 104, 2, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 26px;">Masaż relaksacyjny, leczniczy, a może&nbsp;gorącą czekoladą? Dowiedz się więcej na&nbsp;</span></p>\r\n<p><span style="font-size: 26px;"><a href="http://www.sognomasaz.pl">www.sognomasaz.pl</a></span></p>\r\n<p>&nbsp;</p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 4, 0),
(88, NULL, 42, 1, 88, NULL, NULL, 99, 2, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;"><strong>Finlandczycy&nbsp;cieszą się&nbsp;dobroczynnymi skutkami korzystania z saun&nbsp;już od tysięcy lat!</strong></p>\r\n<p style="text-align: justify;"><br />Nic dziwnego - w saunie mijają dolegliwości powstałe na tle nerwowym, takie jak b&oacute;le żołądka, bezsenność, gwałtowne bicie serca. Korzystanie z sauny wzmacnia układ odpornościowy. Po 15 minutach pobytu w saunie temperatura ciała rośnie do 40-42&ordm;, co przyśpiesza metabolizm i pośrednio wpływa na redukcję podsk&oacute;rnej tkanki tłuszczowej. Pod wpływem wysokiej temperatury naczynia krwionośne ulegają znacznemu rozszerzeniu, a tętno jest przyspieszone, co stabilizuje ciśnienie tętnicze.<br /> <br />Pod wpływem ciepła rozszerzają się pory i szkodliwe produkty przemiany materii są wydalane razem z potem. Sk&oacute;ra staje się idealnie gładka i oczyszczona. Po wyjściu z sauny temperatura ciała spada do normalnego poziomu, krew jest prawidłowo dotleniona, naczynia krwionośne się zwężają. Znaczna r&oacute;żnica temperatur wzmacnia system immunologiczny organizmu, co stanowi znakomitą barierę dla infekcji grypowych oraz przeziębień.</p>\r\n<p style="text-align: justify;"><br />Trzeba jednak wiedzieć, że wraz z utratą potu następuje utrata składnik&oacute;w mineralnych, mikroelement&oacute;w i witamin. Jeśli nie wyr&oacute;wnamy tej straty, pijąc wody mineralne i soki, możemy doprowadzić do zmniejszenia wydolności organizmu.<br /> <br /><strong>Korzystanie z sauny fińskiej:</strong><br /> <br />-pobudza aktywność układu krążenia,<br />-polepsza procesy przemiany materii,<br />-ułatwia aktywność hormonalną,<br />-wywiera efekt masażu na mięśnie szczeg&oacute;lnie wrażliwe w przypadku &bdquo;łamania w kościach&rdquo;,<br />-przyzwyczaja organizm do zmian temperatur,<br />-leczy schorzenia reumatyczne,<br />-oczyszcza sk&oacute;rę,<br />-uodparnia organizm.<br /> <br /> <br /><strong>W jakich godzinach mogę korzystać z sauny?</strong><br /> <br />Sauna jest gotowa do odbycia zabiegu od poniedziałku do piątku w godzinach 14.00-22.50<br />W godzinach porannych oraz w weekendy korzystanie z sauny jest możliwe po uprzednim zgłoszeniu tego w&nbsp;recepcji (30 min przed planowanym seansem w saunie).</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(91, NULL, 8, 1, 91, NULL, NULL, 131, 3, NULL, NULL, 'checked', '', NULL, NULL, 0, 1, NULL, NULL, 'checked', '', NULL, NULL, 0, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 2, 0),
(94, NULL, 45, 1, 94, NULL, NULL, 93, 2, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 18px;">Witaj w strefie <span style="color: #99cc00;"><strong>siły</strong></span>.</span></p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: justify;"><span style="font-size: 18px;">To właśnie tutaj wykonasz trening najlepiej odpowiadający Twoim potrzebom. Opr&oacute;cz nowoczesnych&nbsp;maszyn firmy Technogym oraz HES, a także strefy wolnych ciężar&oacute;w, czekają tu na Ciebie nasi instruktorzy siłowni. Dzięki ich pomocy sw&oacute;j cel treningowy osiągniesz szybciej, niż myślisz!</span></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(95, NULL, 46, 1, 95, NULL, NULL, 92, 2, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 18px;">Witaj w strefie <span style="color: #99cc00;"><strong>cardio</strong></span>.</span></p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: justify;"><span style="font-size: 18px;">Nasze bieżnie, rowery, KRANKi, orbitreki i wiosła przysłużyły się do zrzucenia tysięcy kilogram&oacute;w przez naszych klubowicz&oacute;w. Teraz nadszedł czas, abyś to Ty zrobił z nich użytek!</span></p>', '', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(96, NULL, 47, 1, 97, NULL, NULL, 168, 1, NULL, NULL, '', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;"><span style="color: #99cc00; font-size: 18px;"><strong>Trening personalny &mdash; dla kogo?</strong></span></p>\r\n<p style="text-align: justify;"><br />Treningi personalne są idealnym rozwiązaniem zar&oacute;wno dla pań, jak i dla pan&oacute;w.</p>\r\n<p style="text-align: justify;"><br />Kobiety, kt&oacute;re pragną pozbyć się zbędnych kilogram&oacute;w, chcą wr&oacute;cić do formy po porodzie lub kontuzji, bądź też mają na celu wymodelowanie swojej sylwetki, coraz częściej wybierają pracę pod okiem personalnego trenera. W klubie atmosfera może nim być zar&oacute;wno kobieta, jak i mężczyzna, co daje pełny komfort i zaufanie w rozmowie o swoich potrzebach.</p>\r\n<p style="text-align: justify;"><br />Mężczyźni, kt&oacute;rzy ponownie chcą czuć się silni i sprawni albo marzą o tym, aby ponownie założyć sw&oacute;j ulubiony garnitur, powinni postawić na efektywność i kompleksowość podejścia do treningu. Osoby, kt&oacute;rych celem jest wystartowanie w amatorskim maratonie lub wyprawa wysokog&oacute;rska potrzebują specjalisty, kt&oacute;ry poprowadzi ich do zamierzonych cel&oacute;w.</p>\r\n<p style="text-align: justify;"><br />Treningi te są bezcenne dla os&oacute;b początkujących jak i zaawansowanych. Nie popełniaj błęd&oacute;w na początku swojej drogi, bo one mogą kosztować Cię utratę motywacji lub brak efekt&oacute;w! Nie popadaj w rutynę, bo nawet doświadczony miłośnik sportu potrzebuje nowych impuls&oacute;w i zadbania o szczeg&oacute;ły &mdash; pamiętaj, że mistrz często jest lepszy tylko o kilka centymetr&oacute;w od reszty peletonu!</p>\r\n<p style="text-align: justify;"><br />Każdy wiek jest dobry, by podjąć aktywność fizyczną i zadbać o swoje zdrowie pod czujnym okiem doświadczonego trenera! Zapraszamy młodzież i osoby starsze, każdy uzyska optymalne wsparcie w dążeniu do swojego celu.</p>\r\n<p style="text-align: justify;"><br /><span style="font-size: 18px;"><strong><span style="color: #99cc00;">Czy trening personalny to tylko ćwiczenia?</span></strong></span></p>\r\n<p style="text-align: justify;"><br />Aby Twoje ciało było sprawne i silne oraz wyglądało tak, jak sobie tego życzysz, potrzeba wielu starań. Abyś osiągnął zamierzone cele, musimy synergicznie włączyć r&oacute;żne działania: trening fizyczny, odpowiednie odżywianie, suplementację, odnowę biologiczną oraz przede wszystkim właściwą motywację. Zadaniem trenera personalnego jest pom&oacute;c Ci na każdym z tych obszar&oacute;w. Jedynie właściwe połączenie tych wszystkich element&oacute;w zagwarantuje Ci sukces.</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(97, NULL, 47, 1, 96, 'najlepszy sposób na realizację Twoich marzeń!', '', NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'checked', 0, 0);
INSERT INTO `artykuly_tresc` (`id`, `id_rodzic_blok`, `id_art_nazwa`, `id_lang`, `sort`, `naglowek_bloku`, `naglowek_bloku_typ`, `id_zdjecie_1`, `rozmiar_1`, `podpis_1`, `adres_1`, `powieksz_1`, `target_1`, `alt_1`, `title_1`, `id_zdjecie_2`, `rozmiar_2`, `podpis_2`, `adres_2`, `powieksz_2`, `target_2`, `alt_2`, `title_2`, `id_zdjecie_3`, `rozmiar_3`, `podpis_3`, `adres_3`, `powieksz_3`, `target_3`, `alt_3`, `title_3`, `tresc`, `oblewanie_zdjecie`, `id_plik_1`, `nazwa_plik_1`, `id_plik_2`, `nazwa_plik_2`, `typ_plik`, `widocznosc`, `typ`, `typ_zaawansowany`) VALUES
(98, NULL, 47, 1, 98, NULL, NULL, 169, 1, NULL, NULL, '', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p style="text-align: justify;"><strong><span style="color: #99cc00; font-size: 18px;">Co zyskasz dzięki treningom personalnym w klubie atmosfera fitness &amp; wellness?</span></strong></p>\r\n<p style="text-align: justify;">1. Indywidualne podejście &mdash; bo Twoje potrzeby i oczekiwania są najważniejsze.<br />2. Specjalistę i asystenta &mdash; bo potrzebujesz kompleksowego wsparcia, aby osiągnąć sukces.<br />3. Szybsze efekty &mdash; bo Tw&oacute;j czas jest bardzo cenny.<br />4. Motywację &mdash; bo Ty też możesz mieć chwile zwątpienia.<br />5. System Gravity &mdash; wyjątkowo efektywny i bezpieczny trening z najnowszym sprzętem, wyłącznie dla Ciebie!</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;"><strong>1. Zyskujesz indywidualne podejście:</strong><br />Wiedza Naszych trener&oacute;w pozwoli na indywidualne podejście do Twoich potrzeb, cel&oacute;w i oczekiwań. Instruktor podczas treningu jest wyłącznie do Twojej dyspozycji &mdash; poświęca Ci 100% swojej uwagi, dzięki czemu możesz być pewien, że każde ćwiczenie wykonujesz w prawidłowy spos&oacute;b, co daje gwarancję maksymalnego bezpieczeństwa i efektywności.</p>\r\n<p style="text-align: justify;"><br /><strong>2. Zyskujesz asystenta i specjalistę:</strong><br />Instruktor będzie nie tylko Twoim trenerem, ale także doradcą, dietetykiem, specjalistą w zakresie zdrowego stylu życia a z czasem może nawet stać się Twoim przyjacielem. Nasi trenerzy to ludzie z pasją, ogromną wiedzą i doświadczeniem. Ćwicząc z nimi zyskasz dostęp do kopalni wiedzy &mdash; jakie ćwiczenia są dla ciebie najbardziej odpowiednie, w jaki spos&oacute;b powinieneś/aś się odżywiać oraz jak efektywnie regenerować. Trener dobierze Ci kompleksowy plan treningowy i będzie pilnował, abyś bezwzględnie go przestrzegał. Na bieżąco będzie monitorował postępy w treningach, w razie potrzeby doradzi zastosowanie odpowiednich suplement&oacute;w i odżywek. Założy kartotekę, w kt&oacute;rej będzie zapisywał Twoje (zmieniające się) parametry takie jak: waga, poziom tkanki tłuszczowej, poziom tkanki mięśniowej, liczbę wykonywanych powt&oacute;rzeń danego ćwiczenia, ciężary z jakimi pracujesz. Dzięki temu, po pewnym czasie dostaniesz do ręki niezbite dowody na to, że Tw&oacute;j wysiłek się opłacił i zobaczysz progres, jaki osiągnąłeś/aś. Będzie to doskonałe podsumowanie ciężkiej pracy jaką wykonałeś/aś.</p>\r\n<p style="text-align: justify;"><br /><strong>3. Zyskujesz szybsze efekty:</strong><br />Zdajemy sobie sprawę, że w dzisiejszym świecie czas jest jedną z najcenniejszych wartości każdego człowieka: pogodzenie pracy, rodziny, przyjaci&oacute;ł, własnego rozwoju oraz czasu na relaks i wytchnienie wydaj się dziś niemal niemożliwe. Możemy pom&oacute;c Ci jednak zadbać o Twoje zdrowie i ciało w najefektywniejszy spos&oacute;b. Personalny trener w ciągu jedynie 60 minut przeprowadzi kompleksowy trening dopasowany do Twoich możliwości i cel&oacute;w. Zadba o Tw&oacute;j sprzęt, poprawną technikę i urozmaicenie treningu. Już dwa treningi w tygodniu oraz przestrzeganie zaleceń trenera zmienią jakość Twojego życia bezpowrotnie.</p>\r\n<p style="text-align: justify;"><br /><strong>4. Zyskujesz motywację:</strong><br />Pracując z własnym trenerem dużo trudniej będzie Ci opuścić trening, skończą się wym&oacute;wki i wymyślane na biegu usprawiedliwienia. Poza tym masz pewność, że nie braknie Ci motywacji. Instruktor wie jak, w krytycznym momencie, wesprzeć, zmotywować i zmobilizować swojego podopiecznego do działania. Możesz być pewien, że ta systematyczność Ci się opłaci.</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 4, 0),
(99, NULL, 47, 1, 99, NULL, NULL, 167, 1, NULL, NULL, '', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><strong>5. zyskujesz system Gravity:</strong><br />W klubie atmosfera na treningach personalnych umożliwimy Ci pracę według amerykańskiej koncepcji Gravity, na najwyższym modelu urządzenia Total Gym PowerTower &mdash; urządzeniu, kt&oacute;re pozwala na wykonywanie setki ćwiczeń na wszystkie partie mięśniowe, wykorzystując jako op&oacute;r masę Twojego ciała. Trening Gravity, to nie tylko trening siłowy, ale także możliwość wykonania ćwiczeń rozciągających i Pilates. Total Gym PowerTower &mdash; to urządzenie z powodzeniem może zastąpić Ci całą siłownię, teraz nie musisz już czekać w kolejce na sprzęt!</p>\r\n<p><br /><span style="color: #99cc00; font-size: 18px;"><strong>Cennik:</strong></span><br />1 trening - 100 zł<br />10 trening&oacute;w &ndash; 900 zł (1 trening &ndash; 90 zł) + 1 pomiar wraz z analizą składu ciała gratis<br />30 trening&oacute;w &ndash; 2550 zł (1 trening - 85 zł) + 5 pomiar&oacute;w wraz z analizą składu ciała gratis</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 3, 0),
(101, NULL, 49, 1, 101, NULL, NULL, 170, 1, NULL, NULL, '', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, NULL, 1, NULL, NULL, 'checked', '', NULL, NULL, '<p><span style="font-size: 16px;"><span style="color: #99cc00;"><strong>analizator składu ciała InBody220</strong></span>!</span><br />Urządzenie InBody220 wraz z oprogramowaniem Lookin&rsquo;Body pozwala na pełną i dokładną kontrolę i analizę poprawy sprawności fizycznej i składu ciała zawodnik&oacute;w r&oacute;żnych dyscyplin sportowych.<br /><br />Dzięki niemu możliwa jest m.in.:<br />-analiza składu ciała: ilość wody (w l), minerał&oacute;w, protein (w kg)&nbsp;i tłuszczu (w kg) w organizmie,<br />-analiza mięśniowo- tłuszczowa: masa ciała, ilość mięśni szkieletowych, masa tkanki tłuszczowej,<br />-diagnoza otyłości: procent tkanki tłuszczowej i wskaźnik masy ciała (BMI);&nbsp;jest w stanie wykryć nawet ukrytą otyłość brzuszną,<br />-diagnoza odżywiania: proteiny, minerały, tłuszcze,<br />-diagnoza i kontrola wagi (docelowa waga, kontrola wagi, kontrola tłuszczu,&nbsp;kontrola mięśni, skala fitness, podstawowa przemiana materii),<br />-wydatek energetyczny, sugerowany plan treningowy: ilość spożywanych kalorii dostosowana do prawidłowej masy ciała, zalecana dzienna kaloryczność,</p>\r\n<p>&nbsp;</p>\r\n<p>Analiza składu ciała urządzeniem InBody220 wraz z om&oacute;wieniem wynik&oacute;w (czas trwania ok: 10-15 minut), na podstawie kt&oacute;rej ustalany jest optymalny plan treningowy &mdash; <strong>cena regularna* <span style="color: #99cc00;">50 zł</span>.</strong><br />* zadzwoń i zapytaj o aktualną promocję pod numerem 42 2336633</p>', 'checked', NULL, NULL, NULL, NULL, 1, 'checked', 4, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artykuly_trzon`
--

CREATE TABLE IF NOT EXISTS `artykuly_trzon` (
  `id_trzon` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_rodzic` int(5) unsigned DEFAULT NULL,
  `sort` int(5) unsigned DEFAULT NULL,
  `typ` tinyint(1) unsigned DEFAULT NULL,
  `data_modyfikacji` date DEFAULT NULL,
  `id_zdjecie` int(5) unsigned DEFAULT NULL,
  `naglowek_h1` varchar(8) NOT NULL DEFAULT '',
  `http_auto` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_trzon`),
  KEY `artykuly_trzon_id_rodzic_FK` (`id_rodzic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Zrzut danych tabeli `artykuly_trzon`
--

INSERT INTO `artykuly_trzon` (`id_trzon`, `id_rodzic`, `sort`, `typ`, `data_modyfikacji`, `id_zdjecie`, `naglowek_h1`, `http_auto`) VALUES
(1, NULL, 1, 1, '2015-11-17', NULL, 'checked', 'checked'),
(2, 1, 3, 0, '2015-11-23', NULL, 'checked', 'checked'),
(8, 1, 21, 0, '2015-11-23', NULL, 'checked', 'checked'),
(12, NULL, 12, 1, '2015-11-17', NULL, 'checked', 'checked'),
(13, 12, 13, 0, '2015-11-23', NULL, 'checked', 'checked'),
(14, 12, 14, 0, '2016-03-02', NULL, 'checked', 'checked'),
(17, 12, 17, 0, '2015-11-23', NULL, 'checked', 'checked'),
(18, 12, 18, 0, '2015-11-23', NULL, 'checked', 'checked'),
(19, 1, 19, 0, '2015-11-23', NULL, 'checked', 'checked'),
(20, 1, 20, 0, '2015-11-23', NULL, 'checked', 'checked'),
(22, 12, 22, 0, '2015-11-23', NULL, 'checked', 'checked'),
(26, 1, 36, 0, '2015-11-23', NULL, 'checked', 'checked'),
(29, 1, 4, 1, '2016-01-20', NULL, 'checked', 'checked'),
(31, 29, 32, 0, '2016-01-20', NULL, 'checked', 'checked'),
(32, 29, 31, 0, '2016-01-20', NULL, 'checked', 'checked'),
(33, 29, 33, 0, '2016-01-20', NULL, 'checked', 'checked'),
(34, 1, 5, 1, '2016-01-22', NULL, 'checked', 'checked'),
(35, 34, 35, 0, '2016-01-22', NULL, 'checked', ''),
(36, 34, 36, 0, '2016-01-22', NULL, 'checked', 'checked'),
(40, 1, 9, 1, '2016-02-05', NULL, 'checked', 'checked'),
(41, 40, 41, 0, '2016-02-05', NULL, 'checked', 'checked'),
(42, 40, 42, 0, '2016-02-23', NULL, 'checked', 'checked'),
(44, 1, 6, 1, '2016-03-28', NULL, 'checked', 'checked'),
(45, 44, 45, 0, '2016-03-28', NULL, 'checked', 'checked'),
(46, 44, 46, 0, '2016-03-28', NULL, 'checked', 'checked'),
(47, 44, 47, 0, '2016-03-28', NULL, 'checked', 'checked'),
(49, 44, 49, 0, '2016-03-31', NULL, 'checked', 'checked');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `banery_nazwa`
--

CREATE TABLE IF NOT EXISTS `banery_nazwa` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_trzon` int(5) unsigned DEFAULT NULL,
  `id_lang` int(1) unsigned DEFAULT NULL,
  `nazwa` varchar(255) DEFAULT NULL,
  `id_zdjecia` int(5) unsigned DEFAULT NULL,
  `rozmiar_zdjecia` int(1) unsigned DEFAULT NULL,
  `http` varchar(255) DEFAULT NULL,
  `http_target` varchar(15) DEFAULT NULL,
  `baner_txt` text,
  `baner_alt` varchar(255) DEFAULT NULL,
  `baner_title` varchar(255) DEFAULT NULL,
  `widocznosc` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `banery_nazwa_id_lang_FK` (`id_lang`),
  KEY `banery_nazwa_id_trzon_FK` (`id_trzon`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Zrzut danych tabeli `banery_nazwa`
--

INSERT INTO `banery_nazwa` (`id`, `id_trzon`, `id_lang`, `nazwa`, `id_zdjecia`, `rozmiar_zdjecia`, `http`, `http_target`, `baner_txt`, `baner_alt`, `baner_title`, `widocznosc`) VALUES
(1, 1, 1, 'TOP - STRONA GŁÓWNA', NULL, 4, NULL, NULL, NULL, NULL, NULL, 'checked'),
(2, 2, 1, 'ATMOSFERA', 2, 4, 'kontakt', '_self', '<p>fitness &amp; wellness</p>', '', '', 'checked'),
(3, 3, 1, '', 2, 4, '', '_blank', '<p><span style="font-size: 60px;">Pierwszy krok zr&oacute;b <span style="color: #99cc00;">sam</span>.</span></p>', '', '', 'checked'),
(4, 4, 1, 'BOXY - STRONA GŁÓWNA', NULL, 4, NULL, NULL, NULL, NULL, NULL, 'checked'),
(5, 5, 1, 'STREFA WELLNESS', 0, 4, 'wellness/gabinet-masazu', '_self', '<p>Twoja strefa relaksu</p>', '', '', 'checked'),
(6, 6, 1, 'ODBIERZ VOUCHER', 0, 4, '/atmosfera/aktualnosci/zapros-znajomego-i-odbierz-nagrode', '_self', '<p>zaproś znajomego i zgarnij atmosferyczny gadżet</p>', '', '', 'checked'),
(7, 7, 1, 'ZOBACZ GRAFIK', 0, 4, 'grafik', '_self', '<p>Wybierz zajęcia idealne dla siebie</p>', '', '', 'checked'),
(8, 8, 1, 'honorujemy karty', NULL, 4, NULL, NULL, NULL, NULL, NULL, 'checked'),
(10, 10, 1, 'Ok system', 13, 4, '', '_blank', NULL, NULL, NULL, 'checked'),
(11, 11, 1, 'Fit Profit', 11, 4, '', '_blank', NULL, NULL, NULL, 'checked'),
(12, 12, 1, 'Benefit Systems', 10, 4, '', '_blank', NULL, NULL, NULL, 'checked'),
(14, 14, 1, 'TOP - PODSTRONY', NULL, 4, NULL, NULL, NULL, NULL, NULL, 'checked'),
(16, 16, 1, '', 2, 4, '/atmosfera/aktualnosci', '_self', '<p><span style="font-size: 40px;">Sprawdź, co słychać&nbsp;w <span style="color: #99cc00;">atmosferze</span></span></p>', '', '', 'checked'),
(17, 17, 1, '', 2, 4, '', '_blank', '<p><span style="font-size: 60px;">Każdy kolejny </span></p>\r\n<p><span style="font-size: 60px;">- zrobimy <span style="color: #99cc00;">razem</span>!</span></p>', '', '', 'checked'),
(18, 18, 1, 'Fit Sport', 166, 4, '', '_blank', NULL, NULL, NULL, 'checked');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `banery_trzon`
--

CREATE TABLE IF NOT EXISTS `banery_trzon` (
  `id_trzon` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_rodzic` int(5) unsigned DEFAULT NULL,
  `sort` int(5) unsigned DEFAULT NULL,
  `typ` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_trzon`),
  KEY `banery_trzon_id_rodzic_FK` (`id_rodzic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Zrzut danych tabeli `banery_trzon`
--

INSERT INTO `banery_trzon` (`id_trzon`, `id_rodzic`, `sort`, `typ`) VALUES
(1, NULL, 1, 1),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, NULL, 3, 1),
(5, 4, 7, 0),
(6, 4, 6, 0),
(7, 4, 5, 0),
(8, NULL, 4, 1),
(10, 8, 13, 0),
(11, 8, 12, 0),
(12, 8, 11, 0),
(14, NULL, 2, 1),
(16, 14, 15, 0),
(17, 1, 4, 0),
(18, 8, 10, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `files_tmp`
--

CREATE TABLE IF NOT EXISTS `files_tmp` (
  `id_file_tmp` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `id_session` varchar(255) DEFAULT NULL,
  `date_upload` date DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_file_tmp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jezyki`
--

CREATE TABLE IF NOT EXISTS `jezyki` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(255) DEFAULT NULL,
  `ikona` varchar(10) DEFAULT NULL,
  `widocznosc` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `jezyki`
--

INSERT INTO `jezyki` (`id`, `nazwa`, `ikona`, `widocznosc`) VALUES
(1, 'polski', 'pl', 'checked');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `metatagi`
--

CREATE TABLE IF NOT EXISTS `metatagi` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_lang` int(1) unsigned DEFAULT NULL,
  `slowa_kluczowe` varchar(255) DEFAULT NULL,
  `opis_strony` text,
  `tytul` varchar(255) DEFAULT NULL,
  `link_fb` varchar(255) DEFAULT NULL,
  `tekst_grafik` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `metatagi_id_lang_FK` (`id_lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `metatagi`
--

INSERT INTO `metatagi` (`id`, `id_lang`, `slowa_kluczowe`, `opis_strony`, `tytul`, `link_fb`, `tekst_grafik`) VALUES
(1, 1, 'atmosfera fitness, fitness Łódź, siłownia Łódź, masaż Retkinia, siłownia Retkinia, Zumba Łódź, Indoor Cycling Łódź, crossfit Łódź, Joga Łódź, TRX Łódź, kettlebell Łódź, siłownia piaski, dietetyk retkinia, trening personalny łódź, fitness retkinia', 'Witaj! Jak dobrze, że do nas trafiłeś - atmosfera fitness & wellness to jedyny taki fitness klub i siłownia w Łodzi. Sprawdź sam, dołączając do zajęć Indoor Cycling, Zumba, TRX, Cross, Płaski Brzuch, Joga, Kettlebell i wielu innych. Łódź, Retkinia.', 'atmosfera fitness &amp; wellness', 'https://www.facebook.com/atmosferafitness', 'ważny od 16.02.2016r.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `module` varchar(20) NOT NULL,
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `migrations`
--

INSERT INTO `migrations` (`module`, `version`) VALUES
('CI_core', 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `newsletter_config`
--

CREATE TABLE IF NOT EXISTS `newsletter_config` (
  `id_config` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `sender_email` varchar(255) DEFAULT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_secure` varchar(10) DEFAULT NULL,
  `sender_login` varchar(255) DEFAULT NULL,
  `sender_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `newsletter_config`
--

INSERT INTO `newsletter_config` (`id_config`, `sender_email`, `sender_name`, `smtp_host`, `smtp_secure`, `sender_login`, `sender_password`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `newsletter_members`
--

CREATE TABLE IF NOT EXISTS `newsletter_members` (
  `id_member` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `confirmation` varchar(8) DEFAULT NULL,
  `date_join` timestamp NULL DEFAULT NULL,
  `id_lang` int(1) unsigned DEFAULT NULL,
  `id_user` int(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_member`),
  UNIQUE KEY `email` (`email`),
  KEY `newsletter_members_id_lang_FK` (`id_lang`),
  KEY `newsletter_members_id_user_FK` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `newsletter_messages`
--

CREATE TABLE IF NOT EXISTS `newsletter_messages` (
  `id_message` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `content` text,
  `status` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `newsletter_messages_lang`
--

CREATE TABLE IF NOT EXISTS `newsletter_messages_lang` (
  `id_message` int(5) unsigned DEFAULT NULL,
  `id_lang` int(1) unsigned DEFAULT NULL,
  KEY `newsletter_messages_lang_id_lang_FK` (`id_lang`),
  KEY `newsletter_messages_lang_id_message_FK` (`id_message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `newsletter_shipping`
--

CREATE TABLE IF NOT EXISTS `newsletter_shipping` (
  `id_member` int(5) unsigned DEFAULT NULL,
  `id_message` int(5) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `shipment_date` timestamp NULL DEFAULT NULL,
  KEY `newsletter_shipping_id_member_FK` (`id_member`),
  KEY `newsletter_shipping_id_message_FK` (`id_message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pliki`
--

CREATE TABLE IF NOT EXISTS `pliki` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_rodzic` int(5) unsigned DEFAULT NULL,
  `sort` int(5) unsigned NOT NULL DEFAULT '0',
  `nazwa` varchar(255) DEFAULT NULL,
  `opis` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `wlasciciel` int(1) unsigned NOT NULL DEFAULT '0',
  `typ_pliku` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pliki_id_rodzic_FK` (`id_rodzic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=171 ;

--
-- Zrzut danych tabeli `pliki`
--

INSERT INTO `pliki` (`id`, `id_rodzic`, `sort`, `nazwa`, `opis`, `data`, `wlasciciel`, `typ_pliku`) VALUES
(1, NULL, 1, NULL, 'Banery', '2015-11-17', 1, 1),
(2, 1, 2, 'banner.jpg', 'banner.jpg', '2016-03-30', 1, 0),
(3, NULL, 3, NULL, 'Aktualności', '2015-11-17', 1, 1),
(4, 3, 4, 'news-1.jpg', 'news-1', '2015-11-17', 1, 0),
(5, 3, 5, 'news-2.jpg', 'news-2', '2015-11-17', 1, 0),
(6, 3, 6, 'news-3.jpg', 'news-3', '2015-11-17', 1, 0),
(7, NULL, 7, NULL, 'Artykuły', '2015-11-17', 1, 1),
(8, 7, 8, 'o-klubie-atmosfera.jpg', 'o-klubie-atmosfera', '2015-11-17', 1, 0),
(9, 1, 29, NULL, 'karty', '2015-11-17', 1, 1),
(10, 9, 10, 'benefit-system.png', 'benefit-system.png', '2015-11-24', 1, 0),
(11, 9, 11, 'fit-profit.png', 'fit-profit.png', '2015-11-24', 1, 0),
(13, 9, 13, 'ok-system.png', 'ok-system.png', '2015-11-24', 1, 0),
(14, 7, 14, 'article-img.jpg', 'article-img', '2015-11-18', 1, 0),
(15, NULL, 15, NULL, 'Galeria', '2015-11-18', 1, 1),
(21, NULL, 21, NULL, 'Instruktorzy', '2015-11-19', 1, 1),
(22, 21, 22, 'instructor.jpg', 'instructor', '2015-11-19', 1, 0),
(23, NULL, 23, NULL, 'Przyjaciele atmosfery', '2015-11-19', 1, 1),
(29, 1, 9, 'test-instruktor-atmosfera.jpg', 'test-instruktor-atmosfera', '2015-11-24', 1, 0),
(48, NULL, 30, NULL, 'My :)', '2016-01-20', 4, 1),
(49, 48, 49, 'ada1.jpg', 'ada1', '2016-01-20', 4, 0),
(50, 48, 50, 'agnieszka1.jpg', 'agnieszka1', '2016-01-20', 4, 0),
(51, 48, 51, 'dawid1.jpg', 'dawid1', '2016-01-20', 4, 0),
(52, 48, 52, 'ania-sz.1.jpg', 'ania-sz.1', '2016-01-20', 4, 0),
(53, 48, 53, 'gosia-21.jpg', 'gosia-21', '2016-01-20', 4, 0),
(54, 48, 54, 'gosia-11.jpg', 'gosia-11', '2016-01-20', 4, 0),
(55, 48, 55, 'julia1.jpg', 'julia1', '2016-01-20', 4, 0),
(56, 48, 56, 'kasia1.jpg', 'kasia1', '2016-01-20', 4, 0),
(57, 48, 57, 'kamila1.jpg', 'kamila1', '2016-01-20', 4, 0),
(58, 48, 58, 'maria1.jpg', 'maria1', '2016-01-20', 4, 0),
(59, 48, 59, 'kuba1.jpg', 'kuba1', '2016-01-20', 4, 0),
(60, 48, 60, 'emilka1.jpg', 'emilka1', '2016-01-20', 4, 0),
(61, 48, 61, 'ewa1.jpg', 'ewa1', '2016-01-20', 4, 0),
(62, 48, 62, 'szczepan1.jpg', 'szczepan1', '2016-01-20', 4, 0),
(63, 48, 63, 'pawel1.jpg', 'pawel1', '2016-01-20', 4, 0),
(64, 48, 64, 'szymon1.jpg', 'szymon1', '2016-01-20', 4, 0),
(65, 48, 65, 'paula1.jpg', 'paula1', '2016-01-20', 4, 0),
(66, 48, 66, 'weronika1.jpg', 'weronika1', '2016-01-20', 4, 0),
(67, 48, 67, 'no-picture.jpg', 'no-picture', '2016-01-22', 4, 0),
(68, 48, 68, 'no-picture1.jpg', 'no-picture1', '2016-01-22', 4, 0),
(69, NULL, 69, NULL, 'Grafik zajęć', '2016-01-22', 4, 1),
(70, 69, 70, 'na-strone-od-stycznia-ok-kopia.jpg', 'na-strone-od-stycznia-ok-kopia', '2016-01-22', 4, 0),
(71, 69, 71, 'na-strone-od-stycznia-ok.jpg', 'na-strone-od-stycznia-ok', '2016-01-22', 4, 0),
(72, 69, 72, 'atm_harmonogram_zajec.jpg', 'atm_harmonogram_zajec', '2016-01-22', 4, 0),
(73, 15, 73, '1-3-1.jpg', '1-3-1', '2016-02-03', 4, 0),
(74, 15, 74, '1-3.jpg', '1-3', '2016-02-03', 4, 0),
(75, 15, 75, '1-2-1-1.jpg', '1-2-1-1', '2016-02-03', 4, 0),
(76, 15, 76, '1-4-1.jpg', '1-4-1', '2016-02-03', 4, 0),
(77, 15, 77, '1-1.jpg', '1-1', '2016-02-03', 4, 0),
(78, 15, 78, '1-1-1.jpg', '1-1-1', '2016-02-03', 4, 0),
(79, 15, 79, '1-4.jpg', '1-4', '2016-02-03', 4, 0),
(80, 15, 80, '1-2.jpg', '1-2', '2016-02-03', 4, 0),
(81, 15, 81, '1-5.jpg', '1-5', '2016-02-03', 4, 0),
(82, 15, 82, '1-6.jpg', '1-6', '2016-02-03', 4, 0),
(83, 15, 83, '1-5-1.jpg', '1-5-1', '2016-02-03', 4, 0),
(87, 15, 87, '1-7.jpg', '1-7', '2016-02-03', 4, 0),
(88, 15, 88, '1-91.jpg', '1-91', '2016-02-03', 4, 0),
(89, 15, 89, '1-81.jpg', '1-81', '2016-02-03', 4, 0),
(90, 15, 90, '1-101.jpg', '1-101', '2016-02-03', 4, 0),
(91, 15, 91, '1-13.jpg', '1-13', '2016-02-03', 4, 0),
(92, 15, 92, '1-14.jpg', '1-14', '2016-02-03', 4, 0),
(93, 15, 93, '1-17.jpg', '1-17', '2016-02-03', 4, 0),
(94, 15, 94, '1-15.jpg', '1-15', '2016-02-03', 4, 0),
(95, 15, 95, '1-12.jpg', '1-12', '2016-02-03', 4, 0),
(96, 15, 96, '1-21.jpg', '1-21', '2016-02-03', 4, 0),
(97, 15, 97, '1-18.jpg', '1-18', '2016-02-03', 4, 0),
(98, 15, 98, '1-19.jpg', '1-19', '2016-02-03', 4, 0),
(99, 15, 99, '1-20.jpg', '1-20', '2016-02-03', 4, 0),
(100, NULL, 100, 'urodziny-2016.jpg', 'urodziny-2016', '2016-02-03', 4, 0),
(101, 3, 101, 'odbierz-voucher-plakat-a3_01.jpg', 'odbierz-voucher-plakat-a3_01', '2016-02-03', 4, 0),
(102, 3, 102, 'wiktor_atm.jpg', 'wiktor_atm', '2016-02-05', 4, 0),
(103, 3, 103, 'marzena_atm.jpg', 'marzena_atm', '2016-02-05', 4, 0),
(104, 3, 104, '10960190_465274723620051_5595457850496441825_o.jpg', '10960190_465274723620051_5595457850496441825_o', '2016-02-05', 4, 0),
(131, NULL, 131, 'cennik_2015_poprawiony_01.jpg', 'cennik_2015_poprawiony_01', '2016-03-10', 4, 0),
(132, 23, 132, '12822688_1406579706025933_1962420577_o.jpg', '12822688_1406579706025933_1962420577_o', '2016-03-21', 4, 0),
(133, 23, 133, 'se.jpg', 'se', '2016-03-24', 4, 0),
(134, 23, 134, 'sen.jpg', 'sen', '2016-03-24', 4, 0),
(135, 23, 135, 'sss.jpg', 'sss', '2016-03-24', 4, 0),
(136, 23, 136, 'seni.jpg', 'seni', '2016-03-24', 4, 0),
(137, 23, 137, 'ssss.jpg', 'ssss', '2016-03-24', 4, 0),
(138, 23, 138, 'gt.jpg', 'gt', '2016-03-24', 4, 0),
(140, 23, 140, 'sklep.jpg', 'sklep', '2016-03-24', 4, 0),
(141, 23, 141, 'body-shop.jpg', 'body-shop', '2016-03-24', 4, 0),
(142, 23, 142, '12829528_632754076872114_6596330578039779440_o.jpg', '12829528_632754076872114_6596330578039779440_o', '2016-03-24', 4, 0),
(143, 23, 143, '12814501_626752877472234_6779360440233666307_n.jpg', '12814501_626752877472234_6779360440233666307_n', '2016-03-24', 4, 0),
(144, 23, 144, '9559_630953793718809_254465611116009081_n.jpg', '9559_630953793718809_254465611116009081_n', '2016-03-24', 4, 0),
(145, 23, 145, '12794579_627199344094254_2839984984948379268_n.jpg', '12794579_627199344094254_2839984984948379268_n', '2016-03-24', 4, 0),
(146, 23, 146, '12814539_627055347441987_1587270390791648526_n.jpg', '12814539_627055347441987_1587270390791648526_n', '2016-03-24', 4, 0),
(148, NULL, 148, 'trx-core.jpg', 'trx-core', '2016-03-31', 4, 0),
(149, 23, 149, 'domenica.jpg', 'domenica', '2016-03-31', 4, 0),
(150, 23, 150, 'ekspert1.jpg', 'ekspert1', '2016-03-31', 4, 0),
(151, 23, 151, '226606_157262961004521_6744197_n.jpg', '226606_157262961004521_6744197_n', '2016-03-31', 4, 0),
(152, 23, 152, 'indoorcycling.jpg', 'indoorcycling', '2016-03-31', 4, 0),
(153, 23, 153, 'om-logo.jpg', 'om-logo', '2016-03-31', 4, 0),
(154, 23, 154, 'konstancja.jpg', 'konstancja', '2016-03-31', 4, 0),
(156, 23, 156, '2skin.jpg', '2skin', '2016-03-31', 4, 0),
(157, 23, 157, 'makeup-my-love1.jpg', 'makeup-my-love1', '2016-03-31', 4, 0),
(158, 23, 158, 'megafit-logo-1.jpg', 'megafit-logo-1', '2016-03-31', 4, 0),
(159, 23, 159, 'tiguar.jpg', 'tiguar', '2016-03-31', 4, 0),
(160, 23, 160, 'sogno.jpg', 'sogno', '2016-03-31', 4, 0),
(163, 23, 163, 'pluta.jpg', 'pluta', '2016-03-31', 4, 0),
(164, 23, 164, 'fiore.jpg', 'fiore', '2016-03-31', 4, 0),
(165, 23, 165, 'megafit-logo-kopia.jpg', 'megafit-logo-kopia', '2016-03-31', 4, 0),
(166, 9, 166, 'fitsport.png', 'fitsport', '2016-03-31', 4, 0),
(167, NULL, 167, 'grav.jpg', 'grav', '2016-03-31', 4, 0),
(168, NULL, 168, 'img_3275.jpg', 'img_3275', '2016-03-31', 4, 0),
(169, NULL, 169, 'img_3369.jpg', 'img_3369', '2016-03-31', 4, 0),
(170, NULL, 170, 'inbody220_with_a_model_copy.jpg', 'inbody220_with_a_model_copy', '2016-03-31', 4, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pliki_ustawienia`
--

CREATE TABLE IF NOT EXISTS `pliki_ustawienia` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `wymiar` varchar(20) DEFAULT NULL,
  `width` int(1) unsigned DEFAULT NULL,
  `width_kadr` int(1) unsigned DEFAULT NULL,
  `height` int(1) unsigned DEFAULT NULL,
  `height_kadr` int(1) unsigned DEFAULT NULL,
  `quality` int(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `pliki_ustawienia`
--

INSERT INTO `pliki_ustawienia` (`id`, `wymiar`, `width`, `width_kadr`, `height`, `height_kadr`, `quality`) VALUES
(1, 'panel', 100, 75, 100, 75, 90),
(2, 'mini', 400, 140, 800, 140, 90),
(3, 'medium', 600, 270, 900, 270, 90),
(4, 'big', 1140, 480, 1800, 480, 95);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przekierowania`
--

CREATE TABLE IF NOT EXISTS `przekierowania` (
  `id_przekierowanie` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(255) DEFAULT NULL,
  `adres_stary` varchar(255) DEFAULT NULL,
  `adres_nowy` varchar(255) DEFAULT NULL,
  `typ` int(1) unsigned NOT NULL DEFAULT '0',
  `sort` int(5) unsigned NOT NULL DEFAULT '0',
  `rodzaj` varchar(5) NOT NULL DEFAULT '301',
  `id_rodzic` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_przekierowanie`),
  KEY `przekierowania_id_rodzic_FK` (`id_rodzic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Zrzut danych tabeli `przekierowania`
--

INSERT INTO `przekierowania` (`id_przekierowanie`, `nazwa`, `adres_stary`, `adres_nowy`, `typ`, `sort`, `rodzaj`, `id_rodzic`) VALUES
(1, NULL, '/atmosfera-zajecia/atmosfera-grafik-zajec', '/grafik', 0, 1, '301', NULL),
(2, NULL, '/atmosfera-zajecia/opis-zaj-grupowych', '/zajecia/opis-zajec-grupowych', 0, 2, '301', NULL),
(3, NULL, '/atmosfera-partnerzy-klubu', '/przyjaciele-atmosfery', 0, 3, '301', NULL),
(4, NULL, '/atmosfera-wellness/masazysci', '/wellness/gabinet-masazu', 0, 4, '301', NULL),
(5, NULL, '/atmosfera-wellness/sauna-i-strefa-relaksu', '/wellness/sauna-i-strefa-relaksu', 0, 5, '301', NULL),
(6, NULL, '/atmosfera-galeria-zdjec', '/galeria', 0, 6, '301', NULL),
(9, NULL, '/o-nas/manager-klubu', '/poznaj-nas/manager-klubu', 0, 9, '301', NULL),
(10, NULL, '/dietetyka/analiza-skadu-ciaa', '/silownia/analiza-skladu-ciala', 0, 10, '301', NULL),
(11, NULL, '/o-nas/instruktorzy', '/poznaj-nas/instruktorzy', 0, 11, '301', NULL),
(12, NULL, '/o-nas/recepcja', '/poznaj-nas/recepcja', 0, 12, '301', NULL),
(13, NULL, '/atmosfera-news-nowosci/1-nowiny/642-trx-core-idealne-zajcia-dla-twojego-brzucha', '/aktualnosci/trx-core-plaski-brzuch-do-lata', 0, 13, '301', NULL),
(14, NULL, '/atmosfera-news-nowosci/1-nowiny/602-zapro-znajomego-i-odbierz-nagrod', '/aktualnosci/zapros-znajomego-i-odbierz-nagrode', 0, 14, '301', NULL),
(15, NULL, '/atmosfera-news-nowosci', '/aktualnosci', 0, 15, '301', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `time_ranges`
--

CREATE TABLE IF NOT EXISTS `time_ranges` (
  `id_time_range` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `time_range_from` time DEFAULT NULL,
  `time_range_to` time DEFAULT NULL,
  PRIMARY KEY (`id_time_range`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `time_ranges`
--

INSERT INTO `time_ranges` (`id_time_range`, `time_range_from`, `time_range_to`) VALUES
(2, '07:00:00', '11:00:00'),
(3, '16:00:00', '22:10:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trainings_rooms`
--

CREATE TABLE IF NOT EXISTS `trainings_rooms` (
  `id_room` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name_room` varchar(255) DEFAULT NULL,
  `sort` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `trainings_rooms`
--

INSERT INTO `trainings_rooms` (`id_room`, `name_room`, `sort`) VALUES
(1, 'Sala A', 7),
(2, 'Sala B', 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trainings_types`
--

CREATE TABLE IF NOT EXISTS `trainings_types` (
  `id_type` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name_type` varchar(255) DEFAULT NULL,
  `color_type` varchar(255) DEFAULT NULL,
  `sort` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `trainings_types`
--

INSERT INTO `trainings_types` (`id_type`, `name_type`, `color_type`, `sort`) VALUES
(1, 'zajęcia mentalne, wzmacniająco-relaksujące', '404040', 4),
(2, 'zajęcia mieszane, spalające tkankę tłuszczową oraz modelujące sylwetkę', 'b3b3b3', 5),
(3, 'zajęcia wydolnościowe, spalające tkankę tłuszczową', 'a62960', 6),
(6, 'zajęcia wzmacniające, kształtujące i modelujące sylwetkę', 'C0CD2B', 3),
(8, 'gry i zabawy ruchowe dla najmłodszych', 'aacca5', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ustawienia_strony`
--

CREATE TABLE IF NOT EXISTS `ustawienia_strony` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `tresc_na_poczatku_head` text,
  `tresc_na_koncu_head` text,
  `tresc_na_poczatku_body` text,
  `tresc_na_koncu_body` text,
  `form_nadawca_email` varchar(255) DEFAULT NULL,
  `form_nadawca_nazwa` varchar(255) DEFAULT NULL,
  `form_smtp` varchar(255) DEFAULT NULL,
  `form_smtp_secure` varchar(10) DEFAULT NULL,
  `form_login` varchar(255) DEFAULT NULL,
  `form_haslo` varchar(100) DEFAULT NULL,
  `form_adresat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `ustawienia_strony`
--

INSERT INTO `ustawienia_strony` (`id`, `tresc_na_poczatku_head`, `tresc_na_koncu_head`, `tresc_na_poczatku_body`, `tresc_na_koncu_body`, `form_nadawca_email`, `form_nadawca_nazwa`, `form_smtp`, `form_smtp_secure`, `form_login`, `form_haslo`, `form_adresat`) VALUES
(1, NULL, NULL, NULL, NULL, 'klub@atmosfera-fitness.pl', 'atmosfera fitness & wellness', 'mail.atmosfera-fitness.pl:587', 'tsl', 'klub@atmosfera-fitness.pl', '@sfera', 'klub@atmosfera-fitness.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `haslo` varchar(128) DEFAULT NULL,
  `imie_nazwisko` varchar(100) DEFAULT NULL,
  `prawa` tinyint(1) unsigned DEFAULT NULL,
  `id_ostatni_folder` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `imie_nazwisko`, `prawa`, `id_ostatni_folder`) VALUES
(1, 'admin@ewitryna.pl', 'a4e8b1fa87082db933cb9896dfb3cc39187209bf5f73db95be9db6b672ed62ddaa613ba983aaa53734c6ba1393d66d9bf2faefe41d56b3e155e415eca953c584', 'Admin', 3, 1),
(2, 'm.orynska@atmosfera-fitness.pl', '85ecefd0db09b575e38150ebe9a4fe4dd50dea7c99d35386fb559c70866190235376f7c93bbcb3ecbfeb8219d9e6f11999271a36d9b11f10e74d81b96379e619', 'Małgorzata Oryńska', 1, 0),
(3, 'm.budkowska@atmosfera-fitness.pl', 'eed36afd7325fd7902015f9fda173319693892da5e8fe5e341698c278942c3e143a48742f4731bf72792d859db132076a8dcb9e887d5308f0122e7f6b5c10471', 'Maria Budkowska', 1, 0),
(4, 'w.chodorek@atmosfera-fitness.pl', '13b92bc7a46b3b20ead6ef635798f9fc5f34b359752c24ebe63b5fb9cced745241ed78726722252e85abafa3598863218a3924932b39d6403aeda28820e1ef0c', 'Weronika Chodorek', 1, 0);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `aktualnosci_folder`
--
ALTER TABLE `aktualnosci_folder`
  ADD CONSTRAINT `aktualnosci_folder_id_rodzic_FK` FOREIGN KEY (`id_rodzic`) REFERENCES `aktualnosci_folder` (`id_folder`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `aktualnosci_folder_nazwa`
--
ALTER TABLE `aktualnosci_folder_nazwa`
  ADD CONSTRAINT `aktualnosci_folder_nazwa_id_folder_FK` FOREIGN KEY (`id_folder`) REFERENCES `aktualnosci_folder` (`id_folder`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aktualnosci_folder_nazwa_id_lang_FK` FOREIGN KEY (`id_lang`) REFERENCES `jezyki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `aktualnosci_nazwa`
--
ALTER TABLE `aktualnosci_nazwa`
  ADD CONSTRAINT `aktualnosci_id_instructor_FK` FOREIGN KEY (`id_instructor`) REFERENCES `aktualnosci_trzon` (`id_trzon`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `aktualnosci_id_room_FK` FOREIGN KEY (`id_room`) REFERENCES `trainings_rooms` (`id_room`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `aktualnosci_id_type_FK` FOREIGN KEY (`id_type`) REFERENCES `trainings_types` (`id_type`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `aktualnosci_nazwa_id_lang_FK` FOREIGN KEY (`id_lang`) REFERENCES `jezyki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aktualnosci_nazwa_id_trzon_FK` FOREIGN KEY (`id_trzon`) REFERENCES `aktualnosci_trzon` (`id_trzon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `aktualnosci_tresc`
--
ALTER TABLE `aktualnosci_tresc`
  ADD CONSTRAINT `aktualnosci_tresc_id_art_nazwa_FK` FOREIGN KEY (`id_art_nazwa`) REFERENCES `aktualnosci_nazwa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aktualnosci_tresc_id_lang_FK` FOREIGN KEY (`id_lang`) REFERENCES `jezyki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aktualnosci_tresc_id_rodzic_blok_FK` FOREIGN KEY (`id_rodzic_blok`) REFERENCES `aktualnosci_tresc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `aktualnosci_trzon`
--
ALTER TABLE `aktualnosci_trzon`
  ADD CONSTRAINT `aktualnosci_trzon_id_folder_FK` FOREIGN KEY (`id_folder`) REFERENCES `aktualnosci_folder` (`id_folder`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `artykuly_nazwa`
--
ALTER TABLE `artykuly_nazwa`
  ADD CONSTRAINT `artykuly_nazwa_id_lang_FK` FOREIGN KEY (`id_lang`) REFERENCES `jezyki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artykuly_nazwa_id_trzon_FK` FOREIGN KEY (`id_trzon`) REFERENCES `artykuly_trzon` (`id_trzon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `artykuly_tresc`
--
ALTER TABLE `artykuly_tresc`
  ADD CONSTRAINT `artykuly_tresc_id_art_nazwa_FK` FOREIGN KEY (`id_art_nazwa`) REFERENCES `artykuly_nazwa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artykuly_tresc_id_lang_FK` FOREIGN KEY (`id_lang`) REFERENCES `jezyki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artykuly_tresc_id_rodzic_blok_FK` FOREIGN KEY (`id_rodzic_blok`) REFERENCES `artykuly_tresc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `artykuly_trzon`
--
ALTER TABLE `artykuly_trzon`
  ADD CONSTRAINT `artykuly_trzon_id_rodzic_FK` FOREIGN KEY (`id_rodzic`) REFERENCES `artykuly_trzon` (`id_trzon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `banery_nazwa`
--
ALTER TABLE `banery_nazwa`
  ADD CONSTRAINT `banery_nazwa_id_lang_FK` FOREIGN KEY (`id_lang`) REFERENCES `jezyki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `banery_nazwa_id_trzon_FK` FOREIGN KEY (`id_trzon`) REFERENCES `banery_trzon` (`id_trzon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `banery_trzon`
--
ALTER TABLE `banery_trzon`
  ADD CONSTRAINT `banery_trzon_id_rodzic_FK` FOREIGN KEY (`id_rodzic`) REFERENCES `banery_trzon` (`id_trzon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `metatagi`
--
ALTER TABLE `metatagi`
  ADD CONSTRAINT `metatagi_id_lang_FK` FOREIGN KEY (`id_lang`) REFERENCES `jezyki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `newsletter_members`
--
ALTER TABLE `newsletter_members`
  ADD CONSTRAINT `newsletter_members_id_lang_FK` FOREIGN KEY (`id_lang`) REFERENCES `jezyki` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `newsletter_members_id_user_FK` FOREIGN KEY (`id_user`) REFERENCES `uzytkownicy` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ograniczenia dla tabeli `newsletter_messages_lang`
--
ALTER TABLE `newsletter_messages_lang`
  ADD CONSTRAINT `newsletter_messages_lang_id_lang_FK` FOREIGN KEY (`id_lang`) REFERENCES `jezyki` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `newsletter_messages_lang_id_message_FK` FOREIGN KEY (`id_message`) REFERENCES `newsletter_messages` (`id_message`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ograniczenia dla tabeli `newsletter_shipping`
--
ALTER TABLE `newsletter_shipping`
  ADD CONSTRAINT `newsletter_shipping_id_member_FK` FOREIGN KEY (`id_member`) REFERENCES `newsletter_members` (`id_member`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `newsletter_shipping_id_message_FK` FOREIGN KEY (`id_message`) REFERENCES `newsletter_messages` (`id_message`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `pliki`
--
ALTER TABLE `pliki`
  ADD CONSTRAINT `pliki_id_rodzic_FK` FOREIGN KEY (`id_rodzic`) REFERENCES `pliki` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `przekierowania`
--
ALTER TABLE `przekierowania`
  ADD CONSTRAINT `przekierowania_id_rodzic_FK` FOREIGN KEY (`id_rodzic`) REFERENCES `przekierowania` (`id_przekierowanie`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
