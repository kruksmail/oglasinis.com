-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-7
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 03, 2011 at 03:00 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `kategorije`
-- 

INSERT INTO `kategorije` (`id`, `name`, `access_level`) VALUES 
(15, 'Hobi', NULL),
(14, 'Tehnika', NULL),
(13, 'Nekretnine', NULL),
(27, 'Građevinarstvo ', NULL),
(17, 'Posao', NULL),
(18, 'Lepota i zdravlje', NULL),
(20, 'Ljubimci', NULL),
(22, 'Ugostiteljstvo', NULL),
(23, 'Auto-moto', NULL),
(24, 'Turizam', NULL),
(25, 'Sport', NULL),
(26, 'Software/Internet', NULL);

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
  `detalji` text,
  `ip_oglasivaca` varchar(20) default NULL,
  `oglasivac` varchar(100) default NULL,
  `glavna_slika` varchar(150) default NULL,
  `slika_dva` varchar(150) default NULL,
  `slika_tri` varchar(150) default NULL,
  `slika_cetri` varchar(150) default NULL,
  `proveren` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_oglasa`),
  UNIQUE KEY `id_oglasa` (`id_oglasa`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

-- 
-- Dumping data for table `oglas`
-- 

INSERT INTO `oglas` (`id_oglasa`, `id_kategorije`, `id_podkategorije`, `naslov`, `datum_kreiranja`, `grad`, `ponuda_traznja`, `adresa`, `telefoni`, `trajanje_oglasa`, `email`, `sajt`, `cena`, `valuta`, `detalji`, `ip_oglasivaca`, `oglasivac`, `glavna_slika`, `slika_dva`, `slika_tri`, `slika_cetri`, `proveren`) VALUES 
(10, 13, 15, 'Izdajem stan kod medicinskog fakulteta', '2011-06-21 11:05:32', 'NIŠ', 'ponuda', 'Bulevar Zorana Djindjica 77/30', '063/431-485 018/537-060', '2011-11-30 00:00:00', '', '', 0, 'DIN', 'Izdajem dvosoban stan kod Medicinskog fakulteta, Bulevar Zorana Djindjica 77/30 \r\n\r\nTelefon 063/431-485', '212.200.65.122 ', 'Oglasivac- Dragia', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(11, 13, 15, 'Izdajem stan u Nisu', '2011-06-29 12:35:08', 'NIŠ', 'ponuda', 'Vojvode Misica', '063/8785-196', '2011-09-14 00:00:00', 'danijel@ee.rs', '', 150, 'DIN', 'Izdajem namesten jednosoban stan u Centru Nisa, ulica Vojvode Misica. Prizemlje, centralno grejanje, telefon, terasa. tel. 063 87 85 196  ', '78.30.130.137 ', 'Oglasivac- Vlada', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(4, 13, 21, 'Prodaja placa', '2011-06-14 16:55:54', 'NIŠ', 'ponuda', '', '0644799927          018214885', '2011-07-14 00:00:00', '', '', 0, 'DIN', 'Prodajem plac u naselju Branko Bjegovic povrsine 4,5 ari sa placenim komunalnim troskovima i dozvolom za gradnju.', '93.86.22.65 ', 'Oglasivac- Velimir', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(5, 14, 33, 'Aparati', '2011-06-21 08:49:07', 'NIŠ', 'ponuda', '', '064/661742', '2011-10-04 00:00:00', '', '', 0, 'DIN', 'Povoljno prodajem aparate za kazino MEGE PAY SLOT MULTI GAME. ', '89.216.37.18 ', 'Oglasivac- Miodrag', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', 'NE'),
(3, 13, 26, 'izdajem lokal', '2011-06-06 22:42:05', 'NIŠ', 'ponuda', 'raiceva', '063411185', '2011-10-04 00:00:00', 'vladanzdravkovic@yahoo.com', '', 400, 'DIN', 'Izdajem lokal 46 m2 u ulici Rajicevoj kod o.s. ucitelj tase sa mokrim cvorom i telefonom.\r\nIzdajem i poslovni prostor na istoj adresi 80m2\r\ninformacije na telefon 063-411-185', '109.93.79.165 ', 'Oglasivac- vladan', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'DA'),
(6, 14, 78, 'MEGE, PAY SLOT, MULTI GAME', '2011-06-21 08:52:19', 'NIŠ', 'ponuda', '', '064/6617700', '2011-10-14 00:00:00', '', '', 0, 'DIN', 'POVOLJNO PRODAJEM ILI IZDAJEM APARATE ZA KAZINO MEGE PAY SLOT MULTI GAME. ', '89.216.37.18 ', 'Oglasivac- MIODRAG', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', 'NE'),
(7, 18, 31, 'NOKTI', '2011-06-21 09:07:07', 'NIŠ', 'ponuda', '', '069/661742', '2011-11-23 00:00:00', '', '', 0, 'DIN', 'Nadogradnja noktiju.', '89.216.37.18 ', 'Oglasivac- JELENA', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', 'NE'),
(8, 18, 31, 'NOKTI', '2011-06-21 09:14:24', 'NIŠ', 'ponuda', '', '069/661742', '2011-11-23 00:00:00', '', '', 0, 'DIN', 'NADOGRADNJA IZLIVANJEM POVOLJNO. ', '89.216.37.18 ', 'Oglasivac- JELENA', '/images/upload/slikeoglasa/Vlasotince-Oglasi-Glavna-Slika2011-06-21 09-14-24.jpg', '/images/upload/slikeoglasa/Vlasotince-Oglasi-Slika2-2011-06-21 09-14-24.jpg', '/images/upload/slikeoglasa/Vlasotince-Oglasi-Slika3-2011-06-21 09-14-24.jpg', '/images/upload/slikeoglasa/Vlasotince-Oglasi-Slika4-2011-06-21 09-14-24.jpg', 'NE'),
(9, 14, 78, 'CISTERNA ZA VODU', '2011-06-21 09:22:00', 'NIŠ', 'ponuda', '', '069/661742', '2011-09-14 00:00:00', '', '', 0, 'DIN', 'POVOLJNO PRODAJEM CISTERNU ZA VODU ZAPREMINE 1,5t.CISTERNA JE NOVA GUMENA VOJNA', '89.216.37.18 ', 'Oglasivac- JELENA', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', '/images/upload/slikeoglasa/VlasotinceOglasi.jpg', 'NE'),
(12, 13, 15, 'Izdajem stan kod Caira', '2011-06-30 09:31:38', 'NIŠ', 'ponuda', 'Mokranjceva 77/33', '0607273162', '2011-09-14 00:00:00', '', '', 0, 'DIN', 'Izdajem dvosoban stan kod Caira. Centralno grejanje, kablovksa, internet... Telefon 060/72-73-162', '212.200.65.116 ', 'Oglasivac- Stanislav', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(13, 14, 33, 'Mega drive - igrice -kao sega', '2011-06-30 09:41:31', 'NIŠ', 'ponuda', '', '060/051-09-16', '2011-09-14 00:00:00', '', '', 1300, 'DIN', 'MEGA DRIVE  , radi na 4 baterije AAA od 1.5 v, a moze i na ispravljac od 6v - koji ne ide uz njega , priljucuje se na televizor audio i video kablom tkz. bananicama , i sadrzi 6 igrica u memoriji i to-\r\n\r\nSONIC 2, THE OOZE, ECCO THE DOLPHIN, COLUNS, ALEX KIDD, GAIN GROUND', '212.200.65.116 ', 'Oglasivac- Bozidar', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-06-30 09-50-57.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(14, 13, 16, 'Izdajem kucu', '2011-06-30 21:42:12', 'NIŠ', 'ponuda', '', '041-535-4260', '2011-09-14 00:00:00', 'm.bibi-88@hotmail.com', '', 0, 'DIN', 'Izdajem kucu 700 m od konja a od buvlje pijace 50m.Kuca ima 75 kv i renovirana je sa namestajem.', '80.219.119.231 ', 'Oglasivac- Goran', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(15, 23, 45, 'Peugeot 305', '2011-07-01 11:54:28', 'NIŠ', 'ponuda', '', '062/18-42-751', '2011-07-31 00:00:00', '', '', 85000, 'DIN', 'Auto je u odlicnom stanju, registrovan do 11-2011god, plin, atest, vlasnik licno, prva registracija 1991god, limuzina, mogucnost prenosa vlasnistva, vozilo je korisceno kao licno', '212.200.65.119 ', 'Oglasivac- Zika', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-07-01 11-54-28.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(16, 23, 48, 'Auto prikolica 850eura', '2011-07-01 12:17:49', 'NIŠ', 'ponuda', '', '063/18-81-933', '2011-07-31 00:00:00', '', '', 85000, 'DIN', 'Prikolica je Poljske proizvodnje, teska samo 320kg, predvidjena da moze da je vuce i peglica.Vrlo je lagana i podvozna.Unutrasnjost prikolice renovirana pre 2 godine, gume su joj nove.Ima i predsator koji je malo stariji sto se vidi na slikama. \r\nBoja spoljasnjosti bela', '212.200.65.119 ', 'Oglasivac- Auto prikolica', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-07-01 12-17-49.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(17, 23, 46, 'Motor JAWA 350', '2011-07-01 12:57:04', 'NIŠ', 'ponuda', '', '069/ 770 474', '2011-09-14 00:00:00', 'ljubamaf@gmail.com', '', 0, 'DIN', 'Prodajem motor JAWA 350, godiste 1990, u extra stanju \r\nTelefon\r\n069/ 770 474', '212.200.65.119 ', 'Oglasivac- Ljubisa', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-07-01 12-57-04.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(18, 23, 45, 'Delovi za Renault Laguna  i Renault Safran', '2011-07-01 13:00:57', 'NIŠ', 'ponuda', '', '0658224466', '2011-09-14 00:00:00', 'renault.laguna.ii@gmail.com', '', 0, 'DIN', 'Mehanika, manjac, limarija, stakla, gume, felne aluminijumske i celicne, stop lampe, branici, farovi, elektronika, elektrika, airbag, enterijer, CD, sedista, retrovizori \r\n', '212.200.65.119 ', '1', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(19, 13, 15, 'Studentski stan', '2011-07-02 15:46:37', 'NIŠ', 'ponuda', 'bul. Nemanjica, ul.Branka Krsmanovica 15', '063/870-9531', '2011-09-14 00:00:00', 'jelena.penich@gmail.com', '', 0, 'DIN', 'Izdajem namesten stan za dve studentkinje ili studenta na bulevaru Nemanjica, kod gradske toplane. Tv, kuhinja, ves masina, CG.', '93.86.187.8 ', 'Oglasivac- Jelena Penic', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(20, 15, 14, 'DVD o psima', '2011-07-05 10:04:39', 'NIŠ', 'ponuda', '', '063-8612-420', '2011-08-04 00:00:00', '', '', 0, 'DIN', 'DVD o psima ovcarski polarni psi za pratnju molosi borbeni psi lovni psi lov pernate i dlakave divljaci najveci izbor DVD filmova u Srbiji i sire preko 1000 dvd snimaka na jednom mestu moguca zamena za snimke koje neposedujem i moguca prodaja kompletne kolekcije', '212.200.65.106 ', 'Oglasivac- Jovo', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(21, 15, 14, 'Lampe za lov, ribolov i kampovanje', '2011-07-05 10:07:34', 'NIŠ', 'ponuda', '', '011 3477 981 - 064 911 9112 -  062 196 5484', '2011-08-04 00:00:00', '', '', 1265, 'DIN', 'Veliki izbor lampi za kampovanje, lov i ribolov. Neki modeli imaju  dve neonske lampe ili 9/15 LED dioda, kompas, rucni dinamo za punjenje u prirodi, sirenu, punjac za 220V ili 12V mogucnost da se iz akumulatora lampe pune mobilni telefoni preko adaptera iz kompleta. Cene od 1265 do 3520 dinara. ', '212.200.65.106 ', 'Oglasivac- Vojislav', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(23, 15, 17, 'Prodajem varalice za pecanje', '2011-07-05 10:12:31', 'NIŠ', 'ponuda', '', '0611303778', '2011-10-14 00:00:00', '', '', 120, 'DIN', 'Cena po komadu 120 dinara. Tezina varalice 7,9gr a duzina 9 cm. Jeftinije na vise od 30 komada.\r\n', '212.200.65.106 ', '1', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-07-05 10-12-31.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(24, 15, 23, 'Kupujem pirotski cilim', '2011-07-05 10:16:33', 'NIŠ', 'potraznja', '', '063/ 732-9110 ', '2011-10-14 00:00:00', 'stanimirovic.vladimir@gmail.com', '', 0, 'DIN', 'Kolekcionar, vise od 20 godina iskustva, najpovoljnije otkupljujem, prodajem i vrsim procenu starih pirotskih cilima.\r\n\r\nGodine iskustva i preko 80 cilima koje posedujem garantuju najbolju ponudu za Vas.\r\n\r\nDolazim na adresu bilo gde u Srbiji, isplata odmah, kes.\r\n', '212.200.65.106 ', '1', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-07-05 10-16-33.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(25, 13, 21, 'Plac na prodaju', '2011-07-05 12:42:33', 'NIŠ', 'ponuda', '', '018/4248-863', '2011-10-14 00:00:00', '', '', 0, 'DIN', 'Prodajem plac od 10 ara na Viniku, kod crkve Svetog Luke. Ogradjen,ceo dan sunce,vinograd i vocke, sa izgradjenim podrumom od cvrstog materijala (3 x 4m). Gradsko gradjevinsko zemljiste. Mogucnost uvodjenja struje, vode, telefona. 13.500 Eura. \r\n0184248863', '188.2.217.91 ', 'Oglasivac- Milka', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(26, 13, 15, 'Izdaje se dvosoban stan u kuci na Panteleju.', '2011-07-05 18:55:45', 'NIŠ', 'ponuda', 'Vinkovacka br. 3', '018/219-056', '2011-10-14 00:00:00', 'mircha@bitsyu.net', '', 0, 'DIN', 'Izdaje se dvosoban stan u kuci na Panteleju.\r\n 5 minuta od crkve. Kupatilo, poseban ulaz,\r\n poseban strujomer,\r\n mogucnost koriscenja dvorista za auto i druge stvari.\r\n Cena po dogovoru.\r\n\r\n018/219-056 Rada', '85.222.168.141 ', 'Oglasivac- Radmila', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-07-05 18-55-45.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-07-05 18-55-45.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-07-05 18-55-45.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika4-2011-07-05 18-55-45.jpg', 'NE'),
(27, 24, 56, 'Vlasinsko jezero smestaj, sobe, apartmani, vila', '2011-07-07 15:46:20', 'NIŠ', 'ponuda', 'Vlasinsko jezero', '063/431-485  ', '2011-12-08 00:00:00', '', 'www.vlasinskojezeroodmor.com', 0, 'DIN', 'Izdajem sobe na Vlasinskom jezeru. Vise informacija na sajtu www.vlasinskojezeroodmor.com', '212.200.65.127 ', 'Oglasivac- Dragisa', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-07-07 15-46-20.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-07-07 15-46-20.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-07-07 15-46-20.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika4-2011-07-07 15-46-20.jpg', 'DA'),
(28, 20, 37, 'Prvobirani stenci rotvajlera - musko i zensko', '2011-07-08 11:00:14', 'NIŠ', 'ponuda', '', '063/596-103', '2011-09-29 00:00:00', 'lotnenad@sezampro.rs', '', 0, 'DIN', 'Rotvajler prvobirani muzjak i zenka u leglu na slici stari 70 dana\r\n\r\nRotvajler prvobirani muzjak i zenka u leglu na slici stari 70 dana, na prodaju. Otac Apolon Crni Vitez ocenjen R.CACIB , 3XCAC. R.CAC , majka Hana samo jednom izlagana ocena odlican 5, cuvana vise kao kucni ljubimac.Cena 250e Nis ', '212.200.65.126 ', 'Oglasivac- Ruzica', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(29, 20, 59, 'Dostava hrane i opreme za kucne ljubimce', '2011-07-08 11:07:57', 'NIŠ', 'ponuda', '', '018521497', '2011-10-14 00:00:00', 'info@fido.rs', 'www.fido.rs', 0, 'DIN', 'Dostava hrane i opreme na teritoriji cele Srbije, placanje pouzecem.\r\n\r\nSirok asortiman artikala, cene izuzetno povoljne.\r\n\r\nZa sada imamo oko 300 artikala na sajtu i sto se konstantno povecava.\r\nUkoliko nemamo neki artikal na sajtu, budite slobodni da nas kontaktirate', '212.200.65.126 ', 'Oglasivac- Nikic Jovan', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(30, 24, 54, 'Smestaj u Radovicima, sobe i apartmani', '2011-07-12 18:04:26', 'NIŠ', 'ponuda', 'Crna Gora, Tivat, Radovici', '00382/67/475/921', '2011-09-14 00:00:00', 'draganbatke@rocketmail.com', '', 660, 'DIN', 'Povoljno izdajem sobe i apartmane u Radovicima, Plavi Horizont.', '79.143.104.250 ', 'Oglasivac- Sladjana', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(31, 26, 66, 'Izrada informacinih sistema,  web portala', '2011-07-19 11:05:10', 'NIŠ', 'ponuda', '', '063-587-063  064-33-26-373', '2011-10-21 00:00:00', 'kruksmail@gmail.com', '', 0, 'DIN', 'Izrada informacinih sistema, web prezentacija, web portala. Profesionalnost na prvom mestu. Sirok izbor tehnologija u zavisnoti od potreba korisnika. ', '212.200.34.80 ', 'Oglasivac- Aca', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(33, 17, 76, 'Apsolvent gradjevine trazi posao', '2011-07-19 11:09:00', 'NIŠ', 'potraznja', '', '063 17 27 146', '2011-08-18 00:00:00', '', '', 0, 'DIN', 'Apsolvent gradjevinskog fakulteta trazi posao. Velibor', '212.200.34.80 ', '1', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(34, 18, 32, 'izbeljivanje-zuba', '2011-07-19 19:26:08', 'NIŠ', 'ponuda', 'Episkopska 7/', '064/3227-313', '2011-08-18 00:00:00', 'man4freedoom@yahoo.com', '', 15000, 'DIN', 'beljenje zuba u oedinaciji DENTAL STUDIO M', '109.93.205.103 ', 'Oglasivac- marko', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(35, 20, 37, 'americki staford', '2011-07-19 20:02:47', 'NIŠ', 'potraznja', '', '0628278790', '2011-08-18 00:00:00', '', '', 0, 'DIN', 'primio bih na poklon stene americkog staforda.', '93.86.55.43 ', 'Oglasivac- Sasa', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(36, 13, 15, 'Izdajem stan u centru', '2011-07-19 22:03:15', 'NIŠ', 'ponuda', 'Sindjelicev trg 22', '063/589-009', '2011-08-18 00:00:00', 'zoya-1@hotmail.com', '', 0, 'DIN', 'Izdajem komplet namesten stan u centru iza pozorista.Stan je komplet renoviran,namestaj radjen po meri, zgrada sa dva lifta.Mesecno placanje.', '188.246.50.161 ', 'Oglasivac- zorica Veljkovic', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(37, 23, 48, 'Prodajem traktorsku prikolicu', '2011-07-20 19:57:02', 'NIŠ', 'ponuda', '', '061/14-17-734', '2011-08-19 00:00:00', '', '', 95000, 'DIN', 'Prodajem traktorsku prikolicu, toma vinkovic, nosivosti 2,5t, jednoosovinska trostrana kiperka sa pomocnim tockom, malo koriscena, izuzetno ocuvana.', '109.92.214.125 ', 'Oglasivac- Sotir', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-07-20 19-57-02.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-07-20 19-57-02.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-07-20 19-57-02.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika4-2011-07-20 19-57-02.jpg', 'NE'),
(38, 13, 26, 'potrebna kancelarija', '2011-07-24 19:35:53', 'NIŠ', 'potraznja', '', '062/362-297', '2011-08-23 00:00:00', '', '', 7000, 'DIN', 'Potreban stan ili lokal za kancelariju, sa centralnim grejanjem, siri centar grada, cena do 70 evra', '77.243.20.229 ', 'Oglasivac- Maja', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(39, 20, 37, 'Patuljasti Snaucer', '2011-07-26 14:48:46', 'NIŠ', 'ponuda', '', '061/72-32-032    062/19-61-643', '2011-08-25 00:00:00', '', '', 0, 'DIN', 'Na prodaju stenci patuljastog Snaucera sa papirima,cena za muzjaka 200E, za zenku 180E. Mogucnost kupovine bez papira kada je cena po dogovoru.', '217.16.134.69 ', 'Oglasivac- Nela', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(40, 14, 33, 'Yamaha PSR e403 ARANZER', '2011-07-29 18:15:12', 'NIŠ', 'ponuda', '', '0649954549 ', '2011-08-28 00:00:00', '', '', 18000, 'DIN', 'Ne koriscena,samo probana par put, izvanredna Yamaha psr e403 aranzer klavijatura. Pogodna za pocetnike ali i za profesionalne muzicare i kompozitore. Samim tim sto ima direktan USB prikljucak za laptop ili kompjuter.', '79.101.250.152 ', 'Oglasivac- Neko ime', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(41, 23, 49, 'zupcasti kaisevi za golf 4', '2011-08-02 17:50:35', 'NIŠ', 'ponuda', '', '064/2621852', '2011-09-01 00:00:00', '', '', 0, 'DIN', 'prodajem 2 zupcasta kaisa,4 spanera,vodenu pumpu za golf 4 1.4 u odlicnom stanju\r\n', '77.46.202.125 ', 'Oglasivac- Sasa', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(42, 13, 15, 'izdajem garsonjeru', '2011-08-02 19:33:13', 'NIŠ', 'ponuda', 'Bozidara Adzije 28 sprat III stan11', '0637733622', '2011-09-01 00:00:00', 'zagi2@sbb.rs', '', 0, 'DIN', 'namestena garsonjera 25 m2 iza sipadovog i simpovog salona vredi videti.', '188.2.136.121 ', 'Oglasivac- irena', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(43, 13, 15, 'Izdajem mansardu', '2011-08-04 08:02:41', 'NIŠ', 'ponuda', 'Kraljevica Marka 6', '018/214-284 064/8408-770 ', '2011-09-03 00:00:00', 'durlanski@gmail.com', '', 0, 'DIN', 'Izdajem mansardu kod Saborne crkve.Nova zgrada, nov namestaj, parno grejanje, klima.', '91.148.66.60 ', 'Oglasivac- Ljuba Kostic', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(44, 13, 15, 'Izdajem sprat kuce,90m2', '2011-08-09 10:15:51', 'NIŠ', 'ponuda', 'ljube didica 35', '0631180812', '2011-09-08 00:00:00', 'misastojkovic@yahoo.com', '', 8000, 'DIN', 'Izdajem trosoban kompletno namesten stan 90m2,pogodan za 4-5 studenta i radnika,dve dvokrevetne,jednu jednokrevetnu sobu,na spratu kuce,poseban ulaz,kuhinja,kupatilo,kompletno opremljen,wireles,kablovska,cena 80 evra po osobi(svi troskovi uracunati u cenu),Ljube Didica 35 kod Hitne pomoci', '91.150.91.42 ', 'Oglasivac- Misa', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-09 10-15-51.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-08-09 10-15-51.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-08-09 10-15-51.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(45, 17, 75, 'dubinsko pranje', '2011-08-11 20:46:54', 'NIŠ', 'ponuda', '', '0638983411', '2011-09-10 00:00:00', '', '', 0, 'DIN', 'Dubinsko pranje unutrasnjosti vozila,mebliranog namestaja,tepiha,itisona itd.', '109.92.97.44 ', 'Oglasivac- Dejan', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(46, 13, 15, 'izdajem stan', '2011-08-18 02:08:55', 'NIŠ', 'ponuda', '', '064/8513518', '2011-09-17 00:00:00', '', '', 0, 'DIN', 'Studentima izdajem dvosoban namesten stan kod Caira. 064/851351', '109.106.253.227 ', 'Oglasivac- marko', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(47, 13, 26, 'Izdajem lokla preko puta škole Čegar', '2011-08-18 19:51:59', 'NIŠ', 'ponuda', '', '063/89-85-868', '2011-09-17 00:00:00', 'sdragan2003@yahoo.com', '', 0, 'DIN', 'Izdajem lokal preko puta škole Čegar. 18kvm, magacinski prostor, mokri čvor. Idealan za pekaru, knjižaru, dragstor... Povoljno', '91.148.100.141 ', 'Oglasivac- Dragan', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-18 19-51-59.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-08-18 19-51-59.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(48, 14, 12, 'iPhone 3G 16GB + puno opreme', '2011-08-18 19:57:47', 'NIŠ', 'ponuda', '', '063/89-85-868', '2011-09-17 00:00:00', 'sdragan2003@yahoo.com', '', 0, 'DIN', 'Prodajem iPhone 3G 16GB. Crni. Dobro ocuvan. Prednja strana perfektna, folija od pocetka. Radi na svim mrezama. Od opreme usb, punjac, 5 maskice (3 potpuno nove) i novi auto punjac.', '91.148.100.141 ', 'Oglasivac- Dragan', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-18 19-57-47.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-08-18 19-57-47.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-08-18 19-57-47.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika4-2011-08-18 19-57-47.jpg', 'NE'),
(49, 13, 21, 'prodajem/izdajem stan', '2011-08-18 22:54:54', 'NIŠ', 'ponuda', 'katićeva 17/2', '062758025', '2011-09-17 00:00:00', 'ekofruit@eunet.rs', '', 0, 'DIN', 'Izdajem/prodajem jednosoban namešten uknjižen stan u centru Niša.Prizemlje,CG,parking mesto,32m2.062758025', '213.198.235.159 ', 'Oglasivac- zoki', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(50, 13, 21, 'Prodajem plac', '2011-08-18 23:02:48', 'NIŠ', 'ponuda', '', '063464140', '2011-09-17 00:00:00', '', '', 0, 'DIN', 'Prodajem plac 8 ari sa temeljom kuće po projektu i podrumom,pored asfalta,na ulazu u Lalinac 8km od Niša.Svojina 1/1,gradska autobuska stanica', '213.198.235.159 ', 'Oglasivac- zlatko', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(51, 23, 45, 'automobil', '2011-08-18 23:07:02', 'NIŠ', 'ponuda', 'carnojevica', '018/247834     018/261331  063/435430', '2011-09-17 00:00:00', 'djovani_63@hotmail.com', '', 35000, 'DIN', 'florida 1.3 efi c.brava alarm ne.reg', '109.106.226.89 ', 'Oglasivac- zoran', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(52, 13, 15, 'Izdajem', '2011-08-19 10:17:15', 'NIŠ', 'ponuda', 'Jovana Ristica 45', '018/4516-432', '2011-09-18 00:00:00', 'stralecocacola@gmail.com', '', 0, 'DIN', 'Izdajem novu garsonjeru u kuci (poseban ulaz iz dvorista). Ulica: Jovana Ristica, izmedju DIF/Zastita na radu i Pravnog/Ekonomskog fakulteta. Kvadratura: 20 m2 sa kablovskom. Cena vrlo povoljna!!!', '77.105.25.140 ', 'Oglasivac- Petar Cvetkovic', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(53, 23, 45, 'automobil', '2011-08-19 12:43:02', 'NIŠ', 'ponuda', 'carnojevica', '018/247834     018/261331  063/435430', '2011-09-18 00:00:00', 'djovani_63@hotmail.com', '', 35000, 'DIN', 'Prodajem Floridu 1.3 efi, 1995 godiste, istekl registracija, c-brava, alarm...HITNO!!!', '109.106.226.89 ', 'Oglasivac- Zoran', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-19 12-43-02.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-08-19 12-43-02.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-08-19 12-43-02.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika4-2011-08-19 12-43-02.jpg', 'NE'),
(54, 23, 49, 'Sprajceri', '2011-08-22 12:04:52', 'NIŠ', 'ponuda', '', '018/456 3110', '2011-09-21 00:00:00', '', '', 0, 'DIN', 'PRODAJEM DRVENE SPRAJCERE 100 KOM.\r\nTELEFON: 018/456-3110\r\n         060/456-3110         ', '109.106.226.89 ', 'Oglasivac- Zoran', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(55, 17, 75, 'DUBINSKO PRANJE', '2011-08-22 22:53:01', 'NIŠ', 'ponuda', '', '063 8983411', '2011-09-21 00:00:00', '', '', 0, 'DIN', 'DUBINSKO PRANJE\r\n063 8983411', '79.101.232.25 ', 'Oglasivac- DEJAN', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-22 22-53-01.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(56, 13, 15, 'Izdajem stan', '2011-08-23 13:49:49', 'NIŠ', 'ponuda', 'Rasadnik 8', '064/8977-421', '2011-09-22 00:00:00', 'novica.i@hotmail.com', '', 0, 'DIN', 'Izdajem nov dvosoban stan blizu ekonomskog fakulteta, namesten, cg, III sprat, CG,lift, lodja\r\n     Tel.064/8977-421', '109.93.159.108 ', 'Oglasivac- Novica Ivanovic', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(57, 13, 15, 'prodajem stan', '2011-08-23 16:36:33', 'NIŠ', 'ponuda', 'bul.nemanjica', '062/776-243', '2011-09-22 00:00:00', 'milivojedragovic72@hotmail.com', '', 0, 'DIN', 'prodajem stan u naselju pantalej ul.somborska,povrsine 37 kvadrata,centralno grejanje,kablovska.', '94.228.236.60 ', 'Oglasivac- milenko dragovic', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(58, 23, 48, 'auto prikolica', '2011-08-23 22:11:35', 'NIŠ', 'ponuda', 'Pasi Poljana', '063 / 8142368', '2011-09-22 00:00:00', '', '', 15000, 'DIN', 'Prodajem auto prikolicu dim.1800 x 1000, Alu stranice sa gibnjevima', '178.79.42.146 ', 'Oglasivac- Milos', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-23 22-11-35.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-08-23 22-11-35.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(59, 18, 32, 'Usluge masaze', '2011-08-24 21:36:48', 'NIŠ', 'ponuda', '', '0691738165', '2011-09-23 00:00:00', '', '', 0, 'DIN', 'USLUGE MASAZE\r\n\r\nAnticelulit masaza\r\nFrancuska relaks masaza\r\nSiacu masaza\r\nDrenaza\r\nTerapeutska masaza (migrena, spondiloza, glavobolja, lumboisijalgija)\r\nSportska masaza\r\n\r\n0691738165\r\nBoki', '188.2.222.177 ', 'Oglasivac- Bojan', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-24 21-36-48.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(60, 18, 32, 'Usluge masaze', '2011-08-24 22:11:07', 'NIŠ', 'ponuda', '', '0691738165', '2011-09-23 00:00:00', '', '', 0, 'DIN', 'USLUGE MASAZE\r\n\r\nAnticelulit masaza\r\nFrancuska relaks masaza\r\nSiacu masaza\r\nDrenaza\r\nTerapeutska masaza (migrena, spondiloza,lumboisijalgija)\r\nSportska masaza\r\n\r\n0691738165 Boki\r\n', '188.2.222.177 ', 'Oglasivac- Bojan', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-24 22-11-07.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(61, 13, 15, 'IZDAJEM NAMEŠTEN STAN', '2011-08-25 01:26:32', 'NIŠ', 'ponuda', '', '065/253-60-99', '2011-09-24 00:00:00', '', '', 0, 'DIN', 'Izdajem kompletno opremljen i namešten jednosoban stan površine 33 m2, u blizini Fakulteta zaštite na radu kod Starog groblja (KTV, klima, telefon, TV, kompletno opremljena kuhinja, veš mašina , TA grejanje)\r\nkontakt: 065/ 253-60-99', '178.149.148.82 ', 'Oglasivac- Brt+atislav', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(62, 26, 69, 'Nikada vise problemi sa vasim racunarom !!!!', '2011-08-25 19:28:03', 'NIŠ', 'ponuda', 'Stanoja Pevca 6', '064/9649852', '2011-09-24 00:00:00', 'jatomi733@gmail.com', '', 0, 'DIN', 'Povoljna instalacija operativnog sistema, i drugi problemi vezani za vas racunar. Dolazak na kucnu adresu. Kvalitetno, povoljno i brzo !!', '109.92.108.39 ', 'Oglasivac- Miki', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(63, 13, 15, 'IZDAJEM STAN', '2011-08-25 22:53:25', 'NIŠ', 'ponuda', 'BULEVAR ZORANA DJINDJICA 74', '0698682104  019734914', '2011-09-24 00:00:00', '', '', 0, 'DIN', 'IZDAJEM DVOSOBAN STAN KOMPLETNO OPREMLJEN POGODAN ZA STUDENTE MEDICINE ILI PORODICU CG KABLOVSKA CENA PO DOGOVORU', '78.30.172.184 ', 'Oglasivac- SUZANA', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(64, 14, 78, 'Maine  za  pakovanje ambalaze', '2011-08-26 22:40:32', 'NIŠ', 'ponuda', 'Dunavska 81', '021/169-0881', '2011-09-25 00:00:00', 'nikolicabp@yahoo.com', '', 25000, 'DIN', '-Prodajem rucne masine za klipsanje suhomesnatih proizvoda,pakovanje ekstrudiranih mreza  za voce i povrce,zatvaranje poliamidnih omotaca,pakovanje i zatvaranje kesa svih velicina itd..Masine su rucne izrade, siroke su namene za sve vrste pakovanja proizvoda,lake za upotrebu,nezavisne od svih izvora napajanja,prenosive,lako rasklopive i jednostavne za odrzavanje (samo chiscenje toplom vodom posle upotrebe).\r\nNasa klipsarica vam obezbedjuje brzo i efikasno klipsanje creva pri izradi kulena,kobasice itd.Nema vise mukotrpnog vezivanja,isecenih ruku i gubljenja vrema.Jednim potezom odradili ste sav posao....\r\n	\r\nGARANCIJA 2 GODINE!!!.\r\n\r\n-Klipsanje kulenova,kobasica,salama,pasteta u crevu itd...\r\n-Pakovanje i zatvaranje mlecnih proizvoda u crevima\r\n-Brzo pakovanje kesa i proizvoda u plastificiranim ambalazama.\r\n-Zatvaranje ekstrudiranih mreza za pakovanje voca i povrca na komad (narandze,luk,krompir)\r\n-Pakovanje najlonskih ambalaza siroke namene..itd\r\n\r\n-Masine su do najmanjeg detalja napravljene od nerdjajucih celika tako da su izuzetno dugotrajne,cvrste ,otporne na koroziju i podlezu svakom zakonu za primenu u mesnoj industriji.Imamo ih u dva oblika, odnosno na prohromskom i hrastovom postolju (po zelji kupca)\r\n', '212.200.129.34 ', 'Oglasivac- Svetozar', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-26 22-40-32.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-08-26 22-40-32.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-08-26 22-40-32.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika4-2011-08-26 22-40-32.jpg', 'NE'),
(65, 14, 18, 'MSI laptop', '2011-08-27 12:14:19', 'NIŠ', 'ponuda', '', '0631796925', '2011-09-26 00:00:00', '', '', 0, 'DIN', 'Proizvođač : MSI\r\nOperativni sistem : Windows 7\r\nProcesor : AMD Athlon 64 X2\r\nTakt procesora : 1.8GHz\r\nDijagonala ekrana : 15.4 \\"\r\nRezolucija ekrana : 1280×800 px\r\nGrafička karta : ATi Mobility RADEON HD2400\r\nRAM memorija : 2GB\r\nKapacitet hard diska :250 GB\r\nOptički uređaj : DVD± R/RW\r\nBaterija : Li-Ion 6 cells\r\nKomunikacija : 56K, GigaLAN, WLAN 802.11b, WLAN 802.11g, Bluetooth,\r\nPortovi : Firewire, D-sub out, S-video out, HDMI out, RJ-45, RJ-11, ExpressCard/34,\r\nUSB 2.0 portova : 4 kom.\r\nUnos : Qwerty tastatura, Touchpad,\r\nČitač kartica : MS, MS Pro, MMC, SD, xD,\r\nDodatne funkcije : Kamera. U odlicnom stanju koristen godinu dana. ', '188.2.84.94 ', 'Oglasivac- Marija', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-27 12-14-19.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-08-27 12-14-19.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-08-27 12-14-19.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(66, 13, 15, 'Izdajem stan', '2011-08-27 12:53:17', 'NIŠ', 'ponuda', '', '018/213-520', '2011-09-26 00:00:00', 'mirdzana@hotmail.com', '', 0, 'DIN', 'IZDAJEM NAMEŠTEN STAN U CENTRU GRADA, KOD PRAVNO-EKONOMSKOG FAKULTETA ZA 3 STUDENTA.', '93.87.116.161 ', 'Oglasivac- Mirjana', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(67, 27, 79, 'lepo i povoljno - prozori', '2011-08-27 16:52:26', 'NIŠ', 'ponuda', 'Livadska 11', '064/29-10-761', '2011-10-26 00:00:00', 's.sekulic75@gmail.com', '', 0, 'DIN', 'Povoljno prodajem prozore sa kapcima /bez kutije - rama/ standardnih deimenzija 140x160 i 140z70 proizvodjaca lesnine i dvoje ulaznih vrata /drvo-staklo/.Pozovite i proverite, moguc dogovor\r\n', '109.92.114.47 ', 'Oglasivac- slobodan', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(68, 13, 15, 'izdavanje', '2011-08-28 09:40:14', 'NIŠ', 'ponuda', 'bulevar nemanjica 90', '0648828966 ', '2011-09-27 00:00:00', 'marija-80@live.com', '', 0, 'DIN', 'Izdajem jednoiposoban stan na kraju bulevara,cg treci sprat moze po dogovoru namesten ili polu namesten.kontakt tel.0648828966', '77.243.20.201 ', 'Oglasivac- marija', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(71, 13, 15, 'IZDAVANJE', '2011-08-29 10:30:06', 'NIŠ', 'ponuda', 'VOJVODE GOJKA', '064/2747501', '2011-09-28 00:00:00', '', '', 0, 'DIN', 'VEOMA POVOLJNO IZDAJEM JEDNOSOBAN NAMESTEN STAN U KUCI U BLIZINI PRAVNOG FAKULTETA I DIFA', '93.184.82.192 ', 'Oglasivac- GOCA', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(72, 17, 29, 'Izdavanje caffe/bar Pegaz', '2011-08-30 01:53:12', 'NIŠ', 'ponuda', 'Vizantijski Bulevar, Park Sveti Sava', '064/8-241-341', '2011-09-29 00:00:00', '', '', 0, 'DIN', 'Izdajem kafic u parku Sv. Sava sa kompletnim inventarom.', '188.2.217.65 ', 'Oglasivac- Sasa', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(70, 25, 61, 'Bicikla Mountain Bike', '2011-08-29 05:56:55', 'NIŠ', 'ponuda', 'Ibarska 17', '064/118-69-20  018/200-660', '2011-09-28 00:00:00', 'mariomilojevic1981@hotmail.com', '', 7000, 'DIN', 'Prodajem bicikl MTB Avantgarde. Velicina rama 57cm, velicina tocka 26\\\\\\" broj brzina 24, viljuska HI-Ten celik, volan Zoom-alu,Shimano menjaci. Dodatno dokupljena zadnji blatobran sa klupom za sedenje i prednji blatobran. Uz biciklu ide i plasticna flasica za vodu sa drzacem i sporcka torbica. Bicikla je malo koriscena u odlicnom stanju.', '212.200.193.91 ', 'Oglasivac- Mario', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-29 05-56-55.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-08-29 05-56-55.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-08-29 05-56-55.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(73, 13, 15, 'Izdajem', '2011-08-30 18:21:44', 'NIŠ', 'ponuda', 'Trg Kralja Aleksandra 2a/9', '018/ 265 503 -  065/696 81 81', '2011-09-29 00:00:00', '', '', 0, 'DIN', 'Izdajem prazan trosoban stan sa ugrađenom kuhinjom i podzemnu garažu na Trgu Kralja Aleksandra 2a (Aleksandrija), treći sprat. Pogodan je za poslovni prostor ili za porodicu.\r\nSve informacije na tel: 018/ 265 503\r\n065 696 81 81', '188.2.217.189 ', 'Oglasivac- Goradana', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(74, 15, 24, 'Pirotski cilim', '2011-08-31 10:55:07', 'NIŠ', 'potraznja', '', '064/9-339-702', '2011-09-30 00:00:00', 'egodobri@yahoo.com', '', 0, 'DIN', 'KUPUJEM stare Pirotske cilime, kolekcionar.Placam najbolje, kes, dolazim na adresu (R.Srbija) \r\nKONTAKT :Telefon 064/9-339-702\r\n         E-mail : egodobri@yahoo.com\r\n         ', '94.228.227.40 ', 'Oglasivac- Dobri', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-31 10-55-06.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-08-31 10-55-06.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-08-31 10-55-06.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika4-2011-08-31 10-55-06.jpg', 'NE'),
(75, 15, 14, 'PIROTSKI CILIM KUPUJEM', '2011-08-31 11:02:56', 'NIŠ', 'ponuda', '', '064/9-339-702', '2011-12-11 00:00:00', 'egodobri@yahoo.com', '', 0, 'DIN', 'KUPUJEM STARE PIROTSKE CILIME I STAZE, Kolekcionar.\r\nPlacam kes, dolazim na adresu (R.srbija)\r\n\r\nKONTAKT : Telefon 064/9-339-702\r\n          E-mail : egodobri@yaho.com', '94.228.227.40 ', 'Oglasivac- Dobri', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-08-31 11-02-56.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika2-2011-08-31 11-02-56.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika3-2011-08-31 11-02-56.jpg', '/images/upload/slikeoglasa/Nis-Oglasi-Slika4-2011-08-31 11-02-56.jpg', 'DA'),
(76, 20, 58, 'akvarijumi', '2011-08-31 19:53:56', 'NIŠ', 'ponuda', 'bjelasnicka 3', '018580808', '2011-09-30 00:00:00', 'nexastreber@hotmail.com', '', 0, 'DIN', 'Prodajem dva akvarijuma jedan od 30 litara koji kosta 700 dinara, a drugi koji kosta 1200 dinara. Pozivi i poruke na broj 0612724308.', '109.245.53.223 ', 'Oglasivac- nemanja', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE'),
(78, 13, 53, 'IZDAJEM STAN', '2011-09-02 18:04:03', 'NIŠ', 'ponuda', 'Bulevar Zorana Đinđića 95/14', '063/404-390 018/ 510-965', '2011-10-02 00:00:00', 'donbucony@gmail.com', '', 0, 'DIN', 'IZDAJEM PRELEP DVOSOBAN STAN U BLIZINI MEDICINSKOG FAKULTETA,KOMPLETNO OPREMLJEN.KLIMA,KABLOVKA TV,TELEFON.\r\nZA PORODICU ILI VIŠE STUDENTA. VREDI POGLEDATI STAN JE U STAMBENOJ ZGRADI III SPRAT.(LIFT U ZGRADI)', '109.93.80.25 ', 'Oglasivac- Siniša', '/images/upload/slikeoglasa/Nis-Oglasi-Glavna-Slika2011-09-02 18-04-03.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', '/images/upload/slikeoglasa/NisOglasi.jpg', 'NE');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

-- 
-- Dumping data for table `podkategorije`
-- 

INSERT INTO `podkategorije` (`id`, `kategorija`, `label`, `page_id`, `link`, `position`) VALUES 
(14, 15, 'Lov', NULL, '/lov', 1),
(45, 23, 'Automobili', NULL, '/automobili', 1),
(12, 14, 'Mobilni telefoni', NULL, '/stanovi', 1),
(15, 13, 'Stanovi', NULL, '/nesto', 1),
(16, 13, 'Kuće', NULL, 'aaa', 3),
(17, 15, 'Ribolov', NULL, 'sss', 2),
(18, 14, 'Računari', NULL, 'aaa', 2),
(77, 15, 'Ostalo', NULL, '/hobiostalo', 6),
(78, 14, 'Ostalo', NULL, '/tehnikaostalo', 5),
(21, 13, 'Placevi', NULL, 'aaw', 4),
(22, 17, 'Administracija, komercijala i upravljanje', NULL, '/Administracijakomercijalaiupravljanje', 1),
(23, 15, 'Ručni radovi', NULL, 'sdfa', 4),
(24, 15, 'Kolekcionarstvo', NULL, 'a', 5),
(25, 13, 'Njive', NULL, 'da', 5),
(26, 13, 'Poslovni prostor', NULL, 'sd', 6),
(27, 13, 'Vikendice', NULL, 'dd', 7),
(28, 17, 'Računarstvo i elektrotehinka', NULL, '/racunarstvoielektrotehinka', 2),
(29, 17, 'Trgovina, ugostiteljstvo, turizam', NULL, '/trgovinaugostiteljstvoturizam', 3),
(30, 17, 'Nega, medicina', NULL, '/negamedicina', 4),
(31, 18, 'Kozmetika', NULL, 'aadasd', 1),
(32, 18, 'Ostalo', NULL, 'adsda', 2),
(33, 14, 'Aparati i uređaji', NULL, 'das', 4),
(58, 20, 'Akvaristika', NULL, '/akvaristika', 6),
(37, 20, 'Psi', NULL, 'sad', 3),
(38, 20, 'Mačke', NULL, 'asdd', 4),
(81, 27, 'Građevinski materijal', NULL, 'gradjevinskimaterijal', 3),
(41, 20, 'Ptice', NULL, '/ptice', 5),
(80, 27, 'Vodovod i grejanje', NULL, 'vodovodigrejanje', 2),
(43, 22, 'Ostalo', NULL, 'adsfa', 1),
(44, 22, 'Kafane', NULL, 'adssd', 2),
(46, 23, 'Motori', NULL, '/motori', 2),
(79, 27, 'Vrata i prozori', NULL, 'vrataiprozori', 1),
(48, 23, 'Auto prikolice', NULL, '/autoprikolice', 1),
(49, 23, 'Auto delovi', NULL, '/autodelovi', 4),
(50, 23, 'Auto placevi', NULL, '/autoplacevi', 5),
(51, 23, 'Plovila', NULL, '/plovila', 6),
(52, 13, 'Garaže', NULL, '/garaze', 8),
(53, 13, 'Ostalo', NULL, '/nekretnineostalo', 9),
(54, 24, 'More', NULL, '/more', 1),
(55, 24, 'Planine', NULL, '/planine', 2),
(56, 24, 'Jezera', NULL, '/jezera', 3),
(57, 23, 'Kamioni', NULL, '/kamioni', 7),
(59, 20, 'Ostalo', NULL, '/ljubimciostalo', 7),
(60, 25, 'Tenis', NULL, '/tenis', 1),
(61, 25, 'Biciklizam', NULL, '/biciklizam', 2),
(62, 25, 'Planinarenje', NULL, '/planinarenje', 3),
(63, 25, 'Skijanje', NULL, '/skijanje', 4),
(64, 25, 'Sportska oprema', NULL, '/sportskaoprema', 5),
(65, 26, 'Web design', NULL, '/webdesign', 1),
(66, 26, 'Programiranje', NULL, '/programiranje', 2),
(67, 26, 'Internet marketing', NULL, '/internetmarketing', 3),
(68, 26, 'Hosting', NULL, '/hosting', 4),
(69, 26, 'Ostalo', NULL, '/softwareostalo', 5),
(70, 24, 'Turističke agencije', NULL, '/turistickeagencije', 4),
(71, 24, 'Ostalo', NULL, '/turizamostalo', 5),
(72, 23, 'Bicikli', NULL, '/bicikli', 8),
(73, 23, 'Ostalo', NULL, '/automotoostalo', 9),
(74, 17, 'Transport i magacin', NULL, '/transportimagacin', 5),
(75, 17, 'Zanati', NULL, 'zanati', 6),
(76, 17, 'Ostalo', NULL, '/posaoostalo', 7),
(82, 27, 'Građevinski alati i oprema', NULL, 'gradjevinski alatiioprema', 4),
(83, 27, 'Bageri dizalice mešalice', NULL, 'bageri', 5),
(84, 27, 'Ostalo', NULL, 'gradjevinarstvoostalo', 6);

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
(1, 'ugljesa', '55b98638e33b23df2d23565b8fe8ddb3', 'Uglješa', 'Karuovic', 'Administrator', 'kruksmail@gmail.com', 'Muški', '16-01-1985', 'Uks je car', '381 64 3326373', '381 16 875791', 'Nema', 'Dusanova', 'Vlasotince', 'www.kruksoft.com', '1.jpg', 'kruksoft d.o.o', 'fead7ce2c632027bb7c64c09bbc311c2', '15-01-2011'),
(28, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'user', 'User', 'user1@gmail.com', 'Muški', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'd6jm1tub43k3cb30m9losre2i2', '20-01-2011');
