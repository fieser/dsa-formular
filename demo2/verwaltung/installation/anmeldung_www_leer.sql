-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 19. Dez 2023 um 10:43
-- Server-Version: 10.2.44-MariaDB
-- PHP-Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `anmeldung_www_leer`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dsa_bewerberdaten`
--

CREATE TABLE IF NOT EXISTS `dsa_bewerberdaten` (
  `id` int(11) NOT NULL,
  `md5` varchar(200) COLLATE utf8_bin NOT NULL,
  `code` int(50) NOT NULL,
  `status` varchar(200) COLLATE utf8_bin NOT NULL,
  `nachname` varchar(200) COLLATE utf8_bin NOT NULL,
  `vorname` varchar(200) COLLATE utf8_bin NOT NULL,
  `geschlecht` varchar(100) COLLATE utf8_bin NOT NULL,
  `geburtsdatum` varchar(100) COLLATE utf8_bin NOT NULL,
  `geburtsort` varchar(200) COLLATE utf8_bin NOT NULL,
  `geburtsland` varchar(200) COLLATE utf8_bin NOT NULL,
  `zuzug` varchar(100) COLLATE utf8_bin NOT NULL,
  `staatsangehoerigkeit` varchar(200) COLLATE utf8_bin NOT NULL,
  `muttersprache` varchar(200) COLLATE utf8_bin NOT NULL,
  `religion` varchar(100) COLLATE utf8_bin NOT NULL,
  `herkuftsland` varchar(200) COLLATE utf8_bin NOT NULL,
  `strasse` varchar(200) COLLATE utf8_bin NOT NULL,
  `plz` varchar(100) COLLATE utf8_bin NOT NULL,
  `wohnort` varchar(200) COLLATE utf8_bin NOT NULL,
  `hausnummer` varchar(200) COLLATE utf8_bin NOT NULL,
  `telefon1` varchar(200) COLLATE utf8_bin NOT NULL,
  `telefon2` varchar(200) COLLATE utf8_bin NOT NULL,
  `mail` varchar(200) COLLATE utf8_bin NOT NULL,
  `schulart` varchar(200) COLLATE utf8_bin NOT NULL,
  `schulname` varchar(200) COLLATE utf8_bin NOT NULL,
  `jahrgang` varchar(200) COLLATE utf8_bin NOT NULL,
  `abschluss` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_nachname` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_vorname` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_anrede` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_art` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_strasse` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_hausnummer` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_plz` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_wohnort` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_telefon1` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_telefon2` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge1_mail` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_vorname` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_nachname` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_anrede` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_art` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_strasse` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_hausnummer` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_plz` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_wohnort` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_telefon1` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_telefon2` varchar(200) COLLATE utf8_bin NOT NULL,
  `sorge2_mail` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dsa_bildungsgang`
--

CREATE TABLE IF NOT EXISTS `dsa_bildungsgang` (
  `id` int(11) NOT NULL,
  `md5` varchar(200) COLLATE utf8_bin NOT NULL,
  `prio` varchar(11) COLLATE utf8_bin NOT NULL,
  `id_dsa_bewerberdaten` int(11) NOT NULL,
  `time` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `schulform` varchar(200) COLLATE utf8_bin NOT NULL,
  `beruf` varchar(200) COLLATE utf8_bin NOT NULL,
  `beruf_anz` varchar(500) COLLATE utf8_bin NOT NULL,
  `dauer` varchar(200) COLLATE utf8_bin NOT NULL,
  `beginn` varchar(200) COLLATE utf8_bin NOT NULL,
  `ende` varchar(200) COLLATE utf8_bin NOT NULL,
  `beruf2` varchar(200) COLLATE utf8_bin NOT NULL,
  `betrieb` varchar(200) COLLATE utf8_bin NOT NULL,
  `betrieb2` varchar(200) COLLATE utf8_bin NOT NULL,
  `betrieb_plz` varchar(200) COLLATE utf8_bin NOT NULL,
  `betrieb_ort` varchar(200) COLLATE utf8_bin NOT NULL,
  `betrieb_strasse` varchar(200) COLLATE utf8_bin NOT NULL,
  `betrieb_hausnummer` varchar(200) COLLATE utf8_bin NOT NULL,
  `betrieb_telefon` varchar(200) COLLATE utf8_bin NOT NULL,
  `betrieb_mail` varchar(200) COLLATE utf8_bin NOT NULL,
  `ausbilder_nachname` varchar(200) COLLATE utf8_bin NOT NULL,
  `ausbilder_vorname` varchar(200) COLLATE utf8_bin NOT NULL,
  `ausbilder_telefon` varchar(200) COLLATE utf8_bin NOT NULL,
  `ausbilder_telefon2` varchar(200) COLLATE utf8_bin NOT NULL,
  `ausbilder_mail` varchar(200) COLLATE utf8_bin NOT NULL,
  `bgy_sp1` varchar(200) COLLATE utf8_bin NOT NULL,
  `bgy_sp2` varchar(200) COLLATE utf8_bin NOT NULL,
  `bgy_sp3` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs1` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs1_von` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs1_bis` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs2` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs2_von` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs2_bis` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs3` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs3_von` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs3_bis` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `edoo_bewerber`
--

CREATE TABLE IF NOT EXISTS `edoo_bewerber` (
  `id` int(11) NOT NULL,
  `nachname` varchar(200) COLLATE utf8_bin NOT NULL,
  `vorname` varchar(200) COLLATE utf8_bin NOT NULL,
  `geburtsdatum` varchar(200) COLLATE utf8_bin NOT NULL,
  `geburtsort` varchar(200) COLLATE utf8_bin NOT NULL,
  `geburtsland` varchar(50) COLLATE utf8_bin NOT NULL,
  `staatsangehoerigkeit` varchar(50) COLLATE utf8_bin NOT NULL,
  `herkunftsland` varchar(200) COLLATE utf8_bin NOT NULL,
  `zuzugsdatum` varchar(200) COLLATE utf8_bin NOT NULL,
  `geschlecht` varchar(200) COLLATE utf8_bin NOT NULL,
  `religionszugehoerigkeit` varchar(200) COLLATE utf8_bin NOT NULL,
  `strasse` varchar(200) COLLATE utf8_bin NOT NULL,
  `hausnummer` varchar(50) COLLATE utf8_bin NOT NULL,
  `plz` varchar(50) COLLATE utf8_bin NOT NULL,
  `wohnort` varchar(200) COLLATE utf8_bin NOT NULL,
  `mail` varchar(200) COLLATE utf8_bin NOT NULL,
  `telefon1` varchar(200) COLLATE utf8_bin NOT NULL,
  `telefon2` varchar(200) COLLATE utf8_bin NOT NULL,
  `abschluss` varchar(200) COLLATE utf8_bin NOT NULL,
  `bildungsgang` varchar(200) COLLATE utf8_bin NOT NULL,
  `entscheidung` varchar(200) COLLATE utf8_bin NOT NULL,
  `create_date` varchar(200) COLLATE utf8_bin NOT NULL,
  `create_user` varchar(200) COLLATE utf8_bin NOT NULL,
  `update_date` varchar(200) COLLATE utf8_bin NOT NULL,
  `update_user` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `edoo_bewerbungsziel`
--

CREATE TABLE IF NOT EXISTS `edoo_bewerbungsziel` (
  `id` int(11) NOT NULL,
  `id_edoo` varchar(200) COLLATE utf8_bin NOT NULL,
  `kurzform` varchar(200) COLLATE utf8_bin NOT NULL,
  `anzeigeform` varchar(200) COLLATE utf8_bin NOT NULL,
  `id_bildungsgang` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `edoo_bewerbungsziel`
--

INSERT INTO `edoo_bewerbungsziel` (`id`, `id_edoo`, `kurzform`, `anzeigeform`, `id_bildungsgang`) VALUES
(1, '2c969497/85810650/0185/81c0b2a7/0061', '2023/24_BF2T_1', 'BF II Technik (2023/24)', '1058_8207000T\n'),
(2, '2c969497/85810650/0185/81c19f1e/0062', '2023/24_DBOS_11', 'Duale Berufsoberschule (2023/24)', '1058_8800000\n'),
(3, '2c969497/85810650/0185/81c3b4da/0067', '2023/24_BVJ_1', 'BVJ (2023/24)', '1058_8101050.1360\n'),
(4, '2c969497/85810650/0185/81c3fe0f/0068', '2023/24_BVJS_1', 'BVJ Sprachförderung (2023/24)', '1058_8101060\n'),
(5, '2c969497/85810650/0185/81bdce3f/0058', '2023/24_BGYTM_11', 'Metalltechnik', '1058_8502040\n'),
(6, 'abgelehnte_bewerber_60675_BBS', 'Abgelehnte Bewerber', 'Abgelehnte Bewerber', '\n'),
(7, '2c969497/8b1ee258/018b/33ac1513/0b3f', '2023/24_BGYTBI', 'Biologietechnik', '1058_8502070\n'),
(8, '2c969497/85810650/0185/81bceba6/0056', '2023/24_BGYTB_11', 'Bautechnik', '1058_8502010\n'),
(9, '2c969497/85810650/0185/81bdac77/0057', '2023/24_BGYTE_11', 'Elektrotechnik', '1058_8502020\n'),
(10, '2c969497/85810650/0185/81bdeab7/0059', '2023/24_BGYTG_11', 'Gestaltungs- und Medientechnik', '1058_8502030\n'),
(11, '2c969497/85810650/0185/81be2780/005a', '2023/24_HBFME_1', 'Mediendesign', '1058_8204980\n'),
(12, '2c969497/85810650/0185/81be3d5e/005b', '2023/24_HBFIT_1', 'Informationstechnik', '1058_8204910\n'),
(13, '2c969497/85810650/0185/81be5dd7/005c', '2023/24_HBFGA_1', 'Gastronomie', '1058_8204990\n'),
(14, '2c969497/85810650/0185/81be87af/005d', '2023/24_BF1GT_E', 'Elektrotechnik', '1058_8206030\n'),
(15, '2c969497/85810650/0185/81bf5de5/005e', '2023/24_BF1GT_M', 'Metalltechnik', '1058_8206030\n'),
(16, '2c969497/85810650/0185/81bf9be0/005f', '2023/24_BF1GT_NA', 'Nahrung', '1058_8206030\n'),
(17, '2c969497/85810650/0185/81bfd9a6/0060', '2023/24_BF1GT_MD', 'Mediendesign', '1058_8206030\n'),
(18, '2c969497/85810650/0185/81c1fff7/0063', '2023/24_BOS1G_12', 'Gestaltung', '1058_8701040\n'),
(19, '2c969497/85810650/0185/81c2aca6/0064', '2023/24_BOS1TI_12', 'Technik Sp Ingenieurwesen', '1058_8701012\n'),
(20, '2c969497/85810650/0185/81c30170/0065', '2023/24_FSTAPD_1', 'Produktionsautomatisierung', '1058_8606011\n'),
(21, '2c969497/85810650/0185/81c383cf/0066', '2023/24_FSTAPZ_1', 'Prozessautomatisierung', '1058_8606012\n'),
(22, '2c969497/85f8ee07/0186/0c422c46/1732', '2023/24_BGYTU_11', 'Umwelttechnik', '1058_8502050\n'),
(23, '', '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `edoo_fremdsprachen`
--

CREATE TABLE IF NOT EXISTS `edoo_fremdsprachen` (
  `id` int(11) NOT NULL,
  `nachname` varchar(200) COLLATE utf8_bin NOT NULL,
  `vorname` varchar(200) COLLATE utf8_bin NOT NULL,
  `geburtsdatum` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs_von` varchar(200) COLLATE utf8_bin NOT NULL,
  `fs_bis` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `edoo_schueler`
--

CREATE TABLE IF NOT EXISTS `edoo_schueler` (
  `id` int(11) NOT NULL,
  `nachname` varchar(200) COLLATE utf8_bin NOT NULL,
  `vorname` varchar(200) COLLATE utf8_bin NOT NULL,
  `geburtsdatum` varchar(200) COLLATE utf8_bin NOT NULL,
  `strasse` varchar(200) COLLATE utf8_bin NOT NULL,
  `hausnummer` varchar(50) COLLATE utf8_bin NOT NULL,
  `plz` varchar(50) COLLATE utf8_bin NOT NULL,
  `wohnort` varchar(200) COLLATE utf8_bin NOT NULL,
  `mail` varchar(200) COLLATE utf8_bin NOT NULL,
  `bildungsgang` varchar(200) COLLATE utf8_bin NOT NULL,
  `create_date` varchar(200) COLLATE utf8_bin NOT NULL,
  `create_user` varchar(200) COLLATE utf8_bin NOT NULL,
  `update_date` varchar(200) COLLATE utf8_bin NOT NULL,
  `update_user` varchar(200) COLLATE utf8_bin NOT NULL,
  `austritt` varchar(100) COLLATE utf8_bin NOT NULL,
  `eintritt` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `edoo_schueler_betrieb`
--

CREATE TABLE IF NOT EXISTS `edoo_schueler_betrieb` (
  `id` int(11) NOT NULL,
  `id_schueler` varchar(200) COLLATE utf8_bin NOT NULL,
  `id_betrieb` varchar(200) COLLATE utf8_bin NOT NULL,
  `nachname` varchar(200) COLLATE utf8_bin NOT NULL,
  `vorname` varchar(200) COLLATE utf8_bin NOT NULL,
  `geburtsdatum` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fehler`
--

CREATE TABLE IF NOT EXISTS `fehler` (
  `id` int(11) NOT NULL,
  `id_edoo` varchar(11) COLLATE utf8_bin NOT NULL,
  `id_bewerberdaten` varchar(11) COLLATE utf8_bin NOT NULL,
  `id_bildungsgang` varchar(11) COLLATE utf8_bin NOT NULL,
  `feld_edoo` varchar(200) COLLATE utf8_bin NOT NULL,
  `feld_dsa` varchar(200) COLLATE utf8_bin NOT NULL,
  `feldname` varchar(200) COLLATE utf8_bin NOT NULL,
  `hinweis` varchar(500) COLLATE utf8_bin NOT NULL,
  `erledigt` varchar(11) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ignorieren`
--

CREATE TABLE IF NOT EXISTS `ignorieren` (
  `id` int(11) NOT NULL,
  `id_bewerber` int(11) NOT NULL,
  `wert_edoo` varchar(200) COLLATE utf8_bin NOT NULL,
  `wert_dsa` varchar(200) COLLATE utf8_bin NOT NULL,
  `okay_admin` varchar(11) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schulformen`
--

CREATE TABLE IF NOT EXISTS `schulformen` (
  `id` int(11) NOT NULL,
  `kuerzel` varchar(50) COLLATE utf8_bin NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `aktiv` varchar(11) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `schulformen`
--

INSERT INTO `schulformen` (`id`, `kuerzel`, `name`, `aktiv`) VALUES
(1, 'bs', 'Berufsschule', ''),
(2, 'bgy', 'Berufliches Gymnasium (BGY)', ''),
(3, 'bvj', 'Berufsvorbereitungsjahr (BVJ)', ''),
(4, 'bf1', 'Berufsfachschule 1 (BF 1)', ''),
(5, 'bf2', 'Berufsfachschule 2 (BF 2)', ''),
(6, 'hbf', 'Höhere Berufsfachschule (HBF)', ''),
(7, 'bos1', 'Berufsoberschule 1 (BOS 1)', ''),
(8, 'bos2', 'Berufsoberschule 2 (BOS 2)', ''),
(9, 'dbos', 'Duale Berufsoberschule (DBOS)', ''),
(10, 'fs', 'Fachschule (FS)', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `senden_texte`
--

CREATE TABLE IF NOT EXISTS `senden_texte` (
  `id` int(11) NOT NULL,
  `schulform` varchar(200) COLLATE utf8_bin NOT NULL,
  `bezeichnung` varchar(200) COLLATE utf8_bin NOT NULL,
  `feldname` varchar(200) COLLATE utf8_bin NOT NULL,
  `text` longtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `senden_texte`
--

INSERT INTO `senden_texte` (`id`, `schulform`, `bezeichnung`, `feldname`, `text`) VALUES
(1, 'bs', 'Berufsschule', 'text_bs', '<p>Bitte legen Sie an Ihrem ersten Schultag der Klassenlehrerin bzw. dem Klassenlehrer eine <b>Kopie Ihres Ausbildungsvertrages</b> vor.</p>\r\n	<p>Den <b>Tag der Einschulung</b> und die Unterrichtstage im Schuljahr sind abhängig vom Ausbildungsberuf und entnehmen Sie bitte den i.d.R. ab den Osterferien auf unserer Website veröffentlichten Block- und Teilzeitplänen (www.bbs1-mainz.com/stundenplaene/block-und-teilzeitplaene/).</p> Bitte beachten Sie, dass sich die die Block- und Teilzeitpläne bis zu Beginn des Schuljahres eventuell noch ändern können.</p>\r\n	<p>Am Einschulungstag - i.d.R. der 26.08.2024 - informieren wir Sie ab 7:30 Uhr im Eingangsbereich unserer Schule über den Weg in Ihren Klassenraum.<br>\r\n	Die <b>Einschulung beginnt um 8:00 Uhr</b>. </p>\r\n<p>Sollten Sie Ihre Ausbildung bereits im laufenden Schuljahr beginnen oder an unsere Schule wechseln, dann erscheinen Sie bitte am - gemäß dem entsprechenden Block- oder Teilzeitplan - nächsten Unterrichtstag.</p>\r\n'),
(2, 'bvj', 'Berufsvorbereitungsjahr (BVJ)', 'text_bvj', 'Gewerbe und Technik\r\n		<p>Ihre Anmeldung ist eingegangen und wird bearbeitet nachdem wir folgende Unterlagen <b>im Original oder als beglaubigte Kopie</b> von Ihnen erhalten haben.</p>\r\n		<p>Senden Sie uns die Unterlagen an unsere Postanschrift oder geben Sie sie während der Öffnungszeiten in unserem Sekretariat ab.</p>\r\n\r\n		<li>Kopie Personalausweis (Vorder- und Rückseite) oder Meldebescheinigung</li>\r\n		<li>Lebenslauf</li>\r\n		<li><b>beglaubigte Kopie</b> letztes Halbjahreszeugnis</li>\r\n		<p>Das Abgang- bzw. Abschlusszeugnis ist bis zum 1. August nachzureichen, ebenfalls in <b>beglaubigter Form.</b></p>\r\n				\r\n		<p>Die Einschulung zum Schuljahr 2024/2025 erfolgt am <b>Montag, 26.08.2024 um 8:00 Uhr</b>. Im Eingangsbereich unserer Schule informieren wir Sie ab 7:30 Uhr über den Weg in Ihren Klassenraum.</p>\r\n'),
(3, 'bf1', 'Berufsfachschule 1 (BF1)', 'text_bf1', 'Gewerbe und Technik\r\n		<p>Ihre Anmeldung ist eingegangen und wird bearbeitet nachdem wir folgende Unterlagen <b>im Original oder als beglaubigte Kopie</b> von Ihnen erhalten haben.</p>\r\n		<p>Senden Sie uns die Unterlagen an unsere Postanschrift oder geben Sie sie während der Öffnungszeiten in unserem Sekretariat ab.</p>\r\n\r\n		<li>Kopie Personalausweis (Vorder- und Rückseite) oder Meldebescheinigung</li>\r\n		<li>Lebenslauf</li>\r\n		<li><b>beglaubigte Kopie</b> letztes Halbjahreszeugnis</li>\r\n		<p>Das Abgang- bzw. Abschlusszeugnis ist bis zum 1. August nachzureichen, ebenfalls in <b>beglaubigter Form.</b></p>\r\n				\r\n		<p>Die Einschulung zum Schuljahr 2024/2025 erfolgt am <b>Montag, 26.08.2024 um 8:00 Uhr</b>. Im Eingangsbereich unserer Schule informieren wir Sie ab 7:30 Uhr über den Weg in Ihren Klassenraum.</p>\r\n'),
(4, 'bf2', 'Berufsfachschule 2 (BF2)', 'text_bf2', 'Gewerbe und Technik\r\n		<p>Ihre Anmeldung ist eingegangen und wird bearbeitet nachdem wir folgende Unterlagen <b>im Original oder als beglaubigte Kopie</b> von Ihnen erhalten haben.</p>\r\n		<p>Senden Sie uns die Unterlagen an unsere Postanschrift oder geben Sie sie während der Öffnungszeiten in unserem Sekretariat ab.</p>\r\n\r\n		<li>Kopie Personalausweis (Vorder- und Rückseite) oder Meldebescheinigung</li>\r\n		<li>Lebenslauf</li>\r\n		<li><b>beglaubigte Kopie</b> letztes Halbjahreszeugnis</li>\r\n		<p>Das Abgang- bzw. Abschlusszeugnis ist bis zum 1. August nachzureichen, ebenfalls in <b>beglaubigter Form.</b></p>\r\n				\r\n		<p>Die Einschulung zum Schuljahr 2024/2025 erfolgt am <b>Montag, 26.08.2024 um 8:00 Uhr</b>. Im Eingangsbereich unserer Schule informieren wir Sie ab 7:30 Uhr über den Weg in Ihren Klassenraum.</p>\r\n'),
(5, 'bos2', 'Berufsoberschule 2 (BOS2)', 'text_bos2', ''),
(6, 'bos1', 'Berufsoberschule 1 (BOS1)', 'text_bos1', '<p>Ihre Anmeldung ist eingegangen und wird bearbeitet nachdem wir folgende Unterlagen <b>im Original oder als beglaubigte Kopie</b> von Ihnen erhalten haben.</p>\r\n	<p>Senden Sie uns die Unterlagen an unsere Postanschrift oder geben Sie sie während der Öffnungszeiten in unserem Sekretariat ab.</p>\r\n\r\n	<li>Personalausweis</li>\r\n	<li>Lebenslauf</li>\r\n	<li>Qual. Sek. I Abschluss</li>\r\n	<li>letztes Jahreszeugnis der Berufsschule</li> \r\n	<p>Das Abschlusszeugnis der Berufsschule sowie das Prüfungszeugnis des Ausbildungsberufes ist bis zum 1. August nachzureichen.</p>\r\n	<p>Die Einschulung zum Schuljahr 2024/2025 erfolgt am <b>Montag, 26.08.2024 um 8:00 Uhr</b>. Im Eingangsbereich unserer Schule informieren wir Sie ab 7:30 Uhr über den Weg in Ihren Klassenraum.</p>\r\n'),
(7, 'dbos', 'Duale Berufsoberschule (DBOS)', 'text_dbos', '<p>Ihre Anmeldung ist eingegangen und wird bearbeitet nachdem wir folgende Unterlagen <b>im Original oder als beglaubigte Kopie</b> von Ihnen erhalten haben.</p>\r\n	<p>Senden Sie uns die Unterlagen an unsere Postanschrift oder geben Sie sie während der Öffnungszeiten in unserem Sekretariat ab.</p>\r\n\r\n	<li>Personalausweis</li>\r\n	<li>Lebenslauf</li>\r\n	<li>Qual. Sek. I Abschluss</li>\r\n	<li>letztes Jahreszeugnis der Berufsschule</li>\r\n	<li>Ausbildungsvertrag, sofern die Ausbildung nicht bis zum 31. Juli beendet wird.</li> \r\n	<p>Das Abschlusszeugnis der Berufsschule sowie das Prüfungszeugnis des Ausbildungsberufes ist bis zum 1. August nachzureichen.</p>\r\n'),
(8, 'fs', 'Fachschule (FS)', 'text_fs', '<p>Ihre Anmeldung ist eingegangen und wird bearbeitet nachdem wir folgende Unterlagen <b>im Original oder als beglaubigte Kopie</b> von Ihnen erhalten haben.</p>\r\n	<p>Senden Sie uns die Unterlagen an unsere Postanschrift oder geben Sie sie während der Öffnungszeiten in unserem Sekretariat ab.</p>\r\n\r\n	<li>Personalausweis</li>\r\n	<li>Lebenslauf</li>\r\n	<li>Abschlusszeugnis der allgemeinbildenden Schule</li>\r\n	<li>Abslusszeugnis der Berufsschule</li>\r\n	<li>Prüfungszeugnis des Ausbildungsberufes</li>\r\n	<li>Nachweis über Berufspraxis</li>'),
(9, 'bgy', 'Berufliches Gymnasium (BGY)', 'text_bgy', '<p>Ihre Anmeldung ist eingegangen und wird bearbeitet nachdem wir folgende Unterlagen <b>im Original oder als beglaubigte Kopie</b> von Ihnen erhalten haben.</p>\r\n<p>Senden Sie uns die Unterlagen an unsere Postanschrift oder geben Sie sie während der Öffnungszeiten in unserem Sekretariat ab.</p>\r\n<p>Vielen Dank!</p>\r\n\r\n<li>Kopie Personalausweis (Vorder- und Rückseite).<br>Falls noch kein Personalausweis vorliegt, dann eine Kopie der Meldebescheinigung.</li>\r\n<li>Lebenslauf</li>\r\n<li>letztes Halbjahreszeugnis</li>\r\n<li>Jahres-/Abschlusszeugnis mit Qual. Sek. I (ist bis zum 1. August nachzureichen)</li>\r\n\r\n<p>Die Einschulung zum Schuljahr 2024/2025 erfolgt am <b>Montag, 26.08.2024 um 8:00 Uhr</b>. Im Eingangsbereich unserer Schule informieren wir Sie ab 7:30 Uhr über den Weg in Ihren Klassenraum.</p>\r\n\r\n\r\n<p><b>Zum aktuellen Zeitpunkt können wir nicht sicher bestätigen, dass wir den Schwerpunkte Metalltechnik und Elektrotechnik zum Schuljahr 2024/2025 noch anbieten können.</b><br>Diesbezüglich setzen wir uns noch mit Ihnen in Verbindung.</p>\r\n\r\n<p><b>Zum aktuellen Zeitpunkt können wir nicht sicher bestätigen, dass wir den Schwerpunkte Umwelttechnik und Biologietechnik zum Schuljahr 2024/2025 bereits anbieten können.</b><br>Diesbezüglich setzen wir uns noch mit Ihnen in Verbindung.</p>\r\n'),
(10, 'hbf', 'Höhere Berufsfachschule', 'text_hbf', '<p>Ihre Anmeldung ist eingegangen und wird bearbeitet nachdem wir folgende Unterlagen <b>im Original oder als beglaubigte Kopie</b> von Ihnen erhalten haben.</p>\r\n	<p>Senden Sie uns die Unterlagen an unsere Postanschrift oder geben Sie sie während der Öffnungszeiten in unserem Sekretariat ab.</p>\r\n\r\n	<li>Personalausweis</li>\r\n	<li>Lebenslauf</li>\r\n	<li>letztes Halbjahreszeugnis</li>\r\n	<li>Jahres-/Abschlusszeugnis mit Qual. Sek. I (ist bis zum 1. August nachzureichen)</li>\r\n	<p>Die Einschulung zum Schuljahr 2024/2025 erfolgt am <b>Montag, 26.08.2024 um 8:00 Uhr</b>. Im Eingangsbereich unserer Schule informieren wir Sie ab 7:30 Uhr über den Weg in Ihren Klassenraum.</p>\r\n\r\n');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `summen`
--

CREATE TABLE IF NOT EXISTS `summen` (
  `id` int(11) NOT NULL,
  `md5` varchar(200) COLLATE utf8_bin NOT NULL,
  `time` varchar(100) COLLATE utf8_bin NOT NULL,
  `schulform` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vorbildung`
--

CREATE TABLE IF NOT EXISTS `vorbildung` (
  `id` int(11) NOT NULL,
  `schluessel` varchar(200) COLLATE utf8_bin NOT NULL,
  `kurzform` varchar(200) COLLATE utf8_bin NOT NULL,
  `anzeigeform` varchar(500) COLLATE utf8_bin NOT NULL,
  `langform` varchar(500) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `vorbildung`
--

INSERT INTO `vorbildung` (`id`, `schluessel`, `kurzform`, `anzeigeform`, `langform`) VALUES
(1, 'schluessel', 'kurzform', 'anzeigeform', 'langform\n'),
(2, '1', 'OB', 'Abgangszeugnis ohne Berufsreife', 'Abgangszeugnis ohne Berufsreife\n'),
(3, '15', 'S1', 'Qualifizierter Sekundarabschluss I', 'Qualifizierter Sek. I (ehemals Realschulabschluss)'),
(4, '17', 'GH', 'Fachgebundene Hochschulreife', 'Fachgebundene Hochschulreife\n'),
(5, '18', 'HO', 'Allgemeine Hochschulreife', 'Allgemeine Hochschulreife\n'),
(6, '19', 'NV', 'nicht vergleichbarer Abschluss ausländisch. Schule', 'nicht vergleichbarer Abschluss einer ausländ. Schule\n'),
(7, '3', 'AO', 'Abgangszeugnis im FSP G', 'Abgang ohne Abschluss im Förderschwerpunkt ganzheitliche Entwicklung\n'),
(8, '4', 'FÖ', 'Abschl.zeugnis FSP L, ohne Berufsreife', 'Abschlusszeugnis FSP L, ohne Berufsreife\n'),
(9, '43', 'FHST', 'Fachhochschulreife (schulischer Teil)', 'Fachhochschulreife (schulischer Teil)\n'),
(10, '44', 'FHSPT', 'Fachhochschulreife (schulischer und prakt. Teil)', 'Fachhochschulreife (schulischer und praktischer Teil)\n'),
(11, '7', 'HS', 'Berufsreife', 'Berufsreife (ehem. Hauptschulabschluss)\n'),
(12, '', '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vorgang`
--

CREATE TABLE IF NOT EXISTS `vorgang` (
  `id` int(11) NOT NULL,
  `id_dsa_bewerberdaten` int(11) NOT NULL,
  `bemerkungen` varchar(500) COLLATE utf8_bin NOT NULL,
  `dok_zeugnis` varchar(11) COLLATE utf8_bin NOT NULL,
  `dok_lebenslauf` varchar(11) COLLATE utf8_bin NOT NULL,
  `dok_ausweis` varchar(11) COLLATE utf8_bin NOT NULL,
  `dok_erfahrung` varchar(11) COLLATE utf8_bin NOT NULL,
  `last_user` varchar(200) COLLATE utf8_bin NOT NULL,
  `last_time` varchar(200) COLLATE utf8_bin NOT NULL,
  `log` longtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `dsa_bewerberdaten`
--
ALTER TABLE `dsa_bewerberdaten`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `dsa_bildungsgang`
--
ALTER TABLE `dsa_bildungsgang`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `edoo_bewerber`
--
ALTER TABLE `edoo_bewerber`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `edoo_bewerbungsziel`
--
ALTER TABLE `edoo_bewerbungsziel`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `edoo_fremdsprachen`
--
ALTER TABLE `edoo_fremdsprachen`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `edoo_schueler`
--
ALTER TABLE `edoo_schueler`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `edoo_schueler_betrieb`
--
ALTER TABLE `edoo_schueler_betrieb`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `fehler`
--
ALTER TABLE `fehler`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ignorieren`
--
ALTER TABLE `ignorieren`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `schulformen`
--
ALTER TABLE `schulformen`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `senden_texte`
--
ALTER TABLE `senden_texte`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `summen`
--
ALTER TABLE `summen`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vorbildung`
--
ALTER TABLE `vorbildung`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vorgang`
--
ALTER TABLE `vorgang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `dsa_bewerberdaten`
--
ALTER TABLE `dsa_bewerberdaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `dsa_bildungsgang`
--
ALTER TABLE `dsa_bildungsgang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `edoo_bewerber`
--
ALTER TABLE `edoo_bewerber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `edoo_bewerbungsziel`
--
ALTER TABLE `edoo_bewerbungsziel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT für Tabelle `edoo_fremdsprachen`
--
ALTER TABLE `edoo_fremdsprachen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `edoo_schueler`
--
ALTER TABLE `edoo_schueler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `edoo_schueler_betrieb`
--
ALTER TABLE `edoo_schueler_betrieb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `fehler`
--
ALTER TABLE `fehler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `ignorieren`
--
ALTER TABLE `ignorieren`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `schulformen`
--
ALTER TABLE `schulformen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `senden_texte`
--
ALTER TABLE `senden_texte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT für Tabelle `summen`
--
ALTER TABLE `summen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `vorbildung`
--
ALTER TABLE `vorbildung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT für Tabelle `vorgang`
--
ALTER TABLE `vorgang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
