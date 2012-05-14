-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-7
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 16, 2011 at 01:02 PM
-- Server version: 5.0.32
-- PHP Version: 5.2.0-8+etch11
-- 
-- Database: `oglasinis`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `confirmation`
-- 

CREATE TABLE `confirmation` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `code` varchar(250) default NULL,
  `confirmed` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `confirmation`
-- 

INSERT INTO `confirmation` (`id`, `user_id`, `code`, `confirmed`) VALUES 
(7, 1, '74154e52ff5834f06b4f9b3ea45da0c2', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `emailnotification`
-- 

CREATE TABLE `emailnotification` (
  `id_emaila` int(11) NOT NULL auto_increment,
  `email` varchar(100) default NULL,
  `unsecure_stamp` varchar(100) default NULL,
  `secure_stamp` varchar(100) default NULL,
  `status_slanja` varchar(50) default NULL,
  `from_table` varchar(50) default NULL,
  PRIMARY KEY  (`id_emaila`),
  UNIQUE KEY `id_emaila` (`id_emaila`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `emailnotification`
-- 

INSERT INTO `emailnotification` (`id_emaila`, `email`, `unsecure_stamp`, `secure_stamp`, `status_slanja`, `from_table`) VALUES 
(1, 'emailkosalje@yahoo.com', '6872590c1a0eb6c491cae3898ae1ea58', '7d6b317476a584088986a01c04966d09', 'custom', 'oglas'),
(2, 'email@yahoo.com', '40323e6d72fcf51b3988fd90ed639fc8', '8094ec21d6f924750d5b0ac5f86a5380', 'sve', 'oglas'),
(3, 'kruksmail@gmail.com', '76cb643f0ed53f8076d7490add02a6b3', 'b320365c590a65396bb0154602215421', 'sve', 'oglas');

-- --------------------------------------------------------

-- 
-- Table structure for table `emailtrigger`
-- 

CREATE TABLE `emailtrigger` (
  `id_emailtriggera` int(11) NOT NULL auto_increment,
  `id_emaila` int(11) NOT NULL,
  `naziv` varchar(30) NOT NULL,
  UNIQUE KEY `id_emailtriggera` (`id_emailtriggera`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `emailtrigger`
-- 

INSERT INTO `emailtrigger` (`id_emailtriggera`, `id_emaila`, `naziv`) VALUES 
(5, 1, 'Kategorija19'),
(4, 1, 'Kategorija22');

-- --------------------------------------------------------

-- 
-- Table structure for table `forumregistration`
-- 

CREATE TABLE `forumregistration` (
  `id_foruma` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `email` varbinary(100) NOT NULL,
  `sifra` varchar(50) default NULL,
  PRIMARY KEY  (`id_foruma`),
  UNIQUE KEY `id_foruma` (`id_foruma`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `forumregistration`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `kategorije`
-- 

CREATE TABLE `kategorije` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `access_level` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `kategorije`
-- 

INSERT INTO `kategorije` (`id`, `name`, `access_level`) VALUES 
(15, 'Hobi', NULL),
(14, 'Tehnika', NULL),
(13, 'Nekretnine', NULL),
(16, 'Razno', NULL),
(17, 'Poslovi', NULL),
(18, 'Lepota i zdravlje', NULL),
(19, 'Usluge', NULL),
(20, 'Ljubimci', NULL),
(22, 'Ugostiteljstvo', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `oglas`
-- 

CREATE TABLE `oglas` (
  `id_oglasa` int(11) NOT NULL auto_increment,
  `id_kategorije` int(11) NOT NULL,
  `id_podkategorije` int(11) NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `datum_kreiranja` datetime NOT NULL,
  `grad` varchar(100) default NULL,
  `ponuda_traznja` varchar(100) default NULL,
  `adresa` varchar(100) default NULL,
  `telefoni` varchar(100) default NULL,
  `trajanje_oglasa` datetime NOT NULL,
  `email` varchar(100) default NULL,
  `sajt` varchar(100) default NULL,
  `cena` int(11) default NULL,
  `valuta` varchar(30) default NULL,
  `detalji` varchar(300) default NULL,
  `ip_oglasivaca` varchar(20) default NULL,
  `oglasivac` varchar(100) default NULL,
  `glavna_slika` varchar(150) default NULL,
  `slika_dva` varchar(150) default NULL,
  `slika_tri` varchar(150) default NULL,
  `slika_cetri` varchar(150) default NULL,
  `proveren` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_oglasa`),
  UNIQUE KEY `id_oglasa` (`id_oglasa`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `oglas`
-- 

INSERT INTO `oglas` (`id_oglasa`, `id_kategorije`, `id_podkategorije`, `naslov`, `datum_kreiranja`, `grad`, `ponuda_traznja`, `adresa`, `telefoni`, `trajanje_oglasa`, `email`, `sajt`, `cena`, `valuta`, `detalji`, `ip_oglasivaca`, `oglasivac`, `glavna_slika`, `slika_dva`, `slika_tri`, `slika_cetri`, `proveren`) VALUES 
(1, 14, 12, 'Menjam polovni telefon', '2011-04-15 08:51:34', 'NIŠ', 'ponuda', 'Ulica Branka Mitrovica 23, kod Merkatora', '063/578-063 064/33-26-373', '2011-05-15 00:00:00', 'kruksmail@gmail.com', 'www.oglasinis.com', 1000, 'DIN', 'Prodajem polovni telefon Samsung c300. Izgleda ne radi flet kabal. Cena 1500 din. Moze i zamena neka. Moze svaki vid transakcije. I idemo mala. Ovo je prvi oglas  i sluzi kao proba', '212.200.34.72 ', 'Oglasivac- Aca', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-04-15 08-51-34.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-04-15 08-51-34.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'DA'),
(4, 13, 21, 'Prodaja placa', '2011-06-14 16:55:54', 'NIŠ', 'ponuda', '', '0644799927          018214885', '2011-07-14 00:00:00', '', '', 0, 'DIN', 'Prodajem plac u naselju Branko Bjegovic povrsine 4,5 ari sa placenim komunalnim troskovima i dozvolom za gradnju.', '93.86.22.65 ', 'Oglasivac- Velimir', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(3, 13, 15, 'izdajem lokal', '2011-06-06 22:42:05', 'NIŠ', 'ponuda', 'raiceva', '063411185', '2011-07-06 00:00:00', 'vladanzdravkovic@yahoo.com', '', 400, 'DIN', 'Izdajem lokal 46 m2 u ulici Rajicevoj kod o.s. ucitelj tase sa mokrim cvorom i telefonom.\r\nIzdajem i poslovni prostor na istoj adresi 80m2\r\ninformacije na telefon 063-411-185', '109.93.79.165 ', 'Oglasivac- vladan', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'DA');

-- --------------------------------------------------------

-- 
-- Table structure for table `podkategorije`
-- 

CREATE TABLE `podkategorije` (
  `id` int(11) NOT NULL auto_increment,
  `kategorija` int(11) default NULL,
  `label` varchar(250) default NULL,
  `page_id` int(11) default NULL,
  `link` varchar(250) default NULL,
  `position` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

-- 
-- Dumping data for table `podkategorije`
-- 

INSERT INTO `podkategorije` (`id`, `kategorija`, `label`, `page_id`, `link`, `position`) VALUES 
(14, 15, 'Lov', NULL, '/lov', 1),
(13, 13, 'Stanovi', NULL, '/stanovi', 2),
(12, 14, 'Mobilni telefoni', NULL, '/stanovi', 1),
(15, 13, 'Izdavanje', NULL, '/nesto', 1),
(16, 13, 'KuÄ‡e', NULL, 'aaa', 3),
(17, 15, 'Ribolov', NULL, 'sss', 2),
(18, 14, 'RaÄunari', NULL, 'aaa', 2),
(19, 15, 'Ostalo', NULL, 'ss', 3),
(20, 14, 'Ostalo', NULL, 'aa', 3),
(21, 13, 'Ostalo', NULL, 'aaw', 4),
(22, 17, 'Ostalo', NULL, 'sfa', 1),
(23, 15, 'RuÄni radovi', NULL, 'sdfa', 4),
(24, 15, 'Kolekcionarstvo', NULL, 'a', 5),
(25, 13, 'Njive', NULL, 'da', 5),
(26, 13, 'Poslovni prostor', NULL, 'sd', 6),
(27, 13, 'Vikendice', NULL, 'dd', 7),
(28, 17, 'RaÄunovodstvo', NULL, 'a', 2),
(29, 17, 'Trgovina', NULL, 'ad', 3),
(30, 17, 'Ugostiteljstvo', NULL, 'da', 4),
(31, 18, 'Kozmetika', NULL, 'aadasd', 1),
(32, 18, 'Ostalo', NULL, 'adsda', 2),
(33, 14, 'Aparati i ureÄ‘aji', NULL, 'das', 4),
(34, 19, 'Ostalo', NULL, 'dad', 1),
(35, 20, 'DomaÄ‡e Å¾ivotinje', NULL, 'das', 1),
(36, 20, 'Ostalo', NULL, 'asd', 2),
(37, 20, 'Psi', NULL, 'sad', 3),
(38, 20, 'MaÄke', NULL, 'asdd', 4),
(39, 19, 'Zanatstvo', NULL, 'das', 2),
(40, 19, 'Rad u kuÄ‡i', NULL, 'dasd', 3),
(41, 20, 'Ishrana', NULL, 'as', 5),
(42, 19, 'Servisi', NULL, 'adasd', 4),
(43, 22, 'Ostalo', NULL, 'adsfa', 1),
(44, 22, 'Kafane', NULL, 'adssd', 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `prijateljskisajtovi`
-- 

CREATE TABLE `prijateljskisajtovi` (
  `id_sajta` int(11) NOT NULL auto_increment,
  `naslov` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `sajt` varchar(70) NOT NULL,
  `detalji` varchar(200) NOT NULL,
  `slika` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_sajta`),
  UNIQUE KEY `id_sajta` (`id_sajta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `prijateljskisajtovi`
-- 

INSERT INTO `prijateljskisajtovi` (`id_sajta`, `naslov`, `email`, `sajt`, `detalji`, `slika`) VALUES 
(5, 'Prvi prijateljski sajt', 'emailprvogprijteljskogsajta@email.com', 'www.prviprijateljskisajt.com', 'Prvi prijateljski sajt i idemo mala da vidimo koliko veliki tekst ce prikazati. Prvi prijateljski sajt i idemo mala da vidimo koliko veliki tekst ce prikazati. Prvi prijateljski sajt i idemo mala da v', '/images/prijateljskisajtovi/upload/Vlasotince-PrijateljskiSajtovi-Slika-2011-01-31 17-47-20.jpg'),
(6, 'Drugi prijateljski sajt', 'drugiprijateljskisajt@gmail.com', 'www.drugiprijateljskisajt.com', 'Drugi prijateljski sajtDrugi prijateljski sajtDrugi prijateljski sajtDrugi prijateljski sajtDrugi prijateljski sajtDrugi prijateljski sajtDrugi prijateljski sajtDrugi prijateljski sajtDrugi prijateljs', '/images/prijateljskisajtovi/upload/Vlasotince-PrijateljskiSajtovi-Slika-2011-01-31 20-27-50.jpg');

-- --------------------------------------------------------

-- 
-- Table structure for table `privacy`
-- 

CREATE TABLE `privacy` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `basic` varchar(500) default NULL,
  `custom` varchar(500) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `privacy`
-- 

INSERT INTO `privacy` (`id`, `user_id`, `basic`, `custom`) VALUES 
(12, 1, NULL, 'birthdate/Datum roÄ‘enja,description/Dodatne informacije');

-- --------------------------------------------------------

-- 
-- Table structure for table `temporarypassword`
-- 

CREATE TABLE `temporarypassword` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `username` varchar(50) default NULL,
  `password` varchar(250) default NULL,
  `first_name` varchar(50) default NULL,
  `last_name` varchar(50) default NULL,
  `email` varchar(250) default NULL,
  `sex` varchar(10) default NULL,
  `role` varchar(25) default NULL,
  `confirmed` varchar(50) default NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `temporarypassword`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) default NULL,
  `password` varchar(250) default NULL,
  `first_name` varchar(50) default NULL,
  `last_name` varchar(50) default NULL,
  `role` varchar(25) default 'User',
  `email` varchar(250) default NULL,
  `sex` varchar(10) default NULL,
  `birthdate` varchar(100) default NULL,
  `description` text,
  `phone_mobile` varchar(25) default NULL,
  `phone_home` varchar(25) default NULL,
  `fax` varchar(25) default NULL,
  `address` varchar(100) default NULL,
  `city` varchar(50) default NULL,
  `site` varchar(250) default NULL,
  `image_url` varchar(250) default NULL,
  `employee` varchar(100) default NULL,
  `last_sid` char(32) default NULL,
  `signup_date` varchar(100) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `role`, `email`, `sex`, `birthdate`, `description`, `phone_mobile`, `phone_home`, `fax`, `address`, `city`, `site`, `image_url`, `employee`, `last_sid`, `signup_date`) VALUES 
(1, 'ugljesa', '55b98638e33b23df2d23565b8fe8ddb3', 'Uglješa', 'Karuovic', 'Administrator', 'kruksmail@gmail.com', 'Muški', '16-01-1985', 'Uks je car', '381 64 3326373', '381 16 875791', 'Nema', 'Dusanova', 'Vlasotince', 'www.kruksoft.com', '1.jpg', 'kruksoft d.o.o', '6747bb4faae5df9c02011f4f3136889c', '15-01-2011'),
(28, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'user', 'User', 'user1@gmail.com', 'Muški', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'd6jm1tub43k3cb30m9losre2i2', '20-01-2011');
