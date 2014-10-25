-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 25 okt 2014 om 09:39
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `db_portaal`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_facebookuser`
--

CREATE TABLE IF NOT EXISTS `tbl_facebookuser` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `fbid` bigint(20) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `userType_ID` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_facebookuser`
--

INSERT INTO `tbl_facebookuser` (`id`, `fbid`, `fullname`, `email`, `avatar`, `userType_ID`) VALUES
(17, 10154671936270375, 'Gertjan Tilburgh', 'gertjan_tilburgh@hotmail.com', 'http://graph.facebook.com/10154671936270375/picture', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_googleuser`
--

CREATE TABLE IF NOT EXISTS `tbl_googleuser` (
  `google_id` decimal(21,0) NOT NULL,
  `google_name` varchar(60) NOT NULL,
  `google_email` varchar(60) NOT NULL,
  `google_link` varchar(255) NOT NULL,
  `google_picture_link` varchar(255) NOT NULL,
  `userType_ID` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_googleuser`
--

INSERT INTO `tbl_googleuser` (`google_id`, `google_name`, `google_email`, `google_link`, `google_picture_link`, `userType_ID`) VALUES
('100036254606662452983', 'vincentt heymans', 'vincentheymans@hotmail.com', 'https://plus.google.com/100036254606662452983', 'https://lh6.googleusercontent.com/-v8WnY55Zuow/AAAAAAAAAAI/A', 1),
('110923447136453892981', 'Gertjan Tilburgh', 'gertjan.tilburgh@gmail.com', 'https://plus.google.com/110923447136453892981', 'https://lh3.googleusercontent.com/-QDfthWwFhs8/AAAAAAAAAAI/A', 1),
('112025458640448029822', 'vincent heymans', 'vincentheymanspsn@gmail.com', '', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/A', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_twitteruser`
--

CREATE TABLE IF NOT EXISTS `tbl_twitteruser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_token_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userType_ID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_twitteruser`
--

INSERT INTO `tbl_twitteruser` (`id`, `oauth_provider`, `oauth_uid`, `oauth_token`, `oauth_token_secret`, `username`, `userType_ID`) VALUES
(12, '', '', 'KtayB6vj2bdWvUCMWK3UhCJURDKdCcBQ', 'n6q3UyuASmMiwUC9vh2iNE9gv0UQ9mlb', '', 1),
(13, '', '', 'pUDN3ks2IkipNkPzERBvKNml9RS86j2p', 'aXxumNwLsNix9r30WQTppgSNbT0BnQrD', '', 1),
(14, 'twitter', '', 'wtz0Ii6ANI2cSwh5PvK1o9NfX3W6voWm', '678h6T5KyjhivFJ7XgzCZyEKHFksFbEz', '', 1),
(15, '', '', 'Z9HCt2PFmr6CtXWVvZlu9xY1g4SpkOTo', 'eUmnZUKxKV7NGYjpFeNlycO5xWHaUHPT', '', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateOfBirth` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userType_ID` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_ID`, `name`, `surname`, `dateOfBirth`, `email`, `username`, `password`, `avatar`, `userType_ID`) VALUES
(19, 'test', 'testo', '12/04/2001', 'test@hotmail.com', 'test', 'a646771123f656edf4c556b0f60694aa', '', 1),
(23, 'Gertjan', 'Tilburgh', '15/01/1991', 'gertjan_tilburgh@hotmail.com', 'GertjanT', 'a646771123f656edf4c556b0f60694aa', '', 3),
(24, 'test2', 'test2', '02/02/2002', 'test2@test.com', 'test', 'dee66a3f5cb9c4f91a68941f34897f57', '', 1),
(25, 'test3', 'test3', '03/03/2003', 'test3@hotmail.com', 'test', '8784f711e786899c60a5bb37facd738c', '', 1),
(26, 'test4', 'test4', '04/04/2004', 'test4@t.com', 'test4', '62310061c9a824660b4cbcdbb61f7806', '', 2),
(27, 'test5', '55', '05/05/2005', 'test5@t.com', 'test5', '2a177351e350df8a1818fd4cb6a82126', '', 1),
(28, 'test6', 'test6', '06/06/1996', 'test6@t.com', 'test6', 'be0413539853c5c03ffcaa281754100b', '', 1),
(29, 'test7', 'test7', '07/07/1987', 'test7@t.com', 'test7', '94e2cef76ff9331e97c3cb4e95e06cbe', '', 1),
(30, 'test8', 'test8', '08/08/1998', 'test8@t.com', 'test8', '7f638d14777424fae2d9c0bb16235da6', '', 1),
(31, 'Doctor', 'BrownyJr.', '01/05/1991', 'DoctorBrownyJr@UKtheGreat.com', 'BrownyJR.', 'e6150fdac71a9f05e699c4d2135ff51d', '', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_usertype`
--

CREATE TABLE IF NOT EXISTS `tbl_usertype` (
  `userType_ID` int(11) NOT NULL AUTO_INCREMENT,
  `userType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userType_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_usertype`
--

INSERT INTO `tbl_usertype` (`userType_ID`, `userType`) VALUES
(1, 'user'),
(2, 'expert'),
(3, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
