-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Nov 2019 um 19:33
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cooking_symfony`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, ''),
(2, 'Vegan'),
(3, 'Bakery');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `picture_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `visible` int(11) NOT NULL,
  `description2` longtext COLLATE utf8mb4_unicode_ci,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `food`
--

INSERT INTO `food` (`id`, `name`, `description`, `picture_name`, `creation_date`, `visible`, `description2`, `duration`, `category`) VALUES
(1, 'Rosmarin gebratene Kartoffeln', '<p>Den Spaghettik&uuml;rbis waschen, rundherum mit einer Gabel einstechen und ihn f&uuml;r eine Stunde bei ca. 160&deg;C im Backofen garen.<br /><br />Nach dem Abk&uuml;hlen die Kerne entfernen und mit einer Gabel das K&uuml;rbisfleisch, das sich nun in Streifen abl&ouml;sen l&auml;sst, herausnehmen. Zu dem K&uuml;rbisfleisch ein bis zwei geriebene Kartoffeln, die gew&uuml;rfelte Zwiebel, sowie die restlichen Zutaten wie zu einem \"normalen\" Puffer vermengen. Die Konsistenz entspricht der von Kartoffelpuffern. Gut w&uuml;rzen.<br /><br />Anschlie&szlig;end im hei&szlig;en Fett braten.</p>', '1/food_1.jpeg', '2019-10-31 03:22:08', 1, 'Beispiel Beschreibung', '00:15:00', 2),
(2, 'Nigiri Sushi', 'Beispiel Beschreibung', '2/food_2.jpeg', '2019-10-31 03:22:09', 1, 'Beispiel Beschreibung', '00:15:00', 1),
(3, 'Käse Pizza', 'Beispiel Beschreibung', '3/food_3.jpeg', '2019-10-31 03:22:09', 1, 'Beispiel Beschreibung', '00:15:00', 1),
(4, 'Eier Salat', 'Beispiel Beschreibung', '4/food_4.jpeg', '2019-10-31 03:22:09', 1, 'Beispiel Beschreibung', '00:16:00', 2),
(5, 'Gurken Salat', 'Beispiel Beschreibung', '5/food_5.jpeg', '2019-10-31 03:22:09', 1, 'Beispiel Beschreibung', '00:15:00', 2),
(6, 'Vollkornkuchen mit Kirschen und Kokos', 'Beispiel Beschreibung', '6/food_6.jpeg', '2019-10-31 03:22:09', 1, 'Beispiel Beschreibung', '00:15:00', 3),
(7, 'Kirschschwammkuchen', 'Beispiel Beschreibung', '7/food_7.jpeg', '2019-10-31 03:22:09', 1, 'Beispiel Beschreibung', '01:15:26', 3),
(8, 'Karottenkuchen', 'Beispiel Beschreibung', '8/food_8.jpeg', '2019-10-31 03:22:09', 1, 'Beispiel Beschreibung', NULL, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191029191358', '2019-10-29 19:14:06'),
('20191029213659', '2019-10-29 21:37:05'),
('20191030175404', '2019-10-30 17:57:31'),
('20191031005843', '2019-10-31 00:58:50'),
('20191031010327', '2019-10-31 01:03:41'),
('20191031022149', '2019-10-31 02:21:58');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(5, 'test@test.de', '$argon2i$v=19$m=65536,t=4,p=1$cHNWR0dWYmlEcUplZFRtdQ$U8tXqh7miE4NjHOMT0lH4jfck8cHApeofqOrLCgHqzc');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
