-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 02. dub 2023, 22:20
-- Verze serveru: 10.4.27-MariaDB
-- Verze PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `eshop_zahrada`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `dodavatel`
--

CREATE TABLE `dodavatel` (
  `id_d` int(5) NOT NULL,
  `nazev_d` varchar(70) NOT NULL,
  `mesto_sidlo` varchar(30) NOT NULL,
  `ulice_sidlo` varchar(30) NOT NULL,
  `cislo_sidlo` varchar(12) NOT NULL,
  `psc` varchar(6) NOT NULL,
  `tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `dodavatel`
--

INSERT INTO `dodavatel` (`id_d`, `nazev_d`, `mesto_sidlo`, `ulice_sidlo`, `cislo_sidlo`, `psc`, `tel`) VALUES
(1, 'Květiny Floriana', 'Brušperk', 'náměstí J. A. Komenského', '30', '739 44', '+420 603 843 981'),
(2, 'BÁLEK - ZAHRADNICKÉ CENTRUM s.r.o.', 'Stará Ves nad Ondřejnicí', 'Krmelínská', '218', '739 23', '+420 731 934 245'),
(3, 'Semena Ondra', 'Krmelín', 'Lysková', '558', '739 24', '+420 582 146 246'),
(4, 'ZAHRADY R+R - realizace a údržba zahrad s.r.o.', 'Krmelín', 'Stará cesta', '700', '739 24', '+420 734 447 278'),
(5, 'Zahradnictví U KRTKA Šárka Paličková', 'Ostrava-Nová Bělá', 'Mitrovická', '279/449', '724 00', '+420 608 931 022');

-- --------------------------------------------------------

--
-- Struktura tabulky `druhy_stavu_objednavek`
--

CREATE TABLE `druhy_stavu_objednavek` (
  `id_stavu` int(3) NOT NULL,
  `nazev` varchar(30) NOT NULL,
  `popis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `druhy_stavu_objednavek`
--

INSERT INTO `druhy_stavu_objednavek` (`id_stavu`, `nazev`, `popis`) VALUES
(1, 'Vytvořena', 'Právě se vytvořila objednávka a čeká na přijetí.'),
(2, 'Přijatá', 'Právě jsme přijali vaši objednávku, dále ji budeme zpracovávat.'),
(3, 'Zpracovává se', 'Vaši objednávka zpracováváme a poté bude připravena.'),
(4, 'Připravena', 'Vaše objednávka je připravena a poté bude odeslaná.'),
(5, 'Zrušena', 'Vaši objednávku jsme zrušili.');

-- --------------------------------------------------------

--
-- Struktura tabulky `kategorie`
--

CREATE TABLE `kategorie` (
  `id_kategorie` int(3) NOT NULL,
  `nazev` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `kategorie`
--

INSERT INTO `kategorie` (`id_kategorie`, `nazev`) VALUES
(1, 'Květináč'),
(2, 'Hnojivo'),
(3, 'Konvice'),
(4, 'Semena'),
(5, 'Rýč'),
(6, 'Motyčka'),
(7, 'Zahradní nůžky');

-- --------------------------------------------------------

--
-- Struktura tabulky `komentar_produktu_od_zakaznika`
--

CREATE TABLE `komentar_produktu_od_zakaznika` (
  `id_zakaznika` int(4) NOT NULL,
  `id_produktu` int(5) NOT NULL,
  `komentar_uzivatele` varchar(2000) NOT NULL,
  `hodnoceni` int(1) NOT NULL,
  `cas_vytvoreni_komentare` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `komentar_produktu_od_zakaznika`
--

INSERT INTO `komentar_produktu_od_zakaznika` (`id_zakaznika`, `id_produktu`, `komentar_uzivatele`, `hodnoceni`, `cas_vytvoreni_komentare`) VALUES
(1, 8, 'Tohle je dobrý produkt', 5, '2023-03-28 18:48:26'),
(1, 11, 'Ano mohu jedině doporučit', 5, '2023-03-28 20:18:23'),
(1, 13, 'Nevyrostlo nic', 1, '2023-03-28 20:19:46'),
(1, 14, 'Nic moc', 4, '2023-03-28 20:28:44'),
(1, 15, 'Rád s ní okopávám', 4, '2023-03-28 20:25:13'),
(1, 16, 'Funguje celkem slušně, rychle se ztupí', 3, '2023-03-28 20:23:49');

-- --------------------------------------------------------

--
-- Struktura tabulky `objednavka`
--

CREATE TABLE `objednavka` (
  `id_o` int(5) NOT NULL,
  `id_zakaznika` int(4) NOT NULL,
  `poznamky` varchar(200) DEFAULT NULL,
  `zpusob_dopravy` varchar(30) NOT NULL,
  `zpusob_platby` varchar(30) NOT NULL,
  `cas_vytvoreni_objednavky` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `objednavka`
--

INSERT INTO `objednavka` (`id_o`, `id_zakaznika`, `poznamky`, `zpusob_dopravy`, `zpusob_platby`, `cas_vytvoreni_objednavky`) VALUES
(14, 0, '', 'pobocka', 'pri-vyzvednuti', '2023-03-20 18:46:28'),
(15, 0, '', 'pobocka', 'kartou-online', '2023-03-20 18:47:02'),
(18, 1, 'An', 'zasilkovna', 'pri-vyzvednuti', '2023-03-28 16:46:21'),
(22, 1, 'kl', 'zasilkovna', 'kartou-online', '2023-03-29 17:48:23'),
(23, 1, '', 'pobocka', 'kartou-online', '2023-03-29 17:49:34'),
(24, 1, '', 'pobocka', 'kartou-online', '2023-03-29 17:49:36'),
(25, 1, ',', 'pobocka', 'kartou-online', '2023-04-02 11:54:47'),
(26, 1, '', 'pobocka', 'kartou-online', '2023-04-02 19:31:39');

-- --------------------------------------------------------

--
-- Struktura tabulky `obsah_objednavky`
--

CREATE TABLE `obsah_objednavky` (
  `id_o` int(5) NOT NULL,
  `id_p` int(5) NOT NULL,
  `pocet` int(5) NOT NULL,
  `cena_po_objednani` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `obsah_objednavky`
--

INSERT INTO `obsah_objednavky` (`id_o`, `id_p`, `pocet`, `cena_po_objednani`) VALUES
(14, 12, 4, 164),
(18, 11, 4, 71),
(18, 12, 12, 15),
(18, 13, 8, 13),
(18, 14, 6, 207),
(18, 15, 6, 239),
(18, 16, 7, 231),
(22, 8, 1, 660);

-- --------------------------------------------------------

--
-- Struktura tabulky `parametry_produktu`
--

CREATE TABLE `parametry_produktu` (
  `id_parametru_produktu` int(4) NOT NULL,
  `nazev` varchar(30) NOT NULL,
  `hodnota` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `parametry_produktu`
--

INSERT INTO `parametry_produktu` (`id_parametru_produktu`, `nazev`, `hodnota`) VALUES
(2, 'Hmotnost', '25g'),
(3, 'Doba sklizně', 'červenec, září, srpen'),
(5, 'Klíčení', 'při teplotě 15 - 22 °C, 8 - 14 dní'),
(11, 'Hmotnost', '20 Kg'),
(12, 'Doba aplikace', 'Jaro'),
(13, 'Forma hnojiva', 'granulované'),
(14, 'Složení', 'dusík–fosfor–draslík (19-08-08)+2% hořčíku'),
(15, 'Rozsah aplikace', '10 kg hnojiva vystačí cca na 500-830 m² dle typu rostliny');

-- --------------------------------------------------------

--
-- Struktura tabulky `parametr_produktu_produkt`
--

CREATE TABLE `parametr_produktu_produkt` (
  `id_parametru_produktu` int(4) NOT NULL,
  `id_produktu` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `parametr_produktu_produkt`
--

INSERT INTO `parametr_produktu_produkt` (`id_parametru_produktu`, `id_produktu`) VALUES
(2, 13),
(3, 13),
(5, 13),
(11, 8),
(12, 8),
(13, 8),
(14, 8);

-- --------------------------------------------------------

--
-- Struktura tabulky `produkt`
--

CREATE TABLE `produkt` (
  `id_p` int(5) NOT NULL,
  `nazev_p` varchar(70) NOT NULL,
  `popis` varchar(2000) NOT NULL,
  `cena_bez_dph` float NOT NULL,
  `fotka` varchar(100) NOT NULL,
  `id_d` int(5) NOT NULL,
  `id_kategorie` int(3) NOT NULL,
  `pocet_skladem` int(5) NOT NULL,
  `zverejnen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `produkt`
--

INSERT INTO `produkt` (`id_p`, `nazev_p`, `popis`, `cena_bez_dph`, `fotka`, `id_d`, `id_kategorie`, `pocet_skladem`, `zverejnen`) VALUES
(1, 'Jackova fazole', '22', 299, 'images/nahrane/tvojemama.png', 1, 4, 8, 0),
(8, 'AGRO Trávníkové hnojivo 20 kg 19-08-08+2MgO', '<strong>AGRO Trávníkové hnojivo</strong> je určeno pro základní hnojení travnatých ploch na začátku i během vegetace. Bezchloridové hnojivo má rychlý účinek, obsahuje hořčík pro sytě zelenou barvu trávníku a zdravý vzhled trávníku.', 660, 'images/nahrane/_vyr_679000361-agro-travnikove-hnojivo-20kg-19-08-08-2MgO.png', 2, 2, 45, 1),
(11, 'Květináč plastový, 24cm', 'Interiérový květináč s možností umístění pouze ve vnitřních prostorách. Tento květináč je vyroben z plastu a je to základní model s nejnižší cenou z celé naší nabídky květináčů. Designem a barvou připomíná keramické květináče. Hodí se pro živé i umělé rostliny.', 71, 'images/nahrane/_vyr_111883011017a.jpg', 3, 1, 12, 1),
(12, 'PARKSIDE® Konev na zalévání, 10 l', 'Praktická 10litrová konev na zalévání do interiéru i exteriéru\r\nVelké obloukové držadlo\r\nIntegrovaný držák se sprchovacím nástavcem u ruky\r\nRobustní plast odolný vůči povětrnostním vlivům\r\nLitrová stupnice', 164.46, 'images/nahrane/gcpbe8f65d799e44ea78895af7d2b3c9223.jpeg', 3, 3, 56, 1),
(13, 'Ředkvička - Riesenbutter (Máslová obří)', 'Odrůda vyvářející kulovitou tmavěčervenou bulvičku se slabším obrostem listů. Bulvičky netrpí korkovitostí a zahníváním. Dužnina je jasně bílé barvy. Lze ji vysévat na záhon i v srpnu, poté sklízíme během září a října. Ředkvičky jsou u zahrádkářů velmi oblíbené. Je to kvůli jejich rychlému růstu a jednoduchému pěstování. Pěstování ředkviček zvládne i úplný začátečník.\r\n\r\nŘedkvičky pěstujeme nejčastěji přímým výsevem do záhonů. Předpěstování urychlí růst, ale nutné rozhodně není. Ředkvičky totiž rostou opravdu rychle a na první sklizeň se nečeká dlouho. V chráněných prostorách růst trvá zhruba 3 - 4 týdny. Při pěstování přímo na záhonech ředkvičky vyrostou za přibližně 5 týdnů.\r\n\r\nJak pěstovat ředkvičky:\r\n\r\nVybereme vhodnou odrůdu. Pěstování je pro všechny odrůdy podobné.\r\nŘedkvičkám prospívá lehčí a teplá půda. Růst lze podpořit položením černé fólie.\r\nPřed setím půdu prokypříme.\r\nJe vhodné přidat do půdy kompost, dodá ředkvičkám živiny.\r\nDo venkovních záhonů ředkvičky vysévejme cca od března.\r\nŘádky by měly mít mezi sebou vzdálenost asi 20 centimetrů.\r\nSejeme do hloubky cca 1,5 centimetru.\r\nJe třeba dát pozor, aby výsev nebyl přehuštěný. Příliš mnoho rostlinek na jednom místě je náchylných k tvorbě plísní.\r\nAž rostlinky začnou klíčit, protrháme je. Zajistíme tak rostlinkám dostatek prostoru i živin.\r\nPůdu udržujeme vlhkou, ale nepřeléváme ji. Mohly by se v ní začít tvořit plísně. \r\nPokud ředkvičky vysazujeme znovu, vystřídáme záhon, jinak by ředkvičkám mohly začít černat kořeny.', 13.04, 'images/nahrane/front.jpg', 3, 4, 156, 1),
(14, 'Rýč špičatý DEK', '', 207, 'images/nahrane/152702.png', 5, 5, 10, 1),
(15, 'Motyka kovová, lisovaná, s dřevěnou násadou, 80 mm', 'Rovná motyka s dřevěnou násadou.', 239, 'images/nahrane/153304.png', 2, 6, 32, 1),
(16, 'Gardena Zahradní nůžky Bypass', 'Všestranné využití\r\nVhodné pro stříhání květin, mladých výhonků a větviček\r\nErgonomické rukojeti\r\nPraktická bezpečnostní pojistka, kterou lze ovládat jednou rukou\r\nSnadno ovladatelné a efektivní, s dlouhou životností\r\nPro kreativní zahrádkáře\r\nVýkonné a rychlé stříhání díky pohodlným rukojetím s měkkými komponenty a 2 polohami úchopu\r\nTloušťka řezu: max. cca 18 mm\r\nPrincip řezání: bypass', 230.58, 'images/nahrane/gcpc0a8b81ee2ce4c3b93cb1f6bf643d63a.jpeg', 4, 7, 29, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `stav_objednavky`
--

CREATE TABLE `stav_objednavky` (
  `id_objednavky` int(5) NOT NULL,
  `id_stavu` int(3) NOT NULL,
  `komentar` varchar(100) DEFAULT NULL,
  `cas_stavu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `stav_objednavky`
--

INSERT INTO `stav_objednavky` (`id_objednavky`, `id_stavu`, `komentar`, `cas_stavu`) VALUES
(18, 1, 'ano', '2023-04-01 21:50:21');

-- --------------------------------------------------------

--
-- Struktura tabulky `zakaznik`
--

CREATE TABLE `zakaznik` (
  `id_zakaznika` int(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jmeno` varchar(50) NOT NULL,
  `prijmeni` varchar(50) NOT NULL,
  `heslo` varchar(200) NOT NULL,
  `mesto` varchar(40) NOT NULL,
  `ulice` varchar(40) NOT NULL,
  `cislo_p` int(5) NOT NULL,
  `psc` int(5) NOT NULL,
  `prava` int(1) NOT NULL,
  `telefon_cislo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `zakaznik`
--

INSERT INTO `zakaznik` (`id_zakaznika`, `email`, `jmeno`, `prijmeni`, `heslo`, `mesto`, `ulice`, `cislo_p`, `psc`, `prava`, `telefon_cislo`) VALUES
(0, 'david@gmail.com', 'Jan', 'Černější', 'ed2800d627c35b624f4383f37979de15d667ea0e5a66137f15121556d0f9660d', 'Ostrava', 'Fojtská', 98, 70030, 0, '879456123'),
(1, 'r.tokarsky.st@spseiostrava.cz', 'Robin', 'Tokarský', 'ed2800d627c35b624f4383f37979de15d667ea0e5a66137f15121556d0f9660d', 'Praha', 'Dejvice', 76, 74125, 1, '723400000'),
(7, 'zahradik@seznam.cz', 'Tom', 'Bezva', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'Krmelín', 'Fojtská', 6, 73924, 0, '852321456');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `dodavatel`
--
ALTER TABLE `dodavatel`
  ADD PRIMARY KEY (`id_d`);

--
-- Indexy pro tabulku `druhy_stavu_objednavek`
--
ALTER TABLE `druhy_stavu_objednavek`
  ADD PRIMARY KEY (`id_stavu`);

--
-- Indexy pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id_kategorie`);

--
-- Indexy pro tabulku `komentar_produktu_od_zakaznika`
--
ALTER TABLE `komentar_produktu_od_zakaznika`
  ADD PRIMARY KEY (`id_zakaznika`,`id_produktu`),
  ADD KEY `id_produtku` (`id_produktu`);

--
-- Indexy pro tabulku `objednavka`
--
ALTER TABLE `objednavka`
  ADD PRIMARY KEY (`id_o`),
  ADD KEY `id_zakaznika` (`id_zakaznika`);

--
-- Indexy pro tabulku `obsah_objednavky`
--
ALTER TABLE `obsah_objednavky`
  ADD PRIMARY KEY (`id_o`,`id_p`),
  ADD KEY `id_p` (`id_p`);

--
-- Indexy pro tabulku `parametry_produktu`
--
ALTER TABLE `parametry_produktu`
  ADD PRIMARY KEY (`id_parametru_produktu`);

--
-- Indexy pro tabulku `parametr_produktu_produkt`
--
ALTER TABLE `parametr_produktu_produkt`
  ADD PRIMARY KEY (`id_parametru_produktu`,`id_produktu`),
  ADD UNIQUE KEY `id_parametru_produktu` (`id_parametru_produktu`),
  ADD KEY `id_parametru_produktu_2` (`id_parametru_produktu`,`id_produktu`),
  ADD KEY `id_produktu` (`id_produktu`);

--
-- Indexy pro tabulku `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `kategorie_id` (`id_kategorie`),
  ADD KEY `kategeorie_produkt` (`id_d`) USING BTREE;

--
-- Indexy pro tabulku `stav_objednavky`
--
ALTER TABLE `stav_objednavky`
  ADD PRIMARY KEY (`id_objednavky`,`id_stavu`),
  ADD KEY `id_o` (`id_objednavky`,`id_stavu`),
  ADD KEY `id_stavu` (`id_stavu`);

--
-- Indexy pro tabulku `zakaznik`
--
ALTER TABLE `zakaznik`
  ADD PRIMARY KEY (`id_zakaznika`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `dodavatel`
--
ALTER TABLE `dodavatel`
  MODIFY `id_d` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `druhy_stavu_objednavek`
--
ALTER TABLE `druhy_stavu_objednavek`
  MODIFY `id_stavu` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id_kategorie` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pro tabulku `objednavka`
--
ALTER TABLE `objednavka`
  MODIFY `id_o` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pro tabulku `parametry_produktu`
--
ALTER TABLE `parametry_produktu`
  MODIFY `id_parametru_produktu` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pro tabulku `produkt`
--
ALTER TABLE `produkt`
  MODIFY `id_p` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pro tabulku `zakaznik`
--
ALTER TABLE `zakaznik`
  MODIFY `id_zakaznika` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `komentar_produktu_od_zakaznika`
--
ALTER TABLE `komentar_produktu_od_zakaznika`
  ADD CONSTRAINT `komentar_produktu_od_zakaznika_ibfk_1` FOREIGN KEY (`id_produktu`) REFERENCES `produkt` (`id_p`),
  ADD CONSTRAINT `komentar_produktu_od_zakaznika_ibfk_2` FOREIGN KEY (`id_zakaznika`) REFERENCES `zakaznik` (`id_zakaznika`);

--
-- Omezení pro tabulku `objednavka`
--
ALTER TABLE `objednavka`
  ADD CONSTRAINT `objednavka_ibfk_1` FOREIGN KEY (`id_zakaznika`) REFERENCES `zakaznik` (`id_zakaznika`);

--
-- Omezení pro tabulku `obsah_objednavky`
--
ALTER TABLE `obsah_objednavky`
  ADD CONSTRAINT `obsah_objednavky_ibfk_1` FOREIGN KEY (`id_o`) REFERENCES `objednavka` (`id_o`),
  ADD CONSTRAINT `obsah_objednavky_ibfk_2` FOREIGN KEY (`id_p`) REFERENCES `produkt` (`id_p`);

--
-- Omezení pro tabulku `parametr_produktu_produkt`
--
ALTER TABLE `parametr_produktu_produkt`
  ADD CONSTRAINT `parametr_produktu_produkt_ibfk_1` FOREIGN KEY (`id_produktu`) REFERENCES `produkt` (`id_p`),
  ADD CONSTRAINT `parametr_produktu_produkt_ibfk_2` FOREIGN KEY (`id_parametru_produktu`) REFERENCES `parametry_produktu` (`id_parametru_produktu`);

--
-- Omezení pro tabulku `produkt`
--
ALTER TABLE `produkt`
  ADD CONSTRAINT `produkt_ibfk_1` FOREIGN KEY (`id_kategorie`) REFERENCES `kategorie` (`id_kategorie`),
  ADD CONSTRAINT `produkt_ibfk_2` FOREIGN KEY (`id_d`) REFERENCES `dodavatel` (`id_d`);

--
-- Omezení pro tabulku `stav_objednavky`
--
ALTER TABLE `stav_objednavky`
  ADD CONSTRAINT `stav_objednavky_ibfk_1` FOREIGN KEY (`id_objednavky`) REFERENCES `objednavka` (`id_o`),
  ADD CONSTRAINT `stav_objednavky_ibfk_2` FOREIGN KEY (`id_stavu`) REFERENCES `druhy_stavu_objednavek` (`id_stavu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
